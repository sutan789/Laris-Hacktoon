@extends('layouts.app', ['title' => $store->name . ' - Katalog Gerai UMKM'])

@section('content')
<div class="store-shopee-container">
    {{-- STORE BANNER & PROFILE CARD --}}
    <div class="store-hero-card">
        <div class="store-hero-top">
            <a href="{{ route('user.marketplace') }}" class="btn-back-market">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                <span>Kembali ke Semua Gerai UMKM</span>
            </a>
            <div class="store-badge-group">
                <span class="store-category-pill">{{ $store->category }}</span>
                <span class="store-status-pill"><span class="pulse-green"></span> Buka Sekarang</span>
            </div>
        </div>

        <div class="store-profile-flex">
            <div class="store-avatar-box">
                <svg width="36" height="36" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <div class="verified-badge-mini" title="Gerai UMKM Terverifikasi">
                    <svg width="14" height="14" fill="#10B981" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
            </div>

            <div class="store-profile-main">
                <div class="store-name-row">
                    <h1 class="store-name-title">{{ $store->name }}</h1>
                    <span class="official-pill">Mitra Resmi LARIS</span>
                </div>
                <p class="store-meta-owner">Dikelola oleh <strong>{{ $store->owner_name }}</strong> &bull; Mitra Komunitas UMKM</p>

                <div class="store-highlights-row">
                    <div class="hl-item">
                        <svg width="15" height="15" fill="#F59E0B" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span><strong>{{ number_format($store->rating ?? 4.9, 1) }}</strong> (1.2k+ ulasan)</span>
                    </div>
                    <div class="hl-item">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ $store->address ?? $store->location }}</span>
                    </div>
                    <div class="hl-item">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $store->operating_hours ?? '08:00 - 21:00 WIB' }}</span>
                    </div>
                    <div class="hl-item">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span><strong>{{ $store->products->count() }}</strong> Produk Siap Pesan</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- DELIVERY STATUS BAR --}}
        <div class="delivery-status-banner {{ $store->has_delivery ? 'status-delivery' : 'status-pickup' }}">
            @if($store->has_delivery)
                <div class="dsb-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.948c0-.621-.504-1.125-1.125-1.125H4.125C3.504 5.5 3 6.004 3 6.625v10.5c0 .621.504 1.125 1.125 1.125h1.5"/></svg>
                </div>
                <div class="dsb-text">
                    <strong>Layanan Pengantaran Toko Tersedia</strong>
                    <span>Ongkir flat <strong>Rp {{ number_format($store->delivery_fee ?? 5000, 0, ',', '.') }}</strong> (radius {{ $store->delivery_radius_km ?? 5 }} km) atau opsi <strong>Ambil di Tempat (Self-Pickup)</strong> bebas ongkir.</span>
                </div>
            @else
                <div class="dsb-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                </div>
                <div class="dsb-text">
                    <strong>Gerai Ini Khusus Ambil di Tempat (Self-Pickup)</strong>
                    <span>Pesanan akan disiapkan oleh gerai dan pembeli dapat mengambil langsung ke lokasi gerai fisik.</span>
                </div>
            @endif
        </div>
    </div>

    {{-- VOUCHER SPECIAL STRIP --}}
    @if(isset($vouchers) && $vouchers->count() > 0)
    <div class="store-voucher-strip">
        <div class="sv-header">
            <svg width="18" height="18" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
            <span>Kupon &amp; Voucher Belanja Spesial untuk Gerai Ini:</span>
        </div>
        <div class="sv-grid">
            @foreach($vouchers as $vc)
                <div class="sv-ticket">
                    <div class="sv-ticket-left">
                        <span class="sv-code">{{ $vc->code }}</span>
                        <span class="sv-title">{{ $vc->title }}</span>
                        <span class="sv-desc">{{ $vc->description }}</span>
                    </div>
                    <button type="button" class="btn-claim-voucher" onclick="claimVoucherDirect('{{ $vc->code }}')">
                        Klaim
                    </button>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- CATALOG FILTER & SEARCH BAR --}}
    <div class="catalog-control-panel">
        <div class="search-box-store">
            <svg width="18" height="18" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="storeSearchInput" placeholder="Cari produk di {{ $store->name }}..." onkeyup="filterStoreCatalog()">
        </div>

        @php
            $storeCategories = $store->products->pluck('category')->unique()->filter()->values();
        @endphp
        <div class="category-pills-row">
            <button type="button" class="cat-filter-btn active" data-cat="all" onclick="selectCategoryFilter(this, 'all')">
                Semua Produk ({{ $store->products->count() }})
            </button>
            @foreach($storeCategories as $cat)
                <button type="button" class="cat-filter-btn" data-cat="{{ $cat }}" onclick="selectCategoryFilter(this, '{{ $cat }}')">
                    {{ $cat }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- PRODUCT CATALOG GRID --}}
    <div class="products-catalog-section">
        <div class="catalog-header-row">
            <h2 class="catalog-heading">Katalog Menu &amp; Produk Gerai</h2>
            <span class="catalog-sub" id="productCountLabel">Menampilkan {{ $store->products->count() }} pilihan produk</span>
        </div>

        <div class="shopee-products-grid" id="shopeeProductsGrid">
            @forelse($store->products as $p)
                @php
                    $prodImg = $p->image_url ?: 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=500&auto=format&fit=crop&q=80';
                @endphp
                <div class="shopee-card" data-id="{{ $p->id }}" data-category="{{ $p->category }}" data-name="{{ strtolower($p->name) }}">
                    <div class="shopee-thumb-wrap">
                        <img src="{{ $prodImg }}" alt="{{ $p->name }}" class="shopee-card-img" loading="lazy">
                        <span class="cat-chip-overlay">{{ $p->category }}</span>
                    </div>

                    <div class="shopee-card-body">
                        <h3 class="shopee-prod-title" title="{{ $p->name }}">{{ $p->name }}</h3>
                        <div class="shopee-stock-badge">
                            <span class="stock-dot"></span>
                            <span>Stok: {{ $p->current_stock }} unit tersedia</span>
                        </div>
                        <div class="shopee-price-row">
                            <div class="shopee-price">
                                <span class="cur">Rp</span>
                                <span class="val">{{ number_format($p->selling_price, 0, ',', '.') }}</span>
                            </div>
                            <button type="button" class="btn-buy-shopee" onclick="addToStoreCart({{ $p->id }}, '{{ addslashes($p->name) }}', {{ $p->selling_price }}, {{ $p->current_stock }}, '{{ $prodImg }}')">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                <span>Pesan</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-store-card">
                    <svg width="48" height="48" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <h3>Belum ada produk aktif</h3>
                    <p>Gerai ini sedang memperbarui daftar inventaris produknya. Silakan cek kembali nanti.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- FLOATING CART CHECKOUT BAR --}}
