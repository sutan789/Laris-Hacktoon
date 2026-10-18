@extends('layouts.app', ['title' => 'Laporan Bisnis Bulanan - Audit Performa Gerai'])

@section('content')
<div class="report-page">

    <!-- 1. GLOSSY HEADER BAR -->
    <div class="dash-header">
        <div class="header-main-info">
            <div class="greeting-row">
                <h1 class="page-greeting">Laporan <span class="store-gradient-name">Bisnis Bulanan</span></h1>
                <span class="verified-store-badge">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="#10B981"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                    <span>Audit AI Terverifikasi</span>
                </span>
                <span class="live-status-pill">
                    <span class="pulse-dot"></span>
                    <span>Sinkronisasi POS Realtime</span>
                </span>
            </div>
            <p class="page-subtitle">Laporan komprehensif performa laba bersih, perputaran stok, dan evaluasi efisiensi operasional gerai.</p>
        </div>

        <div class="dash-actions">
            <div class="btn-timeframe-glossy" style="cursor: default;">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                <span>Periode: September 2026</span>
            </div>

            <a href="{{ route('report.whatsapp') }}" target="_blank" class="btn-download-glossy" style="background: #10B981; text-decoration: none; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a.75.75 0 0 1-.974-.944 6.345 6.345 0 0 0 .806-2.91C3.844 15.68 3 13.93 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/></svg>
                <span>Kirim Ringkasan WA</span>
            </a>

            <button type="button" class="btn-download-glossy" onclick="openExportModal()" style="cursor: pointer;">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                <span>Unduh Lengkap (PDF/Excel/CSV/TXT)</span>
            </button>
        </div>
    </div>

    <!-- 2. TOP 4 EXECUTIVE KPI CARDS -->
    <div class="kpi-grid">
        <!-- METRIC 1: REVENUE -->
        <div class="kpi-card card-glossy">
            <div class="kpi-top">
                <span class="kpi-title">Total Penjualan (Revenue)</span>
                <span class="kpi-badge badge-mint">+18% MoM</span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val">Rp 12,4 Juta</h2>
            </div>
            <div class="kpi-status-foot">
                <span class="dot-green"></span>
                <span>Target: Rp 10,5 Juta (118% Tercapai)</span>
            </div>
            <div class="kpi-progress-bar"><div class="progress-fill" style="width: 100%;"></div></div>
        </div>

        <!-- METRIC 2: NET PROFIT -->
        <div class="kpi-card card-glossy">
            <div class="kpi-top">
                <span class="kpi-title">Laba Bersih Riil</span>
                <span class="kpi-badge badge-blue">Margin 42.7%</span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val text-green">Rp 5,3 Juta</h2>
            </div>
            <div class="kpi-status-foot">
                <span class="dot-green"></span>
                <span>Kondisi Sangat Sehat (+4.2% MoM)</span>
            </div>
            <div class="kpi-progress-bar"><div class="progress-fill" style="width: 75%;"></div></div>
        </div>

        <!-- METRIC 3: OPEX -->
        <div class="kpi-card card-glossy">
            <div class="kpi-top">
                <span class="kpi-title">Beban Operasional Toko</span>
                <span class="kpi-badge badge-slate">-3% Efisien</span>
            </div>
            <div class="kpi-value-row">
                <h2 class="kpi-val">Rp 7,1 Juta</h2>
            </div>
            <div class="kpi-status-foot">
                <span>Rasio Opex/Revenue: 57.2% (Terkontrol)</span>
            </div>
            <div class="kpi-progress-bar"><div class="progress-fill" style="width: 57%; background: #64748B;"></div></div>
        </div>

        <!-- METRIC 4: EFFICIENCY SCORE -->
        <div class="kpi-card card-glossy">
            <div class="kpi-top">
                <span class="kpi-title">Skor Efisiensi Operasional</span>
                <span class="kpi-badge badge-lime">AI Radar</span>
            </div>
            <div class="kpi-value-row">
                <div class="score-display">
                    <span class="score-val">84</span>
                    <span class="score-max">/ 100</span>
                </div>
            </div>
            <div class="kpi-status-foot">
                <span class="dot-lime"></span>
                <span>91.4% Target Prediksi Terpenuhi</span>
            </div>
            <div class="kpi-progress-bar"><div class="progress-fill" style="width: 84%; background: #10B981;"></div></div>
        </div>
    </div>

    <!-- 3. MAIN TWO COLUMN CHARTS & BREAKDOWNS -->
    <div class="dash-columns">
        
        <!-- KOLOM KIRI: PERTUMBUHAN MINGGUAN & SALURAN -->
        <div class="col-left">
            <div class="card-panel mb-24">
                <div class="panel-header">
                    <div>
                        <h3 class="panel-title">Pertumbuhan Omzet &amp; Laba Mingguan</h3>
                        <p class="panel-subtitle">Perputaran kas mingguan sepanjang bulan September 2026</p>
                    </div>
                    <div class="chart-legend">
                        <span class="leg-item"><span class="line-black"></span> Omzet</span>
                        <span class="leg-item"><span class="line-green-dash"></span> Laba Bersih</span>
                    </div>
                </div>

                <!-- WEEKLY BAR CHART -->
                <div class="weekly-bar-chart-glossy">
                    <div class="bar-col-item">
                        <div class="bars-pair">
                            <div class="bar-gross" style="height: 65px;" title="Omzet Rp 2,4 Juta"></div>
                            <div class="bar-net" style="height: 30px;" title="Laba Rp 1,0 Juta"></div>
                        </div>
                        <span class="week-label">Minggu 1</span>
                        <span class="week-val">Rp 2,4 Juta</span>
                    </div>

                    <div class="bar-col-item">
                        <div class="bars-pair">
                            <div class="bar-gross" style="height: 80px;" title="Omzet Rp 2,9 Juta"></div>
                            <div class="bar-net" style="height: 40px;" title="Laba Rp 1,3 Juta"></div>
                        </div>
                        <span class="week-label">Minggu 2</span>
                        <span class="week-val">Rp 2,9 Juta</span>
                    </div>

                    <div class="bar-col-item">
                        <div class="bars-pair">
                            <div class="bar-gross" style="height: 95px;" title="Omzet Rp 3,3 Juta"></div>
                            <div class="bar-net" style="height: 50px;" title="Laba Rp 1,5 Juta"></div>
                        </div>
                        <span class="week-label">Minggu 3</span>
                        <span class="week-val">Rp 3,3 Juta</span>
                    </div>

                    <div class="bar-col-item">
                        <div class="bars-pair">
                            <div class="bar-gross" style="height: 115px;" title="Omzet Rp 3,8 Juta"></div>
                            <div class="bar-net" style="height: 60px;" title="Laba Rp 1,8 Juta"></div>
                        </div>
                        <span class="week-label">Minggu 4</span>
                        <span class="week-val text-green" style="font-weight: 800;">Rp 3,8 Juta</span>
                    </div>
                </div>

                <!-- DISTRIBUSI SALURAN PENJUALAN -->
                <div class="channels-breakdown-section mt-20">
                    <h4 class="channels-title">Kontribusi Saluran Penjualan (Sales Channels)</h4>
                    <div class="channels-cards-grid mt-10">
                        <div class="op-alert-card-glossy">
                            <div class="alert-card-top">
                                <span class="c-name">Shopee Official</span>
                                <span class="badge-mint">45%</span>
                            </div>
                            <h4 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 4px 0 0 0;">Rp 5,58 Juta</h4>
                        </div>

                        <div class="op-alert-card-glossy">
                            <div class="alert-card-top">
                                <span class="c-name">Tokopedia Store</span>
                                <span class="badge-blue">30%</span>
                            </div>
                            <h4 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 4px 0 0 0;">Rp 3,72 Juta</h4>
                        </div>

                        <div class="op-alert-card-glossy">
                            <div class="alert-card-top">
                                <span class="c-name">Kasir POS (Toko Fisik)</span>
                                <span class="badge-slate">25%</span>
                            </div>
                            <h4 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 4px 0 0 0;">Rp 3,10 Juta</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: PORTOFOLIO SKU PRODUK -->
        <div class="col-right">
            <div class="card-panel mb-24">
                <div class="panel-header">
                    <div>
                        <h3 class="panel-title">Struktur Portofolio Produk</h3>
                        <p class="panel-subtitle">Evaluasi item terlaris vs stok tertahan</p>
                    </div>
                    <span class="tag-pill-glossy">AUDIT SKU</span>
                </div>

                <div class="sku-legend-list">
                    <!-- CHAMPION ITEM -->
                    <div class="op-alert-card-glossy" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <div class="flex-align gap-10">
                            <div class="panel-icon-circle" style="width: 32px; height: 32px; background: #DCFCE7; color: #10B981;">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            </div>
                            <div>
                                <strong style="font-size: 13.5px; color: #0F172A;">Kopi Arabica Gayo</strong>
                                <span style="display: block; font-size: 11px; color: #10B981; font-weight: 700;">Produk Terlaris (Champion)</span>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <strong style="font-size: 14px; color: #0F172A;">Rp 4,2 Juta</strong>
                            <span style="display: block; font-size: 11px; color: #64748B;">Kontribusi 34%</span>
                        </div>
                    </div>

                    <!-- VIRAL ITEM -->
                    <div class="op-alert-card-glossy" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <div class="flex-align gap-10">
                            <div class="panel-icon-circle" style="width: 32px; height: 32px; background: rgba(204, 255, 0, 0.15); color: #15803D;">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/></svg>
                            </div>
                            <div>
                                <strong style="font-size: 13.5px; color: #0F172A;">Pensil Labubu Blind Box</strong>
                                <span style="display: block; font-size: 11px; color: #15803D; font-weight: 700;">Fast Moving Viral Item</span>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <strong style="font-size: 14px; color: #0F172A;">Rp 3,1 Juta</strong>
                            <span style="display: block; font-size: 11px; color: #64748B;">Kontribusi 25%</span>
                        </div>
                    </div>

                    <!-- DEAD STOCK ITEM -->
                    <div class="op-alert-card-glossy" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; border-color: rgba(239, 68, 68, 0.3);">
                        <div class="flex-align gap-10">
                            <div class="panel-icon-circle" style="width: 32px; height: 32px; background: #FEE2E2; color: #DC2626;">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/></svg>
                            </div>
                            <div>
                                <strong style="font-size: 13.5px; color: #991B1B;">Tumbler Stainless 500ml</strong>
                                <span style="display: block; font-size: 11px; color: #DC2626; font-weight: 700;">45 Hari Tanpa Penjualan</span>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <strong style="font-size: 14px; color: #DC2626;">Rp 1,8 Juta Tertahan</strong>
                            <span class="badge-danger-glossy" style="padding: 1px 6px; font-size: 10px;">Dead Stock</span>
                        </div>
                    </div>

                    <!-- ACCESSORIES GROWTH -->
                    <div class="op-alert-card-glossy" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="flex-align gap-10">
                            <div class="panel-icon-circle" style="width: 32px; height: 32px; background: #E0F2FE; color: #0369A1;">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"/></svg>
                            </div>
                            <div>
                                <strong style="font-size: 13.5px; color: #0F172A;">Aksesoris Stationery</strong>
                                <span style="display: block; font-size: 11px; color: #0369A1; font-weight: 700;">Potensi Margin Naik</span>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <strong style="font-size: 14px; color: #0F172A;">Rp 2,4 Juta</strong>
                            <span style="display: block; font-size: 11px; color: #10B981; font-weight: 700;">+38% Estimasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- 4. RINGKASAN EVALUASI EKSEKUTIF LARIS (BOTTOM CARD) -->
    <div class="card-panel">
        <div class="panel-header">
            <div class="panel-title-group">
                <div class="panel-icon-circle">
                    <svg width="18" height="18" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>
                </div>
                <div>
                    <h3 class="panel-title">Rekomendasi Tindakan Strategis Bulan Depan</h3>
                    <p class="panel-subtitle">Saran otomatis berbasis data pembelajaran mesin untuk memaksimalkan arus kas toko</p>
                </div>
            </div>
            <a href="{{ url('/juragan-ai') }}" class="btn-timeframe-glossy" style="text-decoration: none;">
                <span>Konsultasi Juragan AI &rarr;</span>
            </a>
        </div>

        <div class="exec-pillars-grid">
            <div class="pillar-box-glossy">
                <div class="pillar-num-badge">1</div>
                <h4 class="pillar-head">Target Penjualan Tercapai</h4>
                <p class="pillar-text">Omzet melampaui target awal sebesar Rp 10,5 Juta berkat lonjakan penjualan online di minggu ke-4. Pertahankan stok kopi dan camilan.</p>
            </div>

            <div class="pillar-box-glossy">
                <div class="pillar-num-badge">2</div>
                <h4 class="pillar-head">Validasi Prediksi AI Terbukti</h4>
                <p class="pillar-text">Item <strong>Pensil Labubu Blind Box</strong> membuktikan akurasi simulasi LARIS Predict dengan realisasi ROI 48% dalam 14 hari pertama.</p>
            </div>

            <div class="pillar-box-glossy">
                <div class="pillar-num-badge">3</div>
                <h4 class="pillar-head">Likuidasi Modal Mati Segera</h4>
                <p class="pillar-text">Segera diskon bundling <strong>Tumbler Stainless</strong> saat gajian untuk mencairkan Rp 1,8 Juta modal tertahan menjadi arus kas aktif.</p>
            </div>
        </div>
    </div>

    <!-- MODAL PILIH FORMAT EKSPOR LAPORAN BISNIS (GLOSSY & MEWAH) -->
    <div id="modal-export-report" style="display: none; position: fixed; inset: 0; background: rgba(11, 19, 27, 0.75); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: #FFFFFF; border-radius: 20px; width: 100%; max-width: 680px; box-shadow: 0 25px 60px rgba(0,0,0,0.3); border: 1px solid #E2E8F0; overflow: hidden;">
            
            <div style="background: linear-gradient(135deg, #0B131B, #1E293B); padding: 22px 26px; color: #FFFFFF; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(16, 185, 129, 0.2); border: 1px solid #10B981; display: flex; align-items: center; justify-content: center; color: #10B981;">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                    </div>
                    <div>
                        <h3 style="font-size: 16px; font-weight: 800; margin: 0; color: #FFFFFF;">Ekspor Laporan Bisnis &amp; Audit</h3>
                        <p style="font-size: 12px; color: #94A3B8; margin: 2px 0 0 0;">Pilih format berkas yang Anda butuhkan</p>
                    </div>
                </div>
                <button type="button" onclick="closeExportModal()" style="background: rgba(255, 255, 255, 0.1); border: none; color: #94A3B8; width: 32px; height: 32px; border-radius: 8px; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center;">&times;</button>
            </div>

            <div style="padding: 22px 26px; display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                
                <!-- FORMAT 1: PDF -->
                <a href="{{ route('report.export', ['format' => 'pdf']) }}" style="text-decoration: none; display: flex; flex-direction: column; justify-content: space-between; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px; background: #F8FAFC; transition: all 0.2s;" onmouseover="this.style.borderColor='#EF4444'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#E2E8F0'; this.style.transform='none'">
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: #FEE2E2; color: #DC2626; display: flex; align-items: center; justify-content: center;">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                            </div>
                            <span style="font-size: 10px; font-weight: 800; background: #FEE2E2; color: #DC2626; padding: 2px 7px; border-radius: 6px;">RESMI &amp; CETAK</span>
                        </div>
                        <h4 style="font-size: 13.5px; font-weight: 800; color: #0F172A; margin: 0 0 4px 0;">Dokumen PDF Resmi</h4>
                        <p style="font-size: 11.5px; color: #64748B; margin: 0; line-height: 1.4;">Laporan siap cetak &amp; simpan PDF lengkap dengan kop, evaluasi margin &amp; cap audit AI.</p>
                    </div>
                    <div style="margin-top: 12px; font-size: 12px; font-weight: 800; color: #DC2626; display: flex; align-items: center; gap: 4px;">
                        <span>Buka / Cetak PDF</span> &rarr;
                    </div>
                </a>

                <!-- FORMAT 2: EXCEL -->
                <a href="{{ route('report.export', ['format' => 'excel']) }}" style="text-decoration: none; display: flex; flex-direction: column; justify-content: space-between; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px; background: #F8FAFC; transition: all 0.2s;" onmouseover="this.style.borderColor='#10B981'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#E2E8F0'; this.style.transform='none'">
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: #D1FAE5; color: #059669; display: flex; align-items: center; justify-content: center;">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                            </div>
                            <span style="font-size: 10px; font-weight: 800; background: #D1FAE5; color: #059669; padding: 2px 7px; border-radius: 6px;">SPREADSHEET</span>
                        </div>
                        <h4 style="font-size: 13.5px; font-weight: 800; color: #0F172A; margin: 0 0 4px 0;">Microsoft Excel (.xls)</h4>
                        <p style="font-size: 11.5px; color: #64748B; margin: 0; line-height: 1.4;">Spreadsheet komprehensif dengan rumus finansial, HPP, margin &amp; stok gudang.</p>
                    </div>
                    <div style="margin-top: 12px; font-size: 12px; font-weight: 800; color: #059669; display: flex; align-items: center; gap: 4px;">
                        <span>Unduh Excel (.xls)</span> &rarr;
                    </div>
                </a>

                <!-- FORMAT 3: CSV -->
                <a href="{{ route('report.export', ['format' => 'csv']) }}" style="text-decoration: none; display: flex; flex-direction: column; justify-content: space-between; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px; background: #F8FAFC; transition: all 0.2s;" onmouseover="this.style.borderColor='#3B82F6'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#E2E8F0'; this.style.transform='none'">
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: #DBEAFE; color: #2563EB; display: flex; align-items: center; justify-content: center;">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/></svg>
                            </div>
                            <span style="font-size: 10px; font-weight: 800; background: #DBEAFE; color: #2563EB; padding: 2px 7px; border-radius: 6px;">RFC 4180 / UTF-8</span>
                        </div>
                        <h4 style="font-size: 13.5px; font-weight: 800; color: #0F172A; margin: 0 0 4px 0;">Format CSV Mentah</h4>
                        <p style="font-size: 11.5px; color: #64748B; margin: 0; line-height: 1.4;">File CSV standar dengan UTF-8 BOM untuk integrasi ke software akuntansi.</p>
                    </div>
                    <div style="margin-top: 12px; font-size: 12px; font-weight: 800; color: #2563EB; display: flex; align-items: center; gap: 4px;">
                        <span>Unduh CSV</span> &rarr;
                    </div>
                </a>

                <!-- FORMAT 4: TXT -->
                <a href="{{ route('report.export', ['format' => 'txt']) }}" style="text-decoration: none; display: flex; flex-direction: column; justify-content: space-between; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px; background: #F8FAFC; transition: all 0.2s;" onmouseover="this.style.borderColor='#64748B'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#E2E8F0'; this.style.transform='none'">
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: #F1F5F9; color: #475569; display: flex; align-items: center; justify-content: center;">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                            </div>
                            <span style="font-size: 10px; font-weight: 800; background: #F1F5F9; color: #475569; padding: 2px 7px; border-radius: 6px;">RINGKAS &amp; CEPAT</span>
                        </div>
                        <h4 style="font-size: 13.5px; font-weight: 800; color: #0F172A; margin: 0 0 4px 0;">Dokumen TXT Monospace</h4>
                        <p style="font-size: 11.5px; color: #64748B; margin: 0; line-height: 1.4;">Salinan teks ringkas dengan tabel ASCII untuk memo cepat di ponsel.</p>
                    </div>
                    <div style="margin-top: 12px; font-size: 12px; font-weight: 800; color: #475569; display: flex; align-items: center; gap: 4px;">
                        <span>Unduh Dokumen TXT</span> &rarr;
                    </div>
                </a>

            </div>

            <div style="background: #F8FAFC; border-top: 1px solid #E2E8F0; padding: 12px 26px; display: flex; align-items: center; justify-content: space-between;">
                <span style="font-size: 11.5px; color: #64748B;">Divalidasi otomatis oleh <strong>Juragan AI v3.8</strong></span>
                <button type="button" onclick="closeExportModal()" style="background: #0F172A; color: #FFFFFF; border: none; padding: 7px 16px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer;">Tutup</button>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    function openExportModal() {
        document.getElementById('modal-export-report').style.display = 'flex';
    }
    function closeExportModal() {
        document.getElementById('modal-export-report').style.display = 'none';
    }
