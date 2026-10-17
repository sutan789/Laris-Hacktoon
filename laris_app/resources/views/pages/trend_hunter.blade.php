@extends('layouts.app', ['title' => 'Trend Hunter - Radar Tren Konsumen AI'])

@section('content')
<div class="trend-page">

    <!-- PAGE HEADER -->
    <div class="trend-head-bar">
        <div>
            <div class="flex-align gap-8">
                <h1 class="t-main-title">TREND HUNTER</h1>
                <span class="badge-live-radar">● Real-time AI Market Radar</span>
            </div>
            <p class="t-sub-desc">Memetakan pola lonjakan permintaan konsumen & tren viral sebelum pasar jenuh.</p>
        </div>

        <div class="trend-controls-row">
            <div class="time-filter-pills">
                <button type="button" class="pill-btn active" onclick="filterTrendDuration(this, 7)">Last 7 Days</button>
                <button type="button" class="pill-btn" onclick="filterTrendDuration(this, 30)">30 Days</button>
                <button type="button" class="pill-btn" onclick="filterTrendDuration(this, 90)">90 Days</button>
            </div>
            <select class="category-select-pill" id="trend-category-select" onchange="filterTrendCategory(this.value)">
                <option value="all">Semua Kategori Tren</option>
                <option value="Stationery">Kategori: Stationery</option>
                <option value="Kopi & Beverage">Kategori: Kopi &amp; Beverage</option>
                <option value="FMCG & Sembako">Kategori: FMCG &amp; Sembako</option>
                <option value="Aksesoris Gadget">Kategori: Aksesoris Gadget</option>
            </select>
            <button type="button" class="btn-dark" id="btn-rescan-radar" onclick="rescanMarketplaceRadar()">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                <span>Pindai Ulang</span>
            </button>
        </div>
    </div>

    <!-- HERO TREND CARD (FOKUS RADAR UTAMA) -->
    <div class="card-panel hero-trend-card">
        
        <div class="hero-top-row">
            <div class="hero-title-group">
                <div class="radar-ping-icon">@</div>
                <div>
                    <span class="hero-sub-tag">FOKUS RADAR UTAMA • Akurasi AI: 94.2%</span>
                    <h2 class="hero-product-name">Labubu Stationery & Merchandise</h2>
                </div>
            </div>

            <div class="hero-stage-badge-box">
                <span class="badge-stage-lime">⚡ EARLY STAGE</span>
                <span class="stage-sub">Optimal Seller Entry Point</span>
            </div>
        </div>

        <!-- 4 METRICS ROW -->
        <div class="hero-metrics-grid">
            <!-- METRIC 1 -->
            <div class="hero-m-card">
                <span class="m-lbl">SIGNAL STRENGTH</span>
                <div class="m-val-row">
                    <span class="m-num">82%</span>
                    <span class="m-tag-ultra">↑ Ultra High</span>
                </div>
                <div class="strength-bar"><div class="s-fill" style="width: 82%;"></div></div>
            </div>

            <!-- METRIC 2 -->
            <div class="hero-m-card">
                <span class="m-lbl">GROWTH VELOCITY</span>
                <h3 class="m-big-green">+284%</h3>
                <span class="m-sub-text">WoW Search Volume di marketplace & TikTok</span>
            </div>

            <!-- METRIC 3 -->
            <div class="hero-m-card">
                <span class="m-lbl">AVG. SELLING PRICE</span>
                <h3 class="m-num">Rp 15k - 45k</h3>
                <span class="m-sub-text">Estimasi margin kotor: 42% - 58%</span>
            </div>

            <!-- METRIC 4 -->
            <div class="hero-m-card">
                <span class="m-lbl">TINGKAT PERSAINGAN</span>
                <h3 class="m-num text-green">Rendah</h3>
                <span class="m-sub-deficit">● Defisit Stok Nasional 63%</span>
            </div>
        </div>

        <!-- ACCELERATION CURVE & 7-DAY FORECAST -->
        <div class="accel-chart-box">
            <div class="accel-head">
                <h4>Kurva Akselerasi Tren vs Prediksi 7 Hari Kedepan</h4>
                <div class="accel-legend">
                    <span class="leg-pill">HISTORICAL + AI FORECAST</span>
                    <span><span class="bar-black"></span> Data Aktual</span>
                    <span><span class="bar-green"></span> Prediksi AI (Confidence 91%)</span>
                </div>
            </div>

            <div class="accel-svg-wrapper">
                <svg viewBox="0 0 700 130" class="accel-svg">
                    <line x1="0" y1="40" x2="700" y2="40" stroke="#F1F5F9" stroke-width="1" />
                    <line x1="0" y1="80" x2="700" y2="80" stroke="#F1F5F9" stroke-width="1" />
                    
                    <!-- Prediction area -->
                    <polygon points="500,60 580,35 700,10 700,70 580,75 500,60" fill="rgba(204, 255, 0, 0.2)" />
                    
                    <!-- Historical Curve -->
                    <path d="M 20 100 Q 200 95, 340 85 T 500 60" fill="none" stroke="#0F172A" stroke-width="3" />
                    
                    <!-- Prediction Curve -->
                    <path d="M 500 60 Q 600 25, 700 10" fill="none" stroke="#16A34A" stroke-width="3" stroke-dasharray="6,4" />
                    
                    <!-- Breakthrough Point Badge -->
                    <circle cx="500" cy="60" r="5" fill="#CCFF00" stroke="#0F172A" stroke-width="2" />
                    <rect x="475" y="24" width="110" height="22" rx="4" fill="#0B1215" />
                    <text x="482" y="38" font-size="9" font-weight="700" fill="#CCFF00">POINT BREAKOUT (+284%)</text>
                </svg>
                <div class="accel-x-axis">
                    <span>7 Hari Lalu</span>
                    <span>5 Hari Lalu</span>
                    <span>3 Hari Lalu</span>
                    <span>Kemarin</span>
                    <span class="fw-bold">Hari Ini (Puncak Awal)</span>
                    <span class="text-green fw-bold">(Prediksi +7 Hari)</span>
                </div>
            </div>
        </div>

        <!-- STRATEGIC RECOMMENDATION STRIP -->
        <div class="strategic-rec-banner">
            <div class="rec-left">
                <div class="rec-ai-box">🤖</div>
                <div>
                    <div class="flex-align gap-8">
                        <span class="rec-tag">LARIS STRATEGIC RECOMMENDATION</span>
                        <span class="tag-fast">Tindakan Cepat</span>
                    </div>
                    <p class="rec-text">Permintaan Labubu Stationery berada pada fase eksponensial awal dengan defisit stok distributor di area Jabodetabek & Surabaya. Amankan stok 50–100 unit pertama minggu ini untuk mengunci margin kotor premium (~52%) sebelum perang harga pasar umum terjadi dalam 14–20 hari.</p>
                </div>
            </div>
            <a href="{{ url('/smart-inventory') }}" class="btn-lime">
                <span>Eksekusi Restock</span>
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>

    </div>

    <!-- TOP TRENDING ITEMS MATRIX (4 COLUMNS) -->
    <div class="trending-matrix-sec">
        <div class="matrix-head">
            <div>
                <h3 class="sec-title">Top Trending Items Matrix</h3>
                <p class="sub-muted">Peluang produk terverifikasi dengan rasio margin dan risiko optimal untuk UMKM</p>
            </div>
            <a href="#all" class="link-all">Lihat 48 Trend Lengkap &rarr;</a>
        </div>

        <div class="trending-grid-4col">
            <!-- ITEM 1 -->
            <div class="card-panel trend-matrix-card">
                <div class="thumb-rel-box">
                    <img class="trend-thumb-img" src="https://images.unsplash.com/photo-1585336261026-784860010041?w=300&auto=format&fit=crop&q=80" alt="Labubu Pencil">
                    <span class="thumb-badge badge-lime-sm">Early Stage</span>
                </div>
                <div class="trend-card-body">
                    <div class="t-name-row">
                        <h4 class="t-item-name">Labubu Pencil Case</h4>
                        <span class="badge-high-pill">High</span>
                    </div>
                    <p class="t-item-desc">Pencil case, binder motif, gantungan plushie labubu yang...</p>
                    <div class="t-signal-row">
                        <div class="sig-val">SIGNAL <strong>82%</strong></div>
                        <div class="mini-spark-line green"></div>
                    </div>
                    <a href="{{ route('predict.index', ['product_name' => 'Labubu Pencil Case', 'category' => 'Stationery & Toys', 'cost_price' => 12000, 'selling_price' => 28000]) }}" class="btn-lime w-full text-center">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/></svg>
                        <span>Simulate in Predict</span>
                    </a>
                </div>
            </div>

            <!-- ITEM 2 -->
            <div class="card-panel trend-matrix-card">
                <div class="thumb-rel-box">
                    <img class="trend-thumb-img" src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&auto=format&fit=crop&q=80" alt="Botanical Journal">
                    <span class="thumb-badge badge-amber-sm">Growth Stage</span>
                </div>
                <div class="trend-card-body">
                    <div class="t-name-row">
                        <h4 class="t-item-name">Vintage Journal</h4>
                        <span class="badge-med-pill">Med</span>
                    </div>
                    <p class="t-item-desc">Buku jurnal hard cover bertema flora retro untuk segmen...</p>
                    <div class="t-signal-row">
                        <div class="sig-val">SIGNAL <strong>76%</strong></div>
                        <div class="mini-spark-line green"></div>
                    </div>
                    <a href="{{ route('predict.index', ['product_name' => 'Vintage Botanical Journal', 'category' => 'Stationery & Toys', 'cost_price' => 15000, 'selling_price' => 35000]) }}" class="btn-outline w-full text-center">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/></svg>
                        <span>Simulate in Predict</span>
                    </a>
                </div>
            </div>

            <!-- ITEM 3 -->
            <div class="card-panel trend-matrix-card">
                <div class="thumb-rel-box">
                    <img class="trend-thumb-img" src="https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=300&auto=format&fit=crop&q=80" alt="Bamboo Gel">
                    <span class="thumb-badge badge-gray-sm">Mature Stage</span>
                </div>
                <div class="trend-card-body">
                    <div class="t-name-row">
                        <h4 class="t-item-name">Bamboo Gel Pen</h4>
                        <span class="badge-steady-pill">Steady</span>
                    </div>
                    <p class="t-item-desc">Pulpen ramah lingkungan isi ulang bahan bambu asli dengan...</p>
                    <div class="t-signal-row">
                        <div class="sig-val">SIGNAL <strong>69%</strong></div>
                        <div class="mini-spark-line gray"></div>
                    </div>
                    <a href="{{ route('predict.index', ['product_name' => 'Bamboo Gel Pen Eco', 'category' => 'Stationery & Toys', 'cost_price' => 4000, 'selling_price' => 12000]) }}" class="btn-outline w-full text-center">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/></svg>
                        <span>Simulate in Predict</span>
                    </a>
                </div>
            </div>

            <!-- ITEM 4 -->
            <div class="card-panel trend-matrix-card">
                <div class="thumb-rel-box">
                    <img class="trend-thumb-img" src="https://images.unsplash.com/photo-1517256064527-09c73fc73e38?w=300&auto=format&fit=crop&q=80" alt="Korean Tumbler">
                    <span class="thumb-badge badge-lime-sm">Early Stage</span>
                </div>
                <div class="trend-card-body">
                    <div class="t-name-row">
                        <h4 class="t-item-name">Korean Tumbler</h4>
                        <span class="badge-high-pill">High</span>
                    </div>
                    <p class="t-item-desc">Botol minum insulasi stainless pastel dengan pegangan estetik...</p>
                    <div class="t-signal-row">
                        <div class="sig-val">SIGNAL <strong>64%</strong></div>
                        <div class="mini-spark-line green"></div>
                    </div>
                    <a href="{{ url('/laris-predict') }}" class="btn-lime w-full text-center">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/></svg>
                        <span>Simulate in Predict</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@push('styles')
<style>
    .trend-page {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .trend-head-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .t-main-title {
        font-family: 'Outfit', sans-serif;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .badge-live-radar {
        background: #CCFF00;
        color: #000000;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 20px;
    }

    .t-sub-desc {
        font-size: 13px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .trend-controls-row {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .time-filter-pills {
        display: flex;
        background: #E2E8F0;
        padding: 4px;
        border-radius: 10px;
    }

    .pill-btn {
        background: transparent;
        border: none;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-muted);
        cursor: pointer;
    }

    .pill-btn.active {
        background: #FFFFFF;
        color: var(--text-main);
        font-weight: 700;
        box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    }

    .category-select-pill {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-main);
    }

    /* HERO TREND CARD */
    .hero-trend-card {
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .hero-top-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .hero-title-group {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .radar-ping-icon {
        width: 44px;
        height: 44px;
        background: #ECFDF5;
        border: 1px solid #A7F3D0;
        color: #065F46;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 800;
    }

    .hero-sub-tag {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
    }

    .hero-product-name {
        font-family: 'Outfit', sans-serif;
        font-size: 24px;
        font-weight: 800;
        color: var(--text-main);
    }

    .hero-stage-badge-box {
        text-align: right;
    }

    .badge-stage-lime {
        background: #CCFF00;
        color: #000000;
        font-size: 12px;
        font-weight: 800;
        padding: 4px 12px;
        border-radius: 20px;
        display: inline-block;
    }

    .stage-sub {
        display: block;
        font-size: 10px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    /* HERO 4 METRICS */
    .hero-metrics-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .hero-m-card {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 14px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .m-lbl {
        font-size: 10px;
        font-weight: 800;
        color: var(--text-muted);
        letter-spacing: 0.5px;
    }

    .m-val-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 6px 0;
    }

    .m-num {
        font-family: 'Outfit', sans-serif;
        font-size: 22px;
        font-weight: 800;
        color: var(--text-main);
    }

    .m-tag-ultra {
        background: #0B1215;
        color: #CCFF00;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .m-big-green {
        font-family: 'Outfit', sans-serif;
        font-size: 26px;
        font-weight: 800;
        color: #16A34A;
        margin: 4px 0;
    }

    .m-sub-text {
        font-size: 11px;
        color: var(--text-muted);
    }

    .m-sub-deficit {
        font-size: 11px;
        color: #DC2626;
        font-weight: 600;
    }

    .strength-bar {
        height: 6px;
        background: #E2E8F0;
        border-radius: 6px;
        overflow: hidden;
    }

    .s-fill {
        height: 100%;
        background: #16A34A;
    }

    /* ACCELERATION CHART */
    .accel-chart-box {
        background: #FAFAFA;
        border: 1px solid #F1F5F9;
        border-radius: 14px;
        padding: 18px;
    }

    .accel-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .accel-legend {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 11px;
        color: var(--text-muted);
    }

    .leg-pill {
        background: #E2E8F0;
        color: #475569;
        font-weight: 800;
        font-size: 9px;
        padding: 2px 8px;
        border-radius: 10px;
    }

    .bar-black { width: 12px; height: 3px; background: #0F172A; display: inline-block; }
    .bar-green { width: 12px; height: 3px; background: #16A34A; display: inline-block; }

    .accel-svg-wrapper {
        width: 100%;
    }

    .accel-svg {
        width: 100%;
        height: 120px;
    }

    .accel-x-axis {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: var(--text-muted);
        margin-top: 6px;
    }

    .fw-bold { font-weight: 700; color: var(--text-main); }

    /* STRATEGIC REC BANNER */
    .strategic-rec-banner {
        background: #0B1215;
        border-radius: 14px;
        padding: 18px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .rec-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .rec-ai-box {
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

    .rec-tag {
        font-size: 11px;
        font-weight: 800;
        color: #CCFF00;
        letter-spacing: 0.5px;
    }

    .tag-fast {
        background: #16A34A;
        color: #FFFFFF;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .rec-text {
        font-size: 13px;
        color: #E2E8F0;
        line-height: 1.4;
        margin-top: 4px;
    }

    /* TRENDING MATRIX 4 COLS */
    .trending-matrix-sec {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .matrix-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .link-all {
        font-size: 12px;
        font-weight: 700;
        color: #16A34A;
        text-decoration: none;
    }

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
        width: 100%;
    }

    .trend-thumb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumb-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 10px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
    }

    .badge-lime-sm { background: #CCFF00; color: #000000; }
    .badge-amber-sm { background: #FEF3C7; color: #D97706; }
    .badge-gray-sm { background: #F1F5F9; color: #475569; }

    .trend-card-body {
        padding: 14px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex: 1;
        justify-content: space-between;
    }

    .t-name-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .t-item-name {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-main);
    }

    .badge-high-pill { background: #DCFCE7; color: #16A34A; font-size: 9px; font-weight: 800; padding: 2px 6px; border-radius: 4px; }
    .badge-med-pill { background: #FEF3C7; color: #D97706; font-size: 9px; font-weight: 800; padding: 2px 6px; border-radius: 4px; }
    .badge-steady-pill { background: #F1F5F9; color: #475569; font-size: 9px; font-weight: 800; padding: 2px 6px; border-radius: 4px; }

    .t-item-desc {
        font-size: 11px;
        color: var(--text-muted);
        line-height: 1.4;
    }

    .t-signal-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #F8FAFC;
        padding: 6px 10px;
        border-radius: 6px;
    }

    .sig-val { font-size: 11px; color: var(--text-muted); }
    .sig-val strong { color: var(--text-main); }

    .mini-spark-line {
        width: 40px;
        height: 12px;
        border-radius: 2px;
    }
    .mini-spark-line.green { background: #16A34A; }
    .mini-spark-line.gray { background: #94A3B8; }

    @media (max-width: 1200px) {
        .hero-metrics-grid { grid-template-columns: repeat(2, 1fr); }
        .trending-grid-4col { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endpush

@push('scripts')
<script>
    function filterTrendDuration(btn, days) {
        document.querySelectorAll('.pill-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const growthEl = document.querySelector('.m-big-green');
        if (growthEl) {
            growthEl.textContent = days === 7 ? '+284%' : (days === 30 ? '+612%' : '+1.450%');
        }
        showTrendToast(`📅 Menampilkan data tren ${days} hari terakhir.`);
    }

    function filterTrendCategory(category) {
        const cards = document.querySelectorAll('.trend-matrix-card');
        let visibleCount = 0;
        cards.forEach(c => {
            const text = c.innerText.toLowerCase();
            if (category === 'all' || text.includes(category.toLowerCase().split(' ')[0])) {
                c.style.display = 'flex';
                visibleCount++;
            } else {
                c.style.display = 'none';
            }
        });
        showTrendToast(`🔍 Filter diterapkan: ${category} (${visibleCount} produk terpantau)`);
    }

    function rescanMarketplaceRadar() {
        const btn = document.getElementById('btn-rescan-radar');
        if (btn) btn.innerHTML = '<span>⏳ Memindai...</span>';

        setTimeout(() => {
            if (btn) btn.innerHTML = `<svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg><span>Pindai Ulang</span>`;
            showTrendToast('📡 Radar AI berhasil memindai ulang 24.800 kata kunci marketplace lokal!');
        }, 800);
    }

    function showTrendToast(msg) {
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
        toast.textContent = msg;

        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 400);
        }, 3000);
    }
</script>
@endpush
@endsection