<div id="storeFloatingCart" class="store-floating-cart" style="display: none;">
    <div class="floating-cart-inner">
        <div class="cart-left-summary">
            <div class="cart-badge-circle">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <span id="floatingCartCount" class="count-badge">0</span>
            </div>
            <div>
                <div class="cart-total-lbl">Total Pembelian:</div>
                <div class="cart-total-price" id="floatingCartTotal">Rp 0</div>
            </div>
        </div>
        <button type="button" class="btn-checkout-now" onclick="openStoreCheckoutModal()">
            <span>Lanjut Pembayaran</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </div>
</div>

{{-- CHECKOUT PEMESANAN MODAL --}}
<div id="storeCheckoutModal" class="modal-backdrop-checkout">
    <div class="modal-checkout-card">
        <div class="modal-checkout-header">
            <div>
                <h3 class="checkout-title">Konfirmasi &amp; Pembayaran Pesanan</h3>
                <p class="checkout-store-name">{{ $store->name }} &bull; Mitra Resmi</p>
            </div>
            <button type="button" class="btn-close-modal" onclick="closeStoreCheckoutModal()">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('user.checkout') }}" method="POST" id="storeCheckoutForm">
            @csrf
            <input type="hidden" name="store_id" value="{{ $store->id }}">

            <div class="checkout-scroll-body">
                {{-- ITEM CART LIST --}}
                <div class="checkout-block">
                    <div class="cb-title">Daftar Produk yang Dipesan</div>
                    <div id="cartItemsContainer" class="cart-items-container">
                        {{-- Injected dynamically --}}
                    </div>
                </div>

                {{-- PILIHAN PENGIRIMAN --}}
                <div class="checkout-block">
                    <div class="cb-title">Metode Pengambilan / Pengantaran</div>
                    <div class="delivery-options-grid">
                        <label class="delivery-choice-card {{ $store->has_delivery ? '' : 'disabled' }}" id="optDeliveryCard">
                            <input type="radio" name="delivery_type" value="delivery" id="radioDelivery" {{ $store->has_delivery ? 'checked' : 'disabled' }} onchange="calculateStoreOrder()">
                            <div class="dcc-content">
                                <div class="dcc-top">
                                    <span class="dcc-name">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.948c0-.621-.504-1.125-1.125-1.125H4.125C3.504 5.5 3 6.004 3 6.625v10.5c0 .621.504 1.125 1.125 1.125h1.5"/></svg>
                                        Pengantaran Toko
                                    </span>
                                    <span class="dcc-fee">Rp {{ number_format($store->delivery_fee ?? 5000, 0, ',', '.') }}</span>
                                </div>
                                <p class="dcc-desc">Kurir gerai mengantarkan ke alamat tujuan (radius {{ $store->delivery_radius_km ?? 5 }} km).</p>
                            </div>
                        </label>

                        <label class="delivery-choice-card {{ !$store->has_delivery ? 'checked-default' : '' }}">
                            <input type="radio" name="delivery_type" value="pickup" id="radioPickup" {{ !$store->has_delivery ? 'checked' : '' }} onchange="calculateStoreOrder()">
                            <div class="dcc-content">
                                <div class="dcc-top">
                                    <span class="dcc-name">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                        Ambil di Gerai (Self-Pickup)
                                    </span>
                                    <span class="dcc-fee free">Bebas Ongkir</span>
                                </div>
                                <p class="dcc-desc">Ambil pesanan langsung ke lokasi: {{ $store->address ?? $store->location }}.</p>
                            </div>
                        </label>
                    </div>

                    {{-- ALAMAT & LOKASI PENGANTARAN INPUT --}}
                    <div id="addressInputWrap" style="margin-top: 14px; {{ $store->has_delivery ? '' : 'display: none;' }}">
                        <div class="form-group-field" style="margin-bottom: 10px;">
                            <label class="field-label">Alamat Jalan &amp; Nomor Rumah *</label>
                            <textarea name="delivery_address" id="deliveryAddressInput" rows="2" class="input-text-area" placeholder="Nama Jalan, Blok, RT/RW, No. Rumah..."></textarea>
                        </div>
                        <div class="form-row-two" style="margin-bottom: 10px;">
                            <div class="form-group-field">
                                <label class="field-label">Kecamatan / Wilayah</label>
                                <select name="delivery_district" id="deliveryDistrictSelect" class="input-text-field" style="height: 42px;">
                                    <option value="Coblong / Dago">Coblong / Dago (Bandung)</option>
                                    <option value="Sukajadi / Pasteur">Sukajadi / Pasteur (Bandung)</option>
                                    <option value="Lengkong">Lengkong (Bandung)</option>
                                    <option value="Tebet">Tebet (Jakarta Selatan)</option>
                                    <option value="Kebayoran Baru">Kebayoran Baru (Jakarta Selatan)</option>
                                    <option value="Gubeng">Gubeng (Surabaya)</option>
                                    <option value="Semarang Tengah">Semarang Tengah (Semarang)</option>
                                    <option value="Lainnya">Wilayah Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group-field">
                                <label class="field-label" style="display: flex; justify-content: space-between; align-items: center;">
                                    <span>Patokan Titik Lokasi</span>
                                    <button type="button" onclick="detectUserLocation()" style="background: none; border: none; color: #10B981; font-size: 11px; font-weight: 700; cursor: pointer; text-decoration: underline; padding: 0;">Deteksi GPS</button>
                                </label>
                                <input type="text" name="location_point" id="locationPointInput" class="input-text-field" placeholder="Misal: Seberang Masjid / Pagar Putih">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DATA PENERIMA --}}
                <div class="checkout-block">
                    <div class="cb-title">Informasi Penerima / Pembeli</div>
                    <div class="form-row-two">
                        <div class="form-group-field">
                            <label class="field-label">Nama Lengkap *</label>
                            <input type="text" name="customer_name" class="input-text-field" value="{{ auth()->user()->name ?? '' }}" required placeholder="Nama Anda">
                        </div>
                        <div class="form-group-field">
                            <label class="field-label">Nomor WhatsApp / HP *</label>
                            <input type="text" name="customer_phone" class="input-text-field" value="{{ auth()->user()->phone ?? '081234567890' }}" required placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                    <div class="form-group-field" style="margin-top: 10px;">
                        <label class="field-label">Catatan Tambahan untuk Gerai (Opsional)</label>
                        <input type="text" name="notes" class="input-text-field" placeholder="Contoh: Jangan terlalu pedas / tolong bungkus rapi">
                    </div>
                </div>

                {{-- METODE PEMBAYARAN: QRIS, TRANSFER BANK, TUNAI --}}
                <div class="checkout-block">
                    <div class="cb-title">Metode Pembayaran (Pengaturan Resmi Gerai)</div>
                    <div class="payment-options-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                        <label class="payment-choice-card">
                            <input type="radio" name="payment_method" value="qris" checked onchange="switchStorePayment('qris')">
                            <div class="pcc-content">
                                <div class="pcc-title">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"/></svg>
                                    QRIS Toko
                                </div>
                                <p class="pcc-sub">BCA, Mandiri, BRI, GoPay, OVO, Dana dll</p>
                            </div>
                        </label>

                        <label class="payment-choice-card">
                            <input type="radio" name="payment_method" value="bank" onchange="switchStorePayment('bank')">
                            <div class="pcc-content">
                                <div class="pcc-title">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5m-15 10.5V10.5M1.5 21h21"/></svg>
                                    Transfer Bank
                                </div>
                                <p class="pcc-sub">{{ $store->bank_name ?? 'Transfer Bank' }}</p>
                            </div>
                        </label>

                        <label class="payment-choice-card">
                            <input type="radio" name="payment_method" value="cash" onchange="switchStorePayment('cash')">
                            <div class="pcc-content">
                                <div class="pcc-title">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0 0h.75a.75.75 0 0 1 .75.75v.75m18-10.5v.75c0 .414.336.75.75.75h.75m0 0v8.25m0 0h-.75a.75.75 0 0 1-.75.75v.75m-15-12a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25h12a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 16.5 4.5h-12Zm4.5 6.75a2.25 2.25 0 1 0 4.5 0 2.25 2.25 0 0 0-4.5 0Z"/></svg>
                                    Tunai (COD / Pickup)
                                </div>
                                <p class="pcc-sub">Bayar langsung saat barang diterima</p>
                            </div>
                        </label>
                    </div>

                    {{-- QRIS REAL STORE DISPLAY --}}
                    <div id="qrisBoxContainer" class="qris-interactive-box" style="margin-top: 14px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 16px; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                        <div style="display: flex; justify-content: space-between; width: 100%; border-bottom: 1px solid #E2E8F0; padding-bottom: 6px;">
                            <span style="font-weight: 800; color: #DC2626; font-size: 13px;">QRIS STANDAR NASIONAL</span>
                            <span style="font-size: 11px; font-weight: 700; color: #0F172A;">{{ $store->name }}</span>
                        </div>
                        <img src="{{ $store->qris_image ?? 'https://images.unsplash.com/photo-1595079672139-545c6020c681?w=400&auto=format&fit=crop&q=80' }}" alt="QRIS {{ $store->name }}" style="width: 130px; height: 130px; object-fit: cover; border-radius: 10px; border: 1px solid #CBD5E1; margin: 6px 0;">
                        <div style="font-size: 11px; color: #64748B; text-align: center;">NMID: <strong>{{ $store->qris_nmid ?? 'ID1029384756' }}</strong></div>
                        <div style="font-size: 10px; color: #94A3B8; text-align: center;">Pindai QRIS menggunakan aplikasi M-Banking atau E-Wallet apa pun.</div>
                    </div>

                    {{-- TRANSFER BANK REAL STORE DISPLAY --}}
                    <div id="bankBoxContainer" style="display: none; margin-top: 14px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #E2E8F0; padding-bottom: 6px; margin-bottom: 10px;">
                            <span style="font-size: 10px; font-weight: 800; color: #1D4ED8; background: #EFF6FF; padding: 2px 7px; border-radius: 4px;">REKENING RESMI GERAI</span>
                            <span style="font-size: 13px; font-weight: 800; color: #0F172A;">{{ $store->bank_name ?? 'Bank BCA' }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 10px; padding: 10px 14px;">
                            <div>
                                <div style="font-size: 10px; color: #64748B;">Nomor Rekening:</div>
                                <div style="font-family: monospace; font-size: 16px; font-weight: 800; color: #0F172A;">{{ $store->bank_account_number ?? '7820-192-381' }}</div>
                                <div style="font-size: 11px; color: #64748B;">a.n. <strong>{{ $store->bank_account_name ?? ($store->owner_name ?? $store->name) }}</strong></div>
                            </div>
                            <button type="button" class="btn-copy-acc" style="background: #F1F5F9; border: 1px solid #CBD5E1; color: #0F172A; font-size: 11px; font-weight: 700; padding: 6px 12px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 4px;" onclick="copyStoreBankAcc('{{ $store->bank_account_number ?? '7820-192-381' }}')">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25"/></svg>
                                <span>Salin Rekening</span>
                            </button>
                        </div>
                    </div>

                    {{-- CASH DISPLAY --}}
                    <div id="cashBoxContainer" style="display: none; margin-top: 14px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 12px 16px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 22px; display: flex; align-items: center;">
                                <svg width="22" height="22" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0 0h.75a.75.75 0 0 1 .75.75v.75m18-10.5v.75c0 .414.336.75.75.75h.75m0 0v8.25m0 0h-.75a.75.75 0 0 1-.75.75v.75m-15-12a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25h12a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 16.5 4.5h-12Zm4.5 6.75a2.25 2.25 0 1 0 4.5 0 2.25 2.25 0 0 0-4.5 0Z"/></svg>
                            </span>
                            <div>
                                <div style="font-weight: 700; color: #0F172A; font-size: 12px;">Bayar Tunai di Tempat</div>
                                <div style="font-size: 11px; color: #64748B;">Siapkan uang pas saat barang diantar atau bayar di kasir saat mengambil di gerai fisik.</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- VOUCHER INPUT --}}
                <div class="checkout-block">
                    <div class="cb-title">Kupon Diskon &amp; Voucher</div>
                    <div class="voucher-input-group">
                        <input type="text" id="voucherCodeInput" name="voucher_code" placeholder="Ketik kode kupon (misal: GRATISONGKIR)" class="voucher-input">
                        <button type="button" class="btn-apply-voucher" onclick="applyStoreVoucher()">Terapkan</button>
                    </div>
                    <div id="voucherMessage" class="voucher-msg-pill" style="display: none;"></div>
                </div>

                {{-- RINGKASAN TAGIHAN --}}
                <div class="checkout-block summary-block">
                    <div class="cb-title">Rincian Pembayaran</div>
                    <div class="sum-row">
                        <span>Subtotal Item</span>
                        <strong id="sumSubtotal">Rp 0</strong>
                    </div>
                    <div class="sum-row">
                        <span>Biaya Pengantaran</span>
                        <strong id="sumDelivery">Rp 0</strong>
                    </div>
                    <div class="sum-row discount-row" id="rowDiscount" style="display: none;">
                        <span>Diskon Kupon</span>
                        <strong id="sumDiscount" class="text-green">-Rp 0</strong>
                    </div>
                    <div class="sum-total-row">
                        <span>Total Tagihan Akhir</span>
                        <span id="sumGrandTotal" class="grand-total-amount">Rp 0</span>
                    </div>
                </div>
            </div>

            <div class="modal-checkout-footer">
                <button type="button" class="btn-cancel-checkout" onclick="closeStoreCheckoutModal()">Batal</button>
                @auth
                    <button type="submit" class="btn-confirm-order">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Konfirmasi &amp; Buat Pesanan</span>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn-confirm-order" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center; background: #0B131B; color: #CCFF00; border: 1.5px solid #10B981; padding: 11px 22px; font-weight: 800; border-radius: 12px; gap: 8px;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                        <span>Masuk untuk Memesan &rarr;</span>
                    </a>
                @endauth
            </div>
        </form>
    </div>
