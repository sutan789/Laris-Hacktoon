@extends('layouts.app', ['title' => 'Jelajah Gerai UMKM & Marketplace - LARIS'])

@section('content')
<div class="user-marketplace-container">
    {{-- Header Banner / Hero ala Gojek SuperApp --}}
    <div class="marketplace-hero">
        <div class="hero-left">
            <div class="hero-badge">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <span>Marketplace Gerai UMKM Lintas Sektor</span>
            </div>
            <h1 class="hero-title">Pesan Menu &amp; Produk UMKM Lokal</h1>
            <p class="hero-desc">Dukung tetangga dan UMKM sekitar! Pesan makanan, sembako, busana, kerajinan, hingga jasa dengan opsi <strong>Pengantaran Toko</strong> atau <strong>Ambil di Tempat (Self-Pickup)</strong>, bayar mudah via <strong>QRIS Toko</strong>, <strong>Transfer Bank</strong>, atau <strong>Tunai</strong>.</p>
            
            {{-- Search Bar Sensitif --}}
            <form action="{{ route('user.dashboard') }}" method="GET" class="hero-search-form" id="searchForm">
                @if($currentSector !== 'all')
                    <input type="hidden" name="sector" value="{{ $currentSector }}">
                @endif
                <div class="search-input-wrap">
                    <svg width="18" height="18" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                    <input type="text" name="search" id="liveSearchInput" value="{{ $search }}" placeholder="Cari ayam geprek, beras pandan wangi, batik, rendang, rotan..." class="hero-search-input" onkeyup="filterLiveCatalog(this.value)">
                    @if($search)
                        <a href="{{ route('user.dashboard', ['sector' => $currentSector]) }}" class="clear-search-btn" title="Hapus pencarian">&times;</a>
                    @endif
                </div>
                <button type="submit" class="btn-hero-search">Cari Sekarang</button>
            </form>
        </div>
        <div class="hero-right">
            <div class="voucher-highlight-card">
                <div class="vh-header">
                    <svg width="18" height="18" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/></svg>
                    <span>Voucher Spesial Hari Ini</span>
                </div>
                <div class="vh-code">DISKON10K</div>
                <div class="vh-desc">Potongan Rp 10.000 untuk transaksi di seluruh gerai UMKM mitra platform LARIS.</div>
                <div class="vh-actions">
                    <button type="button" class="btn-claim-pill" onclick="copyVoucher('DISKON10K', this)">Salin Kode</button>
                    <button type="button" class="btn-use-pill" onclick="applyVoucherCode('DISKON10K')">Pakai Kupon</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert-box success">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="alert-box error">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    {{-- Kategori / Sektor UMKM Filter Tabs --}}
    <div class="sector-tabs-container">
        <div class="sector-tabs-scroll">
            <a href="{{ route('user.dashboard', ['search' => $search]) }}" class="sector-tab-item {{ $currentSector === 'all' ? 'active' : '' }}">
                <div class="sector-tab-icon">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                </div>
                <span>Semua Sektor</span>
            </a>
            <a href="{{ route('user.dashboard', ['sector' => 'Kuliner & F&B', 'search' => $search]) }}" class="sector-tab-item {{ $currentSector === 'Kuliner & F&B' ? 'active' : '' }}">
                <div class="sector-tab-icon orange">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <span>Kuliner &amp; F&amp;B</span>
            </a>
            <a href="{{ route('user.dashboard', ['sector' => 'Sembako & Kelontong', 'search' => $search]) }}" class="sector-tab-item {{ $currentSector === 'Sembako & Kelontong' ? 'active' : '' }}">
                <div class="sector-tab-icon green">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <span>Sembako &amp; Kelontong</span>
            </a>
            <a href="{{ route('user.dashboard', ['sector' => 'Fashion & Pakaian', 'search' => $search]) }}" class="sector-tab-item {{ $currentSector === 'Fashion & Pakaian' ? 'active' : '' }}">
                <div class="sector-tab-icon purple">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                </div>
                <span>Fashion &amp; Busana</span>
            </a>
            <a href="{{ route('user.dashboard', ['sector' => 'Kerajinan & Kriya', 'search' => $search]) }}" class="sector-tab-item {{ $currentSector === 'Kerajinan & Kriya' ? 'active' : '' }}">
                <div class="sector-tab-icon amber">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <span>Kriya &amp; Kerajinan</span>
            </a>
            <a href="{{ route('user.dashboard', ['sector' => 'Jasa & Layanan', 'search' => $search]) }}" class="sector-tab-item {{ $currentSector === 'Jasa & Layanan' ? 'active' : '' }}">
                <div class="sector-tab-icon blue">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <span>Jasa &amp; Layanan</span>
            </a>
        </div>
    </div>

    {{-- SECTION 1: FLASH SALE CUCI GUDANG JAM 7 MALAM (ANTI-BASI) --}}
    @if(isset($flashSaleProducts) && $flashSaleProducts->count() > 0)
    <div class="section-container flash-sale-section" id="flashSaleSection">
        <div class="flash-sale-header-banner">
            <div class="fs-header-left">
                <div class="fs-icon-wrap">
                    <svg width="20" height="20" fill="none" stroke="#CCFF00" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/></svg>
                </div>
                <div>
                    <div class="fs-badge-title">
                        <span>Flash Sale Cuci Gudang Jam 7 Malam</span>
                        <span class="fs-subtag">Anti-Basi &amp; Diskon Gede</span>
                    </div>
                    <p class="fs-subtitle">Diskon spesial hingga 50% untuk produk fresh dan kuliner sebelum toko tutup. Rebutan sekarang sebelum habis!</p>
                </div>
            </div>
            <div class="fs-countdown-box">
                <span class="fs-cd-lbl">Berakhir dalam:</span>
                <div class="countdown-timer" id="flashSaleTimer">
                    <span class="cd-box" id="cdHours">02</span> :
                    <span class="cd-box" id="cdMinutes">45</span> :
                    <span class="cd-box" id="cdSeconds">18</span>
                </div>
            </div>
        </div>

        <div class="flash-sale-grid">
            @foreach($flashSaleProducts as $fs)
                @php
                    $originalPrice = round($fs->selling_price * 1.35);
                    $discountPercent = round((($originalPrice - $fs->selling_price) / $originalPrice) * 100);
                    $stockPercent = min(100, max(15, ($fs->current_stock / 10) * 100));
                @endphp
                <div class="fs-product-card">
                    <div class="fs-img-wrap">
                        <img src="{{ $fs->image_url ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&auto=format&fit=crop&q=80' }}" alt="{{ $fs->name }}" class="fs-prod-img" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&auto=format&fit=crop&q=80';">
                        <span class="fs-discount-pill">-{{ $discountPercent }}%</span>
                        <span class="fs-badge-urgent">
                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 2px;"><path d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/></svg>
                            Flash Sale
                        </span>
                    </div>
                    <div class="fs-card-body">
                        <div class="fs-store-name">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span>{{ $fs->store->name ?? 'Gerai UMKM' }}</span>
                        </div>
                        <h3 class="fs-prod-title">{{ $fs->name }}</h3>
                        
                        <div class="fs-price-row">
                            <span class="fs-current-price">Rp {{ number_format($fs->selling_price, 0, ',', '.') }}</span>
                            <span class="fs-strike-price">Rp {{ number_format($originalPrice, 0, ',', '.') }}</span>
                        </div>

                        {{-- Urgency Stock Bar --}}
                        <div class="fs-stock-bar-wrap">
                            <div class="fs-stock-bar-track">
                                <div class="fs-stock-bar-fill" style="width: {{ $stockPercent }}%;"></div>
                            </div>
                            <div class="fs-stock-text">
                                <span>Tersisa <strong>{{ $fs->current_stock }} unit</strong></span>
                                <span class="fs-almost-empty">Hampir Habis!</span>
                            </div>
                        </div>

                        <button type="button" class="btn-fs-buy" onclick="addToCart({{ $fs->id }}, '{{ addslashes($fs->name) }}', {{ $fs->selling_price }}, {{ $fs->store_id }}, '{{ addslashes($fs->store->name ?? 'Gerai UMKM') }}', {{ $fs->store && $fs->store->has_delivery ? 'true' : 'false' }}, {{ $fs->store->delivery_fee ?? 5000 }}); openCheckoutModal();">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span>Beli Flash Sale</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- SECTION 2: VOUCHER DAN KUPON PLATFORM DISKON --}}
    <div class="section-container" id="vouchersSection">
        <div class="section-title-row">
            <div>
                <h2 class="section-title">
                    <svg width="20" height="20" fill="none" stroke="#10B981" viewBox="0 0 24 24" style="vertical-align: -3px; margin-right: 6px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/></svg>
                    Voucher &amp; Kupon Diskon Belanja Spesial
                </h2>
                <p class="section-subtitle">Gunakan kode kupon berikut saat checkout untuk menikmati potongan harga langsung dan gratis ongkir.</p>
            </div>
            <span class="voucher-count-badge">{{ $vouchers->count() }} Kupon Siap Digunakan</span>
        </div>

        <div class="vouchers-grid">
            @foreach($vouchers as $vc)
                <div class="voucher-ticket">
                    <div class="ticket-left">
                        <div class="ticket-val">
                            @if($vc->discount_type === 'percent')
                                {{ $vc->discount_value }}%
                            @else
                                Rp {{ number_format($vc->discount_value / 1000, 0) }}K
                            @endif
                        </div>
                        <div class="ticket-tag">POTONGAN</div>
                    </div>
                    <div class="ticket-right">
                        <div class="ticket-top-row">
                            <span class="ticket-code-pill" id="coupon-{{ $vc->code }}">{{ $vc->code }}</span>
                            <span class="ticket-min-order">Min. order Rp {{ number_format($vc->min_order, 0, ',', '.') }}</span>
                        </div>
                        <div class="ticket-title">{{ $vc->title }}</div>
                        <div class="ticket-desc">{{ $vc->description }}</div>
                        
                        <div class="ticket-actions-row">
                            <button type="button" class="btn-ticket-copy" onclick="copyVoucher('{{ $vc->code }}', this)" title="Salin ke clipboard">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25"/></svg>
                                Salin Kode
                            </button>
                            <button type="button" class="btn-use-voucher" onclick="applyVoucherCode('{{ $vc->code }}')">
                                <span>Gunakan</span>
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-left: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- SECTION 3: REKOMENDASI MENU & PRODUK TERLARIS (AI CURATED) --}}
    <div class="section-container" id="recommendationSection">
        <div class="section-title-row">
            <div>
                <h2 class="section-title">
                    <svg width="20" height="20" fill="none" stroke="#F59E0B" viewBox="0 0 24 24" style="vertical-align: -3px; margin-right: 6px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                    Rekomendasi Menu &amp; Produk Terlaris (AI Curated)
                </h2>
                <p class="section-subtitle">Dipilih otomatis berdasarkan data tren penjualan lokal dan kebutuhan harian masyarakat sekitar.</p>
            </div>
            <span class="ai-badge">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Prediksi Pasar Aktif
            </span>
        </div>

        <div class="rec-grid">
            @foreach($recommendedProducts as $prod)
                <div class="rec-card">
                    <div class="rec-card-image-wrap">
                        <img src="{{ $prod->image_url ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&auto=format&fit=crop&q=80' }}" alt="{{ $prod->name }}" class="rec-card-img" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&auto=format&fit=crop&q=80';">
                        <span class="rec-cat-pill">{{ $prod->category }}</span>
                        @if($prod->current_stock <= 5)
                            <span class="rec-stock-urgent">Tersisa {{ $prod->current_stock }} unit!</span>
                        @endif
                    </div>

                    <div class="rec-card-body">
                        <div class="rec-store-info">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span>{{ $prod->store->name ?? 'Gerai UMKM' }}</span>
                        </div>
                        <h3 class="rec-name">{{ $prod->name }}</h3>
                        
                        <div class="rec-meta-row">
                            <div class="rec-delivery-badge">
                                @if($prod->store && $prod->store->has_delivery)
                                    <span class="badge-delivery-yes">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.948c0-.621-.504-1.125-1.125-1.125H4.125C3.504 5.5 3 6.004 3 6.625v10.5c0 .621.504 1.125 1.125 1.125h1.5"/></svg>
                                        Bisa Diantar
                                    </span>
                                @else
                                    <span class="badge-delivery-no">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                        Ambil di Gerai
                                    </span>
                                @endif
                            </div>
                            <span class="rec-stock-count">Stok: <strong>{{ $prod->current_stock }}</strong></span>
                        </div>

                        <div class="rec-footer">
                            <div class="rec-price">Rp {{ number_format($prod->selling_price, 0, ',', '.') }}</div>
                            <button type="button" class="btn-add-cart" onclick="addToCart({{ $prod->id }}, '{{ addslashes($prod->name) }}', {{ $prod->selling_price }}, {{ $prod->store_id }}, '{{ addslashes($prod->store->name ?? '') }}', {{ $prod->store && $prod->store->has_delivery ? 'true' : 'false' }}, {{ $prod->store->delivery_fee ?? 5000 }})">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span>Pesan</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- SECTION 4: DAFTAR GERAI UMKM MITRA TERVERIFIKASI --}}
    <div class="section-container" id="storesSection">
        <div class="section-title-row">
            <div>
                <h2 class="section-title">
                    <svg width="20" height="20" fill="none" stroke="#10B981" viewBox="0 0 24 24" style="vertical-align: -3px; margin-right: 6px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.614A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.015a2.993 2.993 0 0 0 2.25 1.015c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0L6 3.75h12l2.25 5.599"/></svg>
                    Gerai &amp; Warung UMKM Mitra Terverifikasi
                </h2>
                <p class="section-subtitle">Temukan gerai di sekitar Anda. Lengkap dengan metode pengantaran toko atau pengambilan langsung di gerai fisik.</p>
            </div>
            <span class="store-count-badge">{{ $stores->count() }} Gerai Aktif</span>
        </div>

        <div class="stores-grid">
            @forelse($stores as $st)
                <div class="store-card">
                    <div class="store-banner-wrap">
                        <img src="{{ $st->banner_image ?? 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&auto=format&fit=crop&q=80' }}" alt="{{ $st->name }}" class="store-banner-img" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&auto=format&fit=crop&q=80';">
                        <span class="store-sector-tag">{{ $st->category }}</span>
                        @if($st->is_verified)
                            <span class="store-verified-pill">
                                <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 2px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                Mitra Terverifikasi
                            </span>
                        @endif
                    </div>

                    <div class="store-card-header">
                        <div class="store-header-left">
                            <div class="store-icon-box">
                                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <h3 class="store-name">{{ $st->name }}</h3>
                                <div class="store-meta-line">
                                    <span class="rating-inline">
                                        <svg width="13" height="13" fill="#F59E0B" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        {{ number_format($st->rating ?? 4.8, 1) }}
                                    </span>
                                    <span class="dot-sep">•</span>
                                    <span class="store-loc-short">{{ $st->location }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="store-card-body">
                        <p class="store-desc">{{ $st->description ?? 'Menyediakan aneka menu dan produk UMKM berkualitas dengan harga terjangkau bagi warga sekitar.' }}</p>
                        
                        <div class="store-specs">
                            <div class="spec-row">
                                <svg width="14" height="14" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>{{ $st->address ?? $st->location }}</span>
                            </div>
                            <div class="spec-row">
                                <svg width="14" height="14" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>{{ $st->operating_hours ?? '08:00 - 21:00 WIB' }}</span>
                            </div>
                        </div>

                        {{-- Delivery Policy Notification --}}
                        <div class="delivery-status-box {{ $st->has_delivery ? 'status-delivery-yes' : 'status-delivery-no' }}">
                            @if($st->has_delivery)
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                                <div>
                                    <div style="font-weight: 700;">Tersedia Layanan Pengantaran Toko</div>
                                    <div style="font-size: 11px; opacity: 0.85;">Ongkir flat Rp {{ number_format($st->delivery_fee ?? 5000, 0, ',', '.') }} • Jangkauan {{ $st->delivery_radius_km ?? 5 }} km</div>
                                </div>
                            @else
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                <div>
                                    <div style="font-weight: 700;">Hanya Ambil di Tempat (Self-Pickup)</div>
                                    <div style="font-size: 11px; opacity: 0.85;">Gerai belum menyediakan kurir, pembeli mengambil langsung di lokasi.</div>
                                </div>
                            @endif
                        </div>

                        {{-- Payment Methods Accepted by Store --}}
                        <div class="store-payment-badges">
                            <span class="pay-tag-mini">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"/></svg>
                                QRIS Toko
                            </span>
                            <span class="pay-tag-mini">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5m-15 10.5V10.5M1.5 21h21"/></svg>
                                {{ $st->bank_name ?? 'Transfer Bank' }}
                            </span>
                            <span class="pay-tag-mini">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0 0h.75a.75.75 0 0 1 .75.75v.75m18-10.5v.75c0 .414.336.75.75.75h.75m0 0v8.25m0 0h-.75a.75.75 0 0 1-.75.75v.75m-15-12a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25h12a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 16.5 4.5h-12Zm4.5 6.75a2.25 2.25 0 1 0 4.5 0 2.25 2.25 0 0 0-4.5 0Z"/></svg>
                                Tunai
                            </span>
                        </div>
                    </div>

                    <div class="store-card-footer">
                        <span class="product-count-text">{{ $st->products_count }} item siap pesan</span>
                        <a href="{{ url('/marketplace/store/' . $st->id) }}" class="btn-store-detail">
                            <span>Buka Gerai &amp; Menu</span>
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state-box">
                    <svg width="36" height="36" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div style="font-weight: 700; color: #334155; margin-top: 6px;">Tidak ada gerai ditemukan untuk kriteria pencarian ini.</div>
                    <a href="{{ route('user.dashboard') }}" class="btn-reset-filter">Reset Filter Pencarian</a>
                </div>
            @endforelse
        </div>
    </div>

    {{-- SECTION 5: SEMUA KATALOG PRODUK LENGKAP & PENCARIAN SENSITIF --}}
    <div class="section-container" id="fullCatalogSection">
        <div class="section-title-row">
            <div>
                <h2 class="section-title">
                    <svg width="20" height="20" fill="none" stroke="#10B981" viewBox="0 0 24 24" style="vertical-align: -3px; margin-right: 6px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                    Katalog Produk Lengkap Mitra UMKM
                </h2>
                <p class="section-subtitle">Jelajahi seluruh persediaan stok produk aktif dari semua gerai UMKM terverifikasi di kota Anda.</p>
            </div>
            <div class="catalog-live-counter">
                Menampilkan <strong>{{ $products->count() }}</strong> dari <strong>{{ $products->total() }}</strong> produk
            </div>
        </div>

        <div class="catalog-grid" id="catalogGrid">
            @forelse($products as $prod)
                <div class="catalog-product-card" data-title="{{ strtolower($prod->name) }}" data-category="{{ strtolower($prod->category) }}" data-store="{{ strtolower($prod->store->name ?? '') }}">
                    <div class="cpc-img-wrap">
                        <img src="{{ $prod->image_url ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&auto=format&fit=crop&q=80' }}" alt="{{ $prod->name }}" class="cpc-img" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&auto=format&fit=crop&q=80';">
                        <span class="cpc-cat-badge">{{ $prod->category }}</span>
                        @if($prod->current_stock <= 3)
                            <span class="cpc-stock-warn">Sisa {{ $prod->current_stock }}!</span>
                        @endif
                    </div>

                    <div class="cpc-body">
                        <div class="cpc-store-line">
                            <span class="store-dot"></span>
                            <span class="cpc-store-name">{{ $prod->store->name ?? 'Gerai UMKM' }}</span>
                        </div>
                        <h3 class="cpc-title">{{ $prod->name }}</h3>
                        
                        <div class="cpc-specs">
                            <span class="cpc-stock-tag">
                                @if($prod->current_stock > 10)
                                    <span style="width: 7px; height: 7px; border-radius: 50%; background: #10B981; display: inline-block; margin-right: 4px;"></span>Stok: {{ $prod->current_stock }} pcs
                                @else
                                    <span style="width: 7px; height: 7px; border-radius: 50%; background: #F59E0B; display: inline-block; margin-right: 4px;"></span>Stok: {{ $prod->current_stock }} pcs
                                @endif
                            </span>
                            @if($prod->store && $prod->store->has_delivery)
                                <span class="cpc-delivery-yes">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.948c0-.621-.504-1.125-1.125-1.125H4.125C3.504 5.5 3 6.004 3 6.625v10.5c0 .621.504 1.125 1.125 1.125h1.5"/></svg>
                                    Bisa Diantar
                                </span>
                            @else
                                <span class="cpc-delivery-no">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                    Pickup
                                </span>
                            @endif
                        </div>

                        <div class="cpc-footer">
                            <div class="cpc-price">Rp {{ number_format($prod->selling_price, 0, ',', '.') }}</div>
                            <button type="button" class="btn-cpc-add" onclick="addToCart({{ $prod->id }}, '{{ addslashes($prod->name) }}', {{ $prod->selling_price }}, {{ $prod->store_id }}, '{{ addslashes($prod->store->name ?? '') }}', {{ $prod->store && $prod->store->has_delivery ? 'true' : 'false' }}, {{ $prod->store->delivery_fee ?? 5000 }})">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span>+ Pesan</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-catalog-box">
                    <svg width="40" height="40" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <div style="font-size: 15px; font-weight: 800; color: #0F172A; margin-top: 8px;">Tidak Ada Produk Sesuai Kriteria</div>
                    <p style="font-size: 12px; color: #64748B; max-width: 360px;">Coba gunakan kata kunci pencarian yang berbeda atau pilih sektor produk lainnya.</p>
                    <a href="{{ route('user.dashboard') }}" class="btn-reset-filter" style="margin-top: 10px;">Lihat Semua Produk</a>
                </div>
            @endforelse
        </div>

        {{-- Pagination dengan Custom CSS --}}
        @if($products->hasPages())
            <div class="laris-pagination-wrap" style="margin-top: 16px;">
                <div class="pagination-info">
                    Halaman <strong>{{ $products->currentPage() }}</strong> dari <strong>{{ $products->lastPage() }}</strong> (Total {{ $products->total() }} produk)
                </div>
                <div class="pagination-nav">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- FLOATING CART TRIGGER BAR (ALA GOJEK / GRAB) --}}
