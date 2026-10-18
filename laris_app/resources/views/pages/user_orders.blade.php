@extends('layouts.app', ['title' => 'Pesanan Saya & Pelacakan Real-time - LARIS'])

@section('content')
<div class="user-orders-container">
    {{-- Header Banner --}}
    <div class="orders-header-card">
        <div>
            <div class="orders-badge" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); display: inline-flex; align-items: center; gap: 7px;">
                <span style="width: 7px; height: 7px; background: #10B981; border-radius: 50%; box-shadow: 0 0 8px #10B981;"></span>
                <span>STATUS LIVE AUTO-UPDATE • REALTIME AKTIF</span>
            </div>
            <h1 class="orders-title">Pesanan Saya</h1>
            <p class="orders-subtitle">Pantau kemajuan pesanan Anda secara real-time dari gerai UMKM lokal. Status terupdate otomatis tanpa perlu refresh halaman.</p>
        </div>
        <a href="{{ route('user.dashboard') }}" class="btn-back-market">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            <span>Jelajah Gerai &amp; Menu</span>
        </a>
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

    {{-- Status Filter Tabs --}}
    <div class="orders-filter-tabs">
        <a href="{{ route('user.orders') }}" class="filter-tab-item {{ $statusTab === 'all' ? 'active' : '' }}">
            <span>Semua Pesanan</span>
            <span class="tab-count-pill">{{ $counts['all'] ?? 0 }}</span>
        </a>
        <a href="{{ route('user.orders', ['status' => 'processing']) }}" class="filter-tab-item {{ $statusTab === 'processing' ? 'active' : '' }}">
            <span class="status-indicator-dot dot-amber"></span>
            <span>Diproses Gerai</span>
            <span class="tab-count-pill">{{ $counts['processing'] ?? 0 }}</span>
        </a>
        <a href="{{ route('user.orders', ['status' => 'shipping']) }}" class="filter-tab-item {{ $statusTab === 'shipping' ? 'active' : '' }}">
            <span class="status-indicator-dot dot-blue"></span>
            <span>Pengantaran / Siap Diambil</span>
            <span class="tab-count-pill">{{ $counts['shipping'] ?? 0 }}</span>
        </a>
        <a href="{{ route('user.orders', ['status' => 'completed']) }}" class="filter-tab-item {{ $statusTab === 'completed' ? 'active' : '' }}">
            <span class="status-indicator-dot dot-green"></span>
            <span>Selesai</span>
            <span class="tab-count-pill">{{ $counts['completed'] ?? 0 }}</span>
        </a>
        <a href="{{ route('user.orders', ['status' => 'cancelled']) }}" class="filter-tab-item {{ $statusTab === 'cancelled' ? 'active' : '' }}">
            <span class="status-indicator-dot dot-rose"></span>
            <span>Dibatalkan</span>
            <span class="tab-count-pill">{{ $counts['cancelled'] ?? 0 }}</span>
        </a>
    </div>

    {{-- Order List --}}
    <div class="orders-list">
        @forelse($orders as $ord)
            @php
                $statusClass = match(strtolower($ord->status)) {
                    'processing', 'pending', 'diproses gerai' => 'status-processing',
                    'shipping', 'dalam pengantaran', 'siap diambil' => 'status-shipping',
                    'completed', 'selesai' => 'status-completed',
                    'cancelled', 'dibatalkan' => 'status-cancelled',
                    default => 'status-default'
                };

                $statusLabel = match(strtolower($ord->status)) {
                    'processing', 'pending', 'diproses gerai' => 'Diproses Gerai',
                    'shipping', 'dalam pengantaran' => 'Dalam Pengantaran',
                    'siap diambil' => 'Siap Diambil di Gerai',
                    'completed', 'selesai' => 'Selesai',
                    'cancelled', 'dibatalkan' => 'Dibatalkan',
                    default => $ord->status
                };

                $isCancelled = in_array(strtolower($ord->status), ['cancelled', 'dibatalkan']);
                $isCompleted = in_array(strtolower($ord->status), ['completed', 'selesai']);
                $isShipping = in_array(strtolower($ord->status), ['shipping', 'dalam pengantaran', 'siap diambil']);
                $isProcessing = in_array(strtolower($ord->status), ['processing', 'pending', 'diproses gerai']);
            @endphp

            <div class="order-card" data-order-id="{{ $ord->id }}" data-order-number="{{ $ord->order_number ?? ('ORD-' . $ord->id) }}">
                {{-- Header Kartu Pesanan --}}
                <div class="order-card-header">
                    <div class="order-store-info">
                        <div class="store-avatar-mini">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <div class="order-store-name">
                                <a href="{{ route('user.store_detail', $ord->store_id) }}" class="store-link">
                                    {{ $ord->store->name ?? 'Gerai UMKM' }}
                                </a>
                                @if($ord->store && $ord->store->is_verified)
                                    <span class="verified-icon" title="Mitra Terverifikasi" style="display: inline-flex; align-items: center; justify-content: center; width: 14px; height: 14px; background: #10B981; color: #FFF; border-radius: 50%; font-size: 9px; margin-left: 3px;">
                                        <svg width="10" height="10" fill="none" stroke="#FFF" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                    </span>
                                @endif
                            </div>
                            <div class="order-meta-text">
                                <span class="order-code">{{ $ord->order_number ?? ('ORD-' . $ord->id) }}</span>
                                <span class="dot-separator">•</span>
                                <span>{{ $ord->created_at ? $ord->created_at->format('d M Y, H:i') : 'Baru saja' }} WIB</span>
                            </div>
                        </div>
                    </div>
                    <div class="order-status-badge {{ $statusClass }}" id="order-badge-{{ $ord->id }}">
                        <span class="status-dot"></span>
                        <span>{{ $statusLabel }}</span>
                    </div>
                </div>

                {{-- Status Visual Progress Track --}}
                @if(!$isCancelled)
                    <div class="order-progress-track" id="order-track-{{ $ord->id }}">
                        {{-- Step 1: Pesanan Dibuat --}}
                        <div class="step-item completed">
                            <div class="step-bubble">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="step-label">Pesanan Dibuat</span>
                        </div>
                        <div class="step-line {{ $isProcessing || $isShipping || $isCompleted ? 'active' : '' }}"></div>

                        {{-- Step 2: Disiapkan Gerai --}}
                        <div class="step-item {{ $isProcessing ? 'current' : ($isShipping || $isCompleted ? 'completed' : '') }}">
                            <div class="step-bubble">
                                @if($isShipping || $isCompleted)
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                @else
                                    2
                                @endif
                            </div>
                            <span class="step-label">Disiapkan Gerai</span>
                        </div>
                        <div class="step-line {{ $isShipping || $isCompleted ? 'active' : '' }}"></div>

                        {{-- Step 3: Pengantaran / Siap Diambil --}}
                        <div class="step-item {{ $isShipping ? 'current' : ($isCompleted ? 'completed' : '') }}">
                            <div class="step-bubble">
                                @if($isCompleted)
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                @else
                                    3
                                @endif
                            </div>
                            <span class="step-label">
                                {{ ($ord->delivery_type ?? 'delivery') === 'pickup' ? 'Siap Diambil' : 'Dalam Pengantaran' }}
                            </span>
                        </div>
                        <div class="step-line {{ $isCompleted ? 'active' : '' }}"></div>

                        {{-- Step 4: Selesai --}}
                        <div class="step-item {{ $isCompleted ? 'completed' : '' }}">
                            <div class="step-bubble">
                                @if($isCompleted)
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                @else
                                    4
                                @endif
                            </div>
                            <span class="step-label">Selesai</span>
                        </div>
                    </div>
                @else
                    {{-- Notice Box if Order Cancelled --}}
                    <div class="cancelled-notice-box">
                        <div class="cnb-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="cnb-title">Pesanan Ini Telah Dibatalkan</div>
                            <div class="cnb-desc">
                                Alasan: <strong>{{ $ord->cancelled_reason ?? 'Dibatalkan oleh pembeli' }}</strong>
                                @if($ord->cancelled_at)
                                    • {{ \Carbon\Carbon::parse($ord->cancelled_at)->format('d M Y, H:i') }} WIB
                                @endif
                                <br><span class="cnb-sub">Stok produk pada gerai telah dikembalikan secara riil oleh sistem.</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Order Items List --}}
                <div class="order-items-box">
                    @if($ord->items && $ord->items->count() > 0)
                        @foreach($ord->items as $it)
                            <div class="order-item-row">
                                <div class="item-name-col">
                                    <div class="item-icon-tag">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                    </div>
                                    <div>
                                        <div class="item-title">{{ $it->product->name ?? 'Produk Gerai' }}</div>
                                        <div class="item-sub">
                                            @if($it->product && $it->product->sku)
                                                <span class="sku-tag">{{ $it->product->sku }}</span>
                                            @endif
                                            <span>Rp {{ number_format($it->unit_selling_price ?? ($it->price ?? 0), 0, ',', '.') }} x {{ $it->quantity }} item</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-subtotal">Rp {{ number_format($it->subtotal ?? (($it->unit_selling_price ?? $it->price) * $it->quantity), 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                    @else
                        <div class="order-item-row">
                            <div class="item-name-col">
                                <div class="item-icon-tag">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                                </div>
                                <div>Paket Menu &amp; Produk Gerai UMKM</div>
                            </div>
                            <div class="item-subtotal">Rp {{ number_format($ord->total_amount, 0, ',', '.') }}</div>
                        </div>
                    @endif
                </div>

                {{-- Delivery & Payment Details Grid --}}
                <div class="order-details-grid">
                    <div class="detail-box">
                        <div class="detail-label">Metode Pengantaran &amp; Lokasi:</div>
                        <div class="detail-value">
                            @if(($ord->delivery_type ?? 'delivery') === 'pickup')
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                Ambil di Gerai (Self-Pickup)
                            @else
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.948c0-.621-.504-1.125-1.125-1.125H4.125C3.504 5.5 3 6.004 3 6.625v10.5c0 .621.504 1.125 1.125 1.125h1.5"/></svg>
                                Pengantaran Toko (Ongkir Rp {{ number_format($ord->delivery_fee ?? 0, 0, ',', '.') }})
                            @endif
                        </div>
                        <div class="detail-sub">{{ $ord->delivery_address ?? 'Lokasi gerai mitra' }}</div>
                        @if($ord->notes)
                            <div class="detail-notes">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/></svg>
                                Catatan: "{{ $ord->notes }}"
                            </div>
                        @endif
                    </div>

                    <div class="detail-box">
                        <div class="detail-label">Metode Pembayaran:</div>
                        <div class="detail-value">
                            @if(strtolower($ord->payment_method ?? 'cash') === 'qris')
                                <span class="badge-pay badge-qris">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"/></svg>
                                    QRIS Otomatis (Lunas)
                                </span>
                            @elseif(strtolower($ord->payment_method ?? 'cash') === 'bank')
                                <span class="badge-pay badge-bank">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5m-15 10.5V10.5M1.5 21h21"/></svg>
                                    Transfer Bank {{ $ord->store->bank_name ?? '' }}
                                </span>
                            @else
                                <span class="badge-pay badge-cash">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0 0h.75a.75.75 0 0 1 .75.75v.75m18-10.5v.75c0 .414.336.75.75.75h.75m0 0v8.25m0 0h-.75a.75.75 0 0 1-.75.75v.75m-15-12a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25h12a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 16.5 4.5h-12Zm4.5 6.75a2.25 2.25 0 1 0 4.5 0 2.25 2.25 0 0 0-4.5 0Z"/></svg>
                                    Tunai (Bayar Saat Diterima)
                                </span>
                            @endif
                        </div>
                        @if($ord->discount_amount > 0)
                            <div class="detail-sub discount-applied">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: -1px; margin-right: 3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/></svg>
                                Kupon {{ $ord->voucher_code }}: <strong>-Rp {{ number_format($ord->discount_amount, 0, ',', '.') }}</strong>
                            </div>
                        @endif
                        @if($ord->delivery_fee > 0)
                            <div class="detail-sub">Ongkir: Rp {{ number_format($ord->delivery_fee, 0, ',', '.') }}</div>
                        @endif
                    </div>
                </div>

                {{-- Rating & Review Box if Already Submitted --}}
                @if($ord->rating)
                    <div class="review-display-box">
                        <div class="review-stars-row">
                            <span class="stars-gold" style="display: inline-flex; align-items: center; gap: 2px;">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $ord->rating)
                                        <svg width="15" height="15" fill="#F59E0B" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @else
                                        <svg width="15" height="15" fill="#CBD5E1" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endif
                                @endfor
                            </span>
                            <span class="rating-num">{{ $ord->rating }}.0 dari Anda</span>
                        </div>
                        @if($ord->review)
                            <div class="review-text">"{{ $ord->review }}"</div>
                        @endif
                    </div>
                @endif

                {{-- Action Footer --}}
                <div class="order-card-footer">
                    <div>
                        <span class="total-lbl">Total Pembayaran:</span>
                        <div class="order-total-amount">Rp {{ number_format($ord->total_amount, 0, ',', '.') }}</div>
                    </div>

                    <div class="action-btn-group">
                        {{-- Hubungi Toko via WhatsApp --}}
                        @if($ord->store && $ord->store->phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ord->store->phone) }}?text=Halo%20{{ urlencode($ord->store->name) }},%20saya%20ingin%20menanyakan%20status%20pesanan%20nomor%20{{ $ord->order_number }}" target="_blank" class="btn-action btn-wa" title="Hubungi Gerai via WhatsApp">
                                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                <span>WhatsApp</span>
                            </a>
                        @endif

                        {{-- Action: Batalkan Pesanan (Jika masih Processing / Shipping) --}}
                        @if($isProcessing || $isShipping)
                            <button type="button" class="btn-action btn-cancel-order" onclick="openCancelModal({{ $ord->id }}, '{{ $ord->order_number }}')">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span>Batalkan</span>
                            </button>
                        @endif

                        {{-- Action: Konfirmasi Diterima (Jika Shipping) --}}
                        @if($isShipping)
                            <form action="{{ route('user.orders.complete', $ord->id) }}" method="POST" id="formComplete-{{ $ord->id }}" style="display: inline;">
                                @csrf
                                <button type="button" class="btn-action btn-complete" onclick="confirmReceiveOrder({{ $ord->id }}, '{{ $ord->order_number }}')">
                                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    <span>Konfirmasi Diterima</span>
                                </button>
                            </form>
                        @endif

                        {{-- Action: Beri Ulasan & Rating (Jika Completed dan belum ada rating) --}}
                        @if($isCompleted && !$ord->rating)
                            <button type="button" class="btn-action btn-review" onclick="openReviewModal({{ $ord->id }}, '{{ $ord->order_number }}', '{{ addslashes($ord->store->name ?? 'Gerai UMKM') }}')">
                                <svg width="15" height="15" fill="#F59E0B" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <span>Beri Ulasan</span>
                            </button>
                        @endif

                        {{-- Action: Hapus Riwayat (Jika Completed atau Cancelled) --}}
                        @if($isCompleted || $isCancelled)
                            <form action="{{ route('user.orders.delete', $ord->id) }}" method="POST" id="formDelete-{{ $ord->id }}" style="display: inline;">
                                @csrf
                                <button type="button" class="btn-action btn-delete-history" onclick="confirmDeleteOrder({{ $ord->id }}, '{{ $ord->order_number }}')" title="Hapus dari riwayat pesanan">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-orders-card">
                <div class="empty-icon-wrap">
                    <svg width="48" height="48" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <div class="empty-title">Tidak Ada Pesanan Ditemukan</div>
                <p class="empty-desc">
                    @if($statusTab !== 'all')
                        Tidak ada transaksi pesanan dengan status <strong>"{{ ucfirst($statusTab) }}"</strong> saat ini.
                    @else
                        Anda belum melakukan pemesanan apapun. Yuk, jelajahi ribuan produk kuliner, sembako, dan kerajinan lokal terbaik!
                    @endif
                </p>
                <div class="empty-actions">
                    @if($statusTab !== 'all')
                        <a href="{{ route('user.orders') }}" class="btn-reset-tab">Lihat Semua Pesanan</a>
                    @endif
                    <a href="{{ route('user.dashboard') }}" class="btn-start-shopping">Mulai Belanja Sekarang</a>
                </div>
            </div>
        @endforelse

        {{-- Custom Styled Laravel Pagination --}}
        @if($orders->hasPages())
            <div class="laris-pagination-wrap">
                <div class="pagination-info">
                    Menampilkan <strong>{{ $orders->firstItem() }}</strong> - <strong>{{ $orders->lastItem() }}</strong> dari <strong>{{ $orders->total() }}</strong> total pesanan
                </div>
                <div class="pagination-nav">
                    {{ $orders->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- MODAL BATALKAN PESANAN --}}
