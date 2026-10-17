@extends('layouts.app', ['title' => 'Settings & Konfigurasi - LARIS BI Platform'])

@section('content')
<div class="settings-container">

    <!-- HEADER -->
    <div class="settings-header">
        <div>
            <div class="badge-pill">KONFIGURASI SISTEM • AUTONOMOUS BI</div>
            <h1 class="page-title">Pengaturan & Integrasi Toko</h1>
            <p class="page-subtitle">Kelola profil toko, integrasi marketplace & kasir POS, serta parameter Autonomous AI Engine.</p>
        </div>
        <div>
            <span class="active-badge">
                <span class="dot-online"></span>
                <span>Semua Modul Berjalan Normal</span>
            </span>
        </div>
    </div>

    <!-- FLASH NOTIFICATION -->
    @if(session('success'))
        <div class="alert-success-banner">
            <svg width="20" height="20" fill="none" stroke="#16A34A" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="settings-grid">

        <!-- KIRI: PROFIL TOKO & OPERASIONAL -->
        <div class="card-panel">
            <div class="panel-head">
                <div class="icon-circle">
                    <svg width="18" height="18" fill="none" stroke="#16A34A" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l4.314-4.385a1.5 1.5 0 0 1 2.122 0l4.314 4.385a3.004 3.004 0 0 1-.621 4.72m0 0a3.004 3.004 0 0 1-.621-4.72l4.314-4.385a1.5 1.5 0 0 1 2.122 0l4.314 4.385a3.004 3.004 0 0 1-.621 4.72"/></svg>
                </div>
                <div>
                    <h3>Profil & Operasional Toko</h3>
                    <p class="sub-muted">Informasi identitas bisnis yang digunakan pada laporan & POS</p>
                </div>
            </div>

            <form action="{{ route('settings.update_store') }}" method="POST" class="settings-form">
                @csrf
                <div class="form-group">
                    <label>Nama Bisnis / Toko</label>
                    <input type="text" name="store_name" value="{{ old('store_name', $store->name ?? 'Toko Berkah Utama') }}" required>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Jam Operasional</label>
                        <input type="text" name="operating_hours" value="{{ old('operating_hours', $store->operating_hours ?? '08:00 - 22:00 WIB') }}">
                    </div>
                    <div class="form-group">
                        <label>No. Kontak / WhatsApp Toko</label>
                        <input type="text" name="phone" value="{{ old('phone', $store->phone ?? '081234567890') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat Toko Fisik</label>
                    <textarea name="address" rows="3">{{ old('address', $store->address ?? 'Jl. Braga No. 45, Bandung, Jawa Barat') }}</textarea>
                </div>

                <div class="form-action-row">
                    <button type="submit" class="btn-dark-save">
                        <span>Simpan Perubahan Toko</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- KANAN: PARAMETER AI ENGINE -->
        <div class="card-panel">
            <div class="panel-head">
                <div class="icon-circle lime-bg">
                    <svg width="18" height="18" fill="none" stroke="#000000" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/></svg>
                </div>
                <div>
                    <h3>Autonomous AI Engine Settings</h3>
                    <p class="sub-muted">Pengaturan model kecerdasan buatan & ambang batas peringatan stok</p>
                </div>
            </div>

            <form action="{{ route('settings.update_ai') }}" method="POST" class="settings-form">
                @csrf
                <div class="form-group">
                    <label>AI Foundation Model (Decision Engine)</label>
                    <select name="model">
                        <option value="gemini-3.8-flash" {{ ($aiConfig['model'] ?? '') == 'gemini-3.8-flash' ? 'selected' : '' }}>Google Gemini 3.8 Flash (Aktif - Latensi Rendah)</option>
                        <option value="gemini-2.5-pro">Google Gemini 2.5 Pro (Deep Reasoning Complex)</option>
                    </select>
                    <small class="hint-text">Model ini digunakan oleh Juragan AI Copilot, Auto-Bundle PO, dan deteksi tren viral.</small>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Batas Kritis Runway Stok (Hari)</label>
                        <input type="number" name="runway_threshold" value="{{ $aiConfig['runway_threshold'] ?? 5 }}" min="2" max="30">
                        <small class="hint-text">Trigger peringatan darurat jika sisa stok &lt; X hari.</small>
                    </div>
                    <div class="form-group">
                        <label>Target Diskon Ongkir Auto-Bundle (%)</label>
                        <input type="number" name="auto_bundle_discount" value="{{ $aiConfig['auto_bundle_discount'] ?? 18 }}" min="5" max="50">
                        <small class="hint-text">Ekspektasi penghematan logistik supplier kolektif.</small>
                    </div>
                </div>

                <div class="form-group">
                    <label>Sensitivitas Deteksi Sinyal Viral</label>
                    <select name="sensitivity">
                        <option value="Tinggi (Viral Signals > 80%)" selected>Tinggi (Viral Signals &gt; 80% - Cepat Ambil Peluang)</option>
                        <option value="Moderat (Viral Signals > 60%)">Moderat (Viral Signals &gt; 60% - Seimbang)</option>
                        <option value="Konservatif (Viral Signals > 40%)">Konservatif (Hanya Produk Terbukti Stabil)</option>
                    </select>
                </div>

                <div class="form-action-row">
                    <button type="submit" class="btn-lime-save">
                        <span>Perbarui AI Engine</span>
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- FULL WIDTH: INTEGRASI MULTI-CHANNEL & POS -->
    <div class="card-panel mt-24">
        <div class="panel-head flex-between">
            <div class="flex-align gap-12">
                <div class="icon-circle">
                    <svg width="18" height="18" fill="none" stroke="#2563EB" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"/></svg>
                </div>
                <div>
                    <h3>Integrasi Multi-Channel & Kasir POS</h3>
                    <p class="sub-muted">Koneksi data inventaris dan pesanan otomatis secara multi-tenant</p>
                </div>
            </div>
            <span class="telemetry-chip">Live Sync Enabled</span>
        </div>

        <div class="channels-list">
            @foreach($channels as $key => $ch)
                <div class="channel-card">
                    <div class="channel-info">
                        <div class="channel-icon-avatar">
                            @if($key === 'pos_offline')
                                <svg width="22" height="22" fill="none" stroke="#2563EB" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.651h.008v.008H6.75v-.008Zm0 3h.008v.008H6.75v-.008Zm0 3h.008v.008H6.75v-.008Z"/></svg>
                            @elseif($key === 'shopee')
                                <svg width="22" height="22" fill="none" stroke="#EA580C" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                            @elseif($key === 'tokopedia')
                                <svg width="22" height="22" fill="none" stroke="#16A34A" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3.75h.008v.008H12v-.008Zm0 3.75h.008v.008H12v-.008ZM3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                            @else
                                <svg width="22" height="22" fill="none" stroke="#0F172A" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m9 9 10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.317-.662V9.675M9 9l.001 7.428a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.317-.662V9"/></svg>
                            @endif
                        </div>
                        <div>
                            <h4 class="channel-title">{{ $ch['name'] }}</h4>
                            <span class="channel-meta">Status sinkronisasi: <strong>{{ $ch['last_sync'] }}</strong></span>
                        </div>
                    </div>

                    <div class="channel-status-action">
                        @if($ch['status'] === 'connected')
                            <span class="status-pill-online">● Terhubung</span>
                            <form action="{{ route('settings.toggle_channel', $key) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-disconnect">Putuskan</button>
                            </form>
                        @else
                            <span class="status-pill-offline">○ Terputus</span>
                            <form action="{{ route('settings.toggle_channel', $key) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-connect">Hubungkan</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@push('styles')
