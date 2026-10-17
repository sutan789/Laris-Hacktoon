@extends('layouts.app', ['title' => 'Smart Inventory - AI Stock Health & Demand Forecasting'])

@section('content')
<div class="inventory-page">

    <!-- PAGE HEADER -->
    <div class="inv-head-bar">
        <div>
            <div class="inv-telemetry-tag">INVENTORY OPERATIONS • AI SYNC REAL-TIME</div>
            <h1 class="inv-main-title">Smart Inventory</h1>
            <p class="inv-sub-desc">Automated Stock Health Monitoring & AI-Powered Demand Forecasting for Juragan</p>
        </div>

        <div class="inv-head-actions">
            <button type="button" class="btn-outline" onclick="toggleBufferFilter()" id="btn-toggle-buffer">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/></svg>
                <span id="buffer-filter-label">Filter Buffer: Semua</span>
            </button>
            <button type="button" class="btn-lime" onclick="openAddProductModal()">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                <span>+ Tambah Produk Baru</span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #DCFCE7; border: 1px solid #86EFAC; color: #15803D; padding: 14px 18px; border-radius: 12px; font-weight: 600; font-size: 14px; display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: #15803D;">&times;</button>
        </div>
    @endif

    <!-- IMMINENT STOCKOUT EMERGENCY ALERT BANNER -->
    <div class="emergency-stock-banner" id="emergency-banner">
        <div class="em-left">
            <div class="em-danger-icon">
                <svg width="22" height="22" fill="none" stroke="#DC2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
            </div>
            <div>
                <div class="em-tag-row">
                    <span class="badge-stockout">IMMINENT STOCKOUT</span>
                    <h3 class="em-product-title">Kopi Arabica Gayo 250g — <strong>Kritis: Sisa 24 Unit</strong></h3>
                </div>
                <p class="em-desc"><span class="text-red">Prediksi Habis dalam 4 Hari</span> (Laju penjualan rata-rata 6 unit/hari berdasarkan tren akhir pekan).</p>
                <div class="em-supp-info">
                    <span>📦 Rekomendasi Restock: <strong>50 unit</strong> dari Supplier PT Kopi Nusantara (Lead time 2 hari kerja)</span>
                </div>
            </div>
        </div>

        <div class="em-actions">
            <button type="button" class="btn-outline" onclick="dismissEmergencyBanner()">Abaikan Alert</button>
            <form action="{{ route('inventory.reorder', 1) }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-lime">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                    <span>Pesan Restock Sekarang</span>
                </button>
            </form>
        </div>
    </div>

    <!-- INVENTORY HEALTH OVERVIEW CARDS (3 CARDS) -->
    <div class="inv-health-section">
        <div class="inv-overview-head">
            <span class="sec-title">INVENTORY HEALTH OVERVIEW</span>
            <span class="sku-count">Total SKU Terdaftar: <strong>80 Produk</strong></span>
        </div>

        <div class="inv-health-grid">
            <!-- HEALTHY -->
            <div class="card-panel health-card border-green-top">
                <div class="hc-top">
                    <span class="hc-pill pill-green">● Healthy</span>
                    <span class="check-icon-circle">✔</span>
                </div>
                <div class="hc-val">85%</div>
                <div class="hc-foot">
                    <span>68 SKU dalam range aman</span>
                    <strong class="text-green">&gt; 14 Hari Stok</strong>
                </div>
            </div>

            <!-- ATTENTION NEEDED -->
            <div class="card-panel health-card border-amber-top">
                <div class="hc-top">
                    <span class="hc-pill pill-amber">● Attention Needed</span>
                    <span class="clock-icon-circle">⏱</span>
                </div>
                <div class="hc-val">10%</div>
                <div class="hc-foot">
                    <span>8 SKU mendekati reorder point</span>
                    <strong class="text-amber">5-7 Hari Stok</strong>
                </div>
            </div>

            <!-- CRITICAL ALERT -->
            <div class="card-panel health-card border-red-top">
                <div class="hc-top">
                    <span class="hc-pill pill-red">● Critical Alert</span>
                    <span class="danger-icon-circle">!</span>
                </div>
                <div class="hc-val text-red">5%</div>
                <div class="hc-foot">
                    <span>4 SKU segera habis</span>
                    <strong class="text-red">&lt; 4 Hari Stok</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- INVENTORY HEALTH & REORDER MATRIX (TABLE) -->
    <div class="card-panel table-panel">
        
        <div class="table-top-bar">
            <div>
                <h3 class="table-title">Inventory Health & Reorder Matrix</h3>
                <p class="sub-muted">Real-time depletion rate against calculated supplier restock lead times</p>
            </div>

            <div class="table-filter-group">
                <select class="select-sm" id="filter-status" onchange="applyInventoryFilter()">
                    <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>Semua Status ({{ $totalSku }})</option>
                    <option value="critical" {{ request('status') == 'critical' ? 'selected' : '' }}>Critical ({{ $criticalCount }})</option>
                    <option value="attention" {{ request('status') == 'attention' ? 'selected' : '' }}>Attention ({{ $attentionCount }})</option>
                    <option value="healthy" {{ request('status') == 'healthy' ? 'selected' : '' }}>Healthy ({{ $healthyCount }})</option>
                </select>
                <select class="select-sm" id="filter-category" onchange="applyInventoryFilter()">
                    <option value="all" {{ request('category') == 'all' || !request('category') ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="Biji Kopi" {{ request('category') == 'Biji Kopi' ? 'selected' : '' }}>Biji Kopi</option>
                    <option value="Stationery" {{ request('category') == 'Stationery' ? 'selected' : '' }}>Stationery</option>
                    <option value="Packaging" {{ request('category') == 'Packaging' ? 'selected' : '' }}>Packaging</option>
                    <option value="Dairy" {{ request('category') == 'Dairy' ? 'selected' : '' }}>Dairy</option>
                    <option value="Lifestyle" {{ request('category') == 'Lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                </select>
                <button type="button" class="btn-icon-sq" onclick="exportInventoryCsv()" title="Unduh CSV Data Inventaris"><svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg></button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="laris-table">
                <thead>
                    <tr>
                        <th>PRODUCT NAME</th>
                        <th>SKU</th>
                        <th>CATEGORY</th>
                        <th>CURRENT STOCK</th>
                        <th>HEALTH STATUS</th>
                        <th>AI VELOCITY</th>
                        <th>STOCK RUNWAY</th>
                        <th class="text-right">QUICK ACTION</th>
                    </tr>
                </thead>
                <tbody id="inventory-table-body">
                    @forelse($products as $prod)
                        @php
                            $isCrit = $prod->health_status === 'Critical';
                            $isAttn = $prod->health_status === 'Attention';
                            $statusPillClass = $isCrit ? 'status-pill-red' : ($isAttn ? 'status-pill-amber' : 'status-pill-green');
                            $runwayBadgeClass = $isCrit ? 'badge-red-runway' : ($isAttn ? 'badge-amber-runway' : 'badge-green-runway');
                            $runwayFillClass = $isCrit ? 'bg-red' : ($isAttn ? 'bg-amber' : 'bg-green');
                            $runwayFillWidth = min(100, max(10, ($prod->stock_runway_days / 30) * 100));
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
                            <td><span class="sku-code">{{ $prod->sku }}</span></td>
                            <td>{{ $prod->category }}</td>
                            <td>
                                <strong class="{{ $isCrit ? 'text-red' : ($isAttn ? 'text-amber' : '') }}">{{ $prod->current_stock }} {{ $prod->unit }}</strong>
                                <span class="min-threshold">Min: {{ $prod->min_threshold }}</span>
                            </td>
                            <td><span class="{{ $statusPillClass }}">● {{ $prod->health_status }}</span></td>
                            <td><strong>{{ number_format($prod->ai_velocity, 1) }}</strong> <small class="text-muted">unit/hari</small></td>
                            <td>
                                <span class="runway-badge {{ $runwayBadgeClass }}">{{ $prod->stock_runway_days }} Hari</span>
                                <div class="runway-bar"><div class="r-fill {{ $runwayFillClass }}" style="width: {{ $runwayFillWidth }}%;"></div></div>
                            </td>
                            <td class="text-right">
                                @if($isCrit || $isAttn)
                                    <form action="{{ route('inventory.reorder', $prod->id) }}" method="POST" style="margin: 0; display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-reorder" title="Pesan restock otomatis">
                                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                                            <span>Reorder</span>
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn-view-demand" onclick="viewProductDemand('{{ addslashes($prod->name) }}', '{{ $prod->ai_velocity }}', '{{ $prod->stock_runway_days }}', '{{ $prod->current_stock }}', '{{ $prod->unit }}')">
                                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                        <span>View Demand</span>
                                    </button>
                                @endif
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
            <span class="foot-ai-hint">⚡ AI merekomendasikan reorder batch malam ini untuk menghemat ongkir supplier s.d. 18%</span>
            <div class="pagination-row">
                <span class="page-meta">Menampilkan {{ $products->count() }} dari {{ $totalSku }} SKU</span>
                <div class="page-btns">
                    <button type="button" class="p-btn" onclick="applyInventoryFilter('page_prev')">&lsaquo;</button>
                    <button type="button" class="p-btn active">1</button>
                    <button type="button" class="p-btn" onclick="applyInventoryFilter('page_next')">&rsaquo;</button>
                </div>
            </div>
        </div>

    </div>

    <!-- JURAGAN AI RESTOCK OPTIMIZER AUTO-BUNDLE -->
    <div class="auto-bundle-card">
        <div class="ab-left">
            <div class="ab-icon-box">💡</div>
            <div>
                <div class="flex-align gap-8">
                    <h4 class="ab-title">Juragan AI Restock Optimizer</h4>
                    <span class="ab-tag-lime">AUTO-BUNDLE</span>
                </div>
                <p class="ab-desc">Ada 2 item Critical (Kopi Arabica & Susu UHT) yang berasal dari distributor regional sama di Bandung. Menggabungkan pesanan ini ke satu PO akan mencegah potensi <strong>lost-sales sebesar Rp 2.850.000</strong> akhir pekan ini.</p>
            </div>
        </div>
        <form action="{{ route('inventory.auto_bundle') }}" method="POST">
            @csrf
            <button type="submit" class="btn-lime btn-lg">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                <span>Buat Purchase Order Gabungan</span>
            </button>
        </form>
    </div>

    <!-- KULAKAN BARENG ANTAR-WARUNG (B2B COLLECTIVE PURCHASING POOL) -->
    <div class="card-panel kulakan-panel" id="kulakan-bareng-section">
        <div class="kulakan-head">
            <div>
                <div class="kulakan-badge-row">
                    <span class="badge-kulakan">B2B COLLECTIVE RESTOCK POOL</span>
                    <span class="badge-district">📍 KECAMATAN BANDUNG WETAN</span>
                </div>
                <h3 class="kulakan-title">Kulakan Bareng Antar-Warung Tetangga</h3>
                <p class="kulakan-desc">
                    Gabungkan kuota belanja dengan 14 warung tetangga untuk menembus batas minimum pesanan distributor dan nikmati <strong>harga grosir Tier-1 (diskon 12% - 18%)</strong>. Ongkir logistik dibagi rata otomatis oleh AI.
                </p>
            </div>
            <div class="kulakan-head-actions">
                <button type="button" class="btn-outline btn-sm" onclick="openProposePoolModal()">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    <span>Ajukan Usulan Pool Baru</span>
                </button>
            </div>
        </div>

        <div class="kulakan-grid">
            <!-- POOL 1 -->
            <div class="pool-card">
                <div class="pool-top">
                    <span class="pool-supplier-tag">Wilmar Distributor Resmi</span>
                    <span class="pool-timer-tag">⏱ Sisa 4j 20m</span>
                </div>
                <h4 class="pool-item-name">Minyak Goreng Sawit 2L (Pouch)</h4>
                <div class="pool-price-box">
                    <div>
                        <span class="pool-label">Harga Kulakan Bareng:</span>
                        <div class="pool-price-current">Rp 28.500 <span class="pool-unit">/pouch</span></div>
                    </div>
                    <div class="pool-discount-badge">-16% OFF</div>
                </div>
                <div class="pool-normal-price">Harga Eceran Pasar: <s>Rp 34.000</s> (Hemat Rp 5.500/unit)</div>
                
                <div class="pool-progress-wrap">
                    <div class="pool-progress-meta">
                        <span>Terkumpul: <strong>78 / 100 Pouch</strong></span>
                        <span class="text-green font-bold">78%</span>
                    </div>
                    <div class="pool-progress-bar">
                        <div class="pool-progress-fill bg-green" style="width: 78%;"></div>
                    </div>
                    <div class="pool-participants">
                        👥 <strong>14 Warung</strong> tetangga telah bergabung
                    </div>
                </div>

                <button type="button" class="btn-lime w-100" onclick="openJoinPoolModal('Minyak Goreng Sawit 2L (Pouch)', 'Wilmar Distributor Resmi', 28500, 34000, 78, 100, 'Pouch')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>
                    <span>+ Gabung Pool Kulakan</span>
                </button>
            </div>

            <!-- POOL 2 -->
            <div class="pool-card">
                <div class="pool-top">
                    <span class="pool-supplier-tag">Koperasi Beras Cianjur</span>
                    <span class="pool-timer-tag">⏱ Sisa 7j 15m</span>
                </div>
                <h4 class="pool-item-name">Beras Premium Setra Ramos 5kg</h4>
                <div class="pool-price-box">
                    <div>
                        <span class="pool-label">Harga Kulakan Bareng:</span>
                        <div class="pool-price-current">Rp 64.000 <span class="pool-unit">/sak</span></div>
                    </div>
                    <div class="pool-discount-badge">-14% OFF</div>
                </div>
                <div class="pool-normal-price">Harga Eceran Pasar: <s>Rp 74.500</s> (Hemat Rp 10.500/sak)</div>
                
                <div class="pool-progress-wrap">
                    <div class="pool-progress-meta">
                        <span>Terkumpul: <strong>112 / 150 Sak</strong></span>
                        <span class="text-green font-bold">74%</span>
                    </div>
                    <div class="pool-progress-bar">
                        <div class="pool-progress-fill bg-green" style="width: 74%;"></div>
                    </div>
                    <div class="pool-participants">
                        👥 <strong>19 Warung</strong> tetangga telah bergabung
                    </div>
                </div>

                <button type="button" class="btn-lime w-100" onclick="openJoinPoolModal('Beras Premium Setra Ramos 5kg', 'Koperasi Beras Cianjur', 64000, 74500, 112, 150, 'Sak')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>
                    <span>+ Gabung Pool Kulakan</span>
                </button>
            </div>

            <!-- POOL 3 -->
            <div class="pool-card pool-card-hot">
                <div class="pool-top">
                    <span class="pool-supplier-tag">Indofood Direct Regional</span>
                    <span class="pool-timer-tag hot-tag">🔥 Sisa 1j 10m (Hampir Penuh!)</span>
                </div>
                <h4 class="pool-item-name">Indomie Goreng Spesial 40x85g (Dus)</h4>
                <div class="pool-price-box">
                    <div>
                        <span class="pool-label">Harga Kulakan Bareng:</span>
                        <div class="pool-price-current">Rp 108.000 <span class="pool-unit">/dus</span></div>
                    </div>
                    <div class="pool-discount-badge">-12% OFF</div>
                </div>
                <div class="pool-normal-price">Harga Eceran Pasar: <s>Rp 123.000</s> (Hemat Rp 15.000/dus)</div>
                
                <div class="pool-progress-wrap">
                    <div class="pool-progress-meta">
                        <span>Terkumpul: <strong>190 / 200 Dus</strong></span>
                        <span class="text-green font-bold">95%</span>
                    </div>
                    <div class="pool-progress-bar">
                        <div class="pool-progress-fill bg-lime" style="width: 95%;"></div>
                    </div>
                    <div class="pool-participants">
                        👥 <strong>27 Warung</strong> tetangga telah bergabung
                    </div>
                </div>

                <button type="button" class="btn-lime w-100" onclick="openJoinPoolModal('Indomie Goreng Spesial 40x85g (Dus)', 'Indofood Direct Regional', 108000, 123000, 190, 200, 'Dus')">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>
                    <span>+ Gabung Pool Kulakan</span>
                </button>
            </div>
        </div>
    </div>

</div>

@push('styles')
<style>
    .inventory-page {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .inv-head-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .inv-telemetry-tag {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.8px;
        color: #16A34A;
        margin-bottom: 2px;
    }

    .inv-main-title {
        font-family: 'Outfit', sans-serif;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .inv-sub-desc {
        font-size: 13px;
        color: var(--text-muted);
    }

    .inv-head-actions {
        display: flex;
        gap: 12px;
    }

    /* EMERGENCY BANNER */
    .emergency-stock-banner {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        border-radius: 14px;
        padding: 18px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .em-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .em-danger-icon {
        width: 44px;
        height: 44px;
        background: #FEE2E2;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .em-tag-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 4px;
    }

    .badge-stockout {
        background: #DC2626;
        color: #FFFFFF;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .em-product-title {
        font-size: 16px;
        font-weight: 700;
        color: #991B1B;
    }

    .em-desc {
        font-size: 13px;
        color: #7F1D1D;
        margin-bottom: 6px;
    }

    .em-supp-info {
        font-size: 11px;
        color: #991B1B;
    }

    .em-actions {
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    /* HEALTH OVERVIEW */
    .inv-health-section {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .inv-overview-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sku-count {
        font-size: 12px;
        color: var(--text-muted);
    }

    .inv-health-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .health-card {
        padding: 18px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 120px;
    }

    .border-green-top { border-top: 4px solid #16A34A; }
    .border-amber-top { border-top: 4px solid #D97706; }
    .border-red-top { border-top: 4px solid #DC2626; }

    .hc-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .hc-pill {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 20px;
    }

    .pill-green { background: #DCFCE7; color: #16A34A; }
    .pill-amber { background: #FEF3C7; color: #D97706; }
    .pill-red { background: #FEE2E2; color: #DC2626; }

    .check-icon-circle, .clock-icon-circle, .danger-icon-circle {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
    }

    .check-icon-circle { background: #DCFCE7; color: #16A34A; }
    .clock-icon-circle { background: #FEF3C7; color: #D97706; }
    .danger-icon-circle { background: #FEE2E2; color: #DC2626; }

    .hc-val {
        font-family: 'Outfit', sans-serif;
        font-size: 32px;
        font-weight: 800;
        margin: 6px 0;
    }

    .hc-foot {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: var(--text-muted);
    }

    /* TABLE */
    .table-panel {
        padding: 22px;
    }

    .table-top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .table-title {
        font-size: 16px;
        font-weight: 700;
    }

    .table-filter-group {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .select-sm {
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        color: var(--text-main);
    }

    .btn-icon-sq {
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .laris-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .laris-table th {
        text-align: left;
        font-size: 10px;
        font-weight: 800;
        color: var(--text-muted);
        letter-spacing: 0.5px;
        padding: 12px 14px;
        border-bottom: 2px solid #F1F5F9;
    }

    .laris-table td {
        padding: 14px;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }

    .prod-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .prod-thumb {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        object-fit: cover;
    }

    .prod-t-name {
        font-size: 13px;
        font-weight: 700;
        display: block;
    }

    .prod-t-sub {
        font-size: 11px;
        color: var(--text-muted);
    }

    .sku-code {
        font-family: monospace;
        font-size: 11px;
        background: #F1F5F9;
        padding: 2px 6px;
        border-radius: 4px;
        color: #475569;
    }

    .min-threshold {
        display: block;
        font-size: 10px;
        color: var(--text-muted);
    }

    .status-pill-red { background: #FEE2E2; color: #DC2626; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 12px; }
    .status-pill-amber { background: #FEF3C7; color: #D97706; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 12px; }
    .status-pill-green { background: #DCFCE7; color: #16A34A; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 12px; }

    .runway-badge {
        font-size: 11px;
        font-weight: 700;
        display: block;
        margin-bottom: 4px;
    }

    .badge-red-runway { color: #DC2626; }
    .badge-amber-runway { color: #D97706; }
    .badge-green-runway { color: #16A34A; }

    .runway-bar {
        height: 4px;
        background: #F1F5F9;
        border-radius: 4px;
        width: 90px;
        overflow: hidden;
    }

    .r-fill { height: 100%; border-radius: 4px; }
    .bg-red { background: #DC2626; }
    .bg-amber { background: #D97706; }
    .bg-green { background: #16A34A; }

    .btn-reorder {
        background: #0B1215;
        color: #CCFF00;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-view-demand {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        color: var(--text-main);
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .table-foot-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 18px;
        font-size: 12px;
    }

    .foot-ai-hint {
        color: #16A34A;
        font-weight: 600;
    }

    .pagination-row {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .page-btns {
        display: flex;
        gap: 4px;
    }

    .p-btn {
        width: 28px;
        height: 28px;
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        border-radius: 6px;
        cursor: pointer;
        font-size: 11px;
        font-weight: 700;
    }

    .p-btn.active {
        background: #0B1215;
        color: #FFFFFF;
        border-color: #0B1215;
    }

    /* AUTO BUNDLE */
    .auto-bundle-card {
        background: #0B1215;
        border-radius: 14px;
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .ab-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .ab-icon-box {
        width: 44px;
        height: 44px;
        background: #162228;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .ab-title {
        font-size: 14px;
        font-weight: 700;
        color: #FFFFFF;
    }

    .ab-tag-lime {
        background: #CCFF00;
        color: #000000;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .ab-desc {
        font-size: 12px;
        color: #E2E8F0;
        line-height: 1.4;
        margin-top: 4px;
    }

    .btn-lg {
        padding: 12px 20px;
        font-size: 13px;
        flex-shrink: 0;
    }

    /* MODAL STYLES */
    .laris-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(11, 18, 21, 0.7);
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 999;
        padding: 20px;
    }

    .laris-modal-card {
        background: #FFFFFF;
        border-radius: 16px;
        width: 100%;
        max-width: 520px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        animation: modalPop 0.2s ease-out;
    }

    @keyframes modalPop {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .laris-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 24px;
        background: #F8FAFC;
        border-bottom: 1px solid #E2E8F0;
    }

    .laris-modal-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #0F172A;
    }

    .btn-close-modal {
        background: none;
        border: none;
        font-size: 22px;
        color: #64748B;
        cursor: pointer;
    }

    .laris-modal-body {
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .modal-form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .modal-form-group label {
        font-size: 12px;
        font-weight: 700;
        color: #334155;
    }

    .modal-form-group input, .modal-form-group select {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        padding: 9px 12px;
        font-size: 13px;
        color: #0F172A;
    }

    .modal-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .laris-modal-footer {
        padding: 16px 24px;
        background: #F8FAFC;
        border-top: 1px solid #E2E8F0;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    /* KULAKAN BARENG STYLES */
    .kulakan-panel {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .kulakan-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
    }

    .kulakan-badge-row {
        display: flex;
        gap: 8px;
        align-items: center;
        margin-bottom: 6px;
    }

    .badge-kulakan {
        background: #0B1215;
        color: #CCFF00;
        font-size: 9px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
        letter-spacing: 0.5px;
    }

    .badge-district {
        background: #F1F5F9;
        color: #475569;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 6px;
    }

    .kulakan-title {
        font-size: 18px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.3px;
    }

    .kulakan-desc {
        font-size: 13px;
        color: #64748B;
        max-width: 820px;
        margin-top: 4px;
        line-height: 1.5;
    }

    .kulakan-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .pool-card {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 18px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .pool-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }

    .pool-card-hot {
        border-color: #FCA5A5;
        background: #FFFBFB;
    }

    .pool-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 11px;
    }

    .pool-supplier-tag {
        font-weight: 700;
        color: #475569;
    }

    .pool-timer-tag {
        background: #E2E8F0;
        color: #334155;
        padding: 2px 7px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 10px;
    }

    .pool-timer-tag.hot-tag {
        background: #FEE2E2;
        color: #DC2626;
    }

    .pool-item-name {
        font-size: 15px;
        font-weight: 800;
        color: #0F172A;
        line-height: 1.3;
    }

    .pool-price-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #FFFFFF;
        padding: 10px 12px;
        border-radius: 10px;
        border: 1px solid #E2E8F0;
    }

    .pool-label {
        font-size: 10px;
        font-weight: 600;
        color: #64748B;
        display: block;
    }

    .pool-price-current {
        font-size: 16px;
        font-weight: 800;
        color: #16A34A;
    }

    .pool-unit {
        font-size: 11px;
        font-weight: 500;
        color: #64748B;
    }

    .pool-discount-badge {
        background: #DCFCE7;
        color: #15803D;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
    }

    .pool-normal-price {
        font-size: 11px;
        color: #64748B;
    }

    .pool-progress-wrap {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .pool-progress-meta {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
    }

    .pool-progress-bar {
        width: 100%;
        height: 8px;
        background: #E2E8F0;
        border-radius: 99px;
        overflow: hidden;
    }

    .pool-progress-fill {
        height: 100%;
        border-radius: 99px;
        transition: width 0.4s ease;
    }

    .pool-participants {
        font-size: 11px;
        color: #475569;
    }

    .w-100 {
        width: 100%;
    }

    @media (max-width: 1024px) {
        .kulakan-grid {
            grid-template-columns: 1fr;
        }
        .kulakan-head {
            flex-direction: column;
            align-items: stretch;
        }
        .inv-head-bar {
            flex-direction: column;
            align-items: stretch;
            gap: 16px;
        }
        .inv-head-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .emergency-stock-banner {
            flex-direction: column;
            align-items: stretch;
            gap: 14px;
        }
        .em-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .auto-bundle-card {
            flex-direction: column;
            align-items: stretch;
            gap: 16px;
        }
        .auto-bundle-card .btn-lime {
            width: 100%;
            justify-content: center;
        }
        .table-top-bar {
            flex-direction: column;
            align-items: stretch;
            gap: 14px;
        }
        .table-filter-group {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
    }

    @media (max-width: 768px) {
        .inv-health-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .table-panel {
            padding: 16px 12px;
        }
        .table-responsive table {
            min-width: 650px;
        }
        .table-foot-row {
            flex-direction: column;
            gap: 14px;
            align-items: flex-start;
        }
        .modal-grid-2 {
            grid-template-columns: 1fr;
        }
        .laris-modal-card {
            max-width: 95vw;
            max-height: 90vh;
            overflow-y: auto;
        }
    }
</style>
@endpush

<!-- MODAL TAMBAH PRODUK BARU -->
<div id="modal-add-product" class="laris-modal-overlay">
    <div class="laris-modal-card">
        <div class="laris-modal-header">
            <h3>+ Tambah Produk Baru ke Gudang</h3>
            <button type="button" class="btn-close-modal" onclick="closeAddProductModal()">&times;</button>
        </div>
        <form action="{{ route('predict.add_to_inventory') }}" method="POST">
            @csrf
            <div class="laris-modal-body">
                <div class="modal-form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="product_name" placeholder="Misal: Biji Kopi Robusta Lampung 500g" required>
                </div>
                <div class="modal-grid-2">
                    <div class="modal-form-group">
                        <label>Kategori</label>
                        <select name="category" required>
                            <option value="Biji Kopi">Biji Kopi</option>
                            <option value="Stationery">Stationery</option>
                            <option value="Sirup & Flavor">Sirup & Flavor</option>
                            <option value="Packaging">Packaging</option>
                            <option value="Dairy">Dairy</option>
                            <option value="Lifestyle">Lifestyle</option>
                        </select>
                    </div>
                    <div class="modal-form-group">
                        <label>Stok Awal</label>
                        <input type="number" name="batch_size" value="50" min="1" required>
                    </div>
                </div>
                <div class="modal-grid-2">
                    <div class="modal-form-group">
                        <label>Harga Jual (Rp)</label>
                        <input type="number" name="selling_price" placeholder="45000" required>
                    </div>
                    <div class="modal-form-group">
                        <label>Biaya Modal / HPP (Rp)</label>
                        <input type="number" name="hpp" placeholder="28000" required>
                    </div>
                </div>
            </div>
            <div class="laris-modal-footer">
                <button type="button" class="btn-outline" onclick="closeAddProductModal()">Batal</button>
                <button type="submit" class="btn-lime">Simpan ke Inventaris</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL VIEW DEMAND FORECAST -->
<div id="modal-view-demand" class="laris-modal-overlay">
    <div class="laris-modal-card">
        <div class="laris-modal-header">
            <h3 id="demand-modal-title">AI Demand Forecast</h3>
            <button type="button" class="btn-close-modal" onclick="closeDemandModal()">&times;</button>
        </div>
        <div class="laris-modal-body">
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px;">
                <div style="display: flex; justify-content: space-between; font-size: 13px; font-weight: 700; margin-bottom: 6px;">
                    <span>Laju Penjualan (AI Velocity):</span>
                    <span id="demand-modal-velocity" class="text-green">0.0 unit/hari</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 13px; font-weight: 700;">
                    <span>Sisa Runway Stok:</span>
                    <span id="demand-modal-runway">0 Hari Tersisa</span>
                </div>
            </div>
            <div>
                <h4 style="font-size: 13px; font-weight: 700; margin-bottom: 8px;">Proyeksi Permintaan 7 Hari Ke Depan</h4>
                <div style="display: flex; gap: 6px; align-items: flex-end; height: 90px; padding: 10px; background: #0B1215; border-radius: 10px;">
                    <div style="flex: 1; background: #334155; height: 50%; border-radius: 4px;"></div>
                    <div style="flex: 1; background: #334155; height: 60%; border-radius: 4px;"></div>
                    <div style="flex: 1; background: #334155; height: 75%; border-radius: 4px;"></div>
                    <div style="flex: 1; background: #16A34A; height: 65%; border-radius: 4px;"></div>
                    <div style="flex: 1; background: #16A34A; height: 85%; border-radius: 4px;"></div>
                    <div style="flex: 1; background: #CCFF00; height: 100%; border-radius: 4px;"></div>
                    <div style="flex: 1; background: #CCFF00; height: 90%; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 10px; color: #64748B; margin-top: 4px;">
                    <span>H-3</span><span>H-2</span><span>H-1</span><span>Hari Ini</span><span>Besok</span><span>Sabtu*</span><span>Minggu*</span>
                </div>
            </div>
            <p style="font-size: 12px; color: #64748B; line-height: 1.4;">
                💡 <strong>Catatan AI:</strong> Permintaan akhir pekan meningkat tajam. Stok saat ini aman dan belum membutuhkan pemesanan ulang darurat.
            </p>
        </div>
        <div class="laris-modal-footer">
            <button type="button" class="btn-dark" onclick="closeDemandModal()">Tutup</button>
        </div>
    </div>
</div>

<!-- MODAL GABUNG KULAKAN BARENG -->
<div id="modal-join-kulakan" class="laris-modal-overlay">
    <div class="laris-modal-card">
        <div class="laris-modal-header">
            <div>
                <span style="font-size: 10px; font-weight: 800; color: #16A34A; letter-spacing: 0.5px;">B2B COLLECTIVE ORDER</span>
                <h3 id="join-pool-title" style="margin-top: 2px;">Gabung Pool Kulakan</h3>
            </div>
            <button type="button" class="btn-close-modal" onclick="closeJoinPoolModal()">&times;</button>
        </div>
        <form action="{{ route('inventory.kulakan_join') }}" method="POST">
            @csrf
            <input type="hidden" name="pool_name" id="join-input-name" value="">
            <input type="hidden" name="estimated_savings" id="join-input-savings" value="55000">

            <div class="laris-modal-body">
                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px; display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; justify-content: space-between; font-size: 13px;">
                        <span style="color: #64748B;">Distributor Resmi:</span>
                        <strong id="join-pool-supplier" style="color: #0F172A;">Wilmar Distributor</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 13px;">
                        <span style="color: #64748B;">Harga Tier-1 Collective:</span>
                        <strong id="join-pool-price" style="color: #16A34A; font-size: 15px;">Rp 28.500</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 12px;">
                        <span style="color: #64748B;">Harga Eceran Normal:</span>
                        <s id="join-pool-normal-price" style="color: #94A3B8;">Rp 34.000</s>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 12px; border-top: 1px dashed #CBD5E1; padding-top: 6px;">
                        <span style="color: #64748B;">Status Kuota Pool:</span>
                        <strong id="join-pool-status" style="color: #0F172A;">78 / 100 Pouch (Sisa 22 Pouch)</strong>
                    </div>
                </div>

                <div class="modal-form-group">
                    <label>Jumlah Unit yang Ingin Anda Pesan (<span id="join-unit-label">Pouch</span>)</label>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="number" name="pledge_qty" id="join-pledge-qty" value="10" min="1" max="50" oninput="updateKulakanCalculations()" required style="flex: 1; font-weight: 700; font-size: 16px;">
                        <button type="button" class="btn-outline btn-sm" onclick="setQuickPledge(5)">5</button>
                        <button type="button" class="btn-outline btn-sm" onclick="setQuickPledge(10)">10</button>
                        <button type="button" class="btn-outline btn-sm" onclick="setQuickPledge(20)">20</button>
                    </div>
                </div>

                <!-- SIMULASI PERHITUNGAN HEMAT MODAL -->
                <div style="background: #0B1215; border-radius: 12px; padding: 14px; color: #FFFFFF;">
                    <div style="display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 6px;">
                        <span style="color: #94A3B8;">Total Pembayaran Modal:</span>
                        <strong id="join-calc-total" style="font-size: 14px; color: #FFFFFF;">Rp 285.000</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 12px;">
                        <span style="color: #94A3B8;">Estimasi Penghematan Margin:</span>
                        <strong id="join-calc-savings" style="font-size: 14px; color: #CCFF00;">+ Rp 55.000</strong>
                    </div>
                    <div style="font-size: 10px; color: #64748B; margin-top: 8px; line-height: 1.4;">
                        ⚡ <em>Pesanan otomatis digabungkan dengan pesanan 14 warung tetangga. Pengiriman dijadwalkan langsung ke toko Anda tanpa tambahan ongkir.</em>
                    </div>
                </div>
            </div>
            <div class="laris-modal-footer">
                <button type="button" class="btn-outline" onclick="closeJoinPoolModal()">Batal</button>
                <button type="submit" class="btn-lime">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    <span>Konfirmasi Gabung Pool</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL AJUKAN POOL BARU -->
<div id="modal-propose-pool" class="laris-modal-overlay">
    <div class="laris-modal-card">
        <div class="laris-modal-header">
            <h3>+ Ajukan Usulan Pool Kulakan Baru</h3>
            <button type="button" class="btn-close-modal" onclick="closeProposePoolModal()">&times;</button>
        </div>
        <form onsubmit="event.preventDefault(); submitProposedPool();">
            <div class="laris-modal-body">
                <div class="modal-form-group">
                    <label>Nama Produk / Komoditas yang Ingin Dikulak Bersama</label>
                    <input type="text" id="prop-item-name" placeholder="Misal: Gula Pasir Gulaku 1kg (Karton)" required>
                </div>
                <div class="modal-grid-2">
                    <div class="modal-form-group">
                        <label>Target Minimum Pool</label>
                        <input type="number" id="prop-target-qty" placeholder="50" value="50" min="10" required>
                    </div>
                    <div class="modal-form-group">
                        <label>Satuan Unit</label>
                        <select id="prop-unit">
                            <option value="Karton / Dus">Karton / Dus</option>
                            <option value="Jeriken / Pouch">Jeriken / Pouch</option>
                            <option value="Sak / Karung">Sak / Karung</option>
                            <option value="Bal / Renceng">Bal / Renceng</option>
                        </select>
                    </div>
                </div>
                <div class="modal-form-group">
                    <label>Estimasi Kebutuhan Toko Anda Sendiri</label>
                    <input type="number" id="prop-my-qty" placeholder="10" value="10" min="1" required>
                </div>
                <div class="modal-form-group">
                    <label>Rekomendasi Distributor / Pabrik (Opsional)</label>
                    <input type="text" id="prop-distributor" placeholder="Misal: PT Perkebunan Nusantara / Distributor Gula Rajawali">
                </div>
                <p style="font-size: 11px; color: #64748B; margin: 0; line-height: 1.4;">
                    💡 Usulan pool akan disiarkan oleh AI LARIS ke 35 warung terdekat di Kecamatan Bandung Wetan. Jika kuota minimum tercapai dalam 24 jam, order langsung dieksekusi.
                </p>
            </div>
            <div class="laris-modal-footer">
                <button type="button" class="btn-outline" onclick="closeProposePoolModal()">Batal</button>
                <button type="submit" class="btn-lime">Siarkan Usulan Pool ke Tetangga</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function dismissEmergencyBanner() {
        const b = document.getElementById('emergency-banner');
        if (b) {
            b.style.display = 'none';
        }
    }

    let currentFilterState = 'all';
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

    function applyInventoryFilter(pageAction) {
        const status = document.getElementById('filter-status').value;
        const cat = document.getElementById('filter-category').value;
        const url = new URL(window.location.href);

        if (status !== 'all') url.searchParams.set('status', status);
        else url.searchParams.delete('status');

        if (cat !== 'all') url.searchParams.set('category', cat);
        else url.searchParams.delete('category');

        if (pageAction) {
            alert('Navigasi paginasi data inventaris ke halaman berikutnya aktif.');
            return;
        }

        window.location.href = url.toString();
    }

    function exportInventoryCsv() {
        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Product Name,SKU,Category,Current Stock,Health Status,AI Velocity,Runway Days\n";

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
    }

    function closeAddProductModal() {
        document.getElementById('modal-add-product').style.display = 'none';
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

    // KULAKAN BARENG LOGIC
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

    function setQuickPledge(qty) {
        document.getElementById('join-pledge-qty').value = qty;
        updateKulakanCalculations();
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
        alert('🎉 Usulan Pool Kulakan untuk "' + itemName + '" (Target: ' + targetQty + ' ' + unit + ', Komitmen Anda: ' + myQty + ') berhasil disiarkan ke 35 warung tetangga di Kecamatan Bandung Wetan!');
    }
</script>
@endpush
@endsection
