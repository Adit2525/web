@extends('layouts.admin')

@section('title', 'Tambah Pelanggan')

@section('content')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Pelanggan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Tambah</li>
		</ol>
	</nav>

	<div class="card">
		<div class="card-header">Form Tambah Pelanggan</div>
		<div class="card-body">
			@if($errors->any())
				<div class="alert alert-danger">Periksa kembali input Anda.</div>
			@endif
			<form method="POST" action="{{ route('admin.customers.store') }}">
				@include('admin.customers._form')
			</form>
		</div>
	</div>
@endsection


