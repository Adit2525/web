<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { margin-bottom: 16px; }
        .title { font-size: 18px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background: #f2f2f2; }
        .text-right { text-align: right; }
    </style>
    <title>Invoice {{ $order->kode_invoice }}</title>
 </head>
 <body>
    <div class="header">
        <div class="title">INVOICE {{ $order->kode_invoice }}</div>
        <div>Tanggal: {{ optional($order->tanggal_pesan)->format('d M Y H:i') }}</div>
        <div>Pelanggan: {{ $order->customer->nama }} | {{ $order->customer->no_telepon }}</div>
        <div>Alamat: {{ $order->customer->alamat }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Layanan</th>
                <th>Jumlah</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $d)
                <tr>
                    <td>{{ $d->service->nama_layanan }}</td>
                    <td>{{ $d->jumlah }}</td>
                    <td class="text-right">{{ number_format($d->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-right">Total</th>
                <th class="text-right">{{ number_format($order->total_harga, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
 </body>
 </html>


