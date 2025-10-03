@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Layanan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit</li>
		</ol>
	</nav>

	<div class="card">
		<div class="card-header">Form Edit Layanan</div>
		<div class="card-body">
			<form method="POST" action="{{ route('admin.services.update', $service) }}">
				@method('PUT')
				@include('admin.services._form', ['service' => $service])
			</form>
		</div>
	</div>
@endsection


