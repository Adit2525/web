<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laundry Profesional')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary:#0d6efd; }
        body { font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Liberation Sans', sans-serif; }
        .navbar-brand { font-weight:600; letter-spacing:.2px; }
        .hero { background: linear-gradient(0deg, rgba(13,110,253,.05), rgba(13,110,253,.05)), url('https://images.unsplash.com/photo-1581578731548-c64695cc6952?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat; }
        .hero-overlay { backdrop-filter: blur(1px); }
        .section-title { font-weight:700; letter-spacing:.3px; }
        .feature-icon { width:48px; height:48px; display:inline-flex; align-items:center; justify-content:center; border-radius:10px; background:#e7f1ff; color:#0d6efd; }
        .service-card { transition: transform .2s ease, box-shadow .2s ease; }
        .service-card:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(0,0,0,.08); }
        .footer a { color: inherit; text-decoration: none; }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand text-primary" href="/">LaundryPro</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#proses">Cara Pesan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#testimoni">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('track') }}">Lacak</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Kontak</a></li>
                    <li class="nav-item"><a class="btn btn-primary" href="{{ route('login') }}" target="_blank"><i class="bi bi-login"></i> login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer py-5 border-top mt-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="text-primary fw-bold mb-2">LaundryPro</h5>
                    <p class="text-muted mb-1">Jasa laundry profesional: cepat, higienis, wangi tahan lama.</p>
                    <div class="small text-muted">Jl. Contoh No. 123, Jakarta | 0812-3456-7890</div>
                </div>
                <div class="col-md-6 text-md-end">
                    <a class="me-3" href="#layanan">Layanan</a>
                    <a class="me-3" href="#proses">Proses</a>
                    <a class="me-3" href="#testimoni">Testimoni</a>
                    <a href="mailto:info@laundrypro.id">info@laundrypro.id</a>
                </div>
            </div>
            <div class="mt-3 small text-muted">© {{ date('Y') }} LaundryPro. All rights reserved.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>


