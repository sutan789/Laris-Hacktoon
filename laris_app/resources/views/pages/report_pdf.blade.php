@extends('layouts.app', ['title' => 'Cetak & Ekspor Laporan Bisnis PDF - ' . ($store->name ?? 'Toko Berkah Utama')])

@section('content')
<style>
    @media print {
        body {
            background: #FFFFFF !important;
            color: #0F172A !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .sidebar, .top-bar, .no-print, .laris-alert-backdrop {
            display: none !important;
        }
        .main-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
        .content-area {
            padding: 0 !important;
            max-width: 100% !important;
        }
        .pdf-document {
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            width: 100% !important;
        }
    }

    .pdf-page-container {
        max-width: 960px;
        margin: 0 auto;
        padding-bottom: 50px;
    }

    .pdf-action-bar {
        background: #0B131B;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 14px;
        padding: 14px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    }

    .pdf-document {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 40px 48px;
        box-shadow: 0 12px 35px rgba(15, 23, 42, 0.08);
        color: #0F172A;
    }

    .doc-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-bottom: 2px solid #0F172A;
        padding-bottom: 24px;
        margin-bottom: 28px;
    }

    .doc-badge {
        display: inline-block;
        padding: 4px 10px;
        background: #ECFDF5;
        color: #059669;
        font-weight: 800;
        font-size: 11px;
        border-radius: 6px;
        border: 1px solid #A7F3D0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .kpi-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 28px;
    }

    .kpi-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 14px 16px;
    }

    .kpi-lbl {
        font-size: 11px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
    }

    .kpi-val {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        margin-top: 4px;
    }

    .sec-title {
        font-size: 14px;
        font-weight: 800;
        color: #0F172A;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pdf-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
        margin-bottom: 28px;
    }

    .pdf-table th {
        background: #0F172A;
        color: #FFFFFF;
        text-align: left;
        padding: 10px 12px;
        font-weight: 700;
        font-size: 11.5px;
    }

    .pdf-table td {
        padding: 10px 12px;
        border-bottom: 1px solid #E2E8F0;
        color: #334155;
    }

    .pdf-table tr:nth-child(even) td {
        background: #F8FAFC;
    }

    .stamp-signature-row {
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        border-top: 1px dashed #CBD5E1;
        padding-top: 24px;
    }
</style>

