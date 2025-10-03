@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama Layanan</label>
        <input type="text" name="nama_layanan" class="form-control @error('nama_layanan') is-invalid @enderror" value="{{ old('nama_layanan', $service->nama_layanan ?? '') }}" required>
        @error('nama_layanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Satuan</label>
        <select name="satuan" class="form-select @error('satuan') is-invalid @enderror" required>
            <option value="kg" {{ old('satuan', $service->satuan ?? '') === 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
            <option value="pcs" {{ old('satuan', $service->satuan ?? '') === 'pcs' ? 'selected' : '' }}>Per Item (pcs)</option>
        </select>
        @error('satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Harga</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" min="0" step="100" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', $service->harga ?? '') }}" required>
            @error('harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $service->deskripsi ?? '') }}</textarea>
        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary" type="submit">
            <i class="bi bi-save"></i> Simpan
        </button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</div>


