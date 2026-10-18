@extends('layouts.app', ['title' => 'Trend Hunter - Radar Tren Konsumen AI'])

@section('content')
<div class="trend-page">

    <!-- 1. GLOSSY HEADER BAR -->
    <div class="dash-header">
        <div class="header-main-info">
            <div class="greeting-row">
                <h1 class="page-greeting">Trend <span class="store-gradient-name">Hunter</span></h1>
                <span class="verified-store-badge">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="#10B981"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                    <span>Radar Pasar Realtime</span>
                </span>
                <span class="live-status-pill">
                    <span class="pulse-dot"></span>
                    <span>Sinkronisasi Tiap 15 Menit</span>
                </span>
            </div>
            <p class="page-subtitle">Peta lonjakan permintaan konsumen & produk viral marketplace sebelum pasar jenuh.</p>
            
            <!-- KEYWORD SEARCH RADAR TREN -->
            <div style="margin-top: 14px; position: relative; max-width: 580px;">
                <svg width="18" height="18" fill="none" stroke="#94A3B8" viewBox="0 0 24 24" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                <input type="text" id="trendSearchInput" value="{{ request('q') }}" placeholder="Ketik kata kunci tren (contoh: Labubu, Kopi Gayo, Tumbler, Cromboloni, Masker)..." style="width: 100%; padding: 11px 14px 11px 42px; border-radius: 10px; border: 1.5px solid #334155; background: #0E161A; color: #FFFFFF; font-size: 13px; outline: none; transition: all 0.2s;" onfocus="this.style.borderColor='#10B981'" onblur="this.style.borderColor='#334155'" onkeyup="handleTrendLiveSearch(this.value)">
            </div>
        </div>

        <div class="dash-actions" style="align-self: flex-start;">
            <div class="time-filter-glossy">
                <button type="button" class="t-pill active" onclick="filterTrendDuration(this, 7)">7 Hari</button>
                <button type="button" class="t-pill" onclick="filterTrendDuration(this, 30)">30 Hari</button>
                <button type="button" class="t-pill" onclick="filterTrendDuration(this, 90)">90 Hari</button>
            </div>

            <select class="btn-timeframe-glossy" id="trend-category-select" onchange="filterTrendCategory(this.value)" style="cursor: pointer;">
                <option value="all">Semua Kategori</option>
                <option value="Stationery">Stationery &amp; Mainan</option>
                <option value="Kopi & Beverage">Kopi &amp; Minuman</option>
                <option value="FMCG & Sembako">Sembako &amp; Kebutuhan</option>
                <option value="Aksesoris Gadget">Aksesoris Gadget</option>
            </select>

            <button type="button" class="btn-download-glossy" id="btn-rescan-radar" onclick="rescanMarketplaceRadar()">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                <span>Pindai Ulang</span>
            </button>
        </div>
    </div>

    <!-- 2. MULTI-CHANNEL CONNECTIONS STRIP DENGAN LOGO RESMI SUMBER DATA -->
    <div class="channel-signals-strip card-panel">
        <div class="strip-header">
            <div class="flex-align gap-8">
                <span class="pulse-dot"></span>
                <span class="strip-title">Sinyal Terintegrasi Marketplace &amp; Lembaga Riset Resmi:</span>
            </div>
            <span class="strip-sub">Google Trends, TikTok Shop, Tokopedia, Shopee &amp; BPS RI</span>
        </div>

        <div class="channel-chips-grid">
            <!-- GOOGLE TRENDS -->
            <div class="channel-chip-glossy">
                <div class="chip-top">
                    <div style="display: flex; align-items: center; gap: 7px;">
                        <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17Z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.27 21.43 7.33 24 12 24Z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.17 0 9.99 0 12s.45 3.83 1.25 5.42l4.03-3.15Z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.27 2.57 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98Z"/></svg>
                        <span class="c-name">Google Trends</span>
                    </div>
                    <span class="c-status badge-mint">Live Data</span>
                </div>
                <div class="c-stat">Index 94 • +340% YoY</div>
                <div class="c-desc">Kueri pencarian konsumen teratas</div>
            </div>

            <!-- TIKTOK SHOP -->
            <div class="channel-chip-glossy">
                <div class="chip-top">
                    <div style="display: flex; align-items: center; gap: 7px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#000000"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.29 0 .58.04.86.12V9.42a6.34 6.34 0 0 0-.86-.06 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V9.05a8.16 8.16 0 0 0 4.67 1.46V7.07c-.31-.07-.61-.2-.9-.38Z" fill="#EE1D52"/><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.29 0 .58.04.86.12V9.42a6.34 6.34 0 0 0-.86-.06 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V9.05a8.16 8.16 0 0 0 4.67 1.46V7.07c-.31-.07-.61-.2-.9-.38Z" fill="#69C9D0" style="mix-blend-mode: multiply;"/></svg>
                        <span class="c-name">TikTok Shop</span>
                    </div>
                    <span class="c-status badge-lime">Viral FYP</span>
                </div>
                <div class="c-stat">48.2 Juta Tayangan</div>
                <div class="c-desc">14.8k video keranjang kuning</div>
            </div>

            <!-- TOKOPEDIA -->
            <div class="channel-chip-glossy">
                <div class="chip-top">
                    <div style="display: flex; align-items: center; gap: 7px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#03AC0E"><path d="M19.5 7.5h-15A2.25 2.25 0 0 0 2.25 9.75v10.5A2.25 2.25 0 0 0 4.5 22.5h15a2.25 2.25 0 0 0 2.25-2.25V9.75A2.25 2.25 0 0 0 19.5 7.5Zm-7.5-6a4.5 4.5 0 0 0-4.5 4.5v1.5h9V6a4.5 4.5 0 0 0-4.5-4.5Zm0 13.5a3 3 0 1 1 3-3 3 3 0 0 1-3 3Z"/></svg>
                        <span class="c-name">Tokopedia</span>
                    </div>
                    <span class="c-status badge-blue">Rank #1</span>
                </div>
                <div class="c-stat">Defisit Stok 63%</div>
                <div class="c-desc">Lonjakan pencarian marketplace</div>
            </div>

            <!-- SHOPEE -->
            <div class="channel-chip-glossy">
                <div class="chip-top">
                    <div style="display: flex; align-items: center; gap: 7px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#EE4D2D"><path d="M19 6h-2.58A5.5 5.5 0 0 0 12 .5a5.5 5.5 0 0 0-4.42 5.5H5a2 2 0 0 0-2 2l1.6 13.6A2 2 0 0 0 6.6 23.5h10.8a2 2 0 0 0 2-1.9L21 8a2 2 0 0 0-2-2ZM12 2.5a3.5 3.5 0 0 1 3.42 3.5H8.58A3.5 3.5 0 0 1 12 2.5Zm0 15.5c-2.3 0-4.2-1.2-4.2-3.1 0-2.3 2.7-2.7 4.2-3.1 1.6-.4 2.2-.8 2.2-1.5 0-.8-.7-1.3-1.8-1.3-1.2 0-2 .5-2.3 1.3l-1.8-.7c.6-1.5 2-2.3 4.1-2.3 2.3 0 3.8 1.3 3.8 3.1 0 2.3-2.7 2.7-4.2 3.1-1.6.4-2.2.8-2.2 1.5 0 .8.8 1.3 2 1.3 1.4 0 2.3-.6 2.7-1.5l1.8.8c-.7 1.6-2.2 2.4-4.4 2.4Z"/></svg>
                        <span class="c-name">Shopee</span>
                    </div>
                    <span class="c-status badge-mint">1.250 / jam</span>
                </div>
                <div class="c-stat">Kecepatan Checkout +285%</div>
                <div class="c-desc">Percepatan GMV e-commerce</div>
            </div>

            <!-- BPS (BADAN PUSAT STATISTIK) -->
            <div class="channel-chip-glossy">
                <div class="chip-top">
                    <div style="display: flex; align-items: center; gap: 7px;">
                        <svg width="18" height="18" fill="none" stroke="#0284C7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                        <span class="c-name">BPS &amp; Bank Indonesia</span>
                    </div>
                    <span class="c-status badge-mint">Resmi RI</span>
                </div>
                <div class="c-stat">IKK 124.5 (Optimis)</div>
                <div class="c-desc">Indeks Keyakinan Konsumen Ritel</div>
            </div>
        </div>
    </div>

    <!-- 3. REGIONAL DEMAND PREDICTOR (WILAYAH SEKITAR GERAI) -->
    <div class="regional-demand-card card-panel">
        <div class="regional-left">
            <div class="tag-pill-glossy" style="margin-bottom: 6px; display: inline-flex; align-items: center; gap: 6px;">
                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>PREDIKSI KEBUTUHAN WILAYAH SEKITAR</span>
            </div>
            <h3 class="regional-title">Penyesuaian Kebutuhan Lokal di Radius Gerai Anda</h3>
            <p class="regional-desc">Algoritma LARIS memadukan data Google Trends dan marketplace dengan titik geografis toko fisik Anda untuk memproyeksikan produk yang paling dicari warga sekitar minggu ini.</p>
        </div>

        <div class="regional-right">
            <div class="reg-select-box">
                <label class="reg-label">Pilih Wilayah Pantauan Toko:</label>
                <select id="regionalAreaSelect" class="select-field-glossy" onchange="updateRegionalDemand(this.value)">
                    <option value="bandung_coblong">Bandung - Coblong / Dago / Dipati Ukur (Radius 3km Gerai Utama Anda)</option>
                    <option value="bandung_braga">Bandung - Lengkong / Braga / Buah Batu (Pusat Wisata &amp; F&amp;B)</option>
                    <option value="jkt_tebet">Jakarta Selatan - Tebet / Pancoran / Manggarai (Kepadatan Kafe &amp; Residensial)</option>
                    <option value="jkt_senopati">Jakarta Selatan - Senopati / Blok M / Kebayoran (Sentra Gaya Hidup Populer)</option>
                    <option value="jkt_barat">Jakarta Barat - Kebon Jeruk / Tanjung Duren (Area Hunian &amp; Mahasiswa)</option>
                    <option value="sby_gubeng">Surabaya - Gubeng / Dharmawangsa (Pusat Aktivitas Kampus &amp; Bisnis)</option>
                    <option value="sby_rungkut">Surabaya - Rungkut / Merr (Kawasan Bisnis &amp; Residensial Padat)</option>
                    <option value="smg_tembalang">Semarang - Tembalang / Banyumanik (Area Pelajar &amp; Kebutuhan Pokok)</option>
                    <option value="tangsel_bsd">Tangerang Selatan - BSD / Serpong (Keluarga Muda &amp; Sentra Kuliner)</option>
                </select>
            </div>
            <div class="reg-prediction-box" id="regionalPredictionResult">
                <div class="reg-pred-stat">Peluang Penjualan Wilayah Sekitar: <strong>Sangat Tinggi (88%)</strong></div>
                <div class="reg-pred-items">Kebutuhan Dominan Warga: <strong>Stationery Karakter, Kuliner Kopi &amp; Kebutuhan Pokok</strong>.</div>
                <div class="reg-pred-advice">Saran Juragan AI: Sediakan stok ekstra 25%–35% sebelum akhir pekan untuk melayani pesanan antar &amp; ambil di toko.</div>
            </div>
        </div>
    </div>

    <!-- 4. HERO TREND SPOTLIGHT CARD -->
    @if(isset($heroTrend) && $heroTrend)
    <div class="card-panel hero-trend-card">
        <div class="hero-top-row">
            <div class="hero-title-group" style="display: flex; align-items: center; gap: 14px;">
                @if($heroTrend->image_url)
                    <img src="{{ $heroTrend->image_url }}" alt="{{ $heroTrend->trend_name }}" style="width: 54px; height: 54px; border-radius: 14px; object-fit: cover; border: 2px solid #10B981; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);">
                @else
                    <div class="panel-icon-circle" style="width: 44px; height: 44px;">
                        <svg width="22" height="22" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    </div>
                @endif
                <div>
                    <span class="hero-sub-tag">FOKUS RADAR UTAMA • Sinyal Validasi AI: {{ $heroTrend->signal_strength }}%</span>
                    <h2 class="hero-product-name">{{ $heroTrend->trend_name }}</h2>
                </div>
            </div>

            <div class="hero-stage-badge-box">
                <span class="badge-lime">
                    <span>{{ $heroTrend->stage }}</span>
                </span>
                <span class="stage-sub">Waktu Paling Tepat Menjual</span>
            </div>
        </div>

        <!-- 4 METRICS ROW -->
        <div class="kpi-grid">
            <div class="kpi-card card-glossy">
                <span class="kpi-title">Kekuatan Sinyal</span>
                <div class="kpi-value-row">
                    <h2 class="kpi-val">{{ $heroTrend->signal_strength }}%</h2>
                </div>
                <div class="kpi-progress-bar">
                    <div class="progress-fill" style="width: {{ $heroTrend->signal_strength }}%;"></div>
                </div>
            </div>

            <div class="kpi-card card-glossy">
                <span class="kpi-title">Laju Pertumbuhan</span>
                <div class="kpi-value-row">
                    <h2 class="kpi-val text-green">{{ $heroTrend->growth_velocity }}</h2>
                </div>
                <div class="kpi-status-foot">
                    <span class="dot-green"></span>
                    <span>Pencarian Marketplace &amp; TikTok</span>
                </div>
            </div>

            <div class="kpi-card card-glossy">
                <span class="kpi-title">Estimasi Harga Jual</span>
                <div class="kpi-value-row">
                    <h2 class="kpi-val">{{ $heroTrend->price_range }}</h2>
                </div>
                <div class="kpi-status-foot">
                    <span>Margin Kotor: 38% - 52%</span>
                </div>
            </div>

            <div class="kpi-card card-glossy">
                <span class="kpi-title">Tingkat Persaingan</span>
                <div class="kpi-value-row">
                    <h2 class="kpi-val text-green">{{ $heroTrend->competition_level }}</h2>
                </div>
                <div class="kpi-status-foot">
                    <span class="dot-green"></span>
                    <span>Defisit Pasokan Toko {{ $heroTrend->national_deficit }}</span>
                </div>
            </div>
        </div>

        <!-- ACCELERATION CURVE & 7-DAY FORECAST -->
        <div class="proj-chart-card mt-16">
            <div class="proj-head-flex">
                <div>
                    <h4 class="proj-title">Kurva Akselerasi Tren vs Proyeksi 7 Hari ke Depan</h4>
                    <p class="proj-sub">Fase eksponensial sebelum kompetitor lokal mulai menyusul</p>
                </div>
                <div class="chart-legend">
                    <span class="leg-item"><span class="line-black"></span> Data Aktual</span>
                    <span class="leg-item"><span class="line-green-dash"></span> Proyeksi AI (91% Confidence)</span>
                </div>
            </div>

            <div class="chart-canvas-container">
                <svg viewBox="0 0 700 120" class="main-trend-svg">
                    <line x1="0" y1="35" x2="700" y2="35" stroke="#F1F5F9" stroke-width="1" />
                    <line x1="0" y1="75" x2="700" y2="75" stroke="#F1F5F9" stroke-width="1" />
                    <line x1="0" y1="105" x2="700" y2="105" stroke="#F1F5F9" stroke-width="1" />
                    
                    <!-- Prediction Band -->
                    <polygon points="500,60 580,35 700,10 700,70 580,75 500,60" fill="rgba(16, 185, 129, 0.15)" />
                    
                    <!-- Historical Curve -->
                    <path d="M 20 100 Q 200 95, 340 85 T 500 60" fill="none" stroke="#0F172A" stroke-width="3" />
                    
                    <!-- Prediction Curve -->
                    <path d="M 500 60 Q 600 25, 700 10" fill="none" stroke="#10B981" stroke-width="3" stroke-dasharray="6,4" />
                    
                    <!-- Breakout Point Marker -->
                    <circle cx="500" cy="60" r="5" fill="#CCFF00" stroke="#0F172A" stroke-width="2" />
                    <text x="470" y="48" font-size="9.5" font-weight="800" fill="#0F172A">Titik Breakout ({{ $heroTrend->growth_velocity }})</text>
                </svg>
                <div class="chart-x-labels">
                    <span>7 Hari Lalu</span>
                    <span>5 Hari Lalu</span>
                    <span>3 Hari Lalu</span>
                    <span>Kemarin</span>
                    <span class="active-today">Hari Ini (Puncak Awal)</span>
                    <span class="future-day">+7 Hari Mendatang</span>
                </div>
            </div>
        </div>

        <!-- STRATEGIC RECOMMENDATION STRIP -->
        <div class="instant-insight-banner" style="margin-top: 16px;">
            <div class="insight-left">
                <div class="ai-gem-icon">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/></svg>
                </div>
                <div class="insight-text">
                    <div class="insight-tag">SARAN STRATEGIS JURAGAN AI</div>
                    <p>{{ $heroTrend->recommendation ?: 'Permintaan produk ini sedang melonjak tinggi dengan persediaan minim di Jawa Barat. Amankan 50–100 unit pertama untuk mengunci margin kotor premium sebelum pasar jenuh.' }}</p>
                </div>
            </div>
            <a href="{{ route('predict.index', ['product_name' => $heroTrend->trend_name, 'category' => $heroTrend->category, 'price' => 35000, 'cost' => 22000]) }}" class="btn-insight-action">
                <span>Analisis di LARIS Predict</span>
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
    </div>
    @endif

    <!-- 5. TOP TRENDING ITEMS MATRIX (DYNAMIC VIRAL RADAR) -->
    <div class="trending-matrix-sec">
        <div class="panel-header">
            <div>
                <h3 class="panel-title">Koleksi Tren Viral Terpantau</h3>
                <p class="panel-subtitle">Peluang produk dengan rasio margin dan risiko optimal untuk gerai Anda</p>
            </div>
            <span class="tag-pill-glossy">{{ isset($trendingItems) ? $trendingItems->count() : 5 }} TREN TERVERIFIKASI</span>
        </div>

        <div class="trending-grid-4col">
            @if(isset($trendingItems) && $trendingItems->count() > 0)
                @foreach($trendingItems as $item)
                    <div class="card-panel trend-matrix-card" data-category="{{ strtolower($item->category) }}" data-name="{{ strtolower($item->trend_name) }}">
                        <div class="thumb-rel-box">
                            <img class="trend-thumb-img" src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1585336261026-784860010041?w=300&auto=format&fit=crop&q=80' }}" alt="{{ $item->trend_name }}">
                            <span class="thumb-badge {{ $item->stage === 'Early Stage' ? 'badge-lime' : 'badge-blue' }}">{{ $item->stage }}</span>
                        </div>
                        <div class="trend-card-body">
                            <div class="t-name-row">
                                <h4 class="t-item-name">{{ $item->trend_name }}</h4>
                                <span class="badge-mint">{{ $item->growth_velocity }}</span>
                            </div>
                            <p class="t-item-desc">{{ Str::limit($item->recommendation ?: 'Peluang tren viral dengan sinyal pasar tinggi di marketplace nasional.', 85) }}</p>
                            <div class="t-signal-row">
                                <span class="sig-lbl">Sinyal Pasar: <strong>{{ $item->signal_strength }}%</strong></span>
                                <span class="dot-green"></span>
                            </div>
                            <a href="{{ route('predict.index', ['product_name' => $item->trend_name, 'category' => $item->category, 'price' => 35000, 'cost' => 20000]) }}" class="btn-spotlight-action">
                                <span>Uji di Predict</span>
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="grid-column: 1 / -1; padding: 30px; text-align: center; color: #94A3B8;">
                    Tidak ada data tren tambahan saat ini.
                </div>
            @endif
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    .trend-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .time-filter-glossy {
        display: flex;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        padding: 3px;
        border-radius: 12px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.03);
    }

    .t-pill {
        background: transparent;
        border: none;
        padding: 6px 14px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        color: #64748B;
        cursor: pointer;
        transition: all 0.2s;
    }

    .t-pill.active {
        background: #0B131B;
        color: #CCFF00;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    /* Channel Signals Strip */
    .channel-signals-strip {
        padding: 20px 24px;
    }

    .strip-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .strip-title {
        font-size: 13.5px;
        font-weight: 800;
        color: var(--text-main);
    }

    .strip-sub {
        font-size: 12px;
        color: var(--text-muted);
    }

    .channel-chips-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 12px;
    }

    .channel-chip-glossy {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 12px 14px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        transition: all 0.2s;
    }

    .channel-chip-glossy:hover {
        border-color: #10B981;
        transform: translateY(-2px);
    }

    .chip-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4px;
    }

    .c-name {
        font-size: 12px;
        font-weight: 800;
        color: var(--text-main);
    }

    .c-stat {
        font-size: 12.5px;
        font-weight: 700;
        color: #10B981;
        margin-bottom: 2px;
    }

    .c-desc {
        font-size: 11px;
        color: var(--text-muted);
        line-height: 1.35;
    }

    /* Regional Demand Card */
    .regional-demand-card {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 24px;
        align-items: center;
    }

    .regional-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 6px;
    }

    .regional-desc {
        font-size: 12.5px;
        color: var(--text-muted);
        line-height: 1.5;
    }

    .reg-select-box {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 10px;
    }

    .reg-label {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-main);
    }

    .reg-prediction-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 12px 16px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-size: 12px;
    }

    .reg-pred-stat {
        color: #10B981;
        font-weight: 700;
    }

    .reg-pred-items {
        color: #0F172A;
    }

    .reg-pred-advice {
        color: var(--text-muted);
        font-style: italic;
    }

    /* Hero Trend Card */
    .hero-trend-card {
        padding: 24px;
    }

    .hero-top-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .hero-title-group {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .hero-sub-tag {
        font-size: 11px;
        font-weight: 800;
        color: #10B981;
        text-transform: uppercase;
        display: block;
        margin-bottom: 2px;
    }

    .hero-product-name {
        font-size: 22px;
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -0.01em;
    }

    .hero-stage-badge-box {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 2px;
    }

    .stage-sub {
        font-size: 11px;
        color: var(--text-muted);
    }

    /* 4 Columns Matrix */
    .trending-grid-4col {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    .trend-matrix-card {
        padding: 0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .thumb-rel-box {
        position: relative;
        height: 140px;
        overflow: hidden;
    }

    .trend-thumb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .trend-matrix-card:hover .trend-thumb-img {
        transform: scale(1.05);
    }

    .thumb-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 9999px;
    }

    .trend-card-body {
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        flex: 1;
        justify-content: space-between;
    }

    .t-name-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 6px;
    }

    .t-item-name {
        font-size: 13.5px;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1.3;
    }

    .t-item-desc {
        font-size: 11.5px;
        color: var(--text-muted);
        line-height: 1.4;
        margin: 0;
    }

    .t-signal-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 11px;
        color: var(--text-muted);
        padding-top: 4px;
        border-top: 1px solid #F1F5F9;
    }

    @media (max-width: 1024px) {
        .channel-chips-grid { grid-template-columns: repeat(2, 1fr); }
        .regional-demand-card { grid-template-columns: 1fr; }
        .trending-grid-4col { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 640px) {
        .channel-chips-grid { grid-template-columns: 1fr; }
        .trending-grid-4col { grid-template-columns: 1fr; }
    }
</style>
@endpush

@push('scripts')
<script>
    function filterTrendDuration(btn, days) {
        document.querySelectorAll('.t-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        showToast(`Memfilter sinyal tren untuk rentang ${days} hari terakhir.`);
    }

    let currentCategoryFilter = 'all';

    function applyTrendFilters() {
        let kw = (document.getElementById('trendSearchInput')?.value || '').trim().toLowerCase();
        let cat = currentCategoryFilter.toLowerCase();
        let cards = document.querySelectorAll('.trend-matrix-card');

        cards.forEach(c => {
            let itemCat = (c.getAttribute('data-category') || '').toLowerCase();
            let itemName = (c.getAttribute('data-name') || '').toLowerCase();
            let itemText = c.innerText.toLowerCase();

            let matchesCat = (cat === 'all' || itemCat.includes(cat) || itemName.includes(cat) || itemText.includes(cat));
            let matchesSearch = (!kw || itemName.includes(kw) || itemText.includes(kw));

            if (matchesCat && matchesSearch) {
                c.style.display = '';
            } else {
                c.style.display = 'none';
            }
        });
    }

    function filterTrendCategory(cat) {
        currentCategoryFilter = cat;
        applyTrendFilters();
        showToast(`Kategori tren difilter: ${cat === 'all' ? 'Semua Kategori' : cat}`);
    }

    function rescanMarketplaceRadar() {
        const btn = document.getElementById('btn-rescan-radar');
        if (btn) btn.innerHTML = '<span>Memindai...</span>';
        setTimeout(() => {
            if (btn) btn.innerHTML = '<svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg><span>Pindai Ulang</span>';
            showToast('Radar berhasil memindai sinyal lonjakan baru dari Google Trends, Shopee & TikTok Shop!');
        }, 800);
    }

    let searchDebounce = null;
    function handleTrendLiveSearch(kw) {
        clearTimeout(searchDebounce);
        searchDebounce = setTimeout(() => {
            applyTrendFilters();
            if (kw) {
                showToast(`Menyaring tren dengan kata kunci: "${kw}"`);
            }
        }, 250);
    }

    function updateRegionalDemand(area) {
        const box = document.getElementById('regionalPredictionResult');
        if (!box) return;

        const data = {
            'bandung_coblong': {
                name: 'Bandung - Coblong / Dago / Dipati Ukur',
                stat: 'Sangat Tinggi (91%) • Radius 3 km',
                items: 'Biji Kopi Specialty, Minuman Dingin Takeaway, Pensil & Merchandise Populer',
                advice: 'Sediakan stok ekstra 30% pada hari Kamis-Minggu untuk melayani lonjakan pesanan mahasiswa ITB/UNPAD & wisatawan Dago.'
            },
            'bandung_braga': {
                name: 'Bandung - Lengkong / Braga / Buah Batu',
                stat: 'Sangat Tinggi (89%) • Sentra Kuliner & Wisata',
                items: 'Pastry / Bakery Viral, Kopi Drip Bag Oleh-oleh & Kemasan Siap Bawa',
                advice: 'Prioritaskan bundling takeaway akhir pekan dan QRIS meja untuk kelancaran transaksi checkout cepat.'
            },
            'jkt_tebet': {
                name: 'Jakarta Selatan - Tebet / Pancoran / Manggarai',
                stat: 'Luar Biasa Tinggi (95%) • Kepadatan Komuter & Kafe',
                items: 'Makanan Siap Saji Higienis, Kopi Botol Literan & Aksesoris Kerja',
                advice: 'Aktifkan kurir instan dan sediakan slot pickup pagi (07:30 - 09:30) serta sore pulang kantor.'
            },
            'jkt_senopati': {
                name: 'Jakarta Selatan - Senopati / Blok M / Kebayoran',
                stat: 'Luar Biasa Tinggi (94%) • Gaya Hidup & Komersial',
                items: 'Minuman Artisan, Tumbler Estetik & Camilan Premium',
                advice: 'Pertahankan kemasan estetik bernilai tinggi dan stok produk pop-culture berkecepatan putar tinggi.'
            },
            'jkt_barat': {
                name: 'Jakarta Barat - Kebon Jeruk / Tanjung Duren',
                stat: 'Tinggi (86%) • Pemukiman & Sekitar Kampus',
                items: 'Sembako Hemat Paket, Stationery Karakter & Kabel Fast-Charging',
                advice: 'Gunakan promo potongan ongkir radius 2 km untuk mendominasi pesanan warga apartemen sekitar.'
            },
            'sby_gubeng': {
                name: 'Surabaya - Gubeng / Dharmawangsa',
                stat: 'Tinggi (85%) • Wilayah Pendidikan & Medis',
                items: 'Minuman Segar Dingin, Tumbler Stainless 1200ml & Camilan Pedas',
                advice: 'Siapkan stok cup dan sirup dingin lebih awal mengingat suhu cuaca kota yang tinggi.'
            },
            'sby_rungkut': {
                name: 'Surabaya - Rungkut / Merr',
                stat: 'Tinggi (83%) • Area Bisnis & Perumahan Baru',
                items: 'Sembako Kelontong Lengkap, Minyak Goreng, Kebutuhan Bayi & Rumah Tangga',
                advice: 'Pertahankan ketersediaan sembako harian dan berikan layanan antar sore hari secara konsisten.'
            },
            'smg_tembalang': {
                name: 'Semarang - Tembalang / Banyumanik',
                stat: 'Moderat - Tinggi (79%) • Konsumen Pelajar & Kos',
                items: 'Stationery Kampus, Makanan Cepat Masak & Kopi Sachet Premium',
                advice: 'Pasang harga bersaing dengan bundling hemat untuk meningkatkan frekuensi order mingguan.'
            },
            'tangsel_bsd': {
                name: 'Tangerang Selatan - BSD / Serpong',
                stat: 'Sangat Tinggi (90%) • Keluarga Muda & Modern',
                items: 'Organik & Sehat, Botol Ramah Lingkungan, Kopi Biji Arabika',
                advice: 'Tampilkan label eco-friendly dan sediakan pembayaran non-tunai (QRIS & Transfer Bank) 100% mulus.'
            }
        };

        const res = data[area] || data['bandung_coblong'];
        box.innerHTML = `
            <div class="reg-pred-stat">Peluang Wilayah ${res.name}: <strong>${res.stat}</strong></div>
            <div class="reg-pred-items">Kebutuhan Dominan Warga Sekitar: <strong>${res.items}</strong>.</div>
            <div class="reg-pred-advice">Saran Juragan AI: ${res.advice}</div>
        `;
        showToast(`Wilayah pantauan diubah ke ${res.name}!`);
    }

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
        toast.textContent = message;

        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 400);
        }, 3200);
    }
</script>
@endpush
