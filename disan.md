# Desain Sistem & Spesifikasi UI/UX (disan.md)
## Proyek: LARIS (AI Business Intelligence & Decision Platform for MSMEs)
### Dokumen Desain Teknis, Design System & Spesifikasi UI High-Fidelity Aktual
### Versi: 2.0.0 (Updated from Real High-Fidelity UI Screens) | Tim: Meukarya Team (INFEST Hackathon 2026)

---

## 1. Arsitektur Sistem 5 Lapisan (System Architecture)

Sistem LARIS mengadopsi pola **Intelligence Loop** tertutup:
$$\text{Business Data + Market Signals} \longrightarrow \text{AI Intelligence} \longrightarrow \text{Prediction} \longrightarrow \text{Decision} \longrightarrow \text{Action}$$

```
+-----------------------------------------------------------------------------------------+
|                                      5. ACTION LAYER                                    |
| [Pesan Restock Sekarang] [Auto-Bundle PO] [Simulasi Baru] [Eksekusi Restock] [Buat Promo]|
+-----------------------------------------------------------------------------------------+
                                             ^
+-----------------------------------------------------------------------------------------+
|                                     4. DECISION LAYER                                   |
| - Skor Potensi Produk (87/100)      - Tingkat Keyakinan (88.2% Confidence)              |
| - Key Insights & Rekomendasi        - Explainable AI Engine ("WHY?" & Reason Factors)   |
| - Inventory Health Status (Critical/Attention/Healthy) - Sinyal & Velocity Growth       |
+-----------------------------------------------------------------------------------------+
                                             ^
+-----------------------------------------------------------------------------------------+
|                                  3. AI INTELLIGENCE LAYER                               |
| [LARIS Engine v3.8]   [Demand Engine]     [Opportunity Engine]    [Profit/Margin Engine]|
| [Copilot Juragan AI (RAG + LLM)]          [Time-Series Depletion & Velocity Model]      |
+-----------------------------------------------------------------------------------------+
                                             ^
+-----------------------------------------------------------------------------------------+
|                                      2. SIGNAL LAYER                                    |
| - TikTok & E-Commerce Search Velocity (+142% WoW) - Local Radius Geo-Demand (5km)       |
| - Seasonal Trends & Competitor Deficit Sinyal     - Wholesale & Supplier Lead Times     |
+-----------------------------------------------------------------------------------------+
                                             ^
+-----------------------------------------------------------------------------------------+
|                                       1. DATA LAYER                                     |
| - Real-time POS Transactions (Shopee, Tokopedia, Offline Store)                          |
| - Inventory Stock Thresholds & Cost Structure (HPP, Margin %)                            |
| - Multi-Channel Cash Flow & Revenue Reconciliation                                      |
+-----------------------------------------------------------------------------------------+
```

---

## 2. Design System & Identitas Visual (UI Specification)

Berdasarkan implementasi UI aktual pada aplikasi LARIS:

### 2.1 Palet Warna Utama (Color Tokens)
* **Sidebar Deep Slate / Dark Theme:** `#0B1215` / `#0E161A` (Sidebar hitam pekat dengan nuansa hijau botol gelap, kontras tinggi).
* **Accent Brand Lime / Neon Green:** `#CCFF00` hingga `#B4F000` (Digunakan untuk *Active Nav Pill*, tombol aksi primer, badge skor tinggi, dan indikator *live sync*).
* **Text on Dark:** `#FFFFFF` (Heading) dan `#94A3B8` (Muted navigation label).
* **Main Canvas Background:** `#F8FAF9` / `#F3F4F6` (Latar belakang konten yang bersih dan nyaman di mata).
* **Card Surface:** `#FFFFFF` murni dengan border tipis `1px solid #E5E7EB` atau `rgba(0,0,0,0.04)` serta *subtle soft drop-shadow*.
* **Status Badges & Semantic Colors:**
  * **Critical / Danger:** Background `#FEE2E2`, Teks `#DC2626` (Habis < 4 hari, Stok Kritis).
  * **Attention Needed / Warning:** Background `#FEF3C7`, Teks `#D97706` (Mendekati reorder point 5-7 hari).
  * **Healthy / Safe:** Background `#DCFCE7`, Teks `#16A34A` (> 14 hari aman).
  * **Trending / Viral Purple/Dark:** `#111827` (Badge *Viral Spike*, *Peluang Emas*).

### 2.2 Tipografi
* **Font Family:** `Inter`, `-apple-system`, `BlinkMacSystemFont`, `Segoe UI`, Roboto.
* **Hierarchy:**
  * H1 Main Title: 26px - 30px, Extra Bold (800)
  * Metric Large Numbers: 24px - 32px, Bold (800)
  * Section Headers: 16px - 18px, SemiBold (600)
  * Data Body & Tables: 13px - 14px, Regular (400) / Medium (500)
  * Micro Badge & Status: 11px - 12px, Bold (700), Semi-rounded pill.

### 2.3 Komponen Global (Layout & Navigation)
1. **Left Navigation Sidebar (Dark Theme):**
   * **Brand Header:** Logo kotak hitam "LARIS BI PLATFORM".
   * **Menu Utama:**
     - *Business Dashboard*
     - *LARIS Predict*
     - *Trend Hunter*
     - *Smart Inventory*
     - *Juragan AI*
     - *Business Report*
   * **Menu Konfigurasi:** *Settings*, *Help*.
   * **Active State:** Tombol *pill* dengan latar belakang hijau limau terang (`#CCFF00`), teks hitam tegas, dan sudut membulat (*rounded-xl*).
2. **Top Global Bar:**
   * Universal Search Bar (*"Cari analitik, stok, insight AI..."*).
   * Status Pill Toko: Indikator hijau *dot* `"Toko Berkah Utama - Online"`.
   * Notification Bell dengan notifikasi aktif.
   * User Profile Badge: Foto avatar juragan, *"Juragan Bambang - Super Juragan"*.

---

## 3. Spesifikasi Rinci 6 Layar Utama (Screen-by-Screen UI Blueprint)

---

### 3.1 Layar 1: Business Dashboard (Pusat Kendali Bisnis Real-Time)
*Tampilan: Beranda Eksekutif Pemilik Toko dengan Telemetri Langsung & Radar Peluang.*

1. **Header & Live Telemetry:**
   * Badge Status: `● LIVE TELEMETRY` • *Update terakhir: 2 menit yang lalu*.
   * Greeting: **Good Morning, Juragan 👋**
   * Subtitle: *Here is what's happening with **Toko Berkah Utama** today.*
   * Quick Actions Kanan: Selector tanggal `[📅 Hari Ini (24 Okt)]` dan tombol `[⬇ Unduh Ringkasan]`.
2. **Juragan AI Instant Insight Strip (Top Banner):**
   * Background gelap elegan (`#0B1215`) dengan aksen hijau neon.
   * Pesan Strategis: *"Tren produk viral **Pensil Labubu** meningkat +310% di wilayah Jawa Barat. Margin laba estimasi 38% jika di-restock sebelum akhir pekan."*
   * Tombol CTA Langsung: **`[Eksekusi Rekomendasi ->]`** (Warna hijau limau terang).
3. **Top 4 KPI Metrics Card Grid:**
   * **Pendapatan Hari Ini:** **Rp 45.2M** (`+12% vs kemarin`, dilengkapi mini sparkline chart hijau).
   * **Laba Bersih Estimasi:** **Rp 15.8M** (`+8%`, Margin 34.9% dilengkapi progress bar).
   * **Kesehatan Stok Gudang:** **94%** (Badge: `✔ Optimal`, Subtext: *3 Perlu Reorder*, 812 SKU Aktif & Terisi Penuh).
   * **Opportunity Score:** **87** (Badge: `HIGH SIGNAL`, Potensi Penjualan Tinggi, Top Category: *Stationery & Hobby*, 4 Tren Baru Terdeteksi).
4. **Kolom Tengah: Opportunity Radar (AI Realtime):**
   * Header: **Opportunity Radar [AI REALTIME]** • *Deteksi peluang viral dan margin tertinggi dari marketplace lokal*.
   * **Visual Radar Circular Scanner:** Titik koordinat produk viral vs normal di sekitar toko.
   * **Spotlight Opportunity Card:**
     - Item: **Pensil Labubu Blind Box** (Stationery & Giftware) | Skor Peluang: **87/100**.
     - Demand Score: **92 / 100 (Sangat Tinggi)**.
     - Tingkat Kompetitor: **Rendah (18% Seller)**.
     - Estimasi Margin Laba: **+38% per unit**.
     - Proyeksi Penjualan: **120 unit / minggu** | Potensi Omset Tambahan: **Rp 4.200.000**.
     - Tombol Aksi: **`[Simulasi dengan LARIS Predict ->]`**.
   * **Peluang Lain yang Terpantau:**
     - Kopi Drip Bag (+45% Permintaan, Skor 78)
     - Botol Minum 2L (+32% Permintaan, Skor 74)
     - Kabel Type-C (+28% Permintaan, Skor 69)
     - Link Pintasan: `Lihat Semua di Trend Hunter >`.
   * **Grafik Tren Penjualan & Prediksi AI:**
     - Perbandingan kurva data historis riil (Senin - Hari Ini) dipadukan dengan zona *AI Confidence Band* (Sabtu - Minggu ke depan).
5. **Kolom Kanan: Peringatan Operasional & Kontribusi Kategori:**
   * **Peringatan Operasional (Operational Alerts - 3 Mendesak):**
     - **Kopi Arabica Gayo 250g (SISA 5 UNIT):** Diprediksi habis dalam 14 jam berdasarkan laju transaksi harian. Supplier: PT Kopi Nusantara. Tombol: `[Order Ulang]`.
     - **Minyak Goreng Sania 2L (MARGIN TURUN):** Harga beli distributor naik Rp 1.500. Juragan disarankan menaikkan harga jual ritel jadi Rp 36.500 (Dampak Margin: -4.2%). Tombol: `[Sesuaikan Harga]`.
     - **Tumbler Stainless 500ml (STAGNAN 24 HARI / DEAD STOCK):** Stok 42 unit menahan modal Rp 1.8M. Modal tertahan: Rp 1.850.000. Tombol: `[Buat Promo Bundling]`.
   * **Kategori Terlaris (Kontribusi Omset Minggu Ini):**
     - Stationery & Blind Box: **Rp 18.4M** (+42%)
     - Kebutuhan Pokok / Sembako: **Rp 14.1M** (+12%)
     - Kopi & Minuman Kemasan: **Rp 8.2M** (+8%)
     - Aksesoris Gadget: **Rp 4.5M** (+3%)
     - Rata-rata basket size: **Rp 84.500** | Link: `Analisis Detail`.
   * **Juragan AI Quick Prompt Widget:**
     - Kotak interaktif: *"Tanya Juragan AI: Bagaimana cara menaikkan omset akhir pekan ini?"* `[->]`.

---

### 3.2 Layar 2: Juragan AI (Operational & Strategy Assistant)
*Tampilan: Chatbot Copilot Bisnis Cerdas dengan Rekomendasi Terstruktur.*

1. **Header Juragan AI:**
   * Judul: **Juragan AI** didampingi badge hijau neon: `Model v3.8 - Real-time Data Sync Active`.
   * Subtitle: *Asisten Bisnis Pintar & Partner Strategi Toko Berkah Utama*.
   * Status Bar Kanan: **KESEHATAN BISNIS: Skor 94/100 (Sangat Sehat)** dengan ikon pulse.
2. **Panel Kiri (Konteks & Pintasan Cepat):**
   * **Kartu Profil Pemilik:** Foto Juragan Bambang (Verified), Toko Berkah Utama • ID #88412.
   * **Quick KPI Widget:**
     - *Omzet Hari Ini:* Rp 3.840.000
     - *Margin Rata-rata:* 31.4%
   * **Topik Percakapan Cepat (Quick Chips):**
     - 💡 *Analisis Omzet Bulan Ini* (Review performa kotor vs target)
     - 📦 *Cek Produk Menjelang Habis* (Deteksi 4 SKU stok kritis)
     - ⚡ *Rekomendasi Flash Sale Akhir Pekan* (Simulasi kenaikan laba bersih)
     - 📝 *Catat Transaksi Offline Cepat* (Voice atau upload foto struk nota)
   * **Riwayat Konsultasi:**
     - Strategi Kenaikan Margin Q3 [PROFIT]
     - Evaluasi Supplier Minyak Goreng [SUPPLY]
     - Forecast Permintaan Musim Hujan [PREDICT]
3. **Panel Utama Chatting:**
   * Header Chat: **Juragan AI [COPILOT]** • *Operational & Strategy Assistant • Berbasis Algoritma LARIS BI*.
   * Bubble Pesan Sambutan AI: Rekonsiliasi data kasir & marketplace (Omzet bulanan Rp 12.4M, +18% MoM).
   * Bubble Pertanyaan User: *"Bagaimana cara menaikkan profit margin minggu ini tanpa kehilangan pelanggan?"*
   * **Rich Response Card (Hasil Analisis AI):**
     - Judul: *"Fokus pada produk margin tinggi dengan sinyal permintaan kuat:"*
     - **Kartu Produk 1 (Bundling Opportunity):**
       - Item: **Kopi Arabica Gayo** (Sisa stok 24 unit).
       - Solusi: Bundling dengan Sirup Caramel (+22% basket size).
       - Estimasi Tambahan Laba: **+Rp 1.450.000**.
       - Tombol Aksi: `[Buat Paket Bundling]`.
     - **Kartu Produk 2 (Radar Tren #1):**
       - Item: **Pensil Labubu Series** (Skor 87/100).
       - Solusi: Permintaan naik 82%. Naikkan harga dari Rp 17.500 ke Rp 18.500 tanpa menurunkan konversi.
       - Elastisitas Harga: Aman (+5.7% Margin).
       - Tombol Aksi: `[Buka LARIS Predict]`.
   * Input Chat Bar: Input fleksibel teks, attachment file struk, voice input (microphone), dan tombol kirim hijau limau.

---

### 3.3 Layar 3: LARIS Predict ("What If I Sell This?")
*Tampilan: AI Market Demand, Pricing, & Profitability Simulator.*

1. **Top Notice Strip:**
   * Juragan AI Insight Strip: *"Pasar perlengkapan viral di area tokomu naik +142% pekan ini. Gunakan simulator di bawah untuk mengukur proyeksi laba bersih."*
   * Badge: `Model v3.8 - Real-time Big Data MSME`.
2. **Form Parameter Produk Baru (Sisi Kiri):**
   * Nama Produk: *"Pensil Labubu Premium Edition"*.
   * Kategori Tren Pasar: Dropdown *"Stationery & Toys (Viral Pop Culture)"*.
   * Input Finansial:
     - Modal / HPP: **Rp 8.500**
     - Harga Jual Rencana: **Rp 18.000**
   * *Gross Margin Auto-Calculation:* **52.8%** (Keuntungan per unit: Rp 9.500).
   * Rencana Stok Awal: Slider / Selector (10 pcs Trial / 50 pcs Recommended / 100 pcs Scale / 250 pcs Grosir).
   * Target Saluran Penjualan (Multi-checkbox): Shopee, TikTok Shop, Tokopedia, Offline Store.
   * Tombol CTA: **`ANALYZE WITH LARIS ->`** (Warna hijau neon cerah).
   * Benchmark Card: *"Gantungan Kunci Viral V1 - Tingkat Penjualan 94% dalam 18 Hari"*.
3. **Panel Hasil Prediksi AI (Sisi Kanan):**
   * **Skor Potensi Produk:** Badge skor besar **87 / 100** (Tingkat Keyakinan: 88.2% Confidence).
   * **Estimasi Permintaan Awal:** **38 - 52 pcs** (Terjual dalam 14 hari pertama).
   * **Proyeksi Pendapatan (Revenue):** **Rp 810.000** (Estimasi Laba Bersih: **+Rp 427.500**).
   * **Grafik Lintasan Proyeksi Pendapatan & Laba (30 Hari):** Kurva dinamis titik impas / BEP pada Hari ke-14 dan Laba Maksimal pada Hari ke-30.
   * **Key Insights & Rekomendasi Juragan AI:**
     - 🟢 *High Demand, Low Competition in your local sub-district* (Peluang Emas).
     - ⚡ *Viral velocity on TikTok Shop: +142% search queries this week* (Viral Spike).
     - 📦 *Recommended Bundle: Pair with Labubu Pencil Case to boost AOV by 25%* (+25% AOV).
   * Action Footer: `[Save Simulation]`, `[Export Report]`, dan CTA Utama **`[+ Add to Inventory Plan]`**.

---

### 3.4 Layar 4: Trend Hunter (Radar Tren Pasar)
*Tampilan: Pemetaan lonjakan permintaan konsumen & tren viral sebelum pasar jenuh.*

1. **Header & Filter:**
   * Judul: **TREND HUNTER** didampingi badge `Real-time AI Market Radar`.
   * Filter Jangka Waktu: `[Last 7 Days]`, `[30 Days]`, `[90 Days]`.
   * Filter Kategori: Dropdown Kategori + Tombol `[Pindai Ulang]`.
2. **Kartu Fokus Radar Utama (Hero Trend Card):**
   * Judul Tren: **Labubu Stationery & Merchandise** (Akurasi AI: 94.2%).
   * Status: **EARLY STAGE** (Optimal Seller Entry Point).
   * Metrik Inti:
     - *Signal Strength:* **82%** (Ultra High bar).
     - *Growth Velocity:* **+284%** (WoW Search Volume di marketplace & TikTok).
     - *Avg. Selling Price:* **Rp 15k - 45k** (Margin kotor 42% - 58%).
     - *Tingkat Persaingan:* **Rendah** (Defisit Stok Nasional 63%).
   * **Grafik Kurva Akselerasi Tren vs Prediksi 7 Hari:** Titik breakout lonjakan tren (+284%) dari hari ke hari hingga proyeksi puncak awal.
   * **LARIS Strategic Recommendation Bar:**
     - *"Permintaan Labubu Stationery berada pada fase eksponensial awal dengan defisit stok distributor. Amankan stok 50-100 unit pertama untuk mengunci margin kotor premium (~52%) sebelum perang harga pasar umum terjadi dalam 14-20 hari."*
     - Tombol Aksi: **`[Eksekusi Restock ->]`**.
3. **Top Trending Items Matrix (Grid 4 Kolom):**
   * **Item 1:** *Labubu Pencil Case* (Stationery, Early Stage, Signal 82%, High Demand).
   * **Item 2:** *Vintage Botanical Journal* (Paper Craft, Growth Stage, Signal 76%, Med Demand).
   * **Item 3:** *Bamboo Gel Pen Eco* (Eco Office, Mature Stage, Signal 69%, Steady).
   * **Item 4:** *Korean Pastel Tumbler* (Lifestyle, Early Stage, Signal 64%, High Demand).
   * Masing-masing dilengkapi mini sparkline chart dan tombol `[Simulate in Predict]`.

---

### 3.5 Layar 5: Smart Inventory (Manajemen Stok Berbasis AI)
*Tampilan: Automated Stock Health Monitoring & AI-Powered Demand Forecasting.*

1. **Top Emergency Alert Banner (Imminent Stockout):**
   * Background merah pastel dengan border halus.
   * Pesan: *"Kopi Arabica Gayo 250g — Kritis: Sisa 24 Unit (Prediksi Habis dalam 4 Hari)"*.
   * Rekomendasi Restock: *50 unit dari PT Kopi Nusantara (Lead time 2 hari kerja)*.
   * Tombol Aksi: `[Abaikan Alert]` dan `[Pesan Restock Sekarang]` (Hijau limau mencolok).
2. **Kartu Ringkasan Kesehatan Inventaris (Inventory Health Overview):**
   * **Healthy (85%):** 68 SKU dalam range aman (> 14 Hari Stok).
   * **Attention Needed (10%):** 8 SKU mendekati reorder point (5-7 Hari Stok).
   * **Critical Alert (5%):** 4 SKU segera habis (< 4 Hari Stok).
3. **Tabel Matriks Kesehatan Inventaris (Inventory Health & Reorder Matrix):**
   * Kolom: *Product Name, SKU, Category, Current Stock, Health Status, AI Velocity, Stock Runway, Quick Action*.
   * Contoh Data:
     - **Kopi Arabica Gayo 250g:** Sisa 24 Pouch (Min: 40) | **Critical** | 6.0 unit/hari | **Habis 4 Hari** | `[Reorder]`
     - **Pensil Labubu Premium:** Sisa 180 Box (Min: 50) | **Healthy** | 8.5 unit/hari | Cukup 21 Hari | `[View Demand]`
     - **Sirup Caramel 750ml:** Sisa 12 Botol (Min: 15) | **Attention** | 2.0 unit/hari | **Habis 6 Hari** | `[Reorder]`
     - **Paper Cup 8oz Eco:** Sisa 450 Pcs (Min: 100) | **Healthy** | 15.0 unit/hari | Cukup 30 Hari | `[View Demand]`
     - **Susu UHT Barista 1L:** Sisa 8 Karton (Min: 20) | **Critical** | 4.0 unit/hari | **Habis 2 Hari** | `[Reorder]`
4. **Bottom AI Auto-Bundle Card:**
   * **Juragan AI Restock Optimizer (AUTO-BUNDLE):**
   * *"Ada 2 item Critical (Kopi Arabica & Susu UHT) yang berasal dari distributor regional sama di Bandung. Menggabungkan pesanan ini ke satu PO akan mencegah potensi lost-sales Rp 2.850.000 dan hemat ongkir s.d 18%."*
   * Tombol CTA: **`[Buat Purchase Order Gabungan]`**.

---

### 3.6 Layar 6: Business Report (Audit Performa Laba & Penjualan)
*Tampilan: Monthly Business Review & Evaluasi Portofolio Penjualan.*

1. **Header & Filter Periode:**
   * Judul: **Monthly Business Review** didampingi badge `AI Certified Audited • Sinkronisasi POS Real-time`.
   * Periode: *01 Sep - 30 Sep 2026* | Tombol `[Unduh Laporan Lengkap (PDF/Excel)]`.
2. **Top Executive Metrics Grid (4 Kartu):**
   * **Total Revenue:** **Rp 12.4M** (`+18% MoM`, Target Rp 10.5M, 118% Capaian).
   * **Net Profit (Bersih):** **Rp 5.3M** (`+4.2% MoM`, Margin Profit 42.7% Sangat Sehat).
   * **Beban Operasional:** **Rp 7.1M** (`-3% Efisiensi`, Opex/Rev Ratio 57.2%).
   * **Rata-rata Skor Peluang:** **84 / 100** (12 Peluang Aktif, Konversi AI 91.4%).
3. **Visualisasi Komposisi Finansial:**
   * **Grafik Batang Pertumbuhan Mingguan:** Komparasi Gross Revenue vs Net Profit per Minggu (Minggu 1 s.d. Minggu 4).
   * **Distribusi Saluran Penjualan:**
     - Shopee Mall: 45% (Rp 5.58M)
     - Tokopedia Store: 30% (Rp 3.72M)
     - Toko Fisik (Offline): 25% (Rp 3.10M)
   * **Donut Chart Struktur Portofolio Penjualan (Nilai SKU: Rp 11.5M):**
     - Kopi Arabica Gayo (Champion Terlaris): Rp 4.2M (34%)
     - Pensil Labubu (Fast Moving Viral Item): Rp 3.1M (25%)
     - Tumbler Stainless 500ml (Dead Stock 45 Hari Tertahan): Rp 1.8M
     - Aksesoris Stationery (Potensi Naik): Rp 2.4M
4. **Ringkasan Evaluasi Eksekutif LARIS (Actionable Takeaway Card):**
   * *1. Target Tercapai:* Penjualan tumbuh 18% MoM berkat pesanan Shopee di minggu ke-4.
   * *2. Validasi AI Berhasil:* Pensil Labubu membuktikan akurasi LARIS Predict dengan realisasi ROI 48% dalam 14 hari.
   * *3. Tindakan Bulan Depan:* Segera cairkan modal mati Tumbler Stainless lewat promo bundling gajian, alihkan arus kas ke Kopi & Aksesoris Stationery.
   * Tombol CTA: `[Kirim Ringkasan via WhatsApp]` & `[Jadwalkan Konsultasi Juragan AI]`.

---

## 4. Pola Interaktivitas & Desain Transisi (UX Micro-interactions)

1. **Seamless Simulator Sync:** Ketika pengguna mengklik tombol `[Simulate in Predict]` pada kartu Trend Hunter atau rekomendasi Juragan AI, form *LARIS Predict* akan otomatis terisi dengan data produk terkait tanpa mengetik ulang.
2. **One-Click PO Consolidation:** Tombol *Auto-Bundle* pada Smart Inventory menggabungkan beberapa barang kritis ke dalam satu format faktur order supplier yang dapat langsung dikirim ke WhatsApp distributor.
3. **Explainable AI Drilldown:** Setiap badge skor atau rekomendasi memiliki ikon informasi yang memunculkan faktor penentu akurasi (misal: histori data, sinyal TikTok, demografi lokal).
