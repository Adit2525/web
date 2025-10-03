<div class="card">
    <div class="card-body">
        <h6 class="text-uppercase text-muted small mb-3">Layanan</h6>
        <ul class="list-unstyled mb-0">
            @foreach(($allServices ?? []) as $s)
                <li class="mb-2">
                    <a class="text-decoration-none {{ isset($service) && $service->id === $s->id ? 'fw-semibold text-primary' : '' }}" href="{{ route('services.show', $s) }}">
                        {{ $s->nama_layanan }}
                    </a>
                </li>
            @endforeach
        </ul>
        <hr class="my-3">
        <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success w-100"><i class="bi bi-whatsapp"></i> Konsultasi</a>
    </div>
 </div>



