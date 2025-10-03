@extends('layouts.admin')

@section('title', 'Edit Pesanan')

@section('content')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Pesanan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit</li>
		</ol>
	</nav>

	<div class="card">
		<div class="card-header">Edit Pesanan {{ $order->kode_invoice }}</div>
		<div class="card-body">
			@if($errors->any())
				<div class="alert alert-danger">Periksa kembali input Anda.</div>
			@endif
			<form method="POST" action="{{ route('admin.orders.update', $order) }}">
				@method('PUT')
				@include('admin.orders._form', ['order' => $order])
			</form>
		</div>
	</div>
@endsection


