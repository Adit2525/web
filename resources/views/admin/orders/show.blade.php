@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Pesanan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Detail</li>
		</ol>
	</nav>

	<div class="card mb-3">
		<div class="card-body">
			<div class="d-flex justify-content-between align-items-center mb-2">
				<div>
					<h5 class="mb-1">{{ $order->kode_invoice }}</h5>
					<div class="text-muted">{{ $order->customer->nama }} | {{ $order->customer->no_telepon }}</div>
				</div>
				<div class="d-flex gap-2">
					<a href="{{ route('admin.orders.invoice', $order) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-file-earmark-pdf"></i> Invoice</a>
					<a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Edit</a>
					<a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
				</div>
			</div>
			<div class="row g-3">
				<div class="col-md-6">
					<div class="text-muted">{{ optional($order->tanggal_pesan)->format('d M Y H:i') }}</div>
				</div>
				<div class="col-md-6 text-md-end">
					<span class="badge bg-info text-dark">{{ $order->status }}</span>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Detail Pesanan</h5>
		</div>
		<div class="card-body">
			<div class="row g-3 mb-4">
				<div class="col-md-6">
					<strong>Nama Pelanggan:</strong><br>
					{{ $order->customer->nama }}
				</div>
				<div class="col-md-6">
					<strong>No. Telepon:</strong><br>
					{{ $order->customer->no_telepon }}
				</div>
				<div class="col-12">
					<strong>Alamat:</strong><br>
					{{ $order->customer->alamat }}
				</div>
				<div class="col-md-6">
					<strong>Status:</strong><br>
					<span class="badge bg-info text-dark">{{ $order->status }}</span>
				</div>
				<div class="col-md-6">
					<strong>Tanggal Pesan:</strong><br>
					{{ optional($order->tanggal_pesan)->format('d M Y H:i') }}
				</div>
				@if($order->tanggal_selesai)
				<div class="col-md-6">
					<strong>Tanggal Selesai:</strong><br>
					{{ $order->tanggal_selesai->format('d M Y H:i') }}
				</div>
				@endif
			</div>
			
			<div class="table-responsive">
				<table class="table align-middle">
					<thead>
						<tr>
							<th>Layanan</th>
							<th class="text-end">Harga</th>
							<th class="text-end">Jumlah</th>
							<th class="text-end">Subtotal</th>
						</tr>
					</thead>
					<tbody>
						@foreach($order->details as $d)
							<tr>
								<td>{{ $d->service->nama_layanan }}</td>
								<td class="text-end">Rp {{ number_format($d->service->harga, 0, ',', '.') }}</td>
								<td class="text-end">{{ $d->jumlah }}</td>
								<td class="text-end">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr class="table-primary">
							<th colspan="3" class="text-end">Total</th>
							<th class="text-end">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
@endsection


