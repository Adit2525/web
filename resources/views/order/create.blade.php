@extends('layouts.public')

@section('title', 'Buat Pesanan')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-4">Buat Pesanan</h1>

    <form action="{{ route('order.store') }}" method="POST" id="order-form">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Data Pelanggan</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Tambah Layanan</div>
                    <div class="card-body">
                        <div class="row g-2 align-items-end">
                            <div class="col-8">
                                <label class="form-label">Layanan</label>
                                <select id="service-select" class="form-select">
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" data-price="{{ $service->harga }}" data-unit="{{ $service->satuan }}">{{ $service->nama_layanan }} (Rp {{ number_format($service->harga,0,',','.') }}/{{ $service->satuan }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Jumlah</label>
                                <input type="number" id="qty-input" class="form-control" min="1" value="1">
                            </div>
                            <div class="col-12 d-grid">
                                <button type="button" class="btn btn-primary" id="add-item">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">Ringkasan Pesanan</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Layanan</th>
                                        <th class="text-end">Harga</th>
                                        <th class="text-end">Jumlah</th>
                                        <th class="text-end">Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="items-body"></tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">Total</th>
                                        <th class="text-end" id="total-cell">Rp 0</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div id="items-hidden"></div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg" id="submit-btn" disabled>Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const services = @json($services->map(fn($s) => [
        'id' => $s->id,
        'name' => $s->nama_layanan,
        'price' => (float) $s->harga,
        'unit' => $s->satuan
    ]));

    const items = [];
    const tbody = document.getElementById('items-body');
    const itemsHidden = document.getElementById('items-hidden');
    const totalCell = document.getElementById('total-cell');
    const submitBtn = document.getElementById('submit-btn');

    function formatRupiah(n){
        return 'Rp ' + Math.round(n).toLocaleString('id-ID');
    }

    function render(){
        tbody.innerHTML = '';
        itemsHidden.innerHTML = '';
        let total = 0;
        items.forEach((it, idx) => {
            const subtotal = it.price * it.qty;
            total += subtotal;
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${it.name}</td>
                <td class="text-end">${formatRupiah(it.price)}</td>
                <td class="text-end">${it.qty}</td>
                <td class="text-end">${formatRupiah(subtotal)}</td>
                <td class="text-end"><button type="button" class="btn btn-sm btn-outline-danger" data-rm="${idx}"><i class="bi bi-trash"></i></button></td>
            `;
            tbody.appendChild(tr);

            // hidden inputs
            const sid = document.createElement('input');
            sid.type = 'hidden';
            sid.name = `items[${idx}][service_id]`;
            sid.value = it.id;
            itemsHidden.appendChild(sid);

            const qty = document.createElement('input');
            qty.type = 'hidden';
            qty.name = `items[${idx}][jumlah]`;
            qty.value = it.qty;
            itemsHidden.appendChild(qty);
        });

        totalCell.textContent = formatRupiah(total);
        submitBtn.disabled = items.length === 0;

        tbody.querySelectorAll('[data-rm]')
            .forEach(btn => btn.addEventListener('click', () => {
                items.splice(parseInt(btn.getAttribute('data-rm')), 1);
                render();
            }));
    }

    document.getElementById('add-item').addEventListener('click', () => {
        const select = document.getElementById('service-select');
        const qtyInput = document.getElementById('qty-input');
        const qty = parseInt(qtyInput.value || '1');
        const selectedService = services.find(s => s.id == select.value);

        if (!selectedService) return;

        const existingItem = items.find(item => item.id === selectedService.id);

        if (existingItem) {
            existingItem.qty += qty;
        } else {
            items.push({
                id: selectedService.id,
                name: selectedService.name,
                price: selectedService.price,
                qty: qty,
            });
        }

        qtyInput.value = '1';
        render();
    });
</script>
@endpush
@endsection


