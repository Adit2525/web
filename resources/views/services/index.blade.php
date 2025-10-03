@extends('layouts.public')

@section('title', 'Daftar Layanan')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    @include('services._sidebar', ['allServices' => $sidebarServices])
                </div>
                <div class="col-lg-9">
                    <h1 class="h3 mb-4">Layanan Kami</h1>
                    <div class="row g-4">
                        @foreach($services as $service)
                            <div class="col-md-4">
                                <div class="card service-card h-100">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $service->nama_layanan }}</h5>
                                        <div class="text-muted small mb-2">{{ Str::limit($service->deskripsi, 80) }}</div>
                                        <div class="mt-auto">
                                            <div class="fw-semibold">Mulai dari</div>
                                            <div class="h5 mb-3">Rp {{ number_format($service->harga, 0, ',', '.') }} / {{ $service->satuan }}</div>
                                            <a href="{{ route('services.show', $service) }}" class="btn btn-outline-primary w-100">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($services->hasPages())
                        <div class="mt-4">{{ $services->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection


