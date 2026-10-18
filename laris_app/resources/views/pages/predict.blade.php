@extends('layouts.app', ['title' => 'LARIS Predict - Analisis & Prediksi Kelayakan Produk'])

@section('content')
<div class="predict-page">

    <!-- 1. GLOSSY HEADER BAR -->
    <div class="dash-header">
        <div class="header-main-info">
            <div class="greeting-row">
                <h1 class="page-greeting">LARIS <span class="store-gradient-name">Predict</span></h1>
                <span class="verified-store-badge">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="#10B981"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                    <span>Analisis Presisi</span>
                </span>
                <span class="live-status-pill">
                    <span class="pulse-dot"></span>
                    <span>AI Model v3.8 (Real-time Market Sync)</span>
                </span>
            </div>
            <p class="page-subtitle">Analisis kelayakan permintaan pasar, proyeksi margin laba, dan estimasi titik impas produk baru sebelum belanja modal stok.</p>
        </div>

        <div class="dash-actions">
            <button type="button" class="btn-timeframe-glossy" onclick="resetForm()">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                <span>Reset Parameter</span>
            </button>
            <button type="button" class="btn-timeframe-glossy" onclick="openHistoryModal()">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/></svg>
                <span>Riwayat Skenario ({{ isset($historyPredictions) ? $historyPredictions->count() : 0 }})</span>
            </button>
        </div>
    </div>

    <!-- 2. AI INSIGHT CAPSULE (GLOSSY & MEWAH) -->
    <div class="instant-insight-banner">
        <div class="insight-left">
            <div class="ai-gem-icon">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/></svg>
            </div>
            <div class="insight-text">
                <div class="insight-tag">ANALISIS PASAR SEKITAR TOKO</div>
                <p>Permintaan produk pop-culture stationery di area tokomu naik <strong>+142%</strong> pekan ini. Gunakan simulator di bawah untuk mengukur proyeksi laba bersih dan titik impas (BEP).</p>
            </div>
        </div>
        <div class="insight-badge-pill">
            <span class="dot-green"></span>
            <span>Akurasi Prediksi 91.4%</span>
        </div>
    </div>

    <!-- 3. MAIN TWO-COLUMN SIMULATOR LAYOUT -->
    <div class="dash-columns">
        
        <!-- KOLOM KIRI: FORM PARAMETER PRODUK BARU -->
        <div class="col-left">
            <div class="card-panel mb-24">
                <div class="panel-header">
                    <div class="panel-title-group">
                        <div class="panel-icon-circle">
                            <svg width="18" height="18" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/></svg>
                        </div>
                        <div>
                            <h3 class="panel-title">Parameter Produk Baru</h3>
                            <p class="panel-subtitle">Masukkan rencana modal dan target harga jual produk</p>
                        </div>
                    </div>
                    <span class="tag-pill-glossy">LANGKAH 1/2</span>
                </div>

                <!-- PRESET CEPAT TREN VIRAL -->
                <div class="preset-strip-wrap mb-16">
                    <span class="preset-label">Uji Cepat Produk Tren Viral:</span>
                    <div class="preset-chips-scroll">
                        <button type="button" class="preset-chip active" onclick="selectPreset('Pensil Labubu Blind Box', 'Stationery & Giftware (Pop Culture)', 22000, 35000, 'https://images.unsplash.com/photo-1563245372-f21724e3856d?w=300&auto=format&fit=crop&q=80', this)">
                            <span>Labubu Blind Box</span>
                        </button>
                        <button type="button" class="preset-chip" onclick="selectPreset('Kopi Drip Bag Specialty Arabika', 'Kopi & Minuman Kemasan', 16000, 28000, 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=300&auto=format&fit=crop&q=80', this)">
                            <span>Kopi Drip Bag</span>
                        </button>
                        <button type="button" class="preset-chip" onclick="selectPreset('Tumbler Pastel Stainless 1200ml', 'Aksesoris & Lifestyle', 48000, 79000, 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?w=300&auto=format&fit=crop&q=80', this)">
                            <span>Tumbler Pastel</span>
                        </button>
                        <button type="button" class="preset-chip" onclick="selectPreset('Kabel Fast Charging 65W Braided', 'Aksesoris & Lifestyle', 18000, 35000, 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=300&auto=format&fit=crop&q=80', this)">
                            <span>Kabel Fast Charge</span>
                        </button>
                        <button type="button" class="preset-chip" onclick="selectPreset('Beras Pandan Wangi Super 5kg', 'Kebutuhan Pokok / Sembako', 68000, 78000, 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=300&auto=format&fit=crop&q=80', this)">
                            <span>Beras Pandan Super</span>
                        </button>
                        <button type="button" class="preset-chip" onclick="selectPreset('Paket Ayam Geprek Sambal Korek', 'Kuliner & F&B', 14000, 22000, 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=300&auto=format&fit=crop&q=80', this)">
                            <span>Ayam Geprek Korek</span>
                        </button>
                    </div>
                </div>

                <!-- AI VISUAL TREND LENS & UPLOAD GAMBAR PRODUK -->
                <div class="visual-lens-card mb-20" style="background: linear-gradient(135deg, #0B131B 0%, #162432 100%); border: 1px solid rgba(16, 185, 129, 0.4); border-radius: 16px; padding: 18px 20px; color: #FFFFFF; position: relative; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(16, 185, 129, 0.2); display: flex; align-items: center; justify-content: center; color: #34D399;">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h4 style="font-size: 13.5px; font-weight: 800; color: #FFFFFF; margin: 0;">AI Visual Trend Lens</h4>
                                <p style="font-size: 11px; color: #94A3B8; margin: 0;">Unggah foto produk atau tempel URL untuk deteksi otomatis radar tren &amp; HPP</p>
                            </div>
                        </div>
                        <span style="font-size: 10px; font-weight: 800; background: rgba(52, 211, 153, 0.2); color: #34D399; padding: 4px 10px; border-radius: 20px; border: 1px solid rgba(52, 211, 153, 0.3);">LENS ACTIVE</span>
                    </div>

                    <!-- Upload Dropzone / URL Input -->
                    <div style="display: grid; grid-template-columns: 1fr auto; gap: 10px; align-items: center;">
                        <input type="file" id="visualLensFileInput" accept="image/*" style="display: none;" onchange="handleVisualLensUpload(event)">
                        <button type="button" onclick="document.getElementById('visualLensFileInput').click()" style="background: rgba(255, 255, 255, 0.08); border: 1px dashed rgba(52, 211, 153, 0.5); border-radius: 10px; padding: 10px 14px; color: #E2E8F0; font-size: 12px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                            <svg width="16" height="16" fill="none" stroke="#34D399" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            <span id="lensUploadBtnText">Pilih Foto Produk / Drag File Disini</span>
                        </button>
                        <button type="button" onclick="promptImageUrl()" style="background: #10B981; color: #0B131B; border: none; border-radius: 10px; padding: 10px 14px; font-size: 12px; font-weight: 800; cursor: pointer; white-space: nowrap;">
                            + Tempel URL Foto
                        </button>
                    </div>

                    <!-- Live Scanner Result Container -->
                    <div id="lensResultBox" style="display: none; margin-top: 12px; padding: 12px; background: rgba(0, 0, 0, 0.35); border-radius: 10px; border: 1px solid rgba(52, 211, 153, 0.25);">
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <img id="lensPreviewImg" src="" alt="Preview" style="width: 48px; height: 48px; border-radius: 8px; object-fit: cover; border: 1px solid #34D399;">
                            <div style="flex: 1; min-width: 0;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <strong id="lensDetectedName" style="font-size: 13px; color: #CCFF00; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">-</strong>
                                    <span id="lensDetectedRadar" style="font-size: 10px; background: rgba(16, 185, 129, 0.3); color: #34D399; padding: 2px 8px; border-radius: 6px; font-weight: 700;">Radar Match</span>
                                </div>
                                <div id="lensDetectedDesc" style="font-size: 11px; color: #CBD5E1; margin-top: 2px; line-height: 1.3;">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="predictForm" onsubmit="event.preventDefault(); runPrediction();">
                    <!-- NAMA PRODUK DENGAN THUMBNAIL DINAMIS -->
                    <div class="form-group-glossy">
                        <label for="productName" class="form-label-glossy">Nama Produk Rencana</label>
                        <div class="input-with-thumb-wrap">
                            <div class="form-input-thumb-box">
                                <img id="formThumbImg" src="{{ $prefill['image_url'] ?? 'https://images.unsplash.com/photo-1563245372-f21724e3856d?w=100&auto=format&fit=crop&q=80' }}" alt="Thumb" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=100&auto=format&fit=crop&q=80';">
                            </div>
                            <input type="text" id="productName" class="input-field-glossy input-with-thumb" value="{{ $prefill['product_name'] ?? 'Pensil Labubu Blind Box' }}" placeholder="Contoh: Kopi Susu Aren Literan" required oninput="handleProductNameChange()">
                        </div>
                    </div>

                    <!-- KATEGORI TREN PASAR -->
                    <div class="form-group-glossy">
                        <label for="categorySelect" class="form-label-glossy">Kategori Tren Pasar</label>
                        <select id="categorySelect" class="select-field-glossy" onchange="handleCategoryChange()">
                            <option {{ ($prefill['category'] ?? '') === 'Stationery & Giftware (Pop Culture)' || ($prefill['category'] ?? '') === 'Stationery & Giftware' ? 'selected' : '' }}>Stationery & Giftware (Pop Culture)</option>
                            <option {{ ($prefill['category'] ?? '') === 'Kopi & Minuman Kemasan' ? 'selected' : '' }}>Kopi & Minuman Kemasan</option>
                            <option {{ ($prefill['category'] ?? '') === 'Kebutuhan Pokok / Sembako' ? 'selected' : '' }}>Kebutuhan Pokok / Sembako</option>
                            <option {{ ($prefill['category'] ?? '') === 'Aksesoris & Lifestyle' ? 'selected' : '' }}>Aksesoris & Lifestyle</option>
                            <option {{ ($prefill['category'] ?? '') === 'Fashion & Pakaian' ? 'selected' : '' }}>Fashion & Pakaian</option>
                            <option {{ ($prefill['category'] ?? '') === 'Kuliner & F&B' ? 'selected' : '' }}>Kuliner & F&B</option>
                        </select>
                    </div>

                    <!-- INPUT HARGA MODAL & HARGA JUAL -->
                    <div class="form-row-2col">
                        <div class="form-group-glossy">
                            <label for="costPrice" class="form-label-glossy">Modal / HPP (Rp)</label>
                            <input type="number" id="costPrice" class="input-field-glossy" value="{{ $prefill['cost_price'] ?? 22000 }}" oninput="calculateMargin()">
                        </div>
                        <div class="form-group-glossy">
                            <label for="sellPrice" class="form-label-glossy">Harga Jual Target (Rp)</label>
                            <input type="number" id="sellPrice" class="input-field-glossy" value="{{ $prefill['selling_price'] ?? 35000 }}" oninput="calculateMargin()">
                        </div>
                    </div>

                    <!-- GROSS MARGIN BOX AUTO CALC -->
                    <div class="gross-margin-card-glossy">
                        <div class="gm-left">
                            <div class="gm-icon-circle">%</div>
                            <div>
                                <span class="gm-label">Estimasi Gross Margin</span>
                                <span class="gm-sub" id="profitPerUnit">Keuntungan per unit: Rp 13.000</span>
                            </div>
                        </div>
                        <span class="gm-pct-pill" id="marginBadge">37.1%</span>
                    </div>

                    <!-- RENCANA STOK AWAL -->
                    <div class="form-group-glossy mt-16">
                        <div class="label-flex-between">
                            <label class="form-label-glossy">Rencana Pembelian Stok Awal</label>
                            <span class="stock-active-badge" id="batchDisplay">50 Pcs</span>
                        </div>
                        <div class="stock-chips-grid">
                            <button type="button" class="stock-chip-glossy" onclick="setBatch(10, '10 pcs (Trial)', this)">10 pcs (Trial)</button>
                            <button type="button" class="stock-chip-glossy active" onclick="setBatch(50, '50 pcs (Scale)', this)">50 pcs (Rekomendasi)</button>
                            <button type="button" class="stock-chip-glossy" onclick="setBatch(100, '100 pcs', this)">100 pcs</button>
                            <button type="button" class="stock-chip-glossy" onclick="setBatch(250, '250 pcs (Grosir)', this)">250 pcs (Grosir)</button>
                        </div>
                    </div>

                    <!-- CTA BUTTON -->
                    <button type="submit" class="btn-predict-cta">
                        <span>Uji Kelayakan dengan Juragan AI</span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                    </button>
                </form>
            </div>

            <!-- BENCHMARK KATEGORI SERUPA -->
            <div class="card-panel benchmark-card-glossy">
                <div class="bench-icon-circle">
                    <svg width="20" height="20" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                </div>
                <div>
                    <span class="bench-tag">BENCHMARK PRODUK SERUPA TERLARIS</span>
                    <h5 class="bench-name">Gantungan Kunci Karakter V1</h5>
                    <span class="bench-stat">Terjual <strong>94%</strong> dalam 14 hari pertama dengan kepuasan bintang 4.9.</span>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: HASIL PREDIKSI AI (GLOSSY & MEWAH) -->
        <div class="col-right">
            <div class="card-panel mb-24">
                
                <div class="panel-header">
                    <div>
                        <span class="tag-pill-glossy" style="margin-bottom: 6px; display: inline-block;">HASIL ANALISIS PREDIKSI AI</span>
                        <h3 class="panel-title">Skor Potensi Keberhasilan</h3>
                    </div>
                    <span class="confidence-pill-glossy">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                        <span>88.2% Confidence (Juragan AI)</span>
                    </span>
                </div>

                <!-- SHOWCASE KARTU PRODUK TERUJI DENGAN FOTO REAL -->
                <div class="product-preview-card-glossy">
                    <div class="prod-preview-thumb-box">
                        <img id="simProductImg" src="{{ $prefill['image_url'] ?? 'https://images.unsplash.com/photo-1563245372-f21724e3856d?w=300&auto=format&fit=crop&q=80' }}" alt="Preview Produk" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=300&auto=format&fit=crop&q=80';">
                        <span class="preview-badge-live">
                            <span class="pulse-dot"></span>
                            <span>Produk Teruji</span>
                        </span>
                    </div>
                    <div class="prod-preview-info">
                        <div class="preview-cat-row">
                            <span class="preview-cat-badge" id="simCategoryDisplay">{{ $prefill['category'] ?? 'Stationery & Giftware' }}</span>
                            <span class="preview-time-tag">Sinkronisasi Pasar Real-Time</span>
                        </div>
                        <h4 class="preview-prod-title" id="simProductNameDisplay">{{ $prefill['product_name'] ?? 'Pensil Labubu Blind Box' }}</h4>
                        <div class="preview-pricing-row">
                            <div class="pricing-pill">
                                <span class="pp-lbl">HPP Modal:</span>
                                <strong id="simCostDisplay">Rp {{ number_format($prefill['cost_price'] ?? 22000, 0, ',', '.') }}</strong>
                            </div>
                            <span class="pricing-arrow">&rarr;</span>
                            <div class="pricing-pill pill-accent">
                                <span class="pp-lbl">Target Jual:</span>
                                <strong id="simSellDisplay">Rp {{ number_format($prefill['selling_price'] ?? 35000, 0, ',', '.') }}</strong>
                            </div>
                            <div class="pricing-pill pill-margin">
                                <span class="pp-lbl">Margin:</span>
                                <strong id="simMarginDisplay">37.1%</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOP SCORE DISPLAY -->
                <div class="predict-score-banner">
                    <div class="score-left">
                        <div class="score-circle-glossy">
                            <span class="score-number" id="simScore">87</span>
                            <span class="score-total">/100</span>
                        </div>
                        <div>
                            <h4 class="score-status-title">Peluang Sangat Tinggi</h4>
                            <p class="score-status-desc">Risiko stok mati rendah, estimasi perputaran barang cepat di radius toko fisik Anda.</p>
                        </div>
                    </div>
                </div>

                <!-- FORECAST METRIC ROW -->
                <div class="forecast-two-grid">
                    <div class="f-box-glossy">
                        <span class="f-lbl">Estimasi Penjualan (14 Hari)</span>
                        <h4 class="f-val">38 - 50 <small>unit</small></h4>
                        <span class="f-sub text-green">Laju rata-rata 3 unit / hari</span>
                    </div>
                    <div class="f-box-glossy">
                        <span class="f-lbl">Proyeksi Laba Bersih</span>
                        <h4 class="f-val text-green" id="simProfit">Rp 650.000</h4>
                        <span class="f-sub">Dari total omzet Rp 1.750.000</span>
                    </div>
                </div>

                <!-- PROJECTION LINE CHART (SVG GLOSSY) -->
                <div class="proj-chart-card mt-16">
                    <div class="proj-head-flex">
                        <div>
                            <h4 class="proj-title">Proyeksi Titik Impas (BEP) 30 Hari</h4>
                            <p class="proj-sub">Estimasi titik balik modal tercapai pada hari ke-14</p>
                        </div>
                        <div class="chart-legend">
                            <span class="leg-item"><span class="line-black"></span> Omzet</span>
                            <span class="leg-item"><span class="line-green-dash"></span> Laba Bersih</span>
                        </div>
                    </div>

                    <div class="chart-canvas-container">
                        <svg viewBox="0 0 540 120" class="main-trend-svg">
                            <line x1="0" y1="30" x2="540" y2="30" stroke="#F1F5F9" stroke-width="1" />
                            <line x1="0" y1="70" x2="540" y2="70" stroke="#F1F5F9" stroke-width="1" />
                            <line x1="0" y1="105" x2="540" y2="105" stroke="#F1F5F9" stroke-width="1" />
                            
                            <!-- Shaded Profit Area -->
                            <polygon points="270,70 380,45 540,15 540,110 270,110" fill="rgba(16, 185, 129, 0.12)" />
                            
                            <!-- Curve Revenue -->
                            <path d="M 10 105 Q 180 80, 270 65 T 540 15" fill="none" stroke="#0F172A" stroke-width="3" />
                            
                            <!-- Curve Profit -->
                            <path d="M 10 115 Q 180 100, 270 70 T 540 35" fill="none" stroke="#10B981" stroke-width="3" stroke-dasharray="6,4" />
                            
                            <!-- BEP Point Marker -->
                            <circle cx="270" cy="65" r="5" fill="#CCFF00" stroke="#0F172A" stroke-width="2" />
                            <text x="260" y="52" font-size="9.5" font-weight="800" fill="#0F172A">Hari ke-14 (BEP)</text>
                        </svg>
                        <div class="chart-x-labels">
                            <span>Hari 1 (Mulai)</span>
                            <span>Hari 7</span>
                            <span class="active-today">Hari 14 (BEP)</span>
                            <span>Hari 21</span>
                            <span>Hari 30 (Laba Maks)</span>
                        </div>
                    </div>
                </div>

                <!-- KEY INSIGHTS LIST -->
                <div class="insights-container mt-16">
                    <h4 class="insights-title">Rekomendasi Strategis Juragan AI:</h4>
                    <div class="insights-list">
                        <div class="ins-item-glossy">
                            <div class="ins-bullet">1</div>
                            <div class="ins-content">
                                <strong>Permintaan Tinggi di Wilayah Sekitar Toko:</strong>
                                <p>Terdeteksi 4.200+ pencarian bulanan untuk kategori ini di radius 5 km dari toko fisik Anda, sementara penjual kompetitor lokal masih minim.</p>
                            </div>
                        </div>

                        <div class="ins-item-glossy">
                            <div class="ins-bullet">2</div>
                            <div class="ins-content">
                                <strong>Saran Bundling Produk:</strong>
                                <p>Padukan dengan produk pendukung untuk menaikkan rata-rata belanja konsumen (+25% omzet per transaksi).</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FOOTER BUTTONS -->
                <div class="result-action-footer mt-20">
                    <div class="foot-left-actions">
                        <button type="button" class="btn-timeframe-glossy" onclick="saveSimulationDraft()">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/></svg>
                            <span>Simpan Skenario</span>
                        </button>
                        <button type="button" class="btn-timeframe-glossy" onclick="exportSimulationReport()">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            <span>Unduh TXT</span>
                        </button>
                    </div>

                    <form action="{{ route('predict.add_to_inventory') }}" method="POST" style="margin: 0;">
                        @csrf
                        <input type="hidden" name="prediction_id" value="{{ $latestPrediction ? $latestPrediction->id : 1 }}">
                        <button type="submit" class="btn-download-glossy" style="background: #10B981; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            <span>Masukkan Rencana ke Gudang</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>

</div>

<!-- MODAL RIWAYAT SIMULASI GLOSSY -->
<div id="modal-predict-history" class="laris-modal-overlay" style="position: fixed; inset: 0; background: rgba(11, 19, 27, 0.65); backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; z-index: 999; padding: 20px;">
    <div class="card-panel" style="width: 100%; max-width: 560px; padding: 0; overflow: hidden; box-shadow: 0 24px 50px rgba(0, 0, 0, 0.3);">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 24px; background: #F8FAFC; border-bottom: 1px solid #E2E8F0;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div class="panel-icon-circle">
                    <svg width="18" height="18" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                </div>
                <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">Riwayat Simulasi Skenario</h3>
            </div>
            <button type="button" onclick="closeHistoryModal()" class="alert-close-btn">&times;</button>
        </div>
        <div style="padding: 20px; display: flex; flex-direction: column; gap: 12px; max-height: 400px; overflow-y: auto;">
            @if(isset($historyPredictions) && $historyPredictions->count() > 0)
                @foreach($historyPredictions as $hist)
                    @php
                        $histImg = $hist->image_url ?: \App\Http\Controllers\PredictController::resolveProductImage($hist->product_name, $hist->category);
                    @endphp
                    <div class="op-alert-card-glossy" style="display: flex; justify-content: space-between; align-items: center; gap: 12px;">
                        <div style="display: flex; align-items: center; gap: 12px; min-width: 0;">
                            <img src="{{ $histImg }}" alt="{{ $hist->product_name }}" style="width: 44px; height: 44px; border-radius: 10px; object-fit: cover; border: 1px solid #E2E8F0; flex-shrink: 0;" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=80&auto=format&fit=crop&q=80';">
                            <div style="min-width: 0;">
                                <strong style="font-size: 13.5px; color: #0F172A; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $hist->product_name }}</strong>
                                <div style="font-size: 11.5px; color: #64748B; margin-top: 2px;">
                                    HPP: Rp {{ number_format($hist->cost_price, 0, ',', '.') }} • Jual: Rp {{ number_format($hist->selling_price, 0, ',', '.') }} • Margin: {{ $hist->gross_margin_pct }}% • Skor AI: <span style="color: #10B981; font-weight: 800;">{{ $hist->opportunity_score }}/100</span>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-timeframe-glossy" style="flex-shrink: 0;" onclick="loadSimHistory('{{ addslashes($hist->product_name) }}', {{ $hist->cost_price }}, {{ $hist->selling_price }}, '{{ addslashes($hist->category) }}', '{{ $histImg }}')">Muat</button>
                    </div>
                @endforeach
            @else
                <div style="text-align: center; color: #64748B; font-size: 13px; padding: 24px 0;">
                    Belum ada riwayat skenario. Silakan jalankan simulasi pertama Anda di formulir sebelah kiri!
                </div>
            @endif
        </div>
        <div style="padding: 16px 24px; background: #F8FAFC; border-top: 1px solid #E2E8F0; display: flex; justify-content: flex-end;">
            <button type="button" class="btn-timeframe-glossy" onclick="closeHistoryModal()">Tutup</button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .predict-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    /* Preset Strip */
    .preset-strip-wrap {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 10px 14px;
    }

    .preset-label {
        font-size: 11px;
        font-weight: 800;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: block;
        margin-bottom: 8px;
    }

    .preset-chips-scroll {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 2px;
    }

    .preset-chips-scroll::-webkit-scrollbar {
        height: 4px;
    }
    .preset-chips-scroll::-webkit-scrollbar-thumb {
        background: #CBD5E1;
        border-radius: 4px;
    }

    .preset-chip {
        white-space: nowrap;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 5px 12px;
        font-size: 11.5px;
        font-weight: 700;
        color: #334155;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    }

    .preset-chip:hover {
        border-color: #10B981;
        color: #059669;
    }

    .preset-chip.active {
        background: #0B131B;
        color: #CCFF00;
        border-color: #0B131B;
    }

    /* Input With Thumbnail */
    .input-with-thumb-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-input-thumb-box {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
        border: 1px solid #E2E8F0;
        background: #F1F5F9;
    }

    .form-input-thumb-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .input-with-thumb {
        flex: 1;
    }

    /* Product Preview Showcase Card (Right Column) */
    .product-preview-card-glossy {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.9) 100%);
        border: 1px solid rgba(16, 185, 129, 0.25);
        border-radius: 16px;
        padding: 16px;
        display: flex;
        gap: 16px;
        align-items: center;
        box-shadow: 0 4px 18px rgba(16, 185, 129, 0.08), inset 0 1px 2px rgba(255, 255, 255, 1);
        backdrop-filter: blur(8px);
        margin-bottom: 18px;
    }

    .prod-preview-thumb-box {
        position: relative;
        width: 82px;
        height: 82px;
        border-radius: 14px;
        overflow: hidden;
        flex-shrink: 0;
        border: 2px solid #FFFFFF;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background: #F1F5F9;
    }

    .prod-preview-thumb-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .prod-preview-thumb-box:hover img {
        transform: scale(1.08);
    }

    .preview-badge-live {
        position: absolute;
        bottom: 4px;
        left: 4px;
        right: 4px;
        background: rgba(11, 19, 27, 0.85);
        backdrop-filter: blur(4px);
        color: #CCFF00;
        font-size: 8.5px;
        font-weight: 800;
        padding: 2px 4px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }

    .prod-preview-info {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .preview-cat-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .preview-cat-badge {
        font-size: 11px;
        font-weight: 800;
        color: #059669;
        background: #DCFCE7;
        padding: 2px 8px;
        border-radius: 6px;
    }

    .preview-time-tag {
        font-size: 10.5px;
        color: #94A3B8;
        font-weight: 600;
    }

    .preview-prod-title {
        font-size: 14.5px;
        font-weight: 800;
        color: #0F172A;
        margin: 2px 0 6px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .preview-pricing-row {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pricing-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #F1F5F9;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 11.5px;
        color: #334155;
    }

    .pricing-pill.pill-accent {
        background: #ECFDF5;
        color: #065F46;
        border: 1px solid rgba(16, 185, 129, 0.25);
    }

    .pricing-pill.pill-margin {
        background: #0B131B;
        color: #CCFF00;
        font-weight: 800;
    }

    .pp-lbl {
        font-size: 10.5px;
        color: #64748B;
        font-weight: 600;
    }

    .pricing-pill.pill-accent .pp-lbl {
        color: #059669;
    }

    .pricing-arrow {
        color: #94A3B8;
        font-weight: 800;
        font-size: 12px;
    }

    /* Form Styles Glossy */
    .form-group-glossy {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 16px;
    }

    .form-label-glossy {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-main);
    }

    .input-field-glossy, .select-field-glossy {
        width: 100%;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 11px 16px;
        font-size: 13.5px;
        font-weight: 600;
        color: var(--text-main);
        outline: none;
        transition: all 0.2s;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.03);
    }

    .input-field-glossy:focus, .select-field-glossy:focus {
        border-color: #10B981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }

    .form-row-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    /* Gross Margin Card Glossy */
    .gross-margin-card-glossy {
        background: linear-gradient(135deg, rgba(220, 252, 231, 0.5) 0%, rgba(255, 255, 255, 0.9) 100%);
        border: 1px solid rgba(16, 185, 129, 0.25);
        border-radius: 14px;
        padding: 12px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: inset 0 1px 2px rgba(255, 255, 255, 1);
        margin-bottom: 16px;
    }

    .gm-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .gm-icon-circle {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #10B981;
        color: #FFFFFF;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .gm-label {
        font-size: 11.5px;
        font-weight: 800;
        color: #059669;
        text-transform: uppercase;
        display: block;
    }

    .gm-sub {
        font-size: 12.5px;
        font-weight: 700;
        color: var(--text-main);
    }

    .gm-pct-pill {
        font-size: 18px;
        font-weight: 800;
        color: #10B981;
        background: #FFFFFF;
        border: 1px solid rgba(16, 185, 129, 0.3);
        padding: 4px 12px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.1);
    }

    .label-flex-between {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stock-active-badge {
        font-size: 12px;
        font-weight: 800;
        color: #10B981;
        background: #DCFCE7;
        padding: 2px 8px;
        border-radius: 8px;
    }

    .stock-chips-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
        margin-top: 6px;
    }

    .stock-chip-glossy {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        color: #475569;
        font-size: 11.5px;
        font-weight: 700;
        padding: 8px 6px;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }

    .stock-chip-glossy:hover, .stock-chip-glossy.active {
        background: #0B131B;
        color: #CCFF00;
        border-color: #0B131B;
        box-shadow: 0 4px 12px rgba(11, 19, 27, 0.2);
    }

    .btn-predict-cta {
        width: 100%;
        margin-top: 18px;
        background: #0B131B;
        color: #CCFF00;
        border: 1px solid rgba(204, 255, 0, 0.3);
        border-radius: 14px;
        padding: 13px 20px;
        font-size: 13.5px;
        font-weight: 800;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.25s;
        box-shadow: 0 6px 18px rgba(11, 19, 27, 0.25);
    }

    .btn-predict-cta:hover {
        background: #162432;
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(11, 19, 27, 0.35);
    }

    /* Benchmark Card Glossy */
    .benchmark-card-glossy {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 20px;
    }

    .bench-icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #DCFCE7;
        color: #10B981;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .bench-tag {
        font-size: 10.5px;
        font-weight: 800;
        color: #059669;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 2px;
    }

    .bench-name {
        font-size: 14px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 2px;
    }

    .bench-stat {
        font-size: 12px;
        color: var(--text-muted);
    }

    /* Result Panel Styles */
    .confidence-pill-glossy {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #F0FDF4;
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #15803D;
        font-size: 11px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 9999px;
    }

    .predict-score-banner {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(204, 255, 0, 0.05) 50%, rgba(255, 255, 255, 0.9) 100%);
        border: 1px solid rgba(16, 185, 129, 0.25);
        border-radius: 18px;
        padding: 18px 22px;
        margin-bottom: 16px;
        box-shadow: inset 0 1px 2px rgba(255, 255, 255, 1);
    }

    .score-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .score-circle-glossy {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background: #0B131B;
        color: #CCFF00;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 14px rgba(11, 19, 27, 0.25);
    }

    .score-number {
        font-size: 22px;
        font-weight: 900;
        line-height: 1;
    }

    .score-total {
        font-size: 9.5px;
        font-weight: 700;
        color: #94A3B8;
    }

    .score-status-title {
        font-size: 16px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 3px;
    }

    .score-status-desc {
        font-size: 12.5px;
        color: var(--text-muted);
        line-height: 1.4;
    }

    .forecast-two-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .f-box-glossy {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 14px 16px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
    }

    .f-lbl {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
        display: block;
        margin-bottom: 4px;
    }

    .f-val {
        font-size: 18px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 2px;
    }

    .f-sub {
        font-size: 11.5px;
        color: var(--text-muted);
        font-weight: 600;
    }

    .text-green {
        color: #10B981 !important;
    }

    /* Projection Chart Card */
    .proj-chart-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 16px 18px;
    }

    .proj-head-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .proj-title {
        font-size: 13.5px;
        font-weight: 800;
        color: var(--text-main);
    }

    .proj-sub {
        font-size: 11.5px;
        color: var(--text-muted);
        margin-top: 1px;
    }

    .chart-legend { display: flex; align-items: center; gap: 14px; }
    .leg-item { display: flex; align-items: center; gap: 6px; font-size: 11.5px; font-weight: 700; color: #475569; }
    .line-black { width: 14px; height: 3px; background: #0F172A; border-radius: 2px; display: inline-block; }
    .line-green-dash { width: 14px; height: 0; border-top: 2px dashed #10B981; display: inline-block; }
    .chart-canvas-container { position: relative; width: 100%; margin-top: 10px; }
    .main-trend-svg { width: 100%; height: auto; max-height: 160px; display: block; overflow: visible; }
    .chart-x-labels { display: flex; justify-content: space-between; align-items: center; font-size: 10.5px; font-weight: 700; color: #64748B; margin-top: 10px; padding: 0 4px; }
    .chart-x-labels span.active-today { color: #15803D; font-weight: 800; background: #DCFCE7; padding: 2px 8px; border-radius: 6px; border: 1px solid rgba(16, 185, 129, 0.25); }

    /* Insights List */
    .insights-title {
        font-size: 13px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 10px;
    }

    .insights-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .ins-item-glossy {
        display: flex;
        gap: 12px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 12px 14px;
    }

    .ins-bullet {
        width: 22px;
        height: 22px;
        border-radius: 6px;
        background: #0B131B;
        color: #CCFF00;
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .ins-content strong {
        font-size: 12.5px;
        color: var(--text-main);
        display: block;
        margin-bottom: 2px;
    }

    .ins-content p {
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.4;
        margin: 0;
    }

    .result-action-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        border-top: 1px solid #F1F5F9;
        padding-top: 16px;
    }

    .foot-left-actions {
        display: flex;
        gap: 10px;
    }

    @media (max-width: 1024px) {
        .dash-columns {
            grid-template-columns: 1fr;
        }
        .stock-chips-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    let currentSelectedImageUrl = '{{ $prefill['image_url'] ?? "https://images.unsplash.com/photo-1563245372-f21724e3856d?w=300&auto=format&fit=crop&q=80" }}';

    const imageDictionary = [
        { pattern: /labubu|pensil|pencil|stationery/i, url: 'https://images.unsplash.com/photo-1563245372-f21724e3856d?w=300&auto=format&fit=crop&q=80' },
        { pattern: /kopi|coffee|drip|espresso|gayo/i, url: 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=300&auto=format&fit=crop&q=80' },
        { pattern: /tumbler|botol|bottle|cup|drinkware/i, url: 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?w=300&auto=format&fit=crop&q=80' },
        { pattern: /kabel|cable|charger|gadget|type-c/i, url: 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=300&auto=format&fit=crop&q=80' },
        { pattern: /beras|rice|sembako|minyak|telur/i, url: 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=300&auto=format&fit=crop&q=80' },
        { pattern: /geprek|ayam|chicken|kuliner|makan/i, url: 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=300&auto=format&fit=crop&q=80' },
        { pattern: /roti|bread|pastry|cromboloni|croissant/i, url: 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=300&auto=format&fit=crop&q=80' },
        { pattern: /rendang|daging|beef/i, url: 'https://images.unsplash.com/photo-1544025162-d76694265947?w=300&auto=format&fit=crop&q=80' },
        { pattern: /batik|kemeja|baju|fashion|pakaian/i, url: 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=300&auto=format&fit=crop&q=80' },
        { pattern: /hijab|jilbab|scarf|voal/i, url: 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=300&auto=format&fit=crop&q=80' },
        { pattern: /rotan|kerajinan|craft|kriya/i, url: 'https://images.unsplash.com/photo-1616046229478-9901c5536a45?w=300&auto=format&fit=crop&q=80' },
        { pattern: /laundry|cuci|jasa/i, url: 'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?w=300&auto=format&fit=crop&q=80' },
    ];

    function resolveClientImage(name, cat) {
        const text = (name + ' ' + cat).toLowerCase();
        for (const item of imageDictionary) {
            if (item.pattern.test(text)) {
                return item.url;
            }
        }
        return 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=300&auto=format&fit=crop&q=80';
    }

    function updateProductDisplayImage(url) {
        currentSelectedImageUrl = url;
        const formImg = document.getElementById('formThumbImg');
        if (formImg) formImg.src = url;
        const simImg = document.getElementById('simProductImg');
        if (simImg) simImg.src = url;
    }

    function handleProductNameChange() {
        const name = document.getElementById('productName').value;
        const cat = document.getElementById('categorySelect').value;
        const url = resolveClientImage(name, cat);
        updateProductDisplayImage(url);
        const nameEl = document.getElementById('simProductNameDisplay');
        if (nameEl) nameEl.innerText = name || 'Rencana Produk Baru';
    }

    function handleCategoryChange() {
        handleProductNameChange();
        const cat = document.getElementById('categorySelect').value;
        const catEl = document.getElementById('simCategoryDisplay');
        if (catEl) catEl.innerText = cat;
    }

    function selectPreset(name, cat, cost, sell, imgUrl, btn) {
        document.querySelectorAll('.preset-chip').forEach(c => c.classList.remove('active'));
        if (btn) btn.classList.add('active');

        document.getElementById('productName').value = name;
        document.getElementById('costPrice').value = cost;
        document.getElementById('sellPrice').value = sell;
        
        const catSelect = document.getElementById('categorySelect');
        for (let i = 0; i < catSelect.options.length; i++) {
            if (catSelect.options[i].text.includes(cat) || cat.includes(catSelect.options[i].text)) {
                catSelect.selectedIndex = i;
                break;
            }
        }

        updateProductDisplayImage(imgUrl);
        const nameEl = document.getElementById('simProductNameDisplay');
        if (nameEl) nameEl.innerText = name;
        const catEl = document.getElementById('simCategoryDisplay');
        if (catEl) catEl.innerText = cat;

        calculateMargin();
        showPredictToast(`Preset "${name}" siap diuji!`);
    }

    function calculateMargin() {
        const cost = parseFloat(document.getElementById('costPrice').value) || 0;
        const sell = parseFloat(document.getElementById('sellPrice').value) || 0;
        if (sell > 0) {
            const profit = sell - cost;
            const pct = ((profit / sell) * 100).toFixed(1);
            const badge = document.getElementById('marginBadge');
            if (badge) badge.innerText = pct + '%';
            const profitEl = document.getElementById('profitPerUnit');
            if (profitEl) profitEl.innerText = 'Keuntungan per unit: Rp ' + profit.toLocaleString('id-ID');
            
            const simProfit = document.getElementById('simProfit');
            if (simProfit) {
                const totalProfit = profit * currentBatchSize;
                simProfit.innerText = 'Rp ' + totalProfit.toLocaleString('id-ID');
            }

            // Update showcase card displays
            const costEl = document.getElementById('simCostDisplay');
            if (costEl) costEl.innerText = 'Rp ' + cost.toLocaleString('id-ID');
            const sellEl = document.getElementById('simSellDisplay');
            if (sellEl) sellEl.innerText = 'Rp ' + sell.toLocaleString('id-ID');
            const marginEl = document.getElementById('simMarginDisplay');
            if (marginEl) marginEl.innerText = pct + '%';
        }
    }

    let currentBatchSize = 50;

    function setBatch(num, label, btnEl) {
        currentBatchSize = num;
        const batchEl = document.getElementById('batchDisplay');
        if (batchEl) batchEl.innerText = num + ' Pcs';
        document.querySelectorAll('.stock-chip-glossy').forEach(el => el.classList.remove('active'));
        if (btnEl) btnEl.classList.add('active');
        calculateMargin();
    }

    function resetForm() {
        document.getElementById('productName').value = '';
        document.getElementById('costPrice').value = '10000';
        document.getElementById('sellPrice').value = '20000';
        updateProductDisplayImage('https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=300&auto=format&fit=crop&q=80');
        const nameEl = document.getElementById('simProductNameDisplay');
        if (nameEl) nameEl.innerText = 'Rencana Produk Baru';
        calculateMargin();
        showPredictToast('Formulir berhasil direset ke nilai awal.');
    }

    async function runPrediction() {
        const btn = document.querySelector('.btn-predict-cta');
        if (!btn) return;
        const originalContent = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation: spin 0.8s linear infinite;"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle><path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"></path></svg><span>Menganalisis dengan Juragan AI Live...</span>`;

        const prod = document.getElementById('productName').value;
        const cat = document.getElementById('categorySelect').value;
        const cost = parseFloat(document.getElementById('costPrice').value) || 0;
        const sell = parseFloat(document.getElementById('sellPrice').value) || 0;

        try {
            const res = await fetch('{{ route("predict.simulate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_name: prod,
                    category: cat,
                    cost_price: cost,
                    selling_price: sell,
                    batch_size: currentBatchSize,
                    image_url: currentSelectedImageUrl
                })
            });

            const json = await res.json();
            if (json.status === 'success') {
                const data = json.data;

                // 1. Update Showcase Image and Labels
                if (json.image_url) {
                    updateProductDisplayImage(json.image_url);
                }
                const nameEl = document.getElementById('simProductNameDisplay');
                if (nameEl) nameEl.innerText = data.product_name;
                const catEl = document.getElementById('simCategoryDisplay');
                if (catEl) catEl.innerText = data.category;
                const costEl = document.getElementById('simCostDisplay');
                if (costEl) costEl.innerText = 'Rp ' + Number(data.cost_price).toLocaleString('id-ID');
                const sellEl = document.getElementById('simSellDisplay');
                if (sellEl) sellEl.innerText = 'Rp ' + Number(data.selling_price).toLocaleString('id-ID');
                const marginEl = document.getElementById('simMarginDisplay');
                if (marginEl) marginEl.innerText = (data.gross_margin_pct || 0) + '%';

                // 2. Update Skor AI
                const scoreEl = document.getElementById('simScore');
                if (scoreEl) scoreEl.innerText = data.opportunity_score;

                // 3. Update Confidence Pill
                const confEl = document.querySelector('.confidence-pill-glossy span');
                if (confEl) confEl.innerText = (data.confidence_pct || 88.5) + '% Confidence (Juragan AI)';

                // 4. Update Rating Title & Desc
                const titleEl = document.querySelector('.score-status-title');
                if (titleEl) titleEl.innerText = json.rating_label || 'Peluang Sangat Tinggi';
                const descEl = document.querySelector('.score-status-desc');
                if (descEl) descEl.innerText = json.rating_desc || 'Risiko stok mati rendah, estimasi perputaran barang cepat di radius toko fisik Anda.';

                // 5. Update Demand and Profit
                const fVals = document.querySelectorAll('.f-box-glossy .f-val');
                if (fVals[0]) fVals[0].innerHTML = data.estimated_demand_range;
                if (fVals[1]) fVals[1].innerText = 'Rp ' + Number(data.projected_net_profit).toLocaleString('id-ID');

                const fSubs = document.querySelectorAll('.f-box-glossy .f-sub');
                if (fSubs[1]) fSubs[1].innerText = 'Dari total omzet Rp ' + Number(data.projected_revenue).toLocaleString('id-ID');

                // 6. Update BEP in SVG chart & subtitle
                const bepDay = json.bep_day || 14;
                const projSub = document.querySelector('.proj-sub');
                if (projSub) {
                    projSub.innerText = bepDay >= 365 ? 'Titik impas (BEP) tidak tercapai dalam proyeksi 30 hari' : `Estimasi titik balik modal tercapai pada hari ke-${bepDay}`;
                }
                const bepLabel = document.querySelector('.chart-canvas-container text');
                if (bepLabel) bepLabel.textContent = bepDay >= 365 ? 'BEP: N/A' : `Hari ke-${bepDay} (BEP)`;
                const bepActivePill = document.querySelector('.chart-x-labels .active-today');
                if (bepActivePill) bepActivePill.textContent = bepDay >= 365 ? 'Tidak Tercapai' : `Hari ${bepDay} (BEP)`;

                // 7. Update Key Insights
                if (data.key_insights && data.key_insights.length > 0) {
                    const listContainer = document.querySelector('.insights-list');
                    if (listContainer) {
                        let html = '';
                        data.key_insights.forEach((ins, idx) => {
                            html += `
                            <div class="ins-item-glossy">
                                <div class="ins-bullet">${idx + 1}</div>
                                <div class="ins-content">
                                    <strong>${ins.title}:</strong>
                                    <p>${ins.description}</p>
                                </div>
                            </div>`;
                        });
                        listContainer.innerHTML = html;
                    }
                }

                // 8. Update prediction_id in hidden form
                const predInput = document.querySelector('input[name="prediction_id"]');
                if (predInput) predInput.value = data.id;

                showPredictToast('Selesai dihitung secara akurat oleh Juragan AI!');
            } else {
                showPredictToast('Gagal memproses simulasi: ' + (json.message || 'Terjadi kesalahan'));
            }
        } catch (err) {
            console.error(err);
            showPredictToast('Koneksi terganggu saat menghubungi AI engine.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalContent;
        }
    }

    function openHistoryModal() {
        const modal = document.getElementById('modal-predict-history');
        if (modal) modal.style.display = 'flex';
    }

    function closeHistoryModal() {
        const modal = document.getElementById('modal-predict-history');
        if (modal) modal.style.display = 'none';
    }

    function saveSimulationDraft() {
        const prod = document.getElementById('productName').value || 'Produk Baru';
        showPredictToast(`Skenario "${prod}" berhasil disimpan ke riwayat toko!`);
    }

    function exportSimulationReport() {
        const prod = document.getElementById('productName').value || 'Pensil Labubu Blind Box';
        const cost = document.getElementById('costPrice').value;
        const sell = document.getElementById('sellPrice').value;
        const score = document.getElementById('simScore') ? document.getElementById('simScore').innerText : '87';
        const profit = document.getElementById('simProfit') ? document.getElementById('simProfit').innerText : 'Rp 650.000';

        let txt = `====================================================\n`;
        txt += `   LARIS PREDICT - LAPORAN KELAYAKAN PRODUK BARU\n`;
        txt += `====================================================\n\n`;
        txt += `Nama Produk      : ${prod}\n`;
        txt += `Kategori Pasar   : ${document.getElementById('categorySelect').value}\n`;
        txt += `Modal (HPP)      : Rp ${parseInt(cost).toLocaleString('id-ID')}\n`;
        txt += `Harga Jual Target: Rp ${parseInt(sell).toLocaleString('id-ID')}\n`;
        txt += `Estimasi Laba    : ${profit}\n`;
        txt += `Skor AI Peluang  : ${score} / 100 (Juragan AI Market Reality Engine)\n`;
        txt += `Waktu Ekspor     : ${new Date().toLocaleString('id-ID')}\n\n`;
        txt += `Dianalisis oleh LARIS Autonomous BI Platform 2026\n`;

        const blob = new Blob([txt], { type: 'text/plain' });
        const a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = `simulasi_laris_${prod.replace(/\s+/g, '_').toLowerCase()}.txt`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);

        showPredictToast('Laporan simulasi (.txt) berhasil diunduh!');
    }

    function loadSimHistory(name, cost, sell, cat, imgUrl) {
        document.getElementById('productName').value = name;
        document.getElementById('costPrice').value = cost;
        document.getElementById('sellPrice').value = sell;
        document.getElementById('categorySelect').value = cat;

        const effectiveUrl = imgUrl || resolveClientImage(name, cat);
        updateProductDisplayImage(effectiveUrl);

        const nameEl = document.getElementById('simProductNameDisplay');
        if (nameEl) nameEl.innerText = name;
        const catEl = document.getElementById('simCategoryDisplay');
        if (catEl) catEl.innerText = cat;

        calculateMargin();
        closeHistoryModal();
        showPredictToast(`Parameter "${name}" berhasil dimuat!`);
    }

    function showPredictToast(msg) {
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
        toast.textContent = msg;

        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 400);
        }, 3200);
    }

    async function handleVisualLensUpload(event) {
        const file = event.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('image', file);
        formData.append('_token', '{{ csrf_token() }}');

        const btnText = document.getElementById('lensUploadBtnText');
        if (btnText) btnText.innerText = 'Memindai ' + file.name + '...';
        await executeVisualLensAnalysis(formData);
    }

    async function promptImageUrl() {
        const url = prompt('Masukkan URL gambar produk dari supplier / web:');
        if (!url || !url.trim()) return;

        const formData = new FormData();
        formData.append('image_url', url.trim());
        formData.append('_token', '{{ csrf_token() }}');

        const btnText = document.getElementById('lensUploadBtnText');
        if (btnText) btnText.innerText = 'Menganalisis URL gambar...';
        await executeVisualLensAnalysis(formData);
    }

    async function executeVisualLensAnalysis(formData) {
        try {
            showPredictToast('AI Visual Trend Lens sedang menganalisis gambar produk...');
            const res = await fetch("{{ route('predict.analyze_image') }}", {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            const data = await res.json();
            if (data.status === 'success') {
                // Pre-fill form fields
                document.getElementById('productName').value = data.product_name;
                document.getElementById('costPrice').value = data.cost_price;
                document.getElementById('sellPrice').value = data.selling_price;
                
                // Set category
                const catSelect = document.getElementById('categorySelect');
                let foundCat = false;
                for (let i = 0; i < catSelect.options.length; i++) {
                    if (catSelect.options[i].text.toLowerCase().includes(data.category.toLowerCase().split(' ')[0])) {
                        catSelect.selectedIndex = i;
                        foundCat = true;
                        break;
                    }
                }
                if (!foundCat && catSelect.options.length > 0) {
                    catSelect.options[0].text = data.category;
                    catSelect.selectedIndex = 0;
                }

                // Update thumbnail image
                if (data.image_url) {
                    currentSelectedImageUrl = data.image_url;
                    updateProductDisplayImage(data.image_url);
                }

                // Show Visual Lens result box
                const resBox = document.getElementById('lensResultBox');
                if (resBox) {
                    resBox.style.display = 'block';
                    document.getElementById('lensPreviewImg').src = data.image_url || 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=100&auto=format&fit=crop&q=80';
                    document.getElementById('lensDetectedName').innerText = data.product_name;
                    document.getElementById('lensDetectedRadar').innerText = `Radar: ${data.trend_velocity} • ${data.trend_radar_match}`;
                    document.getElementById('lensDetectedDesc').innerHTML = `HPP: <strong>Rp ${Number(data.cost_price).toLocaleString('id-ID')}</strong> | Jual: <strong>Rp ${Number(data.selling_price).toLocaleString('id-ID')}</strong> (${data.margin_pct}% Margin). ${data.visual_summary}`;
                }

                calculateMargin();
                showPredictToast(`Gambar terdeteksi: ${data.product_name}! Sesuai radar ${data.trend_radar_match}`);
            } else {
                showPredictToast('Gagal menganalisis gambar: ' + (data.message || 'Format tidak didukung'));
            }
        } catch (err) {
            console.error(err);
            showPredictToast('Terjadi kesalahan saat memproses gambar');
        } finally {
            const btnText = document.getElementById('lensUploadBtnText');
            if (btnText) btnText.innerText = 'Pilih Foto Produk / Drag File Disini';
        }
    }
</script>
@endpush
