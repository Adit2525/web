@extends('layouts.admin')

@section('title', 'Detail Layanan')

@section('content')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Layanan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Detail</li>
		</ol>
	</nav>

	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center">
			<span>Detail Layanan</span>
			<div class="d-flex gap-2">
				<a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Edit</a>
				<a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
			</div>
		</div>
		<div class="card-body">
			<dl class="row">
				<dt class="col-sm-3">Nama Layanan</dt>
				<dd class="col-sm-9">{{ $service->nama_layanan }}</dd>
				<dt class="col-sm-3">Satuan</dt>
				<dd class="col-sm-9"><span class="badge bg-secondary">{{ strtoupper($service->satuan) }}</span></dd>
				<dt class="col-sm-3">Harga</dt>
				<dd class="col-sm-9">Rp {{ number_format($service->harga, 0, ',', '.') }}</dd>
				<dt class="col-sm-3">Deskripsi</dt>
				<dd class="col-sm-9">{{ $service->deskripsi ?: '-' }}</dd>
			</dl>
		</div>
	</div>
@endsection


