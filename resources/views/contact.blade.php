@extends('layouts.public')

@section('title', 'Kontak')

@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="h3 mb-4">Kontak Kami</h1>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row g-4">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('contact.submit') }}" class="card">
                        <div class="card-body">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pesan</label>
                                <textarea name="pesan" rows="5" class="form-control @error('pesan') is-invalid @enderror" required>{{ old('pesan') }}</textarea>
                                @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <button class="btn btn-primary" type="submit">Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="mb-2">Informasi Kontak</h5>
                            <div class="mb-2"><i class="bi bi-geo-alt"></i> Jl. Contoh No. 123, Jakarta</div>
                            <div class="mb-2"><i class="bi bi-telephone"></i> 0812-3456-7890</div>
                            <div class="mb-3"><i class="bi bi-envelope"></i> info@laundrypro.id</div>
                            <a class="btn btn-success" href="https://wa.me/6281234567890" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                            <div class="mt-3 ratio ratio-16x9">
                                <iframe src="https://www.google.com/maps?q=jakarta&output=embed" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