<div id="cancelOrderModal" class="modal-overlay-custom" style="display: none;">
    <div class="modal-card-custom">
        <div class="mcc-header">
            <div>
                <h3 class="mcc-title">Batalkan Pesanan</h3>
                <p class="mcc-subtitle" id="cancelModalOrderNum">Nomor Pesanan: #ORD-...</p>
            </div>
            <button type="button" class="mcc-close" onclick="closeCancelModal()">&times;</button>
        </div>
        <form id="cancelOrderForm" method="POST" action="">
            @csrf
            <div class="mcc-body">
                <p style="font-size: 13px; color: #475569; margin-bottom: 12px;">
                    Apakah Anda yakin ingin membatalkan pesanan ini? Stok produk akan otomatis dikembalikan ke inventaris toko.
                </p>
                <label class="mcc-label">Alasan Pembatalan:</label>
                <div class="cancel-reason-options">
                    <label class="reason-radio">
                        <input type="radio" name="reason_choice" value="Ingin mengubah rincian produk pesanan" checked onchange="toggleCustomReason(false)">
                        <span>Ingin mengubah rincian produk pesanan</span>
                    </label>
                    <label class="reason-radio">
                        <input type="radio" name="reason_choice" value="Salah alamat pengantaran" onchange="toggleCustomReason(false)">
                        <span>Salah alamat pengantaran</span>
                    </label>
                    <label class="reason-radio">
                        <input type="radio" name="reason_choice" value="Waktu penyiapan gerai terlalu lama" onchange="toggleCustomReason(false)">
                        <span>Waktu penyiapan gerai terlalu lama</span>
                    </label>
                    <label class="reason-radio">
                        <input type="radio" name="reason_choice" value="other" onchange="toggleCustomReason(true)">
                        <span>Alasan lainnya...</span>
                    </label>
                </div>
                <div id="customReasonWrap" style="display: none; margin-top: 10px;">
                    <textarea name="reason" id="cancelReasonInput" rows="2" class="mcc-textarea" placeholder="Tuliskan alasan pembatalan Anda..."></textarea>
                </div>
            </div>
            <div class="mcc-footer">
                <button type="button" class="btn-mcc-cancel" onclick="closeCancelModal()">Kembali</button>
                <button type="submit" class="btn-mcc-confirm-danger">Ya, Batalkan Pesanan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL BERI ULASAN & RATING BINTANG --}}
