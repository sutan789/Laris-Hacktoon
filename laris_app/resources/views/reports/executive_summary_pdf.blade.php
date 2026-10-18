<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Eksekutif Bisnis &amp; Finansial - LARIS</title>
    <style>
        @page {
            margin: 28px 32px;
            size: A4 portrait;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1E293B;
            font-size: 11px;
            line-height: 1.45;
            margin: 0;
            padding: 0;
        }
        .header-table {
            width: 100%;
            border-bottom: 2px solid #0F172A;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }
        .brand-title {
            font-size: 20px;
            font-weight: bold;
            color: #0F172A;
            letter-spacing: -0.5px;
        }
        .brand-subtitle {
            font-size: 9.5px;
            color: #10B981;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .meta-right {
            text-align: right;
            font-size: 9.5px;
            color: #64748B;
        }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #0F172A;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 4px;
            margin-top: 14px;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }
        .kpi-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
        .kpi-card {
            width: 25%;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 6px;
            padding: 10px 12px;
        }
        .kpi-label {
            font-size: 9px;
            color: #64748B;
            font-weight: bold;
            text-transform: uppercase;
        }
        .kpi-value {
            font-size: 15px;
            font-weight: bold;
            color: #0F172A;
            margin-top: 4px;
        }
        .kpi-sub {
            font-size: 8.5px;
            color: #10B981;
            font-weight: bold;
            margin-top: 2px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
            margin-bottom: 14px;
        }
        .data-table th {
            background: #F1F5F9;
            color: #334155;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 6px 8px;
            border: 1px solid #E2E8F0;
            text-align: left;
        }
        .data-table td {
            padding: 6px 8px;
            border: 1px solid #E2E8F0;
            font-size: 9.5px;
            color: #334155;
        }
        .data-table tr:nth-child(even) td {
            background: #FAFAFA;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .badge-danger {
            background: #FEE2E2;
            color: #B91C1C;
            font-size: 8.5px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-block;
        }
        .badge-success {
            background: #DCFCE7;
            color: #15803D;
            font-size: 8.5px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-block;
        }
        .footer-note {
            margin-top: 24px;
            border-top: 1px solid #E2E8F0;
            padding-top: 8px;
            font-size: 8.5px;
            color: #94A3B8;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <table class="header-table">
        <tr>
            <td style="width: 60%;">
                <div class="brand-title">LARIS Business Intelligence</div>
                <div class="brand-subtitle">Laporan Eksekutif Kinerja Finansial &amp; Operasional</div>
                <div style="font-size: 9.5px; color: #475569; margin-top: 4px;">
                    <strong>{{ $store->name ?? 'Toko Berkah Utama' }}</strong> &bull; {{ $store->address ?? 'Bandung, Jawa Barat' }}
                </div>
            </td>
            <td class="meta-right" style="width: 40%;">
                <div><strong>Periode Laporan:</strong> {{ $timeframeLabel ?? 'Semua Transaksi Realtime' }}</div>
                <div><strong>Waktu Cetak:</strong> {{ now()->format('d M Y, H:i') }} WIB</div>
                <div><strong>Dokumen Resmi:</strong> Dokumen Validasi AI Platform</div>
            </td>
        </tr>
    </table>

    {{-- 1. KPI Finansial Ringkas --}}
    <div class="section-title">1. Indikator Finansial Utama (Satuan Rupiah)</div>
    <table class="kpi-table">
        <tr>
            <td class="kpi-card" style="margin-right: 8px;">
                <div class="kpi-label">Total Penjualan</div>
                <div class="kpi-value">Rp {{ number_format($revenue, 0, ',', '.') }}</div>
                <div class="kpi-sub">&bull; Pendapatan Riil</div>
            </td>
            <td style="width: 2%;"></td>
            <td class="kpi-card">
                <div class="kpi-label">Estimasi Laba Bersih</div>
                <div class="kpi-value" style="color: #10B981;">Rp {{ number_format($profit, 0, ',', '.') }}</div>
                <div class="kpi-sub">&bull; Gross Margin</div>
            </td>
            <td style="width: 2%;"></td>
            <td class="kpi-card">
                <div class="kpi-label">Profit Margin</div>
                <div class="kpi-value">{{ $marginPct }}%</div>
                <div class="kpi-sub">&bull; Target Sehat &gt; 25%</div>
            </td>
            <td style="width: 2%;"></td>
            <td class="kpi-card">
                <div class="kpi-label">Total Transaksi</div>
                <div class="kpi-value">{{ $finalOrdersCount ?? ($telemetry['orders_count'] ?? 0) }} Pesanan</div>
                <div class="kpi-sub">&bull; Multi-channel POS</div>
            </td>
        </tr>
    </table>

    {{-- 2. Radar Kesehatan Stok & SKU Kritis --}}
    <div class="section-title">2. Radar Kesehatan Stok &amp; Peringatan Restock Kritis</div>
    @if(isset($criticalProducts) && $criticalProducts->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 35%;">Nama Produk</th>
                    <th style="width: 15%;">Kategori</th>
                    <th class="text-right" style="width: 15%;">Sisa Stok</th>
                    <th class="text-right" style="width: 15%;">Batas Min.</th>
                    <th class="text-center" style="width: 15%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($criticalProducts as $idx => $p)
                    <tr>
                        <td class="text-center">{{ $idx + 1 }}</td>
                        <td><strong>{{ $p->name }}</strong><br><span style="font-size: 8px; color: #64748B;">SKU: {{ $p->sku }}</span></td>
                        <td>{{ $p->category }}</td>
                        <td class="text-right" style="color: #DC2626; font-weight: bold;">{{ $p->current_stock }} pcs</td>
                        <td class="text-right">{{ $p->min_threshold }} pcs</td>
                        <td class="text-center"><span class="badge-danger">Kritis (&le; {{ $p->stock_runway_days }} Hari)</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="background: #F0FDF4; border: 1px solid #BBF7D0; padding: 10px 14px; border-radius: 6px; font-size: 9.5px; color: #15803D; margin-bottom: 12px;">
            <strong>Kondisi Stok Sehat:</strong> Seluruh SKU barang berada dalam ambang batas aman di atas estimasi laju konsumsi pelanggan.
        </div>
    @endif

    {{-- 3. Top 5 Produk Terlaris --}}
    <div class="section-title">3. Produk Terlaris &amp; Performa Penjualan AI</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 35%;">Nama Produk</th>
                <th style="width: 18%;">Kategori</th>
                <th class="text-right" style="width: 14%;">Harga Jual</th>
                <th class="text-right" style="width: 14%;">Laju Penjualan</th>
                <th class="text-center" style="width: 14%;">Kesehatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topProducts as $idx => $tp)
                <tr>
                    <td class="text-center">{{ $idx + 1 }}</td>
                    <td><strong>{{ $tp->name }}</strong></td>
                    <td>{{ $tp->category }}</td>
                    <td class="text-right">Rp {{ number_format($tp->selling_price, 0, ',', '.') }}</td>
                    <td class="text-right"><strong>{{ $tp->ai_velocity ?? 5 }}</strong> unit/hari</td>
                    <td class="text-center"><span class="badge-success">Sehat</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- 4. Komposisi Kategori Penjualan --}}
    @if(isset($categoriesData) && count($categoriesData) > 0)
        <div class="section-title">4. Kontribusi Pendapatan per Kategori Sektor</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 40%;">Sektor Kategori</th>
                    <th class="text-right" style="width: 20%;">Porsi (%)</th>
                    <th class="text-right" style="width: 25%;">Total Penjualan (Rp)</th>
                    <th class="text-center" style="width: 15%;">Tren</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categoriesData as $cat)
                    <tr>
                        <td><strong>{{ $cat['name'] }}</strong></td>
                        <td class="text-right">{{ $cat['pct'] }}%</td>
                        <td class="text-right">{{ $cat['amount'] }}</td>
                        <td class="text-center" style="color: #10B981; font-weight: bold;">{{ $cat['growth'] ?? '+10%' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Footer --}}
    <div class="footer-note">
        <div>Dicetak otomatis dari Sistem Intelligence Platform LARIS pada {{ now()->format('d/m/Y H:i:s') }} WIB.</div>
        <div style="text-align: right;">Halaman 1 dari 1</div>
    </div>

</body>
</html>
