<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class OrderPublicController extends Controller
{
    public function create(Request $request): View
    {
        $services = Service::orderBy('nama_layanan')->get();
        return view('order.create', compact('services'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:500'],
            'no_telepon' => ['required', 'string', 'max:30'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.service_id' => ['required', 'integer', 'exists:services,id'],
            'items.*.jumlah' => ['required', 'integer', 'min:1'],
        ]);

        // Upsert customer by phone number
        $customer = Customer::firstOrCreate(
            ['no_telepon' => $data['no_telepon']],
            [
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
            ]
        );

        // Generate kode_invoice
        $kodeInvoice = $this->generateInvoiceCode();

        // Create order
        $order = Order::create([
            'customer_id' => $customer->id,
            'kode_invoice' => $kodeInvoice,
            'total_harga' => 0,
            'status' => 'menunggu',
            'tanggal_pesan' => now(),
        ]);

        $total = 0;
        foreach ($data['items'] as $item) {
            $service = Service::findOrFail($item['service_id']);
            $jumlah = (int) $item['jumlah'];
            $subtotal = $service->harga * $jumlah;

            OrderDetail::create([
                'order_id' => $order->id,
                'service_id' => $service->id,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $order->update(['total_harga' => $total]);

        return redirect()->route('order.success', ['kode' => $order->kode_invoice]);
    }

    public function success(string $kode): View
    {
        $order = Order::with(['customer', 'details.service'])->where('kode_invoice', $kode)->firstOrFail();
        return view('order.success', compact('order'));
    }

    private function generateInvoiceCode(): string
    {
        $prefix = 'INV-' . now()->format('Ymd');
        $random = strtoupper(Str::random(4));
        $seq = str_pad((string) (Order::whereDate('created_at', today())->count() + 1), 3, '0', STR_PAD_LEFT);
        return $prefix . '-' . $seq . $random;
    }
}