<div id="floatingCartBar" class="floating-cart-bar" style="display: none;">
    <div class="cart-bar-content">
        <div class="cart-bar-left">
            <div class="cart-icon-bubble">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <span id="cartTotalItemsBadge" class="cart-qty-badge">0</span>
            </div>
            <div>
                <div class="cart-bar-total" id="cartBarTotalAmount">Rp 0</div>
                <div class="cart-bar-store" id="cartBarStoreName">Pilih menu gerai</div>
            </div>
        </div>
        <button type="button" class="btn-open-checkout" onclick="openCheckoutModal()">
            <span>Lanjut Pembayaran</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </div>
</div>

{{-- MODAL CHECKOUT PEMESANAN (FIXED OVERLAY, RESPONSIVE, STORE-SPECIFIC QRIS & BANK) --}}
<div id="checkoutModal" class="modal-overlay" style="display: none;">
    <div class="modal-card modal-checkout">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Konfirmasi &amp; Pembayaran Pesanan</h3>
                <div class="modal-subtitle" id="checkoutModalStoreName">Gerai UMKM Terpilih</div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeCheckoutModal()">&times;</button>
        </div>

        <form action="{{ route('user.checkout') }}" method="POST" id="checkoutForm">
            @csrf
            <input type="hidden" name="store_id" id="checkoutStoreId">

            <div class="modal-body checkout-body">
                {{-- Daftar Item Belanja dengan Qty Modifier --}}
                <div class="checkout-section">
                    <div class="c-section-header">
                        <span class="c-section-title">Item Pesanan Anda</span>
                        <span id="checkoutItemCountLbl" class="item-count-lbl">0 item</span>
                    </div>
                    <div id="checkoutItemsList" class="checkout-items-list">
                        {{-- Injected dynamically --}}
                    </div>
                </div>

                {{-- Pilihan Pengantaran (Delivery vs Self-Pickup) --}}
                <div class="checkout-section">
                    <div class="c-section-title">Metode Pengambilan / Pengantaran</div>
                    <div class="delivery-options-grid">
                        <label class="delivery-option-card" id="optionDeliveryLabel">
                            <input type="radio" name="delivery_type" value="delivery" id="radioDelivery" checked onchange="updateDeliveryCalculation()">
                            <div class="option-content">
                                <div class="option-title">
                                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 5px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.948c0-.621-.504-1.125-1.125-1.125H4.125C3.504 5.5 3 6.004 3 6.625v10.5c0 .621.504 1.125 1.125 1.125h1.5"/></svg>
                                    Pengantaran oleh Toko
                                </div>
                                <div class="option-desc" id="deliveryFeeDesc">Biaya kirim flat Rp 5.000</div>
                            </div>
                        </label>
                        <label class="delivery-option-card" id="optionPickupLabel">
                            <input type="radio" name="delivery_type" value="pickup" id="radioPickup" onchange="updateDeliveryCalculation()">
                            <div class="option-content">
                                <div class="option-title">
                                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 5px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                    Ambil di Gerai (Self-Pickup)
                                </div>
                                <div class="option-desc">Datang langsung ke lokasi gerai (Bebas Ongkir)</div>
                            </div>
                        </label>
                    </div>

                    {{-- Warning if store has no delivery --}}
                    <div id="noDeliveryAlert" class="no-delivery-notice" style="display: none;">
                        <svg width="18" height="18" fill="none" stroke="#D97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span>Gerai ini <strong>HANYA MELAYANI AMBIL DI TEMPAT (SELF-PICKUP)</strong>. Sistem otomatis memilih opsi ambil di gerai.</span>
                    </div>

                    {{-- Delivery Address Input --}}
                    <div id="deliveryAddressGroup" class="form-group" style="margin-top: 10px;">
                        <label class="form-label">Alamat Lengkap Pengantaran *</label>
                        <textarea name="delivery_address" id="deliveryAddressText" rows="2" class="form-input" placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, patokan lokasi..."></textarea>
                    </div>
                </div>

                {{-- Data Pemesan --}}
                <div class="checkout-section">
                    <div class="c-section-title">Informasi Penerima</div>
                    <div class="form-row-2">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" name="customer_name" value="{{ auth()->user()->name ?? 'Budi Pratama' }}" required class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. WhatsApp / HP *</label>
                            <input type="text" name="customer_phone" value="{{ auth()->user()->phone ?? '081234567890' }}" required class="form-input">
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 8px;">
                        <label class="form-label">Catatan Tambahan untuk Gerai (Opsional)</label>
                        <input type="text" name="notes" placeholder="Contoh: Jangan terlalu pedas, minta sendok, sambal dipisah..." class="form-input">
                    </div>
                </div>

                {{-- Kupon & Voucher dengan Quick Chips --}}
                <div class="checkout-section">
                    <div class="c-section-title">Kode Voucher &amp; Kupon Diskon</div>
                    <div class="voucher-input-group">
                        <input type="text" name="voucher_code" id="checkoutVoucherInput" placeholder="Ketik kode kupon (misal: DISKON10K)" class="form-input voucher-input">
                        <button type="button" class="btn-apply-voucher" onclick="applyEnteredVoucher()">Terapkan</button>
                    </div>
                    
                    {{-- Quick Clickable Voucher Chips --}}
                    <div class="voucher-quick-chips">
                        <span class="chips-label">Pilihan kupon cepat:</span>
                        @foreach($vouchers as $vChip)
                            <button type="button" class="chip-item" onclick="quickApplyVoucher('{{ $vChip->code }}')">
                                {{ $vChip->code }}
                            </button>
                        @endforeach
                    </div>

                    <div id="voucherFeedback" class="voucher-feedback" style="display: none;"></div>
                </div>

                {{-- METODE PEMBAYARAN: QRIS TOKO, TRANSFER BANK TOKO, TUNAI --}}
                <div class="checkout-section">
                    <div class="c-section-title">Metode Pembayaran (Sesuai Pengaturan Toko)</div>
                    <div class="payment-options-grid">
                        <label class="payment-option-card" id="optPayQris">
                            <input type="radio" name="payment_method" value="qris" id="radioQris" checked onchange="switchPaymentMethod('qris')">
                            <div class="option-content">
                                <div class="option-title">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"/></svg>
                                    <span>QRIS Toko</span>
                                    <span class="pay-recommend-pill">Instan &amp; Praktis</span>
                                </div>
                                <div class="option-desc">Scan via GoPay, OVO, Dana, BCA, Mandiri dll.</div>
                            </div>
                        </label>
                        <label class="payment-option-card" id="optPayBank">
                            <input type="radio" name="payment_method" value="bank" id="radioBank" onchange="switchPaymentMethod('bank')">
                            <div class="option-content">
                                <div class="option-title">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5m-15 10.5V10.5M1.5 21h21"/></svg>
                                    <span>Transfer Bank</span>
                                </div>
                                <div class="option-desc" id="payBankBriefDesc">BCA, Mandiri, BRI atau BSI toko.</div>
                            </div>
                        </label>
                        <label class="payment-option-card" id="optPayCash">
                            <input type="radio" name="payment_method" value="cash" id="radioCash" onchange="switchPaymentMethod('cash')">
                            <div class="option-content">
                                <div class="option-title">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0 0h.75a.75.75 0 0 1 .75.75v.75m18-10.5v.75c0 .414.336.75.75.75h.75m0 0v8.25m0 0h-.75a.75.75 0 0 1-.75.75v.75m-15-12a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25h12a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 16.5 4.5h-12Zm4.5 6.75a2.25 2.25 0 1 0 4.5 0 2.25 2.25 0 0 0-4.5 0Z"/></svg>
                                    <span>Tunai (Bayar di Tempat)</span>
                                </div>
                                <div class="option-desc">Bayar langsung saat barang diterima atau saat pickup.</div>
                            </div>
                        </label>
                    </div>

                    {{-- BOX QRIS DINAMIS BERDASARKAN PENGATURAN TOKO --}}
                    <div id="qrisDetailBox" class="qris-interactive-box">
                        <div class="qris-box-header">
                            <div class="qris-badge-tag">QRIS NASIONAL</div>
                            <div class="qris-store-merchant" id="qrisStoreMerchant">Nama Toko Mitra</div>
                        </div>
                        <div class="qris-qr-code">
                            <img id="qrisImageDisplay" src="https://images.unsplash.com/photo-1595079672139-545c6020c681?w=400&auto=format&fit=crop&q=80" alt="QRIS Toko" class="qris-img-elem">
                        </div>
                        <div class="qris-meta-info">
                            <div>NMID: <strong id="qrisNmidDisplay">ID1029384756</strong></div>
                            <div class="qris-instruction">Scan barcode di atas menggunakan aplikasi e-wallet atau m-banking apa saja. Pembayaran akan diverifikasi langsung oleh gerai mitra.</div>
                        </div>
                    </div>

                    {{-- BOX TRANSFER BANK DINAMIS BERDASARKAN PENGATURAN TOKO --}}
                    <div id="bankDetailBox" class="bank-interactive-box" style="display: none;">
                        <div class="bank-box-header">
                            <div class="bank-badge-tag">REKENING RESMI GERAI</div>
                            <span id="bankNameDisplay" class="bank-name-text">Bank Central Asia (BCA)</span>
                        </div>
                        <div class="bank-acc-row">
                            <div>
                                <div class="acc-num-lbl">Nomor Rekening:</div>
                                <div class="acc-num-val" id="bankAccNumDisplay">7820-192-381</div>
                                <div class="acc-name-val">a.n. <strong id="bankAccNameDisplay">Nama Pemilik Toko</strong></div>
                            </div>
                            <button type="button" class="btn-copy-acc" onclick="copyBankAccountNumber()">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25"/></svg>
                                Salin Rekening
                            </button>
                        </div>
                        <div class="bank-instruction">Silakan transfer sesuai nominal total tagihan di bawah ini, lalu simpan bukti transfer Anda untuk ditunjukkan ke gerai.</div>
                    </div>

                    {{-- BOX TUNAI --}}
                    <div id="cashDetailBox" class="cash-interactive-box" style="display: none;">
                        <div class="cash-box-inner">
                            <span class="cash-icon">
                                <svg width="22" height="22" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0 0h.75a.75.75 0 0 1 .75.75v.75m18-10.5v.75c0 .414.336.75.75.75h.75m0 0v8.25m0 0h-.75a.75.75 0 0 1-.75.75v.75m-15-12a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25h12a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 16.5 4.5h-12Zm4.5 6.75a2.25 2.25 0 1 0 4.5 0 2.25 2.25 0 0 0-4.5 0Z"/></svg>
                            </span>
                            <div>
                                <div style="font-weight: 700; color: #0F172A;">Pembayaran Tunai Langsung</div>
                                <div style="font-size: 11px; color: #64748B;">Siapkan uang pas saat kurir toko mengantar pesanan Anda, atau bayar langsung di kasir saat mengambil barang di gerai.</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Rincian Tagihan --}}
                <div class="checkout-summary-box">
                    <div class="summary-line">
                        <span>Subtotal Produk</span>
                        <span id="sumSubtotal">Rp 0</span>
                    </div>
                    <div class="summary-line">
                        <span>Biaya Pengantaran</span>
                        <span id="sumDeliveryFee">Rp 0</span>
                    </div>
                    <div class="summary-line discount-line">
                        <span>Diskon Voucher</span>
                        <span id="sumDiscount">-Rp 0</span>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-line total-line">
                        <span>Total Tagihan Akhir</span>
                        <span id="sumGrandTotal">Rp 0</span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel-checkout" onclick="closeCheckoutModal()">Kembali Belanja</button>
                <button type="submit" class="btn-submit-order" id="btnSubmitOrder">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Konfirmasi &amp; Bayar Pesanan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .user-marketplace-container {
        display: flex;
        flex-direction: column;
        gap: 24px;
        padding-bottom: 90px;
    }

    /* HERO BANNER */
    .marketplace-hero {
        background: linear-gradient(135deg, #0B131B 0%, #162434 100%);
        border-radius: 20px;
        padding: 32px 34px;
        color: #FFFFFF;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        box-shadow: 0 10px 30px -5px rgba(11, 19, 27, 0.25);
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(16, 185, 129, 0.2);
        color: #34D399;
        border: 1px solid rgba(16, 185, 129, 0.35);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 4px 10px;
        border-radius: 99px;
        margin-bottom: 12px;
    }

    .hero-title {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.02em;
        margin-bottom: 8px;
    }

    .hero-desc {
        color: #94A3B8;
        font-size: 13px;
        max-width: 620px;
        line-height: 1.55;
        margin-bottom: 18px;
    }
    .hero-desc strong { color: #F1F5F9; }

    .hero-search-form {
        display: flex;
        gap: 8px;
        max-width: 580px;
    }

    .search-input-wrap {
        flex: 1;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 10px;
        padding: 0 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
    }

    .hero-search-input {
        background: transparent;
        border: none;
        outline: none;
        color: #FFFFFF;
        font-size: 13px;
        font-family: inherit;
        width: 100%;
        padding: 11px 0;
    }
    .hero-search-input::placeholder { color: #64748B; }

    .clear-search-btn {
        color: #94A3B8;
        font-size: 18px;
        text-decoration: none;
        cursor: pointer;
        padding: 0 4px;
    }
    .clear-search-btn:hover { color: #FFFFFF; }

    .btn-hero-search {
        background: #10B981;
        color: #FFFFFF;
        border: none;
        padding: 0 20px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.18s;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        white-space: nowrap;
    }
    .btn-hero-search:hover { background: #059669; }

    .voucher-highlight-card {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.14);
        backdrop-filter: blur(8px);
        border-radius: 16px;
        padding: 20px;
        width: 270px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .vh-header {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        color: #10B981;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .vh-code {
        font-family: monospace;
        font-size: 22px;
        font-weight: 800;
        color: #FFFFFF;
        letter-spacing: 0.08em;
    }

    .vh-desc {
        font-size: 11px;
        color: #94A3B8;
        line-height: 1.4;
    }

    .vh-actions {
        display: flex;
        gap: 8px;
        margin-top: 4px;
    }

    .btn-claim-pill {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.15s;
        flex: 1;
    }
    .btn-claim-pill:hover { background: rgba(255, 255, 255, 0.2); }

    .btn-use-pill {
        background: #10B981;
        border: none;
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.15s;
        flex: 1;
    }
    .btn-use-pill:hover { background: #059669; }

    /* SECTOR TABS */
    .sector-tabs-container {
        overflow-x: auto;
        padding-bottom: 4px;
        scrollbar-width: none;
    }
    .sector-tabs-container::-webkit-scrollbar { display: none; }

    .sector-tabs-scroll {
        display: flex;
        gap: 10px;
    }

    .sector-tab-item {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 10px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        transition: all 0.16s ease;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.02);
    }
    .sector-tab-item:hover {
        border-color: #CBD5E1;
        transform: translateY(-1px);
    }
    .sector-tab-item.active {
        background: #0F172A;
        color: #FFFFFF;
        border-color: #0F172A;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
    }

    .sector-tab-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: #F1F5F9;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .sector-tab-item.active .sector-tab-icon {
        background: rgba(255, 255, 255, 0.15);
        color: #FFFFFF;
    }
    .sector-tab-icon.orange { color: #EA580C; background: #FFF7ED; }
    .sector-tab-icon.green { color: #16A34A; background: #F0FDF4; }
    .sector-tab-icon.purple { color: #9333EA; background: #FAF5FF; }
    .sector-tab-icon.amber { color: #D97706; background: #FFFBEB; }
    .sector-tab-icon.blue { color: #0284C7; background: #F0F9FF; }

    /* SECTION CONTAINERS */
    .section-container {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .section-title-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 12px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.01em;
    }

    .section-subtitle {
        font-size: 12px;
        color: #64748B;
        margin-top: 2px;
    }

    .ai-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ECFDF5;
        color: #059669;
        border: 1px solid #A7F3D0;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 99px;
    }

    .store-count-badge, .voucher-count-badge {
        background: #F1F5F9;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 99px;
    }

    /* FLASH SALE STYLES */
    .flash-sale-section {
        background: linear-gradient(135deg, #FFF1F2 0%, #FFE4E6 100%);
        border: 1px solid #FECDD3;
        border-radius: 18px;
        padding: 22px;
    }

    .flash-sale-header-banner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 6px;
        flex-wrap: wrap;
    }

    .fs-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .fs-icon-wrap {
        width: 44px;
        height: 44px;
        background: #E11D48;
        color: #FFFFFF;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        box-shadow: 0 4px 12px rgba(225, 29, 72, 0.35);
    }

    .fs-badge-title {
        font-size: 17px;
        font-weight: 800;
        color: #9F1239;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .fs-subtag {
        background: #E11D48;
        color: #FFFFFF;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 99px;
    }

    .fs-subtitle {
        font-size: 12px;
        color: #BE123C;
        margin-top: 2px;
    }

    .fs-countdown-box {
        background: #FFFFFF;
        border: 1px solid #FECDD3;
        border-radius: 12px;
        padding: 8px 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 6px rgba(225, 29, 72, 0.08);
    }

    .fs-cd-lbl {
        font-size: 11px;
        font-weight: 700;
        color: #9F1239;
    }

    .countdown-timer {
        font-family: monospace;
        font-weight: 800;
        font-size: 14px;
        color: #E11D48;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .cd-box {
        background: #E11D48;
        color: #FFFFFF;
        padding: 2px 5px;
        border-radius: 4px;
    }

    .flash-sale-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-top: 10px;
    }

    .fs-product-card {
        background: #FFFFFF;
        border: 1px solid #FECDD3;
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 2px 8px rgba(225, 29, 72, 0.06);
        transition: transform 0.18s, box-shadow 0.18s;
    }
    .fs-product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(225, 29, 72, 0.12);
    }

    .fs-img-wrap {
        position: relative;
        height: 140px;
        background: #F8FAFC;
        overflow: hidden;
    }

    .fs-prod-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .fs-discount-pill {
        position: absolute;
        top: 8px;
        left: 8px;
        background: #E11D48;
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
    }

    .fs-badge-urgent {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(15, 23, 42, 0.75);
        color: #FFFFFF;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 4px;
        backdrop-filter: blur(4px);
    }

    .fs-card-body {
        padding: 12px 14px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .fs-store-name {
        font-size: 11px;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .fs-prod-title {
        font-size: 13px;
        font-weight: 800;
        color: #0F172A;
        line-height: 1.35;
        height: 36px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .fs-price-row {
        display: flex;
        align-items: baseline;
        gap: 6px;
    }

    .fs-current-price {
        font-size: 15px;
        font-weight: 800;
        color: #E11D48;
    }

    .fs-strike-price {
        font-size: 11px;
        color: #94A3B8;
        text-decoration: line-through;
    }

    .fs-stock-bar-wrap {
        margin-top: 4px;
    }

    .fs-stock-bar-track {
        height: 6px;
        background: #FEE2E2;
        border-radius: 99px;
        overflow: hidden;
    }

    .fs-stock-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #F43F5E, #E11D48);
        border-radius: 99px;
    }

    .fs-stock-text {
        display: flex;
        justify-content: space-between;
        font-size: 10px;
        color: #64748B;
        margin-top: 3px;
    }
    .fs-almost-empty {
        color: #E11D48;
        font-weight: 700;
    }

    .btn-fs-buy {
        background: #E11D48;
        color: #FFFFFF;
        border: none;
        border-radius: 8px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.15s;
        margin-top: 4px;
        box-shadow: 0 2px 6px rgba(225, 29, 72, 0.25);
    }
    .btn-fs-buy:hover { background: #BE123C; }

    /* VOUCHERS GRID */
    .vouchers-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }

    .voucher-ticket {
        background: #FFFFFF;
        border: 1px dashed #CBD5E1;
        border-radius: 14px;
        display: flex;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.02);
    }

    .ticket-left {
        background: linear-gradient(135deg, #10B981, #059669);
        color: #FFFFFF;
        padding: 14px 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-width: 65px;
        text-align: center;
    }

    .ticket-val {
        font-size: 17px;
        font-weight: 800;
    }

    .ticket-tag {
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.05em;
        opacity: 0.9;
    }

    .ticket-right {
        padding: 12px 14px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 6px;
        flex: 1;
    }

    .ticket-top-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .ticket-code-pill {
        display: inline-block;
        background: #F1F5F9;
        color: #0F172A;
        font-family: monospace;
        font-size: 11px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 5px;
    }

    .ticket-min-order {
        font-size: 10px;
        color: #94A3B8;
    }

    .ticket-title {
        font-size: 12px;
        font-weight: 700;
        color: #0F172A;
    }

    .ticket-desc {
        font-size: 11px;
        color: #64748B;
        line-height: 1.35;
    }

    .ticket-actions-row {
        display: flex;
        gap: 6px;
        margin-top: 4px;
    }

    .btn-ticket-copy {
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        color: #334155;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-ticket-copy:hover {
        background: #E2E8F0;
    }

    .btn-use-voucher {
        background: #ECFDF5;
        border: 1px solid #A7F3D0;
        color: #059669;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-use-voucher:hover {
        background: #10B981;
        color: #FFFFFF;
    }

    /* REKOMENDASI GRID */
    .rec-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }

    .rec-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.02);
        transition: all 0.18s;
    }
    .rec-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(15, 23, 42, 0.06);
        border-color: #CBD5E1;
    }

    .rec-card-image-wrap {
        position: relative;
        height: 135px;
        background: #F8FAFC;
        overflow: hidden;
    }

    .rec-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .rec-cat-pill {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(15, 23, 42, 0.75);
        color: #FFFFFF;
        font-size: 9px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 99px;
        backdrop-filter: blur(4px);
    }

    .rec-stock-urgent {
        position: absolute;
        bottom: 8px;
        right: 8px;
        background: #E11D48;
        color: #FFFFFF;
        font-size: 9px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .rec-card-body {
        padding: 12px 14px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .rec-store-info {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        color: #64748B;
    }

    .rec-name {
        font-size: 13px;
        font-weight: 700;
        color: #0F172A;
        line-height: 1.35;
        height: 36px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .rec-meta-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 11px;
        margin-top: 2px;
    }

    .badge-delivery-yes {
        font-size: 10px;
        font-weight: 700;
        color: #059669;
        background: #ECFDF5;
        padding: 2px 6px;
        border-radius: 99px;
    }
    .badge-delivery-no {
        font-size: 10px;
        font-weight: 700;
        color: #D97706;
        background: #FFFBEB;
        padding: 2px 6px;
        border-radius: 99px;
    }

    .rec-stock-count {
        color: #64748B;
        font-size: 11px;
    }

    .rec-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #F1F5F9;
        padding-top: 10px;
        margin-top: 4px;
    }

    .rec-price {
        font-size: 14px;
        font-weight: 800;
        color: #0F172A;
    }

    .btn-add-cart {
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        color: #0F172A;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-add-cart:hover {
        background: #10B981;
        color: #FFFFFF;
        border-color: #10B981;
    }

    /* STORE CARDS GRID */
    .stores-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .store-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.02);
        transition: all 0.18s;
        overflow: hidden;
    }
    .store-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
    }

    .store-banner-wrap {
        position: relative;
        height: 110px;
        background: #F1F5F9;
        overflow: hidden;
    }

    .store-banner-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .store-sector-tag {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(15, 23, 42, 0.8);
        color: #FFFFFF;
        font-size: 9px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 99px;
        backdrop-filter: blur(4px);
    }

    .store-verified-pill {
        position: absolute;
        top: 8px;
        right: 8px;
        background: #10B981;
        color: #FFFFFF;
        font-size: 9px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 99px;
    }

    .store-card-header {
        padding: 14px 18px 8px 18px;
    }

    .store-header-left {
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }

    .store-icon-box {
        width: 40px;
        height: 40px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #334155;
        flex-shrink: 0;
    }

    .store-name {
        font-size: 15px;
        font-weight: 800;
        color: #0F172A;
        line-height: 1.3;
        margin-bottom: 2px;
    }

    .store-meta-line {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        color: #64748B;
    }

    .rating-inline {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        font-weight: 700;
        color: #0F172A;
    }

    .dot-sep { opacity: 0.5; }

    .store-card-body {
        padding: 0 18px 14px 18px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .store-desc {
        font-size: 12px;
        color: #64748B;
        line-height: 1.45;
        height: 34px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .store-specs {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .spec-row {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        color: #64748B;
    }

    .delivery-status-box {
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 11px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .status-delivery-yes {
        background: #ECFDF5;
        border: 1px solid #A7F3D0;
        color: #065F46;
    }
    .status-delivery-no {
        background: #FFFBEB;
        border: 1px solid #FDE68A;
        color: #92400E;
    }

    .store-payment-badges {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-top: 2px;
    }

    .pay-tag-mini {
        background: #F1F5F9;
        color: #475569;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 5px;
    }

    .store-card-footer {
        background: #F8FAFC;
        border-top: 1px solid #F1F5F9;
        padding: 10px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-count-text {
        font-size: 11px;
        font-weight: 600;
        color: #64748B;
    }

    .btn-store-detail {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 700;
        color: #0284C7;
        text-decoration: none;
        transition: gap 0.15s;
    }
    .btn-store-detail:hover { gap: 8px; }

    /* CATALOG FULL GRID */
    .catalog-live-counter {
        font-size: 12px;
        color: #64748B;
    }
    .catalog-live-counter strong { color: #0F172A; }

    .catalog-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }

    .catalog-product-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.02);
        transition: all 0.18s;
    }
    .catalog-product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.06);
        border-color: #CBD5E1;
    }

    .cpc-img-wrap {
        position: relative;
        height: 135px;
        background: #F8FAFC;
        overflow: hidden;
    }

    .cpc-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cpc-cat-badge {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(15, 23, 42, 0.75);
        color: #FFFFFF;
        font-size: 9px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 99px;
        backdrop-filter: blur(4px);
    }

    .cpc-stock-warn {
        position: absolute;
        bottom: 8px;
        right: 8px;
        background: #E11D48;
        color: #FFFFFF;
        font-size: 9px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .cpc-body {
        padding: 12px 14px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .cpc-store-line {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #64748B;
    }
    .store-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #10B981;
    }

    .cpc-title {
        font-size: 13px;
        font-weight: 700;
        color: #0F172A;
        line-height: 1.35;
        height: 36px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .cpc-specs {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 11px;
    }

    .cpc-stock-tag {
        font-size: 11px;
        color: #334155;
    }

    .cpc-delivery-yes {
        font-size: 9px;
        font-weight: 700;
        color: #059669;
        background: #ECFDF5;
        padding: 2px 6px;
        border-radius: 99px;
    }
    .cpc-delivery-no {
        font-size: 9px;
        font-weight: 700;
        color: #D97706;
        background: #FFFBEB;
        padding: 2px 6px;
        border-radius: 99px;
    }

    .cpc-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #F1F5F9;
        padding-top: 10px;
        margin-top: 4px;
    }

    .cpc-price {
        font-size: 14px;
        font-weight: 800;
        color: #0F172A;
    }

    .btn-cpc-add {
        background: #0F172A;
        color: #FFFFFF;
        border: none;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-cpc-add:hover {
        background: #10B981;
    }

    /* EMPTY STATES */
    .empty-state-box, .empty-catalog-box {
        grid-column: 1 / -1;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 42px 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .btn-reset-filter {
        background: #10B981;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: 700;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        margin-top: 10px;
    }

    /* FLOATING CART BAR */
    .floating-cart-bar {
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        width: calc(100% - 40px);
        max-width: 680px;
        background: #0F172A;
        color: #FFFFFF;
        border-radius: 16px;
        padding: 14px 20px;
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.4);
        z-index: 990;
        animation: slideUp 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideUp {
        from { transform: translate(-50%, 40px); opacity: 0; }
        to { transform: translate(-50%, 0); opacity: 1; }
    }

    .cart-bar-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-bar-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .cart-icon-bubble {
        position: relative;
        background: rgba(255, 255, 255, 0.12);
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-qty-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background: #10B981;
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 800;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 0 2px #0F172A;
    }

    .cart-bar-total {
        font-size: 16px;
        font-weight: 800;
        color: #FFFFFF;
    }

    .cart-bar-store {
        font-size: 11px;
        color: #94A3B8;
    }

    .btn-open-checkout {
        background: #10B981;
        color: #FFFFFF;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.15s;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .btn-open-checkout:hover { background: #059669; }

    /* CHECKOUT MODAL - FIXED OVERLAY & ELEGANT LAYOUT */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(15, 23, 42, 0.7);
        backdrop-filter: blur(6px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 20px;
    }

    .modal-checkout {
        background: #FFFFFF;
        border-radius: 20px;
        width: 100%;
        max-width: 620px;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.35);
        overflow: hidden;
        animation: modalScale 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes modalScale {
        from { transform: scale(0.96); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .modal-header {
        background: #0F172A;
        color: #FFFFFF;
        padding: 18px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-shrink: 0;
    }

    .modal-title {
        font-size: 16px;
        font-weight: 800;
        color: #FFFFFF;
    }

    .modal-subtitle {
        font-size: 11px;
        color: #94A3B8;
        margin-top: 2px;
    }

    .modal-close-btn {
        background: transparent;
        border: none;
        color: #94A3B8;
        font-size: 24px;
        line-height: 1;
        cursor: pointer;
    }
    .modal-close-btn:hover { color: #FFFFFF; }

    .checkout-body {
        overflow-y: auto;
        padding: 20px 24px;
        display: flex;
        flex-direction: column;
        gap: 18px;
        max-height: calc(90vh - 140px);
    }

    .checkout-section {
        border-bottom: 1px solid #F1F5F9;
        padding-bottom: 16px;
    }
    .checkout-section:last-child { border-bottom: none; }

    .c-section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .c-section-title {
        font-size: 13px;
        font-weight: 800;
        color: #0F172A;
    }

    .item-count-lbl {
        font-size: 11px;
        color: #64748B;
        font-weight: 600;
    }

    .checkout-items-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .checkout-item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #F8FAFC;
        padding: 10px 14px;
        border-radius: 10px;
        font-size: 12px;
        border: 1px solid #F1F5F9;
    }

    .checkout-item-title {
        font-weight: 700;
        color: #0F172A;
    }

    .checkout-item-price {
        font-size: 11px;
        color: #64748B;
        margin-top: 1px;
    }

    .checkout-qty-controls {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-qty-mod {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        background: #E2E8F0;
        border: none;
        color: #0F172A;
        font-weight: 800;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .btn-qty-mod:hover { background: #CBD5E1; }

    .qty-display-num {
        font-weight: 800;
        font-size: 12px;
        min-width: 18px;
        text-align: center;
    }

    .item-subtotal-val {
        font-weight: 800;
        color: #0F172A;
        min-width: 75px;
        text-align: right;
    }

    .delivery-options-grid, .payment-options-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .payment-options-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .delivery-option-card, .payment-option-card {
        border: 1px solid #CBD5E1;
        border-radius: 10px;
        padding: 10px 12px;
        display: flex;
        gap: 8px;
        align-items: flex-start;
        cursor: pointer;
        transition: all 0.15s;
        background: #FFFFFF;
    }
    .delivery-option-card:hover, .payment-option-card:hover {
        border-color: #94A3B8;
    }
    .delivery-option-card.selected, .payment-option-card.selected {
        border-color: #10B981;
        background: #F0FDF4;
    }

    .option-title {
        font-size: 12px;
        font-weight: 700;
        color: #0F172A;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .pay-recommend-pill {
        background: #ECFDF5;
        color: #059669;
        font-size: 9px;
        font-weight: 800;
        padding: 1px 5px;
        border-radius: 99px;
    }

    .option-desc {
        font-size: 11px;
        color: #64748B;
        margin-top: 2px;
        line-height: 1.35;
    }

    .no-delivery-notice {
        background: #FFFBEB;
        border: 1px solid #FDE68A;
        color: #92400E;
        font-size: 12px;
        padding: 10px 14px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 10px;
    }

    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .form-label {
        font-size: 11px;
        font-weight: 700;
        color: #334155;
    }

    .form-input {
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 12px;
        font-family: inherit;
        outline: none;
        width: 100%;
        box-sizing: border-box;
    }
    .form-input:focus {
        border-color: #10B981;
        background: #FFFFFF;
    }

    .voucher-input-group {
        display: flex;
        gap: 8px;
    }

    .voucher-input {
        text-transform: uppercase;
        font-family: monospace;
        font-weight: 700;
    }

    .btn-apply-voucher {
        background: #0F172A;
        color: #FFFFFF;
        border: none;
        padding: 0 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        white-space: nowrap;
    }
    .btn-apply-voucher:hover { background: #1E293B; }

    .voucher-quick-chips {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .chips-label {
        font-size: 10px;
        color: #64748B;
        font-weight: 600;
    }

    .chip-item {
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        color: #0F172A;
        font-family: monospace;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.12s;
    }
    .chip-item:hover {
        background: #10B981;
        color: #FFFFFF;
        border-color: #10B981;
    }

    .voucher-feedback {
        font-size: 11px;
        margin-top: 6px;
        font-weight: 700;
    }
    .voucher-feedback.success { color: #059669; }
    .voucher-feedback.error { color: #DC2626; }

    /* QRIS & BANK INTERACTIVE BOXES */
    .qris-interactive-box, .bank-interactive-box, .cash-interactive-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
    }

    .qris-box-header, .bank-box-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #E2E8F0;
        padding-bottom: 8px;
    }

    .qris-badge-tag {
        font-weight: 900;
        color: #DC2626;
        letter-spacing: 0.05em;
        font-size: 14px;
    }

    .qris-store-merchant {
        font-size: 12px;
        font-weight: 700;
        color: #0F172A;
    }

    .qris-qr-code {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px 0;
    }

    .qris-img-elem {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #CBD5E1;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
    }

    .qris-meta-info {
        text-align: center;
        font-size: 11px;
        color: #64748B;
    }

    .qris-instruction {
        font-size: 10px;
        color: #94A3B8;
        margin-top: 4px;
        line-height: 1.4;
    }

    .bank-badge-tag {
        font-size: 10px;
        font-weight: 800;
        color: #1D4ED8;
        background: #EFF6FF;
        padding: 2px 7px;
        border-radius: 4px;
    }

    .bank-name-text {
        font-size: 13px;
        font-weight: 800;
        color: #0F172A;
    }

    .bank-acc-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 10px;
        padding: 12px 14px;
    }

    .acc-num-lbl {
        font-size: 10px;
        color: #64748B;
    }

    .acc-num-val {
        font-family: monospace;
        font-size: 17px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: 0.04em;
    }

    .acc-name-val {
        font-size: 11px;
        color: #64748B;
        margin-top: 2px;
    }

    .btn-copy-acc {
        background: #F1F5F9;
        border: 1px solid #CBD5E1;
        color: #0F172A;
        font-size: 11px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.15s;
        white-space: nowrap;
    }
    .btn-copy-acc:hover { background: #E2E8F0; }

    .bank-instruction {
        font-size: 11px;
        color: #64748B;
        line-height: 1.4;
    }

    .cash-box-inner {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .cash-icon { font-size: 24px; }

    /* SUMMARY BILL */
    .checkout-summary-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 14px 16px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        font-size: 12px;
    }

    .summary-line {
        display: flex;
        justify-content: space-between;
        color: #475569;
    }
    .summary-line.discount-line { color: #059669; font-weight: 700; }
    .summary-divider { height: 1px; background: #E2E8F0; margin: 4px 0; }
    .summary-line.total-line {
        font-size: 15px;
        font-weight: 800;
        color: #0F172A;
    }

    .modal-footer {
        background: #F8FAFC;
        border-top: 1px solid #F1F5F9;
        padding: 14px 24px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-shrink: 0;
    }

    .btn-cancel-checkout {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        color: #475569;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 16px;
        border-radius: 10px;
        cursor: pointer;
    }

    .btn-submit-order {
        background: #10B981;
        color: #FFFFFF;
        border: none;
        font-weight: 800;
        font-size: 13px;
        padding: 10px 20px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .btn-submit-order:hover { background: #059669; }

    /* PAGINATION STYLING */
    .laris-pagination-wrap {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 12px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.02);
    }
    .pagination-info { font-size: 12px; color: #64748B; }
    .pagination-info strong { color: #0F172A; }
    .pagination-nav .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 6px;
        align-items: center;
    }
    .pagination-nav .page-item { display: inline-block; }
    .pagination-nav .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
        padding: 0 8px;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        background: #FFFFFF;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.15s ease;
    }
    .pagination-nav .page-link:hover { background: #F8FAFC; border-color: #CBD5E1; color: #0F172A; }
    .pagination-nav .page-item.active .page-link { background: #0F172A; border-color: #0F172A; color: #FFFFFF; }
    .pagination-nav .page-item.disabled .page-link { opacity: 0.4; cursor: not-allowed; }

    @media (max-width: 1024px) {
        .rec-grid { grid-template-columns: repeat(2, 1fr); }
        .stores-grid { grid-template-columns: repeat(2, 1fr); }
        .vouchers-grid { grid-template-columns: repeat(2, 1fr); }
        .flash-sale-grid { grid-template-columns: repeat(2, 1fr); }
        .catalog-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .marketplace-hero { flex-direction: column; align-items: flex-start; }
        .voucher-highlight-card { width: 100%; }
        .rec-grid { grid-template-columns: 1fr; }
        .stores-grid { grid-template-columns: 1fr; }
        .vouchers-grid { grid-template-columns: 1fr; }
        .flash-sale-grid { grid-template-columns: 1fr; }
        .catalog-grid { grid-template-columns: 1fr; }
        .delivery-options-grid, .payment-options-grid { grid-template-columns: 1fr; }
        .form-row-2 { grid-template-columns: 1fr; }
        .laris-pagination-wrap { flex-direction: column; gap: 10px; align-items: flex-start; }
    }
</style>

<script>
    // Inisialisasi Database Toko Lengkap untuk QRIS & Bank Dinamis
    const storesMap = {
        @foreach($allStores as $sId => $stObj)
            {{ $sId }}: {
                id: {{ $stObj->id }},
                name: {!! json_encode($stObj->name) !!},
                has_delivery: {{ $stObj->has_delivery ? 'true' : 'false' }},
                delivery_fee: {{ $stObj->delivery_fee ?? 5000 }},
                qris_image: {!! json_encode($stObj->qris_image ?? 'https://images.unsplash.com/photo-1595079672139-545c6020c681?w=400&auto=format&fit=crop&q=80') !!},
                qris_nmid: {!! json_encode($stObj->qris_nmid ?? ('ID' . rand(1000000000, 9999999999))) !!},
                bank_name: {!! json_encode($stObj->bank_name ?? 'Bank BCA') !!},
                bank_account_number: {!! json_encode($stObj->bank_account_number ?? '7820-192-381') !!},
                bank_account_name: {!! json_encode($stObj->bank_account_name ?? ($stObj->owner_name ?? $stObj->name)) !!}
            },
        @endforeach
    };

    // State Keranjang Belanja Global
    let cart = [];
    let currentStore = null;
    let appliedVoucher = null;

    function addToCart(productId, name, price, storeId, storeName, hasDelivery, deliveryFee) {
        // Jika keranjang berisi barang dari gerai lain, konfirmasi reset secara interaktif
        if (currentStore && currentStore.id !== storeId && cart.length > 0) {
            larisConfirm(
                "Ganti Gerai Belanja?",
                `Keranjang belanja Anda saat ini berisi produk dari <strong>'${currentStore.name}'</strong>.<br><br>Apakah Anda ingin mengosongkan keranjang untuk mulai berbelanja di <strong>'${storeName}'</strong>?`,
                function() {
                    cart = [];
                    executeAddToCart(productId, name, price, storeId, storeName, hasDelivery, deliveryFee);
                },
                null,
                "Ya, Ganti Gerai",
                "Batal"
            );
            return;
        }

        executeAddToCart(productId, name, price, storeId, storeName, hasDelivery, deliveryFee);
    }

    function executeAddToCart(productId, name, price, storeId, storeName, hasDelivery, deliveryFee) {
        const storeLookup = storesMap[storeId] || {
            id: storeId,
            name: storeName,
            has_delivery: hasDelivery,
            delivery_fee: deliveryFee,
            qris_image: 'https://images.unsplash.com/photo-1595079672139-545c6020c681?w=400&auto=format&fit=crop&q=80',
            qris_nmid: 'ID1029384756',
            bank_name: 'Bank BCA',
            bank_account_number: '7820-192-381',
            bank_account_name: storeName
        };

        currentStore = storeLookup;

        const existingItem = cart.find(i => i.id === productId);
        if (existingItem) {
            existingItem.qty += 1;
        } else {
            cart.push({ id: productId, name: name, price: price, qty: 1 });
        }

        updateCartFloatingBar();
        larisToast(`1x ${name} dimasukkan ke keranjang!`, 'success');
    }

    function changeCartItemQty(productId, delta) {
        const item = cart.find(i => i.id === productId);
        if (!item) return;

        item.qty += delta;
        if (item.qty <= 0) {
            cart = cart.filter(i => i.id !== productId);
        }

        if (cart.length === 0) {
            closeCheckoutModal();
        } else {
            renderCheckoutModalItems();
            updateDeliveryCalculation();
        }
        updateCartFloatingBar();
    }

    function updateCartFloatingBar() {
        const bar = document.getElementById('floatingCartBar');
        if (cart.length === 0) {
            bar.style.display = 'none';
            return;
        }

        bar.style.display = 'block';
        const totalItems = cart.reduce((acc, i) => acc + i.qty, 0);
        const subtotal = cart.reduce((acc, i) => acc + (i.price * i.qty), 0);

        document.getElementById('cartTotalItemsBadge').innerText = totalItems;
        document.getElementById('cartBarTotalAmount').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
        document.getElementById('cartBarStoreName').innerText = `${currentStore.name} • ${totalItems} item dipilih`;
    }

    function renderCheckoutModalItems() {
        const itemsList = document.getElementById('checkoutItemsList');
        itemsList.innerHTML = '';
        const totalCount = cart.reduce((acc, i) => acc + i.qty, 0);
        document.getElementById('checkoutItemCountLbl').innerText = totalCount + ' item';

        cart.forEach((item, index) => {
            const itemRow = document.createElement('div');
            itemRow.className = 'checkout-item-row';
            itemRow.innerHTML = `
                <input type="hidden" name="items[${index}][product_id]" value="${item.id}">
                <input type="hidden" name="items[${index}][quantity]" value="${item.qty}">
                <div>
                    <div class="checkout-item-title">${item.name}</div>
                    <div class="checkout-item-price">Rp ${item.price.toLocaleString('id-ID')} / pcs</div>
                </div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div class="checkout-qty-controls">
                        <button type="button" class="btn-qty-mod" onclick="changeCartItemQty(${item.id}, -1)">−</button>
                        <span class="qty-display-num">${item.qty}</span>
                        <button type="button" class="btn-qty-mod" onclick="changeCartItemQty(${item.id}, 1)">+</button>
                    </div>
                    <div class="item-subtotal-val">Rp ${(item.price * item.qty).toLocaleString('id-ID')}</div>
                </div>
            `;
            itemsList.appendChild(itemRow);
        });
    }

    function openCheckoutModal() {
        if (!currentStore || cart.length === 0) {
            larisAlert("Keranjang Masih Kosong", "Silakan pilih produk atau menu UMKM yang Anda sukai terlebih dahulu.", "info");
            return;
        }

        document.getElementById('checkoutStoreId').value = currentStore.id;
        document.getElementById('checkoutModalStoreName').innerText = currentStore.name;

        // Render Cart Items
        renderCheckoutModalItems();

        // Setup Delivery Policy Check
        const radioDelivery = document.getElementById('radioDelivery');
        const radioPickup = document.getElementById('radioPickup');
        const optionDeliveryLabel = document.getElementById('optionDeliveryLabel');
        const noDeliveryAlert = document.getElementById('noDeliveryAlert');
        const addressGroup = document.getElementById('deliveryAddressGroup');

        if (!currentStore.has_delivery) {
            radioDelivery.disabled = true;
            radioDelivery.checked = false;
            radioPickup.checked = true;
            optionDeliveryLabel.style.opacity = '0.5';
            optionDeliveryLabel.style.pointerEvents = 'none';
            noDeliveryAlert.style.display = 'flex';
            addressGroup.style.display = 'none';
        } else {
            radioDelivery.disabled = false;
            radioDelivery.checked = true;
            optionDeliveryLabel.style.opacity = '1';
            optionDeliveryLabel.style.pointerEvents = 'auto';
            noDeliveryAlert.style.display = 'none';
            addressGroup.style.display = 'flex';
            document.getElementById('deliveryFeeDesc').innerText = 'Biaya kirim flat Rp ' + currentStore.delivery_fee.toLocaleString('id-ID');
        }

        // Configure Dynamic Store-Specific Payment Details
        updateStorePaymentDisplay();

        updateDeliveryCalculation();
        document.getElementById('checkoutModal').style.display = 'flex';
    }

    function closeCheckoutModal() {
        document.getElementById('checkoutModal').style.display = 'none';
    }

    function updateStorePaymentDisplay() {
        if (!currentStore) return;

        // Update QRIS
        document.getElementById('qrisStoreMerchant').innerText = currentStore.name;
        document.getElementById('qrisNmidDisplay').innerText = currentStore.qris_nmid;
        if (currentStore.qris_image) {
            document.getElementById('qrisImageDisplay').src = currentStore.qris_image;
        }

        // Update Bank Details
        document.getElementById('bankNameDisplay').innerText = currentStore.bank_name;
        document.getElementById('bankAccNumDisplay').innerText = currentStore.bank_account_number;
        document.getElementById('bankAccNameDisplay').innerText = currentStore.bank_account_name;
        document.getElementById('payBankBriefDesc').innerText = currentStore.bank_name + ' • ' + currentStore.bank_account_number;
    }

    function switchPaymentMethod(method) {
        document.getElementById('qrisDetailBox').style.display = (method === 'qris') ? 'flex' : 'none';
        document.getElementById('bankDetailBox').style.display = (method === 'bank') ? 'flex' : 'none';
        document.getElementById('cashDetailBox').style.display = (method === 'cash') ? 'flex' : 'none';
    }

    function copyBankAccountNumber() {
        if (!currentStore) return;
        const accNum = currentStore.bank_account_number;
        copyToClipboardFallback(accNum, `Nomor rekening ${currentStore.bank_name} (${accNum}) berhasil disalin!`);
    }

    function updateDeliveryCalculation() {
        const isDelivery = document.getElementById('radioDelivery').checked;
        const addressGroup = document.getElementById('deliveryAddressGroup');
        if (addressGroup) {
            addressGroup.style.display = isDelivery ? 'flex' : 'none';
            const textarea = document.getElementById('deliveryAddressText');
            if (textarea) textarea.required = isDelivery;
        }

        const subtotal = cart.reduce((acc, i) => acc + (i.price * i.qty), 0);
        let deliveryFee = 0;
        if (isDelivery && currentStore && currentStore.has_delivery) {
            deliveryFee = currentStore.delivery_fee;
        }

        let discount = 0;
        if (appliedVoucher) {
            if (appliedVoucher.type === 'percent') {
                discount = (subtotal * appliedVoucher.val) / 100;
            } else {
                discount = appliedVoucher.val;
            }
            if (discount > subtotal) discount = subtotal;
        }

        const grandTotal = Math.max(0, subtotal + deliveryFee - discount);

        document.getElementById('sumSubtotal').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
        document.getElementById('sumDeliveryFee').innerText = 'Rp ' + deliveryFee.toLocaleString('id-ID');
        document.getElementById('sumDiscount').innerText = '-Rp ' + discount.toLocaleString('id-ID');
        document.getElementById('sumGrandTotal').innerText = 'Rp ' + grandTotal.toLocaleString('id-ID');
    }

    // --- Voucher Functionality ---
    function copyVoucher(code, btnElem) {
        copyToClipboardFallback(code, `Kode voucher '${code}' berhasil disalin ke clipboard!`);
        if (btnElem) {
            const originalText = btnElem.innerText;
            btnElem.innerText = 'Tersalin!';
            setTimeout(() => { btnElem.innerText = originalText; }, 2000);
        }
    }

    function copyToClipboardFallback(text, successToastMsg) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(() => {
                larisToast(successToastMsg, 'success');
            }).catch(() => {
                manualCopy(text, successToastMsg);
            });
        } else {
            manualCopy(text, successToastMsg);
        }
    }

    function manualCopy(text, successToastMsg) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            larisToast(successToastMsg, 'success');
        } catch (err) {
            larisAlert("Salin Teks", `Silakan salin kode berikut secara manual: <strong>${text}</strong>`, "info");
        }
        document.body.removeChild(textArea);
    }

    function applyVoucherCode(code) {
        document.getElementById('checkoutVoucherInput').value = code;
        copyVoucher(code);
        if (cart.length > 0 && currentStore) {
            openCheckoutModal();
            applyEnteredVoucher();
        } else {
            larisAlert(
                "Kupon Disalin!",
                `Kupon <strong>${code}</strong> telah aktif & disalin!<br><br>Silakan pilih menu / produk yang Anda sukai dari gerai di bawah, lalu buka pembayaran. Kupon akan otomatis terpasang.`,
                "success"
            );
        }
    }

    function quickApplyVoucher(code) {
        document.getElementById('checkoutVoucherInput').value = code;
        applyEnteredVoucher();
    }

    function applyEnteredVoucher() {
        const code = document.getElementById('checkoutVoucherInput').value.trim().toUpperCase();
        const feedback = document.getElementById('voucherFeedback');
        const subtotal = cart.reduce((acc, i) => acc + (i.price * i.qty), 0);

        if (!code) {
            feedback.style.display = 'block';
            feedback.className = 'voucher-feedback error';
            feedback.innerText = 'Harap ketik kode voucher.';
            return;
        }

        // Live check via API or instant rules
        if (code === 'DISKON10K') {
            if (subtotal < 30000) {
                feedback.style.display = 'block';
                feedback.className = 'voucher-feedback error';
                feedback.innerText = 'Minimal belanja untuk DISKON10K adalah Rp 30.000.';
                appliedVoucher = null;
                updateDeliveryCalculation();
                return;
            }
            appliedVoucher = { code: 'DISKON10K', type: 'fixed', val: 10000 };
        } else if (code === 'GRATISONGKIR') {
            appliedVoucher = { code: 'GRATISONGKIR', type: 'fixed', val: 7000 };
        } else if (code === 'FLASH50') {
            appliedVoucher = { code: 'FLASH50', type: 'percent', val: 50 };
        } else if (code === 'USERBARU') {
            if (subtotal < 40000) {
                feedback.style.display = 'block';
                feedback.className = 'voucher-feedback error';
                feedback.innerText = 'Minimal belanja untuk USERBARU adalah Rp 40.000.';
                appliedVoucher = null;
                updateDeliveryCalculation();
                return;
            }
            appliedVoucher = { code: 'USERBARU', type: 'fixed', val: 15000 };
        } else {
            feedback.style.display = 'block';
            feedback.className = 'voucher-feedback error';
            feedback.innerText = 'Kode voucher tidak valid atau kedaluwarsa.';
            appliedVoucher = null;
            updateDeliveryCalculation();
            return;
        }

        feedback.style.display = 'block';
        feedback.className = 'voucher-feedback success';
        feedback.innerText = `Kupon ${code} berhasil dipasang!`;
        updateDeliveryCalculation();
    }

    // --- Sensitive Live Catalog Search on Keystroke ---
    function filterLiveCatalog(keyword) {
        const q = keyword.toLowerCase().trim();
        const cards = document.querySelectorAll('.catalog-product-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const title = card.getAttribute('data-title') || '';
            const cat = card.getAttribute('data-category') || '';
            const store = card.getAttribute('data-store') || '';

            if (title.includes(q) || cat.includes(q) || store.includes(q)) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
    }

    // --- Countdown Timer for Flash Sale ---
    function initFlashSaleTimer() {
        let totalSeconds = 2 * 3600 + 45 * 60 + 18;
        setInterval(() => {
            if (totalSeconds > 0) {
                totalSeconds--;
                const h = Math.floor(totalSeconds / 3600);
                const m = Math.floor((totalSeconds % 3600) / 60);
                const s = totalSeconds % 60;

                const hElem = document.getElementById('cdHours');
                const mElem = document.getElementById('cdMinutes');
                const sElem = document.getElementById('cdSeconds');

                if (hElem) hElem.innerText = String(h).padStart(2, '0');
                if (mElem) mElem.innerText = String(m).padStart(2, '0');
                if (sElem) sElem.innerText = String(s).padStart(2, '0');
            }
        }, 1000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        initFlashSaleTimer();
    });
</script>
@endsection
