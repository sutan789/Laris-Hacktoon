<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LARIS — AI Business Intelligence & Decision Platform for MSMEs</title>
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #080D0F;
            --accent-lime: #CCFF00;
            --accent-lime-hover: #B4F000;
            --border-dark: #1E2D33;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #FFFFFF;
            overflow-x: hidden;
            background-image: radial-gradient(circle at 50% 0%, rgba(204, 255, 0, 0.15) 0%, transparent 60%);
        }
        /* NAVBAR */
        .landing-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 48px;
            max-width: 1280px;
            margin: 0 auto;
        }
        .nav-logo img {
            height: 40px;
            filter: drop-shadow(0 0 14px rgba(204, 255, 0, 0.6));
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }
        .nav-links a {
            color: #94A3B8;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.2s;
        }
        .nav-links a:hover {
            color: #FFFFFF;
        }
        .nav-btns {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .btn-outline-landing {
            color: #FFFFFF;
            border: 1px solid #24353E;
            padding: 9px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.2s;
        }
        .btn-outline-landing:hover {
            border-color: var(--accent-lime);
            color: var(--accent-lime);
        }
        .btn-lime-landing {
            background: var(--accent-lime);
            color: #000000;
            padding: 9px 22px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(204, 255, 0, 0.35);
        }
        .btn-lime-landing:hover {
            background: var(--accent-lime-hover);
            transform: translateY(-1px);
        }

        /* HERO SECTION */
        .hero-section {
            max-width: 1100px;
            margin: 60px auto 40px auto;
            text-align: center;
            padding: 0 24px;
        }
        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(204, 255, 0, 0.12);
            border: 1px solid rgba(204, 255, 0, 0.3);
            color: var(--accent-lime);
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 24px;
            letter-spacing: 0.5px;
        }
        .hero-title {
            font-size: 54px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            margin-bottom: 24px;
        }
        .hero-title span {
            background: linear-gradient(135deg, #CCFF00 0%, #FFFFFF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-sub {
            font-size: 18px;
            color: #94A3B8;
            max-width: 720px;
            margin: 0 auto 36px auto;
            line-height: 1.6;
        }
        .hero-cta-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 60px;
        }
        .btn-hero-main {
            background: var(--accent-lime);
            color: #000000;
            font-size: 16px;
            font-weight: 800;
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(204, 255, 0, 0.4);
            transition: all 0.2s;
        }
        .btn-hero-main:hover {
            transform: translateY(-2px);
            background: var(--accent-lime-hover);
        }
        .btn-hero-secondary {
            background: #141E24;
            color: #FFFFFF;
            border: 1px solid #24353E;
            font-size: 16px;
            font-weight: 700;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-hero-secondary:hover {
            border-color: #CBD5E1;
        }

        /* 3 ROLES SHOWCASE CARDS */
        .roles-section {
            max-width: 1200px;
            margin: 40px auto 100px auto;
            padding: 0 24px;
        }
        .sec-title {
            text-align: center;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 12px;
        }
        .sec-sub {
            text-align: center;
            color: #94A3B8;
            font-size: 15px;
            margin-bottom: 48px;
        }
        .roles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .role-card {
            background: #0E161A;
            border: 1px solid #1E2D33;
            border-radius: 20px;
            padding: 32px 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .role-card:hover {
            border-color: var(--accent-lime);
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.5);
        }
        .role-icon {
            font-size: 36px;
            margin-bottom: 16px;
        }
        .role-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 12px;
        }
        .badge-owner { background: rgba(204, 255, 0, 0.15); color: #CCFF00; }
        .badge-cashier { background: rgba(34, 197, 94, 0.15); color: #4ADE80; }
        .badge-inventory { background: rgba(59, 130, 246, 0.15); color: #60A5FA; }

        .role-title { font-size: 20px; font-weight: 800; margin-bottom: 8px; }
        .role-desc { font-size: 13px; color: #94A3B8; line-height: 1.6; margin-bottom: 24px; }
        .role-btn {
            background: #141E24;
            border: 1px solid #24353E;
            color: #FFFFFF;
            padding: 10px;
            text-align: center;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            transition: all 0.2s;
        }
        .role-card:hover .role-btn {
            background: var(--accent-lime);
            color: #000000;
            border-color: var(--accent-lime);
        }

        /* FOOTER */
        .landing-footer {
            border-top: 1px solid #1E2D33;
            padding: 36px 48px;
            text-align: center;
            color: #64748B;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .landing-nav {
                padding: 16px 20px;
                flex-direction: column;
                gap: 16px;
            }
            .nav-links {
                gap: 18px;
                font-size: 13px;
                flex-wrap: wrap;
                justify-content: center;
            }
            .hero-section {
                padding: 60px 20px 40px 20px;
            }
            .hero-title {
                font-size: 32px;
                line-height: 1.25;
            }
            .hero-sub {
                font-size: 14px;
            }
            .roles-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .hero-cta-group {
                flex-direction: column;
                width: 100%;
                max-width: 320px;
                margin: 0 auto;
                gap: 12px;
            }
            .btn-hero-main, .btn-hero-secondary {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="landing-nav">
        <a href="{{ url('/') }}" class="nav-logo">
            <img src="{{ asset('logo.png') }}" alt="LARIS Logo">
        </a>
        <ul class="nav-links">
            <li><a href="#roles">Pilihan Role</a></li>
            <li><a href="#fitur">Fitur Unggulan</a></li>
            <li><a href="https://laris.meukarya.my.id" target="_blank">Tentang Tim</a></li>
        </ul>
        <div class="nav-btns">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-lime-landing">Buka Dashboard &rarr;</a>
            @else
                <a href="{{ route('login') }}" class="btn-outline-landing">Masuk</a>
                <a href="{{ route('register') }}" class="btn-lime-landing">Daftar Toko</a>
            @endauth
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="hero-tag">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: -2px; margin-right: 4px;"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
            <span>MEUKARYA TEAM • INFEST HACKATHON 2026</span>
        </div>
        <h1 class="hero-title">
            AI Business Intelligence &<br>
            <span>Decision Platform for MSMEs</span>
        </h1>
        <p class="hero-sub">
            Ubah data kasir POS dan sinyal tren pasar menjadi keputusan bisnis nyata dengan <strong>Explainable AI</strong>. Tahu barang apa yang harus dijual, kapan harus restock, dan cara menaikkan profit tanpa spekulasi.
        </p>
        <div class="hero-cta-group">
            <a href="{{ route('login') }}" class="btn-hero-main">Mulai Demo Sekarang &rarr;</a>
            <a href="#roles" class="btn-hero-secondary">Lihat Antarmuka Role</a>
        </div>
    </section>

    <!-- 3 ROLES SECTION -->
    <section id="roles" class="roles-section">
        <h2 class="sec-title">Dashboard Disesuaikan untuk Setiap Peran</h2>
        <p class="sec-sub">Setiap anggota tim toko memiliki dashboard kerja yang akurat, intuitif, dan terfokus</p>

        <div class="roles-grid">
            <!-- 1. OWNER -->
            <div class="role-card">
                <div>
                    <div class="role-icon" style="background: rgba(204, 255, 0, 0.12); color: #CCFF00; display: inline-flex; align-items: center; justify-content: center; width: 50px; height: 50px; border-radius: 14px; margin-bottom: 16px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4l3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14"/></svg>
                    </div>
                    <div>
                        <span class="role-badge badge-owner">Juragan / Owner</span>
                    </div>
                    <h3 class="role-title">Business Dashboard</h3>
                    <p class="role-desc">Pusat kendali eksekutif: Telemetri omzet harian, Opportunity Radar, simulasi "What If I Sell This?" (LARIS Predict), dan asisten Copilot Juragan AI.</p>
                </div>
                <a href="{{ route('login') }}" class="role-btn">Masuk sebagai Juragan &rarr;</a>
            </div>

            <!-- 2. CASHIER -->
            <div class="role-card">
                <div>
                    <div class="role-icon" style="background: rgba(56, 189, 248, 0.12); color: #38BDF8; display: inline-flex; align-items: center; justify-content: center; width: 50px; height: 50px; border-radius: 14px; margin-bottom: 16px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                    </div>
                    <div>
                        <span class="role-badge badge-cashier">Kasir / Frontliner</span>
                    </div>
                    <h3 class="role-title">Smart POS Cashier</h3>
                    <p class="role-desc">Antarmuka kasir cepat tanpa loading rumit. Pindai produk, transaksi QRIS/Tunai langsung motong stok atomik secara real-time dan rekap shift kasir.</p>
                </div>
                <a href="{{ route('login') }}" class="role-btn">Masuk sebagai Kasir &rarr;</a>
            </div>

            <!-- 3. INVENTORY -->
            <div class="role-card">
                <div>
                    <div class="role-icon" style="background: rgba(251, 146, 60, 0.12); color: #FB923C; display: inline-flex; align-items: center; justify-content: center; width: 50px; height: 50px; border-radius: 14px; margin-bottom: 16px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                    </div>
                    <div>
                        <span class="role-badge badge-inventory">Staf Gudang & Logistik</span>
                    </div>
                    <h3 class="role-title">Smart Inventory Control</h3>
                    <p class="role-desc">Pemantauan stok fisik, peringatan barang kritis (&lt; 4 hari stok), auto-bundle draf Purchase Order ke supplier dan tracking barang masuk.</p>
                </div>
                <a href="{{ route('login') }}" class="role-btn">Masuk sebagai Staf Gudang &rarr;</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="landing-footer">
        &copy; 2026 LARIS — Meukarya Team (Universitas Serambi Mekkah). Inovasi AI untuk Pemerataan Daya Saing UMKM Indonesia.
    </footer>

</body>
</html>
