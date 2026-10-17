@extends('layouts.app', ['title' => 'Dashboard Staf Gudang & Logistik - LARIS'])

@push('styles')
<style>
    .wh-top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #0E161A;
        border: 1px solid #1E2D33;
        border-radius: 16px;
        padding: 20px 24px;
        color: #FFFFFF;
    }
    .wh-kpi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    @media (max-width: 900px) {
        .wh-top-bar {
            flex-direction: column;
            align-items: stretch;
            gap: 16px;
        }
        .wh-kpi-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }
</style>
@endpush

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">

    <!-- TOP BAR GUDANG -->
    <div class="wh-top-bar" style="background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%); border: 1px solid #334155; border-radius: 16px; padding: 22px 26px;">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(2, 132, 199, 0.2); color: #38BDF8; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px; margin-bottom: 8px; border: 1px solid rgba(2, 132, 199, 0.3);">
                <span style="width: 7px; height: 7px; background: #38BDF8; border-radius: 50%;"></span>
                <span>LOGISTICS &amp; STOCK CONTROL • OFFLINE-READY</span>
            </div>
            <h1 style="font-size: 22px; font-weight: 800; color: #FFFFFF;">Pusat Manajemen Gudang &amp; Stok</h1>
            <p style="color: #CBD5E1; font-size: 13px;">Petugas Gudang: <strong>Doni Staf Gudang</strong> • Pantau Stok Kritis &amp; Kiriman Masuk</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('inventory.index') }}" class="btn-soft-primary" style="background: #0284C7; color: #FFFFFF; font-weight: 700; font-size: 13px; padding: 10px 18px; border-radius: 10px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                <span>Buka Smart Inventory &rarr;</span>
            </a>
        </div>
    </div>

    <!-- METRICS KESEHATAN GUDANG -->
    <div class="wh-kpi-grid">
        <div class="card-panel" style="border-left: 4px solid #DC2626;">
            <span style="font-size: 11px; font-weight: 700; color: #DC2626; text-transform: uppercase;">Stok Kritis Segera Habis</span>
            <h2 style="font-size: 28px; font-weight: 800; color: #DC2626; margin: 4px 0;">{{ $criticalCount }} SKU</h2>
            <span style="font-size: 12px; color: #64748B;">Sisa hari aman &le; 4 hari</span>
        </div>
        <div class="card-panel" style="border-left: 4px solid #D97706;">
            <span style="font-size: 11px; font-weight: 700; color: #D97706; text-transform: uppercase;">Perhatian Reorder</span>
            <h2 style="font-size: 28px; font-weight: 800; color: #D97706; margin: 4px 0;">{{ $attentionCount }} SKU</h2>
            <span style="font-size: 12px; color: #64748B;">Mendekati minimum threshold</span>
        </div>
        <div class="card-panel" style="border-left: 4px solid #16A34A;">
            <span style="font-size: 11px; font-weight: 700; color: #16A34A; text-transform: uppercase;">Kondisi Aman / Optimal</span>
            <h2 style="font-size: 28px; font-weight: 800; color: #16A34A; margin: 4px 0;">{{ $healthyCount }} SKU</h2>
            <span style="font-size: 12px; color: #64748B;">Stok aman &gt; 14 hari kedepan</span>
        </div>
    </div>

    <!-- TABEL MONITORING STOK OPERASIONAL -->
    <div class="card-panel">
        <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
            <span>Daftar Monitoring Fisik Gudang</span>
        </h3>
        <div class="table-responsive">
        <table style="width: 100%; border-collapse: collapse; font-size: 13px; min-width: 600px;">
            <thead>
                <tr style="border-bottom: 1px solid #E2E8F0; text-align: left; color: #64748B;">
                    <th style="padding: 10px;">Nama Produk</th>
                    <th style="padding: 10px;">SKU</th>
                    <th style="padding: 10px;">Kategori</th>
                    <th style="padding: 10px;">Stok Fisik</th>
                    <th style="padding: 10px;">Status</th>
                    <th style="padding: 10px;">Supplier / Distributor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                    <tr style="border-bottom: 1px solid #F1F5F9;">
                        <td style="padding: 12px 10px; font-weight: 600;">{{ $p->name }}</td>
                        <td style="padding: 12px 10px; color: #64748B; font-family: monospace;">{{ $p->sku }}</td>
                        <td style="padding: 12px 10px;">{{ $p->category }}</td>
                        <td style="padding: 12px 10px; font-weight: 700;">{{ $p->current_stock }} unit</td>
                        <td style="padding: 12px 10px;">
                            <span style="padding: 3px 8px; border-radius: 12px; font-size: 11px; font-weight: 700; background: {{ $p->health_status === 'Critical' ? '#FEE2E2' : ($p->health_status === 'Attention' ? '#FEF3C7' : '#DCFCE7') }}; color: {{ $p->health_status === 'Critical' ? '#DC2626' : ($p->health_status === 'Attention' ? '#D97706' : '#16A34A') }};">
                                {{ $p->health_status }}
                            </span>
                        </td>
                        <td style="padding: 12px 10px; color: #64748B;">{{ $p->supplier_name ?: 'Distributor Umum' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

</div>
@endsection
