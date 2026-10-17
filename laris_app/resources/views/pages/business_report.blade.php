@extends('layouts.app', ['title' => 'Business Report - Monthly Business Review'])

@section('content')
<div class="report-page">

    <!-- PAGE HEADER -->
    <div class="report-head-bar">
        <div>
            <div class="report-audit-tag">AI CERTIFIED AUDITED • Sinkronisasi POS Real-time</div>
            <h1 class="rep-main-title">Monthly Business Review</h1>
            <p class="rep-sub-desc">Laporan audit komprehensif performa laba, perputaran stok, dan peluang AI Toko Berkah Utama.</p>
        </div>

        <div class="report-head-actions">
            <div class="period-selector">
                <span class="p-icon">📅</span>
                <div>
                    <span class="p-lbl">PERIODE EVALUASI</span>
                    <strong class="p-date">01 Sep - 30 Sep 2026</strong>
                </div>
            </div>
            <span class="month-pill">Bulan: Sept 2026</span>
            <button class="btn-lime" onclick="alert('Laporan Audit Bulanan sedang diunduh dalam format PDF/Excel!')">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                <span>Unduh Laporan Lengkap (PDF/Excel)</span>
            </button>
        </div>
    </div>

    <!-- 4 EXECUTIVE METRIC CARDS -->
    <div class="rep-kpi-grid">
        <!-- METRIC 1 -->
        <div class="card-panel rep-kpi-card">
            <div class="rep-top-meta">
                <span class="k-title">TOTAL REVENUE</span>
                <span class="badge-growth-green">↗ +18% MoM</span>
            </div>
            <h2 class="rep-big-num">Rp 12.4M</h2>
            <div class="rep-foot-meta">
                <span>Target: Rp 10.5M</span>
                <strong class="text-green">118% Capaian</strong>
            </div>
            <div class="bar-track mt-6"><div class="bar-fill" style="width: 100%; background: #0F172A;"></div></div>
        </div>

        <!-- METRIC 2 -->
        <div class="card-panel rep-kpi-card">
            <div class="rep-top-meta">
                <span class="k-title">NET PROFIT (BERSIH)</span>
                <span class="badge-growth-green">↗ +4.2% MoM</span>
            </div>
            <h2 class="rep-big-num">Rp 5.3M</h2>
            <div class="rep-foot-meta">
                <span>Margin Profit: <strong>42.7%</strong></span>
                <span class="badge-green-sm">Sangat Sehat</span>
            </div>
            <div class="bar-track mt-6"><div class="bar-fill" style="width: 75%; background: #16A34A;"></div></div>
        </div>

        <!-- METRIC 3 -->
        <div class="card-panel rep-kpi-card">
            <div class="rep-top-meta">
                <span class="k-title">BEBAN OPERASIONAL</span>
                <span class="badge-growth-green">↘ -3% Efisiensi</span>
            </div>
            <h2 class="rep-big-num">Rp 7.1M</h2>
            <div class="rep-foot-meta">
                <span>Opex/Rev Ratio: 57.2%</span>
                <strong class="text-muted">Terkontrol</strong>
            </div>
            <div class="bar-track mt-6"><div class="bar-fill" style="width: 57%; background: #64748B;"></div></div>
        </div>

        <!-- METRIC 4 -->
        <div class="card-panel rep-kpi-card">
            <div class="rep-top-meta">
                <span class="k-title">RATA-RATA SKOR PELUANG</span>
                <span class="badge-opp-count">12 Peluang Aktif</span>
            </div>
            <div class="rep-score-row">
                <h2 class="rep-big-num">84<small>/100</small></h2>
            </div>
            <div class="rep-foot-meta">
                <span>Tingkat Konversi AI</span>
                <strong class="text-green">91.4% Sukses</strong>
            </div>
            <div class="bar-track mt-6"><div class="bar-fill" style="width: 84%; background: #CCFF00;"></div></div>
        </div>
    </div>

    <!-- MAIN TWO COLUMN CHARTS & BREAKDOWNS -->
    <div class="rep-charts-grid">
        
        <!-- KOLOM KIRI: PERTUMBUHAN REVENUE & DISTRIBUSI SALURAN -->
        <div class="card-panel">
            <div class="chart-sec-header">
                <div>
                    <h3 class="chart-sec-title">Pertumbuhan Revenue & Net Profit Mingguan</h3>
                    <p class="sub-muted">Agregasi perputaran kas mingguan sepanjang bulan September 2026</p>
                </div>
                <div class="chart-legends-group">
                    <span class="leg-dot"><span class="d-black"></span> Gross Revenue</span>
                    <span class="leg-dot"><span class="d-green"></span> Net Profit</span>
                </div>
            </div>

            <!-- BAR CHART SVG -->
            <div class="weekly-bar-chart-container">
                <div class="bar-col-item">
                    <div class="bars-pair">
                        <div class="bar-gross" style="height: 60px;"></div>
                        <div class="bar-net" style="height: 28px;"></div>
                    </div>
                    <span class="week-label">Minggu 1</span>
                    <span class="week-val">(Rp 2.4M)</span>
                </div>

                <div class="bar-col-item">
                    <div class="bars-pair">
                        <div class="bar-gross" style="height: 75px;"></div>
                        <div class="bar-net" style="height: 38px;"></div>
                    </div>
                    <span class="week-label">Minggu 2</span>
                    <span class="week-val">(Rp 2.9M)</span>
                </div>

                <div class="bar-col-item">
                    <div class="bars-pair">
                        <div class="bar-gross" style="height: 90px;"></div>
                        <div class="bar-net" style="height: 48px;"></div>
                    </div>
                    <span class="week-label">Minggu 3</span>
                    <span class="week-val">(Rp 3.3M)</span>
                </div>

                <div class="bar-col-item">
                    <div class="bars-pair">
                        <div class="bar-gross" style="height: 110px;"></div>
                        <div class="bar-net" style="height: 55px;"></div>
                    </div>
                    <span class="week-label">Minggu 4</span>
                    <span class="week-val">(Rp 3.8M)</span>
                </div>
            </div>

            <!-- DISTRIBUSI SALURAN PENJUALAN (SALES CHANNELS) -->
            <div class="channels-breakdown-section">
                <h4 class="channels-title">DISTRIBUSI SALURAN PENJUALAN (SALES CHANNELS)</h4>
                
                <div class="channels-cards-grid">
                    <div class="ch-card">
                        <div class="ch-top">
                            <span class="ch-name">Shopee Mall</span>
                            <span class="ch-pct">45%</span>
                        </div>
                        <h4 class="ch-revenue">Rp 5.58M</h4>
                    </div>

                    <div class="ch-card">
                        <div class="ch-top">
                            <span class="ch-name">Tokopedia Store</span>
                            <span class="ch-pct">30%</span>
                        </div>
                        <h4 class="ch-revenue">Rp 3.72M</h4>
                    </div>

                    <div class="ch-card">
                        <div class="ch-top">
                            <span class="ch-name">Toko Fisik (Offline)</span>
                            <span class="ch-pct">25%</span>
                        </div>
                        <h4 class="ch-revenue">Rp 3.10M</h4>
                    </div>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN: STRUKTUR PORTOFOLIO PENJUALAN (DONUT CHART) -->
        <div class="card-panel">
            <div class="chart-sec-header">
                <div>
                    <h3 class="chart-sec-title">Struktur Portofolio Penjualan</h3>
                    <p class="sub-muted">Audit item terlaris, dead stock berisiko, dan peluang konversi tinggi.</p>
                </div>
                <svg width="20" height="20" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z"/></svg>
            </div>

            <div class="donut-chart-container">
                <div class="donut-circle-visual">
                    <svg viewBox="0 0 100 100" class="donut-svg">
                        <circle cx="50" cy="50" r="38" fill="transparent" stroke="#16A34A" stroke-width="14" stroke-dasharray="80 160" stroke-dashoffset="25"></circle>
                        <circle cx="50" cy="50" r="38" fill="transparent" stroke="#CCFF00" stroke-width="14" stroke-dasharray="60 180" stroke-dashoffset="-55"></circle>
                        <circle cx="50" cy="50" r="38" fill="transparent" stroke="#DC2626" stroke-width="14" stroke-dasharray="40 200" stroke-dashoffset="-115"></circle>
                        <circle cx="50" cy="50" r="38" fill="transparent" stroke="#0F172A" stroke-width="14" stroke-dasharray="50 190" stroke-dashoffset="-155"></circle>
                    </svg>
                    <div class="donut-center-text">
                        <span class="d-center-num">Rp 11.5M</span>
                        <span class="d-center-lbl">Top SKU Value</span>
                    </div>
                </div>
            </div>

            <div class="sku-legend-list">
                <div class="sku-leg-item">
                    <div class="flex-align gap-8">
                        <span class="dot-black"></span>
                        <div>
                            <strong class="sku-name">Kopi Arabica Gayo</strong>
                            <span class="sku-role">Produk Terlaris (Champion)</span>
                        </div>
                    </div>
                    <div class="sku-right-meta">
                        <span class="sku-rev">Rp 4.2M</span>
                        <span class="sku-pct">Kontribusi 34%</span>
                    </div>
                </div>

                <div class="sku-leg-item">
                    <div class="flex-align gap-8">
                        <span class="dot-lime"></span>
                        <div>
                            <strong class="sku-name">Pensil Labubu</strong>
                            <span class="sku-role">Fast Moving Viral Item</span>
                        </div>
                    </div>
                    <div class="sku-right-meta">
                        <span class="sku-rev">Rp 3.1M</span>
                        <span class="sku-pct">Kontribusi 25%</span>
                    </div>
                </div>

                <div class="sku-leg-item">
                    <div class="flex-align gap-8">
                        <span class="dot-red"></span>
                        <div>
                            <strong class="sku-name text-red">Tumbler Stainless 500ml</strong>
                            <span class="sku-role">45 Hari Tanpa Penjualan</span>
                        </div>
                    </div>
                    <div class="sku-right-meta">
                        <span class="sku-rev text-red">Rp 1.8M Tertahan</span>
                        <span class="badge-dead-stock">Dead Stock</span>
                    </div>
                </div>

                <div class="sku-leg-item">
                    <div class="flex-align gap-8">
                        <span class="dot-gray"></span>
                        <div>
                            <strong class="sku-name">Aksesoris Stationery</strong>
                            <span class="sku-role">Potensi Permintaan Naik</span>
                        </div>
                    </div>
                    <div class="sku-right-meta">
                        <span class="sku-rev">Rp 2.4M</span>
                        <span class="sku-pct text-green">+38% Estimasi</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- RINGKASAN EVALUASI EKSEKUTIF LARIS (BOTTOM CARD) -->
    <div class="card-panel executive-summary-card">
        
        <div class="exec-head-row">
            <div class="exec-title-group">
                <div class="exec-ai-icon">🤖</div>
                <div>
                    <div class="flex-align gap-8">
                        <h3 class="exec-title">Ringkasan Evaluasi Eksekutif LARIS</h3>
                        <span class="badge-ai-v">AI Insight v2.4</span>
                    </div>
                    <p class="sub-muted">Rekomendasi otomatis berbasis pembelajaran mesin terhadap pergerakan ritel Toko Berkah Utama</p>
                </div>
            </div>

            <div class="exec-head-btns">
                <a href="{{ route('report.whatsapp') }}" target="_blank" class="btn-dark" style="text-decoration: none;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a.75.75 0 0 1-.974-.944 6.345 6.345 0 0 0 .806-2.91C3.844 15.68 3 13.93 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/></svg>
                    <span>Kirim Ringkasan via WhatsApp</span>
                </a>
                <a href="{{ url('/juragan-ai') }}" class="btn-outline">
                    <span>Jadwalkan Konsultasi Juragan AI</span>
                </a>
            </div>
        </div>

        <div class="exec-pillars-grid">
            <!-- PILLAR 1 -->
            <div class="pillar-box">
                <div class="pillar-num">1</div>
                <h4 class="pillar-head">Target Tercapai</h4>
                <p class="pillar-text">Penjualan tumbuh <strong>18% MoM</strong>, secara meyakinkan melampaui target bulanan awal sebesar Rp 10.5M berkat lonjakan pesanan Shopee di minggu ke-4.</p>
            </div>

            <!-- PILLAR 2 -->
            <div class="pillar-box">
                <div class="pillar-num">2</div>
                <h4 class="pillar-head">Validasi AI Berhasil</h4>
                <p class="pillar-text">Item <strong>Pensil Labubu</strong> membuktikan akurasi model LARIS Predict dengan realisasi <strong>ROI 48%</strong> hanya dalam tempo 14 hari peluncuran.</p>
            </div>

            <!-- PILLAR 3 -->
            <div class="pillar-box">
                <div class="pillar-num">3</div>
                <h4 class="pillar-head">Tindakan Bulan Depan</h4>
                <p class="pillar-text">Segera kurangi modal mati pada <span class="text-red font-bold">Tumbler Stainless</span> lewat diskon bundling gajian, lalu alihkan arus kas ke lini Kopi Arabica & Aksesoris Stationery.</p>
            </div>
        </div>

    </div>

</div>

@push('styles')
<style>
    .report-page {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .report-head-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .report-audit-tag {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.8px;
        color: #16A34A;
        margin-bottom: 2px;
    }

    .rep-main-title {
        font-family: 'Outfit', sans-serif;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .rep-sub-desc {
        font-size: 13px;
        color: var(--text-muted);
    }

    .report-head-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .period-selector {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        padding: 6px 14px;
        border-radius: 10px;
    }

    .p-lbl {
        font-size: 9px;
        font-weight: 700;
        color: var(--text-muted);
        display: block;
    }

    .p-date {
        font-size: 12px;
        font-weight: 700;
    }

    .month-pill {
        background: #F1F5F9;
        font-size: 12px;
        font-weight: 600;
        padding: 8px 14px;
        border-radius: 8px;
        color: var(--text-main);
    }

    /* 4 KPIS */
    .rep-kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    .rep-kpi-card {
        padding: 18px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 140px;
    }

    .rep-top-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .k-title {
        font-size: 10px;
        font-weight: 800;
        color: var(--text-muted);
        letter-spacing: 0.5px;
    }

    .badge-growth-green {
        background: #DCFCE7;
        color: #16A34A;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .badge-opp-count {
        background: #CCFF00;
        color: #000000;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .rep-big-num {
        font-family: 'Outfit', sans-serif;
        font-size: 30px;
        font-weight: 800;
        color: var(--text-main);
        margin: 6px 0;
    }

    .rep-big-num small {
        font-size: 14px;
        color: var(--text-muted);
    }

    .rep-foot-meta {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: var(--text-muted);
    }

    .mt-6 { margin-top: 6px; }

    /* CHARTS GRID */
    .rep-charts-grid {
        display: grid;
        grid-template-columns: 1.3fr 1fr;
        gap: 22px;
    }

    .chart-sec-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .chart-sec-title {
        font-size: 16px;
        font-weight: 700;
    }

    .chart-legends-group {
        display: flex;
        gap: 12px;
        font-size: 11px;
        color: var(--text-muted);
    }

    .d-black { width: 10px; height: 10px; background: #0F172A; display: inline-block; border-radius: 2px; }
    .d-green { width: 10px; height: 10px; background: #CCFF00; display: inline-block; border-radius: 2px; }

    /* WEEKLY BAR CHART */
    .weekly-bar-chart-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        align-items: flex-end;
        min-height: 160px;
        border-bottom: 1px solid #F1F5F9;
        padding-bottom: 16px;
        margin-bottom: 20px;
    }

    .bar-col-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }

    .bars-pair {
        display: flex;
        align-items: flex-end;
        gap: 6px;
    }

    .bar-gross {
        width: 28px;
        background: #0F172A;
        border-radius: 4px 4px 0 0;
    }

    .bar-net {
        width: 20px;
        background: #CCFF00;
        border-radius: 4px 4px 0 0;
    }

    .week-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-main);
    }

    .week-val {
        font-size: 10px;
        color: var(--text-muted);
    }

    /* CHANNELS */
    .channels-title {
        font-size: 10px;
        font-weight: 800;
        color: var(--text-muted);
        letter-spacing: 0.5px;
        margin-bottom: 12px;
    }

    .channels-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .ch-card {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 12px;
    }

    .ch-top {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 6px;
    }

    .ch-pct {
        font-weight: 800;
        color: #16A34A;
    }

    .ch-revenue {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-main);
    }

    /* DONUT CHART */
    .donut-chart-container {
        display: flex;
        justify-content: center;
        margin: 10px 0 20px 0;
    }

    .donut-circle-visual {
        position: relative;
        width: 170px;
        height: 170px;
    }

    .donut-svg {
        transform: rotate(-90deg);
        width: 100%;
        height: 100%;
    }

    .donut-center-text {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .d-center-num {
        font-family: 'Outfit', sans-serif;
        font-size: 18px;
        font-weight: 800;
        color: var(--text-main);
    }

    .d-center-lbl {
        font-size: 10px;
        color: var(--text-muted);
    }

    .sku-legend-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .sku-leg-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
        border-bottom: 1px solid #F8FAFC;
    }

    .dot-black { width: 10px; height: 10px; background: #0F172A; border-radius: 50%; display: inline-block; }
    .dot-lime { width: 10px; height: 10px; background: #CCFF00; border-radius: 50%; display: inline-block; }
    .dot-red { width: 10px; height: 10px; background: #DC2626; border-radius: 50%; display: inline-block; }
    .dot-gray { width: 10px; height: 10px; background: #94A3B8; border-radius: 50%; display: inline-block; }

    .sku-name {
        font-size: 12px;
        display: block;
    }

    .sku-role {
        font-size: 10px;
        color: var(--text-muted);
    }

    .sku-right-meta {
        text-align: right;
    }

    .sku-rev {
        font-size: 12px;
        font-weight: 700;
        display: block;
    }

    .sku-pct {
        font-size: 10px;
        color: var(--text-muted);
    }

    .badge-dead-stock {
        background: #FEE2E2;
        color: #DC2626;
        font-size: 9px;
        font-weight: 800;
        padding: 1px 5px;
        border-radius: 4px;
    }

    /* EXECUTIVE SUMMARY */
    .executive-summary-card {
        background: #F8FAF9;
        border: 1px solid #E2E8F0;
        padding: 24px;
    }

    .exec-head-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .exec-title-group {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .exec-ai-icon {
        width: 40px;
        height: 40px;
        background: #0B1215;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .exec-title {
        font-size: 16px;
        font-weight: 700;
    }

    .badge-ai-v {
        background: #CCFF00;
        color: #000000;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 10px;
    }

    .exec-head-btns {
        display: flex;
        gap: 10px;
    }

    .exec-pillars-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .pillar-box {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 16px;
    }

    .pillar-num {
        width: 24px;
        height: 24px;
        background: #CCFF00;
        color: #000000;
        font-weight: 800;
        font-size: 12px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .pillar-head {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 6px;
    }

    .pillar-text {
        font-size: 11px;
        color: var(--text-muted);
        line-height: 1.5;
    }

    .font-bold { font-weight: 700; }

    @media (max-width: 1200px) {
        .rep-kpi-grid { grid-template-columns: repeat(2, 1fr); }
        .rep-charts-grid { grid-template-columns: 1fr; }
        .exec-pillars-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush
@endsection
