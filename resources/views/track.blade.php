@extends('layouts.public')

@section('title', 'Lacak Pesanan')

@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="h3 mb-4">Lacak Pesanan</h1>
            <form method="GET" action="{{ route('track') }}" class="row g-2 mb-4">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="kode_invoice" value="{{ $kode ?? '' }}" placeholder="Masukkan kode invoice">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100" type="submit"><i class="bi bi-search"></i> Lacak</button>
                </div>
            </form>

            @if(isset($kode) && $kode !== '')
                @if($order)
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="fw-semibold">Invoice: {{ $order->kode_invoice }}</div>
                                    <div class="text-muted small">{{ $order->customer->nama }}</div>
                                </div>
                                <div>
                                    <span class="badge bg-info text-dark">{{ $order->status }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="small text-muted">Tanggal Pesan</div>
                                    <div>{{ optional($order->tanggal_pesan)->format('d M Y H:i') ?: '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="small text-muted">Tanggal Selesai</div>
                                    <div>{{ optional($order->tanggal_selesai)->format('d M Y H:i') ?: '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">Kode invoice tidak ditemukan.</div>
                @endif
            @endif
        </div>
    </section>
@endsection


