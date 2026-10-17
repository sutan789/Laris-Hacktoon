@extends('layouts.app', ['title' => 'LARIS Predict - What If I Sell This?'])

@section('content')
<div class="predict-page">

    <!-- TOP NOTICE STRIP -->
    <div class="insight-strip-dark">
        <div class="strip-left">
            <div class="strip-icon-box">💡</div>
            <div>
                <div class="strip-tag">Juragan AI Insight Strip •</div>
                <p>Pasar perlengkapan viral di area tokomu naik <strong>+142%</strong> pekan ini. Gunakan simulator di bawah untuk mengukur proyeksi laba bersih.</p>
            </div>
        </div>
        <div class="strip-meta">
            <span class="live-dot-green"></span>
            <span>Model v3.8 - Real-time Big Data MSME</span>
        </div>
    </div>

    <!-- MAIN PAGE TITLE -->
    <div class="predict-header-row">
        <div>
            <div class="presisi-pill">● SIMULASI BISNIS PRESISI</div>
            <h1 class="p-main-title">What If I Sell This?</h1>
            <p class="p-sub-desc">AI Market Demand, Pricing, & Profitability Simulator for Indonesian MSMEs (Juragan Pintar)</p>
        </div>
        <div class="header-action-group">
            <button class="btn-dark" onclick="resetForm()">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                <span>Simulasi Baru</span>
            </button>
            <button type="button" class="btn-outline" onclick="openHistoryModal()">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/></svg>
                <span>Riwayat (12)</span>
            </button>
        </div>
    </div>

    <!-- TWO COLUMN SIMULATOR LAYOUT -->
    <div class="simulator-grid">
        
        <!-- SISI KIRI: FORM PARAMETER PRODUK BARU -->
        <div class="sim-left-col">
            <div class="card-panel">
                <div class="form-sec-head">
                    <div class="flex-align gap-8">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/></svg>
                        <h3 class="sec-heading">Parameter Produk Baru</h3>
                    </div>
                    <span class="step-tag">Langkah 1/2</span>
                </div>

                <form id="predictForm" onsubmit="event.preventDefault(); runPrediction();">
                    <!-- NAMA PRODUK -->
                    <div class="form-group">
                        <div class="label-row">
                            <label for="productName">Nama Produk Rencana</label>
                            <span class="required-tag">Wajib diisi</span>
                        </div>
                        <div class="input-with-icon">
                            <svg width="16" height="16" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                            <input type="text" id="productName" value="{{ $prefill['product_name'] ?? 'Pensil Labubu Premium Edition' }}" required>
                        </div>
                    </div>

                    <!-- KATEGORI TREN PASAR -->
                    <div class="form-group">
                        <label for="categorySelect">Kategori Tren Pasar</label>
                        <select id="categorySelect">
                            <option {{ ($prefill['category'] ?? '') === 'Stationery & Toys' ? 'selected' : '' }}>Stationery & Toys (Viral Pop Culture)</option>
                            <option {{ ($prefill['category'] ?? '') === 'Kopi & Minuman Kemasan' ? 'selected' : '' }}>Kopi & Minuman Kemasan</option>
                            <option {{ ($prefill['category'] ?? '') === 'Kebutuhan Pokok / Sembako' ? 'selected' : '' }}>Kebutuhan Pokok / Sembako</option>
                            <option {{ ($prefill['category'] ?? '') === 'Aksesoris Gadget' ? 'selected' : '' }}>Aksesoris Gadget</option>
                            <option {{ ($prefill['category'] ?? '') === 'Lifestyle & Fashion' ? 'selected' : '' }}>Lifestyle & Fashion</option>
                        </select>
                    </div>

                    <!-- INPUT HARGA MODAL & HARGA JUAL -->
                    <div class="form-row-2col">
                        <div class="form-group">
                            <label for="costPrice">Modal / HPP (Rp)</label>
                            <input type="number" id="costPrice" value="{{ $prefill['cost_price'] ?? 8500 }}" oninput="calculateMargin()">
                        </div>
                        <div class="form-group">
                            <label for="sellPrice">Harga Jual (Rp)</label>
                            <input type="number" id="sellPrice" value="{{ $prefill['selling_price'] ?? 18000 }}" oninput="calculateMargin()">
                        </div>
                    </div>

                    <!-- GROSS MARGIN BOX AUTO CALC -->
                    <div class="gross-margin-auto-box">
                        <div class="gm-left">
                            <span class="pct-icon">%</span>
                            <div>
                                <span class="gm-label">Estimasi Gross Margin</span>
                                <span class="gm-sub" id="profitPerUnit">Keuntungan per unit: Rp 9.500</span>
                            </div>
                        </div>
                        <span class="gm-pct-badge" id="marginBadge">52.8%</span>
                    </div>

                    <!-- RENCANA STOK AWAL -->
                    <div class="form-group mt-16">
                        <div class="label-row">
                            <label>Rencana Stok Awal (Batch 1)</label>
                            <span class="stock-highlight" id="batchDisplay">50 Pcs</span>
                        </div>
                        <div class="stock-chips-row">
                            <button type="button" class="stock-chip" onclick="setBatch(10, '10 pcs (Trial)')">10 pcs (Trial)</button>
                            <button type="button" class="stock-chip active" onclick="setBatch(50, '50 pcs (Scale)')">50 pcs (Scale)</button>
                            <button type="button" class="stock-chip" onclick="setBatch(100, '100 pcs')">100 pcs</button>
                            <button type="button" class="stock-chip" onclick="setBatch(250, '250 pcs (Grosir)')">250 pcs (Grosir)</button>
                        </div>
                    </div>

                    <!-- TARGET SALURAN PENJUALAN -->
                    <div class="form-group">
                        <label>Target Saluran Penjualan</label>
                        <div class="channels-checkbox-grid">
                            <label class="channel-pill active">
                                <input type="checkbox" checked> ✔ Shopee
                            </label>
                            <label class="channel-pill active">
                                <input type="checkbox" checked> ✔ TikTok Shop
                            </label>
                            <label class="channel-pill active">
                                <input type="checkbox" checked> ✔ Tokopedia
                            </label>
                            <label class="channel-pill active">
                                <input type="checkbox" checked> ✔ Offline Store
                            </label>
                        </div>
                    </div>

                    <!-- CTA BUTTON -->
                    <button type="submit" class="btn-lime w-full text-center sim-submit-btn">
                        <span>ANALYZE WITH LARIS</span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                    </button>
                </form>
            </div>

            <!-- BENCHMARK KATEGORI SERUPA -->
            <div class="card-panel benchmark-card mt-16">
                <img class="bench-thumb" src="https://images.unsplash.com/photo-1585336261026-784860010041?w=80&auto=format&fit=crop&q=80" alt="Thumb">
                <div>
                    <span class="bench-tag">BENCHMARK KATEGORI SERUPA</span>
                    <h5 class="bench-name">Gantungan Kunci Viral V1</h5>
                    <span class="bench-stat">Tingkat Penjualan <strong>94%</strong> dalam 18 Hari</span>
                </div>
            </div>
        </div>

        <!-- SISI KANAN: HASIL PREDIKSI KECERDASAN BUATAN -->
        <div class="sim-right-col">
            <div class="card-panel result-main-panel">
                
                <div class="result-header">
                    <span class="res-sub-head">HASIL PREDIKSI KECERDASAN BUATAN</span>
                    <div class="flex-align gap-8">
                        <h2 class="res-title">Skor Potensi Produk</h2>
                        <span class="verified-icon">✔</span>
                    </div>
                </div>

                <div class="result-top-metrics">
                    <div class="score-banner-box">
                        <div class="confidence-strip">
                            <span>🔒 88.2% Confidence</span>
                            <span class="conf-lbl">Tingkat Keyakinan</span>
                        </div>
                        <div class="big-score-num">
                            <span>87</span><small>/100</small>
                        </div>
                    </div>

                    <div class="forecast-cards-row">
                        <div class="f-metric-card">
                            <span class="f-lbl">Estimasi Permintaan Awal</span>
                            <h3 class="f-val">38 - 52 <small>pcs</small></h3>
                            <span class="f-sub text-green">📈 Terjual dalam 14 hari pertama</span>
                        </div>

                        <div class="f-metric-card">
                            <span class="f-lbl">Proyeksi Pendapatan (Revenue)</span>
                            <h3 class="f-val">Rp 810.000</h3>
                            <span class="f-sub text-green">Estimasi Laba Bersih: <strong>+Rp 427.500</strong></span>
                        </div>
                    </div>
                </div>

                <!-- LINTASAN PROYEKSI PENDAPATAN & LABA (30 HARI) -->
                <div class="projection-chart-box">
                    <div class="proj-head">
                        <div>
                            <h4>Lintasan Proyeksi Pendapatan & Laba (30 Hari)</h4>
                            <p class="sub-muted">Kurva pertumbuhan dinamis dengan pita probabilitas LARIS</p>
                        </div>
                        <div class="proj-legend">
                            <span><span class="dash-black"></span> Revenue Target</span>
                            <span><span class="dash-green"></span> Profit Curve</span>
                        </div>
                    </div>

                    <div class="chart-wrapper">
                        <svg viewBox="0 0 540 130" class="proj-svg">
                            <!-- Shaded BEP / Profit polygon -->
                            <polygon points="0,120 180,100 270,75 540,15 540,120" fill="rgba(204, 255, 0, 0.15)" />
                            
                            <!-- Curve 1: Revenue -->
                            <path d="M 0 115 Q 180 90, 270 70 T 540 15" fill="none" stroke="#0F172A" stroke-width="2.5" />
                            
                            <!-- Curve 2: Profit -->
                            <path d="M 0 125 Q 180 110, 270 85 T 540 40" fill="none" stroke="#16A34A" stroke-width="2.5" stroke-dasharray="5,4" />
                            
                            <!-- BEP Point Marker -->
                            <circle cx="270" cy="70" r="5" fill="#CCFF00" stroke="#000000" stroke-width="2" />
                            <text x="260" y="58" font-size="9" font-weight="700" fill="#000000">Hari ke-14 (BEP)</text>
                        </svg>
                        <div class="chart-timeline-labels">
                            <span>Hari 1 (Peluncuran)</span>
                            <span>Hari 7</span>
                            <span class="bep-text">Hari 14 (Titik Impas/BEP)</span>
                            <span>Hari 21</span>
                            <span>Hari 30 (Laba Maks)</span>
                        </div>
                    </div>
                </div>

                <!-- KEY INSIGHTS & REKOMENDASI JURAGAN AI -->
                <div class="insights-box">
                    <div class="ins-title-row">
                        <div class="ins-icon">💡</div>
                        <div>
                            <h4>Key Insights & Rekomendasi Juragan AI</h4>
                            <p class="sub-muted">Analisis prediktif berbasis lokasi tokomu di Jabodetabek</p>
                        </div>
                    </div>

                    <div class="insights-list">
                        <!-- INSIGHT 1 -->
                        <div class="ins-item">
                            <div class="ins-item-head">
                                <div class="flex-align gap-8">
                                    <span class="check-green">✔</span>
                                    <strong>High Demand, Low Competition in your local sub-district.</strong>
                                </div>
                                <span class="badge-gold">PELUANG EMAS</span>
                            </div>
                            <p class="ins-desc">Ada 4.800+ pencarian bulanan untuk kata kunci labubu stationary di radius 5km toko fisikmu, dengan hanya 2 penjual aktif berstok terbatas.</p>
                        </div>

                        <!-- INSIGHT 2 -->
                        <div class="ins-item">
                            <div class="ins-item-head">
                                <div class="flex-align gap-8">
                                    <span class="bolt-lime">⚡</span>
                                    <strong>Viral velocity on TikTok Shop: +142% search queries this week.</strong>
                                </div>
                                <span class="badge-black">VIRAL SPIKE</span>
                            </div>
                            <p class="ins-desc">Rekomendasi format konten: Video unboxing mini stationery dengan audio trending anak sekolah berdurasi 12-18 detik.</p>
                        </div>

                        <!-- INSIGHT 3 -->
                        <div class="ins-item">
                            <div class="ins-item-head">
                                <div class="flex-align gap-8">
                                    <span class="star-icon">📦</span>
                                    <strong>Recommended Bundle: Pair with Labubu Pencil Case to boost AOV by 25%.</strong>
                                </div>
                                <span class="badge-green-sm">+25% AOV</span>
                            </div>
                            <p class="ins-desc">Paket bundling seharga Rp 49.000 meningkatkan konversi keranjang belanja hingga 1.8x dibandingkan penjualan satuan.</p>
                        </div>
                    </div>
                </div>

                <!-- FOOTER BUTTONS -->
                <div class="result-action-footer">
                    <div class="foot-left-actions">
                        <button type="button" class="btn-outline" onclick="saveSimulationDraft()">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/></svg>
                            <span>Save Simulation</span>
                        </button>
                        <button type="button" class="btn-outline" onclick="exportSimulationReport()">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            <span>Export Report</span>
                        </button>
                    </div>
                    <form action="{{ route('predict.add_to_inventory') }}" method="POST">
                        @csrf
                        <input type="hidden" name="prediction_id" value="{{ $latestPrediction ? $latestPrediction->id : 1 }}">
                        <button type="submit" class="btn-dark">
                            <svg width="16" height="16" fill="none" stroke="#CCFF00" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            <span>Add to Inventory Plan</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>

</div>

@push('styles')
<style>
    .predict-page {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .insight-strip-dark {
        background: #0B1215;
        border: 1px solid #1E2D33;
        border-radius: 14px;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .strip-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .strip-icon-box {
        width: 36px;
        height: 36px;
        background: #162228;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .strip-tag {
        font-size: 11px;
        font-weight: 800;
        color: var(--accent-lime);
        letter-spacing: 0.5px;
    }

    .strip-left p {
        font-size: 13px;
        color: #E2E8F0;
    }

    .strip-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        color: #94A3B8;
        font-weight: 600;
    }

    .live-dot-green {
        width: 7px;
        height: 7px;
        background: #22C55E;
        border-radius: 50%;
    }

    /* HEADER */
    .predict-header-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .presisi-pill {
        display: inline-block;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        color: #84CC16;
        margin-bottom: 4px;
    }

    .p-main-title {
        font-family: 'Outfit', sans-serif;
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .p-sub-desc {
        font-size: 13px;
        color: var(--text-muted);
    }

    .header-action-group {
        display: flex;
        gap: 10px;
    }

    /* SIMULATOR GRID */
    .simulator-grid {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 24px;
    }

    .form-sec-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .sec-heading {
        font-size: 15px;
        font-weight: 700;
    }

    .step-tag {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 14px;
    }

    .label-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-group label {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-main);
    }

    .required-tag {
        font-size: 10px;
        color: #64748B;
    }

    .input-with-icon {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        border-radius: 10px;
        padding: 8px 12px;
    }

    .input-with-icon input {
        border: none;
        background: transparent;
        outline: none;
        font-size: 13px;
        width: 100%;
        color: var(--text-main);
        font-weight: 600;
    }

    .form-group select, .form-group input[type="number"] {
        background: #F8FAFC;
        border: 1px solid #CBD5E1;
        border-radius: 10px;
        padding: 9px 12px;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-main);
        outline: none;
    }

    .form-row-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .gross-margin-auto-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #F0FDF4;
        border: 1px solid #BBF7D0;
        padding: 12px 14px;
        border-radius: 10px;
    }

    .gm-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pct-icon {
        width: 28px;
        height: 28px;
        background: #DCFCE7;
        color: #16A34A;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 14px;
    }

    .gm-label {
        font-size: 12px;
        font-weight: 700;
        color: #166534;
        display: block;
    }

    .gm-sub {
        font-size: 10px;
        color: #15803D;
    }

    .gm-pct-badge {
        font-size: 18px;
        font-weight: 800;
        color: #166534;
    }

    .mt-16 { margin-top: 16px; }

    .stock-highlight {
        font-size: 12px;
        font-weight: 800;
        color: #16A34A;
    }

    .stock-chips-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 6px;
    }

    .stock-chip {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 8px 4px;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
        text-align: center;
    }

    .stock-chip.active {
        background: #0B1215;
        color: #FFFFFF;
        border-color: #0B1215;
    }

    .channels-checkbox-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .channel-pill {
        background: #0B1215;
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 700;
        padding: 8px 12px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }

    .channel-pill input { display: none; }

    .sim-submit-btn {
        margin-top: 14px;
        padding: 12px;
    }

    .benchmark-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
    }

    .bench-thumb {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        object-fit: cover;
    }

    .bench-tag {
        font-size: 9px;
        font-weight: 800;
        color: var(--text-muted);
        letter-spacing: 0.5px;
    }

    .bench-name {
        font-size: 13px;
        font-weight: 700;
    }

    .bench-stat {
        font-size: 11px;
        color: #16A34A;
    }

    /* RIGHT COLUMN RESULTS */
    .result-main-panel {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .res-sub-head {
        font-size: 10px;
        font-weight: 800;
        color: var(--text-muted);
        letter-spacing: 0.8px;
    }

    .res-title {
        font-size: 22px;
        font-weight: 800;
    }

    .verified-icon {
        color: #16A34A;
    }

    .result-top-metrics {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 16px;
    }

    .score-banner-box {
        background: #0B1215;
        color: #FFFFFF;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .confidence-strip {
        font-size: 10px;
        color: #94A3B8;
    }

    .conf-lbl { display: block; font-size: 9px; }

    .big-score-num {
        font-size: 42px;
        font-weight: 900;
        color: #CCFF00;
        line-height: 1;
    }

    .big-score-num small {
        font-size: 16px;
        color: #FFFFFF;
    }

    .forecast-cards-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .f-metric-card {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 14px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .f-lbl {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-muted);
    }

    .f-val {
        font-size: 22px;
        font-weight: 800;
        color: var(--text-main);
        margin: 6px 0;
    }

    .f-sub {
        font-size: 11px;
    }

    /* PROJECTION CHART */
    .projection-chart-box {
        border-top: 1px solid #F1F5F9;
        padding-top: 18px;
    }

    .proj-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .proj-legend {
        display: flex;
        gap: 12px;
        font-size: 11px;
        color: var(--text-muted);
    }

    .dash-black { width: 12px; height: 3px; background: #0F172A; display: inline-block; }
    .dash-green { width: 12px; height: 3px; background: #16A34A; display: inline-block; }

    .proj-svg {
        width: 100%;
        height: 110px;
    }

    .chart-timeline-labels {
        display: flex;
        justify-content: space-between;
        font-size: 10px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    .bep-text {
        font-weight: 800;
        color: #0F172A;
    }

    /* INSIGHTS */
    .insights-box {
        background: #FAFAFA;
        border: 1px solid #F1F5F9;
        border-radius: 12px;
        padding: 18px;
    }

    .ins-title-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
    }

    .ins-icon {
        width: 32px;
        height: 32px;
        background: #CCFF00;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .insights-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .ins-item {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 12px;
    }

    .ins-item-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
    }

    .ins-item-head strong {
        font-size: 12px;
        color: var(--text-main);
    }

    .badge-gold { background: #FEF3C7; color: #D97706; font-size: 9px; font-weight: 800; padding: 2px 6px; border-radius: 4px; }
    .badge-black { background: #0B1215; color: #FFFFFF; font-size: 9px; font-weight: 800; padding: 2px 6px; border-radius: 4px; }
    .badge-green-sm { background: #DCFCE7; color: #16A34A; font-size: 9px; font-weight: 800; padding: 2px 6px; border-radius: 4px; }

    .ins-desc {
        font-size: 11px;
        color: var(--text-muted);
        line-height: 1.4;
    }

    .result-action-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #F1F5F9;
        padding-top: 16px;
    }

    .foot-left-actions {
        display: flex;
        gap: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
    function calculateMargin() {
        const cost = parseFloat(document.getElementById('costPrice').value) || 0;
        const sell = parseFloat(document.getElementById('sellPrice').value) || 0;
        if (sell > 0) {
            const profit = sell - cost;
            const pct = ((profit / sell) * 100).toFixed(1);
            document.getElementById('marginBadge').innerText = pct + '%';
            document.getElementById('profitPerUnit').innerText = 'Keuntungan per unit: Rp ' + profit.toLocaleString('id-ID');
        }
    }

    function setBatch(num, label) {
        document.getElementById('batchDisplay').innerText = num + ' Pcs';
        document.querySelectorAll('.stock-chip').forEach(el => el.classList.remove('active'));
        event.target.classList.add('active');
    }

    function resetForm() {
        document.getElementById('productName').value = '';
        document.getElementById('costPrice').value = '10000';
        document.getElementById('sellPrice').value = '20000';
        calculateMargin();
    }

    function runPrediction() {
        showPredictToast('⚡ Simulasi AI sedang memproses data pasar terkini...');
    }

    function openHistoryModal() {
        document.getElementById('modal-predict-history').style.display = 'flex';
    }

    function closeHistoryModal() {
        document.getElementById('modal-predict-history').style.display = 'none';
    }

    function saveSimulationDraft() {
        const prod = document.getElementById('productName').value || 'Produk Tanpa Nama';
        showPredictToast(`💾 Skenario simulasi "${prod}" berhasil disimpan ke riwayat Juragan!`);
    }

    function exportSimulationReport() {
        const prod = document.getElementById('productName').value || 'Labubu Blind Box';
        const cost = document.getElementById('costPrice').value;
        const sell = document.getElementById('sellPrice').value;

        let txt = `====================================================\n`;
        txt += `   LARIS PREDICT - HASIL PROYEKSI SIMULASI BISNIS\n`;
        txt += `====================================================\n\n`;
        txt += `Produk: ${prod}\n`;
        txt += `HPP Modal: Rp ${parseInt(cost).toLocaleString('id-ID')}\n`;
        txt += `Harga Jual Target: Rp ${parseInt(sell).toLocaleString('id-ID')}\n`;
        txt += `Estimasi Demand: HIGH (Skor Potensi: 88/100)\n`;
        txt += `Proyeksi Laba Bersih: Rp 1.560.000 / batch\n`;
        txt += `Waktu Ekspor: ${new Date().toLocaleString('id-ID')}\n\n`;
        txt += `Platform Didukung oleh LARIS Autonomous AI Engine 2026\n`;

        const blob = new Blob([txt], { type: 'text/plain' });
        const a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = `simulasi_laris_${prod.replace(/\s+/g, '_').toLowerCase()}.txt`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);

        showPredictToast('📄 Laporan simulasi berhasil diunduh!');
    }

    function loadSimHistory(name, cost, sell, cat) {
        document.getElementById('productName').value = name;
        document.getElementById('costPrice').value = cost;
        document.getElementById('sellPrice').value = sell;
        document.getElementById('productCategory').value = cat;
        calculateMargin();
        closeHistoryModal();
        showPredictToast(`🔄 Parameter simulasi "${name}" dimuat kembali!`);
    }

    function showPredictToast(msg) {
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
        }, 3200);
    }
</script>
@endpush

<!-- MODAL RIWAYAT SIMULASI -->
<div id="modal-predict-history" class="laris-modal-overlay" style="position: fixed; inset: 0; background: rgba(11, 18, 21, 0.7); backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; z-index: 999; padding: 20px;">
    <div style="background: #FFFFFF; border-radius: 16px; width: 100%; max-width: 560px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); overflow: hidden;">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 24px; background: #F8FAFC; border-bottom: 1px solid #E2E8F0;">
            <h3 style="font-size: 16px; font-weight: 700; color: #0F172A; margin: 0;">📜 Riwayat Simulasi Produk Terakhir</h3>
            <button type="button" onclick="closeHistoryModal()" style="background: none; border: none; font-size: 22px; color: #64748B; cursor: pointer;">&times;</button>
        </div>
        <div style="padding: 20px; display: flex; flex-direction: column; gap: 12px; max-height: 400px; overflow-y: auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px;">
                <div>
                    <strong style="font-size: 13px; color: #0F172A;">Pensil Labubu Blind Box</strong>
                    <div style="font-size: 11px; color: #64748B;">HPP: Rp 22.000 | Jual: Rp 35.000 | Margin: 37%</div>
                </div>
                <button type="button" class="btn-dark" onclick="loadSimHistory('Pensil Labubu Blind Box', 22000, 35000, 'Stationery & Toys')" style="font-size: 11px; padding: 6px 12px;">Muat</button>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px;">
                <div>
                    <strong style="font-size: 13px; color: #0F172A;">Kopi Drip Bag Arabika</strong>
                    <div style="font-size: 11px; color: #64748B;">HPP: Rp 16.000 | Jual: Rp 28.000 | Margin: 42%</div>
                </div>
                <button type="button" class="btn-dark" onclick="loadSimHistory('Kopi Drip Bag Arabika', 16000, 28000, 'Food & Beverage')" style="font-size: 11px; padding: 6px 12px;">Muat</button>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px;">
                <div>
                    <strong style="font-size: 13px; color: #0F172A;">Botol Minum Motivasi 2L</strong>
                    <div style="font-size: 11px; color: #64748B;">HPP: Rp 25.000 | Jual: Rp 45.000 | Margin: 44%</div>
                </div>
                <button type="button" class="btn-dark" onclick="loadSimHistory('Botol Minum Motivasi 2L', 25000, 45000, 'Lifestyle')" style="font-size: 11px; padding: 6px 12px;">Muat</button>
            </div>
        </div>
        <div style="padding: 14px 24px; background: #F8FAFC; border-top: 1px solid #E2E8F0; display: flex; justify-content: flex-end;">
            <button type="button" class="btn-outline" onclick="closeHistoryModal()">Tutup</button>
        </div>
    </div>
</div>
@endsection
