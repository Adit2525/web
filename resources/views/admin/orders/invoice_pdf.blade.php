<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->kode_invoice }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; color: #333; }
        .header p { margin: 5px 0; color: #666; }
        .invoice-info { margin-bottom: 20px; }
        .invoice-info table { width: 100%; }
        .invoice-info td { padding: 5px 0; }
        .customer-info { margin-bottom: 20px; }
        .customer-info h3 { margin: 0 0 10px 0; color: #333; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .items-table th, .items-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .items-table th { background-color: #f5f5f5; font-weight: bold; }
        .items-table .text-right { text-align: right; }
        .total-section { margin-top: 20px; }
        .total-row { display: flex; justify-content: space-between; padding: 5px 0; }
        .total-row.total { font-weight: bold; font-size: 14px; border-top: 2px solid #333; padding-top: 10px; }
        .footer { margin-top: 40px; text-align: center; color: #666; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAUNDRY ATUN</h1>
        <p>Jasa Laundry Profesional</p>
        <p>Jl. Contoh No. 123, Jakarta | Telp: 0812-3456-7890</p>
    </div>

    <div class="invoice-info">
        <table>
            <tr>
                <td><strong>Invoice:</strong> {{ $order->kode_invoice }}</td>
                <td><strong>Tanggal:</strong> {{ $order->tanggal_pesan->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td><strong>Status:</strong> {{ $order->status }}</td>
                @if($order->tanggal_selesai)
                <td><strong>Selesai:</strong> {{ $order->tanggal_selesai->format('d/m/Y H:i') }}</td>
                @endif
            </tr>
        </table>
    </div>

    <div class="customer-info">
        <h3>Data Pelanggan</h3>
        <p><strong>Nama:</strong> {{ $order->customer->nama }}</p>
        <p><strong>Telepon:</strong> {{ $order->customer->no_telepon }}</p>
        <p><strong>Alamat:</strong> {{ $order->customer->alamat }}</p>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Layanan</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $detail)
            <tr>
                <td>{{ $detail->service->nama_layanan }}</td>
                <td class="text-right">Rp {{ number_format($detail->service->harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ $detail->jumlah }}</td>
                <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row total">
            <span>TOTAL</span>
            <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        <p>Terima kasih telah mempercayai layanan laundry kami!</p>
        <p>Invoice ini dicetak pada {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>