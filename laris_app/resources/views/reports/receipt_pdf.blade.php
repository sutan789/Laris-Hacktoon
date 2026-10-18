<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran #{{ $order->order_number }}</title>
    <style>
        @page {
            margin: 8px;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #0F172A;
            line-height: 1.35;
            background: #FFFFFF;
            margin: 0;
            padding: 10px;
        }
        .header {
            text-align: center;
            border-bottom: 1px dashed #94A3B8;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }
        .store-name {
            font-size: 14px;
            font-weight: 800;
            text-transform: uppercase;
            margin: 0;
            color: #0F172A;
        }
        .store-info {
            font-size: 10px;
            color: #475569;
            margin-top: 2px;
        }
        .meta-row {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: #475569;
            margin-bottom: 3px;
        }
        .divider {
            border-top: 1px dashed #CBD5E1;
            margin: 6px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10.5px;
        }
        table th {
            text-align: left;
            padding: 4px 0;
            border-bottom: 1px solid #E2E8F0;
            color: #475569;
            font-size: 9.5px;
            text-transform: uppercase;
        }
        table td {
            padding: 4px 0;
            vertical-align: top;
        }
        .text-right {
            text-align: right;
        }
        .totals-table {
            width: 100%;
            margin-top: 4px;
        }
        .totals-table td {
            padding: 2px 0;
        }
        .grand-total {
            font-size: 13px;
            font-weight: 800;
            border-top: 1px solid #0F172A;
            border-bottom: 1px solid #0F172A;
            padding: 4px 0;
        }
        .footer {
            text-align: center;
            margin-top: 12px;
            padding-top: 8px;
            border-top: 1px dashed #94A3B8;
            font-size: 10px;
            color: #64748B;
        }
        .footer-note {
            font-weight: 700;
            color: #0F172A;
            margin-bottom: 3px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1 class="store-name">{{ $store->name ?? 'TOKO BERKAH UTAMA' }}</h1>
        <div class="store-info">{{ $store->address ?? ($store->location ?? 'Jl. Braga No. 45, Bandung') }}</div>
        <div class="store-info">Telp/WA: {{ $store->phone ?? '0812-3456-7890' }}</div>
    </div>

    <table style="margin-bottom: 6px;">
        <tr>
            <td style="color: #64748B;">No. Struk:</td>
            <td class="text-right"><strong>#{{ $order->order_number }}</strong></td>
        </tr>
        <tr>
            <td style="color: #64748B;">Waktu:</td>
            <td class="text-right">{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : now()->format('d/m/Y H:i') }} WIB</td>
        </tr>
        <tr>
            <td style="color: #64748B;">Kasir:</td>
            <td class="text-right">{{ auth()->user()->name ?? 'Rian Kasir' }}</td>
        </tr>
        <tr>
            <td style="color: #64748B;">Kanal:</td>
            <td class="text-right">{{ $order->channel ?? 'Kasir Smart POS' }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <table>
        <thead>
            <tr>
                <th>Item Produk</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product->name ?? 'Produk' }}</strong>
                        @if($item->product && $item->product->sku)
                            <div style="font-size: 9px; color: #94A3B8;">SKU: {{ $item->product->sku }}</div>
                        @endif
                    </td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($item->unit_price ?: ($item->price ?? 0), 0, ',', '.') }}</td>
                    <td class="text-right"><strong>Rp {{ number_format($item->subtotal ?: ($item->quantity * ($item->unit_price ?: $item->price)), 0, ',', '.') }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="divider"></div>

    <table class="totals-table">
        <tr>
            <td>Total Tagihan</td>
            <td class="text-right"><strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td>Metode Bayar</td>
            <td class="text-right">{{ strtoupper($order->payment_method ?? 'TUNAI') }}</td>
        </tr>
        @if(!empty($order->notes) && str_contains($order->notes, 'Bayar:'))
            <tr>
                <td>Jumlah Uang</td>
                <td class="text-right">{{ $order->notes }}</td>
            </tr>
        @endif
        <tr class="grand-total">
            <td>TOTAL LUNAS</td>
            <td class="text-right">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        <div class="footer-note">{{ $store->receipt_footer_note ?? 'Terima Kasih Telah Berbelanja di UMKM Lokal!' }}</div>
        <div>Barang yang sudah dibeli tidak dapat ditukar kecuali ada perjanjian.</div>
        <div style="margin-top: 4px; font-size: 9px; color: #94A3B8;">Struk resmi diproses otomatis oleh LARIS Smart POS Platform</div>
    </div>

</body>
</html>
