@extends('layouts.public')

@section('title', 'Pesanan Berhasil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    
                    <h1 class="h3 mb-3 text-success">Pesanan Berhasil Dibuat!</h1>
                    <p class="text-muted mb-4">Terima kasih telah mempercayai layanan laundry kami. Pesanan Anda sedang diproses.</p>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">Kode Invoice</h6>
                                    <p class="card-text h5 mb-0">{{ $order->kode_invoice }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">Total Harga</h6>
                                    <p class="card-text h5 mb-0">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Detail Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <strong>Nama Pelanggan:</strong><br>
                                    {{ $order->customer->nama }}
                                </div>
                                <div class="col-md-6">
                                    <strong>No. Telepon:</strong><br>
                                    {{ $order->customer->no_telepon }}
                                </div>
                                <div class="col-12">
                                    <strong>Alamat:</strong><br>
                                    {{ $order->customer->alamat }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Status:</strong><br>
                                    <span class="badge bg-warning">{{ $order->status }}</span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Tanggal Pesan:</strong><br>
                                    {{ $order->tanggal_pesan->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Layanan yang Dipesan</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Layanan</th>
                                            <th class="text-end">Harga</th>
                                            <th class="text-end">Jumlah</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->details as $detail)
                                        <tr>
                                            <td>{{ $detail->service->nama_layanan }}</td>
                                            <td class="text-end">Rp {{ number_format($detail->service->harga, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ $detail->jumlah }}</td>
                                            <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-primary">
                                            <th colspan="3" class="text-end">Total</th>
                                            <th class="text-end">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Catatan:</strong> Simpan kode invoice ini untuk melacak status pesanan Anda. 
                        Anda akan dihubungi oleh tim kami untuk konfirmasi dan penjemputan.
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="bi bi-house me-2"></i>Kembali ke Beranda
                        </a>
                        <a href="{{ route('track') }}" class="btn btn-outline-primary">
                            <i class="bi bi-search me-2"></i>Lacak Pesanan
                        </a>
                        <a href="{{ route('order.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle me-2"></i>Pesan Lagi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection