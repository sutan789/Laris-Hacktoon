@extends('layouts.app', ['title' => 'Smart Inventory - AI Stock Health & Demand Forecasting'])

@section('content')
<div class="inventory-page">

    <!-- 1. GLOSSY HEADER BAR -->
    <div class="dash-header">
        <div class="header-main-info">
            <div class="greeting-row">
                <h1 class="page-greeting">Smart <span class="store-gradient-name">Inventory</span></h1>
                <span class="verified-store-badge">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="#10B981"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                    <span>Stok &amp; PO Cerdas</span>
                </span>
                <span class="live-status-pill">
                    <span class="pulse-dot"></span>
                    <span>Monitoring Realtime</span>
                </span>
            </div>
            <p class="page-subtitle">Pantau kesehatan persediaan gudang, prediksi kehabisan stok, dan pengadaan grosir bersama antar-gerai tetangga.</p>
        </div>

        <div class="dash-actions">
            <button type="button" class="btn-timeframe-glossy" onclick="toggleBufferFilter()" id="btn-toggle-buffer">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/></svg>
                <span id="buffer-filter-label">Filter: Semua Status</span>
            </button>
            <button type="button" class="btn-download-glossy" onclick="openAddProductModal()" style="background: #10B981; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                <span>Tambah Produk Baru</span>
            </button>
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

    <!-- 2. IMMINENT STOCKOUT EMERGENCY ALERT BANNER (GLOSSY & MEWAH - DYNAMIC REAL DATA) -->
    @if(isset($emergencyProduct) && $emergencyProduct)
        @php
            $reorderQty = max(20, $emergencyProduct->min_threshold * 2);
        @endphp
        <div class="emergency-banner-glossy" id="emergency-banner">
            <div class="em-left">
                <div class="alert-icon-circle" style="width: 44px; height: 44px; border-radius: 14px;">
                    <svg width="22" height="22" fill="none" stroke="#DC2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                </div>
                <div>
                    <div class="flex-align gap-8 mb-4">
                        <span class="badge-danger-glossy">PERINGATAN STOK MENIPIS</span>
                        <h3 class="em-product-title">{{ $emergencyProduct->name }} — <strong>Sisa {{ $emergencyProduct->current_stock }} Unit</strong></h3>
                    </div>
                    <p class="em-desc">Diprediksi habis dalam <strong>{{ max(1, $emergencyProduct->stock_runway_days) }} hari</strong> berdasarkan laju rata-rata {{ round($emergencyProduct->ai_velocity ?: 5, 1) }} unit/hari. Rekomendasi restock: {{ $reorderQty }} unit dari supplier {{ $emergencyProduct->supplier_name ?: 'Distributor Ritel Resmi' }}.</p>
                </div>
            </div>

            <div class="em-actions">
                <button type="button" class="btn-timeframe-glossy" onclick="dismissEmergencyBanner()">Abaikan</button>
                <button type="button" class="btn-download-glossy" onclick="openRestockModal({{ $emergencyProduct->id }}, '{{ addslashes($emergencyProduct->name) }}', '{{ $emergencyProduct->sku }}', {{ $emergencyProduct->current_stock }}, {{ $emergencyProduct->min_threshold }}, {{ $emergencyProduct->cost_price }}, '{{ addslashes($emergencyProduct->supplier_name ?? '') }}', '{{ $emergencyProduct->image_url ?? '' }}')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                    <span>Restock Cepat</span>
                </button>
            </div>
        </div>
    @endif

    <!-- 3. INVENTORY HEALTH OVERVIEW (3 GLOSSY KPI CARDS) -->
    <div class="inventory-kpi-grid">
        <!-- HEALTHY -->
        <div class="kpi-card card-glossy">
            <div class="kpi-top">
                <span class="kpi-title">Stok Sehat (Aman)</span>
                <span class="kpi-badge badge-mint">&gt; 14 Hari</span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val text-green">85%</h2>
            </div>
            <div class="kpi-status-foot">
                <span class="dot-green"></span>
                <span>68 SKU dalam kondisi aman</span>
            </div>
        </div>

        <!-- ATTENTION NEEDED -->
        <div class="kpi-card card-glossy">
            <div class="kpi-top">
                <span class="kpi-title">Perlu Perhatian</span>
                <span class="kpi-badge badge-slate">5 - 7 Hari</span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val text-amber">10%</h2>
            </div>
            <div class="kpi-status-foot">
                <span class="dot-amber"></span>
                <span>8 SKU mendekati batas reorder</span>
            </div>
        </div>

        <!-- CRITICAL ALERT -->
        <div class="kpi-card card-glossy">
            <div class="kpi-top">
                <span class="kpi-title">Stok Kritis</span>
                <span class="kpi-badge badge-danger-glossy">&lt; 4 Hari</span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val text-red">5%</h2>
            </div>
            <div class="kpi-status-foot">
                <span class="dot-red"></span>
                <span>4 SKU segera habis tanpa restock</span>
            </div>
        </div>
    </div>

    <!-- 4. INVENTORY HEALTH & REORDER MATRIX (TABLE) -->
    <div class="card-panel">
        <div class="panel-header">
            <div>
                <h3 class="panel-title">Daftar Inventaris &amp; Matriks Reorder</h3>
                <p class="panel-subtitle">Laju penjualan harian real-time dan estimasi hari tersisa sebelum habis</p>
            </div>

            <div class="dash-actions">
                <select class="btn-timeframe-glossy" id="filter-status" onchange="applyInventoryFilter()">
                    <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>Semua Status ({{ $totalSku }})</option>
                    <option value="critical" {{ request('status') == 'critical' ? 'selected' : '' }}>Kritis ({{ $criticalCount }})</option>
                    <option value="attention" {{ request('status') == 'attention' ? 'selected' : '' }}>Perhatian ({{ $attentionCount }})</option>
                    <option value="healthy" {{ request('status') == 'healthy' ? 'selected' : '' }}>Sehat ({{ $healthyCount }})</option>
                </select>

                <select class="btn-timeframe-glossy" id="filter-category" onchange="applyInventoryFilter()">
                    <option value="all" {{ request('category') == 'all' || !request('category') ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="Biji Kopi" {{ request('category') == 'Biji Kopi' ? 'selected' : '' }}>Biji Kopi</option>
                    <option value="Stationery" {{ request('category') == 'Stationery' ? 'selected' : '' }}>Stationery</option>
                    <option value="Packaging" {{ request('category') == 'Packaging' ? 'selected' : '' }}>Packaging</option>
                    <option value="Dairy" {{ request('category') == 'Dairy' ? 'selected' : '' }}>Dairy</option>
                    <option value="Lifestyle" {{ request('category') == 'Lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                </select>

                <button type="button" class="btn-timeframe-glossy" onclick="exportInventoryCsv()" title="Unduh CSV">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                    <span>CSV</span>
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="laris-table-glossy">
                <thead>
                    <tr>
                        <th>NAMA PRODUK</th>
                        <th>KODE SKU</th>
                        <th>KATEGORI</th>
                        <th>STOK SAAT INI</th>
                        <th>STATUS</th>
                        <th>KECEPATAN AI</th>
                        <th>SISA HARI (RUNWAY)</th>
                        <th style="text-align: right;">AKSI CEPAT</th>
                    </tr>
                </thead>
                <tbody id="inventory-table-body">
                    @forelse($products as $prod)
                        @php
                            $isCrit = $prod->health_status === 'Critical';
                            $isAttn = $prod->health_status === 'Attention';
                            $statusBadge = $isCrit ? 'badge-danger-glossy' : ($isAttn ? 'badge-amber-glossy' : 'badge-mint');
                        @endphp
                        <tr>
                            <td>
                                <div class="prod-cell">
                                    <img class="prod-thumb" src="{{ $prod->image_url ?? 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=80&auto=format&fit=crop&q=80' }}" alt="{{ $prod->name }}">
                                    <div>
                                        <strong class="prod-t-name">{{ $prod->name }}</strong>
                                        <span class="prod-t-sub">Supplier: {{ $prod->supplier_name ?? 'Mitra Utama' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="sku-code-glossy">{{ $prod->sku }}</span></td>
                            <td>{{ $prod->category }}</td>
                            <td>
                                <strong>{{ $prod->current_stock }} {{ $prod->unit }}</strong>
                                <span class="min-threshold">Min: {{ $prod->min_threshold }}</span>
                            </td>
                            <td><span class="{{ $statusBadge }}">{{ $prod->health_status }}</span></td>
                            <td><strong>{{ number_format($prod->ai_velocity, 1) }}</strong> <small style="color: var(--text-muted);">unit/hari</small></td>
                            <td>
                                <div class="runway-cell">
                                    <strong>{{ $prod->stock_runway_days }} Hari</strong>
                                    <div class="kpi-progress-bar" style="margin-top: 4px; width: 80px;">
                                        <div class="progress-fill" style="width: {{ min(100, max(10, ($prod->stock_runway_days / 30) * 100)) }}%;"></div>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; align-items: center; justify-content: flex-end; gap: 6px;">
                                    <button type="button" class="btn-action-glossy" style="padding: 6px 12px; font-size: 11.5px;" onclick="openRestockModal({{ $prod->id }}, '{{ addslashes($prod->name) }}', '{{ $prod->sku }}', {{ $prod->current_stock }}, {{ $prod->min_threshold }}, {{ $prod->cost_price }}, '{{ addslashes($prod->supplier_name ?? 'Distributor Ritel') }}', '{{ $prod->image_url ?? 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=100' }}')" title="Restock Cepat">
                                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                        <span>Restock</span>
                                    </button>
                                    <button type="button" class="btn-timeframe-glossy" style="padding: 6px 9px; font-size: 11px; border-radius: 8px;" onclick='openEditProductModal(@json($prod))' title="Edit Rincian Produk">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/></svg>
                                    </button>
                                    <button type="button" class="btn-timeframe-glossy" style="padding: 6px 9px; font-size: 11px; border-radius: 8px; color: #EF4444; border-color: rgba(239, 68, 68, 0.35);" onclick="confirmDeleteProduct({{ $prod->id }}, '{{ addslashes($prod->name) }}')" title="Hapus Produk dari Inventaris">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 30px; color: #64748B;">
                                Tidak ada produk yang sesuai dengan filter yang dipilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-foot-row">
            <span class="foot-ai-hint">
                <span class="pulse-dot"></span>
                <span>AI merekomendasikan reorder malam ini untuk menghemat ongkir supplier s.d. 18%</span>
            </span>
            <div class="pagination-row">
                <span class="page-meta">Menampilkan {{ $products->count() }} dari {{ $totalSku }} SKU</span>
            </div>
        </div>
    </div>

    <!-- 5. JURAGAN AI RESTOCK OPTIMIZER (AUTO-BUNDLE PO) -->
    <div class="instant-insight-banner">
        <div class="insight-left">
            <div class="ai-gem-icon">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
            </div>
            <div class="insight-text">
                <div class="insight-tag">PENGHEMATAN ONGKIR SUPPLIER (AUTO-BUNDLE PO)</div>
                <p>Terdapat 2 item kritis dari distributor regional yang sama. Menggabungkan pesanan ke 1 Purchase Order menghemat ongkir logistik s.d. <strong>18%</strong> dan mencegah potensi <strong>lost-sales Rp 2.850.000</strong>.</p>
            </div>
        </div>
        <form action="{{ route('inventory.auto_bundle') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="btn-insight-action">
                <span>Buat PO Gabungan</span>
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            </button>
        </form>
    </div>

    <!-- 6. PENGADAAN GROSIR BERSAMA ANTAR-GERAI (B2B POOL) -->
    <div class="card-panel" id="kulakan-bareng-section">
        <div class="panel-header">
            <div>
                <div class="tag-pill-glossy" style="margin-bottom: 6px; display: inline-block;">PENGADAAN GROSIR BERSAMA</div>
                <h3 class="panel-title">Pengadaan Grosir Bersama Antar-Gerai Sekitar</h3>
                <p class="panel-subtitle">Gabungkan kuota belanja dengan gerai sekitar untuk harga grosir Tier-1 (diskon 12% - 18%). Ongkir dibagi rata otomatis.</p>
            </div>
            <button type="button" class="btn-timeframe-glossy" onclick="openProposePoolModal()">
                <span>Usulkan Pengadaan Baru</span>
            </button>
        </div>

        <div class="kulakan-grid">
            <!-- POOL 1 -->
            <div class="pool-card-glossy">
                <div class="pool-top-flex">
                    <span class="pool-supplier-tag">Wilmar Distributor Resmi</span>
                    <span class="badge-mint">Sisa 4j 20m</span>
                </div>
                <h4 class="pool-item-name">Minyak Goreng Sawit 2L (Pouch)</h4>
                <div class="pool-price-box">
                    <div>
                        <span class="pool-lbl">Harga Grosir Bersama:</span>
                        <div class="pool-price-val">Rp 28.500 <small>/pouch</small></div>
                    </div>
                    <span class="badge-mint">-16% OFF</span>
                </div>
                <div class="pool-sub-price">Harga Pasar: <s>Rp 34.000</s> (Hemat Rp 5.500/unit)</div>

                <div class="pool-progress-wrap mt-12">
                    <div class="pool-progress-meta">
                        <span>Terkumpul: <strong>78 / 100 Pouch</strong></span>
                        <strong class="text-green">78%</strong>
                    </div>
                    <div class="kpi-progress-bar"><div class="progress-fill" style="width: 78%;"></div></div>
                    <div class="pool-participants">14 Gerai mitra telah bergabung</div>
                </div>

                <button type="button" class="btn-spotlight-action mt-16" onclick="openJoinPoolModal('Minyak Goreng Sawit 2L (Pouch)', 'Wilmar Distributor Resmi', 28500, 34000, 78, 100, 'Pouch')">
                    <span>Gabung Pengadaan Ini</span>
                </button>
            </div>

            <!-- POOL 2 -->
            <div class="pool-card-glossy">
                <div class="pool-top-flex">
                    <span class="pool-supplier-tag">Koperasi Beras Cianjur</span>
                    <span class="badge-blue">Sisa 7j 15m</span>
                </div>
                <h4 class="pool-item-name">Beras Premium Setra Ramos 5kg</h4>
                <div class="pool-price-box">
                    <div>
                        <span class="pool-lbl">Harga Grosir Bersama:</span>
                        <div class="pool-price-val">Rp 64.000 <small>/sak</small></div>
                    </div>
                    <span class="badge-mint">-14% OFF</span>
                </div>
                <div class="pool-sub-price">Harga Pasar: <s>Rp 74.500</s> (Hemat Rp 10.500/sak)</div>

                <div class="pool-progress-wrap mt-12">
                    <div class="pool-progress-meta">
                        <span>Terkumpul: <strong>112 / 150 Sak</strong></span>
                        <strong class="text-green">74%</strong>
                    </div>
                    <div class="kpi-progress-bar"><div class="progress-fill" style="width: 74%;"></div></div>
                    <div class="pool-participants">19 Gerai mitra telah bergabung</div>
                </div>

                <button type="button" class="btn-spotlight-action mt-16" onclick="openJoinPoolModal('Beras Premium Setra Ramos 5kg', 'Koperasi Beras Cianjur', 64000, 74500, 112, 150, 'Sak')">
                    <span>Gabung Pengadaan Ini</span>
                </button>
            </div>

            <!-- POOL 3 -->
            <div class="pool-card-glossy">
                <div class="pool-top-flex">
                    <span class="pool-supplier-tag">Indofood Direct Regional</span>
                    <span class="badge-lime">Hampir Penuh</span>
                </div>
                <h4 class="pool-item-name">Indomie Goreng Spesial 40x85g (Dus)</h4>
                <div class="pool-price-box">
                    <div>
                        <span class="pool-lbl">Harga Grosir Bersama:</span>
                        <div class="pool-price-val">Rp 108.000 <small>/dus</small></div>
                    </div>
                    <span class="badge-mint">-12% OFF</span>
                </div>
                <div class="pool-sub-price">Harga Pasar: <s>Rp 123.000</s> (Hemat Rp 15.000/dus)</div>

                <div class="pool-progress-wrap mt-12">
                    <div class="pool-progress-meta">
                        <span>Terkumpul: <strong>190 / 200 Dus</strong></span>
                        <strong class="text-green">95%</strong>
                    </div>
                    <div class="kpi-progress-bar"><div class="progress-fill" style="width: 95%;"></div></div>
                    <div class="pool-participants">27 Gerai mitra telah bergabung</div>
                </div>

                <button type="button" class="btn-spotlight-action mt-16" onclick="openJoinPoolModal('Indomie Goreng Spesial 40x85g (Dus)', 'Indofood Direct Regional', 108000, 123000, 190, 200, 'Dus')">
                    <span>Gabung Pengadaan Ini</span>
                </button>
            </div>
        </div>
    </div>

</div>

<!-- MODAL TAMBAH PRODUK BARU LENGKAP & DETAIL (GLOSSY & PERSISTEN KE DATABASE) -->
<div id="modal-add-product" class="laris-modal-overlay" style="position: fixed; inset: 0; background: rgba(11, 19, 27, 0.75); backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; z-index: 9999; padding: 20px;">
    <div class="card-panel" style="width: 100%; max-width: 680px; max-height: 90vh; overflow-y: auto; padding: 0; border-radius: 20px; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35); border: 1px solid #E2E8F0;">
        
        <!-- MODAL HEADER -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 26px; background: linear-gradient(135deg, #0B131B, #1E293B); border-bottom: 1px solid rgba(255, 255, 255, 0.1); color: #FFFFFF;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(16, 185, 129, 0.2); border: 1px solid #10B981; display: flex; align-items: center; justify-content: center; color: #10B981;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                </div>
                <div>
                    <h3 style="font-size: 16.5px; font-weight: 800; color: #FFFFFF; margin: 0;">Tambah Produk Baru ke Inventaris</h3>
                    <p style="font-size: 12px; color: #94A3B8; margin: 2px 0 0 0;">Lengkapi rincian finansial, HPP, harga jual &amp; foto produk</p>
                </div>
            </div>
            <button type="button" onclick="closeAddProductModal()" style="background: rgba(255, 255, 255, 0.1); border: none; color: #94A3B8; width: 32px; height: 32px; border-radius: 8px; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#94A3B8'">&times;</button>
        </div>

        <!-- FORM INPUT -->
        <form action="{{ route('inventory.store_product') }}" method="POST" style="padding: 24px 26px; display: flex; flex-direction: column; gap: 16px;">
            @csrf

            <!-- NAMA PRODUK & SKU -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Nama Produk <span style="color:#EF4444;">*</span></label>
                    <input type="text" name="name" id="inp-prod-name" class="input-field-glossy" placeholder="Contoh: Masker KN95 Anti-Asap PM2.5" required>
                </div>
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Kode SKU / Barcode</label>
                    <input type="text" name="sku" id="inp-prod-sku" class="input-field-glossy" placeholder="Contoh: MSK-KN95-01">
                </div>
            </div>

            <!-- KATEGORI & LAJU AI -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Kategori Produk <span style="color:#EF4444;">*</span></label>
                    <select name="category" id="inp-prod-cat" class="select-field-glossy" required style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 13px;">
                        <option value="Kesehatan & Proteksi Darurat">Kesehatan &amp; Proteksi Darurat</option>
                        <option value="Kebutuhan Pokok">Kebutuhan Pokok &amp; Sembako</option>
                        <option value="Minuman & Kopi">Minuman &amp; Biji Kopi</option>
                        <option value="Makanan & Camilan">Makanan &amp; Camilan</option>
                        <option value="Aksesoris & Lifestyle">Aksesoris &amp; Lifestyle</option>
                        <option value="Perawatan Diri">Perawatan Diri &amp; Rumah Tangga</option>
                    </select>
                </div>
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Estimasi Laju Penjualan (Unit/Hari)</label>
                    <input type="number" step="0.5" name="ai_velocity" id="inp-prod-velocity" class="input-field-glossy" value="8" min="0.1" required>
                </div>
            </div>

            <!-- FINANSIAL: HARGA BELI (HPP) & HARGA JUAL -->
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px;">
                <div style="font-size: 11px; font-weight: 800; color: #64748B; text-transform: uppercase; margin-bottom: 10px;">STRUKTUR FINANSIAL &amp; KALKULASI MARGIN</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="form-group-glossy">
                        <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Harga Beli / HPP Modal (Rp) <span style="color:#EF4444;">*</span></label>
                        <input type="number" name="cost_price" id="inp-prod-cost" class="input-field-glossy" placeholder="20000" value="20000" min="0" oninput="calculateModalMargin()" required>
                    </div>
                    <div class="form-group-glossy">
                        <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Harga Jual Kasir / POS (Rp) <span style="color:#EF4444;">*</span></label>
                        <input type="number" name="selling_price" id="inp-prod-price" class="input-field-glossy" placeholder="42000" value="42000" min="0" oninput="calculateModalMargin()" required>
                    </div>
                </div>

                <!-- LIVE MARGIN INDICATOR -->
                <div id="modal-margin-indicator" style="margin-top: 12px; padding: 10px 14px; background: rgba(16, 185, 129, 0.1); border: 1px solid #10B981; border-radius: 10px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <span style="font-size: 11px; color: #065F46; font-weight: 700;">PROYEKSI LABA KOTOR:</span>
                        <div id="modal-margin-text" style="font-size: 14px; font-weight: 800; color: #059669;">Rp 22.000 / unit (Margin 52.4%)</div>
                    </div>
                    <span id="modal-margin-badge" style="font-size: 10.5px; font-weight: 800; background: #10B981; color: #FFFFFF; padding: 3px 8px; border-radius: 6px;">Sangat Sehat</span>
                </div>
            </div>

            <!-- MANAJEMEN STOK & SUPPLIER -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Stok Awal di Gudang (Unit) <span style="color:#EF4444;">*</span></label>
                    <input type="number" name="current_stock" id="inp-prod-stock" class="input-field-glossy" value="50" min="0" required>
                </div>
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Batas Minimum Alert (Unit) <span style="color:#EF4444;">*</span></label>
                    <input type="number" name="min_threshold" id="inp-prod-min" class="input-field-glossy" value="15" min="1" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Nama Distributor / Supplier</label>
                    <input type="text" name="supplier_name" id="inp-prod-supplier" class="input-field-glossy" placeholder="Contoh: PT Mitra Medika Sentosa">
                </div>
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Lead Time (Hari)</label>
                    <input type="number" name="supplier_lead_time_days" class="input-field-glossy" value="2" min="1">
                </div>
            </div>

            <!-- GAMBAR PRODUK & PRESET CEPAT -->
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px;">
                <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Gambar / Foto Produk (URL)</label>
                <div style="display: flex; gap: 12px; align-items: center; margin-top: 6px;">
                    <img id="product-img-preview" src="https://images.unsplash.com/photo-1584634731339-252c581abfc5?w=400&auto=format&fit=crop&q=80" alt="Preview" style="width: 56px; height: 56px; border-radius: 10px; object-fit: cover; border: 1px solid #CBD5E1; background: #FFFFFF;">
                    <input type="url" name="image_url" id="inp-prod-img" class="input-field-glossy" value="https://images.unsplash.com/photo-1584634731339-252c581abfc5?w=400&auto=format&fit=crop&q=80" placeholder="https://..." oninput="document.getElementById('product-img-preview').src = this.value || 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=400&auto=format&fit=crop&q=80'" style="flex: 1;">
                </div>
                
                <!-- PRESET CHIPS FOTO POPULER -->
                <div style="margin-top: 10px;">
                    <span style="font-size: 11px; color: #64748B; font-weight: 600;">Pintasan Foto Cepat:</span>
                    <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-top: 6px;">
                        <button type="button" class="preset-img-chip" onclick="applyImagePreset('https://images.unsplash.com/photo-1584634731339-252c581abfc5?w=400&auto=format&fit=crop&q=80', 'Masker KN95 Anti-Asap PM2.5', 'Kesehatan & Proteksi Darurat', 20000, 42000, 'PT Mitra Medika Sentosa')">Masker KN95</button>
                        <button type="button" class="preset-img-chip" onclick="applyImagePreset('https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=400&auto=format&fit=crop&q=80', 'Kopi Arabica Gayo Premium 250g', 'Minuman & Kopi', 48000, 75000, 'PT Kopi Nusantara')">Kopi Arabica</button>
                        <button type="button" class="preset-img-chip" onclick="applyImagePreset('https://images.unsplash.com/photo-1586201375761-83865001e31c?w=400&auto=format&fit=crop&q=80', 'Beras Premium Setra Ramos 5kg', 'Kebutuhan Pokok', 62000, 74000, 'Koperasi Beras Cianjur')">Beras 5kg</button>
                        <button type="button" class="preset-img-chip" onclick="applyImagePreset('https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&auto=format&fit=crop&q=80', 'Minyak Goreng Sawit 2L', 'Kebutuhan Pokok', 28500, 34000, 'Wilmar Distributor')">Minyak Sawit 2L</button>
                        <button type="button" class="preset-img-chip" onclick="applyImagePreset('https://images.unsplash.com/photo-1612927601601-6638404737ce?w=400&auto=format&fit=crop&q=80', 'Indomie Goreng Spesial Dus', 'Makanan & Camilan', 108000, 125000, 'Indofood Direct')">Indomie Dus</button>
                    </div>
                </div>
            </div>

            <!-- BUTTONS (NO DUPLICATE PLUS ICON!) -->
            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="button" onclick="closeAddProductModal()" style="flex: 1; padding: 12px; border-radius: 10px; border: 1px solid #CBD5E1; background: #F8FAFC; color: #475569; font-weight: 700; font-size: 13px; cursor: pointer;">Batal</button>
                <button type="submit" style="flex: 2; padding: 12px; border-radius: 10px; border: none; background: #10B981; color: #FFFFFF; font-weight: 800; font-size: 13px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    <span>Simpan Produk ke Gudang</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL INTERAKTIF: RESTOCK CEPAT DENGAN INPUT JUMLAH BARANG (REAL BACKEND & DATABASE PERSISTENCE) -->
<div id="modal-quick-restock" class="laris-modal-overlay" style="position: fixed; inset: 0; background: rgba(11, 19, 27, 0.75); backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; z-index: 9999; padding: 20px;">
    <div class="card-panel" style="width: 100%; max-width: 520px; padding: 0; overflow: hidden; border-radius: 20px; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35); border: 1px solid #E2E8F0;">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 24px; background: linear-gradient(135deg, #0B131B, #1E293B); border-bottom: 1px solid rgba(255, 255, 255, 0.1); color: #FFFFFF;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 36px; height: 36px; border-radius: 10px; background: rgba(16, 185, 129, 0.2); border: 1px solid #10B981; display: flex; align-items: center; justify-content: center; color: #10B981;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                </div>
                <div>
                    <h3 style="font-size: 16px; font-weight: 800; color: #FFFFFF; margin: 0;">Restock Cepat Barang</h3>
                    <p style="font-size: 11.5px; color: #94A3B8; margin: 0;">Tentukan jumlah unit yang ingin dipesan ulang ke supplier</p>
                </div>
            </div>
            <button type="button" onclick="closeRestockModal()" style="background: rgba(255, 255, 255, 0.1); border: none; color: #94A3B8; width: 30px; height: 30px; border-radius: 8px; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#94A3B8'">&times;</button>
        </div>

        <form id="form-quick-restock" method="POST" action="" style="padding: 24px; display: flex; flex-direction: column; gap: 16px;">
            @csrf

            <!-- Product Summary Card -->
            <div style="display: flex; gap: 14px; align-items: center; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 14px;">
                <img id="restock-prod-img" src="" alt="Thumbnail" style="width: 52px; height: 52px; border-radius: 10px; object-fit: cover; border: 1px solid #CBD5E1;">
                <div style="flex: 1; min-width: 0;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <strong id="restock-prod-name" style="font-size: 14px; color: #0F172A; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Nama Produk</strong>
                        <span id="restock-prod-sku" class="sku-code-glossy">-</span>
                    </div>
                    <div style="font-size: 11.5px; color: #64748B; margin-top: 3px;">
                        Supplier: <strong id="restock-prod-supplier" style="color: #334155;">-</strong>
                    </div>
                    <div style="display: flex; gap: 12px; margin-top: 6px; font-size: 11.5px;">
                        <span>Stok Saat Ini: <strong id="restock-prod-current" style="color: #0F172A;">0</strong> unit</span>
                        <span>Batas Minimum: <strong id="restock-prod-min" style="color: #EF4444;">0</strong> unit</span>
                    </div>
                </div>
            </div>

            <!-- Input Jumlah Restock -->
            <div class="form-group-glossy">
                <label for="restock-qty-input" class="form-label-glossy" style="font-weight: 700; font-size: 12.5px; color: #0F172A;">
                    Jumlah Unit yang Ingin di-Restock <span style="color: #EF4444;">*</span>
                </label>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <input type="number" id="restock-qty-input" name="quantity" class="input-field-glossy" value="20" min="1" required oninput="updateRestockCalculations()" style="font-size: 16px; font-weight: 800; text-align: center; width: 120px;">
                    <span style="font-size: 13px; font-weight: 700; color: #64748B;">Unit</span>
                    
                    <!-- Quick Preset Buttons -->
                    <div style="display: flex; gap: 6px; margin-left: auto;">
                        <button type="button" class="preset-img-chip" onclick="setRestockQty(10)">+10</button>
                        <button type="button" class="preset-img-chip" onclick="setRestockQty(25)">+25</button>
                        <button type="button" class="preset-img-chip" onclick="setRestockQty(50)">+50</button>
                        <button type="button" class="preset-img-chip" onclick="setRestockQty(100)">+100</button>
                    </div>
                </div>
            </div>

            <!-- Kalkulasi Finansial Purchase Order -->
            <div style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(204, 255, 0, 0.05) 100%); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 14px; padding: 14px 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                    <span style="font-size: 11.5px; color: #065F46; font-weight: 700;">PROYEKSI STOK SETELAH RESTOCK:</span>
                    <strong id="restock-calc-new-stock" style="font-size: 14px; color: #059669;">-</strong>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 8px; border-top: 1px dashed rgba(16, 185, 129, 0.3);">
                    <span style="font-size: 12px; color: #0F172A; font-weight: 800;">TOTAL ESTIMASI BIAYA PO:</span>
                    <strong id="restock-calc-total-po" style="font-size: 18px; color: #0F172A; font-weight: 900;">Rp 0</strong>
                </div>
                <div style="font-size: 10.5px; color: #64748B; margin-top: 4px;">*Dihitung berdasarkan HPP: <span id="restock-calc-unit-hpp">Rp 0</span> / unit. Otomatis diterbitkan ke Purchase Order.</div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 10px; margin-top: 4px;">
                <button type="button" onclick="closeRestockModal()" style="flex: 1; padding: 12px; border-radius: 10px; border: 1px solid #CBD5E1; background: #F8FAFC; color: #475569; font-weight: 700; font-size: 13px; cursor: pointer;">Batal</button>
                <button type="submit" style="flex: 2; padding: 12px; border-radius: 10px; border: none; background: #0B131B; color: #CCFF00; font-weight: 800; font-size: 13px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(11, 19, 27, 0.25);">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    <span>Konfirmasi &amp; Restock Sekarang</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT PRODUK LENGKAP (UPDATE CRUD GLOSSY & PERSISTEN KE DATABASE) -->
<div id="modal-edit-product" class="laris-modal-overlay" style="position: fixed; inset: 0; background: rgba(11, 19, 27, 0.75); backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; z-index: 9999; padding: 20px;">
    <div class="card-panel" style="width: 100%; max-width: 680px; max-height: 90vh; overflow-y: auto; padding: 0; border-radius: 20px; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35); border: 1px solid #E2E8F0;">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 26px; background: linear-gradient(135deg, #0B131B, #1E293B); border-bottom: 1px solid rgba(255, 255, 255, 0.1); color: #FFFFFF;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(59, 130, 246, 0.2); border: 1px solid #3B82F6; display: flex; align-items: center; justify-content: center; color: #60A5FA;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/></svg>
                </div>
                <div>
                    <h3 style="font-size: 16.5px; font-weight: 800; color: #FFFFFF; margin: 0;">Edit Data Produk Gudang</h3>
                    <p style="font-size: 12px; color: #94A3B8; margin: 2px 0 0 0;">Perbarui harga, stok fisik, batas minimum, dan parameter supplier</p>
                </div>
            </div>
            <button type="button" onclick="closeEditProductModal()" style="background: rgba(255, 255, 255, 0.1); border: none; color: #94A3B8; width: 32px; height: 32px; border-radius: 8px; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#94A3B8'">&times;</button>
        </div>

        <form id="form-edit-product" method="POST" action="" style="padding: 24px 26px; display: flex; flex-direction: column; gap: 16px;">
            @csrf

            <!-- NAMA PRODUK & SKU (READONLY SKU) -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Nama Produk <span style="color:#EF4444;">*</span></label>
                    <input type="text" name="name" id="edit-prod-name" class="input-field-glossy" required>
                </div>
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Kode SKU</label>
                    <input type="text" id="edit-prod-sku" class="input-field-glossy" readonly style="background: #F1F5F9; color: #64748B;">
                </div>
            </div>

            <!-- KATEGORI & LAJU AI -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Kategori Produk <span style="color:#EF4444;">*</span></label>
                    <select name="category" id="edit-prod-cat" class="select-field-glossy" required style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 13px;">
                        <option value="Kesehatan & Proteksi Darurat">Kesehatan &amp; Proteksi Darurat</option>
                        <option value="Kebutuhan Pokok">Kebutuhan Pokok &amp; Sembako</option>
                        <option value="Minuman & Kopi">Minuman &amp; Biji Kopi</option>
                        <option value="Makanan & Camilan">Makanan &amp; Camilan</option>
                        <option value="Aksesoris & Lifestyle">Aksesoris &amp; Lifestyle</option>
                        <option value="Stationery & Giftware">Stationery &amp; Giftware</option>
                        <option value="Perawatan Diri">Perawatan Diri &amp; Rumah Tangga</option>
                    </select>
                </div>
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Estimasi Laju Penjualan (Unit/Hari)</label>
                    <input type="number" step="0.5" name="ai_velocity" id="edit-prod-velocity" class="input-field-glossy" min="0.1" required>
                </div>
            </div>

            <!-- FINANSIAL: HARGA BELI (HPP) & HARGA JUAL -->
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px;">
                <div style="font-size: 11px; font-weight: 800; color: #64748B; text-transform: uppercase; margin-bottom: 10px;">STRUKTUR FINANSIAL &amp; MARGIN</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="form-group-glossy">
                        <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Harga Beli / HPP Modal (Rp) <span style="color:#EF4444;">*</span></label>
                        <input type="number" name="cost_price" id="edit-prod-cost" class="input-field-glossy" min="0" oninput="calculateEditModalMargin()" required>
                    </div>
                    <div class="form-group-glossy">
                        <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Harga Jual Kasir / POS (Rp) <span style="color:#EF4444;">*</span></label>
                        <input type="number" name="selling_price" id="edit-prod-price" class="input-field-glossy" min="0" oninput="calculateEditModalMargin()" required>
                    </div>
                </div>

                <!-- LIVE MARGIN INDICATOR -->
                <div id="edit-margin-indicator" style="margin-top: 12px; padding: 10px 14px; background: rgba(16, 185, 129, 0.1); border: 1px solid #10B981; border-radius: 10px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <span style="font-size: 11px; color: #065F46; font-weight: 700;">PROYEKSI LABA KOTOR:</span>
                        <div id="edit-margin-text" style="font-size: 14px; font-weight: 800; color: #059669;">-</div>
                    </div>
                    <span id="edit-margin-badge" style="font-size: 10.5px; font-weight: 800; background: #10B981; color: #FFFFFF; padding: 3px 8px; border-radius: 6px;">Sehat</span>
                </div>
            </div>

            <!-- MANAJEMEN STOK & SUPPLIER -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Stok Fisik di Gudang (Unit) <span style="color:#EF4444;">*</span></label>
                    <input type="number" name="current_stock" id="edit-prod-stock" class="input-field-glossy" min="0" required>
                </div>
                <div class="form-group-glossy">
                    <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Batas Minimum Alert (Unit) <span style="color:#EF4444;">*</span></label>
                    <input type="number" name="min_threshold" id="edit-prod-min" class="input-field-glossy" min="1" required>
                </div>
            </div>

            <div class="form-group-glossy">
                <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Distributor / Supplier</label>
                <input type="text" name="supplier_name" id="edit-prod-supplier" class="input-field-glossy">
            </div>

            <!-- GAMBAR PRODUK -->
            <div class="form-group-glossy">
                <label class="form-label-glossy" style="font-weight: 700; font-size: 12px; color: #0F172A;">Gambar / Foto Produk (URL)</label>
                <div style="display: flex; gap: 12px; align-items: center;">
                    <img id="edit-prod-img-preview" src="" alt="Preview" style="width: 48px; height: 48px; border-radius: 10px; object-fit: cover; border: 1px solid #CBD5E1; background: #FFFFFF;">
                    <input type="url" name="image_url" id="edit-prod-img" class="input-field-glossy" style="flex: 1;" oninput="document.getElementById('edit-prod-img-preview').src = this.value">
                </div>
            </div>

            <!-- BUTTONS -->
            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="button" onclick="closeEditProductModal()" style="flex: 1; padding: 12px; border-radius: 10px; border: 1px solid #CBD5E1; background: #F8FAFC; color: #475569; font-weight: 700; font-size: 13px; cursor: pointer;">Batal</button>
                <button type="submit" style="flex: 2; padding: 12px; border-radius: 10px; border: none; background: #10B981; color: #FFFFFF; font-weight: 800; font-size: 13px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    <span>Perbarui Data Produk</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL GABUNG PENGADAAN GROSIR BERSAMA -->
<div id="modal-join-kulakan" class="laris-modal-overlay" style="position: fixed; inset: 0; background: rgba(11, 19, 27, 0.65); backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; z-index: 999; padding: 20px;">
    <div class="card-panel" style="width: 100%; max-width: 520px; padding: 0; overflow: hidden; box-shadow: 0 24px 50px rgba(0, 0, 0, 0.3);">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 24px; background: #F8FAFC; border-bottom: 1px solid #E2E8F0;">
            <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;" id="join-pool-title">Gabung Pengadaan Grosir Bersama</h3>
            <button type="button" onclick="closeJoinPoolModal()" class="alert-close-btn">&times;</button>
        </div>
        <form action="{{ route('inventory.kulakan_join') }}" method="POST" style="padding: 24px; display: flex; flex-direction: column; gap: 14px;">
            @csrf
            <input type="hidden" name="item_name" id="join-input-name" value="">
            <input type="hidden" name="estimated_savings" id="join-input-savings" value="0">

            <div class="op-alert-card-glossy" style="background: #F8FAFC;">
                <div style="font-size: 12px; color: #64748B;">Supplier: <strong id="join-pool-supplier" style="color: #0F172A;">-</strong></div>
                <div style="display: flex; justify-content: space-between; margin-top: 6px;">
                    <div>Harga Bareng: <strong id="join-pool-price" style="color: #10B981;">Rp 0</strong></div>
                    <div>Harga Ecer: <s id="join-pool-normal-price" style="color: #94A3B8;">Rp 0</s></div>
                </div>
                <div style="font-size: 11.5px; color: #64748B; margin-top: 4px;">Status Pool: <span id="join-pool-status" style="font-weight: 700; color: #0F172A;">-</span></div>
            </div>

            <div class="form-group-glossy">
                <label class="form-label-glossy">Jumlah Kuota yang Ingin Anda Ambil (<span id="join-unit-label">Unit</span>)</label>
                <input type="number" id="join-pledge-qty" name="pledge_qty" class="input-field-glossy" value="10" min="1" oninput="updateKulakanCalculations()" required>
            </div>

            <div class="gross-margin-card-glossy">
                <div>
                    <span class="gm-label">Total Pembayaran Anda</span>
                    <h3 id="join-calc-total" style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0;">Rp 0</h3>
                </div>
                <div>
                    <span class="gm-label" style="text-align: right;">Estimasi Hemat</span>
                    <strong id="join-calc-savings" style="font-size: 16px; font-weight: 800; color: #10B981; display: block; text-align: right;">+ Rp 0</strong>
                </div>
            </div>

            <button type="submit" class="btn-download-glossy" style="width: 100%; justify-content: center;">Konfirmasi Gabung Pool</button>
        </form>
    </div>
</div>

<!-- MODAL USULKAN POOL BARU -->
<div id="modal-propose-pool" class="laris-modal-overlay" style="position: fixed; inset: 0; background: rgba(11, 19, 27, 0.65); backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; z-index: 999; padding: 20px;">
    <div class="card-panel" style="width: 100%; max-width: 500px; padding: 0; overflow: hidden; box-shadow: 0 24px 50px rgba(0, 0, 0, 0.3);">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 24px; background: #F8FAFC; border-bottom: 1px solid #E2E8F0;">
            <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">Ajukan Usulan Pengadaan Grosir Bersama</h3>
            <button type="button" onclick="closeProposePoolModal()" class="alert-close-btn">&times;</button>
        </div>
        <div style="padding: 24px; display: flex; flex-direction: column; gap: 14px;">
            <div class="form-group-glossy">
                <label class="form-label-glossy">Nama Barang / Komoditas</label>
                <input type="text" id="prop-item-name" class="input-field-glossy" placeholder="Contoh: Gula Pasir Curah 50kg" required>
            </div>
            <div class="form-row-2col">
                <div class="form-group-glossy">
                    <label class="form-label-glossy">Target Minimum Pool</label>
                    <input type="number" id="prop-target-qty" class="input-field-glossy" value="100" required>
                </div>
                <div class="form-group-glossy">
                    <label class="form-label-glossy">Satuan</label>
                    <input type="text" id="prop-unit" class="input-field-glossy" value="Karung" required>
                </div>
            </div>
            <div class="form-group-glossy">
                <label class="form-label-glossy">Komitmen Kuota Anda Sendiri</label>
                <input type="number" id="prop-my-qty" class="input-field-glossy" value="20" required>
            </div>
            <button type="button" onclick="submitProposedPool()" class="btn-download-glossy" style="width: 100%; justify-content: center;">Siarkan Usulan ke Warung Tetangga</button>
        </div>
    </div>
</div>

<!-- MODAL DEMAND FORECAST DETAIL -->
<div id="modal-view-demand" class="laris-modal-overlay" style="position: fixed; inset: 0; background: rgba(11, 19, 27, 0.65); backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; z-index: 999; padding: 20px;">
    <div class="card-panel" style="width: 100%; max-width: 480px; padding: 0; overflow: hidden; box-shadow: 0 24px 50px rgba(0, 0, 0, 0.3);">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 24px; background: #F8FAFC; border-bottom: 1px solid #E2E8F0;">
            <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;" id="demand-modal-title">AI Demand Forecast</h3>
            <button type="button" onclick="closeDemandModal()" class="alert-close-btn">&times;</button>
        </div>
        <div style="padding: 24px; display: flex; flex-direction: column; gap: 14px;">
            <div class="op-alert-card-glossy">
                <div style="font-size: 12px; color: #64748B;">Laju Penjualan Harian Rata-rata:</div>
                <strong id="demand-modal-velocity" style="font-size: 18px; color: #10B981;">0 unit/hari</strong>
            </div>
            <div class="op-alert-card-glossy">
                <div style="font-size: 12px; color: #64748B;">Estimasi Stok Habis:</div>
                <strong id="demand-modal-runway" style="font-size: 18px; color: #0F172A;">0 Hari</strong>
            </div>
            <p style="font-size: 12px; color: #64748B; margin: 0;">Data diproyeksikan oleh algoritma LARIS berdasarkan riwayat transaksi POS 30 hari terakhir.</p>
            <button type="button" onclick="closeDemandModal()" class="btn-timeframe-glossy" style="width: 100%; justify-content: center;">Tutup</button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .inventory-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .emergency-banner-glossy {
        background: linear-gradient(135deg, rgba(254, 242, 242, 0.95) 0%, rgba(254, 226, 226, 0.9) 100%);
        border: 1px solid rgba(239, 68, 68, 0.35);
        border-radius: 20px;
        padding: 18px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        box-shadow: 0 10px 25px -5px rgba(220, 38, 38, 0.1), inset 0 1px 2px rgba(255, 255, 255, 1);
        backdrop-filter: blur(12px);
    }

    .em-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .em-product-title {
        font-size: 15px;
        font-weight: 700;
        color: #991B1B;
        margin: 0;
    }

    .em-desc {
        font-size: 12.5px;
        color: #7F1D1D;
        margin: 0;
    }

    .em-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .text-red {
        color: #DC2626 !important;
    }

    .text-amber {
        color: #D97706 !important;
    }

    .dot-red {
        width: 6px;
        height: 6px;
        background: #DC2626;
        border-radius: 50%;
    }

    .badge-amber-glossy {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 9999px;
        background: #FEF3C7;
        color: #B45309;
        border: 1px solid rgba(217, 119, 6, 0.2);
    }

    /* Table Glossy */
    .table-responsive {
        overflow-x: auto;
        margin-top: 10px;
    }

    .laris-table-glossy {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 13px;
    }

    .laris-table-glossy th {
        background: #F8FAFC;
        padding: 12px 14px;
        font-size: 11px;
        font-weight: 800;
        color: var(--text-muted);
        letter-spacing: 0.5px;
        border-bottom: 1px solid #E2E8F0;
        text-align: left;
    }

    .laris-table-glossy td {
        padding: 14px;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
        color: var(--text-main);
    }

    .laris-table-glossy tr:hover td {
        background: #F8FAFC;
    }

    .prod-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .prod-thumb {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #E2E8F0;
    }

    .prod-t-name {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--text-main);
        display: block;
    }

    .prod-t-sub {
        font-size: 11px;
        color: var(--text-muted);
    }

    .sku-code-glossy {
        font-size: 11.5px;
        font-weight: 700;
        background: #F1F5F9;
        color: #334155;
        padding: 2px 8px;
        border-radius: 6px;
    }

    .min-threshold {
        display: block;
        font-size: 11px;
        color: var(--text-muted);
    }

    .table-foot-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        margin-top: 8px;
        border-top: 1px solid #F1F5F9;
    }

    .foot-ai-hint {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #10B981;
        font-weight: 600;
    }

    .page-meta {
        font-size: 12px;
        color: var(--text-muted);
    }

    /* Kulakan Grid */
    .kulakan-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-top: 16px;
    }

    .pool-card-glossy {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        transition: all 0.2s;
    }

    .pool-card-glossy:hover {
        border-color: #10B981;
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(16, 185, 129, 0.08);
    }

    .pool-top-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .pool-supplier-tag {
        font-size: 11px;
        font-weight: 700;
        color: #64748B;
    }

    .pool-item-name {
        font-size: 15px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 8px;
    }

    .pool-price-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #F8FAFC;
        padding: 10px 14px;
        border-radius: 12px;
        margin-bottom: 4px;
    }

    .pool-lbl {
        font-size: 10.5px;
        color: #64748B;
        display: block;
    }

    .pool-price-val {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-main);
    }

    .pool-price-val small {
        font-size: 11px;
        color: #64748B;
    }

    .pool-sub-price {
        font-size: 11px;
        color: var(--text-muted);
    }

    .pool-progress-meta {
        display: flex;
        justify-content: space-between;
        font-size: 11.5px;
        margin-bottom: 4px;
    }

    .pool-participants {
        font-size: 11px;
        color: #64748B;
        margin-top: 6px;
    }

    /* Responsive Layout Styles for Smart Inventory */
    .inventory-kpi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    @media (max-width: 1100px) {
        .inventory-kpi-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }
        .kulakan-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }
    }

    @media (max-width: 768px) {
        .dash-header {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 14px !important;
        }
        .dash-actions {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 8px !important;
            width: 100% !important;
        }
        .dash-actions > button,
        .dash-actions > select {
            flex: 1 1 calc(50% - 6px) !important;
            justify-content: center !important;
            text-align: center !important;
        }
        .emergency-banner-glossy {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 14px !important;
            padding: 16px !important;
        }
        .em-left {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 10px !important;
        }
        .em-actions {
            width: 100% !important;
            display: flex !important;
            gap: 8px !important;
        }
        .em-actions > button {
            flex: 1 !important;
            justify-content: center !important;
        }
        .panel-header {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 12px !important;
        }
        .panel-header .dash-actions select {
            flex: 1 1 calc(50% - 6px) !important;
        }
        .instant-insight-banner {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 14px !important;
            padding: 16px !important;
        }
        .btn-insight-action {
            width: 100% !important;
            justify-content: center !important;
        }
    }

    @media (max-width: 640px) {
        .inventory-kpi-grid {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }
        .kulakan-grid {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }
        .table-foot-row {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 8px !important;
        }
        .laris-modal-overlay {
            padding: 10px !important;
        }
        .laris-modal-overlay div[style*="grid-template-columns: 2fr 1fr"],
        .laris-modal-overlay div[style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 10px !important;
        }
    }

    .laris-table-glossy {
        min-width: 820px;
    }

    .preset-img-chip {
        padding: 5px 10px;
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 700;
        color: #334155;
        cursor: pointer;
        transition: all 0.15s;
    }
    .preset-img-chip:hover {
        background: #10B981;
        color: #FFFFFF;
        border-color: #10B981;
    }
</style>
@endpush

@push('scripts')
<script>
    let currentFilterState = 'all';

    function dismissEmergencyBanner() {
        const el = document.getElementById('emergency-banner');
        if (el) el.style.display = 'none';
    }

    function toggleBufferFilter() {
        const states = ['all', 'critical', 'attention', 'healthy'];
        const nextIdx = (states.indexOf(currentFilterState) + 1) % states.length;
        currentFilterState = states[nextIdx];

        const select = document.getElementById('filter-status');
        if (select) {
            select.value = currentFilterState;
            applyInventoryFilter();
        }
    }

    function applyInventoryFilter() {
        const status = document.getElementById('filter-status').value;
        const cat = document.getElementById('filter-category').value;
        const url = new URL(window.location.href);

        if (status !== 'all') url.searchParams.set('status', status);
        else url.searchParams.delete('status');

        if (cat !== 'all') url.searchParams.set('category', cat);
        else url.searchParams.delete('category');

        window.location.href = url.toString();
    }

    function exportInventoryCsv() {
        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Nama Produk,SKU,Kategori,Stok Saat Ini,Status,Laju AI,Runway Hari\n";

        const rows = document.querySelectorAll("#inventory-table-body tr");
        rows.forEach(row => {
            const cols = row.querySelectorAll("td");
            if (cols.length >= 7) {
                const name = cols[0].querySelector('.prod-t-name') ? cols[0].querySelector('.prod-t-name').innerText.trim() : '';
                const sku = cols[1].innerText.trim();
                const cat = cols[2].innerText.trim();
                const stock = cols[3].innerText.replace(/\n/g, ' ').trim();
                const status = cols[4].innerText.trim();
                const vel = cols[5].innerText.trim();
                const runway = cols[6].innerText.trim();
                csvContent += `"${name}","${sku}","${cat}","${stock}","${status}","${vel}","${runway}"\n`;
            }
        });

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `inventaris_laris_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function openAddProductModal() {
        document.getElementById('modal-add-product').style.display = 'flex';
        calculateModalMargin();
    }

    function closeAddProductModal() {
        document.getElementById('modal-add-product').style.display = 'none';
    }

    function calculateModalMargin() {
        const cost = parseFloat(document.getElementById('inp-prod-cost').value) || 0;
        const price = parseFloat(document.getElementById('inp-prod-price').value) || 0;
        const profit = price - cost;
        const pct = price > 0 ? ((profit / price) * 100).toFixed(1) : 0;

        const textElem = document.getElementById('modal-margin-text');
        const badgeElem = document.getElementById('modal-margin-badge');

        if (textElem && badgeElem) {
            textElem.textContent = `Rp ${profit.toLocaleString('id-ID')} / unit (Margin ${pct}%)`;

            if (pct >= 40) {
                badgeElem.textContent = 'Margin Sangat Sehat';
                badgeElem.style.background = '#10B981';
            } else if (pct >= 20) {
                badgeElem.textContent = 'Margin Moderat';
                badgeElem.style.background = '#3B82F6';
            } else {
                badgeElem.textContent = 'Margin Tipis';
                badgeElem.style.background = '#EF4444';
            }
        }
    }

    function applyImagePreset(url, name, cat, cost, price, supplier) {
        document.getElementById('inp-prod-img').value = url;
        document.getElementById('product-img-preview').src = url;
        if (name) {
            document.getElementById('inp-prod-name').value = name;
        }
        if (cat) {
            document.getElementById('inp-prod-cat').value = cat;
        }
        if (cost) {
            document.getElementById('inp-prod-cost').value = cost;
        }
        if (price) {
            document.getElementById('inp-prod-price').value = price;
        }
        if (supplier) {
            document.getElementById('inp-prod-supplier').value = supplier;
        }
        calculateModalMargin();
    }

    function viewProductDemand(name, velocity, runway, stock, unit) {
        document.getElementById('demand-modal-title').textContent = 'AI Demand Forecast: ' + name;
        document.getElementById('demand-modal-velocity').textContent = velocity + ' unit/hari';
        document.getElementById('demand-modal-runway').textContent = runway + ' Hari (Sisa ' + stock + ' ' + unit + ')';
        document.getElementById('modal-view-demand').style.display = 'flex';
    }

    function closeDemandModal() {
        document.getElementById('modal-view-demand').style.display = 'none';
    }

    // Kulakan Bareng Logic
    let activeKulakanItem = {
        name: 'Minyak Goreng Sawit 2L (Pouch)',
        supplier: 'Wilmar Distributor Resmi',
        price: 28500,
        normalPrice: 34000,
        current: 78,
        target: 100,
        unit: 'Pouch'
    };

    function openJoinPoolModal(name, supplier, price, normalPrice, current, target, unit) {
        activeKulakanItem = { name, supplier, price, normalPrice, current, target, unit };
        document.getElementById('join-pool-title').textContent = 'Gabung Pool: ' + name;
        document.getElementById('join-input-name').value = name;
        document.getElementById('join-pool-supplier').textContent = supplier;
        document.getElementById('join-pool-price').textContent = 'Rp ' + price.toLocaleString('id-ID');
        document.getElementById('join-pool-normal-price').textContent = 'Rp ' + normalPrice.toLocaleString('id-ID');
        document.getElementById('join-pool-status').textContent = current + ' / ' + target + ' ' + unit + ' (Sisa ' + (target - current) + ' ' + unit + ')';
        document.getElementById('join-unit-label').textContent = unit;
        
        document.getElementById('join-pledge-qty').value = 10;
        updateKulakanCalculations();
        document.getElementById('modal-join-kulakan').style.display = 'flex';
    }

    function closeJoinPoolModal() {
        document.getElementById('modal-join-kulakan').style.display = 'none';
    }

    function updateKulakanCalculations() {
        const qty = parseInt(document.getElementById('join-pledge-qty').value) || 1;
        const total = qty * activeKulakanItem.price;
        const savings = qty * (activeKulakanItem.normalPrice - activeKulakanItem.price);

        document.getElementById('join-calc-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('join-calc-savings').textContent = '+ Rp ' + savings.toLocaleString('id-ID');
        document.getElementById('join-input-savings').value = savings;
    }

    function openProposePoolModal() {
        document.getElementById('modal-propose-pool').style.display = 'flex';
    }

    function closeProposePoolModal() {
        document.getElementById('modal-propose-pool').style.display = 'none';
    }

    function submitProposedPool() {
        const itemName = document.getElementById('prop-item-name').value;
        const targetQty = document.getElementById('prop-target-qty').value;
        const unit = document.getElementById('prop-unit').value;
        const myQty = document.getElementById('prop-my-qty').value;

        closeProposePoolModal();
        larisAlert('Usulan Pool Berhasil Disiarkan!', 'Usulan Pengadaan Grosir Bersama untuk <strong>"' + itemName + '"</strong> (Target: ' + targetQty + ' ' + unit + ', Komitmen: ' + myQty + ') berhasil disiarkan ke 35 warung tetangga mitra LARIS!', 'success');
    }

    // === QUICK RESTOCK MODAL FUNCTIONS ===
    let activeRestockProduct = {
        id: 0,
        name: '',
        sku: '',
        currentStock: 0,
        minThreshold: 0,
        costPrice: 0,
        supplier: '',
        imageUrl: ''
    };

    function openRestockModal(id, name, sku, currentStock, minThreshold, costPrice, supplier, imageUrl) {
        activeRestockProduct = { id, name, sku, currentStock, minThreshold, costPrice, supplier, imageUrl };
        
        document.getElementById('restock-prod-img').src = imageUrl || 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=100';
        document.getElementById('restock-prod-name').innerText = name;
        document.getElementById('restock-prod-sku').innerText = sku || ('SKU-' + id);
        document.getElementById('restock-prod-supplier').innerText = supplier || 'Distributor Ritel';
        document.getElementById('restock-prod-current').innerText = currentStock;
        document.getElementById('restock-prod-min').innerText = minThreshold;
        
        const recQty = Math.max(10, minThreshold * 2);
        document.getElementById('restock-qty-input').value = recQty;
        document.getElementById('form-quick-restock').action = `/smart-inventory/reorder/${id}`;

        updateRestockCalculations();
        document.getElementById('modal-quick-restock').style.display = 'flex';
    }

    function closeRestockModal() {
        document.getElementById('modal-quick-restock').style.display = 'none';
    }

    function setRestockQty(qty) {
        document.getElementById('restock-qty-input').value = qty;
        updateRestockCalculations();
    }

    function updateRestockCalculations() {
        const qty = parseInt(document.getElementById('restock-qty-input').value) || 0;
        const newStock = activeRestockProduct.currentStock + qty;
        const totalPo = qty * activeRestockProduct.costPrice;

        document.getElementById('restock-calc-new-stock').innerText = `${activeRestockProduct.currentStock} → ${newStock} unit`;
        document.getElementById('restock-calc-total-po').innerText = 'Rp ' + totalPo.toLocaleString('id-ID');
        document.getElementById('restock-calc-unit-hpp').innerText = 'Rp ' + activeRestockProduct.costPrice.toLocaleString('id-ID');
    }

    // === EDIT PRODUCT MODAL FUNCTIONS ===
    function openEditProductModal(product) {
        document.getElementById('form-edit-product').action = `/smart-inventory/products/${product.id}/update`;
        document.getElementById('edit-prod-name').value = product.name;
        document.getElementById('edit-prod-sku').value = product.sku || '';
        document.getElementById('edit-prod-cat').value = product.category;
        document.getElementById('edit-prod-velocity').value = product.ai_velocity || 5.0;
        document.getElementById('edit-prod-cost').value = parseInt(product.cost_price) || 0;
        document.getElementById('edit-prod-price').value = parseInt(product.selling_price) || 0;
        document.getElementById('edit-prod-stock').value = product.current_stock;
        document.getElementById('edit-prod-min').value = product.min_threshold;
        document.getElementById('edit-prod-supplier').value = product.supplier_name || '';
        document.getElementById('edit-prod-img').value = product.image_url || '';
        document.getElementById('edit-prod-img-preview').src = product.image_url || 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=100';

        calculateEditModalMargin();
        document.getElementById('modal-edit-product').style.display = 'flex';
    }

    function closeEditProductModal() {
        document.getElementById('modal-edit-product').style.display = 'none';
    }

    function calculateEditModalMargin() {
        const cost = parseFloat(document.getElementById('edit-prod-cost').value) || 0;
        const price = parseFloat(document.getElementById('edit-prod-price').value) || 0;
        const profit = price - cost;
        const marginPct = price > 0 ? ((profit / price) * 100).toFixed(1) : 0;

        const textEl = document.getElementById('edit-margin-text');
        const badgeEl = document.getElementById('edit-margin-badge');
        if (textEl && badgeEl) {
            textEl.textContent = 'Rp ' + profit.toLocaleString('id-ID') + ' / unit (Margin ' + marginPct + '%)';
            if (marginPct >= 40) {
                badgeEl.textContent = 'Sangat Sehat';
                badgeEl.style.background = '#10B981';
            } else if (marginPct >= 20) {
                badgeEl.textContent = 'Normal';
                badgeEl.style.background = '#0284C7';
            } else if (marginPct > 0) {
                badgeEl.textContent = 'Tipis';
                badgeEl.style.background = '#D97706';
            } else {
                badgeEl.textContent = 'Rugi!';
                badgeEl.style.background = '#EF4444';
            }
        }
    }

    // === DELETE PRODUCT WITH ANIMATED CONFIRMATION ===
    function confirmDeleteProduct(id, name) {
        larisConfirm(
            'Hapus Produk dari Gudang?',
            `Apakah Anda yakin ingin menghapus produk <strong>"${name}"</strong> secara permanen dari sistem inventaris toko? Tindakan ini tidak dapat dibatalkan.`,
            'warning',
            function() {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/smart-inventory/products/${id}/delete`;
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);
                document.body.appendChild(form);
                form.submit();
            }
        );
    }
</script>
@endpush
