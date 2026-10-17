<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LARIS — AI Business Intelligence & Decision Platform for MSMEs. Solusi Inovatif AI for All untuk Pemerataan Daya Saing UMKM Indonesia.">
    <title>LARIS — AI Business Intelligence & Decision Platform for MSMEs</title>
    
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    
    <!-- Typography: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --brand-dark: #080E14;
            --brand-surface: #0F1A24;
            --brand-card: #142332;
            --brand-border: #1E3347;
            
            --accent-mint: #10B981;
            --accent-mint-hover: #059669;
            --accent-cyan: #06B6D4;
            --accent-blue: #0284C7;
            --accent-lime: #CCFF00;
            
            --text-white: #FFFFFF;
            --text-light: #F1F5F9;
            --text-muted: #94A3B8;
            --text-dim: #64748B;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--brand-dark);
            color: var(--text-light);
            overflow-x: hidden;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* FIXED HEADER / NAVIGATION (PLN SustainAction Style) */
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 76px;
            background: rgba(8, 14, 20, 0.82);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
        }

        .header-container {
            max-width: 1280px;
            height: 100%;
            margin: 0 auto;
            padding: 0 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand-logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo-img {
            height: 38px;
            width: auto;
            object-fit: contain;
            filter: drop-shadow(0 0 12px rgba(16, 185, 129, 0.45));
            transition: transform 0.25s ease;
        }

        .brand-logo-img:hover {
            transform: scale(1.03);
        }

        .desktop-nav {
            display: flex;
            align-items: center;
            gap: 28px;
            list-style: none;
        }

        .desktop-nav a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            transition: color 0.2s ease;
            letter-spacing: -0.01em;
        }

        .desktop-nav a:hover {
            color: var(--text-white);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-header-login {
            color: var(--text-white);
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.16);
            padding: 9px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .btn-header-login:hover {
            background: rgba(255, 255, 255, 0.14);
            border-color: rgba(255, 255, 255, 0.3);
            color: var(--text-white);
        }

        .btn-header-primary {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: #FFFFFF;
            padding: 9px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);
        }

        .btn-header-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.45);
        }

        /* MOBILE MENU TOGGLE */
        .btn-menu-toggle {
            display: none;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 10px;
            padding: 8px;
            color: #FFFFFF;
            cursor: pointer;
        }

        .mobile-dropdown-menu {
            display: none;
            position: fixed;
            top: 76px;
            left: 0;
            right: 0;
            background: rgba(8, 14, 20, 0.96);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px 24px;
            z-index: 999;
            flex-direction: column;
            gap: 16px;
        }

        .mobile-dropdown-menu.active {
            display: flex;
        }

        .mobile-dropdown-menu a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* HERO SECTION WITH FULLSCREEN BACKGROUND VIDEO */
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 130px 24px 80px 24px;
            overflow: hidden;
        }

        .hero-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            z-index: 1;
            pointer-events: none;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, 
                rgba(8, 14, 20, 0.76) 0%, 
                rgba(8, 14, 20, 0.65) 45%, 
                rgba(8, 14, 20, 0.94) 85%, 
                var(--brand-dark) 100%);
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            max-width: 980px;
            margin: 0 auto;
            text-align: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(16, 185, 129, 0.14);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #34D399;
            padding: 7px 18px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-bottom: 24px;
            backdrop-filter: blur(8px);
        }

        .hero-title {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.025em;
            color: #FFFFFF;
            margin-bottom: 22px;
        }

        .hero-title span {
            background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 18px;
            color: #CBD5E1;
            max-width: 760px;
            margin: 0 auto 36px auto;
            line-height: 1.65;
            font-weight: 400;
        }

        .hero-btn-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 48px;
            flex-wrap: wrap;
        }

        .btn-hero-main {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: #FFFFFF;
            font-size: 15px;
            font-weight: 700;
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.38);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-hero-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.5);
        }

        .btn-hero-sec {
            background: rgba(255, 255, 255, 0.08);
            color: #FFFFFF;
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 15px;
            font-weight: 600;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.25s ease;
            backdrop-filter: blur(8px);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-hero-sec:hover {
            background: rgba(255, 255, 255, 0.16);
            border-color: rgba(255, 255, 255, 0.35);
        }

        /* METRIC HIGHLIGHT STRIP */
        .hero-metrics {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            max-width: 900px;
            margin: 0 auto;
            background: rgba(15, 26, 36, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 20px 24px;
        }

        .metric-item {
            text-align: center;
        }

        .metric-value {
            font-size: 24px;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.02em;
        }

        .metric-value.mint { color: #34D399; }
        .metric-value.cyan { color: #38BDF8; }
        .metric-value.amber { color: #FBBF24; }
        .metric-value.purple { color: #A78BFA; }

        .metric-label {
            font-size: 11.5px;
            color: var(--text-muted);
            font-weight: 600;
            margin-top: 2px;
        }

        /* SECTION BASE STYLES */
        .section-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 90px 28px;
        }

        .section-header {
            text-align: center;
            max-width: 740px;
            margin: 0 auto 56px auto;
        }

        .section-tag {
            display: inline-block;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #34D399;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 34px;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #FFFFFF;
            margin-bottom: 16px;
            line-height: 1.25;
        }

        .section-desc {
            font-size: 16px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* 4 ROLE GATEWAY CARDS */
        .role-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
        }

        .role-card {
            background: var(--brand-surface);
            border: 1px solid var(--brand-border);
            border-radius: 20px;
            padding: 28px 22px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .role-card:hover {
            transform: translateY(-5px);
            border-color: rgba(52, 211, 153, 0.4);
            box-shadow: 0 16px 36px -4px rgba(0, 0, 0, 0.45);
        }

        .role-card-top {
            margin-bottom: 24px;
        }

        .role-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }

        .icon-owner { background: rgba(16, 185, 129, 0.14); color: #34D399; }
        .icon-cashier { background: rgba(56, 189, 248, 0.14); color: #38BDF8; }
        .icon-inventory { background: rgba(245, 158, 11, 0.14); color: #FBBF24; }
        .icon-customer { background: rgba(168, 85, 247, 0.14); color: #C084FC; }

        .role-badge-tag {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 12px;
        }

        .badge-owner { background: rgba(16, 185, 129, 0.14); color: #34D399; }
        .badge-cashier { background: rgba(56, 189, 248, 0.14); color: #38BDF8; }
        .badge-inventory { background: rgba(245, 158, 11, 0.14); color: #FBBF24; }
        .badge-customer { background: rgba(168, 85, 247, 0.14); color: #C084FC; }

        .role-name {
            font-size: 19px;
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 10px;
        }

        .role-explanation {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.55;
            margin-bottom: 18px;
        }

        .role-feature-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 22px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            padding-top: 14px;
        }

        .role-feature-item {
            font-size: 12px;
            color: #CBD5E1;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .role-feature-item svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
            margin-top: 3px;
            color: #34D399;
        }

        .btn-role-action {
            display: block;
            width: 100%;
            text-align: center;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid var(--brand-border);
            color: #FFFFFF;
            font-size: 13px;
            font-weight: 700;
            padding: 11px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .role-card:hover .btn-role-action {
            background: #10B981;
            border-color: #10B981;
            color: #FFFFFF;
        }

        /* ABOUT SECTION (PLN SustainAction Gradient Style) */
        .about-gradient-section {
            background: linear-gradient(115deg, #0A1926 0%, #0F2D3D 45%, #083344 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: relative;
            padding: 90px 24px;
        }

        .about-inner {
            max-width: 820px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .about-inner h2 {
            font-size: 32px;
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 24px;
            line-height: 1.3;
        }

        .about-inner p {
            font-size: 16px;
            color: #E2E8F0;
            line-height: 1.75;
            margin-bottom: 20px;
            font-weight: 400;
        }

        /* TECH & EDGE AI SECTION */
        .tech-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .tech-card {
            background: var(--brand-surface);
            border: 1px solid var(--brand-border);
            border-radius: 18px;
            padding: 30px 24px;
            transition: all 0.25s ease;
        }

        .tech-card:hover {
            border-color: rgba(56, 189, 248, 0.4);
            transform: translateY(-3px);
        }

        .tech-icon-circle {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(56, 189, 248, 0.12);
            color: #38BDF8;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }

        .tech-card h3 {
            font-size: 18px;
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 10px;
        }

        .tech-card p {
            font-size: 13.5px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* TWO-SIDED PLATFORM ECOSYSTEM SECTION */
        .ecosystem-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: center;
        }

        .ecosystem-box {
            background: var(--brand-surface);
            border: 1px solid var(--brand-border);
            border-radius: 20px;
            padding: 34px 28px;
        }

        .ecosystem-box.umkm {
            border-left: 4px solid #10B981;
        }

        .ecosystem-box.consumer {
            border-left: 4px solid #38BDF8;
        }

        .ecosystem-box h3 {
            font-size: 20px;
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ecosystem-box ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
            font-size: 13.5px;
            color: #CBD5E1;
        }

        .ecosystem-box li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.5;
        }

        .ecosystem-box li svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* FOOTER */
        .site-footer {
            background: #05080C;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 48px 28px 36px 28px;
            color: var(--text-dim);
            font-size: 13px;
        }

        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-links {
            display: flex;
            gap: 24px;
            list-style: none;
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: #FFFFFF;
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 1024px) {
            .role-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .tech-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .hero-title {
                font-size: 42px;
            }
            .desktop-nav {
                display: none;
            }
            .btn-menu-toggle {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 32px;
            }
            .hero-desc {
                font-size: 15px;
            }
            .hero-metrics {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                padding: 16px;
            }
            .role-grid {
                grid-template-columns: 1fr;
            }
            .tech-grid {
                grid-template-columns: 1fr;
            }
            .ecosystem-wrap {
                grid-template-columns: 1fr;
            }
            .footer-container {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- TOP FIXED HEADER (PLN SustainAction 2026 Style) -->
    <header class="site-header" id="site-header">
        <div class="header-container">
            <a href="{{ url('/') }}" class="brand-logo-area" aria-label="LARIS - Beranda">
                <img class="brand-logo-img" src="{{ asset('logo.png') }}" alt="LARIS Platform">
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="desktop-nav">
                <a href="#about">Tentang Inovasi</a>
                <a href="#roles">4 Pilihan Peran</a>
                <a href="#edge-ai">Edge AI (Offline)</a>
                <a href="#ecosystem">Ekosistem 2 Sisi</a>
                <a href="{{ url('/pembeli') }}" target="_blank" style="color: #34D399; font-weight: 700;">Portal Pembeli ↗</a>
            </nav>

            <!-- Action Buttons -->
            <div class="header-actions">
                @auth
                    @php
                        $user = Auth::user();
                        $targetUrl = match($user->role) {
                            'staff_cashier' => route('cashier.dashboard'),
                            'staff_inventory' => route('inventory_staff.dashboard'),
                            'customer' => route('customer.dashboard'),
                            default => route('dashboard'),
                        };
                    @endphp
                    <a href="{{ $targetUrl }}" class="btn-header-primary">Buka Dashboard &rarr;</a>
                @else
                    <a href="{{ route('login') }}" class="btn-header-login">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-header-primary">Daftar Akun</a>
                @endauth

                <!-- Mobile Hamburger Toggle -->
                <button type="button" class="btn-menu-toggle" id="btn-menu-toggle" onclick="toggleMobileMenu()" aria-label="Buka Menu Navigasi">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Dropdown Navigation -->
    <div class="mobile-dropdown-menu" id="mobile-dropdown-menu">
        <a href="#about" onclick="toggleMobileMenu()">Tentang Inovasi</a>
        <a href="#roles" onclick="toggleMobileMenu()">4 Pilihan Peran</a>
        <a href="#edge-ai" onclick="toggleMobileMenu()">Edge AI (Offline)</a>
        <a href="#ecosystem" onclick="toggleMobileMenu()">Ekosistem 2 Sisi</a>
        <a href="{{ url('/pembeli') }}" target="_blank" onclick="toggleMobileMenu()" style="color: #34D399;">Portal Belanja Warga ↗</a>
        @auth
            <a href="{{ $targetUrl ?? route('dashboard') }}" style="color: #34D399; font-weight: 700;">Buka Dashboard Anda &rarr;</a>
        @else
            <a href="{{ route('login') }}">Masuk ke Sistem</a>
            <a href="{{ route('register') }}" style="color: #34D399;">Daftar Akun Baru</a>
        @endauth
    </div>

    <!-- MAIN CONTENT -->
    <main>
        <!-- HERO SECTION WITH CONTINUOUS LOOPING MUTED VIDEO -->
        <section id="home" class="hero-section">
            <!-- Fullscreen Video Element: Autoplay, Loop, Muted, Playsinline -->
            <video class="hero-video" id="hero-bg-video" autoplay loop muted playsinline preload="auto">
                <source src="{{ asset('video.mp4') }}" type="video/mp4">
            </video>
            
            <!-- Dark Gradient Cinematic Overlay -->
            <div class="hero-overlay" aria-hidden="true"></div>

            <!-- Hero Message Copy -->
            <div class="hero-content">
                <div class="hero-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                    <span>MEUKARYA TEAM • INFEST HACKATHON 2026 • AI FOR ALL</span>
                </div>

                <h1 class="hero-title">
                    AI Business Intelligence &<br>
                    <span>Decision Platform for MSMEs</span>
                </h1>

                <p class="hero-desc">
                    Mengubah data kasir POS dan sinyal pasar menjadi keputusan bisnis nyata dengan <strong>Explainable AI</strong>. Dilengkapi On-Device Edge AI (LARIS Lite) yang tetap aktif di daerah 3T tanpa internet, serta menghubungkan UMKM dengan konsumen sekitar secara inklusif.
                </p>

                <div class="hero-btn-group">
                    <a href="{{ route('login') }}" class="btn-hero-main">
                        <span>Mulai Demo Platform</span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                    <a href="{{ url('/pembeli') }}" target="_blank" class="btn-hero-sec">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                        <span>Portal Belanja Warga (Sisi Pembeli)</span>
                    </a>
                </div>

                <!-- 4 KPI Metrics Strip -->
                <div class="hero-metrics">
                    <div class="metric-item">
                        <div class="metric-value mint">0 Menit</div>
                        <div class="metric-label">Downtime Offline (LARIS Lite)</div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value cyan">88%</div>
                        <div class="metric-label">Akurasi Prediksi Restock</div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value amber">&lt; 15 Detik</div>
                        <div class="metric-label">Generate Draf PO Otomatis</div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value purple">4 Peran</div>
                        <div class="metric-label">Dashboard &amp; Sesi Terpisah</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4 ROLE GATEWAY SECTION (Role-Separated Dashboards) -->
        <section id="roles" class="section-container">
            <div class="section-header">
                <span class="section-tag">Struktur Peran Terisolasi</span>
                <h2 class="section-title">4 Dashboard Mandiri Sesuai Alur Kerja Nyata</h2>
                <p class="section-desc">
                    Setiap peran memiliki kredensial sesi, rute akses, dan menu navigasi yang terpisah penuh tanpa tercampur aduk.
                </p>
            </div>

            <div class="role-grid">
                <!-- 1. JURAGAN (OWNER) -->
                <article class="role-card">
                    <div class="role-card-top">
                        <div class="role-icon-box icon-owner">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                        </div>
                        <span class="role-badge-tag badge-owner">Juragan (Owner)</span>
                        <h3 class="role-name">Business Dashboard</h3>
                        <p class="role-explanation">
                            Kendali eksekutif untuk melihat kesehatan bisnis, peluang margin baru, dan asisten keputusan AI.
                        </p>
                        <ul class="role-feature-list">
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Simulasi LARIS Predict ("What If")</span>
                            </li>
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Trend Hunter &amp; Opportunity Radar</span>
                            </li>
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Juragan AI Copilot &amp; Laporan WhatsApp</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('login') }}" class="btn-role-action">Masuk sebagai Juragan &rarr;</a>
                </article>

                <!-- 2. KASIR TOKO -->
                <article class="role-card">
                    <div class="role-card-top">
                        <div class="role-icon-box icon-cashier">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0-8.25h19.5m0 0v8.25m0-8.25v-.75a.75.75 0 0 0-.75-.75h-.75m0 0V4.5m-18 0h18"/></svg>
                        </div>
                        <span class="role-badge-tag badge-cashier">Kasir Frontliner</span>
                        <h3 class="role-name">Smart POS Kasir</h3>
                        <p class="role-explanation">
                            Antarmuka kasir gesit tanpa lag untuk melayani transaksi cepat, barcode scan, dan cetak struk.
                        </p>
                        <ul class="role-feature-list">
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Pemotongan stok atomik real-time</span>
                            </li>
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Simulasi QRIS Dinamis &amp; Tunai Cepat</span>
                            </li>
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Cek stok barang langsung dari kasir</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('login') }}" class="btn-role-action">Masuk sebagai Kasir &rarr;</a>
                </article>

                <!-- 3. STAF GUDANG & LOGISTIK -->
                <article class="role-card">
                    <div class="role-card-top">
                        <div class="role-icon-box icon-inventory">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m16.5 0v-1.5a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25v1.5m16.5 0H3.75"/></svg>
                        </div>
                        <span class="role-badge-tag badge-inventory">Staf Gudang</span>
                        <h3 class="role-name">Inventory Control</h3>
                        <p class="role-explanation">
                            Monitoring stok fisik, peringatan barang kritis (&lt; 4 hari), dan generate Purchase Order otomatis.
                        </p>
                        <ul class="role-feature-list">
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Peringatan runway stok kritis</span>
                            </li>
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Auto-bundle draf PO ke supplier</span>
                            </li>
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Input penerimaan fisik barang masuk</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('login') }}" class="btn-role-action">Masuk sebagai Staf Gudang &rarr;</a>
                </article>

                <!-- 4. KONSUMEN / PELANGGAN WARGA -->
                <article class="role-card">
                    <div class="role-card-top">
                        <div class="role-icon-box icon-customer">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                        </div>
                        <span class="role-badge-tag badge-customer">Konsumen Warga</span>
                        <h3 class="role-name">Portal Pelanggan</h3>
                        <p class="role-explanation">
                            Akses katalog toko, promo flash sale jam 7 malam, titip kulakan, dan kupon diskon warga.
                        </p>
                        <ul class="role-feature-list">
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Flash Sale Cuci Rak Jam 7 Malam</span>
                            </li>
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Titip Kulakan Pre-Order Harga Grosir</span>
                            </li>
                            <li class="role-feature-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Dompet kupon warga &amp; pembayaran QRIS</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('login') }}" class="btn-role-action">Masuk sebagai Konsumen &rarr;</a>
                </article>
            </div>
        </section>

        <!-- ABOUT SECTION (PLN SustainAction Gradient Aesthetic) -->
        <section id="about" class="about-gradient-section">
            <div class="about-inner">
                <span class="section-tag" style="color: #6EE7B7;">Misi Inovasi Sosial &amp; Ekonomi</span>
                <h2>Membawa Kecerdasan Korporat ke Warung &amp; UMKM Indonesia</h2>
                <p>
                    Selama ini, sistem analitik cerdas dan AI prediktif hanya dinikmati oleh jaringan ritel modern raksasa dengan modal triliunan rupiah. Pemilik toko kelontong dan UMKM tradisional harus berspekulasi dengan modal terbatas, sering terjebak dead-stock, atau kehabisan stok saat permintaan melonjak.
                </p>
                <p>
                    <strong>LARIS hadir sebagai jawaban nyata untuk tema "AI for All: Intelligent Solutions for an Equitable Future".</strong> Kami mendemokratisasi akses ke data intelligence dengan antarmuka yang ramah bagi semua usia, Explainable AI yang menyertakan alasan transparan (Confidence Score &amp; Why Factor), serta mekanisme On-Device Edge AI agar UMKM di daerah 3T yang minim sinyal internet tetap berdaya dan sejahtera.
                </p>
            </div>
        </section>

        <!-- EDGE AI & OFFLINE FIRST SECTION -->
        <section id="edge-ai" class="section-container">
            <div class="section-header">
                <span class="section-tag">Ketahanan Tanpa Internet</span>
                <h2 class="section-title">LARIS Lite: On-Device Edge AI untuk Daerah 3T</h2>
                <p class="section-desc">
                    Inovasi teknologi yang memastikan operasional UMKM tidak pernah terhenti meskipun sinyal internet padam total.
                </p>
            </div>

            <div class="tech-grid">
                <div class="tech-card">
                    <div class="tech-icon-circle">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.516 0c.85.493 1.508 1.333 1.508 2.316V18"/></svg>
                    </div>
                    <h3>Edge AI On-Device</h3>
                    <p>Model AI berjalan langsung di peramban dan HP (Client Edge) menggunakan cache lokal. Prediksi tren dasar dan penghitungan runway stok tetap akurat tanpa memerlukan server eksternal.</p>
                </div>

                <div class="tech-card">
                    <div class="tech-icon-circle">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                    </div>
                    <h3>Sinkronisasi Otomatis</h3>
                    <p>Transaksi saat offline disimpan dalam antrean aman. Begitu perangkat mendeteksi jaringan internet pulih, seluruh riwayat langsung tersinkronisasi ke basis data tanpa ada data yang hilang.</p>
                </div>

                <div class="tech-card">
                    <div class="tech-icon-circle">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                    </div>
                    <h3>Explainable AI (XAI)</h3>
                    <p>Bukan kotak hitam (black-box). Setiap rekomendasi stok, prediksi laris, dan saran diskon disertai alasan logis dan Confidence Score teruji yang mudah dipahami pemilik warung.</p>
                </div>
            </div>
        </section>

        <!-- TWO-SIDED PLATFORM ECOSYSTEM SECTION -->
        <section id="ecosystem" class="section-container" style="padding-top: 20px;">
            <div class="section-header">
                <span class="section-tag">Ekosistem Saling Menguntungkan</span>
                <h2 class="section-title">Two-Sided Platform: UMKM &amp; Konsumen Bersinergi</h2>
                <p class="section-desc">
                    LARIS tidak hanya menolong pemilik usaha, tetapi juga memberikan keuntungan nyata bagi warga sekitar yang berbelanja.
                </p>
            </div>

            <div class="ecosystem-wrap">
                <!-- Sisi UMKM -->
                <div class="ecosystem-box umkm">
                    <h3>
                        <svg width="22" height="22" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.651h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z"/></svg>
                        <span>Sisi Pemilik UMKM</span>
                    </h3>
                    <ul>
                        <li>
                            <svg fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Zero Food Waste:</strong> Cuci rak otomatis jam 7 malam mencairkan barang mendekati exp date menjadi modal tunai.</span>
                        </li>
                        <li>
                            <svg fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Kepastian Modal:</strong> Pesanan pre-order dari warga dikumpulkan terlebih dahulu sebelum belanja kulakan.</span>
                        </li>
                        <li>
                            <svg fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Kulakan Bareng:</strong> Menggabungkan kuota belanja dengan warung terdekat untuk mendapat potongan harga distributor.</span>
                        </li>
                    </ul>
                </div>

                <!-- Sisi Konsumen -->
                <div class="ecosystem-box consumer">
                    <h3>
                        <svg width="22" height="22" fill="none" stroke="#38BDF8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>
                        <span>Sisi Konsumen &amp; Warga</span>
                    </h3>
                    <ul>
                        <li>
                            <svg fill="none" stroke="#38BDF8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Hemat Pengeluaran:</strong> Beli sembako dan produk berkualitas dengan diskon hingga 50% di promo cuci rak.</span>
                        </li>
                        <li>
                            <svg fill="none" stroke="#38BDF8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Transparansi Stok:</strong> Cek ketersediaan sembako di warung terdekat langsung dari HP tanpa repot jalan kaki.</span>
                        </li>
                        <li>
                            <svg fill="none" stroke="#38BDF8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Dukung Ekonomi Lokal:</strong> Uang berputar di lingkungan tetangga sendiri, memperkuat daya beli komunitas warga.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="footer-container">
            <div>
                <img src="{{ asset('logo.png') }}" alt="LARIS Logo" style="height: 28px; margin-bottom: 8px;">
                <div>&copy; 2026 LARIS Platform — Meukarya Team (Universitas Serambi Mekkah).</div>
                <div style="font-size: 11.5px; color: #64748B; margin-top: 4px;">Inovasi AI untuk Pemerataan Daya Saing UMKM Indonesia • Infest Hackathon 2026</div>
            </div>

            <ul class="footer-links">
                <li><a href="#about">Tentang</a></li>
                <li><a href="#roles">4 Peran</a></li>
                <li><a href="#edge-ai">Edge AI</a></li>
                <li><a href="{{ url('/pembeli') }}" target="_blank">Portal Pembeli</a></li>
                <li><a href="{{ route('login') }}">Masuk</a></li>
            </ul>
        </div>
    </footer>

    <!-- SCRIPT FOR VIDEO LOOP SAFEGUARD & MOBILE MENU -->
    <script>
        /* Continuous Video Loop Safeguard */
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('hero-bg-video');
            if (video) {
                video.muted = true;
                video.defaultMuted = true;
                video.playsInline = true;
                video.loop = true;

                // Ensure continuous playback
                const playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise.catch(function(error) {
                        // In case browser autoplay policy asks for muted confirmation
                        video.muted = true;
                        video.play();
                    });
                }

                // Extra loop assurance if loop attribute encounters edge cases
                video.addEventListener('ended', function() {
                    video.currentTime = 0;
                    video.play();
                });
            }
        });

        /* Mobile Dropdown Menu Toggle */
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-dropdown-menu');
            if (menu) {
                menu.classList.toggle('active');
            }
        }

        /* Header backdrop elevation on scroll */
        window.addEventListener('scroll', function() {
            const header = document.getElementById('site-header');
            if (header) {
                if (window.scrollY > 40) {
                    header.style.background = 'rgba(8, 14, 20, 0.95)';
                    header.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.5)';
                } else {
                    header.style.background = 'rgba(8, 14, 20, 0.82)';
                    header.style.boxShadow = 'none';
                }
            }
        });
    </script>
</body>
</html>
