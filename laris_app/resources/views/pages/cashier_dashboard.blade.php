@extends('layouts.app', ['title' => 'Dashboard Kasir & Smart POS - LARIS'])

@push('styles')
<style>
    .pos-top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
        border: 1px solid #334155;
        border-radius: 16px;
        padding: 20px 24px;
        color: #FFFFFF;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.08);
    }
    .pos-main-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.55fr) minmax(360px, 1fr);
        gap: 20px;
        align-items: start;
    }
    .pos-catalog-panel {
        padding: 20px;
        display: flex;
        flex-direction: column;
    }
    .pos-cart-panel {
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: sticky;
        top: 80px;
        max-height: calc(100vh - 100px);
        overflow-y: auto;
    }
    .category-chip {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        border: 1px solid #E2E8F0;
        background: #FFFFFF;
        color: #475569;
        white-space: nowrap;
        transition: all 0.2s ease;
    }
    .category-chip:hover, .category-chip.active {
        background: #0F172A;
        color: #34D399;
        border-color: #0F172A;
    }
    .product-card {
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        background: #FFFFFF;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.25s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .product-card:hover {
        border-color: #10B981;
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(16, 185, 129, 0.12);
    }
    .product-img-box {
        width: 100%;
        height: 110px;
        background: #F1F5F9;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .product-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .quick-nominal-btn {
        background: #F1F5F9;
        border: 1px solid #CBD5E1;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        color: #334155;
        padding: 7px 6px;
        cursor: pointer;
        transition: all 0.15s;
        text-align: center;
    }
    .quick-nominal-btn:hover {
        background: #0F172A;
        color: #34D399;
        border-color: #0F172A;
    }
    .voice-pulse {
        animation: voicePulse 1.4s infinite;
    }
    @keyframes voicePulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.08); opacity: 0.85; }
        100% { transform: scale(1); opacity: 1; }
    }

    /* POS Mobile Tab Switcher */
    .pos-mobile-tabs {
        display: none;
        gap: 8px;
        background: #F1F5F9;
        padding: 6px;
        border-radius: 14px;
        border: 1px solid #E2E8F0;
    }
    .pos-tab-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 10px;
        border: none;
        background: transparent;
        color: #64748B;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .pos-tab-btn.active {
        background: #0F172A;
        color: #34D399;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.15);
    }
    .pos-tab-badge {
        background: #10B981;
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 9999px;
    }

    /* Floating Cart Checkout Bar for Mobile */
    .pos-floating-bar {
        display: none;
        position: fixed;
        bottom: 16px;
        left: 16px;
        right: 16px;
        z-index: 990;
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
        border: 1.5px solid #10B981;
        border-radius: 16px;
        padding: 12px 18px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        cursor: pointer;
        animation: floatSlideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes floatSlideUp {
        from { transform: translateY(100px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .pos-float-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .pos-float-badge {
        background: rgba(16, 185, 129, 0.25);
        color: #34D399;
        border: 1px solid #10B981;
        font-size: 11px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 20px;
    }
    .pos-float-total {
        font-size: 16px;
        font-weight: 800;
        color: #FFFFFF;
    }
    .pos-float-btn {
        background: #CCFF00;
        color: #000000;
        border: none;
        padding: 9px 15px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }

    /* Responsive POS Layout Breakpoints */
    @media (min-width: 961px) {
        .pos-mobile-tabs {
            display: none !important;
        }
        .pos-floating-bar {
            display: none !important;
        }
        .pos-catalog-panel,
        .pos-cart-panel {
            display: flex !important;
        }
    }
    @media (max-width: 1200px) and (min-width: 961px) {
        .pos-main-grid {
            grid-template-columns: minmax(0, 1.25fr) minmax(340px, 390px);
            gap: 16px;
        }
        .pos-top-bar {
            padding: 16px 20px;
        }
    }
    @media (max-width: 960px) {
        .pos-top-bar {
            flex-direction: column;
            align-items: stretch;
            gap: 14px;
            padding: 16px;
        }
        .pos-top-bar > div:last-child {
            text-align: left !important;
            border-top: 1px solid #334155;
            padding-top: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .pos-mobile-tabs {
            display: flex !important;
            margin-bottom: 4px;
        }
        .pos-main-grid {
            display: block !important;
        }
        .pos-cart-panel {
            position: static !important;
            max-height: none !important;
            overflow-y: visible !important;
            display: none;
            margin-bottom: 85px;
            width: 100% !important;
        }
        .pos-catalog-panel {
            display: block;
            margin-bottom: 85px;
            width: 100% !important;
        }
    }
    @media (max-width: 580px) {
        #productGrid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 10px !important;
        }
        .product-img-box {
            height: 95px !important;
        }
        .product-card {
            border-radius: 10px !important;
        }
        .quick-nominal-btn {
            flex: 1 1 calc(33.3% - 6px) !important;
        }
    }
    @media (max-width: 380px) {
        #productGrid {
            grid-template-columns: 1fr !important;
        }
        .product-img-box {
            height: 120px !important;
        }
    }
    @media print {
        body * {
            visibility: hidden;
        }
        #printableReceipt, #printableReceipt * {
            visibility: visible;
        }
        #printableReceipt {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 10px;
        }
    }
</style>
@endpush

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">

    <!-- TOP BAR KASIR -->
    <div class="pos-top-bar">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(16, 185, 129, 0.2); color: #34D399; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px; margin-bottom: 8px; border: 1px solid rgba(16, 185, 129, 0.3);">
                <span style="width: 7px; height: 7px; background: #34D399; border-radius: 50%;"></span>
                <span>SMART POS KASIR • OFFLINE SYNC READY</span>
            </div>
            <h1 style="font-size: 22px; font-weight: 800; color: #FFFFFF; margin: 0 0 4px 0;">Terminal Kasir Pintar (Smart POS)</h1>
            <p style="color: #CBD5E1; font-size: 13px; margin: 0;">
                Gerai: <strong>{{ $store->name ?? 'Toko Berkah Utama' }}</strong> • Shift Aktif: <strong>{{ auth()->user()->name ?? 'Kasir Bertugas' }}</strong>
            </p>
        </div>
        <div style="text-align: right;">
            <span style="font-size: 11px; color: #94A3B8; text-transform: uppercase; font-weight: 700;">Omzet Kasir Hari Ini</span>
            <h2 style="font-size: 26px; font-weight: 800; color: #34D399; margin: 4px 0;">Rp {{ number_format($todayTotal, 0, ',', '.') }}</h2>
            <span style="font-size: 12px; color: #CBD5E1;">{{ $todayCount }} Struk Transaksi Selesai</span>
        </div>
    </div>

    <!-- POS MOBILE TABS BAR (<= 960px) -->
    <div class="pos-mobile-tabs" id="posMobileTabs">
        <button type="button" class="pos-tab-btn active" id="tabBtnCatalog" onclick="switchPosTab('catalog')">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
            <span>1. Katalog Produk</span>
        </button>
        <button type="button" class="pos-tab-btn" id="tabBtnCart" onclick="switchPosTab('cart')">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
            <span>2. Struk &amp; Bayar</span>
            <span class="pos-tab-badge" id="tabCartCount">0</span>
        </button>
    </div>

    <!-- MAIN GRID KASIR -->
    <div class="pos-main-grid">
        
        <!-- KATALOG PRODUK -->
        <div class="card-panel pos-catalog-panel" id="posCatalogContainer">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 12px;">
                <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; display: flex; align-items: center; gap: 8px; margin: 0;">
                    <svg width="20" height="20" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                    <span>Katalog Produk Siap Jual</span>
                </h3>
                <span id="productCountBadge" style="font-size: 12px; font-weight: 700; color: #64748B; background: #F1F5F9; padding: 4px 10px; border-radius: 12px;">
                    {{ count($products) }} Produk Aktif
                </span>
            </div>

            <!-- SEARCH & FILTER SENSITIF -->
            <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px;">
                <div style="position: relative;">
                    <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94A3B8;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                    </span>
                    <input type="text" id="posSearchInput" onkeyup="filterProducts()" placeholder="Cari nama produk, SKU, atau barcode secara sensitif..." style="width: 100%; padding: 11px 14px 11px 42px; border: 1.5px solid #E2E8F0; border-radius: 10px; font-size: 13px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#10B981'" onblur="this.style.borderColor='#E2E8F0'">
                </div>

                <!-- CATEGORY CHIPS -->
                <div style="display: flex; gap: 8px; overflow-x: auto; padding-bottom: 6px;" id="categoryFilterContainer">
                    <button type="button" class="category-chip active" onclick="setCategoryFilter('all', this)">Semua Kategori</button>
                    @php
                        $uniqueCategories = $products->pluck('category')->unique()->filter();
                    @endphp
                    @foreach($uniqueCategories as $cat)
                        <button type="button" class="category-chip" onclick="setCategoryFilter('{{ addslashes($cat) }}', this)">{{ $cat }}</button>
                    @endforeach
                </div>
            </div>

            <!-- PRODUCT GRID -->
            <div id="productGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 14px; max-height: 520px; overflow-y: auto; padding-right: 4px;">
                @foreach($products as $prod)
                    <div class="product-card product-item" data-id="{{ $prod->id }}" data-name="{{ strtolower($prod->name) }}" data-sku="{{ strtolower($prod->sku) }}" data-category="{{ $prod->category }}" data-price="{{ $prod->selling_price }}" data-stock="{{ $prod->current_stock }}">
                        <div class="product-img-box">
                            @if(!empty($prod->image_url))
                                <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" loading="lazy">
                            @else
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 4px; color: #94A3B8;">
                                    <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                                    <span style="font-size: 10px; font-weight: 600;">LARIS Produk</span>
                                </div>
                            @endif
                            <span style="position: absolute; top: 6px; left: 6px; background: rgba(15, 23, 42, 0.75); color: #FFFFFF; font-size: 9px; font-weight: 700; padding: 2px 6px; border-radius: 4px;">{{ $prod->category }}</span>
                        </div>
                        <div style="padding: 12px; display: flex; flex-direction: column; justify-content: space-between; flex: 1;">
                            <div>
                                <span style="font-size: 10px; color: #64748B; font-weight: 600;">SKU: {{ $prod->sku }}</span>
                                <h4 style="font-size: 13px; font-weight: 700; margin: 3px 0 6px 0; color: #0F172A; line-height: 1.35; height: 34px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    {{ $prod->name }}
                                </h4>
                                <div style="font-size: 14px; font-weight: 800; color: #10B981;">Rp {{ number_format($prod->selling_price, 0, ',', '.') }}</div>
                                <span style="font-size: 11px; color: {{ $prod->current_stock <= 10 ? '#EF4444' : '#64748B' }}; font-weight: 600;">
                                    Sisa: <strong>{{ $prod->current_stock }} unit</strong>
                                </span>
                            </div>
                            <button type="button" onclick="quickAdd({{ $prod->id }}, '{{ addslashes($prod->name) }}', {{ $prod->selling_price }}, {{ $prod->current_stock }})" style="margin-top: 10px; width: 100%; background: #0F172A; color: #34D399; border: 1px solid #1E293B; padding: 8px; border-radius: 8px; font-weight: 700; font-size: 12px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.2s;" onmouseover="this.style.background='#10B981'; this.style.color='#FFFFFF'" onmouseout="this.style.background='#0F172A'; this.style.color='#34D399'">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                <span>Tambah</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="noProductsFound" style="display: none; text-align: center; padding: 40px 10px; color: #94A3B8;">
                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin: 0 auto 10px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                <p style="font-size: 14px; font-weight: 700; color: #475569; margin: 0;">Produk tidak ditemukan</p>
                <p style="font-size: 12px; margin: 4px 0 0 0;">Coba ubah kata kunci pencarian atau ganti kategori.</p>
            </div>
        </div>

        <!-- STRUK CHECKOUT KASIR -->
        <div class="card-panel pos-cart-panel" id="posCartContainer">
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                    <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; display: flex; align-items: center; gap: 8px; margin: 0;">
                        <svg width="18" height="18" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                        <span>Struk Kasir Aktif</span>
                    </h3>
                    <button type="button" onclick="clearCart()" style="background: none; border: none; font-size: 11px; font-weight: 700; color: #EF4444; cursor: pointer; display: flex; align-items: center; gap: 4px;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                        <span>Kosongkan</span>
                    </button>
                </div>

                <!-- CART ITEMS CONTAINER -->
                <div id="cartItems" style="display: flex; flex-direction: column; gap: 10px; max-height: 260px; overflow-y: auto; margin-bottom: 16px; padding-right: 4px;">
                    <div id="emptyCartText" style="text-align: center; color: #94A3B8; font-size: 13px; padding: 28px 0;">
                        <svg width="36" height="36" fill="none" stroke="#CBD5E1" viewBox="0 0 24 24" style="margin: 0 auto 8px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                        <p style="margin: 0; font-weight: 600;">Belum ada produk di struk kasir.</p>
                        <p style="margin: 4px 0 0 0; font-size: 11px;">Klik "Tambah" di katalog atau gunakan tombol suara di bawah.</p>
                    </div>
                </div>
            </div>

            <!-- PAYMENT & VOICE CONTROLS -->
            <div style="border-top: 1px solid #E2E8F0; padding-top: 14px;">
                
                <!-- VOICE-TO-RECEIPT (MULTI-DIALEK) -->
                <div style="margin-bottom: 14px; background: #0E161A; border: 1px solid #1E2D33; border-radius: 12px; padding: 12px 14px; color: #FFFFFF;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div id="micIndicator" style="width: 32px; height: 32px; border-radius: 50%; background: #1E2D33; display: flex; align-items: center; justify-content: center; color: #34D399;">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v7.5a3 3 0 0 1-3 3Z"/></svg>
                            </div>
                            <div>
                                <span style="font-size: 12px; font-weight: 700; color: #FFFFFF; display: block;">Voice-to-Receipt (Multi-Dialek)</span>
                                <span id="voiceStatusText" style="font-size: 10.5px; color: #94A3B8;">Siap deteksi: Sunda, Jawa, Melayu & Indonesia</span>
                            </div>
                        </div>
                        <button type="button" id="btnStartVoice" onclick="toggleVoiceOrder()" style="background: #CCFF00; color: #000000; border: none; font-size: 11px; font-weight: 800; padding: 6px 12px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 5px;">
                            <span>Mulai Rekam</span>
                        </button>
                    </div>

                    <!-- QUICK DIALECT BUTTONS -->
                    <div style="margin-top: 8px; padding-top: 6px; border-top: 1px dashed #1E2D33; display: flex; gap: 6px; flex-wrap: wrap;">
                        <span style="font-size: 10px; color: #64748B; align-self: center;">Simulasi Suara:</span>
                        <button type="button" onclick="simulateDialectPhrase('Kopi Arabica satu')" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); color: #CBD5E1; font-size: 10px; padding: 3px 8px; border-radius: 6px; cursor: pointer;">"Kopi Arabica 1"</button>
                        <button type="button" onclick="simulateDialectPhrase('Pensil Labubu dua ya mang')" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); color: #CBD5E1; font-size: 10px; padding: 3px 8px; border-radius: 6px; cursor: pointer;">"Pensil Labubu 2 mang"</button>
                        <button type="button" onclick="simulateDialectPhrase('Susu UHT tiga bungkus')" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); color: #CBD5E1; font-size: 10px; padding: 3px 8px; border-radius: 6px; cursor: pointer;">"Susu UHT 3 bungkus"</button>
                    </div>
                </div>

                <!-- METODE PEMBAYARAN -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <label for="payMethod" style="color: #475569; font-size: 12px; font-weight: 700;">Metode Pembayaran:</label>
                    <select id="payMethod" onchange="handlePayMethodChange()" style="background: #F8FAFC; border: 1.5px solid #CBD5E1; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; color: #0F172A; outline: none;">
                        <option value="Tunai">Tunai / Cash</option>
                        <option value="QRIS">QRIS Statis/Dinamis</option>
                        <option value="Kasbon">Catat Kasbon (AI Credit Risk)</option>
                        <option value="Debit">Kartu Debit</option>
                    </select>
                </div>

                <!-- CASH (TUNAI) PANEL -->
                <div id="cashPanel" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 12px; margin-bottom: 12px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <span style="font-size: 11px; font-weight: 700; color: #334155;">Uang Tunai Diterima:</span>
                        <span id="cashChangeDisplay" style="font-size: 11px; font-weight: 800; color: #10B981;">Kembalian: Rp 0</span>
                    </div>
                    <div style="position: relative; margin-bottom: 8px;">
                        <span style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); font-weight: 800; font-size: 13px; color: #64748B;">Rp</span>
                        <input type="number" id="cashReceivedInput" oninput="calculateChange()" placeholder="0" style="width: 100%; padding: 8px 10px 8px 34px; border: 1.5px solid #CBD5E1; border-radius: 8px; font-size: 14px; font-weight: 800; color: #0F172A; outline: none;">
                    </div>
                    <!-- Quick Nominal Buttons -->
                    <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                        <button type="button" class="quick-nominal-btn" onclick="setCashNominal('exact')">Uang Pas</button>
                        <button type="button" class="quick-nominal-btn" onclick="setCashNominal(20000)">20.000</button>
                        <button type="button" class="quick-nominal-btn" onclick="setCashNominal(50000)">50.000</button>
                        <button type="button" class="quick-nominal-btn" onclick="setCashNominal(100000)">100.000</button>
                        <button type="button" class="quick-nominal-btn" onclick="setCashNominal(200000)">200.000</button>
                    </div>
                </div>

                <!-- QRIS MODAL / PREVIEW BOX -->
                <div id="qrisPanel" style="display: none; background: #ECFDF5; border: 1.5px solid #10B981; border-radius: 12px; padding: 14px; margin-bottom: 12px; text-align: center;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <span style="font-size: 12px; font-weight: 800; color: #065F46;">SCAN QRIS PEMBAYARAN GERAI</span>
                        <button type="button" onclick="closeQrisPanel()" style="background: none; border: none; font-size: 11px; font-weight: 700; color: #065F46; cursor: pointer;">Tutup [x]</button>
                    </div>
                    <div style="display: inline-block; background: #FFFFFF; padding: 10px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 8px;">
                        @if(!empty($store->qris_image))
                            <img src="{{ $store->qris_image }}" alt="QRIS Gerai {{ $store->name }}" style="width: 170px; height: 170px; object-fit: contain;">
                        @else
                            <div style="width: 170px; height: 170px; display: flex; flex-direction: column; align-items: center; justify-content: center; background: #F1F5F9; border-radius: 8px; color: #64748B;">
                                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"/></svg>
                                <span style="font-size: 11px; margin-top: 6px;">QRIS Belum Diunggah</span>
                            </div>
                        @endif
                    </div>
                    <p style="font-size: 11px; color: #047857; margin: 0; font-weight: 600;">
                        {{ $store->name ?? 'Toko Berkah Utama' }} • NMID: {{ $store->qris_nmid ?? 'ID1020039201940' }}
                    </p>
                    <span style="font-size: 10px; color: #065F46;">Mendukung BCA, Mandiri, BRI, BNI, GoPay, OVO, Dana, ShopeePay</span>
                </div>

                <!-- SMART KASBON PANEL -->
                <div id="kasbonPanel" style="display: none; background: #FEF3C7; border: 1px solid #FCD34D; border-radius: 10px; padding: 12px; margin-bottom: 12px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                        <strong style="font-size: 11px; color: #92400E; text-transform: uppercase;">Buku Kasbon Cerdas (Buku Utang)</strong>
                        <span id="kasbonScoreBadge" style="background: #16A34A; color: #FFFFFF; font-size: 9px; font-weight: 800; padding: 2px 6px; border-radius: 4px;">Skor 94% (AMAN)</span>
                    </div>
                    <div style="margin-bottom: 8px;">
                        <label style="font-size: 11px; color: #78350F; font-weight: 600; display: block; margin-bottom: 4px;">Nama Pelanggan:</label>
                        <select id="kasbonCustomer" onchange="updateKasbonCustomer()" style="width: 100%; background: #FFFFFF; border: 1px solid #D97706; padding: 6px; border-radius: 6px; font-size: 12px;">
                            @foreach($kasbonCustomers ?? [] as $kc)
                                <option value="{{ $kc['name'] }}" data-phone="{{ $kc['phone'] }}" data-score="{{ $kc['score'] }}" data-status="{{ $kc['status'] }}" data-limit="{{ $kc['limit'] }}" data-debt="{{ $kc['current_debt'] }}">
                                    {{ $kc['name'] }} (Skor AI: {{ $kc['score'] }}% - {{ $kc['status'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="kasbonDetails" style="font-size: 11px; color: #92400E; line-height: 1.4;">
                        Plafon Utang Maksimal: <strong>Rp 350.000</strong> • Utang Berjalan: <strong>Rp 45.000</strong>
                    </div>
                </div>

                <!-- TOTAL & SUBMIT -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                    <span style="font-size: 14px; font-weight: 700; color: #475569;">Total Tagihan:</span>
                    <strong id="cartTotal" style="font-size: 22px; font-weight: 800; color: #10B981;">Rp 0</strong>
                </div>

                <button onclick="submitCheckout()" id="btnSubmitCheckout" style="width: 100%; background: #CCFF00; color: #000000; border: none; padding: 14px; border-radius: 12px; font-size: 14px; font-weight: 800; cursor: pointer; box-shadow: 0 4px 14px rgba(204, 255, 0, 0.3); display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.2s;">
                    <span>PROSES BAYAR (F8)</span>
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                </button>
            </div>
        </div>

    </div>

    <!-- FLOATING QUICK CHECKOUT BAR FOR MOBILE (<= 960px) -->
    <div class="pos-floating-bar" id="posFloatingBar" onclick="switchPosTab('cart')">
        <div class="pos-float-info">
            <span class="pos-float-badge" id="posFloatBadge">0 Item</span>
            <div>
                <span style="font-size: 10px; color: #94A3B8; display: block; font-weight: 600;">Total Tagihan:</span>
                <span class="pos-float-total" id="posFloatTotal">Rp 0</span>
            </div>
        </div>
        <button type="button" class="pos-float-btn">
            <span>Lanjut Bayar</span>
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
        </button>
    </div>

</div>

<!-- STRUK THERMAL MODAL POPUP -->
<div id="receiptModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #FFFFFF; border-radius: 16px; max-width: 400px; width: 100%; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2); overflow: hidden; max-height: 90vh; display: flex; flex-direction: column;">
        <div style="padding: 14px 18px; background: #0F172A; color: #FFFFFF; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" fill="none" stroke="#34D399" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                <span style="font-weight: 700; font-size: 13px;">Transaksi Berhasil</span>
            </div>
            <button type="button" onclick="closeReceiptModal()" style="background: none; border: none; color: #94A3B8; font-size: 16px; cursor: pointer;">&times;</button>
        </div>

        <!-- PRINTABLE RECEIPT CONTENT -->
        <div id="printableReceipt" style="padding: 20px; overflow-y: auto; font-family: monospace; font-size: 12px; color: #0F172A; background: #FAFAFA;">
            <div style="text-align: center; border-bottom: 1px dashed #CBD5E1; padding-bottom: 10px; margin-bottom: 10px;">
                <h3 id="rcStoreName" style="margin: 0; font-size: 15px; font-weight: 800; text-transform: uppercase;">{{ $store->name ?? 'TOKO BERKAH UTAMA' }}</h3>
                <p id="rcStoreAddress" style="margin: 4px 0 0; font-size: 10.5px; color: #475569;">{{ $store->address ?? 'Jl. Braga No. 45, Bandung' }}</p>
                <p id="rcStorePhone" style="margin: 2px 0 0; font-size: 10.5px; color: #475569;">Telp: {{ $store->phone ?? '0812-3456-7890' }}</p>
            </div>

            <div style="display: flex; justify-content: space-between; font-size: 10.5px; margin-bottom: 4px;">
                <span>No: <strong id="rcOrderNumber">ORD-POS-...</strong></span>
                <span id="rcOrderDate">18/10/2026</span>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 10.5px; margin-bottom: 8px;">
                <span>Kasir: {{ auth()->user()->name ?? 'Rian Kasir' }}</span>
                <span>Metode: <strong id="rcPaymentMethod">Tunai</strong></span>
            </div>

            <div style="border-top: 1px dashed #CBD5E1; border-bottom: 1px dashed #CBD5E1; padding: 8px 0; margin-bottom: 8px;">
                <div id="rcItemsList" style="display: flex; flex-direction: column; gap: 6px;">
                    <!-- Items rendered dynamically -->
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; font-size: 11px; margin-bottom: 3px;">
                <span>Subtotal:</span>
                <strong id="rcSubtotal">Rp 0</strong>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 11px; margin-bottom: 3px;">
                <span>Bayar:</span>
                <span id="rcCashReceived">Rp 0</span>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 800; border-top: 1px dashed #CBD5E1; padding-top: 4px; margin-top: 4px;">
                <span>Kembalian:</span>
                <span id="rcChangeAmount" style="color: #10B981;">Rp 0</span>
            </div>

            <div style="text-align: center; margin-top: 14px; padding-top: 10px; border-top: 1px dashed #CBD5E1; font-size: 10px; color: #64748B;">
                <p style="margin: 0; font-weight: 700; color: #0F172A;">Terima Kasih Telah Berbelanja!</p>
                <p style="margin: 3px 0 0;">Barang yang sudah dibeli tidak dapat ditukar kembali.</p>
                <p style="margin: 2px 0 0; color: #94A3B8;">Didukung oleh LARIS Smart POS</p>
            </div>
        </div>

        <!-- ACTIONS -->
        <div style="padding: 12px 18px; background: #F1F5F9; border-top: 1px solid #E2E8F0; display: flex; gap: 8px;">
            <button type="button" onclick="printReceipt()" style="flex: 1; background: #0F172A; color: #34D399; border: none; padding: 10px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px;">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z"/></svg>
                <span>Cetak Struk</span>
            </button>
            <a id="btnDownloadPdf" href="#" target="_blank" style="flex: 1; background: #10B981; color: #FFFFFF; text-decoration: none; padding: 10px; border-radius: 8px; font-size: 12px; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 6px;">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                <span>Unduh PDF</span>
            </a>
        </div>
    </div>
</div>

<script>
    let cart = [];
    let currentCategoryFilter = 'all';
    let currentPosTab = 'catalog';
    let recognition = null;
    let isListening = false;
    let currentCompletedOrderId = null;

    // Mobile / Tablet Tab Switcher
    function switchPosTab(tab) {
        currentPosTab = tab;
        const catalogPanel = document.getElementById('posCatalogContainer');
        const cartPanel = document.getElementById('posCartContainer');
        const btnCatalog = document.getElementById('tabBtnCatalog');
        const btnCart = document.getElementById('tabBtnCart');
        const floatingBar = document.getElementById('posFloatingBar');

        if (window.innerWidth <= 960) {
            if (tab === 'catalog') {
                if (catalogPanel) catalogPanel.style.display = 'block';
                if (cartPanel) cartPanel.style.display = 'none';
                if (btnCatalog) btnCatalog.classList.add('active');
                if (btnCart) btnCart.classList.remove('active');
                if (floatingBar && cart.length > 0) {
                    floatingBar.style.display = 'flex';
                }
            } else {
                if (catalogPanel) catalogPanel.style.display = 'none';
                if (cartPanel) cartPanel.style.display = 'flex';
                if (btnCatalog) btnCatalog.classList.remove('active');
                if (btnCart) btnCart.classList.add('active');
                if (floatingBar) floatingBar.style.display = 'none';
                if (cartPanel) {
                    window.scrollTo({ top: cartPanel.offsetTop - 70, behavior: 'smooth' });
                }
            }
        }
    }

    function handlePosResize() {
        const catalogPanel = document.getElementById('posCatalogContainer');
        const cartPanel = document.getElementById('posCartContainer');
        const floatingBar = document.getElementById('posFloatingBar');

        if (window.innerWidth > 960) {
            if (catalogPanel) catalogPanel.style.display = 'flex';
            if (cartPanel) cartPanel.style.display = 'flex';
            if (floatingBar) floatingBar.style.display = 'none';
        } else {
            switchPosTab(currentPosTab);
        }
    }
    window.addEventListener('resize', handlePosResize);
    document.addEventListener('DOMContentLoaded', handlePosResize);

    // Quick Add Product
    function quickAdd(id, name, price, maxStock) {
        let existing = cart.find(i => i.id === id);
        if (existing) {
            if (existing.qty >= maxStock) {
                larisToast('Stok maksimal tercapai (' + maxStock + ' unit)', 'warning');
                return;
            }
            existing.qty += 1;
        } else {
            cart.push({ id, name, price, qty: 1, maxStock });
        }
        renderCart();
        larisToast(`Ditambahkan ke Struk: ${name}`, 'success', 1800);
    }

    // Change Qty (+ / -)
    function changeQty(id, delta) {
        let item = cart.find(i => i.id === id);
        if (!item) return;

        item.qty += delta;
        if (item.qty <= 0) {
            removeFromCart(id);
            return;
        }
        if (item.maxStock && item.qty > item.maxStock) {
            item.qty = item.maxStock;
            larisToast('Stok tidak mencukupi', 'warning');
        }
        renderCart();
    }

    // Remove single item
    function removeFromCart(id) {
        cart = cart.filter(i => i.id !== id);
        renderCart();
    }

    // Clear whole cart
    function clearCart() {
        cart = [];
        renderCart();
    }

    // Render Cart HTML
    function renderCart() {
        let container = document.getElementById('cartItems');
        let totalCountBadge = document.getElementById('tabCartCount');
        let floatBadge = document.getElementById('posFloatBadge');
        let floatTotal = document.getElementById('posFloatTotal');
        let floatingBar = document.getElementById('posFloatingBar');

        if (cart.length === 0) {
            container.innerHTML = `
                <div id="emptyCartText" style="text-align: center; color: #94A3B8; font-size: 13px; padding: 28px 0;">
                    <svg width="36" height="36" fill="none" stroke="#CBD5E1" viewBox="0 0 24 24" style="margin: 0 auto 8px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                    <p style="margin: 0; font-weight: 600;">Belum ada produk di struk kasir.</p>
                    <p style="margin: 4px 0 0 0; font-size: 11px;">Klik "Tambah" di katalog atau gunakan tombol suara di bawah.</p>
                </div>
            `;
            document.getElementById('cartTotal').innerText = 'Rp 0';
            if (totalCountBadge) totalCountBadge.innerText = '0';
            if (floatBadge) floatBadge.innerText = '0 Item';
            if (floatTotal) floatTotal.innerText = 'Rp 0';
            if (floatingBar) floatingBar.style.display = 'none';
            calculateChange();
            return;
        }

        let total = 0;
        let totalQty = 0;
        let html = '';
        cart.forEach((item) => {
            let sub = item.price * item.qty;
            total += sub;
            totalQty += item.qty;
            html += `
                <div style="display: flex; justify-content: space-between; align-items: center; background: #F8FAFC; border: 1px solid #E2E8F0; padding: 10px 12px; border-radius: 10px; font-size: 12px;">
                    <div style="flex: 1; padding-right: 8px;">
                        <strong style="color: #0F172A; display: block; font-size: 12.5px;">${item.name}</strong>
                        <span style="color: #64748B; font-size: 11px;">Rp ${item.price.toLocaleString('id-ID')}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <button type="button" onclick="changeQty(${item.id}, -1)" style="width: 24px; height: 24px; border-radius: 6px; border: 1px solid #CBD5E1; background: #FFFFFF; font-weight: 800; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #475569;">-</button>
                        <span style="font-weight: 800; min-width: 20px; text-align: center; color: #0F172A;">${item.qty}</span>
                        <button type="button" onclick="changeQty(${item.id}, 1)" style="width: 24px; height: 24px; border-radius: 6px; border: 1px solid #CBD5E1; background: #FFFFFF; font-weight: 800; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #475569;">+</button>
                    </div>
                    <div style="font-weight: 800; color: #10B981; min-width: 80px; text-align: right; padding-left: 8px;">
                        Rp ${sub.toLocaleString('id-ID')}
                    </div>
                    <button type="button" onclick="removeFromCart(${item.id})" title="Hapus produk" style="background: none; border: none; color: #94A3B8; cursor: pointer; margin-left: 4px; padding: 4px;" onmouseover="this.style.color='#EF4444'" onmouseout="this.style.color='#94A3B8'">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                    </button>
                </div>
            `;
        });

        container.innerHTML = html;
        document.getElementById('cartTotal').innerText = 'Rp ' + total.toLocaleString('id-ID');

        // Sync Mobile Badges & Floating Bar
        if (totalCountBadge) totalCountBadge.innerText = totalQty;
        if (floatBadge) floatBadge.innerText = totalQty + ' Item';
        if (floatTotal) floatTotal.innerText = 'Rp ' + total.toLocaleString('id-ID');

        if (floatingBar) {
            if (window.innerWidth <= 960 && currentPosTab === 'catalog') {
                floatingBar.style.display = 'flex';
            } else {
                floatingBar.style.display = 'none';
            }
        }

        calculateChange();
    }

    // Sensitive Search & Filter
    function filterProducts() {
        let keyword = (document.getElementById('posSearchInput').value || '').trim().toLowerCase();
        let items = document.querySelectorAll('.product-item');
        let visibleCount = 0;

        items.forEach(el => {
            let name = el.getAttribute('data-name') || '';
            let sku = el.getAttribute('data-sku') || '';
            let cat = el.getAttribute('data-category') || '';

            let matchesCat = (currentCategoryFilter === 'all' || cat.toLowerCase() === currentCategoryFilter.toLowerCase());
            let matchesSearch = (!keyword || name.includes(keyword) || sku.includes(keyword));

            if (matchesCat && matchesSearch) {
                el.style.display = 'flex';
                visibleCount++;
            } else {
                el.style.display = 'none';
            }
        });

        document.getElementById('noProductsFound').style.display = visibleCount === 0 ? 'block' : 'none';
        document.getElementById('productCountBadge').innerText = visibleCount + ' Produk Ditampilkan';
    }

    function setCategoryFilter(category, btn) {
        currentCategoryFilter = category;
        document.querySelectorAll('.category-chip').forEach(c => c.classList.remove('active'));
        if (btn) btn.classList.add('active');
        filterProducts();
    }

    // Payment Method Change
    function handlePayMethodChange() {
        const method = document.getElementById('payMethod').value;
        const cashPanel = document.getElementById('cashPanel');
        const qrisPanel = document.getElementById('qrisPanel');
        const kasbonPanel = document.getElementById('kasbonPanel');
        const btn = document.getElementById('btnSubmitCheckout');

        cashPanel.style.display = (method === 'Tunai') ? 'block' : 'none';
        qrisPanel.style.display = (method === 'QRIS') ? 'block' : 'none';
        kasbonPanel.style.display = (method === 'Kasbon') ? 'block' : 'none';

        if (method === 'Kasbon') {
            btn.innerHTML = '<span>CATAT KASBON (AI RISK APPROVED) &rarr;</span>';
            btn.style.background = '#F59E0B';
            btn.style.color = '#FFFFFF';
            updateKasbonCustomer();
        } else if (method === 'QRIS') {
            btn.innerHTML = '<span>KONFIRMASI BAYAR QRIS &rarr;</span>';
            btn.style.background = '#10B981';
            btn.style.color = '#FFFFFF';
        } else {
            btn.innerHTML = '<span>PROSES BAYAR (F8) &rarr;</span>';
            btn.style.background = '#CCFF00';
            btn.style.color = '#000000';
        }
    }

    function closeQrisPanel() {
        document.getElementById('qrisPanel').style.display = 'none';
    }

    // Cash Calculation & Kembalian
    function calculateChange() {
        let total = cart.reduce((acc, it) => acc + (it.price * it.qty), 0);
        let cashInput = parseFloat(document.getElementById('cashReceivedInput').value) || 0;
        let changeDisplay = document.getElementById('cashChangeDisplay');

        if (cashInput <= 0 && total > 0) {
            changeDisplay.innerText = 'Kembalian: Rp 0';
            changeDisplay.style.color = '#64748B';
            return;
        }

        let diff = cashInput - total;
        if (diff >= 0) {
            changeDisplay.innerText = 'Kembalian: Rp ' + diff.toLocaleString('id-ID');
            changeDisplay.style.color = '#10B981';
        } else {
            changeDisplay.innerText = 'Kurang: Rp ' + Math.abs(diff).toLocaleString('id-ID');
            changeDisplay.style.color = '#EF4444';
        }
    }

    function setCashNominal(val) {
        let total = cart.reduce((acc, it) => acc + (it.price * it.qty), 0);
        if (val === 'exact') {
            document.getElementById('cashReceivedInput').value = total;
        } else {
            document.getElementById('cashReceivedInput').value = val;
        }
        calculateChange();
    }

    // Kasbon Support
    function updateKasbonCustomer() {
        const sel = document.getElementById('kasbonCustomer');
        if (!sel || sel.selectedIndex < 0) return;
        const opt = sel.options[sel.selectedIndex];
        const score = opt.getAttribute('data-score');
        const status = opt.getAttribute('data-status');
        const limit = parseInt(opt.getAttribute('data-limit') || 0);
        const debt = parseInt(opt.getAttribute('data-debt') || 0);

        const badge = document.getElementById('kasbonScoreBadge');
        if (badge) {
            badge.innerText = `Skor ${score}% (${status.toUpperCase()})`;
            badge.style.background = score > 80 ? '#16A34A' : '#D97706';
        }

        const details = document.getElementById('kasbonDetails');
        if (details) {
            details.innerHTML = `Plafon Utang Maksimal: <strong>Rp ${limit.toLocaleString('id-ID')}</strong> • Utang Berjalan: <strong>Rp ${debt.toLocaleString('id-ID')}</strong>`;
        }
    }

    // Voice-to-Receipt (Multi-Dialek)
    function initSpeechRecognition() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (!SpeechRecognition) {
            console.log('SpeechRecognition tidak didukung di browser ini.');
            return null;
        }
        const sr = new SpeechRecognition();
        sr.continuous = false;
        sr.interimResults = false;
        sr.lang = 'id-ID';

        sr.onstart = function() {
            isListening = true;
            document.getElementById('micIndicator').classList.add('voice-pulse');
            document.getElementById('micIndicator').style.background = '#10B981';
            document.getElementById('micIndicator').style.color = '#FFFFFF';
            document.getElementById('voiceStatusText').innerText = 'Mendengarkan... Silakan sebut produk dan jumlahnya!';
            document.getElementById('btnStartVoice').innerText = 'Berhenti';
            document.getElementById('btnStartVoice').style.background = '#EF4444';
            document.getElementById('btnStartVoice').style.color = '#FFFFFF';
        };

        sr.onresult = function(event) {
            const transcript = event.results[0][0].transcript;
            console.log('Voice recognized:', transcript);
            parseAndAddVoiceItems(transcript);
        };

        sr.onerror = function(event) {
            console.warn('Speech error:', event.error);
            stopVoice();
            larisToast('Voice listener: ' + event.error, 'info');
        };

        sr.onend = function() {
            stopVoice();
        };

        return sr;
    }

    function toggleVoiceOrder() {
        if (!recognition) {
            recognition = initSpeechRecognition();
        }

        if (!recognition) {
            larisToast('Gunakan tombol simulasi suara di bawah (browser mode)', 'info');
            return;
        }

        if (isListening) {
            recognition.stop();
        } else {
            try {
                recognition.start();
            } catch (e) {
                console.error(e);
            }
        }
    }

    function stopVoice() {
        isListening = false;
        const mic = document.getElementById('micIndicator');
        if (mic) {
            mic.classList.remove('voice-pulse');
            mic.style.background = '#1E2D33';
            mic.style.color = '#34D399';
        }
        document.getElementById('voiceStatusText').innerText = 'Siap deteksi: Sunda, Jawa, Melayu & Indonesia';
        const btn = document.getElementById('btnStartVoice');
        if (btn) {
            btn.innerText = 'Mulai Rekam';
            btn.style.background = '#CCFF00';
            btn.style.color = '#000000';
        }
    }

    function simulateDialectPhrase(phrase) {
        parseAndAddVoiceItems(phrase);
    }

    function parseAndAddVoiceItems(text) {
        document.getElementById('voiceStatusText').innerText = `Terdeteksi: "${text}"`;
        larisToast(`AI Voice: "${text}" diproses...`, 'info', 3000);

        let lower = text.toLowerCase();
        let qty = 1;

        // Dialect number mappings
        if (lower.includes('dua') || lower.includes('lorow') || lower.includes('loro') || lower.includes('duo') || lower.includes('2')) qty = 2;
        else if (lower.includes('tiga') || lower.includes('telu') || lower.includes('tigo') || lower.includes('3')) qty = 3;
        else if (lower.includes('empat') || lower.includes('papat') || lower.includes('opat') || lower.includes('4')) qty = 4;
        else if (lower.includes('lima') || lower.includes('limo') || lower.includes('5')) qty = 5;
        else if (lower.includes('sepuluh') || lower.includes('sedasa') || lower.includes('sapuluh') || lower.includes('10')) qty = 10;
        else if (lower.includes('satu') || lower.includes('siji') || lower.includes('hiji') || lower.includes('1')) qty = 1;

        // Find matching product in catalog
        let items = Array.from(document.querySelectorAll('.product-item'));
        let matched = null;

        for (let el of items) {
            let name = el.getAttribute('data-name');
            let words = name.split(' ');
            for (let w of words) {
                if (w.length > 2 && lower.includes(w)) {
                    matched = el;
                    break;
                }
            }
            if (matched) break;
        }

        if (!matched && items.length > 0) {
            matched = items[0]; // fallback
        }

        if (matched) {
            let id = parseInt(matched.getAttribute('data-id'));
            let name = matched.querySelector('h4').innerText.trim();
            let attrPrice = matched.getAttribute('data-price');
            let priceText = matched.querySelector('[data-id] strong, .product-card strong, [style*="color: #10B981"]')?.innerText.replace(/[^0-9]/g, '');
            let price = attrPrice ? parseInt(attrPrice) : (parseInt(priceText) || 15000);
            let maxStock = parseInt(matched.getAttribute('data-stock')) || 999;

            for (let i = 0; i < qty; i++) {
                quickAdd(id, name, price, maxStock);
            }
            larisToast(`Ditambahkan ke Struk: ${name} (${qty}x)`, 'success');
        }
    }

    // Submit Checkout
    function submitCheckout() {
        if (cart.length === 0) {
            larisAlert('Keranjang Kasir Kosong', 'Silakan pilih atau tambahkan minimal 1 produk ke struk!', 'warning');
            return;
        }

        const method = document.getElementById('payMethod').value;
        const cashReceived = parseFloat(document.getElementById('cashReceivedInput').value) || 0;
        let total = cart.reduce((acc, it) => acc + (it.price * it.qty), 0);

        if (method === 'Tunai' && cashReceived < total) {
            larisAlert('Uang Tunai Kurang', `Total tagihan <strong>Rp ${total.toLocaleString('id-ID')}</strong>, namun uang diterima baru <strong>Rp ${cashReceived.toLocaleString('id-ID')}</strong>!`, 'warning');
            return;
        }

        let payload = {
            channel: 'Offline Store',
            payment_method: method,
            cash_received: method === 'Tunai' ? cashReceived : total,
            items: cart.map(i => ({ product_id: i.id, quantity: i.qty }))
        };

        const btn = document.getElementById('btnSubmitCheckout');
        btn.disabled = true;
        btn.innerText = 'MEMPROSES TRANSAKSI...';

        fetch("{{ route('pos.checkout') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(res => {
            btn.disabled = false;
            handlePayMethodChange();

            if (res.status === 'success') {
                currentCompletedOrderId = res.data.id;
                showReceiptModal(res.data);
                cart = [];
                renderCart();
            } else {
                larisAlert('Gagal Memproses Transaksi', res.message || 'Terjadi kesalahan sistem.', 'error');
            }
        })
        .catch(err => {
            btn.disabled = false;
            handlePayMethodChange();
            larisAlert('Kesalahan Jaringan', 'Gagal menghubungi server.', 'error');
        });
    }

    // Receipt Modal Display
    function showReceiptModal(data) {
        document.getElementById('rcStoreName').innerText = (data.store && data.store.name) ? data.store.name : 'TOKO BERKAH UTAMA';
        document.getElementById('rcStoreAddress').innerText = (data.store && data.store.address) ? data.store.address : 'Jl. Braga No. 45, Bandung';
        document.getElementById('rcStorePhone').innerText = 'Telp: ' + ((data.store && data.store.phone) ? data.store.phone : '0812-3456-7890');
        document.getElementById('rcOrderNumber').innerText = data.order_number;
        document.getElementById('rcOrderDate').innerText = data.created_at || '{{ date("d/m/Y H:i") }}';
        document.getElementById('rcPaymentMethod').innerText = data.payment_method;
        document.getElementById('rcSubtotal').innerText = 'Rp ' + Number(data.total_amount).toLocaleString('id-ID');
        document.getElementById('rcCashReceived').innerText = 'Rp ' + Number(data.cash_received || data.total_amount).toLocaleString('id-ID');
        document.getElementById('rcChangeAmount').innerText = 'Rp ' + Number(data.change_amount || 0).toLocaleString('id-ID');

        let itemsHtml = '';
        if (data.items && data.items.length > 0) {
            data.items.forEach(it => {
                itemsHtml += `
                    <div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>${it.name}</span>
                            <span>Rp ${Number(it.subtotal).toLocaleString('id-ID')}</span>
                        </div>
                        <div style="font-size: 10px; color: #64748B;">
                            ${it.quantity} x Rp ${Number(it.unit_price).toLocaleString('id-ID')}
                        </div>
                    </div>
                `;
            });
        }
        document.getElementById('rcItemsList').innerHTML = itemsHtml;

        // Set PDF download URL
        document.getElementById('btnDownloadPdf').href = '/cashier/receipt/' + data.id + '/pdf';

        const modal = document.getElementById('receiptModal');
        modal.style.display = 'flex';
    }

    function closeReceiptModal() {
        document.getElementById('receiptModal').style.display = 'none';
        location.reload();
    }

    function printReceipt() {
        window.print();
    }

    // Shortcut F8 for Checkout
    document.addEventListener('keydown', function(e) {
        if (e.key === 'F8') {
            e.preventDefault();
            submitCheckout();
        }
    });
</script>
@endsection
