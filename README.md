# LARIS - AI Business Intelligence & Decision Platform for MSMEs

> **Developed by Meukarya Team for INFEST Hackathon 2026**  
> *"Empowering Indonesian MSMEs with Predictive Analytics, Automated Stock Bundling, and Real-Time POS Intelligence."*

---

## 🌟 Highlight Features

1. **Executive Real-Time Dashboard**
   - Live revenue, margin, and sales telemetry polling every 7 seconds.
   - Dynamic timeframe filters (*Hari Ini*, *7 Hari Terakhir*, *30 Hari Terakhir*).
   - Opportunity Radar AI insights and simulated cashier ordering (`+ Simulasi Kasir`).
   - One-click executive summary download (`/dashboard/download-summary`).

2. **Smart Inventory & Auto-Bundling Engine**
   - Real-time stock depletion tracker linked with SQLite database.
   - 7-Day Demand Forecasting modal with AI confidence indicators.
   - Dynamic Reorder modal and Buffer Stock filtering.
   - Auto-bundling generator matching slow-moving inventory with high-demand products.

3. **Trend Hunter Radar**
   - Multi-channel trend detection across TikTok Shop, Tokopedia, and Shopee.
   - Category filtering (Fashion Muslim, Kuliner Kekinian, Skincare Herbal, dll).
   - Live simulated radar scan with visual progress animation.

4. **Laris Predict Simulator**
   - Interactive business scenario simulator (Price elasticity, Marketing spend, Inventory risk).
   - Simulation history modal with instant parameter re-population.
   - Printable summary report export.

5. **Integrated Settings & Help Center**
   - Store profile manager and multi-channel toggle sync (Kasir POS, Shopee, Tokopedia, TikTok Shop).
   - AI Engine configuration with Gemini 3.8 Flash support.
   - Interactive Help Center with live searchable FAQ and instant support routing.

---

## 🛠️ Tech Stack & Requirements

- **Backend:** Laravel 11/12 (PHP >= 8.2)
- **Database:** SQLite (included with pre-seeded transactions & products)
- **Frontend:** Blade, TailwindCSS, Chart.js, Lucide Icons, Alpine.js / Vanilla JS
- **AI Engine:** Google Gemini AI API integration

---

## 🚀 Quick Start Guide

### 1. Clone the Repository
```bash
git clone https://github.com/Napwoy/Laris.git
cd Laris/laris_app
```

### 2. Install Dependencies
```bash
composer install
npm install
npm run build # or npm run dev
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
The SQLite database file `database/database.sqlite` is already populated and included in this repository.  
An equivalent SQL dump is also provided in `laris_database_dump.sql`.

If you wish to re-migrate or re-seed:
```bash
php artisan migrate:fresh --seed
```

### 5. Run Local Development Server
```bash
php artisan serve
```
Open your browser at [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## 👥 Meukarya Team
INFEST Hackathon 2026 Innovation Project. All rights reserved.
