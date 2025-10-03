@extends('layouts.admin')

@section('title', 'Buat Pesanan')

@section('content')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Pesanan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Buat</li>
		</ol>
	</nav>

	<div class="card">
		<div class="card-header">Form Pesanan</div>
		<div class="card-body">
			@if($errors->any())
				<div class="alert alert-danger">Periksa kembali input Anda.</div>
			@endif
			<form method="POST" action="{{ route('admin.orders.store') }}">
				@include('admin.orders._form')
			</form>
		</div>
	</div>
@endsection