</script>
@endpush
@endsection

@push('styles')
<style>
    .report-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    /* Weekly Bar Chart */
    .weekly-bar-chart-glossy {
        display: flex;
        justify-content: space-around;
        align-items: flex-end;
        height: 180px;
        padding: 20px 0 10px 0;
        border-bottom: 1px solid #F1F5F9;
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
        height: 130px;
    }

    .bar-gross {
        width: 18px;
        background: #0B131B;
        border-radius: 6px 6px 0 0;
        transition: height 0.5s ease;
    }

    .bar-net {
        width: 18px;
        background: #10B981;
        border-radius: 6px 6px 0 0;
        transition: height 0.5s ease;
    }

    .week-label {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--text-main);
    }

    .week-val {
        font-size: 11px;
        color: var(--text-muted);
    }

    .channels-title {
        font-size: 12.5px;
        font-weight: 800;
        color: var(--text-main);
    }

    .channels-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    /* Pillars Grid */
    .exec-pillars-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .pillar-box-glossy {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 16px;
        position: relative;
    }

    .pillar-num-badge {
        width: 24px;
        height: 24px;
        border-radius: 8px;
        background: #0B131B;
        color: #CCFF00;
        font-size: 11.5px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .pillar-head {
        font-size: 13px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 4px;
    }

    .pillar-text {
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.45;
        margin: 0;
    }

    @media (max-width: 1024px) {
        .dash-columns { grid-template-columns: 1fr; }
        .channels-cards-grid { grid-template-columns: 1fr; }
        .exec-pillars-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush
