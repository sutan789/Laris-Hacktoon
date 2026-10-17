@extends('layouts.app', ['title' => 'Business Dashboard - LARIS BI Platform'])

@section('content')
<div class="dashboard-container">

    <!-- NOTIFIKASI SUCCESS FLASH -->
    @if(session('success'))
        <div style="background: linear-gradient(135deg, #DCFCE7 0%, #BBF7D0 100%); border: 1px solid #86EFAC; border-radius: 12px; padding: 14px 20px; color: #166534; font-size: 13px; font-weight: 700; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.12);">
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg width="20" height="20" fill="none" stroke="#16A34A" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: #166534;">&times;</button>
        </div>
    @endif

    <!-- TOP HEADER & STATUS -->
    <div class="dash-header">
        <div class="header-main-info">
            <div class="telemetry-pill">
                <span class="pulse-dot"></span>
                <span>Kasir & Marketplace Terhubung</span>
                <span class="telemetry-divider">•</span>
                <span class="telemetry-sync-time" id="telemetry-sync-badge">Sinkronisasi Real-time ({{ $kpiData['last_sync'] }})</span>
                <button type="button" onclick="simulateLiveOrder()" class="btn-mini-sim" title="Simulasikan Penjualan Masuk Otomatis">
                    <span>+ Simulasi Kasir</span>
                </button>
            </div>
            <div class="greeting-row">
                <h1 class="page-greeting">Selamat Pagi, <span class="store-gradient-name">{{ $store->name ?? 'Toko Berkah Utama' }}</span></h1>
                <span class="verified-store-badge" title="Toko Terverifikasi">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="#16A34A"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                    <span>Terverifikasi</span>
                </span>
            </div>
            <div class="header-meta-chips">
                <p class="page-subtitle">Ringkasan performa omzet harian, margin laba bersih, dan radar stok.</p>
                <div class="quick-status-badges">
                    <span class="stat-pill"><span class="dot-live"></span> Jam Operasional: <strong>08.00 - 22.00</strong></span>
                    <span class="stat-pill">Status Runway: <strong class="text-green">Aman (8 Hari)</strong></span>
                </div>
            </div>
        </div>
        <div class="dash-actions">
            <!-- TIMEFRAME DROPDOWN -->
            <div class="dropdown-timeframe" style="position: relative;">
                <button type="button" class="btn-outline" id="btn-timeframe-toggle" onclick="toggleTimeframeMenu()">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                    <span id="current-timeframe-label">{{ $kpiData['timeframe_label'] }}</span>
                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                </button>
                <div id="timeframe-menu" class="timeframe-popup-menu" style="display: none;">
                    <a href="{{ route('dashboard', ['timeframe' => 'today']) }}" class="menu-item {{ $timeframe === 'today' ? 'active' : '' }}">Hari Ini (Realtime)</a>
                    <a href="{{ route('dashboard', ['timeframe' => '7d']) }}" class="menu-item {{ $timeframe === '7d' ? 'active' : '' }}">7 Hari Terakhir</a>
                    <a href="{{ route('dashboard', ['timeframe' => '30d']) }}" class="menu-item {{ $timeframe === '30d' ? 'active' : '' }}">Bulan Ini (30 Hari)</a>
                </div>
            </div>

            <!-- UNDUH RINGKASAN BUTTON -->
            <a href="{{ route('dashboard.download_summary') }}" class="btn-dark" title="Download Laporan Ringkasan Eksekutif (.txt)">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                <span>Unduh Ringkasan</span>
            </a>
        </div>
    </div>

    <!-- JURAGAN AI INSTANT INSIGHT STRIP (TOP HERO BANNER) -->
    <div class="instant-insight-banner">
        <div class="insight-left">
            <div class="ai-icon-box">
                <svg width="20" height="20" fill="none" stroke="#CCFF00" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/></svg>
            </div>
            <div class="insight-text">
                <div class="insight-tag">JURAGAN AI INSTANT INSIGHT •</div>
                <p>Tren produk viral <span class="highlight-text">Pensil Labubu</span> meningkat <strong>+310%</strong> di wilayah Jawa Barat. Margin laba estimasi <strong>38%</strong> jika di-restock sebelum akhir pekan.</p>
            </div>
        </div>
        <a href="{{ url('/laris-predict') }}" class="btn-lime">
            <span>Eksekusi Rekomendasi</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
        </a>
    </div>

    <!-- TOP 4 KPI METRIC CARDS -->
    <div class="kpi-grid">
        <!-- KPI 1 -->
        <div class="kpi-card card-panel">
            <div class="kpi-top">
                <span class="kpi-title">Pendapatan ({{ $kpiData['timeframe_label'] }})</span>
                <span class="kpi-badge badge-green">+12%</span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val" id="kpi-revenue">{{ $kpiData['revenue_formatted'] }}</h2>
                <span class="kpi-comparison">vs periode lalu</span>
            </div>
            <div class="kpi-sparkline">
                <svg viewBox="0 0 160 30" class="sparkline-svg">
                    <path d="M0 24 Q 40 10, 80 18 T 160 4" fill="none" stroke="#16A34A" stroke-width="2.5" />
                </svg>
            </div>
            <div class="kpi-status-foot" style="margin-top: 6px;">
                <span class="bullet-green"></span>
                <span id="kpi-orders-count">{{ $kpiData['orders_today_count'] }} Transaksi Terproses</span>
            </div>
        </div>

        <!-- KPI 2 -->
        <div class="kpi-card card-panel">
            <div class="kpi-top">
                <span class="kpi-title">Laba Bersih Estimasi</span>
                <span class="kpi-badge badge-green">+8%</span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val" id="kpi-profit">{{ $kpiData['profit_formatted'] }}</h2>
                <div class="kpi-sub-meta">
                    <span class="meta-label">Margin</span>
                    <span class="meta-bold" id="kpi-margin">{{ $kpiData['margin_pct'] }}%</span>
                </div>
            </div>
            <div class="kpi-progress-bar">
                <div class="progress-fill" id="kpi-margin-bar" style="width: {{ min(100, $kpiData['margin_pct'] * 2) }}%;"></div>
            </div>
        </div>

        <!-- KPI 3 -->
        <div class="kpi-card card-panel">
            <div class="kpi-top">
                <span class="kpi-title">Kesehatan Stok Gudang</span>
                <span class="kpi-badge badge-optimal">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:-1px; margin-right:3px;"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>Optimal</span>
                </span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val" id="kpi-stock-health">{{ $kpiData['stock_health_pct'] }}%</h2>
                <span class="kpi-alert-subtext" id="kpi-critical-count">{{ $kpiData['critical_count'] }} Perlu Reorder</span>
            </div>
            <div class="kpi-status-foot">
                <span class="bullet-green"></span>
                <span>{{ $kpiData['active_sku_count'] }} SKU Aktif Terpantau</span>
            </div>
        </div>

        <!-- KPI 4 -->
        <div class="kpi-card card-panel">
            <div class="kpi-top">
                <span class="kpi-title">Opportunity Score</span>
                <span class="kpi-badge badge-high-signal">HIGH SIGNAL</span>
            </div>
            <div class="kpi-value-row">
                <div class="score-pill" id="kpi-opp-score">{{ $kpiData['opportunity_score'] }}</div>
                <div class="score-desc">
                    <div class="score-head">Potensi Penjualan Tinggi</div>
                    <div class="score-sub">Top category: Stationery &amp; Hobby</div>
                </div>
            </div>
            <div class="kpi-status-foot">
                <span class="radar-ping"></span>
                <span>{{ $trends->count() }} Tren Baru Terdeteksi</span>
            </div>
        </div>
    </div>

    <!-- MAIN TWO COLUMN GRID -->
    <div class="dash-columns">
        
        <!-- COLUMN LEFT: OPPORTUNITY RADAR -->
        <div class="col-left">
            <div class="card-panel">
                <div class="radar-header">
                    <div class="radar-title-group">
                        <div class="radar-icon-badge">
                            <svg width="18" height="18" fill="none" stroke="#16A34A" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        </div>
                        <div>
                            <div class="flex-align gap-8">
                                <h3>Opportunity Radar</h3>
                                <span class="tag-pill">AI REALTIME</span>
                            </div>
                            <p class="sub-muted">Deteksi peluang viral dan margin tertinggi dari marketplace lokal</p>
                        </div>
                    </div>
                    <div style="position: relative;">
                        <button type="button" class="btn-more" onclick="toggleRadarMenu()" title="Opsi Radar">•••</button>
                        <div id="radar-dropdown-menu" class="timeframe-popup-menu" style="display: none; width: 220px;">
                            <a href="javascript:void(0)" onclick="refreshRadarVisual()" class="menu-item">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px; vertical-align:-2px;"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>
                                <span>Pindai Ulang Radar</span>
                            </a>
                            <a href="{{ route('trends.index') }}" class="menu-item">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px; vertical-align:-2px;"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                                <span>Buka Trend Hunter</span>
                            </a>
                            <a href="{{ route('predict.index') }}" class="menu-item">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px; vertical-align:-2px;"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                                <span>Buka Simulator Predict</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- SPOTLIGHT RADAR CONTENT -->
                <div class="spotlight-radar-box">
                    <div class="radar-visual">
                        <div class="radar-circle-outer"></div>
                        <div class="radar-circle-mid"></div>
                        <div class="radar-circle-inner"></div>
                        <div class="radar-sweep"></div>
                        <div class="radar-blip blip-center">87</div>
                        <div class="radar-blip blip-target"></div>
                        <div class="radar-legend">
                            <span class="dot-green"></span> Top Viral
                            <span class="dot-gray"></span> Normal
                        </div>
                    </div>

                    <div class="spotlight-card">
                        <div class="spotlight-badge-row">
                            <span class="badge-spotlight">SPOTLIGHT OPPORTUNITY</span>
                            <span class="score-box">87/100 <span>OPPORTUNITY</span></span>
                        </div>
                        <h4 class="spotlight-name">Pensil Labubu Blind Box</h4>
                        <div class="spotlight-category">Stationery & Giftware</div>

                        <div class="spotlight-metric-row">
                            <span class="lbl">Demand Score</span>
                            <span class="val-bold">92 / 100 (Sangat Tinggi)</span>
                        </div>
                        <div class="spotlight-metric-row">
                            <span class="lbl">Tingkat Kompetitor</span>
                            <span class="val-green">Rendah (18% Seller)</span>
                        </div>
                        <div class="spotlight-metric-row">
                            <span class="lbl">Estimasi Margin Laba</span>
                            <span class="val-bold">+38% per unit</span>
                        </div>

                        <div class="spotlight-forecast-grid">
                            <div class="fc-box">
                                <span class="fc-label">PROYEKSI PENJUALAN</span>
                                <span class="fc-num">120 unit / <small>mgg</small></span>
                            </div>
                            <div class="fc-box">
                                <span class="fc-label">POTENSI OMSET TAMBAHAN</span>
                                <span class="fc-num text-green">Rp 4.200.000</span>
                            </div>
                        </div>

                        <a href="{{ route('predict.index', ['product_name' => 'Pensil Labubu Blind Box', 'price' => 35000, 'cost' => 22000, 'category' => 'Stationery & Giftware']) }}" class="btn-lime w-full text-center">
                            <span>Simulasi dengan LARIS Predict</span>
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- PELUANG LAIN -->
                <div class="other-opportunities-row">
                    <div class="other-head">
                        <span class="title">Peluang Lain yang Terpantau</span>
                        <a href="{{ url('/trend-hunter') }}" class="link-view-all">Lihat Semua di Trend Hunter &rarr;</a>
                    </div>
                    <div class="other-items-grid">
                        <a href="{{ route('predict.index', ['product_name' => 'Kopi Drip Bag Arabika', 'price' => 28000, 'cost' => 16000, 'category' => 'Biji Kopi']) }}" class="opp-mini-card interactive-opp-link" title="Klik untuk simulasi produk ini">
                            <div class="opp-mini-info">
                                <span class="opp-name">Kopi Drip Bag Arabika</span>
                                <span class="opp-growth">+45% Permintaan (Simulasi &rarr;)</span>
                            </div>
                            <span class="opp-score-badge">78</span>
                        </a>
                        <a href="{{ route('predict.index', ['product_name' => 'Botol Minum Motivasi 2L', 'price' => 45000, 'cost' => 25000, 'category' => 'Lifestyle']) }}" class="opp-mini-card interactive-opp-link" title="Klik untuk simulasi produk ini">
                            <div class="opp-mini-info">
                                <span class="opp-name">Botol Minum 2L</span>
                                <span class="opp-growth">+32% Permintaan (Simulasi &rarr;)</span>
                            </div>
                            <span class="opp-score-badge">74</span>
                        </a>
                        <a href="{{ route('predict.index', ['product_name' => 'Kabel Data Type-C 65W', 'price' => 35000, 'cost' => 15000, 'category' => 'Aksesoris & Lifestyle']) }}" class="opp-mini-card interactive-opp-link" title="Klik untuk simulasi produk ini">
                            <div class="opp-mini-info">
                                <span class="opp-name">Kabel Type-C 65W</span>
                                <span class="opp-growth">+28% Permintaan (Simulasi &rarr;)</span>
                            </div>
                            <span class="opp-score-badge">69</span>
                        </a>
                    </div>
                </div>

                <!-- TREN PENJUALAN & PREDIKSI AI (CHART) -->
                <div class="trend-chart-section">
                    <div class="chart-header">
                        <div>
                            <h4>Tren Penjualan & Prediksi AI</h4>
                            <p class="sub-muted">Perbandingan data historis dengan AI Confidence Band (7 hari kedepan)</p>
                        </div>
                        <div class="chart-legend">
                            <span class="leg-item"><span class="line-black"></span> Riil</span>
                            <span class="leg-item"><span class="line-green-dash"></span> Prediksi AI</span>
                        </div>
                    </div>

                    <div class="chart-canvas-container">
                        <svg viewBox="0 0 600 140" class="main-trend-svg">
                            <!-- Background Grid -->
                            <line x1="0" y1="30" x2="600" y2="30" stroke="#F1F5F9" stroke-width="1" />
                            <line x1="0" y1="70" x2="600" y2="70" stroke="#F1F5F9" stroke-width="1" />
                            <line x1="0" y1="110" x2="600" y2="110" stroke="#F1F5F9" stroke-width="1" />
                            
                            <!-- Confidence Band (Light Green Polygon) -->
                            <polygon points="360,65 440,40 520,30 600,10 600,60 520,80 440,90 360,65" fill="rgba(204, 255, 0, 0.22)" />
                            
                            <!-- Historical Real Curve -->
                            <path d="M 20 100 Q 100 130, 180 80 T 360 65" fill="none" stroke="#0F172A" stroke-width="3" />
                            
                            <!-- AI Prediction Forecast (Dashed Green) -->
                            <path d="M 360 65 Q 480 35, 600 20" fill="none" stroke="#16A34A" stroke-width="3" stroke-dasharray="6,4" />
                            
                            <!-- Key Points -->
                            <circle cx="360" cy="65" r="5" fill="#CCFF00" stroke="#0F172A" stroke-width="2" />
                            <circle cx="600" cy="20" r="4" fill="#16A34A" />
                        </svg>
                        <div class="chart-x-labels">
                            <span>Sen (18)</span>
                            <span>Sel (19)</span>
                            <span>Rab (20)</span>
                            <span>Kam (21)</span>
                            <span class="active-today">Hari Ini (24)</span>
                            <span class="future-day">Sab (25)*</span>
                            <span class="future-day">Min (26)*</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- COLUMN RIGHT: PERINGATAN OPERASIONAL & KONTRIBUSI KATEGORI -->
        <div class="col-right">
            
            <!-- PERINGATAN OPERASIONAL -->
            <div class="card-panel mb-24">
                <div class="alert-sec-header">
                    <div class="flex-align gap-8">
                        <svg width="18" height="18" fill="none" stroke="#DC2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                        <h3 class="sec-title">Peringatan Operasional</h3>
                    </div>
                    <span class="badge-danger-pill">3 MENDESAK</span>
                </div>

                <div class="alert-items-list">
                    @forelse($alerts as $alert)
                        @php
                            $borderClass = $alert->alert_type === 'imminent_stockout' ? 'border-red' : ($alert->alert_type === 'margin_drop' ? 'border-amber' : 'border-gray');
                            $tagClass = $alert->alert_type === 'imminent_stockout' ? 'tag-red' : ($alert->alert_type === 'margin_drop' ? 'tag-amber' : 'tag-gray');
                            $btnClass = $alert->alert_type === 'imminent_stockout' ? 'btn-action-dark' : ($alert->alert_type === 'margin_drop' ? 'btn-action-lime' : 'btn-action-outline');
                        @endphp
                        <div class="op-alert-card {{ $borderClass }}">
                            <div class="alert-card-top">
                                <h4>{{ $alert->product_name }}</h4>
                                <span class="badge-tag {{ $tagClass }}">{{ $alert->badge_text }}</span>
                            </div>
                            <p class="alert-desc">{{ $alert->description }}</p>
                            <div class="alert-foot">
                                <span class="supp-text">Tindakan Cepat AI</span>
                                <form action="{{ route('alerts.resolve', $alert->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="{{ $btnClass }}" style="cursor: pointer;">
                                        {{ $alert->action_label }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div style="padding: 18px; text-align: center; color: #16A34A; background: #DCFCE7; border-radius: 12px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <span>Semua peringatan operasional telah terselesaikan! Operasional berjalan optimal.</span>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- KATEGORI TERLARIS -->
            <div class="card-panel mb-24">
                <div class="cat-sec-header">
                    <div>
                        <h3 class="sec-title">Kategori Terlaris</h3>
                        <p class="sub-muted">Kontribusi omzet ({{ $kpiData['timeframe_label'] }})</p>
                    </div>
                    <svg width="20" height="20" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                </div>

                <div class="category-bars-list">
                    @foreach($categoriesData as $cat)
                        <div class="cat-bar-item">
                            <div class="cat-bar-info">
                                <span class="cat-name">{{ $cat['name'] }}</span>
                                <span class="cat-val">{{ $cat['amount'] }} <small class="text-green">({{ $cat['growth'] }})</small></span>
                            </div>
                            <div class="bar-track"><div class="bar-fill" style="width: {{ min(100, $cat['pct'] * 2.2) }}%;"></div></div>
                        </div>
                    @endforeach
                </div>

                <div class="cat-foot-row">
                    <span class="basket-stat">Rata-rata basket size: <strong>Rp 84.500</strong></span>
                    <a href="{{ url('/business-report') }}" class="link-detail">Analisis Detail &rarr;</a>
                </div>
            </div>

            <!-- PROMPT JURAGAN AI WIDGET -->
            <a href="{{ url('/juragan-ai') }}" class="juragan-prompt-card">
                <div class="prompt-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.502 49.177 49.177 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/></svg>
                </div>
                <div class="prompt-body">
                    <div class="prompt-title">Tanya Juragan AI</div>
                    <div class="prompt-sub">"Bagaimana cara menaikkan omset akhir pekan ini?"</div>
                </div>
                <div class="prompt-arrow">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                </div>
            </a>

        </div>

    </div>

</div>

@push('styles')
<style>
    .dashboard-container {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .dash-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .header-main-info {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .telemetry-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%);
        border: 1px solid #BBF7D0;
        color: #166534;
        padding: 5px 14px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        width: fit-content;
        box-shadow: 0 2px 6px rgba(22, 163, 74, 0.08);
    }

    .telemetry-divider {
        color: #86EFAC;
    }

    .telemetry-sync-time {
        color: #15803D;
        font-weight: 600;
    }

    .pulse-dot {
        width: 7px;
        height: 7px;
        background-color: #16A34A;
        border-radius: 50%;
        animation: pulse 1.8s infinite;
        box-shadow: 0 0 8px rgba(22, 163, 74, 0.6);
    }

    @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(22, 163, 74, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(22, 163, 74, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(22, 163, 74, 0); }
    }

    .greeting-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 2px;
    }

    .page-greeting {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 24px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .store-gradient-name {
        background: linear-gradient(135deg, #0F172A 30%, #166534 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        border-bottom: 2px solid #CCFF00;
        padding-bottom: 1px;
    }

    .verified-store-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #F0FDF4;
        border: 1px solid #BBF7D0;
        color: #166534;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 12px;
    }

    .header-meta-chips {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-top: 2px;
    }

    .page-subtitle {
        font-size: 13px;
        color: #64748B;
        line-height: 1.4;
    }

    .quick-status-badges {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stat-pill {
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        color: #475569;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .dot-live {
        width: 6px;
        height: 6px;
        background: #16A34A;
        border-radius: 50%;
    }

    .dash-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* INSTANT INSIGHT STRIP BANNER */
    .instant-insight-banner {
        background: #0B1215;
        border: 1px solid #1E2D33;
        border-radius: 16px;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25);
    }

    .insight-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .ai-icon-box {
        width: 44px;
        height: 44px;
        background: #162228;
        border: 1px solid #273840;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .insight-tag {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.8px;
        color: var(--accent-lime);
        margin-bottom: 2px;
    }

    .insight-text p {
        color: #E2E8F0;
        font-size: 14px;
        line-height: 1.4;
    }

    .highlight-text {
        color: var(--accent-lime);
        text-decoration: underline;
        font-weight: 600;
    }

    /* KPI GRID */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    .kpi-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 140px;
    }

    .kpi-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .kpi-title {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-muted);
    }

    .kpi-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 20px;
    }

    .badge-green {
        background: #DCFCE7;
        color: #16A34A;
    }

    .badge-optimal {
        background: #F1F5F9;
        color: #0F172A;
    }

    .badge-high-signal {
        background: #CCFF00;
        color: #000000;
    }

    .kpi-value-row {
        display: flex;
        align-items: baseline;
        gap: 10px;
        margin: 10px 0 6px 0;
    }

    .kpi-val {
        font-family: 'Outfit', sans-serif;
        font-size: 28px;
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -0.5px;
    }

    .kpi-comparison, .kpi-alert-subtext {
        font-size: 11px;
        color: #DC2626;
        font-weight: 600;
    }

    .kpi-comparison {
        color: var(--text-muted);
    }

    .kpi-sub-meta {
        font-size: 12px;
    }

    .meta-bold {
        font-weight: 700;
        color: #0F172A;
    }

    .kpi-progress-bar {
        height: 6px;
        background: #F1F5F9;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: var(--text-main);
        border-radius: 10px;
    }

    .kpi-status-foot {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .bullet-green {
        width: 6px;
        height: 6px;
        background-color: #22C55E;
        border-radius: 50%;
    }

    .radar-ping {
        width: 6px;
        height: 6px;
        background-color: #CCFF00;
        border-radius: 50%;
    }

    .score-pill {
        width: 38px;
        height: 38px;
        background: #0B1215;
        color: var(--accent-lime);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
    }

    .score-head {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-main);
    }

    .score-sub {
        font-size: 10px;
        color: var(--text-muted);
    }

    /* TWO COLUMNS */
    .dash-columns {
        display: grid;
        grid-template-columns: 1.35fr 1fr;
        gap: 22px;
    }

    /* RADAR STYLES */
    .radar-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .radar-title-group {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .radar-icon-badge {
        width: 36px;
        height: 36px;
        background: #DCFCE7;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .flex-align {
        display: flex;
        align-items: center;
    }

    .gap-8 { gap: 8px; }

    .tag-pill {
        background: #CCFF00;
        color: #000000;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 12px;
    }

    .sub-muted {
        font-size: 12px;
        color: var(--text-muted);
    }

    .btn-more {
        background: transparent;
        border: none;
        color: var(--text-muted);
        font-size: 16px;
        cursor: pointer;
    }

    .spotlight-radar-box {
        display: grid;
        grid-template-columns: 1fr 1.3fr;
        gap: 20px;
        background: #FAFAFA;
        border: 1px solid #F1F5F9;
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 20px;
    }

    .radar-visual {
        position: relative;
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .radar-circle-outer, .radar-circle-mid, .radar-circle-inner {
        position: absolute;
        border-radius: 50%;
        border: 1px dashed #CBD5E1;
    }

    .radar-circle-outer { width: 180px; height: 180px; }
    .radar-circle-mid { width: 120px; height: 120px; }
    .radar-circle-inner { width: 60px; height: 60px; }

    .radar-blip.blip-center {
        position: absolute;
        width: 32px;
        height: 32px;
        background: #0B1215;
        color: #CCFF00;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
        border: 2px solid #CCFF00;
        z-index: 5;
    }

    .radar-blip.blip-target {
        position: absolute;
        top: 40px;
        right: 35px;
        width: 14px;
        height: 14px;
        background: #CCFF00;
        border: 2px solid #000000;
        border-radius: 50%;
        z-index: 6;
        animation: pulse 1.5s infinite;
    }

    .radar-legend {
        position: absolute;
        bottom: 0;
        left: 0;
        font-size: 11px;
        color: var(--text-muted);
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .dot-green { width: 8px; height: 8px; background: #CCFF00; border-radius: 50%; display: inline-block; }
    .dot-gray { width: 8px; height: 8px; background: #94A3B8; border-radius: 50%; display: inline-block; }

    .spotlight-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 16px;
    }

    .spotlight-badge-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .badge-spotlight {
        font-size: 10px;
        font-weight: 800;
        color: #64748B;
        letter-spacing: 0.5px;
    }

    .score-box {
        background: #DCFCE7;
        color: #16A34A;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
    }

    .spotlight-name {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-main);
    }

    .spotlight-category {
        font-size: 11px;
        color: var(--text-muted);
        margin-bottom: 12px;
    }

    .spotlight-metric-row {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        padding: 4px 0;
        border-bottom: 1px solid #F8FAFC;
    }

    .val-bold { font-weight: 700; color: var(--text-main); }
    .val-green { font-weight: 700; color: #16A34A; }

    .spotlight-forecast-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        background: #F8FAFC;
        padding: 10px;
        border-radius: 8px;
        margin: 14px 0;
    }

    .fc-label {
        font-size: 9px;
        font-weight: 700;
        color: var(--text-muted);
        display: block;
    }

    .fc-num {
        font-size: 14px;
        font-weight: 800;
        color: var(--text-main);
    }

    .text-green { color: #16A34A; }
    .w-full { width: 100%; justify-content: center; }

    /* OTHER OPPORTUNITIES */
    .other-opportunities-row {
        margin-bottom: 24px;
    }

    .other-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .other-head .title {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-main);
    }

    .link-view-all {
        font-size: 12px;
        font-weight: 600;
        color: #16A34A;
        text-decoration: none;
    }

    .other-items-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .opp-mini-card {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .opp-name {
        font-size: 12px;
        font-weight: 700;
        display: block;
        color: var(--text-main);
    }

    .opp-growth {
        font-size: 10px;
        color: #16A34A;
        font-weight: 600;
    }

    .opp-score-badge {
        background: #0B1215;
        color: var(--accent-lime);
        font-size: 12px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
    }

    /* CHART SECTION */
    .trend-chart-section {
        border-top: 1px solid #F1F5F9;
        padding-top: 20px;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .chart-legend {
        display: flex;
        gap: 14px;
        font-size: 11px;
        color: var(--text-muted);
    }

    .leg-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .line-black { width: 14px; height: 3px; background: #0F172A; display: inline-block; border-radius: 2px; }
    .line-green-dash { width: 14px; height: 3px; background: #16A34A; display: inline-block; border-radius: 2px; border-top: 1px dashed; }

    .chart-canvas-container {
        width: 100%;
    }

    .main-trend-svg {
        width: 100%;
        height: 120px;
    }

    .chart-x-labels {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: var(--text-muted);
        margin-top: 6px;
    }

    .active-today {
        font-weight: 700;
        color: var(--text-main);
    }

    .future-day {
        color: #16A34A;
        font-weight: 600;
    }

    /* OPERATIONAL ALERTS */
    .mb-24 { margin-bottom: 24px; }
    .alert-sec-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .sec-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-main);
    }

    .badge-danger-pill {
        background: #FEE2E2;
        color: #DC2626;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 12px;
    }

    .alert-items-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .op-alert-card {
        border-radius: 12px;
        padding: 14px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
    }

    .border-red { border-left: 4px solid #DC2626; }
    .border-amber { border-left: 4px solid #D97706; }
    .border-gray { border-left: 4px solid #64748B; }

    .alert-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
    }

    .alert-card-top h4 {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-main);
    }

    .badge-tag {
        font-size: 9px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .tag-red { background: #FEE2E2; color: #DC2626; }
    .tag-amber { background: #FEF3C7; color: #D97706; }
    .tag-gray { background: #F1F5F9; color: #475569; }

    .alert-desc {
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.4;
        margin-bottom: 10px;
    }

    .alert-foot {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .supp-text, .margin-impact, .modal-hold {
        font-size: 11px;
        color: var(--text-muted);
    }

    .btn-action-dark {
        background: #0B1215;
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
    }

    .btn-action-lime {
        background: var(--accent-lime);
        color: #000000;
        font-size: 11px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
    }

    .btn-action-outline {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        color: var(--text-main);
        font-size: 11px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
    }

    /* KATEGORI TERLARIS BARS */
    .cat-sec-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .category-bars-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-bottom: 16px;
    }

    .cat-bar-info {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .bar-track {
        height: 6px;
        background: #F1F5F9;
        border-radius: 6px;
        overflow: hidden;
    }

    .bar-fill {
        height: 100%;
        background: #16A34A;
        border-radius: 6px;
    }

    .cat-foot-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #F1F5F9;
        padding-top: 12px;
        font-size: 12px;
    }

    .link-detail {
        color: #16A34A;
        font-weight: 600;
        text-decoration: none;
    }

    /* JURAGAN AI QUICK PROMPT */
    .juragan-prompt-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        color: inherit;
        transition: all 0.2s;
    }

    .juragan-prompt-card:hover {
        border-color: #CCFF00;
        box-shadow: 0 4px 16px rgba(204, 255, 0, 0.2);
    }

    .prompt-icon {
        width: 38px;
        height: 38px;
        background: #0B1215;
        color: var(--accent-lime);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .prompt-title {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-main);
    }

    .prompt-sub {
        font-size: 11px;
        color: var(--text-muted);
    }

    .prompt-arrow {
        margin-left: auto;
        color: var(--text-muted);
    }

    @media (max-width: 1200px) {
        .kpi-grid { grid-template-columns: repeat(2, 1fr); }
        .dash-columns { grid-template-columns: 1fr; }
    }

    @media (max-width: 900px) {
        .dash-header {
            flex-direction: column;
            align-items: stretch;
            gap: 16px;
        }
        .dash-actions {
            display: flex;
            width: 100%;
            justify-content: flex-start;
            flex-wrap: wrap;
            gap: 10px;
        }
        .instant-insight-banner {
            flex-direction: column;
            align-items: stretch;
            gap: 14px;
        }
        .instant-insight-banner .btn-lime {
            width: 100%;
            justify-content: center;
        }
        .charts-duo-grid {
            grid-template-columns: 1fr;
        }
        .opp-radar-cards {
            grid-template-columns: 1fr;
        }
        .quick-prompts-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .kpi-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .telemetry-pill {
            flex-wrap: wrap;
            font-size: 11px;
            padding: 8px 12px;
        }
        .telemetry-divider {
            display: none;
        }
        .page-greeting {
            font-size: 20px;
        }
        .kpi-val {
            font-size: 22px;
        }
        .trans-table-wrap {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .trans-table-wrap table {
            min-width: 580px;
        }
    }

    /* TIMEFRAME DROPDOWN STYLES */
    .timeframe-popup-menu {
        position: absolute;
        top: calc(100% + 6px);
        right: 0;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        min-width: 180px;
        z-index: 50;
        overflow: hidden;
        padding: 6px;
    }

    .timeframe-popup-menu .menu-item {
        display: block;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 600;
        color: #334155;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.15s ease;
    }

    .timeframe-popup-menu .menu-item:hover {
        background: #F1F5F9;
        color: #0F172A;
    }

    .timeframe-popup-menu .menu-item.active {
        background: #0B1215;
        color: #CCFF00;
        font-weight: 700;
    }

    /* MINI SIMULATION BUTTON */
    .btn-mini-sim {
        background: #0B1215;
        color: #CCFF00;
        border: 1px solid #1E2D33;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-mini-sim:hover {
        background: #CCFF00;
        color: #000000;
        transform: scale(1.05);
    }

    /* INTERACTIVE OPP LINKS */
    .interactive-opp-link {
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .interactive-opp-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.15);
        border-color: #16A34A !important;
    }

    /* FLASH HIGHLIGHT ON LIVE UPDATE */
    .live-flash-green {
        animation: flashGreen 1.2s ease-out;
    }

    @keyframes flashGreen {
        0% { background-color: rgba(204, 255, 0, 0.5); border-radius: 6px; }
        100% { background-color: transparent; }
    }
</style>
@endpush

@push('scripts')
<script>
    function toggleTimeframeMenu() {
        const menu = document.getElementById('timeframe-menu');
        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const toggleBtn = document.getElementById('btn-timeframe-toggle');
        const menu = document.getElementById('timeframe-menu');
        if (toggleBtn && menu && !toggleBtn.contains(e.target) && !menu.contains(e.target)) {
            menu.style.display = 'none';
        }
    });

    // Real-time Telemetry Poller
    const currentTimeframe = "{{ $timeframe }}";
    let lastRevenue = "{{ $kpiData['revenue_raw'] }}";

    async function pollLiveTelemetry() {
        try {
            const response = await fetch(`{{ route('telemetry.live') }}?timeframe=${currentTimeframe}`);
            if (!response.ok) return;

            const res = await response.json();
            if (res.status === 'success' && res.data) {
                const data = res.data;
                const revenueEl = document.getElementById('kpi-revenue');
                const profitEl = document.getElementById('kpi-profit');
                const marginEl = document.getElementById('kpi-margin');
                const ordersEl = document.getElementById('kpi-orders-count');
                const syncBadge = document.getElementById('telemetry-sync-badge');

                if (revenueEl && data.revenue_formatted) {
                    if (data.revenue_raw !== parseFloat(lastRevenue)) {
                        revenueEl.classList.add('live-flash-green');
                        profitEl.classList.add('live-flash-green');
                        setTimeout(() => {
                            revenueEl.classList.remove('live-flash-green');
                            profitEl.classList.remove('live-flash-green');
                        }, 1300);
                        lastRevenue = data.revenue_raw;
                    }
                    revenueEl.textContent = data.revenue_formatted;
                }

                if (profitEl && data.profit_formatted) profitEl.textContent = data.profit_formatted;
                if (marginEl && data.margin_pct) marginEl.textContent = data.margin_pct + '%';
                if (ordersEl && data.orders_count) ordersEl.textContent = data.orders_count + ' Transaksi Terproses';
                if (syncBadge && data.last_sync) syncBadge.textContent = 'Sinkronisasi Real-time (' + data.last_sync + ')';
            }
        } catch (err) {
            console.warn('Telemetry poll error:', err);
        }
    }

    // Poll every 7 seconds
    setInterval(pollLiveTelemetry, 7000);

    // Simulate Live Order from Cashier / Marketplace
    async function simulateLiveOrder() {
        const btn = document.querySelector('.btn-mini-sim');
        if (btn) btn.textContent = '⏳ Memproses...';

        try {
            const channels = ['Kasir Smart POS', 'Shopee Official', 'Tokopedia Store'];
            const chosen = channels[Math.floor(Math.random() * channels.length)];

            const response = await fetch('{{ route('telemetry.simulate_webhook') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ channel: chosen })
            });

            const res = await response.json();
            if (res.status === 'success') {
                await pollLiveTelemetry();
                showToast(res.message);
            }
        } catch (e) {
            console.error(e);
            alert('Gagal mensimulasikan transaksi!');
        } finally {
            if (btn) btn.innerHTML = '<span>+ Simulasi Kasir</span>';
        }
    }

    function toggleRadarMenu() {
        const menu = document.getElementById('radar-dropdown-menu');
        if (menu) menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }

    function refreshRadarVisual() {
        const menu = document.getElementById('radar-dropdown-menu');
        if (menu) menu.style.display = 'none';
        const sweep = document.querySelector('.radar-sweep');
        if (sweep) {
            sweep.style.animation = 'none';
            sweep.offsetHeight; // trigger reflow
            sweep.style.animation = null;
        }
        showToast('Radar berhasil memindai 4 sinyal tren baru di marketplace!');
    }

    // Close radar menu on outside click
    document.addEventListener('click', function(e) {
        const radarMenu = document.getElementById('radar-dropdown-menu');
        const moreBtn = document.querySelector('.btn-more');
        if (radarMenu && moreBtn && !radarMenu.contains(e.target) && !moreBtn.contains(e.target)) {
            radarMenu.style.display = 'none';
        }
    });

    function showToast(message) {
        const toast = document.createElement('div');
        toast.style.position = 'fixed';
        toast.style.bottom = '24px';
        toast.style.right = '24px';
        toast.style.background = '#0B1215';
        toast.style.color = '#CCFF00';
        toast.style.border = '1px solid #16A34A';
        toast.style.padding = '12px 20px';
        toast.style.borderRadius = '10px';
        toast.style.fontSize = '12px';
        toast.style.fontWeight = '700';
        toast.style.boxShadow = '0 10px 25px rgba(0,0,0,0.3)';
        toast.style.zIndex = '9999';
        toast.style.transition = 'all 0.3s ease';
        toast.textContent = message;

        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(10px)';
            setTimeout(() => toast.remove(), 400);
        }, 3500);
    }
</script>
@endpush
@endsection
