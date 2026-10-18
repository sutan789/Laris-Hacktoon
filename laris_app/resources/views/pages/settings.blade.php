@extends('layouts.app', ['title' => 'Pengaturan & Integrasi Toko - LARIS BI'])

@section('content')
<div class="settings-container">

    <!-- 1. GLOSSY HEADER BAR -->
    <div class="dash-header">
        <div class="header-main-info">
            <div class="greeting-row">
                <h1 class="page-greeting">Pengaturan &amp; <span class="store-gradient-name">Integrasi Toko</span></h1>
                <span class="verified-store-badge">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="#10B981"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                    <span>Konfigurasi Resmi</span>
                </span>
                <span class="live-status-pill">
                    <span class="pulse-dot"></span>
                    <span>Semua Modul Aktif Normal</span>
                </span>
            </div>
            <p class="page-subtitle">Kelola profil usaha, integrasi marketplace &amp; kasir POS, serta parameter Autonomous AI Engine.</p>
        </div>
    </div>

    <!-- FLASH SUCCESS ALERT -->
    @if(session('success'))
        <div class="glass-success-alert">
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg width="20" height="20" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="alert-close-btn">&times;</button>
        </div>
    @endif

    <div class="dash-columns">

        <!-- KIRI: PROFIL TOKO & OPERASIONAL -->
        <div class="col-left">
            <div class="card-panel">
                <div class="panel-header">
                    <div class="panel-title-group">
                        <div class="panel-icon-circle">
                            <svg width="18" height="18" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l4.314-4.385a1.5 1.5 0 0 1 2.122 0l4.314 4.385a3.004 3.004 0 0 1-.621 4.72m0 0a3.004 3.004 0 0 1-.621-4.72l4.314-4.385a1.5 1.5 0 0 1 2.122 0l4.314 4.385a3.004 3.004 0 0 1-.621 4.72"/></svg>
                        </div>
                        <div>
                            <h3 class="panel-title">Profil &amp; Operasional Gerai</h3>
                            <p class="panel-subtitle">Informasi identitas bisnis pada laporan audit dan nota kasir POS</p>
                        </div>
                    </div>
                    <span class="tag-pill-glossy">IDENTITAS</span>
                </div>

                <form action="{{ route('settings.update_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group-glossy">
                        <label class="form-label-glossy">Nama Bisnis / Toko</label>
                        <input type="text" name="store_name" class="input-field-glossy" value="{{ old('store_name', $store->name ?? 'Toko Berkah Utama') }}" required>
                    </div>

                    <div class="form-row-2col">
                        <div class="form-group-glossy">
                            <label class="form-label-glossy">Jam Operasional</label>
                            <input type="text" name="operating_hours" class="input-field-glossy" value="{{ old('operating_hours', $store->operating_hours ?? '08:00 - 22:00 WIB') }}">
                        </div>
                        <div class="form-group-glossy">
                            <label class="form-label-glossy">No. WhatsApp Toko</label>
                            <input type="text" name="phone" class="input-field-glossy" value="{{ old('phone', $store->phone ?? '081234567890') }}">
                        </div>
                    </div>

                    <div class="form-group-glossy">
                        <label class="form-label-glossy">Alamat Fisik Gerai</label>
                        <textarea name="address" class="input-field-glossy" rows="2" style="resize: vertical;">{{ old('address', $store->address ?? 'Jl. Braga No. 45, Bandung, Jawa Barat') }}</textarea>
                    </div>

                    {{-- PENGATURAN PEMBAYARAN TOKO (QRIS & REKENING BANK) --}}
                    <div style="margin-top: 18px; padding-top: 16px; border-top: 1px dashed #E2E8F0;">
                        <div style="font-size: 13px; font-weight: 800; color: #0F172A; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                            <svg width="16" height="16" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            <span>Rekening Bank &amp; QRIS Toko (Untuk Pembeli)</span>
                        </div>
                        <p style="font-size: 11.5px; color: #64748B; margin-bottom: 12px;">Informasi ini akan ditampilkan otomatis kepada konsumen saat memilih metode pembayaran QRIS / Transfer Bank.</p>

                        <div class="form-row-2col">
                            <div class="form-group-glossy">
                                <label class="form-label-glossy">Nama Bank</label>
                                <input type="text" name="bank_name" class="input-field-glossy" placeholder="Contoh: BCA / Mandiri / BRI / BSI" value="{{ old('bank_name', $store->bank_name ?? 'BCA (Bank Central Asia)') }}">
                            </div>
                            <div class="form-group-glossy">
                                <label class="form-label-glossy">Nomor Rekening</label>
                                <input type="text" name="bank_account_number" class="input-field-glossy" placeholder="Contoh: 7820-192-381" value="{{ old('bank_account_number', $store->bank_account_number ?? '7820-192-381') }}">
                            </div>
                        </div>

                        <div class="form-row-2col">
                            <div class="form-group-glossy">
                                <label class="form-label-glossy">Atas Nama Pemilik Rekening</label>
                                <input type="text" name="bank_account_name" class="input-field-glossy" placeholder="Contoh: Toko Berkah - Bambang" value="{{ old('bank_account_name', $store->bank_account_name ?? 'Toko Berkah Utama - Bambang') }}">
                            </div>
                            <div class="form-group-glossy">
                                <label class="form-label-glossy">NMID QRIS Nasional</label>
                                <input type="text" name="qris_nmid" class="input-field-glossy" placeholder="Contoh: ID1029384756" value="{{ old('qris_nmid', $store->qris_nmid ?? 'ID1029384756') }}">
                            </div>
                        </div>

                        <div class="form-group-glossy">
                            <label class="form-label-glossy">Upload Barcode QRIS Toko (File Gambar)</label>
                            <div style="display: flex; gap: 14px; align-items: center; background: #F8FAFC; border: 1px dashed #CBD5E1; padding: 14px; border-radius: 12px;">
                                <div style="width: 80px; height: 80px; border-radius: 8px; border: 1px solid #CBD5E1; overflow: hidden; background: #FFFFFF; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <img id="qrisPreviewImg" src="{{ $store->qris_image ?? 'https://images.unsplash.com/photo-1595079672139-545c6020c681?w=400&auto=format&fit=crop&q=80' }}" alt="QRIS Toko" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="flex: 1;">
                                    <input type="file" name="qris_file" id="qrisFileInput" accept="image/png, image/jpeg, image/jpg, image/webp" class="input-field-glossy" style="padding: 7px 10px; font-size: 12px; background: #FFFFFF;" onchange="previewQrisFile(this)">
                                    <input type="hidden" name="qris_image" value="{{ $store->qris_image ?? '' }}">
                                    <p style="font-size: 11px; color: #64748B; margin-top: 5px;">Pilih file gambar barcode QRIS resmi toko Anda (PNG, JPG, JPEG, WEBP. Maks. 3MB). Barcode ini akan langsung tampil saat pembeli checkout.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-20">
                        <button type="submit" class="btn-download-glossy" style="width: 100%; justify-content: center;">
                            <span>Simpan Perubahan &amp; Pengaturan Toko</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- KANAN: PARAMETER AI ENGINE -->
        <div class="col-right">
            <div class="card-panel">
                <div class="panel-header">
                    <div class="panel-title-group">
                        <div class="panel-icon-circle" style="background: rgba(204, 255, 0, 0.15); color: #15803D;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/></svg>
                        </div>
                        <div>
                            <h3 class="panel-title">Pengaturan AI Engine</h3>
                            <p class="panel-subtitle">Konfigurasi ambang batas stok dan sensitivitas deteksi tren</p>
                        </div>
                    </div>
                    <span class="tag-pill-glossy">AI CONFIG</span>
                </div>

                <form action="{{ route('settings.update_ai') }}" method="POST">
                    @csrf
                    <div class="form-group-glossy">
                        <label class="form-label-glossy">Model Kecerdasan Buatan (Decision Engine)</label>
                        <select name="model" class="select-field-glossy">
                            <option value="juragan-ai-standard" {{ in_array(($aiConfig['model'] ?? ''), ['juragan-ai-standard', 'gemini-3.5-flash', 'gemini-3.8-flash']) ? 'selected' : '' }}>Juragan AI Autonomous Engine (Aktif - Cepat &amp; Akurat)</option>
                            <option value="juragan-ai-pro" {{ ($aiConfig['model'] ?? '') == 'juragan-ai-pro' ? 'selected' : '' }}>Juragan AI Deep Reasoning (Analisis Kompleks)</option>
                        </select>
                    </div>

                    <div class="form-row-2col">
                        <div class="form-group-glossy">
                            <label class="form-label-glossy">Batas Stok Kritis (Hari)</label>
                            <input type="number" name="runway_threshold" class="input-field-glossy" value="{{ $aiConfig['runway_threshold'] ?? 5 }}" min="2" max="30">
                        </div>
                        <div class="form-group-glossy">
                            <label class="form-label-glossy">Target Diskon PO Kolektif (%)</label>
                            <input type="number" name="auto_bundle_discount" class="input-field-glossy" value="{{ $aiConfig['auto_bundle_discount'] ?? 18 }}" min="5" max="50">
                        </div>
                    </div>

                    <div class="form-group-glossy">
                        <label class="form-label-glossy">Sensitivitas Deteksi Sinyal Viral</label>
                        <select name="sensitivity" class="select-field-glossy">
                            <option value="Tinggi (Viral Signals > 80%)" selected>Tinggi (Sinyal &gt; 80% - Cepat Ambil Peluang)</option>
                            <option value="Moderat (Viral Signals > 60%)">Moderat (Sinyal &gt; 60% - Seimbang)</option>
                            <option value="Konservatif (Viral Signals > 40%)">Konservatif (Produk Terbukti Stabil Saja)</option>
                        </select>
                    </div>

                    <div class="mt-20">
                        <button type="submit" class="btn-download-glossy" style="width: 100%; justify-content: center; background: #10B981; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);">
                            <span>Perbarui Konfigurasi AI</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- FULL WIDTH: INTEGRASI MULTI-CHANNEL & KASIR POS -->
    <div class="card-panel">
        <div class="panel-header">
            <div class="panel-title-group">
                <div class="panel-icon-circle">
                    <svg width="18" height="18" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"/></svg>
                </div>
                <div>
                    <h3 class="panel-title">Integrasi Multi-Kanal &amp; Kasir Smart POS</h3>
                    <p class="panel-subtitle">Koneksi inventaris dan pesanan otomatis antara gerai fisik dan marketplace online</p>
                </div>
            </div>
            <span class="tag-pill-glossy">LIVE TELEMETRY</span>
        </div>

        <div class="channels-grid-glossy">
            @foreach($channels as $key => $ch)
                <div class="channel-card-glossy">
                    <div class="channel-left-info">
                        <div class="channel-icon-avatar">
                            @if($key === 'pos_offline')
                                <svg width="22" height="22" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                            @elseif($key === 'google_trends')
                                <svg width="22" height="22" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17Z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.27 21.43 7.33 24 12 24Z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.17 0 9.99 0 12s.45 3.83 1.25 5.42l4.03-3.15Z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.27 2.57 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98Z"/></svg>
                            @elseif($key === 'google_analytics')
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="#E37400"><path d="M19.5 3h-3a1.5 1.5 0 0 0-1.5 1.5v15a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5v-15A1.5 1.5 0 0 0 19.5 3Zm-7.5 6H9A1.5 1.5 0 0 0 7.5 10.5v7.5A1.5 1.5 0 0 0 9 19.5h3a1.5 1.5 0 0 0 1.5-1.5v-7.5A1.5 1.5 0 0 0 12 9Zm-7.5 6H1.5A1.5 1.5 0 0 0 0 16.5v1.5A1.5 1.5 0 0 0 1.5 19.5h3A1.5 1.5 0 0 0 6 18v-1.5A1.5 1.5 0 0 0 4.5 15Z"/></svg>
                            @elseif($key === 'shopee')
                                <svg width="22" height="22" fill="none" stroke="#EA580C" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                            @elseif($key === 'tokopedia')
                                <svg width="22" height="22" fill="none" stroke="#16A34A" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3.75h.008v.008H12v-.008Zm0 3.75h.008v.008H12v-.008ZM3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                            @elseif($key === 'qris_bi')
                                <svg width="22" height="22" fill="none" stroke="#005E9E" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"/></svg>
                            @elseif($key === 'tiktok')
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="#000000"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.29 0 .58.04.86.12V9.42a6.34 6.34 0 0 0-.86-.06 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V9.05a8.16 8.16 0 0 0 4.67 1.46V7.07c-.31-.07-.61-.2-.9-.38Z" fill="#EE1D52"/></svg>
                            @else
                                <svg width="22" height="22" fill="none" stroke="#0F172A" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 9 10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.317-.662V9.675M9 9l.001 7.428a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.317-.662V9"/></svg>
                            @endif
                        </div>
                        <div>
                            <h4 class="channel-title">{{ $ch['name'] }}</h4>
                            <span class="channel-meta">Sinkronisasi terakhir: <strong>{{ $ch['last_sync'] }}</strong></span>
                        </div>
                    </div>

                    <div class="channel-right-action">
                        @if($ch['status'] === 'connected')
                            <span class="badge-mint" style="display: inline-flex; align-items: center; gap: 5px;">
                                <span class="dot-green"></span>
                                <span>Terhubung</span>
                            </span>
                            <form action="{{ route('settings.toggle_channel', $key) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-timeframe-glossy" style="font-size: 11px; padding: 6px 12px; color: #DC2626;">Putuskan</button>
                            </form>
                        @else
                            <span class="badge-slate" style="display: inline-flex; align-items: center; gap: 5px;">
                                <span class="dot-gray"></span>
                                <span>Terputus</span>
                            </span>
                            <form action="{{ route('settings.toggle_channel', $key) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-download-glossy" style="font-size: 11px; padding: 6px 14px;">Hubungkan</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    .settings-container {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .channels-grid-glossy {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
        margin-top: 10px;
    }

    .channel-card-glossy {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        transition: all 0.2s;
    }

    .channel-card-glossy:hover {
        border-color: #10B981;
        transform: translateY(-1px);
    }

    .channel-left-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .channel-icon-avatar {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .channel-title {
        font-size: 14px;
        font-weight: 800;
        color: var(--text-main);
        margin: 0;
    }

    .channel-meta {
        font-size: 11.5px;
        color: var(--text-muted);
    }

    .channel-right-action {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    @media (max-width: 1024px) {
        .channels-grid-glossy { grid-template-columns: 1fr; }
    }
</style>
<script>
    function previewQrisFile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('qrisPreviewImg');
                if (img) img.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
