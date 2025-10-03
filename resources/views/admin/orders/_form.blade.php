@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Pelanggan</label>
        <select name="customer_id" class="form-select @error('customer_id') is-invalid @enderror" required>
            <option value="">Pilih pelanggan</option>
            @foreach($customers as $c)
                <option value="{{ $c->id }}" @selected(old('customer_id', $order->customer_id ?? null) == $c->id)>{{ $c->nama }} - {{ $c->no_telepon }}</option>
            @endforeach
        </select>
        @error('customer_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            @foreach($statuses as $s)
                <option value="{{ $s }}" @selected(old('status', $order->status ?? $s) == $s)>{{ $s }}</option>
            @endforeach
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Pesan</label>
        <input type="datetime-local" name="tanggal_pesan" class="form-control @error('tanggal_pesan') is-invalid @enderror" value="{{ old('tanggal_pesan', optional($order->tanggal_pesan ?? null)->format('Y-m-d\TH:i')) }}">
        @error('tanggal_pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Target Selesai</label>
        <input type="datetime-local" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai', optional($order->tanggal_selesai ?? null)->format('Y-m-d\TH:i')) }}">
        @error('tanggal_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Detail Layanan</label>
        <div class="table-responsive">
            <table class="table align-middle" id="details-table">
                <thead>
                    <tr>
                        <th>Layanan</th>
                        <th style="width:140px">Jumlah</th>
                        <th style="width:180px">Subtotal</th>
                        <th style="width:60px" class="text-end"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $oldDetails = old('details', isset($order) ? $order->details->map(fn($d) => ['service_id' => $d->service_id, 'jumlah' => $d->jumlah])->toArray() : [[ ]]);
                    @endphp
                    @foreach($oldDetails as $index => $row)
                        @include('admin.orders._details_row', ['index' => $index, 'row' => $row])
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-end">Total</th>
                        <th id="total-cell">Rp <span>0</span></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <button type="button" class="btn btn-outline-secondary" id="add-row"><i class="bi bi-plus-lg"></i> Tambah Baris</button>
    </div>
    <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> Simpan</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const services = @json($services->map(fn($s) => ['id' => $s->id, 'harga' => (float)$s->harga]));
    const tbody = document.querySelector('#details-table tbody');
    const addBtn = document.getElementById('add-row');

    function recalc() {
        let total = 0;
        tbody.querySelectorAll('tr.detail-row').forEach(function(tr){
            const select = tr.querySelector('select');
            const jumlah = parseInt(tr.querySelector('.jumlah-input').value || '0', 10);
            const harga = parseFloat(select.options[select.selectedIndex]?.getAttribute('data-price') || '0');
            const subtotal = harga * jumlah;
            tr.querySelector('.subtotal-cell span').textContent = new Intl.NumberFormat('id-ID').format(subtotal);
            total += subtotal;
        });
        document.querySelector('#total-cell span').textContent = new Intl.NumberFormat('id-ID').format(total);
    }

    function bindRow(tr) {
        tr.querySelectorAll('select, .jumlah-input').forEach(function(el){
            el.addEventListener('change', recalc);
            el.addEventListener('keyup', recalc);
        });
        tr.querySelector('.remove-row').addEventListener('click', function(){
            if (tbody.querySelectorAll('tr.detail-row').length > 1) {
                tr.remove();
                recalc();
            }
        });
    }

    tbody.querySelectorAll('tr.detail-row').forEach(bindRow);
    recalc();

    addBtn.addEventListener('click', function(){
        const index = tbody.querySelectorAll('tr.detail-row').length;
        const template = `@php $idx='__INDEX__'; @endphp @include('admin.orders._details_row', ['index' => $idx, 'row' => []])`;
        const html = template.replaceAll('__INDEX__', index);
        const tmp = document.createElement('tbody');
        tmp.innerHTML = html.trim();
        const tr = tmp.querySelector('tr');
        tbody.appendChild(tr);
        bindRow(tr);
        recalc();
    });
});
</script>
@endpush


