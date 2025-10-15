<tr class="detail-row">
    <td>
        <select name="details[{{ $index }}][service_id]" class="form-select" required>
            <option value="">Pilih layanan</option>
            @foreach($services as $s)
                <option value="{{ $s->id }}" 
                    data-price="{{ $s->harga }}" 
                    @selected(($row['service_id'] ?? '') == $s->id)>
                    {{ $s->nama_layanan }} (Rp {{ number_format($s->harga, 0, ',', '.') }}/{{ $s->satuan }})
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="number" name="details[{{ $index }}][jumlah]" 
            class="form-control jumlah-input" 
            min="1" 
            value="{{ $row['jumlah'] ?? 1 }}" 
            required>
    </td>
    <td class="subtotal-cell">
        <span>0</span>
    </td>
    <td class="text-end">
        <button type="button" class="btn btn-sm btn-outline-danger remove-row">
            <i class="bi bi-trash"></i>
        </button>
    </td>
</tr>