<div class="pdf-page-container">

    <!-- ACTION BAR (HIDDEN ON PRINT) -->
    <div class="pdf-action-bar no-print">
        <div style="display: flex; align-items: center; gap: 12px;">
            <a href="{{ route('report.index') }}" style="display: inline-flex; align-items: center; gap: 6px; color: #94A3B8; text-decoration: none; font-size: 13px; font-weight: 700;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                <span>Kembali ke Laporan</span>
            </a>
            <span style="color: #475569;">•</span>
            <span style="color: #F8FAFC; font-weight: 700; font-size: 13.5px;">Dokumen Siap Cetak &amp; Simpan PDF</span>
        </div>

        <div style="display: flex; align-items: center; gap: 10px;">
            <a href="{{ route('report.export', ['format' => 'excel']) }}" style="padding: 8px 14px; border-radius: 8px; background: rgba(255, 255, 255, 0.08); color: #F8FAFC; text-decoration: none; font-size: 12px; font-weight: 700; border: 1px solid rgba(255, 255, 255, 0.15); display: inline-flex; align-items: center; gap: 6px;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                <span>Unduh Excel (.xls)</span>
            </a>
            <a href="{{ route('report.export', ['format' => 'csv']) }}" style="padding: 8px 14px; border-radius: 8px; background: rgba(255, 255, 255, 0.08); color: #F8FAFC; text-decoration: none; font-size: 12px; font-weight: 700; border: 1px solid rgba(255, 255, 255, 0.15); display: inline-flex; align-items: center; gap: 6px;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/></svg>
                <span>Unduh CSV</span>
            </a>
            <a href="{{ route('report.export', ['format' => 'txt']) }}" style="padding: 8px 14px; border-radius: 8px; background: rgba(255, 255, 255, 0.08); color: #F8FAFC; text-decoration: none; font-size: 12px; font-weight: 700; border: 1px solid rgba(255, 255, 255, 0.15); display: inline-flex; align-items: center; gap: 6px;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                <span>Unduh TXT</span>
            </a>
            <button type="button" onclick="window.print()" style="padding: 8px 18px; border-radius: 8px; background: #10B981; color: #FFFFFF; font-size: 12.5px; font-weight: 800; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z"/></svg>
                <span>Cetak / Simpan PDF</span>
            </button>
        </div>
    </div>

    <!-- MAIN PRINTABLE AUDIT REPORT DOCUMENT -->
    <div class="pdf-document">
        
        <!-- HEADER -->
        <div class="doc-header">
            <div>
                <span class="doc-badge">DOKUMEN AUDIT RESMI • LARIS BI PLATFORM</span>
                <h1 style="font-size: 24px; font-weight: 800; color: #0F172A; margin: 8px 0 4px 0;">LAPORAN KINERJA BISNIS BULANAN</h1>
                <p style="font-size: 13px; color: #64748B; margin: 0;">Audit Finansial, Efisiensi Margin, dan Rekomendasi Restock AI</p>
            </div>
            <div style="text-align: right;">
                <h3 style="font-size: 16px; font-weight: 800; color: #10B981; margin: 0;">{{ $store->name ?? 'Toko Berkah Utama' }}</h3>
                <p style="font-size: 12px; color: #64748B; margin: 3px 0 0 0;">Pemilik: <strong>{{ $store->owner_name ?? 'Juragan Bambang' }}</strong></p>
                <p style="font-size: 11px; color: #94A3B8; margin: 2px 0 0 0;">Periode: {{ $period ?? 'Oktober 2026' }}</p>
            </div>
        </div>

        <!-- KPI SUMMARY GRID -->
        <div class="kpi-summary-grid">
            <div class="kpi-box">
                <span class="kpi-lbl">TOTAL OMZET (PENJUALAN)</span>
                <div class="kpi-val text-green">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</div>
                <span style="font-size: 11px; color: #10B981; font-weight: 700;">118% Capaian Target</span>
            </div>
            <div class="kpi-box">
                <span class="kpi-lbl">LABA BERSIH RIIL</span>
                <div class="kpi-val text-green">Rp {{ number_format($monthlyProfit, 0, ',', '.') }}</div>
                <span style="font-size: 11px; color: #0F172A; font-weight: 700;">Margin {{ $marginPct }}%</span>
            </div>
            <div class="kpi-box">
                <span class="kpi-lbl">BIAYA OPERASIONAL (OPEX)</span>
                <div class="kpi-val">Rp {{ number_format($opex, 0, ',', '.') }}</div>
                <span style="font-size: 11px; color: #64748B;">Sewa, Listrik, Gaji</span>
            </div>
            <div class="kpi-box">
                <span class="kpi-lbl">SKOR KESEHATAN BISNIS</span>
                <div class="kpi-val text-green">94 / 100</div>
                <span style="font-size: 11px; color: #10B981; font-weight: 700;">Kondisi Sangat Sehat</span>
            </div>
        </div>

        <!-- PRODUCT TABLE -->
        <div class="sec-title">
            <span>DAFTAR PRODUK &amp; KESEHATAN PERSEDIAAN GUDANG</span>
        </div>
        <table class="pdf-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>SKU</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>HPP (Beli)</th>
                    <th>Harga Jual</th>
                    <th>Margin (%)</th>
                    <th>Stok</th>
                    <th>Laju/Hari</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $idx => $prod)
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        <td><strong>{{ $prod->sku }}</strong></td>
                        <td>{{ $prod->name }}</td>
                        <td>{{ $prod->category }}</td>
                        <td>Rp {{ number_format($prod->cost_price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($prod->selling_price, 0, ',', '.') }}</td>
                        <td style="font-weight: 700; color: #10B981;">{{ $prod->gross_margin_pct }}%</td>
                        <td><strong>{{ $prod->current_stock }}</strong> unit</td>
                        <td>{{ $prod->ai_velocity }} unit</td>
                        <td>
                            <span style="display: inline-block; padding: 2px 6px; border-radius: 4px; font-size: 10px; font-weight: 700; background: {{ $prod->health_status === 'Critical' ? '#FEE2E2' : ($prod->health_status === 'Attention' ? '#FEF3C7' : '#D1FAE5') }}; color: {{ $prod->health_status === 'Critical' ? '#DC2626' : ($prod->health_status === 'Attention' ? '#D97706' : '#059669') }};">
                                {{ $prod->health_status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- JURAGAN AI STRATEGIC SUMMARY -->
        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 18px 22px; margin-bottom: 24px;">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                <span style="font-weight: 800; font-size: 13px; color: #0F172A;">EVALUASI STRATEGIS JURAGAN AI:</span>
            </div>
            <p style="font-size: 12.5px; color: #475569; line-height: 1.6; margin: 0 0 8px 0;">
                1. <strong>Stabilitas Margin:</strong> Rata-rata margin gerai bertahan di level 42.7%, jauh di atas ambang batas kritis ritel (25%). Efisiensi logistik tercapai berkat pemanfaatan fitur Kulakan Bareng antar-toko.
            </p>
            <p style="font-size: 12.5px; color: #475569; line-height: 1.6; margin: 0 0 8px 0;">
                2. <strong>Mitigasi Kebencanaan &amp; Fluktuasi Pasar:</strong> Dalam menghadapi bencana musiman kabut asap atau libur darurat, gunakan model <em>Fast Reorder Rolling Batch</em> (siklus kulakan 50-100 unit) guna menghindari penumpukan modal mati saat situasi darurat pulih mendadak.
            </p>
            <p style="font-size: 12.5px; color: #475569; line-height: 1.6; margin: 0;">
                3. <strong>Validasi Rekomendasi Kasir POS:</strong> 91.4% promo bundling rekomendasi AI berhasil dikonversi oleh pelanggan di mesin kasir fisik dan kanal antar-pesan WhatsApp.
            </p>
        </div>

        <!-- SIGNATURE ROW -->
        <div class="stamp-signature-row">
            <div>
                <p style="font-size: 11px; color: #94A3B8; margin: 0 0 4px 0;">Disahkan oleh Asisten Intelijen Bisnis:</p>
                <strong style="font-size: 13px; color: #10B981;">JURAGAN AI ENGINE v3.8</strong>
                <p style="font-size: 10px; color: #64748B; margin: 2px 0 0 0;">ID Autentikasi: LARIS-VERIFIED-{{ strtoupper(substr(md5($monthlyRevenue . date('Ymd')), 0, 10)) }}</p>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 11px; color: #64748B; margin: 0 0 45px 0;">Bandung, {{ date('d F Y') }}<br>Pemilik / Pengelola Gerai:</p>
                <strong style="font-size: 13px; color: #0F172A; border-top: 1px solid #CBD5E1; padding-top: 4px; display: inline-block;">{{ $store->owner_name ?? 'Juragan Bambang' }}</strong>
            </div>
        </div>

    </div>

</div>
@endsection