</div>

<style>
    /* PAGE CONTAINER */
    .store-shopee-container {
        display: flex;
        flex-direction: column;
        gap: 22px;
        padding-bottom: 90px;
    }

    /* HERO BANNER & PROFILE */
    .store-hero-card {
        background: linear-gradient(135deg, #0B131B 0%, #152331 100%);
        border-radius: 20px;
        padding: 28px 32px;
        color: #FFFFFF;
        box-shadow: 0 10px 30px -5px rgba(11, 19, 27, 0.25);
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .store-hero-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .btn-back-market {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #94A3B8;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: color 0.15s;
    }
    .btn-back-market:hover { color: #10B981; }

    .store-badge-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .store-category-pill {
        background: rgba(255, 255, 255, 0.12);
        color: #E2E8F0;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 99px;
    }

    .store-status-pill {
        background: rgba(16, 185, 129, 0.18);
        border: 1px solid rgba(16, 185, 129, 0.35);
        color: #34D399;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 99px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .pulse-green {
        width: 7px;
        height: 7px;
        background: #10B981;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 8px #10B981;
    }

    .store-profile-flex {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .store-avatar-box {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
    }

    .verified-badge-mini {
        position: absolute;
        bottom: -4px;
        right: -4px;
        background: #FFFFFF;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .store-profile-main {
        flex: 1;
    }

    .store-name-row {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .store-name-title {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.02em;
        margin: 0;
    }

    .official-pill {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: #FFFFFF;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 3px 8px;
        border-radius: 6px;
    }

    .store-meta-owner {
        font-size: 13px;
        color: #94A3B8;
        margin-top: 4px;
    }

    .store-highlights-row {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 12px;
    }

    .hl-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        color: #CBD5E1;
    }

    .delivery-status-banner {
        border-radius: 12px;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .delivery-status-banner.status-delivery {
        background: rgba(16, 185, 129, 0.14);
        border: 1px solid rgba(16, 185, 129, 0.35);
        color: #D1FAE5;
    }

    .delivery-status-banner.status-pickup {
        background: rgba(245, 158, 11, 0.14);
        border: 1px solid rgba(245, 158, 11, 0.35);
        color: #FEF3C7;
    }

    .dsb-icon { font-size: 22px; flex-shrink: 0; }
    .dsb-text { font-size: 12.5px; line-height: 1.45; }
    .dsb-text strong { display: block; font-size: 13px; }

    /* VOUCHER STRIP */
    .store-voucher-strip {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 16px 20px;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03);
    }

    .sv-header {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 12px;
    }

    .sv-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 12px;
    }

    .sv-ticket {
        background: #F8FAFC;
        border: 1px dashed #CBD5E1;
        border-radius: 12px;
        padding: 10px 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .sv-ticket-left {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .sv-code {
        font-size: 12px;
        font-weight: 800;
        color: #10B981;
        letter-spacing: 0.05em;
    }

    .sv-title {
        font-size: 12px;
        font-weight: 700;
        color: #0F172A;
    }

    .sv-desc {
        font-size: 11px;
        color: #64748B;
    }

    .btn-claim-voucher {
        background: #10B981;
        color: #FFFFFF;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s;
        flex-shrink: 0;
    }
    .btn-claim-voucher:hover { background: #059669; transform: translateY(-1px); }

    /* CATALOG CONTROLS */
    .catalog-control-panel {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .search-box-store {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 0 16px;
        height: 48px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03);
    }

    .search-box-store input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 13.5px;
        font-family: inherit;
        color: #0F172A;
    }

    .category-pills-row {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 4px;
    }

    .cat-filter-btn {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        color: #475569;
        font-size: 12.5px;
        font-weight: 600;
        padding: 7px 16px;
        border-radius: 99px;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.15s;
    }

    .cat-filter-btn:hover {
        border-color: #10B981;
        color: #10B981;
    }

    .cat-filter-btn.active {
        background: #0F172A;
        color: #FFFFFF;
        border-color: #0F172A;
        font-weight: 700;
    }

    /* PRODUCTS CATALOG GRID */
    .catalog-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
    }

    .catalog-heading {
        font-size: 18px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.01em;
        margin: 0;
    }

    .catalog-sub {
        font-size: 12.5px;
        color: #64748B;
    }

    .shopee-products-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    .shopee-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 3px 8px rgba(15, 23, 42, 0.03);
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .shopee-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -5px rgba(15, 23, 42, 0.1);
        border-color: rgba(16, 185, 129, 0.4);
    }

    .shopee-thumb-wrap {
        width: 100%;
        height: 160px;
        position: relative;
        background: #F1F5F9;
        overflow: hidden;
    }

    .shopee-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .shopee-card:hover .shopee-card-img {
        transform: scale(1.05);
    }

    .cat-chip-overlay {
        position: absolute;
        bottom: 8px;
        left: 8px;
        background: rgba(15, 23, 42, 0.85);
        color: #FFFFFF;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 6px;
        backdrop-filter: blur(4px);
    }

    .shopee-card-body {
        padding: 14px;
        display: flex;
        flex-direction: column;
        flex: 1;
        justify-content: space-between;
        gap: 10px;
    }

    .shopee-prod-title {
        font-size: 14.5px;
        font-weight: 700;
        color: #0F172A;
        line-height: 1.35;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 38px;
    }

    .shopee-stock-badge {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11.5px;
        color: #64748B;
    }

    .stock-dot {
        width: 6px;
        height: 6px;
        background: #10B981;
        border-radius: 50%;
    }

    .shopee-price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #F1F5F9;
        padding-top: 10px;
    }

    .shopee-price {
        color: #0F172A;
        font-weight: 800;
    }

    .shopee-price .cur {
        font-size: 11.5px;
        color: #64748B;
    }

    .shopee-price .val {
        font-size: 16px;
    }

    .btn-buy-shopee {
        background: #10B981;
        color: #FFFFFF;
        border: none;
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.15s;
    }

    .btn-buy-shopee:hover {
        background: #059669;
        transform: scale(1.04);
    }

    .btn-buy-shopee:active {
        transform: scale(0.96);
    }

    .empty-store-card {
        grid-column: 1 / -1;
        background: #FFFFFF;
        border: 1px dashed #CBD5E1;
        border-radius: 16px;
        padding: 50px 20px;
        text-align: center;
        color: #64748B;
    }

    .empty-store-card h3 {
        margin: 12px 0 6px;
        color: #0F172A;
        font-size: 16px;
    }

    /* FLOATING BOTTOM CART BAR */
    .store-floating-cart {
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        width: calc(100% - 48px);
        max-width: 680px;
        background: #0B131B;
        border: 1px solid #10B981;
        border-radius: 18px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        padding: 12px 20px;
        z-index: 9999;
        animation: floatSlideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes floatSlideUp {
        from { transform: translate(-50%, 40px); opacity: 0; }
        to { transform: translate(-50%, 0); opacity: 1; }
    }

    .floating-cart-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-left-summary {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .cart-badge-circle {
        width: 44px;
        height: 44px;
        background: rgba(16, 185, 129, 0.2);
        color: #10B981;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .count-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #EF4444;
        color: #FFFFFF;
        font-size: 10px;
        font-weight: 800;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-total-lbl {
        font-size: 11px;
        color: #94A3B8;
        font-weight: 600;
    }

    .cart-total-price {
        font-size: 18px;
        font-weight: 800;
        color: #CCFF00;
    }

    .btn-checkout-now {
        background: #10B981;
        color: #FFFFFF;
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.15s;
    }

    .btn-checkout-now:hover {
        background: #059669;
        transform: translateY(-1px);
    }

    /* MODAL CHECKOUT */
    .modal-backdrop-checkout {
        position: fixed;
        inset: 0;
        background: rgba(11, 19, 27, 0.75);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 999999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-backdrop-checkout.active {
        display: flex;
    }

    .modal-checkout-card {
        background: #FFFFFF;
        border-radius: 20px;
        width: 100%;
        max-width: 580px;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        animation: modalScale 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
    }

    @keyframes modalScale {
        from { transform: scale(0.92); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .modal-checkout-header {
        padding: 20px 24px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .checkout-title {
        font-size: 17px;
        font-weight: 800;
        color: #0F172A;
        margin: 0;
    }

    .checkout-store-name {
        font-size: 12px;
        color: #10B981;
        font-weight: 700;
        margin-top: 2px;
    }

    .btn-close-modal {
        background: transparent;
        border: none;
        color: #94A3B8;
        cursor: pointer;
        padding: 4px;
        border-radius: 8px;
    }
    .btn-close-modal:hover { color: #0F172A; background: #F1F5F9; }

    .checkout-scroll-body {
        padding: 20px 24px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .checkout-block {
        border-bottom: 1px solid #F1F5F9;
        padding-bottom: 16px;
    }

    .checkout-block.summary-block {
        border-bottom: none;
        padding-bottom: 0;
    }

    .cb-title {
        font-size: 13px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 10px;
    }

    .cart-items-container {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .cart-item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #F8FAFC;
        border-radius: 10px;
        padding: 8px 12px;
    }

    .ci-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .ci-name {
        font-size: 13px;
        font-weight: 700;
        color: #0F172A;
    }

    .ci-price {
        font-size: 11.5px;
        color: #64748B;
    }

    .ci-controls {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-qty {
        width: 26px;
        height: 26px;
        border-radius: 6px;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
    }
    .btn-qty:hover { background: #F1F5F9; }

    .ci-qty-num {
        font-size: 13px;
        font-weight: 700;
        min-width: 18px;
        text-align: center;
    }

    /* DELIVERY & PAYMENT CHOICES */
    .delivery-options-grid, .payment-options-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .delivery-choice-card, .payment-choice-card {
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        padding: 12px;
        cursor: pointer;
        display: flex;
        gap: 10px;
        transition: all 0.15s;
    }

    .delivery-choice-card.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: #F8FAFC;
    }

    .delivery-choice-card:has(input:checked), .payment-choice-card:has(input:checked) {
        border-color: #10B981;
        background: rgba(16, 185, 129, 0.05);
    }

    .dcc-content, .pcc-content {
        flex: 1;
    }

    .dcc-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4px;
    }

    .dcc-name, .pcc-title {
        font-size: 12.5px;
        font-weight: 700;
        color: #0F172A;
    }

    .dcc-fee {
        font-size: 11px;
        font-weight: 700;
        color: #10B981;
    }

    .dcc-fee.free {
        color: #059669;
    }

    .dcc-desc, .pcc-sub {
        font-size: 11px;
        color: #64748B;
        line-height: 1.35;
        margin: 0;
    }

    .form-group-field {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .field-label {
        font-size: 11.5px;
        font-weight: 700;
        color: #475569;
    }

    .input-text-field, .input-text-area {
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 13px;
        font-family: inherit;
        outline: none;
    }
    .input-text-field:focus, .input-text-area:focus {
        border-color: #10B981;
    }

    .form-row-two {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    /* QRIS SIMULATOR */
    .qris-interactive-box {
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        border-radius: 12px;
        padding: 14px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .qris-box-header {
        display: flex;
        justify-content: space-between;
        width: 100%;
        font-size: 11px;
        font-weight: 700;
    }

    .qris-badge-official {
        color: #EF4444;
        letter-spacing: 0.05em;
    }

    .qris-status-live {
        color: #0284C7;
    }

    .qris-center {
        text-align: center;
    }

    .qris-image {
        width: 130px;
        height: 130px;
        border-radius: 8px;
        background: #FFFFFF;
        padding: 6px;
        border: 1px solid #E2E8F0;
    }

    .qris-desc {
        font-size: 11px;
        color: #64748B;
        margin-top: 6px;
    }

    /* VOUCHER INPUT */
    .voucher-input-group {
        display: flex;
        gap: 8px;
    }

    .voucher-input {
        flex: 1;
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 12.5px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .btn-apply-voucher {
        background: #0F172A;
        color: #FFFFFF;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }
    .btn-apply-voucher:hover { background: #1E293B; }

    .voucher-msg-pill {
        margin-top: 6px;
        font-size: 11.5px;
        padding: 6px 10px;
        border-radius: 6px;
    }
    .voucher-msg-pill.success {
        background: #ECFDF5;
        color: #059669;
        border: 1px solid #A7F3D0;
    }
    .voucher-msg-pill.error {
        background: #FEF2F2;
        color: #DC2626;
        border: 1px solid #FECACA;
    }

    /* SUMMARY */
    .sum-row {
        display: flex;
        justify-content: space-between;
        font-size: 12.5px;
        color: #64748B;
        margin-bottom: 5px;
    }

    .sum-row strong {
        color: #0F172A;
    }

    .sum-row.discount-row strong {
        color: #10B981;
    }

    .sum-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1.5px dashed #CBD5E1;
        padding-top: 10px;
        margin-top: 8px;
        font-size: 14px;
        font-weight: 800;
        color: #0F172A;
    }

    .grand-total-amount {
        font-size: 18px;
        color: #10B981;
    }

    .modal-checkout-footer {
        padding: 16px 24px;
        background: #F8FAFC;
        border-top: 1px solid #E2E8F0;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-cancel-checkout {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        color: #64748B;
        padding: 9px 18px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-confirm-order {
        background: #10B981;
        color: #FFFFFF;
        border: none;
        padding: 9px 22px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s;
    }
    .btn-confirm-order:hover {
        background: #059669;
        transform: translateY(-1px);
    }

    @media (max-width: 900px) {
        .shopee-products-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 600px) {
        .shopee-products-grid { grid-template-columns: 1fr; }
        .store-profile-flex { flex-direction: column; align-items: flex-start; }
        .delivery-options-grid, .payment-options-grid, .form-row-two { grid-template-columns: 1fr; }
    }
</style>

<script>
    // State Keranjang Belanja Toko Ini
    const storeData = {
        id: {{ $store->id }},
        name: "{{ addslashes($store->name) }}",
        has_delivery: {{ $store->has_delivery ? 'true' : 'false' }},
        delivery_fee: {{ $store->delivery_fee ?? 5000 }}
    };

    let storeCart = [];
    let appliedVoucher = null;

    // Filter Kategori Tab
    function selectCategoryFilter(btn, category) {
        document.querySelectorAll('.cat-filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const cards = document.querySelectorAll('.shopee-card');
        let count = 0;
        cards.forEach(card => {
            if (category === 'all' || card.getAttribute('data-category') === category) {
                card.style.display = 'flex';
                count++;
            } else {
                card.style.display = 'none';
            }
        });

        document.getElementById('productCountLabel').innerText = `Menampilkan ${count} pilihan produk`;
    }

    // Filter Pencarian Toko
    function filterStoreCatalog() {
        const query = document.getElementById('storeSearchInput').value.toLowerCase().trim();
        const activeCategory = document.querySelector('.cat-filter-btn.active').getAttribute('data-cat');
        const cards = document.querySelectorAll('.shopee-card');
        let count = 0;

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const category = card.getAttribute('data-category');
            const matchesCat = (activeCategory === 'all' || category === activeCategory);
            const matchesQuery = (!query || name.includes(query));

            if (matchesCat && matchesQuery) {
                card.style.display = 'flex';
                count++;
            } else {
                card.style.display = 'none';
            }
        });

        document.getElementById('productCountLabel').innerText = `Menampilkan ${count} pilihan produk`;
    }

    // Tambah Produk ke Keranjang Toko
    function addToStoreCart(productId, name, price, stock, imageUrl) {
        const existing = storeCart.find(item => item.id === productId);
        if (existing) {
            if (existing.qty >= stock) {
                larisAlert("Batas Stok Tercapai", `Maaf, persediaan untuk <strong>${name}</strong> hanya tersisa ${stock} unit.`, "warning");
                return;
            }
            existing.qty += 1;
        } else {
            storeCart.push({
                id: productId,
                name: name,
                price: price,
                qty: 1,
                stock: stock,
                img: imageUrl
            });
        }

        updateStoreFloatingCart();
        larisToast(`1x ${name} masuk ke keranjang belanja!`, 'success');
    }

    function changeCartItemQty(productId, delta) {
        const item = storeCart.find(i => i.id === productId);
        if (!item) return;

        item.qty += delta;
        if (item.qty <= 0) {
            storeCart = storeCart.filter(i => i.id !== productId);
        } else if (item.qty > item.stock) {
            item.qty = item.stock;
            larisAlert("Batas Stok", `Persediaan maksimal produk ini adalah ${item.stock} unit.`, "warning");
        }

        updateStoreFloatingCart();
        renderCartItemsModal();
        calculateStoreOrder();

        if (storeCart.length === 0) {
            closeStoreCheckoutModal();
        }
    }

    function updateStoreFloatingCart() {
        const bar = document.getElementById('storeFloatingCart');
        if (storeCart.length === 0) {
            bar.style.display = 'none';
            return;
        }

        bar.style.display = 'block';
        const totalCount = storeCart.reduce((sum, item) => sum + item.qty, 0);
        const totalPrice = storeCart.reduce((sum, item) => sum + (item.price * item.qty), 0);

        document.getElementById('floatingCartCount').innerText = totalCount;
        document.getElementById('floatingCartTotal').innerText = 'Rp ' + totalPrice.toLocaleString('id-ID');
    }

    // Buka Modal Checkout
    function openStoreCheckoutModal() {
        if (storeCart.length === 0) return;
        renderCartItemsModal();
        calculateStoreOrder();
        document.getElementById('storeCheckoutModal').classList.add('active');
    }

    function closeStoreCheckoutModal() {
        document.getElementById('storeCheckoutModal').classList.remove('active');
    }

    function renderCartItemsModal() {
        const container = document.getElementById('cartItemsContainer');
        container.innerHTML = '';

        storeCart.forEach((item, index) => {
            const row = document.createElement('div');
            row.className = 'cart-item-row';
            row.innerHTML = `
                <input type="hidden" name="items[${index}][product_id]" value="${item.id}">
                <input type="hidden" name="items[${index}][quantity]" value="${item.qty}">
                <div class="ci-info">
                    <span class="ci-name">${item.name}</span>
                    <span class="ci-price">Rp ${item.price.toLocaleString('id-ID')} &times; ${item.qty} = <strong>Rp ${(item.price * item.qty).toLocaleString('id-ID')}</strong></span>
                </div>
                <div class="ci-controls">
                    <button type="button" class="btn-qty" onclick="changeCartItemQty(${item.id}, -1)">&minus;</button>
                    <span class="ci-qty-num">${item.qty}</span>
                    <button type="button" class="btn-qty" onclick="changeCartItemQty(${item.id}, 1)">&plus;</button>
                </div>
            `;
            container.appendChild(row);
        });
    }

    function calculateStoreOrder() {
        const isDelivery = document.getElementById('radioDelivery') && document.getElementById('radioDelivery').checked;
        const addressWrap = document.getElementById('addressInputWrap');
        if (addressWrap) {
            addressWrap.style.display = isDelivery ? 'flex' : 'none';
        }

        const subtotal = storeCart.reduce((sum, item) => sum + (item.price * item.qty), 0);
        let deliveryFee = 0;
        if (isDelivery && storeData.has_delivery) {
            deliveryFee = storeData.delivery_fee;
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
        document.getElementById('sumDelivery').innerText = 'Rp ' + deliveryFee.toLocaleString('id-ID');
        
        const rowDiscount = document.getElementById('rowDiscount');
        if (discount > 0) {
            rowDiscount.style.display = 'flex';
            document.getElementById('sumDiscount').innerText = '-Rp ' + discount.toLocaleString('id-ID');
        } else {
            rowDiscount.style.display = 'none';
        }

        document.getElementById('sumGrandTotal').innerText = 'Rp ' + grandTotal.toLocaleString('id-ID');
    }

    function switchStorePayment(method) {
        const qrisBox = document.getElementById('qrisBoxContainer');
        const bankBox = document.getElementById('bankBoxContainer');
        const cashBox = document.getElementById('cashBoxContainer');
        if (qrisBox) qrisBox.style.display = (method === 'qris') ? 'flex' : 'none';
        if (bankBox) bankBox.style.display = (method === 'bank') ? 'block' : 'none';
        if (cashBox) cashBox.style.display = (method === 'cash') ? 'block' : 'none';
    }

    function copyStoreBankAcc(accNum) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(accNum).then(() => {
                larisToast(`Nomor rekening ${accNum} berhasil disalin!`, 'success');
            });
        } else {
            larisToast(`Nomor rekening ${accNum} berhasil disalin!`, 'success');
        }
    }

    // Klaim Kupon Langsung
    function claimVoucherDirect(code) {
        document.getElementById('voucherCodeInput').value = code;
        if (storeCart.length > 0) {
            openStoreCheckoutModal();
            applyStoreVoucher();
        } else {
            larisAlert("Kupon Tersalin!", `Voucher <strong>${code}</strong> telah disalin!<br><br>Silakan tambahkan produk ke keranjang belanja Anda, voucher akan otomatis diterapkan saat checkout.`, "success");
        }
    }

    // Terapkan Voucher
    function applyStoreVoucher() {
        const code = document.getElementById('voucherCodeInput').value.trim().toUpperCase();
        const msgEl = document.getElementById('voucherMessage');
        const subtotal = storeCart.reduce((sum, item) => sum + (item.price * item.qty), 0);

        if (!code) {
            msgEl.style.display = 'block';
            msgEl.className = 'voucher-msg-pill error';
            msgEl.innerText = 'Silakan ketikkan kode voucher.';
            return;
        }

        if (code === 'DISKON10K') {
            if (subtotal < 30000) {
                msgEl.style.display = 'block';
                msgEl.className = 'voucher-msg-pill error';
                msgEl.innerText = 'Minimal belanja untuk DISKON10K adalah Rp 30.000.';
                return;
            }
            appliedVoucher = { code: 'DISKON10K', type: 'fixed', val: 10000 };
        } else if (code === 'GRATISONGKIR') {
            appliedVoucher = { code: 'GRATISONGKIR', type: 'fixed', val: storeData.delivery_fee };
        } else if (code === 'FLASH50') {
            appliedVoucher = { code: 'FLASH50', type: 'percent', val: 50 };
        } else if (code === 'USERBARU') {
            if (subtotal < 40000) {
                msgEl.style.display = 'block';
                msgEl.className = 'voucher-msg-pill error';
                msgEl.innerText = 'Minimal belanja untuk USERBARU adalah Rp 40.000.';
                return;
            }
            appliedVoucher = { code: 'USERBARU', type: 'fixed', val: 15000 };
        } else {
            msgEl.style.display = 'block';
            msgEl.className = 'voucher-msg-pill error';
            msgEl.innerText = 'Kode kupon tidak valid atau telah kedaluwarsa.';
            appliedVoucher = null;
            calculateStoreOrder();
            return;
        }

        msgEl.style.display = 'block';
        msgEl.className = 'voucher-msg-pill success';
        msgEl.innerText = `Kupon ${code} berhasil dipasang! Potongan diskon telah dihitung.`;
        calculateStoreOrder();
    }

    function detectUserLocation() {
        if ('geolocation' in navigator) {
            if (typeof larisAlert === 'function') {
                larisAlert('Mendeteksi GPS', 'Menghubungkan ke sensor satelit GPS untuk menentukan titik koordinat Anda...', 'info');
            }
            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    const lat = pos.coords.latitude.toFixed(6);
                    const lng = pos.coords.longitude.toFixed(6);
                    const input = document.getElementById('locationPointInput');
                    if (input) {
                        input.value = `Koordinat: ${lat}, ${lng} (Akurat)`;
                    }
                    if (typeof larisAlert === 'function') {
                        larisAlert('GPS Terdeteksi', `Titik koordinat berhasil diterapkan: <strong>${lat}, ${lng}</strong>`, 'success');
                    }
                },
                function(err) {
                    const input = document.getElementById('locationPointInput');
                    if (input && !input.value) {
                        input.value = 'Depan Gerbang / Pos Satpam (Titik Akses Utama)';
                    }
                    if (typeof larisAlert === 'function') {
                        larisAlert('Titik Patokan Disiapkan', 'Izin GPS tidak diberikan. Silakan tulis patokan alamat Anda secara manual.', 'info');
                    }
                },
                { timeout: 7000 }
            );
        } else {
            alert('Browser tidak mendukung deteksi GPS.');
        }
    }

    // Validasi Form Checkout Sebelum Submit
    document.addEventListener('DOMContentLoaded', () => {
        const checkoutForm = document.getElementById('storeCheckoutForm');
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                const isDelivery = document.getElementById('radioDelivery') && document.getElementById('radioDelivery').checked;
                const address = document.getElementById('deliveryAddressInput') ? document.getElementById('deliveryAddressInput').value.trim() : '';
                
                if (isDelivery && !address) {
                    e.preventDefault();
                    larisAlert("Alamat Pengantaran Wajib Diisi", "Anda memilih metode <strong>Pengantaran Toko</strong>. Harap cantumkan alamat pengantaran lengkap Anda agar kurir gerai dapat mengantarkan pesanan.", "warning");
                    return false;
                }
            });
        }
    });
</script>
@endsection