<div id="reviewOrderModal" class="modal-overlay-custom" style="display: none;">
    <div class="modal-card-custom">
        <div class="mcc-header">
            <div>
                <h3 class="mcc-title">Beri Penilaian &amp; Ulasan</h3>
                <p class="mcc-subtitle" id="reviewModalStoreName">Gerai UMKM Mitra</p>
            </div>
            <button type="button" class="mcc-close" onclick="closeReviewModal()">&times;</button>
        </div>
        <form id="reviewOrderForm" method="POST" action="">
            @csrf
            <div class="mcc-body">
                <div class="star-rating-selector">
                    <div class="stars-row" style="display: flex; gap: 6px;">
                        @for($s = 1; $s <= 5; $s++)
                            <span class="star-btn {{ $s === 5 ? 'active' : '' }}" data-val="{{ $s }}" onclick="setRating({{ $s }})" style="cursor: pointer; display: inline-flex;">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </span>
                        @endfor
                    </div>
                    <div id="ratingTextLabel" class="rating-label-desc">5 Bintang - Sangat Memuaskan!</div>
                    <input type="hidden" name="rating" id="inputRatingValue" value="5">
                </div>

                <div style="margin-top: 16px;">
                    <label class="mcc-label">Ulasan Anda (Opsional):</label>
                    <textarea name="review" rows="3" class="mcc-textarea" placeholder="Ceritakan rasa masakan, kesegaran bahan, keramahan penjual, atau kecepatan pengantaran..."></textarea>
                </div>
            </div>
            <div class="mcc-footer">
                <button type="button" class="btn-mcc-cancel" onclick="closeReviewModal()">Batal</button>
                <button type="submit" class="btn-mcc-confirm-success">Kirim Penilaian</button>
            </div>
        </form>
    </div>
