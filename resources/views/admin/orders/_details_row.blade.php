<tr class="detail-row">
    <td>
        <select name="details[{{ $index }}][service_id]" class="form-select" required>
            <option value="">Pilih layanan</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}" data-price="{{ $service->harga }}" @selected(old("details.$index.service_id", $row['service_id'] ?? null) == $service->id)>
                    {{ $service->nama_layanan }} (Rp {{ number_format($service->harga,0,',','.') }}/{{ $service->satuan }})
                </option>
            @endforeach
        </select>
    </td>
    <td style="width:140px">
        <input type="number" name="details[{{ $index }}][jumlah]" class="form-control jumlah-input" min="1" value="{{ old("details.$index.jumlah", $row['jumlah'] ?? 1) }}" required>
    </td>
    <td class="subtotal-cell" style="width:180px">Rp <span>0</span></td>
    <td class="text-end" style="width:60px">
        <button type="button" class="btn btn-outline-danger btn-sm remove-row"><i class="bi bi-x"></i></button>
    </td>
</tr>


