@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="h4 mb-0">Layanan</h1>
		<a href="{{ route('admin.services.create') }}" class="btn btn-primary">
			<i class="bi bi-plus-lg"></i> Tambah Layanan
		</a>
	</div>

	<div class="card">
		<div class="table-responsive">
			<table class="table table-hover align-middle mb-0">
				<thead class="table-light">
					<tr>
						<th>#</th>
						<th>Nama Layanan</th>
						<th>Satuan</th>
						<th>Harga</th>
						<th class="text-end">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse($services as $service)
						<tr>
							<td>{{ $loop->iteration + ($services->currentPage()-1)*$services->perPage() }}</td>
							<td>{{ $service->nama_layanan }}</td>
							<td><span class="badge bg-secondary">{{ strtoupper($service->satuan) }}</span></td>
							<td>Rp {{ number_format($service->harga, 0, ',', '.') }}</td>
							<td class="text-end">
								<a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary">
									<i class="bi bi-pencil"></i>
								</a>
								<form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus layanan ini?');">
									@csrf
									@method('DELETE')
									<button class="btn btn-sm btn-outline-danger">
										<i class="bi bi-trash"></i>
									</button>
								</form>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="5" class="text-center text-muted">Belum ada layanan.</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
		@if($services->hasPages())
			<div class="card-footer">
				{{ $services->links() }}
			</div>
		@endif
	</div>
@endsection
