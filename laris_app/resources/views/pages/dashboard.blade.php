@extends('layouts.app', ['title' => 'Business Dashboard - LARIS BI Platform'])

@section('content')
<div class="dashboard-container">

    <!-- NOTIFIKASI SUCCESS FLASH -->
    @if(session('success'))
        <div class="glass-success-alert">
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg width="20" height="20" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="alert-close-btn">&times;</button>
        </div>
    @endif

    <!-- 1. CLEAN EXECUTIVE GREETING HEADER -->
    <div class="dash-header">
        <div class="header-main-info">
            <div class="greeting-row">
                <h1 class="page-greeting">Selamat {{ $greetingTime ?? 'Pagi' }}, <span class="store-gradient-name">{{ $store->name ?? 'Toko Berkah' }}</span></h1>
                <span class="verified-store-badge" title="Gerai Resmi Terverifikasi">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="#10B981"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                    <span>Terverifikasi</span>
                </span>
                <span class="live-status-pill">
                    <span class="pulse-dot"></span>
                    <span id="telemetry-sync-badge">Live Sync ({{ $kpiData['last_sync'] }})</span>
                </span>
            </div>
            <p class="page-subtitle">Ringkasan performa penjualan harian, margin keuntungan, dan peluang produk terlaris.</p>
        </div>

        <div class="dash-actions">

            <!-- TIMEFRAME DROPDOWN -->
            <div class="dropdown-timeframe" style="position: relative;">
                <button type="button" class="btn-timeframe-glossy" id="btn-timeframe-toggle" onclick="toggleTimeframeMenu()">
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

            <!-- UNDUH RINGKASAN BUTTON (PDF) -->
            <a href="{{ route('dashboard.download_summary', ['timeframe' => $timeframe]) }}" class="btn-download-glossy" title="Unduh Ringkasan Laporan Bisnis Resmi (PDF)">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                <span>Unduh Laporan (PDF)</span>
            </a>
        </div>
    </div>

    <!-- 2. GLOSSY AI INSIGHT CAPSULE (ELEGANT & MEWAH) -->
    <div class="instant-insight-banner">
        <div class="insight-left">
            <div class="ai-gem-icon">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/></svg>
            </div>
            <div class="insight-text">
                <div class="insight-tag">PELUANG PASAR TERBAIK HARI INI</div>
                <p>Permintaan produk viral <strong>Pensil Labubu Blind Box</strong> melonjak <strong>+310%</strong> di wilayah Jawa Barat. Estimasi margin keuntungan <strong>38%</strong> jika di-restock sebelum akhir pekan.</p>
            </div>
        </div>
        <a href="{{ route('predict.index', ['product_name' => 'Pensil Labubu Blind Box', 'price' => 35000, 'cost' => 22000, 'category' => 'Stationery & Giftware']) }}" class="btn-insight-action">
            <span>Analisis Peluang di LARIS Predict</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
        </a>
    </div>

    <!-- 3. TOP 4 GLOSSY KPI CARDS (SIMPLE & MEWAH) -->
    <div class="kpi-grid">
        <!-- KPI 1: REVENUE -->
        <div class="kpi-card card-glossy">
            <div class="kpi-top">
                <span class="kpi-title">Total Penjualan</span>
                <span class="kpi-badge badge-mint">+12%</span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val" id="kpi-revenue">{{ $kpiData['revenue_formatted'] }}</h2>
            </div>
            <div class="kpi-status-foot">
                <span class="dot-green"></span>
                <span id="kpi-orders-count">{{ $kpiData['orders_today_count'] }} Transaksi Terproses</span>
            </div>
        </div>

        <!-- KPI 2: NET PROFIT -->
        <div class="kpi-card card-glossy">
            <div class="kpi-top">
                <span class="kpi-title">Estimasi Laba Bersih</span>
                <span class="kpi-badge badge-blue">Margin <span id="kpi-margin">{{ $kpiData['margin_pct'] }}%</span></span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val" id="kpi-profit">{{ $kpiData['profit_formatted'] }}</h2>
            </div>
            <div class="kpi-progress-bar">
                <div class="progress-fill" id="kpi-margin-bar" style="width: {{ min(100, $kpiData['margin_pct'] * 2) }}%;"></div>
            </div>
        </div>

        <!-- KPI 3: STOCK HEALTH -->
        <div class="kpi-card card-glossy">
            <div class="kpi-top">
                <span class="kpi-title">Kesehatan Stok Gudang</span>
                <span class="kpi-badge badge-slate">Optimal</span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val" id="kpi-stock-health">{{ $kpiData['stock_health_pct'] }}%</h2>
            </div>
            <div class="kpi-status-foot">
                <span class="dot-amber"></span>
                <span id="kpi-critical-count">{{ $kpiData['critical_count'] }} Perlu Reorder</span>
                <span style="color: var(--text-muted);">• {{ $kpiData['active_sku_count'] }} SKU</span>
            </div>
        </div>

        <!-- KPI 4: OPPORTUNITY SCORE -->
        <div class="kpi-card card-glossy">
            <div class="kpi-top">
                <span class="kpi-title">Skor Peluang Pasar</span>
                <span class="kpi-badge badge-lime">AI Radar</span>
            </div>
            <div class="kpi-value-row">
                <div class="score-display">
                    <span class="score-val" id="kpi-opp-score">{{ $kpiData['opportunity_score'] }}</span>
                    <span class="score-max">/ 100</span>
                </div>
            </div>
            <div class="kpi-status-foot">
                <span class="dot-lime"></span>
                <span>{{ $trends->count() }} Tren Viral Terpantau</span>
            </div>
        </div>
    </div>

    <!-- 4. MAIN TWO-COLUMN DASHBOARD SECTION -->
    <div class="dash-columns">
        
        <!-- COLUMN LEFT: OPPORTUNITY SPOTLIGHT & SALES TREND -->
        <div class="col-left">

            <!-- KARTU 1: OPPORTUNITY RADAR SPOTLIGHT -->
            <div class="card-panel mb-24">
                <div class="panel-header">
                    <div class="panel-title-group">
                        <div class="panel-icon-circle">
                            <svg width="18" height="18" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        </div>
                        <div>
                            <div class="flex-align gap-8">
                                <h3 class="panel-title">Radar Peluang Pasar</h3>
                                <span class="tag-pill-glossy">AI REALTIME</span>
                            </div>
                            <p class="panel-subtitle">Peluang margin dan permintaan tertinggi dari marketplace sekitar</p>
                        </div>
                    </div>
                    
                    <div style="position: relative;">
                        <button type="button" class="btn-more-glossy" onclick="toggleRadarMenu()" title="Opsi Radar">•••</button>
                        <div id="radar-dropdown-menu" class="timeframe-popup-menu" style="display: none; width: 220px;">
                            <a href="javascript:void(0)" onclick="refreshRadarVisual()" class="menu-item">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>
                                <span>Pindai Ulang Radar</span>
                            </a>
                            <a href="{{ route('trends.index') }}" class="menu-item">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                                <span>Buka Trend Hunter</span>
                            </a>
                            <a href="{{ route('predict.index') }}" class="menu-item">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                                <span>Buka Simulator Predict</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- SPOTLIGHT DETAIL CONTENT -->
                <div class="spotlight-radar-box">
                    <div class="radar-visual">
                        <div class="radar-circle-outer"></div>
                        <div class="radar-circle-mid"></div>
                        <div class="radar-circle-inner"></div>
                        <div class="radar-sweep"></div>
                        <div class="radar-blip blip-center">{{ $kpiData['opportunity_score'] }}</div>
                        <div class="radar-legend">
                            <span class="dot-green"></span> Top Viral
                            <span class="dot-gray"></span> Normal
                        </div>
                    </div>

                    <div class="spotlight-card-glossy">
                        <div class="spotlight-top-badge">
                            <span class="badge-spotlight">PRODUK SPOTLIGHT</span>
                            <span class="score-badge-glossy">{{ $kpiData['opportunity_score'] }} / 100 POTENSI</span>
                        </div>

                        @php
                            $spotlightName = $spotlightTrend->trend_name ?? 'Pensil Labubu Blind Box';
                            $spotlightCat = $spotlightTrend->category ?? 'Stationery & Giftware';
                            $spotlightGrowth = $spotlightTrend->growth_velocity ?? '+284%';
                            $spotlightComp = $spotlightTrend->competition_level ?? 'Rendah';
                        @endphp
                        <h4 class="spotlight-name">{{ $spotlightName }}</h4>
                        <div class="spotlight-category">{{ $spotlightCat }} &bull; Tren Viral Terpantau AI</div>

                        <div class="spotlight-metrics-list">
                            <div class="spotlight-metric-item">
                                <span class="lbl">Permintaan Pasar:</span>
                                <span class="val-bold">Sangat Tinggi ({{ $kpiData['opportunity_score'] }}/100)</span>
                            </div>
                            <div class="spotlight-metric-item">
                                <span class="lbl">Kompetisi Wilayah:</span>
                                <span class="val-green">{{ $spotlightComp }}</span>
                            </div>
                            <div class="spotlight-metric-item">
                                <span class="lbl">Estimasi Margin:</span>
                                <span class="val-bold">+38% per unit</span>
                            </div>
                        </div>

                        <div class="spotlight-forecast-row">
                            <div class="fc-stat">
                                <span class="fc-lbl">Target Penjualan:</span>
                                <strong>120 unit / minggu</strong>
                            </div>
                            <div class="fc-stat">
                                <span class="fc-lbl">Potensi Tambahan Omzet:</span>
                                <strong style="color: #10B981;">+Rp 4.200.000</strong>
                            </div>
                        </div>

                        <a href="{{ route('predict.index', ['product_name' => $spotlightName, 'category' => $spotlightCat, 'price' => 35000, 'cost' => 22000]) }}" class="btn-spotlight-action">
                            <span>Prediksi Margin di LARIS Predict</span>
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- 3 PELUANG LAIN (CLEAN MINI PILLS) -->
                <div class="other-opportunities-section">
                    <div class="other-head">
                        <span>Peluang Produk Lainnya di Sekitar Anda:</span>
                        <a href="{{ url('/trend-hunter') }}" class="link-view-all">Buka Trend Hunter &rarr;</a>
                    </div>
                    <div class="other-items-grid">
                        @if(isset($otherTrends) && $otherTrends->isNotEmpty())
                            @foreach($otherTrends as $ot)
                                <a href="{{ route('predict.index', ['product_name' => $ot->trend_name, 'category' => $ot->category]) }}" class="opp-mini-card">
                                    <div>
                                        <div class="opp-name">{{ $ot->trend_name }}</div>
                                        <div class="opp-growth">{{ $ot->growth_velocity }} Permintaan</div>
                                    </div>
                                    <span class="opp-score-pill">{{ $ot->signal_strength }}</span>
                                </a>
                            @endforeach
                        @else
                            <a href="{{ route('predict.index', ['product_name' => 'Kopi Drip Bag Arabika', 'price' => 28000, 'cost' => 16000, 'category' => 'Biji Kopi']) }}" class="opp-mini-card">
                                <div>
                                    <div class="opp-name">Kopi Drip Bag Arabika</div>
                                    <div class="opp-growth">+45% Permintaan</div>
                                </div>
                                <span class="opp-score-pill">78</span>
                            </a>
                            <a href="{{ route('predict.index', ['product_name' => 'Botol Minum 2L', 'price' => 45000, 'cost' => 25000, 'category' => 'Lifestyle']) }}" class="opp-mini-card">
                                <div>
                                    <div class="opp-name">Botol Minum 2L</div>
                                    <div class="opp-growth">+32% Permintaan</div>
                                </div>
                                <span class="opp-score-pill">74</span>
                            </a>
                            <a href="{{ route('predict.index', ['product_name' => 'Kabel Type-C 65W', 'price' => 35000, 'cost' => 15000, 'category' => 'Aksesoris & Lifestyle']) }}" class="opp-mini-card">
                                <div>
                                    <div class="opp-name">Kabel Type-C 65W</div>
                                    <div class="opp-growth">+28% Permintaan</div>
                                </div>
                                <span class="opp-score-pill">69</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- KARTU 2: TREN PENJUALAN & PREDIKSI AI (DEDICATED GLOSSY CHART) -->
            <div class="card-panel">
                <div class="panel-header">
                    <div>
                        <h3 class="panel-title">Tren Penjualan &amp; Prediksi AI</h3>
                        <p class="panel-subtitle">Perbandingan data historis riil dengan proyeksi AI 7 hari ke depan</p>
                    </div>
                    <div class="chart-legend">
                        <span class="leg-item"><span class="line-black"></span> Data Riil</span>
                        <span class="leg-item"><span class="line-green-dash"></span> Proyeksi AI</span>
                    </div>
                </div>

                <div class="chart-canvas-container">
                    <svg viewBox="0 0 600 130" class="main-trend-svg">
                        <line x1="0" y1="30" x2="600" y2="30" stroke="#F1F5F9" stroke-width="1" />
                        <line x1="0" y1="70" x2="600" y2="70" stroke="#F1F5F9" stroke-width="1" />
                        <line x1="0" y1="110" x2="600" y2="110" stroke="#F1F5F9" stroke-width="1" />
                        
                        <!-- Shaded Prediction Band -->
                        <polygon points="360,65 440,40 520,30 600,10 600,60 520,80 440,90 360,65" fill="rgba(16, 185, 129, 0.12)" />
                        
                        <!-- Historical Real Curve -->
                        <path d="M 20 100 Q 100 130, 180 80 T 360 65" fill="none" stroke="#0F172A" stroke-width="3" />
                        
                        <!-- AI Forecast Dashed Line -->
                        <path d="M 360 65 Q 480 35, 600 20" fill="none" stroke="#10B981" stroke-width="3" stroke-dasharray="6,4" />
                        
                        <circle cx="360" cy="65" r="5" fill="#CCFF00" stroke="#0F172A" stroke-width="2" />
                        <circle cx="600" cy="20" r="4" fill="#10B981" />
                    </svg>
                    <div class="chart-x-labels">
                        @if(isset($chartDays) && count($chartDays) === 7)
                            @foreach($chartDays as $idx => $cd)
                                <span class="{{ $idx === 4 ? 'active-today' : ($idx > 4 ? 'future-day' : '') }}">{{ $cd }}</span>
                            @endforeach
                        @else
                            <span>Sen (18)</span>
                            <span>Sel (19)</span>
                            <span>Rab (20)</span>
                            <span>Kam (21)</span>
                            <span class="active-today">Hari Ini</span>
                            <span class="future-day">Sab*</span>
                            <span class="future-day">Min*</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- COLUMN RIGHT: PERINGATAN OPERASIONAL & KATEGORI -->
        <div class="col-right">
            
            <!-- PERINGATAN OPERASIONAL -->
            <div class="card-panel mb-24">
                <div class="panel-header">
                    <div class="flex-align gap-8">
                        <div class="alert-icon-circle">
                            <svg width="18" height="18" fill="none" stroke="#DC2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                        </div>
                        <h3 class="panel-title">Peringatan Operasional</h3>
                    </div>
                    <span class="badge-danger-glossy">{{ count($alerts) }} Perlu Tindakan</span>
                </div>

                <div class="alert-items-list">
                    @forelse($alerts as $alert)
                        @php
                            $badgeColor = $alert->alert_type === 'imminent_stockout' ? 'badge-pill-red' : ($alert->alert_type === 'margin_drop' ? 'badge-pill-amber' : 'badge-pill-slate');
                        @endphp
                        <div class="op-alert-card-glossy">
                            <div class="alert-card-top">
                                <h4>{{ $alert->product_name }}</h4>
                                <span class="badge-pill {{ $badgeColor }}">{{ $alert->badge_text }}</span>
                            </div>
                            <p class="alert-desc">{{ $alert->description }}</p>
                            <div class="alert-foot">
                                <span class="supp-text">Saran Cepat AI</span>
                                <form action="{{ route('alerts.resolve', $alert->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn-action-glossy">
                                        {{ $alert->action_label }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="alert-empty-card">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <span>Semua operasional toko aman dan terkendali.</span>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- KATEGORI TERLARIS -->
            <div class="card-panel mb-24">
                <div class="panel-header">
                    <div>
                        <h3 class="panel-title">Kategori Terlaris</h3>
                        <p class="panel-subtitle">Kontribusi omzet gerai ({{ $kpiData['timeframe_label'] }})</p>
                    </div>
                    <svg width="20" height="20" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                </div>

                <div class="category-bars-list">
                    @foreach($categoriesData as $cat)
                        <div class="cat-bar-item">
                            <div class="cat-bar-info">
                                <span class="cat-name">{{ $cat['name'] }}</span>
                                <span class="cat-val">{{ $cat['amount'] }} <small style="color: #10B981; font-weight: 700;">({{ $cat['growth'] }})</small></span>
                            </div>
                            <div class="bar-track"><div class="bar-fill" style="width: {{ min(100, $cat['pct'] * 2.2) }}%;"></div></div>
                        </div>
                    @endforeach
                </div>

                <div class="cat-foot-row">
                    <span class="basket-stat">Rata-rata keranjang: <strong>{{ $kpiData['avg_basket_formatted'] ?? 'Rp 84.500' }}</strong></span>
                    <a href="{{ url('/business-report') }}" class="link-detail">Analisis Lengkap &rarr;</a>
                </div>
            </div>

            <!-- TANYA JURAGAN AI (GLOSSY QUICK PROMPT) -->
            <a href="{{ url('/juragan-ai') }}" class="juragan-prompt-card-glossy">
                <div class="prompt-icon-glossy">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.502 49.177 49.177 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/></svg>
                </div>
                <div class="prompt-body">
                    <div class="prompt-title">Tanya Juragan AI</div>
                    <div class="prompt-sub">"Bagaimana strategi menaikkan omzet akhir pekan ini?"</div>
                </div>
                <div class="prompt-arrow">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                </div>
            </a>

        </div>

    </div>

</div>
@endsection

@push('styles')
<style>
    /* ==========================================================================
       GLOSSY MINIMALIST DASHBOARD DESIGN SYSTEM (SIMPLE & MEWAH)
       ========================================================================== */
    .dashboard-container {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    /* Flash Alert */
    .glass-success-alert {
        background: linear-gradient(135deg, rgba(220, 252, 231, 0.95) 0%, rgba(187, 247, 208, 0.9) 100%);
        border: 1px solid rgba(134, 239, 172, 0.8);
        border-radius: 16px;
        padding: 14px 20px;
        color: #166534;
        font-size: 13.5px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.12), inset 0 1px 2px rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }

    .alert-close-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #166534;
        line-height: 1;
    }

    /* 1. Header Styles */
    .dash-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 16px;
    }

    .header-main-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .greeting-row {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .page-greeting {
        font-size: 26px;
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -0.02em;
        line-height: 1.2;
    }

    .store-gradient-name {
        background: linear-gradient(135deg, #0F172A 0%, #10B981 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .verified-store-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: linear-gradient(180deg, #F0FDF4 0%, #DCFCE7 100%);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #15803D;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 9999px;
        box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.8);
    }

    .live-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid #E2E8F0;
        color: #64748B;
        font-size: 11.5px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 9999px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    .pulse-dot {
        width: 7px;
        height: 7px;
        background: #10B981;
        border-radius: 50%;
        box-shadow: 0 0 8px #10B981;
    }

    .page-subtitle {
        font-size: 13.5px;
        color: var(--text-muted);
        line-height: 1.5;
    }

    .dash-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-mini-sim {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        padding: 8px 14px;
        border-radius: 9999px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04), inset 0 1px 1px rgba(255, 255, 255, 1);
    }

    .btn-mini-sim:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
        color: #0F172A;
        transform: translateY(-1px);
    }

    .btn-timeframe-glossy {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        color: #1E293B;
        font-size: 13px;
        font-weight: 700;
        padding: 9px 16px;
        border-radius: 12px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04), inset 0 1px 1px rgba(255, 255, 255, 1);
    }

    .btn-timeframe-glossy:hover {
        border-color: #10B981;
        background: #F8FAFC;
    }

    .btn-download-glossy {
        background: #0B131B;
        color: #FFFFFF;
        font-size: 13px;
        font-weight: 700;
        padding: 9px 18px;
        border-radius: 12px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        box-shadow: 0 4px 14px rgba(11, 19, 27, 0.25);
    }

    .btn-download-glossy:hover {
        background: #162432;
        transform: translateY(-1px);
    }

    /* Timeframe Menu */
    .timeframe-popup-menu {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.1);
        z-index: 50;
        overflow: hidden;
        min-width: 170px;
    }

    .timeframe-popup-menu .menu-item {
        display: flex;
        align-items: center;
        padding: 10px 14px;
        font-size: 12.5px;
        font-weight: 600;
        color: #334155;
        text-decoration: none;
        transition: background 0.15s;
    }

    .timeframe-popup-menu .menu-item:hover, .timeframe-popup-menu .menu-item.active {
        background: #F1F5F9;
        color: #10B981;
    }

    /* 2. GLOSSY AI INSIGHT CAPSULE (MEWAH) */
    .instant-insight-banner {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(204, 255, 0, 0.05) 50%, rgba(255, 255, 255, 0.95) 100%);
        border: 1px solid rgba(16, 185, 129, 0.25);
        border-radius: 20px;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.08), inset 0 1px 2px rgba(255, 255, 255, 1);
        backdrop-filter: blur(12px);
    }

    .insight-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .ai-gem-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: #CCFF00;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.6);
    }

    .insight-tag {
        font-size: 11px;
        font-weight: 800;
        color: #059669;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .insight-text p {
        font-size: 13.5px;
        color: #1E293B;
        line-height: 1.5;
    }

    .btn-insight-action {
        background: #0B131B;
        color: #CCFF00;
        padding: 10px 20px;
        border-radius: 9999px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        transition: all 0.25s;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
    }

    .btn-insight-action:hover {
        background: #162432;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
    }

    /* 3. GLOSSY KPI CARDS */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    .card-glossy {
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.92) 100%);
        border: 1px solid rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 22px 24px;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04), inset 0 1px 2px rgba(255, 255, 255, 1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 145px;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
    }

    .card-glossy:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1px 2px rgba(255, 255, 255, 1);
        border-color: rgba(16, 185, 129, 0.25);
    }

    .kpi-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .kpi-title {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-muted);
    }

    .kpi-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 9999px;
        box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.7);
    }

    .badge-mint {
        background: #DCFCE7;
        color: #15803D;
        border: 1px solid rgba(22, 163, 74, 0.2);
    }

    .badge-blue {
        background: #E0F2FE;
        color: #0369A1;
        border: 1px solid rgba(2, 132, 199, 0.2);
    }

    .badge-slate {
        background: #F1F5F9;
        color: #334155;
        border: 1px solid #E2E8F0;
    }

    .badge-lime {
        background: rgba(204, 255, 0, 0.2);
        color: #15803D;
        border: 1px solid rgba(204, 255, 0, 0.5);
    }

    .kpi-value-row {
        margin: 10px 0 6px 0;
    }

    .kpi-val {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    .score-display {
        display: flex;
        align-items: baseline;
        gap: 4px;
    }

    .score-val {
        font-size: 30px;
        font-weight: 800;
        color: var(--text-main);
    }

    .score-max {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-muted);
    }

    .kpi-status-foot {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11.5px;
        color: var(--text-muted);
        font-weight: 600;
    }

    .dot-green {
        width: 6px;
        height: 6px;
        background: #10B981;
        border-radius: 50%;
    }

    .dot-amber {
        width: 6px;
        height: 6px;
        background: #F59E0B;
        border-radius: 50%;
    }

    .dot-lime {
        width: 6px;
        height: 6px;
        background: #84CC16;
        border-radius: 50%;
    }

    .kpi-progress-bar {
        height: 6px;
        background: #F1F5F9;
        border-radius: 10px;
        overflow: hidden;
        margin-top: 4px;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #10B981, #0284C7);
        border-radius: 10px;
    }

    /* 4. MAIN TWO COLUMNS LAYOUT */
    .dash-columns {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 22px;
        align-items: flex-start;
    }

    .card-panel {
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.92) 100%);
        border: 1px solid rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04), inset 0 1px 2px rgba(255, 255, 255, 1);
        backdrop-filter: blur(16px);
        transition: all 0.25s ease;
    }

    .card-panel:hover {
        box-shadow: 0 14px 30px -4px rgba(16, 185, 129, 0.10), inset 0 1px 2px rgba(255, 255, 255, 1);
        border-color: rgba(16, 185, 129, 0.25);
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .panel-title-group {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .panel-icon-circle {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(16, 185, 129, 0.12);
        color: #10B981;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .panel-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-main);
    }

    .panel-subtitle {
        font-size: 12.5px;
        color: var(--text-muted);
        margin-top: 1px;
    }

    .tag-pill-glossy {
        font-size: 10px;
        font-weight: 800;
        color: #059669;
        background: #DCFCE7;
        padding: 2px 8px;
        border-radius: 20px;
        border: 1px solid rgba(16, 185, 129, 0.25);
        box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.8);
    }

    .btn-more-glossy {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        color: #64748B;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-more-glossy:hover {
        background: #F1F5F9;
        color: #0F172A;
    }

    /* Radar Visual */
    .spotlight-radar-box {
        display: grid;
        grid-template-columns: 190px 1fr;
        gap: 24px;
        align-items: center;
        margin-bottom: 24px;
    }

    .radar-visual {
        position: relative;
        width: 180px;
        height: 180px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .radar-circle-outer {
        position: absolute;
        inset: 0;
        border: 1px dashed rgba(16, 185, 129, 0.35);
        border-radius: 50%;
    }

    .radar-circle-mid {
        position: absolute;
        inset: 25px;
        border: 1px solid rgba(16, 185, 129, 0.25);
        border-radius: 50%;
    }

    .radar-circle-inner {
        position: absolute;
        inset: 50px;
        border: 1px solid rgba(16, 185, 129, 0.4);
        border-radius: 50%;
    }

    .radar-sweep {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: conic-gradient(from 0deg at 50% 50%, rgba(16, 185, 129, 0.3) 0deg, transparent 60deg);
        animation: radarSpin 4s linear infinite;
    }

    @keyframes radarSpin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .radar-blip.blip-center {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #0B131B;
        color: #CCFF00;
        font-size: 13px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        box-shadow: 0 0 12px rgba(204, 255, 0, 0.5);
    }

    .radar-legend {
        position: absolute;
        bottom: -2px;
        font-size: 10px;
        color: #64748B;
        display: flex;
        gap: 8px;
    }

    /* Spotlight Card */
    .spotlight-card-glossy {
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 18px 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    }

    .spotlight-top-badge {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .badge-spotlight {
        font-size: 10px;
        font-weight: 800;
        color: #059669;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .score-badge-glossy {
        font-size: 11px;
        font-weight: 800;
        color: #10B981;
        background: #DCFCE7;
        padding: 2px 8px;
        border-radius: 9999px;
    }

    .spotlight-name {
        font-size: 18px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 2px;
    }

    .spotlight-category {
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 14px;
    }

    .spotlight-metrics-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 14px;
        font-size: 12.5px;
    }

    .spotlight-metric-item {
        display: flex;
        justify-content: space-between;
    }

    .spotlight-metric-item .lbl {
        color: var(--text-muted);
    }

    .spotlight-metric-item .val-bold {
        font-weight: 700;
        color: var(--text-main);
    }

    .spotlight-metric-item .val-green {
        font-weight: 700;
        color: #10B981;
    }

    .spotlight-forecast-row {
        background: #F8FAFC;
        border-radius: 10px;
        padding: 10px 14px;
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        margin-bottom: 14px;
    }

    .fc-stat {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .fc-lbl {
        color: var(--text-muted);
        font-size: 10.5px;
    }

    .btn-spotlight-action {
        width: 100%;
        background: #0B131B;
        color: #CCFF00;
        padding: 10px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-spotlight-action:hover {
        background: #162432;
        transform: translateY(-1px);
    }

    /* Other Opportunities */
    .other-opportunities-section {
        border-top: 1px solid #F1F5F9;
        padding-top: 16px;
    }

    .other-head {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 600;
        margin-bottom: 10px;
    }

    .link-view-all {
        color: #10B981;
        text-decoration: none;
        font-weight: 700;
    }

    .other-items-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .opp-mini-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 10px 12px;
        text-decoration: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.2s;
    }

    .opp-mini-card:hover {
        border-color: #10B981;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    .opp-name {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-main);
    }

    .opp-growth {
        font-size: 11px;
        color: #10B981;
        font-weight: 600;
    }

    .opp-score-pill {
        font-size: 11px;
        font-weight: 800;
        background: #F1F5F9;
        color: #334155;
        padding: 2px 7px;
        border-radius: 6px;
    }

    /* Chart Styles */
    .chart-legend {
        display: flex;
        align-items: center;
        gap: 14px;
        font-size: 11.5px;
        color: var(--text-muted);
    }

    .leg-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .line-black {
        width: 14px;
        height: 3px;
        background: #0F172A;
        border-radius: 2px;
    }

    .line-green-dash {
        width: 14px;
        height: 3px;
        background: #10B981;
        border-radius: 2px;
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
        padding: 0 10px;
    }

    .chart-x-labels .active-today {
        color: #10B981;
        font-weight: 800;
    }

    /* Right Column Styles */
    .alert-icon-circle {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #FEE2E2;
        color: #DC2626;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .badge-danger-glossy {
        font-size: 10.5px;
        font-weight: 800;
        color: #B91C1C;
        background: #FEE2E2;
        padding: 3px 10px;
        border-radius: 9999px;
        border: 1px solid rgba(220, 38, 38, 0.2);
    }

    .alert-items-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .op-alert-card-glossy {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 14px 16px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
    }

    .alert-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
    }

    .alert-card-top h4 {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--text-main);
    }

    .badge-pill {
        font-size: 10.5px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 6px;
    }

    .badge-pill-red {
        background: #FEE2E2;
        color: #DC2626;
    }

    .badge-pill-amber {
        background: #FEF3C7;
        color: #D97706;
    }

    .badge-pill-slate {
        background: #F1F5F9;
        color: #475569;
    }

    .alert-desc {
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.45;
        margin-bottom: 12px;
    }

    .alert-foot {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .supp-text {
        font-size: 11px;
        color: var(--text-dim);
    }

    .btn-action-glossy {
        background: #0B131B;
        color: #FFFFFF;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-action-glossy:hover {
        background: #162432;
        color: #CCFF00;
    }

    .alert-empty-card {
        padding: 16px;
        text-align: center;
        color: #10B981;
        background: #F0FDF4;
        border: 1px solid rgba(16, 185, 129, 0.2);
        border-radius: 12px;
        font-size: 12.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    /* Category Breakdown */
    .category-bars-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-bottom: 16px;
    }

    .cat-bar-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .cat-bar-info {
        display: flex;
        justify-content: space-between;
        font-size: 12.5px;
    }

    .cat-name {
        font-weight: 600;
        color: var(--text-main);
    }

    .cat-val {
        font-weight: 700;
        color: #0F172A;
    }

    .bar-track {
        height: 6px;
        background: #F1F5F9;
        border-radius: 6px;
        overflow: hidden;
    }

    .bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #10B981, #0284C7);
        border-radius: 6px;
    }

    .cat-foot-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #F1F5F9;
        padding-top: 12px;
        font-size: 12px;
        color: var(--text-muted);
    }

    .link-detail {
        color: #10B981;
        text-decoration: none;
        font-weight: 700;
    }

    /* Tanya Juragan AI */
    .juragan-prompt-card-glossy {
        background: linear-gradient(135deg, #0B131B 0%, #162432 100%);
        border-radius: 16px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        color: #FFFFFF;
        box-shadow: 0 8px 20px rgba(11, 19, 27, 0.25);
        transition: all 0.2s;
    }

    .juragan-prompt-card-glossy:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(11, 19, 27, 0.35);
    }

    .prompt-icon-glossy {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(204, 255, 0, 0.15);
        color: #CCFF00;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .prompt-title {
        font-size: 13.5px;
        font-weight: 800;
        color: #FFFFFF;
    }

    .prompt-sub {
        font-size: 11.5px;
        color: #94A3B8;
        margin-top: 2px;
    }

    .prompt-arrow {
        margin-left: auto;
        color: #CCFF00;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .dash-columns {
            grid-template-columns: 1fr;
        }
        .spotlight-radar-box {
            grid-template-columns: 1fr;
        }
        .other-items-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .kpi-grid {
            grid-template-columns: 1fr;
        }
        .dash-header {
            flex-direction: column;
        }
        .instant-insight-banner {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush

@push('scripts')
<script>
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
                    revenueEl.textContent = data.revenue_formatted;
                }

                if (profitEl && data.profit_formatted) profitEl.textContent = data.profit_formatted;
                if (marginEl && data.margin_pct) marginEl.textContent = data.margin_pct + '%';
                if (ordersEl && data.orders_count) ordersEl.textContent = data.orders_count + ' Transaksi Terproses';
                if (syncBadge && data.last_sync) syncBadge.textContent = 'Live Sync (' + data.last_sync + ')';

                const stockHealthEl = document.getElementById('kpi-stock-health');
                const criticalEl = document.getElementById('kpi-critical-count');
                const marginBarEl = document.getElementById('kpi-margin-bar');

                if (stockHealthEl && data.stock_health_pct !== undefined) stockHealthEl.textContent = data.stock_health_pct + '%';
                if (criticalEl && data.critical_count !== undefined) criticalEl.textContent = data.critical_count + ' Perlu Reorder';
                if (marginBarEl && data.margin_pct !== undefined) marginBarEl.style.width = Math.min(100, data.margin_pct * 2) + '%';
            }
        } catch (err) {
            console.warn('Telemetry poll error:', err);
        }
    }

    // Poll every 7 seconds
    setInterval(pollLiveTelemetry, 7000);

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
        const moreBtn = document.querySelector('.btn-more-glossy');
        if (radarMenu && moreBtn && !radarMenu.contains(e.target) && !moreBtn.contains(e.target)) {
            radarMenu.style.display = 'none';
        }
    });

    function showToast(message) {
        const toast = document.createElement('div');
        toast.style.position = 'fixed';
        toast.style.bottom = '24px';
        toast.style.right = '24px';
        toast.style.background = '#0B131B';
        toast.style.color = '#CCFF00';
        toast.style.border = '1px solid #10B981';
        toast.style.padding = '12px 20px';
        toast.style.borderRadius = '12px';
        toast.style.fontSize = '12.5px';
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