<style>
    .settings-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .settings-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .badge-pill {
        display: inline-block;
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        color: #475569;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.8px;
        margin-bottom: 6px;
    }

    .page-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 24px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .page-subtitle {
        font-size: 13px;
        color: #64748B;
        margin-top: 4px;
    }

    .active-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #F0FDF4;
        border: 1px solid #BBF7D0;
        color: #166534;
        font-size: 11px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
    }

    .dot-online {
        width: 7px;
        height: 7px;
        background: #16A34A;
        border-radius: 50%;
    }

    .alert-success-banner {
        background: linear-gradient(135deg, #DCFCE7 0%, #BBF7D0 100%);
        border: 1px solid #86EFAC;
        border-radius: 12px;
        padding: 12px 18px;
        color: #166534;
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .settings-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .panel-head {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #F1F5F9;
    }

    .panel-head h3 {
        font-size: 15px;
        font-weight: 700;
        color: #0F172A;
    }

    .icon-circle {
        width: 36px;
        height: 36px;
        background: #F0FDF4;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .lime-bg {
        background: #CCFF00;
    }

    .settings-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-group label {
        font-size: 12px;
        font-weight: 700;
        color: #334155;
    }

    .form-group input, .form-group select, .form-group textarea {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        padding: 9px 12px;
        font-size: 13px;
        color: #0F172A;
        font-family: inherit;
        outline: none;
        transition: all 0.2s;
    }

    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        border-color: #16A34A;
        box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.15);
    }

    .hint-text {
        font-size: 11px;
        color: #64748B;
    }

    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .form-action-row {
        margin-top: 6px;
    }

    .btn-dark-save {
        background: #0B1215;
        color: #FFFFFF;
        padding: 10px 18px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-dark-save:hover {
        background: #1E293B;
    }

    .btn-lime-save {
        background: #CCFF00;
        color: #0B1215;
        padding: 10px 18px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-lime-save:hover {
        background: #B8E600;
    }

    /* CHANNELS */
    .flex-between {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .telemetry-chip {
        background: #F0FDF4;
        color: #166534;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 12px;
        border: 1px solid #BBF7D0;
    }

    .channels-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .channel-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 14px 18px;
        transition: all 0.2s;
    }

    .channel-card:hover {
        border-color: #CBD5E1;
        background: #FFFFFF;
    }

    .channel-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .channel-icon-avatar {
        font-size: 24px;
        width: 42px;
        height: 42px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .channel-title {
        font-size: 13px;
        font-weight: 700;
        color: #0F172A;
    }

    .channel-meta {
        font-size: 11px;
        color: #64748B;
    }

    .channel-status-action {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .status-pill-online {
        font-size: 11px;
        font-weight: 700;
        color: #16A34A;
        background: #DCFCE7;
        padding: 4px 10px;
        border-radius: 12px;
    }

    .status-pill-offline {
        font-size: 11px;
        font-weight: 700;
        color: #64748B;
        background: #F1F5F9;
        padding: 4px 10px;
        border-radius: 12px;
    }

    .btn-disconnect {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        color: #EF4444;
        font-size: 11px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-connect {
        background: #0B1215;
        color: #CCFF00;
        border: none;
        font-size: 11px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
    }

    .mt-24 { margin-top: 24px; }
    .gap-12 { gap: 12px; }

    @media (max-width: 900px) {
        .settings-grid { grid-template-columns: 1fr; }
        .form-row-2 { grid-template-columns: 1fr; }
        .set-head-bar {
            flex-direction: column;
            align-items: stretch;
            gap: 14px;
        }
        .set-head-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
    }

    @media (max-width: 640px) {
        .channel-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
    }
</style>
@endpush
@endsection
