@extends('layouts.public')

@section('title', 'Jasa Laundry Profesional Terpercaya')

@section('content')
    <section class="hero py-5 py-lg-6 text-white">
        <div class="hero-overlay py-5">
            <div class="container py-4">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <h1 class="display-5 fw-bold">Jasa Laundry Profesional Terpercaya</h1>
                        <p class="lead"> proses cepat, higienis, dan wangi premium.</p>
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="#lacak" class="btn btn-light text-primary"><i class="bi bi-search"></i> Lacak Pesanan</a>
                            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="keunggulan">
        <div class="container">
            <h2 class="section-title h3 mb-4">Mengapa Memilih Kami</h2>
            <div class="row g-4">
               
                <div class="col-md-3">
                    <div class="d-flex align-items-start gap-3">
                        <div class="feature-icon"><i class="bi bi-lightning-charge"></i></div>
                        <div>
                            <div class="fw-semibold">Proses Cepat</div>
                            <div class="text-muted small">Layanan express untuk kebutuhan mendesak Anda.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-start gap-3">
                        <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                        <div>
                            <div class="fw-semibold">Higienis</div>
                            <div class="text-muted small">Standar kebersihan tinggi untuk kenyamanan keluarga.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-start gap-3">
                        <div class="feature-icon"><i class="bi bi-stars"></i></div>
                        <div>
                            <div class="fw-semibold">Pewangi Premium</div>
                            <div class="text-muted small">Aroma segar tahan lama pilihan pelanggan.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light" id="layanan">
        <div class="container">
            <h2 class="section-title h3 mb-4">Layanan & Harga</h2>
            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-md-3">
                        <div class="card service-card h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $service->nama_layanan }}</h5>
                                <div class="text-muted small mb-2">{{ $service->deskripsi }}</div>
                                <div class="mt-auto">
                                    <div class="fw-semibold">Mulai dari</div>
                                    <div class="h5 mb-3">Rp {{ number_format($service->harga, 0, ',', '.') }} / {{ $service->satuan }}</div>
                                    <a href="#" class="btn btn-outline-primary w-100">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5" id="proses">
        <div class="container">
            <h2 class="section-title h3 mb-4">Cara Pemesanan</h2>
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="feature-icon mx-auto mb-2"><i class="bi bi-phone"></i></div>
                    <div class="fw-semibold">Pesan</div>
                    <div class="text-muted small">Hubungi kami via WhatsApp.</div>
                </div>
                <div class="col-md-3">
                    <div class="feature-icon mx-auto mb-2"><i class="bi bi-bag-check"></i></div>
                    <div class="fw-semibold">Kami Jemput</div>
                    <div class="text-muted small">Kurir menjemput cucian Anda.</div>
                </div>
                <div class="col-md-3">
                    <div class="feature-icon mx-auto mb-2"><i class="bi bi-droplet"></i></div>
                    <div class="fw-semibold">Proses Cuci</div>
                    <div class="text-muted small">Pencucian profesional dan higienis.</div>
                </div>
                <div class="col-md-3">
                    <div class="feature-icon mx-auto mb-2"><i class="bi bi-house-door"></i></div>
                    <div class="fw-semibold">Kami Antar</div>
                    <div class="text-muted small">Diantar kembali tepat waktu.</div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light" id="testimoni">
        <div class="container">
            <h2 class="section-title h3 mb-4">Testimoni Pelanggan</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-2">"Cepat dan wangi! Pasti langganan."</div>
                            <div class="small text-muted">— Rina, Jakarta</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-2">"Antar-jemputnya membantu banget, recommended."</div>
                            <div class="small text-muted">— Dimas, Tangerang</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-2">"Hasil rapi, pakaian jadi segar sekali."</div>
                            <div class="small text-muted">— Sari, Depok</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="lacak">
        <div class="container">
            <h2 class="section-title h3 mb-3">Lacak Pesanan</h2>
            <form class="row g-2" method="GET" action="#">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="kode_invoice" placeholder="Masukkan kode invoice (contoh: INV-20251003-0001)">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100" type="submit"><i class="bi bi-search"></i> Lacak</button>
                </div>
            </form>
        </div>
    </section>
@endsection