</div>

<style>
    .user-orders-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding-bottom: 60px;
    }

    /* HEADER BANNER */
    .orders-header-card {
        background: linear-gradient(135deg, #0B131B 0%, #162434 100%);
        border-radius: 18px;
        padding: 26px 30px;
        color: #FFFFFF;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        box-shadow: 0 10px 25px -5px rgba(11, 19, 27, 0.25);
    }

    .orders-badge {
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
        margin-bottom: 8px;
    }

    .orders-title {
        font-size: 24px;
        font-weight: 800;
        letter-spacing: -0.02em;
        margin-bottom: 4px;
    }

    .orders-subtitle {
        font-size: 13px;
        color: #94A3B8;
        max-width: 580px;
        line-height: 1.5;
    }

    .btn-back-market {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.16);
        color: #FFFFFF;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 18px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: all 0.16s;
        white-space: nowrap;
    }
    .btn-back-market:hover {
        background: #10B981;
        border-color: #10B981;
    }

    /* FILTER TABS */
    .orders-filter-tabs {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 4px;
        scrollbar-width: none;
    }
    .orders-filter-tabs::-webkit-scrollbar { display: none; }

    .filter-tab-item {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 8px 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 700;
        color: #475569;
        text-decoration: none;
        white-space: nowrap;
        transition: all 0.15s ease;
    }
    .filter-tab-item:hover {
        border-color: #CBD5E1;
        background: #F8FAFC;
    }
    .filter-tab-item.active {
        background: #0F172A;
        color: #FFFFFF;
        border-color: #0F172A;
    }

    .tab-count-pill {
        background: #F1F5F9;
        color: #334155;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 99px;
    }
    .filter-tab-item.active .tab-count-pill {
        background: rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
    }

    .status-indicator-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }
    .dot-amber { background: #F59E0B; }
    .dot-blue { background: #0284C7; }
    .dot-green { background: #10B981; }
    .dot-rose { background: #F43F5E; }

    /* ORDER CARD */
    .orders-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .order-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 20px 24px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
        display: flex;
        flex-direction: column;
        gap: 16px;
        transition: all 0.2s;
    }
    .order-card:hover {
        border-color: #CBD5E1;
        box-shadow: 0 6px 16px rgba(15, 23, 42, 0.06);
    }

    .order-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #F1F5F9;
        padding-bottom: 14px;
    }

    .order-store-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .store-avatar-mini {
        width: 42px;
        height: 42px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        color: #0F172A;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .order-store-name {
        font-size: 15px;
        font-weight: 800;
        color: #0F172A;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .store-link {
        color: #0F172A;
        text-decoration: none;
    }
    .store-link:hover {
        color: #10B981;
    }

    .verified-icon {
        background: #10B981;
        color: #FFFFFF;
        font-size: 9px;
        font-weight: 800;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .order-meta-text {
        font-size: 11px;
        color: #64748B;
        margin-top: 2px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .order-code {
        font-family: monospace;
        font-weight: 700;
        color: #334155;
    }

    .order-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 99px;
    }
    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        display: inline-block;
    }

    .status-processing {
        background: #FFFBEB;
        color: #B45309;
        border: 1px solid #FDE68A;
    }
    .status-processing .status-dot { background: #F59E0B; }

    .status-shipping {
        background: #F0F9FF;
        color: #0369A1;
        border: 1px solid #BAE6FD;
    }
    .status-shipping .status-dot { background: #0284C7; }

    .status-completed {
        background: #ECFDF5;
        color: #047857;
        border: 1px solid #A7F3D0;
    }
    .status-completed .status-dot { background: #10B981; }

    .status-cancelled {
        background: #FFF1F2;
        color: #BE123C;
        border: 1px solid #FECDD3;
    }
    .status-cancelled .status-dot { background: #E11D48; }

    /* PROGRESS TRACKER */
    .order-progress-track {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 14px 20px;
    }

    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        z-index: 2;
    }

    .step-bubble {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #E2E8F0;
        color: #64748B;
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .step-item.completed .step-bubble {
        background: #10B981;
        color: #FFFFFF;
    }

    .step-item.current .step-bubble {
        background: #0284C7;
        color: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.2);
    }

    .step-label {
        font-size: 11px;
        font-weight: 600;
        color: #64748B;
        text-align: center;
    }

    .step-item.completed .step-label, .step-item.current .step-label {
        color: #0F172A;
        font-weight: 700;
    }

    .step-line {
        flex: 1;
        height: 3px;
        background: #E2E8F0;
        margin: 0 8px 16px 8px;
    }
    .step-line.active {
        background: #10B981;
    }

    /* CANCELLED NOTICE */
    .cancelled-notice-box {
        background: #FFF1F2;
        border: 1px solid #FECDD3;
        border-radius: 12px;
        padding: 12px 16px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .cnb-icon {
        color: #E11D48;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .cnb-title {
        font-size: 13px;
        font-weight: 800;
        color: #9F1239;
    }
    .cnb-desc {
        font-size: 11px;
        color: #BE123C;
        margin-top: 2px;
        line-height: 1.4;
    }
    .cnb-sub {
        font-size: 10px;
        color: #64748B;
    }

    /* ORDER ITEMS */
    .order-items-box {
        display: flex;
        flex-direction: column;
        gap: 8px;
        background: #F8FAFC;
        border-radius: 12px;
        padding: 12px 16px;
        border: 1px solid #F1F5F9;
    }

    .order-item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
    }

    .item-name-col {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .item-icon-tag {
        font-size: 16px;
    }

    .item-title {
        font-weight: 700;
        color: #0F172A;
    }

    .item-sub {
        font-size: 11px;
        color: #64748B;
        margin-top: 1px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .sku-tag {
        background: #E2E8F0;
        color: #334155;
        font-family: monospace;
        font-size: 10px;
        font-weight: 700;
        padding: 1px 4px;
        border-radius: 4px;
    }

    .item-subtotal {
        font-weight: 800;
        color: #0F172A;
    }

    /* DETAILS GRID */
    .order-details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .detail-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 12px;
    }

    .detail-label {
        font-size: 11px;
        color: #64748B;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .detail-value {
        font-weight: 700;
        color: #0F172A;
    }

    .detail-sub {
        font-size: 11px;
        color: #64748B;
        margin-top: 3px;
    }

    .detail-notes {
        font-size: 11px;
        color: #B45309;
        background: #FFFBEB;
        padding: 4px 8px;
        border-radius: 6px;
        margin-top: 6px;
        border: 1px solid #FDE68A;
    }

    .discount-applied {
        color: #059669;
        font-weight: 600;
    }

    .badge-pay {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
    }
    .badge-qris {
        background: #ECFDF5;
        color: #059669;
        border: 1px solid #A7F3D0;
    }
    .badge-bank {
        background: #EFF6FF;
        color: #1D4ED8;
        border: 1px solid #BFDBFE;
    }
    .badge-cash {
        background: #F1F5F9;
        color: #334155;
        border: 1px solid #CBD5E1;
    }

    /* REVIEW DISPLAY BOX */
    .review-display-box {
        background: #FFFBEB;
        border: 1px solid #FDE68A;
        border-radius: 10px;
        padding: 10px 14px;
    }

    .review-stars-row {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .stars-gold {
        color: #F59E0B;
        font-size: 16px;
        letter-spacing: 2px;
    }

    .rating-num {
        font-size: 11px;
        font-weight: 700;
        color: #92400E;
    }

    .review-text {
        font-size: 12px;
        font-style: italic;
        color: #78350F;
        margin-top: 4px;
    }

    /* FOOTER */
    .order-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #F1F5F9;
        padding-top: 14px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .total-lbl {
        font-size: 11px;
        color: #64748B;
        font-weight: 600;
    }

    .order-total-amount {
        font-size: 18px;
        font-weight: 800;
        color: #0F172A;
    }

    .action-btn-group {
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn-action {
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        padding: 7px 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.15s;
        border: 1px solid transparent;
    }

    .btn-wa {
        background: #ECFDF5;
        border-color: #A7F3D0;
        color: #059669;
    }
    .btn-wa:hover {
        background: #10B981;
        color: #FFFFFF;
    }

    .btn-cancel-order {
        background: #FFF1F2;
        border-color: #FECDD3;
        color: #BE123C;
    }
    .btn-cancel-order:hover {
        background: #E11D48;
        color: #FFFFFF;
    }

    .btn-complete {
        background: #10B981;
        color: #FFFFFF;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25);
    }
    .btn-complete:hover {
        background: #059669;
    }

    .btn-review {
        background: #FFFBEB;
        border-color: #FDE68A;
        color: #B45309;
    }
    .btn-review:hover {
        background: #F59E0B;
        color: #FFFFFF;
    }

    .btn-delete-history {
        background: #F1F5F9;
        border-color: #CBD5E1;
        color: #64748B;
    }
    .btn-delete-history:hover {
        background: #E2E8F0;
        color: #0F172A;
    }

    /* EMPTY STATE */
    .empty-orders-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 48px 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 8px;
    }

    .empty-icon-wrap {
        width: 72px;
        height: 72px;
        border-radius: 20px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 6px;
    }

    .empty-title {
        font-size: 17px;
        font-weight: 800;
        color: #0F172A;
    }

    .empty-desc {
        font-size: 13px;
        color: #64748B;
        max-width: 440px;
        line-height: 1.5;
    }

    .empty-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .btn-reset-tab {
        background: #F1F5F9;
        border: 1px solid #CBD5E1;
        color: #334155;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 16px;
        border-radius: 10px;
        text-decoration: none;
    }

    .btn-start-shopping {
        background: #10B981;
        color: #FFFFFF;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 18px;
        border-radius: 10px;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }
    .btn-start-shopping:hover {
        background: #059669;
    }

    /* CUSTOM PAGINATION CSS - ZERO UNSTYLED BREAKS */
    .laris-pagination-wrap {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 14px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.02);
        margin-top: 10px;
    }

    .pagination-info {
        font-size: 12px;
        color: #64748B;
    }
    .pagination-info strong {
        color: #0F172A;
    }

    .pagination-nav {
        display: flex;
        align-items: center;
    }

    /* Complete Bootstrap 4 / Laravel Pagination Overrides */
    .pagination-nav .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 6px;
        align-items: center;
    }

    .pagination-nav .page-item {
        display: inline-block;
    }

    .pagination-nav .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 10px;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        background: #FFFFFF;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.15s ease;
    }

    .pagination-nav .page-link:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
        color: #0F172A;
    }

    .pagination-nav .page-item.active .page-link {
        background: #0F172A;
        border-color: #0F172A;
        color: #FFFFFF;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.15);
    }

    .pagination-nav .page-item.disabled .page-link {
        opacity: 0.4;
        cursor: not-allowed;
        background: #F8FAFC;
        border-color: #E2E8F0;
    }

    /* MODAL OVERLAY & CARD STYLING */
    .modal-overlay-custom {
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

    .modal-card-custom {
        background: #FFFFFF;
        border-radius: 18px;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.3);
        overflow: hidden;
        animation: scaleIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes scaleIn {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .mcc-header {
        background: #0F172A;
        color: #FFFFFF;
        padding: 18px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .mcc-title {
        font-size: 16px;
        font-weight: 800;
    }

    .mcc-subtitle {
        font-size: 11px;
        color: #94A3B8;
        margin-top: 2px;
    }

    .mcc-close {
        background: transparent;
        border: none;
        color: #94A3B8;
        font-size: 24px;
        line-height: 1;
        cursor: pointer;
    }
    .mcc-close:hover { color: #FFFFFF; }

    .mcc-body {
        padding: 20px 22px;
    }

    .mcc-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 6px;
    }

    .cancel-reason-options {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .reason-radio {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #334155;
        cursor: pointer;
        background: #F8FAFC;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
    }
    .reason-radio:hover {
        border-color: #CBD5E1;
    }

    .mcc-textarea {
        width: 100%;
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 12px;
        font-family: inherit;
        outline: none;
        resize: vertical;
        box-sizing: border-box;
    }
    .mcc-textarea:focus {
        border-color: #10B981;
        background: #FFFFFF;
    }

    .star-rating-selector {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        padding: 10px 0;
    }

    .stars-row {
        display: flex;
        gap: 8px;
    }

    .star-btn {
        font-size: 36px;
        color: #CBD5E1;
        cursor: pointer;
        transition: transform 0.12s, color 0.12s;
    }
    .star-btn:hover {
        transform: scale(1.15);
    }
    .star-btn.active {
        color: #F59E0B;
    }

    .rating-label-desc {
        font-size: 12px;
        font-weight: 700;
        color: #B45309;
    }

    .mcc-footer {
        background: #F8FAFC;
        border-top: 1px solid #F1F5F9;
        padding: 14px 22px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-mcc-cancel {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        color: #475569;
        font-weight: 700;
        font-size: 12px;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
    }

    .btn-mcc-confirm-danger {
        background: #E11D48;
        border: none;
        color: #FFFFFF;
        font-weight: 700;
        font-size: 12px;
        padding: 8px 18px;
        border-radius: 8px;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(225, 29, 72, 0.3);
    }
    .btn-mcc-confirm-danger:hover {
        background: #BE123C;
    }

    .btn-mcc-confirm-success {
        background: #10B981;
        border: none;
        color: #FFFFFF;
        font-weight: 700;
        font-size: 12px;
        padding: 8px 18px;
        border-radius: 8px;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }
    .btn-mcc-confirm-success:hover {
        background: #059669;
    }

    @media (max-width: 768px) {
        .orders-header-card { flex-direction: column; align-items: flex-start; }
        .order-progress-track { overflow-x: auto; }
        .order-details-grid { grid-template-columns: 1fr; }
        .laris-pagination-wrap { flex-direction: column; gap: 12px; align-items: flex-start; }
    }
</style>

<script>
    // --- Cancel Order Modal ---
    function openCancelModal(orderId, orderNum) {
        document.getElementById('cancelModalOrderNum').innerText = 'Nomor Pesanan: #' + orderNum;
        document.getElementById('cancelOrderForm').action = '/user/orders/' + orderId + '/cancel';
        document.getElementById('cancelOrderModal').style.display = 'flex';
    }

    function closeCancelModal() {
        document.getElementById('cancelOrderModal').style.display = 'none';
    }

    function toggleCustomReason(isOther) {
        document.getElementById('customReasonWrap').style.display = isOther ? 'block' : 'none';
        if (!isOther) {
            const selected = document.querySelector('input[name="reason_choice"]:checked');
            if (selected) {
                document.getElementById('cancelReasonInput').value = selected.value;
            }
        } else {
            document.getElementById('cancelReasonInput').value = '';
            document.getElementById('cancelReasonInput').focus();
        }
    }

    // --- Confirm Received Action ---
    function confirmReceiveOrder(orderId, orderNum) {
        larisConfirm(
            "Konfirmasi Pesanan Diterima?",
            `Apakah Anda sudah menerima seluruh pesanan <strong>#${orderNum}</strong> dengan baik dan sesuai?`,
            function() {
                document.getElementById('formComplete-' + orderId).submit();
            },
            null,
            "Ya, Sudah Diterima",
            "Batal",
            "success"
        );
    }

    // --- Delete Order History Action ---
    function confirmDeleteOrder(orderId, orderNum) {
        larisConfirm(
            "Hapus Riwayat Pesanan?",
            `Riwayat pesanan <strong>#${orderNum}</strong> akan dihapus permanen dari akun Anda.<br><br>Apakah Anda yakin?`,
            function() {
                document.getElementById('formDelete-' + orderId).submit();
            },
            null,
            "Ya, Hapus Riwayat",
            "Batal",
            "danger"
        );
    }

    // --- Review Order Modal ---
    const ratingLabels = {
        1: "1 Bintang - Kecewa, Perlu Ditingkatkan",
        2: "2 Bintang - Kurang Memuaskan",
        3: "3 Bintang - Cukup Standar",
        4: "4 Bintang - Enak & Memuaskan!",
        5: "5 Bintang - Sangat Memuaskan & Direkomendasikan! ⭐"
    };

    function openReviewModal(orderId, orderNum, storeName) {
        document.getElementById('reviewModalStoreName').innerText = storeName + ' • #' + orderNum;
        document.getElementById('reviewOrderForm').action = '/user/orders/' + orderId + '/review';
        setRating(5);
        document.getElementById('reviewOrderModal').style.display = 'flex';
    }

    function closeReviewModal() {
        document.getElementById('reviewOrderModal').style.display = 'none';
    }

    function setRating(val) {
        document.getElementById('inputRatingValue').value = val;
        document.getElementById('ratingTextLabel').innerText = ratingLabels[val] || (val + " Bintang");

        const starBtns = document.querySelectorAll('.star-btn');
        starBtns.forEach(btn => {
            const starVal = parseInt(btn.getAttribute('data-val'));
            if (starVal <= val) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }

    // --- Live Auto-Update Polling for Order Status ---
    let previousStatuses = {};
    document.querySelectorAll('.order-card[data-order-id]').forEach(card => {
        let oid = card.getAttribute('data-order-id');
        let badge = document.getElementById('order-badge-' + oid);
        if (badge) {
            previousStatuses[oid] = badge.innerText.trim();
        }
    });

    function pollLiveOrderStatus() {
        fetch("{{ route('user.orders.live_status') }}")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && data.orders) {
                    data.orders.forEach(ord => {
                        let card = document.querySelector(`.order-card[data-order-id="${ord.id}"]`);
                        let badge = document.getElementById('order-badge-' + ord.id);
                        let track = document.getElementById('order-track-' + ord.id);

                        if (badge) {
                            let oldLabel = previousStatuses[ord.id];
                            if (oldLabel && oldLabel !== ord.display_label) {
                                larisToast(`Status Pesanan #${ord.order_number} berubah: ${ord.display_label}!`, 'success', 5000);
                                previousStatuses[ord.id] = ord.display_label;
                                if (card) {
                                    card.style.transition = 'all 0.5s ease';
                                    card.style.boxShadow = '0 0 0 3px #10B981';
                                    setTimeout(() => { card.style.boxShadow = ''; }, 3000);
                                }
                            }
                            badge.className = 'order-status-badge ' + ord.badge_class;
                            badge.innerHTML = `<span class="status-dot"></span><span>${ord.display_label}</span>`;
                        }

                        if (track && ord.step > 0) {
                            let step1 = track.children[0];
                            let line1 = track.children[1];
                            let step2 = track.children[2];
                            let line2 = track.children[3];
                            let step3 = track.children[4];
                            let line3 = track.children[5];
                            let step4 = track.children[6];

                            if (line1) line1.className = 'step-line ' + (ord.step >= 2 ? 'active' : '');
                            if (step2) step2.className = 'step-item ' + (ord.step === 2 ? 'current' : (ord.step > 2 ? 'completed' : ''));
                            if (line2) line2.className = 'step-line ' + (ord.step >= 3 ? 'active' : '');
                            if (step3) step3.className = 'step-item ' + (ord.step === 3 ? 'current' : (ord.step > 3 ? 'completed' : ''));
                            if (line3) line3.className = 'step-line ' + (ord.step >= 4 ? 'active' : '');
                            if (step4) step4.className = 'step-item ' + (ord.step === 4 ? 'completed' : '');
                        }
                    });
                }
            })
            .catch(e => console.warn('Polling error:', e));
    }

    // Auto update every 5 seconds
    setInterval(pollLiveOrderStatus, 5000);
</script>
@endsection
