<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
	public function index()
	{
		$orders = Order::with(['customer'])
			->latest('id')
			->paginate(10);

		return view('admin.orders.index', compact('orders'));
	}

	public function create()
	{
		$customers = Customer::orderBy('nama')->get();
		$services = Service::orderBy('nama_layanan')->get();
		$statuses = ['Pesanan Diterima', 'Sedang Dijemput', 'Sedang Dicuci', 'Selesai', 'Sudah Diantar'];

		return view('admin.orders.create', compact('customers', 'services', 'statuses'));
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'customer_id' => ['required', 'exists:customers,id'],
			'status' => ['required', Rule::in(['Pesanan Diterima', 'Sedang Dijemput', 'Sedang Dicuci', 'Selesai', 'Sudah Diantar'])],
			'tanggal_pesan' => ['nullable', 'date'],
			'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_pesan'],
			'details' => ['required', 'array', 'min:1'],
			'details.*.service_id' => ['required', 'exists:services,id'],
			'details.*.jumlah' => ['required', 'integer', 'min:1'],
		]);

		DB::transaction(function () use ($validated) {
			$kodeInvoice = $this->generateInvoiceCode();

			$order = Order::create([
				'customer_id' => $validated['customer_id'],
				'kode_invoice' => $kodeInvoice,
				'status' => $validated['status'],
				'tanggal_pesan' => $validated['tanggal_pesan'] ?? now(),
				'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
				'total_harga' => 0,
			]);

			$total = 0;
			$servicePrices = Service::whereIn('id', collect($validated['details'])->pluck('service_id'))
				->pluck('harga', 'id');

			foreach ($validated['details'] as $row) {
				$harga = (float) ($servicePrices[$row['service_id']] ?? 0);
				$subtotal = $harga * (int) $row['jumlah'];
				$total += $subtotal;

				OrderDetail::create([
					'order_id' => $order->id,
					'service_id' => $row['service_id'],
					'jumlah' => $row['jumlah'],
					'subtotal' => $subtotal,
				]);
			}

			$order->update(['total_harga' => $total]);
		});

		return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dibuat.');
	}

	public function show(Order $order)
	{
		$order->load(['customer', 'details.service']);
		return view('admin.orders.show', compact('order'));
	}

	public function edit(Order $order)
	{
		$order->load(['details']);
		$customers = Customer::orderBy('nama')->get();
		$services = Service::orderBy('nama_layanan')->get();
		$statuses = ['Pesanan Diterima', 'Sedang Dijemput', 'Sedang Dicuci', 'Selesai', 'Sudah Diantar'];
		return view('admin.orders.edit', compact('order', 'customers', 'services', 'statuses'));
	}

	public function update(Request $request, Order $order)
	{
		$validated = $request->validate([
			'customer_id' => ['required', 'exists:customers,id'],
			'status' => ['required', Rule::in(['Pesanan Diterima', 'Sedang Dijemput', 'Sedang Dicuci', 'Selesai', 'Sudah Diantar'])],
			'tanggal_pesan' => ['nullable', 'date'],
			'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_pesan'],
			'details' => ['required', 'array', 'min:1'],
			'details.*.service_id' => ['required', 'exists:services,id'],
			'details.*.jumlah' => ['required', 'integer', 'min:1'],
		]);

		DB::transaction(function () use ($validated, $order) {
			$order->update([
				'customer_id' => $validated['customer_id'],
				'status' => $validated['status'],
				'tanggal_pesan' => $validated['tanggal_pesan'] ?? $order->tanggal_pesan,
				'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
			]);

			// Rebuild details
			$order->details()->delete();

			$total = 0;
			$servicePrices = Service::whereIn('id', collect($validated['details'])->pluck('service_id'))
				->pluck('harga', 'id');

			foreach ($validated['details'] as $row) {
				$harga = (float) ($servicePrices[$row['service_id']] ?? 0);
				$subtotal = $harga * (int) $row['jumlah'];
				$total += $subtotal;

				OrderDetail::create([
					'order_id' => $order->id,
					'service_id' => $row['service_id'],
					'jumlah' => $row['jumlah'],
					'subtotal' => $subtotal,
				]);
			}

			$order->update(['total_harga' => $total]);
		});

		return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil diperbarui.');
	}

	public function destroy(Order $order)
	{
		$order->delete();
		return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
	}

	private function generateInvoiceCode(): string
	{
		$prefix = 'INV-'.now()->format('Ymd');
		$last = Order::where('kode_invoice', 'like', $prefix.'%')
			->latest('id')
			->value('kode_invoice');
		$seq = 1;
		if ($last) {
			$parts = explode('-', $last);
			$seq = (int) end($parts) + 1;
		}
		return sprintf('%s-%04d', $prefix, $seq);
	}

    public function invoice(Order $order)
    {
        $order->load(['customer', 'details.service']);
        $pdf = Pdf::loadView('admin.orders.invoice_pdf', ['order' => $order]);
        return $pdf->download($order->kode_invoice.'.pdf');
    }

    public function export(Request $request)
    {
        $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ]);

        $query = Order::with(['customer']);
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->date('from'));
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->date('to'));
        }

        $rows = $query->orderBy('id')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="orders_export.csv"',
        ];

        $callback = function () use ($rows) {
            $output = fopen('php://output', 'w');
            fputcsv($output, ['ID', 'Invoice', 'Pelanggan', 'Status', 'Total', 'Tanggal Pesan']);
            foreach ($rows as $o) {
                fputcsv($output, [
                    $o->id,
                    $o->kode_invoice,
                    optional($o->customer)->nama,
                    $o->status,
                    $o->total_harga,
                    optional($o->tanggal_pesan)->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }
}
