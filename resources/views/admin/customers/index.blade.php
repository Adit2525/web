@extends('layouts.admin')

@section('title', 'Pelanggan')

@section('content')
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="h4 mb-0">Pelanggan</h1>
		<a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
			<i class="bi bi-plus-lg"></i> Tambah Pelanggan
		</a>
	</div>

	<div class="card">
		<div class="table-responsive">
			<table class="table table-hover align-middle mb-0">
				<thead class="table-light">
					<tr>
						<th>#</th>
						<th>Nama</th>
						<th>No. Telepon</th>
						<th>Alamat</th>
						<th class="text-end">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse($customers as $customer)
						<tr>
							<td>{{ $loop->iteration + ($customers->currentPage()-1)*$customers->perPage() }}</td>
							<td>{{ $customer->nama }}</td>
							<td>{{ $customer->no_telepon }}</td>
							<td>{{ $customer->alamat }}</td>
							<td class="text-end">
								<a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
								<form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pelanggan ini?');">
									@csrf
									@method('DELETE')
									<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
								</form>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="5" class="text-center text-muted">Belum ada pelanggan.</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
		@if($customers->hasPages())
			<div class="card-footer">{{ $customers->links() }}</div>
		@endif
	</div>
@endsection


