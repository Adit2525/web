@extends('layouts.admin')

@section('title', 'Edit Pelanggan')

@section('content')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Pelanggan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit</li>
		</ol>
	</nav>

	<div class="card">
		<div class="card-header">Form Edit Pelanggan</div>
		<div class="card-body">
			@if($errors->any())
				<div class="alert alert-danger">Periksa kembali input Anda.</div>
			@endif
			<form method="POST" action="{{ route('admin.customers.update', $customer) }}">
				@method('PUT')
				@include('admin.customers._form', ['customer' => $customer])
			</form>
		</div>
	</div>
@endsection


