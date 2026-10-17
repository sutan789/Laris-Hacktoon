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
            /* PLN SustainAction Oceanic & Modern Executive Palette */
            --pln-deep-navy: #04101E;
            --pln-blue-primary: #1C67AB;
            --pln-cyan: #00A2B9;
            --pln-teal: #4FB3B2;
            --pln-yellow-lime: #F2F15D;
            --pln-yellow-lime-hover: #E2E146;
            --pln-card-bg: #0A1C30;
            --pln-card-border: #153250;
            
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
            background-color: var(--pln-deep-navy);
            color: var(--text-light);
            overflow-x: hidden;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* 1. COMPLETELY TRANSPARENT FLOATING NAVBAR (PLN SustainAction Style) */
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 76px;
            background: transparent; /* 100% Transparent on Hero */
            border: none;
            box-shadow: none;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Glass blur applies smoothly only when scrolled down */
        .site-header.scrolled {
            background: rgba(4, 16, 30, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
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
            gap: 10px;
            text-decoration: none;
        }

        .brand-logo-img {
            height: 36px;
            width: auto;
            object-fit: contain;
            filter: drop-shadow(0 0 12px rgba(255, 255, 255, 0.4));
            transition: transform 0.25s ease;
        }

        .brand-logo-img:hover {
            transform: scale(1.04);
        }

        .desktop-nav {
            display: flex;
            align-items: center;
            gap: 26px;
            list-style: none;
        }

        .desktop-nav a {
            color: rgba(255, 255, 255, 0.88);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.2s ease;
            letter-spacing: -0.01em;
            position: relative;
        }

        .desktop-nav a:hover {
            color: #FFFFFF;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .desktop-nav a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0%;
            height: 2px;
            background: var(--pln-yellow-lime);
            transition: width 0.2s ease;
            border-radius: 2px;
        }

        .desktop-nav a:hover::after {
            width: 100%;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-header-login {
            color: #FFFFFF;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 9999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.2s ease;
        }

        .btn-header-login:hover {
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-1px);
        }

        .btn-header-primary {
            background: var(--pln-yellow-lime);
            color: #032D42;
            padding: 8px 20px;
            border-radius: 9999px;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 800;
            transition: all 0.2s ease;
            box-shadow: 0 4px 16px rgba(242, 241, 93, 0.35);
        }

        .btn-header-primary:hover {
            background: var(--pln-yellow-lime-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(242, 241, 93, 0.5);
        }

        /* MOBILE MENU TOGGLE */
        .btn-menu-toggle {
            display: none;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
            background: rgba(4, 16, 30, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px 24px;
            z-index: 999;
            flex-direction: column;
            gap: 14px;
        }

        .mobile-dropdown-menu.active {
            display: flex;
        }

        .mobile-dropdown-menu a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        /* 2. HERO SECTION WITH CONTINUOUS VIDEO LOOP & OCEANIC GRADIENT OVERLAY */
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

        /* Deep Oceanic Navy Tint Overlay (Matches PLN SustainAction 2026 exactly) */
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, 
                rgba(7, 24, 48, 0.45) 0%, 
                rgba(9, 36, 68, 0.62) 50%, 
                rgba(5, 18, 36, 0.92) 88%, 
                var(--pln-deep-navy) 100%);
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            max-width: 920px;
            margin: 0 auto;
            text-align: center;
            animation: fadeInScale 0.8s ease-out;
        }

        @keyframes fadeInScale {
            from { opacity: 0; transform: translateY(18px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Prominent Center Emblem Logo (Like PLN SustainAction) */
        .hero-center-logo {
            height: 60px;
            width: auto;
            object-fit: contain;
            margin: 0 auto 20px auto;
            display: block;
            filter: drop-shadow(0 0 24px rgba(0, 162, 185, 0.55)) brightness(1.08);
            animation: heroFloat 4s ease-in-out infinite;
        }

        @keyframes heroFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .hero-badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.22);
            color: #FFFFFF;
            padding: 6px 16px;
            border-radius: 9999px;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 22px;
            backdrop-filter: blur(8px);
        }

        /* Solid Crisp White Typography - NO Rainbow/Multi-color glare! */
        .hero-title {
            font-size: 46px;
            font-weight: 800;
            line-height: 1.18;
            letter-spacing: -0.025em;
            color: #FFFFFF;
            margin-bottom: 20px;
            text-shadow: 0 4px 24px rgba(0, 0, 0, 0.65);
        }

        .hero-desc {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
            max-width: 760px;
            margin: 0 auto 34px auto;
            line-height: 1.7;
            font-weight: 400;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .hero-btn-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 46px;
            flex-wrap: wrap;
        }

        /* Vibrant Yellow-Lime Pill Button (PLN SustainAction signature CTA) */
        .hero-cta-pln {
            background: var(--pln-yellow-lime);
            color: #041B29;
            font-size: 15px;
            font-weight: 800;
            padding: 14px 38px;
            border-radius: 9999px;
            text-decoration: none;
            box-shadow: 0 4px 25px rgba(242, 241, 93, 0.45);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .hero-cta-pln:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 32px rgba(242, 241, 93, 0.6);
            background: var(--pln-yellow-lime-hover);
            color: #000000;
        }

        .hero-cta-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #FFFFFF;
            border: 1px solid rgba(255, 255, 255, 0.25);
            font-size: 14.5px;
            font-weight: 700;
            padding: 14px 28px;
            border-radius: 9999px;
            text-decoration: none;
            transition: all 0.25s ease;
            backdrop-filter: blur(8px);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .hero-cta-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.45);
            transform: translateY(-1px);
        }

        /* Clean Unified KPI Metrics Strip */
        .hero-metrics {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            max-width: 880px;
            margin: 0 auto;
            background: rgba(10, 28, 48, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 20px 24px;
        }

        .metric-item {
            text-align: center;
        }

        .metric-value {
            font-size: 26px;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.02em;
        }

        .metric-label {
            font-size: 11.5px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
            margin-top: 3px;
        }

        /* SECTION BASE STYLES */
        .section-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 96px 28px;
        }

        .section-header {
            text-align: center;
            max-width: 760px;
            margin: 0 auto 52px auto;
        }

        .section-tag {
            display: inline-block;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--pln-yellow-lime);
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
            font-size: 15.5px;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.65;
        }

        /* 3. INTERACTIVE 4 ROLES EXPLORER WITH ANIMATED TAB SWITCHER */
        .role-tabs-nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 34px;
            flex-wrap: wrap;
        }

        .role-tab-btn {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.14);
            color: rgba(255, 255, 255, 0.8);
            font-size: 13.5px;
            font-weight: 700;
            padding: 10px 22px;
            border-radius: 9999px;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .role-tab-btn:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #FFFFFF;
        }

        .role-tab-btn.active {
            background: var(--pln-yellow-lime);
            color: #041B29;
            border-color: var(--pln-yellow-lime);
            box-shadow: 0 4px 18px rgba(242, 241, 93, 0.35);
        }

        .role-showcase-card {
            background: var(--pln-card-bg);
            border: 1px solid var(--pln-card-border);
            border-radius: 24px;
            padding: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            transition: all 0.35s ease;
            display: none;
        }

        .role-showcase-card.active {
            display: grid;
            animation: fadeInScale 0.35s ease-out;
        }

        .role-card-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--pln-yellow-lime);
            margin-bottom: 14px;
        }

        .role-card-title {
            font-size: 28px;
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 12px;
        }

        .role-card-summary {
            font-size: 14.5px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.65;
            margin-bottom: 24px;
        }

        .role-bullet-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 28px;
        }

        .role-bullet-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13.5px;
            color: #E2E8F0;
        }

        .role-bullet-item svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin-top: 3px;
            color: var(--pln-yellow-lime);
        }

        /* Mockup Preview Box inside Role Showcase */
        .role-mockup-preview {
            background: #061322;
            border: 1px solid #142F4D;
            border-radius: 18px;
            padding: 24px;
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.4);
            position: relative;
        }

        .mockup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #142F4D;
            padding-bottom: 12px;
            margin-bottom: 16px;
            font-size: 12px;
            font-weight: 700;
            color: #94A3B8;
        }

        .mockup-live-indicator {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #34D399;
            font-size: 11px;
            font-weight: 700;
        }

        .mockup-pulse-dot {
            width: 7px;
            height: 7px;
            background: #34D399;
            border-radius: 50%;
            box-shadow: 0 0 8px #34D399;
        }

        /* 4. ABOUT SECTION (PLN SustainAction Signature 105deg Gradient Style) */
        .about-gradient-section {
            background: linear-gradient(105deg, #1A64AB 10%, #155E9E 58%, #4FB3B2 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            padding: 96px 28px;
            color: #FFFFFF;
        }

        .about-inner {
            max-width: 840px;
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
            color: rgba(255, 255, 255, 0.94);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        /* 5. CORE FEATURES GRID (Kategori & Kriteria Style with Modal Trigger) */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: var(--pln-card-bg);
            border: 1px solid var(--pln-card-border);
            border-radius: 20px;
            padding: 30px 26px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
        }

        .feature-card:hover {
            border-color: rgba(242, 241, 93, 0.5);
            transform: translateY(-5px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.45);
        }

        .feature-icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(242, 241, 93, 0.12);
            color: var(--pln-yellow-lime);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }

        .feature-card h3 {
            font-size: 18px;
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 13.5px;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .feature-card-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--pln-yellow-lime);
            transition: gap 0.2s ease;
        }

        .feature-card:hover .feature-card-action {
            gap: 10px;
        }

        /* 6. INTERACTIVE LIVE TELEMETRY SIMULATOR */
        .sim-playground {
            background: #061525;
            border: 1px solid #153250;
            border-radius: 22px;
            padding: 34px;
            margin-top: 40px;
        }

        .sim-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
            border-bottom: 1px solid #153250;
            padding-bottom: 16px;
        }

        .sim-buttons-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-sim-action {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #FFFFFF;
            font-size: 13px;
            font-weight: 700;
            padding: 10px 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-sim-action:hover {
            background: var(--pln-yellow-lime);
            color: #041B29;
            border-color: var(--pln-yellow-lime);
        }

        .sim-monitor-display {
            background: #020A14;
            border-radius: 14px;
            padding: 20px;
            font-family: monospace;
            font-size: 13px;
            color: #38BDF8;
            max-height: 160px;
            overflow-y: auto;
            border: 1px solid #0F253C;
        }

        /* 7. INTERACTIVE MODAL DIALOG (PLN SustainAction Category Modal Style) */
        .pln-modal {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(4, 16, 30, 0.85);
            backdrop-filter: blur(10px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .pln-modal.active {
            display: flex;
            animation: fadeInScale 0.25s ease-out;
        }

        .pln-modal-dialog {
            background: #0A1E34;
            border: 1px solid #1E466F;
            border-radius: 20px;
            max-width: 600px;
            width: 100%;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.6);
        }

        .pln-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 26px;
            background: #071627;
            border-bottom: 1px solid #1E466F;
        }

        .pln-modal-header h3 {
            font-size: 18px;
            font-weight: 800;
            color: #FFFFFF;
            margin: 0;
        }

        .pln-modal-close {
            background: none;
            border: none;
            color: #94A3B8;
            font-size: 24px;
            cursor: pointer;
            transition: color 0.15s;
        }

        .pln-modal-close:hover {
            color: #FFFFFF;
        }

        .pln-modal-body {
            padding: 26px;
            font-size: 14px;
            color: #CBD5E1;
            line-height: 1.7;
        }

        /* 8. FOOTER */
        .site-footer {
            background: #020810;
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
            .desktop-nav {
                display: none;
            }
            .btn-menu-toggle {
                display: block;
            }
            .role-showcase-card {
                grid-template-columns: 1fr;
            }
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .hero-title {
                font-size: 38px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 30px;
            }
            .hero-desc {
                font-size: 14.5px;
            }
            .hero-metrics {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                padding: 16px;
            }
            .features-grid {
                grid-template-columns: 1fr;
            }
            .hero-btn-group {
                flex-direction: column;
                width: 100%;
                max-width: 340px;
                margin: 0 auto 36px auto;
            }
            .hero-cta-pln, .hero-cta-secondary {
                width: 100%;
                justify-content: center;
            }
            .footer-container {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- 1. COMPLETELY TRANSPARENT FIXED HEADER (PLN SustainAction Style) -->
    <header class="site-header" id="site-header">
        <div class="header-container">
            <a href="{{ url('/') }}" class="brand-logo-area" aria-label="LARIS 2026">
                <img class="brand-logo-img" src="{{ asset('logo.png') }}" alt="LARIS Platform">
            </a>

            <!-- Desktop Clean White Navigation Links (No rainbow text) -->
            <nav class="desktop-nav">
                <a href="#about">Tentang Inovasi</a>
                <a href="#roles">4 Pilihan Peran</a>
                <a href="#features">Fitur Unggulan</a>
                <a href="#edge-ai">Edge AI (Offline)</a>
                <a href="#simulator">Simulator</a>
                <a href="{{ url('/pembeli') }}" target="_blank">Portal Pembeli ↗</a>
            </nav>

            <!-- Action Buttons: Clean White Text Masuk & Vibrant Pill Daftar -->
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
        <a href="#features" onclick="toggleMobileMenu()">Fitur Unggulan</a>
        <a href="#edge-ai" onclick="toggleMobileMenu()">Edge AI (Offline)</a>
        <a href="#simulator" onclick="toggleMobileMenu()">Simulator Interaktif</a>
        <a href="{{ url('/pembeli') }}" target="_blank" onclick="toggleMobileMenu()">Portal Belanja Warga ↗</a>
        @auth
            <a href="{{ $targetUrl ?? route('dashboard') }}" style="color: var(--pln-yellow-lime); font-weight: 700;">Buka Dashboard Anda &rarr;</a>
        @else
            <a href="{{ route('login') }}">Masuk ke Sistem</a>
            <a href="{{ route('register') }}" style="color: var(--pln-yellow-lime);">Daftar Akun Baru</a>
        @endauth
    </div>

    <!-- MAIN CONTENT -->
    <main>
        <!-- 2. HERO SECTION WITH NON-STOP VIDEO LOOP & OCEANIC GRADIENT (PLN SustainAction Style) -->
        <section id="home" class="hero-section">
            <!-- Fullscreen Video Element: Autoplay, Loop, Muted, Playsinline -->
            <video class="hero-video" id="hero-bg-video" autoplay loop muted playsinline preload="auto">
                <source src="{{ asset('video.mp4') }}" type="video/mp4">
            </video>
            
            <!-- Deep Oceanic Navy Cinematic Overlay -->
            <div class="hero-overlay" aria-hidden="true"></div>

            <!-- Hero Content -->
            <div class="hero-content">
                <!-- Center Prominent Branding Logo -->
                <img src="{{ asset('logo.png') }}" alt="LARIS" class="hero-center-logo">

                <div class="hero-badge-tag">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                    <span>MEUKARYA TEAM • INFEST HACKATHON 2026 • AI FOR ALL</span>
                </div>

                <!-- Pure White Clean Headline (No Rainbow Clutter) -->
                <h1 class="hero-title">
                    Siap Wujudkan Daya Saing UMKM Inklusif?
                </h1>

                <!-- Descriptive Subtitle -->
                <p class="hero-desc">
                    Saatnya membawa analitik prediktif dan Explainable AI menjadi keputusan bisnis nyata bagi pemilik warung dan UMKM Indonesia. Dilengkapi On-Device Edge AI (LARIS Lite) untuk daerah 3T tanpa internet, serta ekosistem dua sisi yang menguntungkan pemilik usaha dan warga sekitar.
                </p>

                <!-- Action Button: Yellow-Lime Pill like PLN SustainAction -->
                <div class="hero-btn-group">
                    <a href="{{ route('login') }}" class="hero-cta-pln">
                        <span>Jelajahi Demo Platform</span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                    <a href="#roles" class="hero-cta-secondary">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                        <span>Pelajari 4 Pilihan Peran</span>
                    </a>
                </div>

                <!-- Clean Unified KPI Metrics Strip -->
                <div class="hero-metrics">
                    <div class="metric-item">
                        <div class="metric-value">0 Menit</div>
                        <div class="metric-label">Downtime Offline (LARIS Lite)</div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value">88%</div>
                        <div class="metric-label">Akurasi Prediksi Restock</div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value">&lt; 15 Detik</div>
                        <div class="metric-label">Generate Draf PO Otomatis</div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value">4 Peran</div>
                        <div class="metric-label">Sesi &amp; Rute Terpisah Penuh</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. INTERACTIVE 4 ROLES EXPLORER SECTION (Animated Switcher & Complete Details) -->
        <section id="roles" class="section-container">
            <div class="section-header">
                <span class="section-tag">Struktur Peran Terisolasi</span>
                <h2 class="section-title">4 Pilihan Peran, 1 Ekosistem Terpadu</h2>
                <p class="section-desc">
                    Setiap peran memiliki kredensial sesi, rute akses, dan menu navigasi yang terpisah penuh tanpa tercampur aduk. Klik peran di bawah untuk melihat alur kerja lengkapnya:
                </p>
            </div>

            <!-- Interactive Tab Navigation -->
            <div class="role-tabs-nav">
                <button type="button" class="role-tab-btn active" onclick="switchRoleTab('owner', this)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                    <span>1. Juragan (Owner)</span>
                </button>
                <button type="button" class="role-tab-btn" onclick="switchRoleTab('cashier', this)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0-8.25h19.5m0 0v8.25m0-8.25v-.75a.75.75 0 0 0-.75-.75h-.75m0 0V4.5m-18 0h18"/></svg>
                    <span>2. Kasir Frontliner</span>
                </button>
                <button type="button" class="role-tab-btn" onclick="switchRoleTab('inventory', this)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m16.5 0v-1.5a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25v1.5m16.5 0H3.75"/></svg>
                    <span>3. Staf Gudang &amp; Logistik</span>
                </button>
                <button type="button" class="role-tab-btn" onclick="switchRoleTab('customer', this)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                    <span>4. Konsumen Warga</span>
                </button>
            </div>

            <!-- Role Showcase Panel 1: OWNER -->
            <div id="role-panel-owner" class="role-showcase-card active">
                <div>
                    <span class="role-card-badge">Pusat Kendali Eksekutif</span>
                    <h3 class="role-card-title">Super Juragan (Owner)</h3>
                    <p class="role-card-summary">
                        Membantu pemilik UMKM melihat kondisi riil bisnis tanpa spekulasi. Dilengkapi simulasi "What If I Sell This?" (LARIS Predict), Opportunity Radar tren pasar, dan asisten AI Juragan Copilot.
                    </p>
                    <ul class="role-bullet-list">
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Simulasi LARIS Predict:</strong> Uji margin, potensi omzet, dan risiko dead-stock sebelum membeli barang dagangan baru.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Trend Hunter Lokal:</strong> Menangkap sinyal produk yang sedang viral di media sosial dan lingkungan sekitar toko.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Juragan AI Copilot:</strong> Tanya strategi harga, waktu restock, dan ekspor ringkasan bisnis langsung ke WhatsApp.</span>
                        </li>
                    </ul>
                    <a href="{{ route('login') }}" class="hero-cta-pln" style="font-size: 13.5px; padding: 11px 28px;">Masuk sebagai Juragan &rarr;</a>
                </div>

                <div class="role-mockup-preview">
                    <div class="mockup-header">
                        <span>BUSINESS_DASHBOARD.PHP</span>
                        <div class="mockup-live-indicator">
                            <span class="mockup-pulse-dot"></span>
                            <span>TELEMETRI AKTIF</span>
                        </div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: 10px; padding: 14px; margin-bottom: 12px;">
                        <div style="font-size: 11px; color: #94A3B8;">Omzet Penjualan Hari Ini</div>
                        <div style="font-size: 22px; font-weight: 800; color: #FFFFFF; margin: 4px 0;">Rp 4.750.000</div>
                        <div style="font-size: 11px; color: #34D399;">+18.4% vs target harian (Runway 12 Hari)</div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: 10px; padding: 14px;">
                        <div style="font-size: 11px; color: #94A3B8;">Rekomendasi Juragan AI (Confidence: 89%)</div>
                        <div style="font-size: 12.5px; color: #E2E8F0; margin-top: 4px; line-height: 1.5;">
                            "Permintaan Kopi Susu Aren naik 35%. AI sarankan reorder 2 karton sirup sebelum hari Jumat."
                        </div>
                    </div>
                </div>
            </div>

            <!-- Role Showcase Panel 2: CASHIER -->
            <div id="role-panel-cashier" class="role-showcase-card">
                <div>
                    <span class="role-card-badge">Operasional Frontliner</span>
                    <h3 class="role-card-title">Kasir Toko (Smart POS)</h3>
                    <p class="role-card-summary">
                        Mesin kasir berbasis web yang sangat ringan dan responsif. Mendukung pemotongan stok otomatis real-time, cetak struk kasir, input kasbon, dan simulasi QRIS Dinamis.
                    </p>
                    <ul class="role-bullet-list">
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Pencatatan Transaksi Cepat:</strong> Tambah produk ke keranjang belanja hanya dalam 1 klik tanpa lag.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Pemotongan Stok Atomik:</strong> Setiap item terjual langsung memotong sisa stok fisik di gudang.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Rekap Shift Otomatis:</strong> Kasir dapat melihat total omzet dan jumlah struk shift berjalan secara instan.</span>
                        </li>
                    </ul>
                    <a href="{{ route('login') }}" class="hero-cta-pln" style="font-size: 13.5px; padding: 11px 28px;">Masuk sebagai Kasir &rarr;</a>
                </div>

                <div class="role-mockup-preview">
                    <div class="mockup-header">
                        <span>SMART_POS_TERMINAL.PHP</span>
                        <div class="mockup-live-indicator">
                            <span class="mockup-pulse-dot"></span>
                            <span>POS SIAP JUAL</span>
                        </div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: 10px; padding: 14px; margin-bottom: 12px;">
                        <div style="display: flex; justify-content: space-between; font-size: 12px; color: #CBD5E1;">
                            <span>Kopi Arabika Gayo x 2</span>
                            <strong>Rp 70.000</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 12px; color: #CBD5E1; margin-top: 6px;">
                            <span>Gula Aren Cair 500ml x 1</span>
                            <strong>Rp 24.000</strong>
                        </div>
                        <div style="border-top: 1px dashed rgba(255,255,255,0.15); margin-top: 8px; padding-top: 8px; display: flex; justify-content: space-between; font-size: 14px; font-weight: 800; color: #FFFFFF;">
                            <span>Total Tagihan:</span>
                            <span style="color: var(--pln-yellow-lime);">Rp 94.000</span>
                        </div>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <button type="button" style="flex: 1; background: #00A2B9; border: none; padding: 8px; border-radius: 8px; color: #FFF; font-size: 11px; font-weight: 700;">Bayar QRIS</button>
                        <button type="button" style="flex: 1; background: #1C67AB; border: none; padding: 8px; border-radius: 8px; color: #FFF; font-size: 11px; font-weight: 700;">Bayar Tunai</button>
                    </div>
                </div>
            </div>

            <!-- Role Showcase Panel 3: INVENTORY -->
            <div id="role-panel-inventory" class="role-showcase-card">
                <div>
                    <span class="role-card-badge">Logistik &amp; Gudang</span>
                    <h3 class="role-card-title">Staf Gudang &amp; Logistik</h3>
                    <p class="role-card-summary">
                        Mengontrol stok fisik barang, mendeteksi barang kritis (&lt; 4 hari habis), auto-bundle draft Purchase Order ke distributor, dan mencatat penerimaan barang masuk.
                    </p>
                    <ul class="role-bullet-list">
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Peringatan Runway Kritis:</strong> Indikator merah otomatis jika stok menipis dan berisiko kehabisan.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Auto-Bundle Draf PO:</strong> Generate dokumen pemesanan ke distributor tanpa harus menghitung manual.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Penerimaan Barang Masuk:</strong> Verifikasi fisik barang datang dan update kuantitas stok otomatis.</span>
                        </li>
                    </ul>
                    <a href="{{ route('login') }}" class="hero-cta-pln" style="font-size: 13.5px; padding: 11px 28px;">Masuk sebagai Staf Gudang &rarr;</a>
                </div>

                <div class="role-mockup-preview">
                    <div class="mockup-header">
                        <span>GUDANG_CONTROL.PHP</span>
                        <div class="mockup-live-indicator">
                            <span class="mockup-pulse-dot"></span>
                            <span>MONITORING REALTIME</span>
                        </div>
                    </div>
                    <div style="background: rgba(220, 38, 38, 0.15); border: 1px solid rgba(220, 38, 38, 0.3); border-radius: 10px; padding: 12px; margin-bottom: 10px;">
                        <div style="font-size: 11px; font-weight: 800; color: #F87171;">PERINGATAN STOK KRITIS (1 SKU)</div>
                        <div style="font-size: 12.5px; color: #FFFFFF; font-weight: 700; margin-top: 2px;">Kopi Arabika Gayo: Sisa 12 unit</div>
                        <div style="font-size: 11px; color: #CBD5E1;">Perkiraan habis dalam 1.8 hari. Rekomendasi restock: 50 unit.</div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: 10px; padding: 12px; font-size: 12px; color: #CBD5E1;">
                        Status Gudang: 12 SKU Sehat • 2 SKU Perlu Perhatian
                    </div>
                </div>
            </div>

            <!-- Role Showcase Panel 4: CUSTOMER -->
            <div id="role-panel-customer" class="role-showcase-card">
                <div>
                    <span class="role-card-badge">Konsumen Sekitar Toko</span>
                    <h3 class="role-card-title">Portal Konsumen Warga</h3>
                    <p class="role-card-summary">
                        Platform bagi warga sekitar untuk mengecek stok toko secara langsung, mendapatkan diskon <strong>Flash Sale Cuci Rak Jam 7 Malam</strong>, dan menitipkan kulakan belanja grosir.
                    </p>
                    <ul class="role-bullet-list">
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Cek Stok Toko Terdekat:</strong> Warga tahu ketersediaan sembako dari rumah tanpa perlu jalan kaki.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Flash Sale Cuci Rak:</strong> Diskon 30%–50% produk roti &amp; segar jam 7 malam sebelum toko tutup.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Titip Kulakan Pre-Order:</strong> Warga bisa titip beli barang langka saat Juragan belanja ke distributor.</span>
                        </li>
                    </ul>
                    <a href="{{ route('login') }}" class="hero-cta-pln" style="font-size: 13.5px; padding: 11px 28px;">Masuk sebagai Konsumen &rarr;</a>
                </div>

                <div class="role-mockup-preview">
                    <div class="mockup-header">
                        <span>PORTAL_WARGA.PHP</span>
                        <div class="mockup-live-indicator">
                            <span class="mockup-pulse-dot"></span>
                            <span>CUCI RAK LIVE</span>
                        </div>
                    </div>
                    <div style="background: rgba(242, 241, 93, 0.12); border: 1px solid rgba(242, 241, 93, 0.3); border-radius: 10px; padding: 12px; margin-bottom: 10px;">
                        <div style="font-size: 11px; font-weight: 800; color: var(--pln-yellow-lime);">FLASH SALE CUCI RAK JAM 7 MALAM</div>
                        <div style="font-size: 12.5px; color: #FFFFFF; font-weight: 700; margin-top: 2px;">Roti Tawar Gandum Spesial</div>
                        <div style="font-size: 13px; font-weight: 800; color: #34D399; margin-top: 4px;">Rp 9.500 <span style="font-size: 11px; color: #94A3B8; text-decoration: line-through;">Rp 18.000</span> (-47%)</div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: 10px; padding: 10px; font-size: 11.5px; color: #CBD5E1;">
                        Titip Kulakan Saya: Minyak Bimoli 2L (Diproses Juragan)
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. ABOUT INNOVATION SECTION (PLN SustainAction 105deg Signature Gradient) -->
        <section id="about" class="about-gradient-section">
            <div class="about-inner">
                <span class="section-tag" style="color: #F2F15D;">Misi Inovasi Sosial &amp; Ekonomi</span>
                <h2>Membawa Kecerdasan Korporat ke Warung &amp; UMKM Indonesia</h2>
                <p>
                    Selama ini, sistem analitik cerdas dan AI prediktif hanya dinikmati oleh jaringan ritel modern raksasa dengan modal triliunan rupiah. Pemilik warung dan UMKM tradisional harus berspekulasi dengan modal terbatas, sering terjebak dead-stock, atau kehabisan stok saat permintaan melonjak.
                </p>
                <p>
                    <strong>LARIS hadir sebagai jawaban nyata untuk tema "AI for All: Intelligent Solutions for an Equitable Future".</strong> Kami mendemokratisasi akses ke data intelligence dengan antarmuka yang ramah bagi semua usia, Explainable AI yang menyertakan alasan transparan (Confidence Score &amp; Why Factor), serta mekanisme On-Device Edge AI agar UMKM di daerah 3T yang minim sinyal internet tetap berdaya dan sejahtera.
                </p>
            </div>
        </section>

        <!-- 5. CORE FEATURES & CRITERIA (PLN SustainAction Category Cards with Interactive Modal) -->
        <section id="features" class="section-container">
            <div class="section-header">
                <span class="section-tag">Teknologi Berdampak Nyata</span>
                <h2 class="section-title">6 Inovasi Utama Platform LARIS</h2>
                <p class="section-desc">
                    Dirancang dari masalah riil pemilik toko kelontong di lapangan dengan pendekatan Explainable AI dan arsitektur offline-first. Klik fitur untuk melihat rincian cara kerjanya:
                </p>
            </div>

            <div class="features-grid">
                <!-- Feature 1 -->
                <article class="feature-card" onclick="openFeatureModal('predict')">
                    <div>
                        <div class="feature-icon-circle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/></svg>
                        </div>
                        <h3>LARIS Predict ("What If")</h3>
                        <p>Simulasi sebelum kulakan. AI memprediksi apakah suatu produk baru akan laku, menghitung margin aman, dan risiko dead-stock.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>

                <!-- Feature 2 -->
                <article class="feature-card" onclick="openFeatureModal('edge')">
                    <div>
                        <div class="feature-icon-circle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.516 0c.85.493 1.508 1.333 1.508 2.316V18"/></svg>
                        </div>
                        <h3>On-Device Edge AI (LARIS Lite)</h3>
                        <p>Tetap mencatat kasir POS dan memprediksi stok dasar secara lokal di HP/browser tanpa koneksi internet sama sekali.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>

                <!-- Feature 3 -->
                <article class="feature-card" onclick="openFeatureModal('xai')">
                    <div>
                        <div class="feature-icon-circle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                        </div>
                        <h3>Explainable AI (XAI)</h3>
                        <p>Bukan black-box misterius. Setiap rekomendasi dilengkapi penjelasan alasan ("Why Factor") dan Confidence Score.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>

                <!-- Feature 4 -->
                <article class="feature-card" onclick="openFeatureModal('flash')">
                    <div>
                        <div class="feature-icon-circle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z"/></svg>
                        </div>
                        <h3>Cuci Rak Jam 7 Malam</h3>
                        <p>Otomasi diskon produk mendekati masa kedaluwarsa bagi warga sekitar untuk mencegah kerugian dan food waste.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>

                <!-- Feature 5 -->
                <article class="feature-card" onclick="openFeatureModal('kulakan')">
                    <div>
                        <div class="feature-icon-circle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        </div>
                        <h3>Titip Kulakan &amp; Kolaborasi</h3>
                        <p>Warga menitipkan kebutuhan sembako, dan toko menggabungkan pesanan untuk daya tawar harga grosir distributor.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>

                <!-- Feature 6 -->
                <article class="feature-card" onclick="openFeatureModal('pos')">
                    <div>
                        <div class="feature-icon-circle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0-8.25h19.5m0 0v8.25m0-8.25v-.75a.75.75 0 0 0-.75-.75h-.75m0 0V4.5m-18 0h18"/></svg>
                        </div>
                        <h3>Smart POS &amp; QRIS Dinamis</h3>
                        <p>Kasir kasbon dan tunai/QRIS yang cepat, auto-sync telemetri omzet harian ke dashboard pemilik toko.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>
            </div>
        </section>

        <!-- 6. INTERACTIVE LIVE TELEMETRY & SIMULATION PLAYGROUND -->
        <section id="simulator" class="section-container" style="padding-top: 20px;">
            <div class="sim-playground">
                <div class="sim-header">
                    <div>
                        <span class="section-tag">Playground Interaktif</span>
                        <h2 style="font-size: 24px; font-weight: 800; color: #FFFFFF; margin: 4px 0;">Simulator Alur Kerja Nyata LARIS</h2>
                        <p style="font-size: 13.5px; color: rgba(255, 255, 255, 0.7); margin: 0;">Uji coba langsung bagaimana AI, POS, dan fitur offline merespons aksi Anda:</p>
                    </div>
                    <div class="sim-buttons-row">
                        <button type="button" class="btn-sim-action" onclick="runSim('pos')">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            <span>Simulasi Transaksi POS</span>
                        </button>
                        <button type="button" class="btn-sim-action" onclick="runSim('offline')">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 0 1 0 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 0 1 0 7.072m0 0l-2.829-2.829m-4.243 4.243a9 9 0 0 1-2.828-6.364M3 3l18 18"/></svg>
                            <span>Simulasi Putus Internet (3T)</span>
                        </button>
                        <button type="button" class="btn-sim-action" onclick="runSim('flash')">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            <span>Simulasi Jam 7 Malam</span>
                        </button>
                    </div>
                </div>

                <div class="sim-monitor-display" id="sim-monitor">
                    <div>[SYSTEM_READY] Telemetri aktif terhubung ke http://127.0.0.1:8000</div>
                    <div>[NODE_EDGE] Model On-Device AI dimuat dalam cache lokal (Status: Sehat)</div>
                    <div>[TIPS] Klik tombol aksi di atas untuk menguji alur kerja platform...</div>
                </div>
            </div>
        </section>
    </main>

    <!-- 7. INTERACTIVE DETAIL MODAL (PLN SustainAction Category Modal Dialog) -->
    <div id="feature-modal" class="pln-modal" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="pln-modal-dialog">
            <div class="pln-modal-header">
                <h3 id="modal-title">Spesifikasi Fitur LARIS</h3>
                <button type="button" class="pln-modal-close" onclick="closeFeatureModal()" aria-label="Tutup">&times;</button>
            </div>
            <div class="pln-modal-body" id="modal-body">
                <!-- Content dynamically populated via JS -->
            </div>
        </div>
    </div>

    <!-- 8. FOOTER -->
    <footer class="site-footer">
        <div class="footer-container">
            <div>
                <img src="{{ asset('logo.png') }}" alt="LARIS Logo" style="height: 28px; margin-bottom: 8px;">
                <div>&copy; 2026 LARIS Platform — Meukarya Team (Universitas Serambi Mekkah).</div>
                <div style="font-size: 11.5px; color: #64748B; margin-top: 4px;">Inovasi AI Inklusif untuk Pemerataan Daya Saing UMKM Indonesia • Infest Hackathon 2026</div>
            </div>

            <ul class="footer-links">
                <li><a href="#about">Tentang</a></li>
                <li><a href="#roles">4 Peran</a></li>
                <li><a href="#features">Fitur</a></li>
                <li><a href="{{ url('/pembeli') }}" target="_blank">Portal Pembeli</a></li>
                <li><a href="{{ route('login') }}">Masuk</a></li>
            </ul>
        </div>
    </footer>

    <!-- SCRIPT FOR VIDEO SAFEGUARD, TRANSPARENT NAVBAR SCROLL, TABS & INTERACTIVE MODAL -->
    <script>
        /* 1. Continuous Video Loop Safeguard */
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('hero-bg-video');
            if (video) {
                video.muted = true;
                video.defaultMuted = true;
                video.playsInline = true;
                video.loop = true;

                const playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise.catch(function() {
                        video.muted = true;
                        video.play();
                    });
                }

                video.addEventListener('ended', function() {
                    video.currentTime = 0;
                    video.play();
                });
            }
        });

        /* 2. Transparent Navbar on Top, Soft Glass Blur on Scroll */
        window.addEventListener('scroll', function() {
            const header = document.getElementById('site-header');
            if (header) {
                if (window.scrollY > 40) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
        });

        /* 3. Mobile Dropdown Toggle */
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-dropdown-menu');
            if (menu) {
                menu.classList.toggle('active');
            }
        }

        /* 4. Interactive 4 Roles Tab Switcher */
        function switchRoleTab(roleKey, btnEl) {
            document.querySelectorAll('.role-tab-btn').forEach(b => b.classList.remove('active'));
            if (btnEl) btnEl.classList.add('active');

            document.querySelectorAll('.role-showcase-card').forEach(c => c.classList.remove('active'));
            const targetPanel = document.getElementById('role-panel-' + roleKey);
            if (targetPanel) {
                targetPanel.classList.add('active');
            }
        }

        /* 5. Interactive Modal Details (PLN SustainAction style) */
        const featureDetails = {
            'predict': {
                title: 'LARIS Predict ("What If I Sell This?")',
                body: '<p><strong>Tujuan:</strong> Menghilangkan spekulasi modal saat pemilik warung membeli stok baru.</p><p style="margin-top:10px;"><strong>Cara Kerja AI:</strong> Menggunakan model probabilistik berdasarkan data histori penjualan kategori serupa, elastisitas harga lokal, serta sinyal tren pasar. Memberikan estimasi laba bulanan, titik impas (break-even), dan skor risiko dead-stock.</p>'
            },
            'edge': {
                title: 'On-Device Edge AI (LARIS Lite untuk Daerah 3T)',
                body: '<p><strong>Tujuan:</strong> Memastikan UMKM di pelosok terluar dan kepulauan tetap bisa beroperasi saat koneksi internet terputus total.</p><p style="margin-top:10px;"><strong>Cara Kerja:</strong> Logika AI dan basis data lokal berjalan di IndexedDB peramban. Transaksi offline diantrekan secara aman dan otomatis disinkronisasi ke basis data pusat saat koneksi internet kembali pulih.</p>'
            },
            'xai': {
                title: 'Explainable AI (XAI) & Confidence Score',
                body: '<p><strong>Tujuan:</strong> Menghindari sistem "black-box" yang membingungkan pedagang tradisional.</p><p style="margin-top:10px;"><strong>Cara Kerja:</strong> Setiap saran restock atau bundling dilengkapi faktor alasan logis (Why Factor) dan persentase keyakinan (misal: "Confidence 88% karena tren kopi naik di hari Jumat-Minggu").</p>'
            },
            'flash': {
                title: 'Flash Sale Cuci Rak Jam 7 Malam',
                body: '<p><strong>Tujuan:</strong> Mencegah kerugian makanan/barang basi dan mengurangi food waste.</p><p style="margin-top:10px;"><strong>Cara Kerja:</strong> Sistem otomatis menyaring barang dengan sisa umur simpan &lt; 2 hari dan mempublikasikan diskon 30%–50% ke portal warga sekitar toko pada pukul 19.00 WIB setiap malam.</p>'
            },
            'kulakan': {
                title: 'Titip Kulakan & Kolektif Pool Pembelian',
                body: '<p><strong>Tujuan:</strong> Memberikan daya tawar harga grosir distributor setara jaringan minimarket modern.</p><p style="margin-top:10px;"><strong>Cara Kerja:</strong> Warga sekitar dapat melakukan pre-order titip belanja, dan beberapa warung tetangga dapat menggabungkan kuota pembelian (misal: patungan 1 karton minyak 24 unit) untuk memotong modal HPP.</p>'
            },
            'pos': {
                title: 'Smart POS Kasir & QRIS Dinamis Multi-Channel',
                body: '<p><strong>Tujuan:</strong> Menghadirkan mesin kasir ultra-gesit tanpa perlu perangkat keras mahal.</p><p style="margin-top:10px;"><strong>Cara Kerja:</strong> Beroperasi lancar di peramban HP Android maupun laptop kasir. Mendukung cetak struk kasir, pencatatan kasbon pelanggan, dan generate QRIS otomatis yang langsung memotong kuantitas stok barang.</p>'
            }
        };

        function openFeatureModal(key) {
            const data = featureDetails[key];
            if (data) {
                document.getElementById('modal-title').innerText = data.title;
                document.getElementById('modal-body').innerHTML = data.body;
                document.getElementById('feature-modal').classList.add('active');
            }
        }

        function closeFeatureModal() {
            document.getElementById('feature-modal').classList.remove('active');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeFeatureModal();
        });

        /* 6. Live Telemetry Simulator */
        function runSim(type) {
            const mon = document.getElementById('sim-monitor');
            const now = new Date().toLocaleTimeString('id-ID');
            let log = '';

            if (type === 'pos') {
                log = `<div>[${now}] <span style="color:#34D399;">[TRANSAKSI_POS]</span> 2x Kopi Gayo terjual (Rp 70.000). Stok berkurang 45 -> 43 unit. Telemetri omzet diperbarui!</div>`;
            } else if (type === 'offline') {
                log = `<div>[${now}] <span style="color:#FBBF24;">[EDGE_OFFLINE]</span> Sinyal terputus. Mode LARIS Lite aktif. Transaksi disimpan di antrean lokal SQLite. Operasional berjalan 100%!</div>`;
            } else if (type === 'flash') {
                log = `<div>[${now}] <span style="color:#F2F15D;">[CUCI_RAK]</span> Jam 19:00 WIB terdeteksi! Roti Tawar Gandum diskon 47% tayang di portal warga. Notifikasi dikirimkan ke 14 tetangga sekitar toko!</div>`;
            }

            mon.innerHTML += log;
            mon.scrollTop = mon.scrollHeight;
        }
    </script>
</body>
</html>
