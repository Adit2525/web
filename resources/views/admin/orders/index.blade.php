@extends('layouts.admin')

@section('title', 'Pesanan')

@section('content')
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="h4 mb-0">Pesanan</h1>
		<div class="d-flex gap-2">
			<form class="d-flex align-items-center gap-2" action="{{ route('admin.orders.export') }}" method="GET">
				<input type="date" name="from" class="form-control form-control-sm" value="{{ request('from') }}" placeholder="Dari">
				<input type="date" name="to" class="form-control form-control-sm" value="{{ request('to') }}" placeholder="Sampai">
				<button class="btn btn-outline-secondary btn-sm" type="submit"><i class="bi bi-download"></i> Ekspor CSV</button>
			</form>
			<a href="{{ route('admin.orders.create') }}" class="btn btn-primary">
				<i class="bi bi-plus-lg"></i> Buat Pesanan
			</a>
		</div>
	</div>

	<div class="card">
		<div class="table-responsive">
			<table class="table table-hover align-middle mb-0">
				<thead class="table-light">
					<tr>
						<th>#</th>
						<th>Invoice</th>
						<th>Pelanggan</th>
						<th>Status</th>
						<th>Total</th>
						<th>Tanggal</th>
						<th class="text-end">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse($orders as $order)
						<tr>
							<td>{{ $loop->iteration + ($orders->currentPage()-1)*$orders->perPage() }}</td>
							<td><a href="{{ route('admin.orders.show', $order) }}">{{ $order->kode_invoice }}</a></td>
							<td>{{ $order->customer->nama }}</td>
							<td><span class="badge bg-info text-dark">{{ $order->status }}</span></td>
							<td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
							<td>{{ optional($order->tanggal_pesan)->format('d M Y H:i') }}</td>
							<td class="text-end">
								<a href="{{ route('admin.orders.invoice', $order) }}" class="btn btn-sm btn-outline-secondary" title="Invoice PDF"><i class="bi bi-file-earmark-pdf"></i></a>
								<a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
								<form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesanan ini?');">
									@csrf
									@method('DELETE')
									<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
								</form>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="7" class="text-center text-muted">Belum ada pesanan.</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
		@if($orders->hasPages())
			<div class="card-footer">{{ $orders->links() }}</div>
		@endif
	</div>
@endsection


