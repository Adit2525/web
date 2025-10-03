@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Layanan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Tambah</li>
		</ol>
	</nav>

	<div class="card">
		<div class="card-header">Form Tambah Layanan</div>
		<div class="card-body">
			<form method="POST" action="{{ route('admin.services.store') }}">
				@include('admin.services._form')
			</form>
		</div>
	</div>
@endsection


