@extends('layouts.public')

@section('title', $service->nama_layanan)

@section('content')
    <section class="py-5">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('services.public') }}">Layanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $service->nama_layanan }}</li>
                </ol>
            </nav>
            <div class="row g-4">
                <div class="col-lg-3 order-lg-1 order-2">
                    @include('services._sidebar', ['allServices' => $sidebarServices, 'service' => $service])
                </div>
                <div class="col-lg-9 order-lg-2 order-1">
                    <div class="row g-4">
                        <div class="col-12 col-xl-8">
                            <h1 class="h3">{{ $service->nama_layanan }}</h1>
                            <div class="text-muted mb-3">Satuan: {{ strtoupper($service->satuan) }}</div>
                            <p>{{ $service->deskripsi }}</p>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="small text-muted">Harga mulai dari</div>
                                    <div class="display-6">Rp {{ number_format($service->harga, 0, ',', '.') }}</div>
                                    <div class="text-muted mb-3">per {{ $service->satuan }}</div>
                                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success w-100"><i class="bi bi-whatsapp"></i> Pesan via WhatsApp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


