<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LARIS — AI Business Intelligence & Decision Platform for MSMEs. Solusi Inovatif AI for All untuk Pemerataan Daya Saing UMKM Indonesia dengan fitur Offline-First LARIS Lite.">
    <title>LARIS — AI Business Intelligence & Decision Platform for MSMEs</title>
    
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    
    <!-- Typography: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Google Analytics 4 (GA4) Ecosystem Integration -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LARISBI2026"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-LARISBI2026', {
        'app_name': 'LARIS Platform',
        'send_page_view': true
      });
    </script>
    
    <style>
        :root {
            /* LARIS Official Identity Palette (Deep Obsidian, Emerald & Cyber Lime) */
            --laris-bg-base: #080D11;
            --laris-bg-surface: #0E161C;
            --laris-bg-card: #121D24;
            --laris-bg-card-hover: #16242E;
            --laris-border-subtle: rgba(255, 255, 255, 0.08);
            --laris-border-emerald: rgba(16, 185, 129, 0.24);
            --laris-border-hover: rgba(52, 211, 153, 0.45);
            
            /* Accent & Brand Colors */
            --laris-emerald: #10B981;
            --laris-emerald-dark: #059669;
            --laris-mint: #34D399;
            --laris-cyber-lime: #CCFF00;
            --laris-cyber-lime-hover: #B8E600;
            --laris-amber: #F59E0B;
            --laris-sky: #0EA5E9;
            --laris-rose: #F43F5E;
            --laris-indigo: #6366F1;
            
            /* Text Contrast Tokens */
            --text-heading: #FFFFFF;
            --text-body: #E2E8F0;
            --text-muted: #94A3B8;
            --text-dim: #64748B;

            /* Shadows & Elevation */
            --shadow-soft: 0 10px 30px rgba(0, 0, 0, 0.45);
            --shadow-emerald: 0 10px 35px rgba(16, 185, 129, 0.22);
            --shadow-lime: 0 8px 28px rgba(204, 255, 0, 0.28);
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
            background-color: var(--laris-bg-base);
            color: var(--text-body);
            overflow-x: hidden;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* Ambient Background Glowing Orbs */
        .ambient-orb-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .ambient-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.16;
            animation: orbFloat 22s infinite ease-in-out alternate;
        }

        .ambient-orb-1 {
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, #10B981, transparent 70%);
            top: -100px;
            left: -100px;
        }

        .ambient-orb-2 {
            width: 650px;
            height: 650px;
            background: radial-gradient(circle, #CCFF00, transparent 70%);
            top: 40%;
            right: -150px;
            animation-duration: 28s;
            opacity: 0.11;
        }

        .ambient-orb-3 {
            width: 480px;
            height: 480px;
            background: radial-gradient(circle, #0EA5E9, transparent 70%);
            bottom: -80px;
            left: 20%;
            animation-duration: 24s;
            opacity: 0.12;
        }

        @keyframes orbFloat {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(60px, 40px) scale(1.08); }
            100% { transform: translate(-40px, 70px) scale(0.95); }
        }

        /* 1. FIXED GLASSMORPHIC NAVBAR */
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 74px;
            background: transparent;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .site-header.scrolled {
            background: rgba(8, 13, 17, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--laris-border-subtle);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            height: 68px;
        }

        .header-container {
            max-width: 1280px;
            height: 100%;
            margin: 0 auto;
            padding: 0 24px;
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
            filter: drop-shadow(0 0 12px rgba(16, 185, 129, 0.35));
            transition: transform 0.25s ease;
        }

        .brand-logo-img:hover {
            transform: scale(1.04);
        }

        .brand-badge-tag {
            font-size: 10px;
            font-weight: 800;
            background: rgba(204, 255, 0, 0.12);
            color: var(--laris-cyber-lime);
            border: 1px solid rgba(204, 255, 0, 0.3);
            padding: 3px 8px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .desktop-nav {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
        }

        .desktop-nav a {
            color: #FFFFFF;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
            position: relative;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
        }

        .desktop-nav a:hover {
            color: var(--laris-cyber-lime);
        }

        .desktop-nav a.highlight-nav {
            color: #FFFFFF;
        }

        .header-action-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-nav-ghost {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            padding: 8px 16px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
        }

        .btn-nav-ghost:hover {
            background: rgba(255, 255, 255, 0.16);
            color: #FFFFFF;
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-nav-primary {
            background: var(--laris-cyber-lime);
            color: #080D11;
            padding: 9px 20px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 16px rgba(204, 255, 0, 0.3);
        }

        .btn-nav-primary:hover {
            background: var(--laris-cyber-lime-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(204, 255, 0, 0.45);
        }

        /* Mobile Hamburger Button */
        .mobile-menu-btn {
            display: none;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid var(--laris-border-subtle);
            color: #FFFFFF;
            padding: 8px;
            border-radius: 10px;
            cursor: pointer;
        }

        /* Mobile Dropdown */
        .mobile-dropdown-menu {
            display: none;
            position: fixed;
            top: 74px;
            left: 0;
            right: 0;
            background: rgba(8, 13, 17, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--laris-border-subtle);
            padding: 20px 24px;
            z-index: 999;
            flex-direction: column;
            gap: 14px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.7);
        }

        .mobile-dropdown-menu.active {
            display: flex;
        }

        .mobile-dropdown-menu a {
            color: var(--text-body);
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* 2. HERO SECTION WITH CINEMATIC VIDEO & LARIS OVERLAY */
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 120px 24px 80px 24px;
            overflow: hidden;
            background: #080D11;
        }

        .hero-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: 1;
            transform: translate(-50%, -50%);
            object-fit: cover;
            opacity: 0.80;
            filter: saturate(1.1) contrast(1.08);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            z-index: 2;
            background: linear-gradient(180deg, rgba(8, 13, 17, 0.15) 0%, rgba(8, 13, 17, 0.28) 40%, rgba(8, 13, 17, 0.68) 80%, var(--laris-bg-base) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 3;
            max-width: 980px;
            margin: 0 auto;
            text-align: center;
        }

        .hero-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(8, 13, 17, 0.65);
            border: 1px solid rgba(16, 185, 129, 0.4);
            color: var(--laris-mint);
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.8px;
            padding: 6px 16px;
            border-radius: 9999px;
            margin-bottom: 24px;
            text-transform: uppercase;
            backdrop-filter: blur(12px);
        }

        .hero-pulse-dot {
            width: 7px;
            height: 7px;
            background: var(--laris-cyber-lime);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--laris-cyber-lime);
            animation: pulse 1.8s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.9); opacity: 0.8; }
            50% { transform: scale(1.3); opacity: 1; box-shadow: 0 0 14px var(--laris-cyber-lime); }
            100% { transform: scale(0.9); opacity: 0.8; }
        }

        .hero-title {
            font-size: clamp(30px, 5.5vw, 56px);
            font-weight: 800;
            color: #FFFFFF;
            line-height: 1.18;
            letter-spacing: -0.025em;
            margin-bottom: 20px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.85), 0 2px 6px rgba(0, 0, 0, 0.9);
        }

        .hero-title-highlight {
            color: var(--laris-cyber-lime);
            text-shadow: 0 0 28px rgba(204, 255, 0, 0.6), 0 2px 8px rgba(0, 0, 0, 0.9);
            font-weight: 800;
        }

        .hero-subtitle {
            font-size: clamp(15px, 2.2vw, 18px);
            color: #FFFFFF;
            line-height: 1.7;
            max-width: 780px;
            margin: 0 auto 36px auto;
            text-shadow: 0 2px 14px rgba(0, 0, 0, 0.9);
        }

        .hero-btn-group {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 56px;
        }

        .hero-cta-main {
            background: var(--laris-cyber-lime);
            color: #080D11;
            font-size: clamp(13px, 1.8vw, 15px);
            font-weight: 800;
            padding: 14px 30px;
            border-radius: 9999px;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: var(--shadow-lime);
        }

        .hero-cta-main:hover {
            transform: translateY(-2px) scale(1.02);
            background: var(--laris-cyber-lime-hover);
            box-shadow: 0 10px 32px rgba(204, 255, 0, 0.45);
        }

        .hero-cta-alt {
            background: rgba(18, 29, 36, 0.8);
            color: #FFFFFF;
            border: 1px solid var(--laris-border-emerald);
            font-size: clamp(13px, 1.8vw, 15px);
            font-weight: 700;
            padding: 14px 28px;
            border-radius: 9999px;
            text-decoration: none;
            transition: all 0.25s ease;
            backdrop-filter: blur(10px);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .hero-cta-alt:hover {
            background: rgba(16, 185, 129, 0.16);
            border-color: var(--laris-mint);
            transform: translateY(-2px);
        }

        /* Hero Live Telemetry Metrics Strip */
        .hero-metrics-strip {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            max-width: 900px;
            margin: 0 auto;
            background: rgba(14, 22, 28, 0.78);
            border: 1px solid var(--laris-border-subtle);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            padding: 22px 24px;
            box-shadow: var(--shadow-soft);
        }

        .metric-card {
            text-align: center;
            position: relative;
        }

        .metric-card:not(:last-child)::after {
            content: '';
            position: absolute;
            right: -8px;
            top: 20%;
            height: 60%;
            width: 1px;
            background: rgba(255, 255, 255, 0.08);
        }

        .metric-value {
            font-size: clamp(20px, 3vw, 28px);
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .metric-value span.highlight {
            color: var(--laris-cyber-lime);
        }

        .metric-label {
            font-size: clamp(10.5px, 1.4vw, 12px);
            color: var(--text-muted);
            font-weight: 600;
            margin-top: 4px;
        }

        /* SECTION BASE STYLES */
        .section-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 100px 24px;
            position: relative;
            z-index: 2;
        }

        .section-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 56px auto;
        }

        .section-tag {
            display: inline-block;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--laris-cyber-lime);
            background: rgba(204, 255, 0, 0.08);
            border: 1px solid rgba(204, 255, 0, 0.22);
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 14px;
        }

        .section-title {
            font-size: clamp(24px, 4vw, 38px);
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #FFFFFF;
            margin-bottom: 16px;
            line-height: 1.25;
        }

        .section-desc {
            font-size: clamp(14px, 2vw, 16px);
            color: var(--text-muted);
            line-height: 1.7;
        }

        /* 3. MULTI-CHANNEL CONNECTOR STRIP */
        .connector-strip {
            border-top: 1px solid var(--laris-border-subtle);
            border-bottom: 1px solid var(--laris-border-subtle);
            background: rgba(14, 22, 28, 0.5);
            padding: 32px 24px;
            position: relative;
            z-index: 2;
        }

        .connector-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .connector-label {
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-dim);
            text-align: center;
        }

        .connector-badges {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 14px;
        }

        .connector-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--laris-bg-card);
            border: 1px solid var(--laris-border-subtle);
            padding: 8px 16px;
            border-radius: 9999px;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--text-body);
            transition: all 0.25s ease;
        }

        .connector-badge:hover {
            border-color: var(--laris-mint);
            transform: translateY(-2px);
            background: var(--laris-bg-card-hover);
        }

        .connector-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        /* 4. REDESIGNED MISSION & SOCIAL IMPACT SECTION (LARIS OBSIDIAN MESH) */
        .mission-section {
            background: linear-gradient(135deg, #071015 0%, #0A1E1B 45%, #081116 100%);
            border-top: 1px solid var(--laris-border-emerald);
            border-bottom: 1px solid var(--laris-border-emerald);
            position: relative;
            padding: 100px 24px;
            overflow: hidden;
            z-index: 2;
        }

        .mission-inner {
            max-width: 920px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .mission-inner h2 {
            font-size: clamp(26px, 4.5vw, 42px);
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 24px;
            line-height: 1.25;
            letter-spacing: -0.02em;
        }

        .mission-inner p {
            font-size: clamp(14.5px, 2vw, 16.5px);
            color: rgba(226, 232, 240, 0.9);
            line-height: 1.8;
            margin-bottom: 22px;
        }

        .mission-highlight-card {
            background: rgba(18, 29, 36, 0.6);
            border: 1px solid rgba(16, 185, 129, 0.25);
            border-radius: 20px;
            padding: 28px;
            margin-top: 36px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            text-align: left;
            backdrop-filter: blur(10px);
        }

        .mission-pill-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .mission-pill-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(16, 185, 129, 0.15);
            color: var(--laris-mint);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 4px;
        }

        .mission-pill-title {
            font-size: 14px;
            font-weight: 700;
            color: #FFFFFF;
        }

        .mission-pill-desc {
            font-size: 12.5px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* 5. INTERACTIVE 4 ROLES EXPLORER SECTION */
        .role-tabs-nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 36px;
        }

        .role-tab-btn {
            background: var(--laris-bg-card);
            border: 1px solid var(--laris-border-subtle);
            color: var(--text-muted);
            font-size: clamp(12px, 1.8vw, 13.5px);
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
            background: var(--laris-bg-card-hover);
            color: #FFFFFF;
            border-color: rgba(255, 255, 255, 0.2);
        }

        .role-tab-btn.active {
            background: var(--laris-cyber-lime);
            color: #080D11;
            border-color: var(--laris-cyber-lime);
            box-shadow: 0 4px 18px rgba(204, 255, 0, 0.35);
        }

        .role-showcase-card {
            background: var(--laris-bg-card);
            border: 1px solid var(--laris-border-subtle);
            border-radius: 24px;
            padding: clamp(24px, 4vw, 44px);
            display: none;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
            box-shadow: var(--shadow-soft);
            transition: all 0.35s ease;
        }

        .role-showcase-card.active {
            display: grid;
            animation: fadeInScale 0.35s ease-out;
        }

        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.98) translateY(8px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .role-card-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
            background: rgba(16, 185, 129, 0.12);
            color: var(--laris-mint);
            border: 1px solid rgba(16, 185, 129, 0.25);
            margin-bottom: 14px;
        }

        .role-card-title {
            font-size: clamp(22px, 3.5vw, 30px);
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 12px;
        }

        .role-card-summary {
            font-size: clamp(13.5px, 1.8vw, 15px);
            color: var(--text-body);
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
            font-size: clamp(12.5px, 1.6vw, 13.5px);
            color: var(--text-body);
        }

        .role-bullet-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            margin-top: 2px;
            color: var(--laris-mint);
        }

        /* Mockup Preview Box inside Role Showcase */
        .role-mockup-preview {
            background: #080D11;
            border: 1px solid var(--laris-border-emerald);
            border-radius: 18px;
            padding: 24px;
            box-shadow: inset 0 0 24px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .mockup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 12px;
            margin-bottom: 16px;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--text-dim);
        }

        .mockup-live-indicator {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--laris-mint);
            font-size: 11px;
            font-weight: 700;
        }

        .mockup-pulse-dot {
            width: 7px;
            height: 7px;
            background: var(--laris-mint);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--laris-mint);
        }

        /* 6. DEDICATED HIGHLIGHT: LARIS LITE (MODE OFFLINE 3T & SYNC WHEN ONLINE) */
        .lite-section {
            background: linear-gradient(135deg, #0A151C 0%, #0F2229 50%, #081116 100%);
            border-top: 1px solid var(--laris-border-emerald);
            border-bottom: 1px solid var(--laris-border-emerald);
            padding: 100px 24px;
            position: relative;
            z-index: 2;
        }

        .lite-container {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 48px;
            align-items: center;
        }

        .mvp-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.35);
            color: #FBBF24;
            font-size: 11px;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .lite-feature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin: 28px 0;
        }

        .lite-feature-item {
            background: rgba(18, 29, 36, 0.7);
            border: 1px solid var(--laris-border-subtle);
            border-radius: 14px;
            padding: 18px;
        }

        .lite-feature-item h4 {
            font-size: 14px;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .lite-feature-item p {
            font-size: 12.5px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .mvp-disclaimer-box {
            background: rgba(245, 158, 11, 0.08);
            border-left: 3px solid #F59E0B;
            padding: 14px 18px;
            border-radius: 0 10px 10px 0;
            font-size: 12.5px;
            color: #FDE68A;
            line-height: 1.6;
        }

        /* Interactive Simulator Box for LARIS Lite */
        .simulator-interactive-box {
            background: var(--laris-bg-card);
            border: 1px solid var(--laris-border-emerald);
            border-radius: 24px;
            padding: clamp(20px, 3.5vw, 32px);
            box-shadow: var(--shadow-emerald);
        }

        .simulator-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 16px;
            margin-bottom: 20px;
        }

        .sim-status-toggle {
            display: flex;
            background: #080D11;
            border: 1px solid var(--laris-border-subtle);
            border-radius: 9999px;
            padding: 3px;
        }

        .sim-toggle-btn {
            background: transparent;
            border: none;
            color: var(--text-dim);
            font-size: 11.5px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 9999px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .sim-toggle-btn.active.online {
            background: var(--laris-emerald);
            color: #FFFFFF;
        }

        .sim-toggle-btn.active.offline {
            background: #EF4444;
            color: #FFFFFF;
        }

        .sim-screen {
            background: #080D11;
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .sim-screen-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-dim);
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
        }

        .sim-queue-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 160px;
            overflow-y: auto;
        }

        .sim-queue-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sim-action-btn {
            width: 100%;
            background: var(--laris-cyber-lime);
            color: #080D11;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .sim-action-btn:hover {
            background: var(--laris-cyber-lime-hover);
            transform: translateY(-1px);
        }

        /* 7. FIVE LAYER ARCHITECTURE (Intelligence Loop) */
        .pipeline-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-top: 36px;
        }

        .pipeline-card {
            background: var(--laris-bg-card);
            border: 1px solid var(--laris-border-subtle);
            border-radius: 18px;
            padding: 22px 18px;
            position: relative;
            transition: all 0.3s ease;
        }

        .pipeline-card:hover {
            border-color: var(--laris-mint);
            transform: translateY(-4px);
            background: var(--laris-bg-card-hover);
        }

        .pipeline-number {
            font-size: 11px;
            font-weight: 800;
            color: var(--laris-cyber-lime);
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .pipeline-title {
            font-size: 15px;
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 8px;
        }

        .pipeline-desc {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* 8. CORE 6 INNOVATIONS GRID WITH MODAL TRIGGER */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: var(--laris-bg-card);
            border: 1px solid var(--laris-border-subtle);
            border-radius: 20px;
            padding: clamp(22px, 3vw, 30px);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
        }

        .feature-card:hover {
            border-color: var(--laris-mint);
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.5);
            background: var(--laris-bg-card-hover);
        }

        .feature-icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(16, 185, 129, 0.12);
            color: var(--laris-mint);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }

        .feature-card h3 {
            font-size: clamp(16px, 2.2vw, 19px);
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: clamp(12.5px, 1.6vw, 14px);
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .feature-card-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--laris-cyber-lime);
            font-size: 12.5px;
            font-weight: 700;
        }

        /* 9. INTERACTIVE ROI & PROFIT SIMULATOR */
        .roi-section {
            background: #080D11;
            border-top: 1px solid var(--laris-border-subtle);
            border-bottom: 1px solid var(--laris-border-subtle);
            padding: 100px 24px;
            position: relative;
            z-index: 2;
        }

        .roi-calculator-box {
            max-width: 960px;
            margin: 0 auto;
            background: var(--laris-bg-card);
            border: 1px solid var(--laris-border-emerald);
            border-radius: 24px;
            padding: clamp(24px, 4vw, 44px);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            box-shadow: var(--shadow-soft);
        }

        .roi-slider-group {
            margin-bottom: 24px;
        }

        .roi-slider-label {
            display: flex;
            justify-content: space-between;
            font-size: 13.5px;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 10px;
        }

        .roi-slider-val {
            color: var(--laris-cyber-lime);
            font-weight: 800;
        }

        .roi-slider {
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: rgba(255, 255, 255, 0.1);
            outline: none;
            -webkit-appearance: none;
        }

        .roi-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--laris-cyber-lime);
            cursor: pointer;
            box-shadow: 0 0 10px var(--laris-cyber-lime);
        }

        .roi-result-card {
            background: #080D11;
            border: 1px solid var(--laris-border-subtle);
            border-radius: 18px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .roi-kpi-row {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            padding-bottom: 14px;
            margin-bottom: 14px;
        }

        .roi-kpi-sub {
            font-size: 11.5px;
            color: var(--text-dim);
            text-transform: uppercase;
            font-weight: 700;
        }

        .roi-kpi-big {
            font-size: clamp(22px, 3.5vw, 32px);
            font-weight: 800;
            color: var(--laris-mint);
            margin-top: 4px;
        }

        /* 10. TESTIMONIALS & CASE STUDIES */
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .testimonial-card {
            background: var(--laris-bg-card);
            border: 1px solid var(--laris-border-subtle);
            border-radius: 20px;
            padding: 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .testimonial-quote {
            font-size: 14px;
            color: var(--text-body);
            line-height: 1.65;
            margin-bottom: 20px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            padding-top: 16px;
        }

        .author-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.2);
            color: var(--laris-mint);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
        }

        .author-name {
            font-size: 13.5px;
            font-weight: 700;
            color: #FFFFFF;
        }

        .author-shop {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        /* 11. FAQ ACCORDION */
        .faq-accordion-box {
            max-width: 840px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .faq-item {
            background: var(--laris-bg-card);
            border: 1px solid var(--laris-border-subtle);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.25s ease;
        }

        .faq-item.active {
            border-color: var(--laris-mint);
        }

        .faq-question {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-size: clamp(14px, 2vw, 16px);
            font-weight: 700;
            color: #FFFFFF;
        }

        .faq-icon-arrow {
            width: 20px;
            height: 20px;
            color: var(--laris-mint);
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }

        .faq-item.active .faq-icon-arrow {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
            padding: 0 24px;
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .faq-item.active .faq-answer {
            padding-bottom: 20px;
            max-height: 300px;
        }

        /* 12. FINAL CALL-TO-ACTION */
        .cta-bottom-section {
            background: radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.18) 0%, transparent 70%),
                        linear-gradient(180deg, var(--laris-bg-base) 0%, #06090C 100%);
            padding: 110px 24px;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .cta-bottom-box {
            max-width: 820px;
            margin: 0 auto;
            background: var(--laris-bg-card);
            border: 1px solid var(--laris-border-emerald);
            border-radius: 28px;
            padding: clamp(32px, 5vw, 64px) 24px;
            box-shadow: var(--shadow-soft);
        }

        /* 13. SITE FOOTER */
        .site-footer {
            border-top: 1px solid var(--laris-border-subtle);
            background: #05080A;
            padding: 60px 24px 36px 24px;
            position: relative;
            z-index: 2;
            font-size: 13px;
            color: var(--text-dim);
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 48px;
        }

        .footer-brand p {
            margin-top: 12px;
            line-height: 1.6;
            max-width: 320px;
        }

        .footer-col h5 {
            font-size: 13.5px;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 16px;
        }

        .footer-col ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-col a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-col a:hover {
            color: var(--laris-cyber-lime);
        }

        .footer-bottom {
            max-width: 1280px;
            margin: 0 auto;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
        }

        /* INTERACTIVE MODAL DIALOG */
        .feature-modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(12px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .feature-modal-backdrop.active {
            display: flex;
            animation: fadeIn 0.25s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .feature-modal-box {
            background: var(--laris-bg-card);
            border: 1px solid var(--laris-border-emerald);
            border-radius: 24px;
            max-width: 680px;
            width: 100%;
            padding: clamp(24px, 4vw, 36px);
            position: relative;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.7);
            animation: modalScale 0.25s ease-out;
        }

        @keyframes modalScale {
            from { transform: scale(0.92); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.08);
            border: none;
            color: var(--text-body);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close-btn:hover {
            background: rgba(255, 255, 255, 0.16);
            color: #FFFFFF;
        }

        /* ==========================================================================
           RESPONSIVE BREAKPOINTS (Mobile, Tablet, Desktop)
           Ensures text and buttons scale down gracefully on mobile devices.
           ========================================================================== */
        @media (max-width: 1024px) {
            .desktop-nav {
                display: none;
            }
            .mobile-menu-btn {
                display: block;
            }
            .role-showcase-card {
                grid-template-columns: 1fr;
            }
            .lite-container {
                grid-template-columns: 1fr;
            }
            .pipeline-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .roi-calculator-box {
                grid-template-columns: 1fr;
            }
            .footer-inner {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .section-container {
                padding: 64px 16px;
            }
            .hero-section {
                padding: 100px 16px 60px 16px;
            }
            .hero-metrics-strip {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
                padding: 16px;
            }
            .metric-card:nth-child(2)::after {
                display: none;
            }
            .mission-highlight-card {
                grid-template-columns: 1fr;
                padding: 20px;
            }
            .lite-feature-grid {
                grid-template-columns: 1fr;
            }
            .pipeline-grid {
                grid-template-columns: 1fr;
            }
            .features-grid {
                grid-template-columns: 1fr;
            }
            .testimonial-grid {
                grid-template-columns: 1fr;
            }
            .hero-btn-group {
                flex-direction: column;
                width: 100%;
            }
            .hero-cta-main, .hero-cta-alt {
                width: 100%;
                justify-content: center;
                padding: 12px 20px;
                font-size: 13.5px;
            }
            .role-tab-btn {
                padding: 8px 14px;
                font-size: 12px;
            }
            .footer-inner {
                grid-template-columns: 1fr;
                gap: 28px;
            }
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .site-header {
                height: 64px;
            }
            .brand-logo-img {
                height: 32px;
            }
            .hero-badge-pill {
                font-size: 10px;
                padding: 4px 12px;
            }
            .section-tag {
                font-size: 10px;
                padding: 3px 10px;
            }
            .btn-nav-primary {
                padding: 7px 14px;
                font-size: 11.5px;
            }
            .btn-nav-ghost {
                display: none;
            }
            .metric-value {
                font-size: 20px;
            }
            .metric-label {
                font-size: 10.5px;
            }
        }
    </style>
</head>
<body>

    <!-- Ambient Floating Orbs -->
    <div class="ambient-orb-container" aria-hidden="true">
        <div class="ambient-orb ambient-orb-1"></div>
        <div class="ambient-orb ambient-orb-2"></div>
        <div class="ambient-orb ambient-orb-3"></div>
    </div>

    <!-- 1. TRANSPARENT / GLASSMORPHIC SITE HEADER -->
    <header class="site-header" id="site-header">
        <div class="header-container">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-logo-area">
                <img src="{{ asset('logo.png') }}" alt="LARIS Logo" class="brand-logo-img">
            </a>

            <!-- Desktop Navigation Links (Simple, Clean & Balanced) -->
            <nav>
                <ul class="desktop-nav">
                    <li><a href="#about">Misi Inovasi</a></li>
                    <li><a href="#roles">5 Peran Ekosistem</a></li>
                    <li><a href="#lite">LARIS Lite</a></li>
                    <li><a href="#features">Fitur AI</a></li>
                    <li><a href="#roi">Simulator ROI</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </nav>

            <!-- Action CTAs -->
            <div class="header-action-group">
                <a href="{{ url('/marketplace') }}" target="_blank" class="btn-nav-ghost" title="Buka Marketplace Publik (Tanpa Login)">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    <span>Marketplace ↗</span>
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-nav-primary">
                        <span>Dashboard &rarr;</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-nav-primary">
                        <span>Masuk</span>
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                @endauth

                <!-- Mobile Hamburger Toggle -->
                <button type="button" class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Buka Menu Navigasi">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Navigation Drawer -->
    <div class="mobile-dropdown-menu" id="mobile-dropdown-menu">
        <a href="#about" onclick="toggleMobileMenu()">Misi Inovasi</a>
        <a href="#roles" onclick="toggleMobileMenu()">5 Peran Ekosistem</a>
        <a href="#lite" onclick="toggleMobileMenu()" style="color: var(--laris-cyber-lime); font-weight: 700;">LARIS Lite (Mode Offline 3T)</a>
        <a href="#features" onclick="toggleMobileMenu()">Fitur AI</a>
        <a href="#roi" onclick="toggleMobileMenu()">Simulator ROI</a>
        <a href="#faq" onclick="toggleMobileMenu()">FAQ</a>
        <a href="{{ url('/marketplace') }}" target="_blank" onclick="toggleMobileMenu()">Marketplace Publik ↗</a>
        @auth
            <a href="{{ route('dashboard') }}" style="color: var(--laris-cyber-lime); font-weight: 800;">Buka Dashboard Akun &rarr;</a>
        @else
            <a href="{{ route('login') }}" style="color: var(--laris-cyber-lime); font-weight: 800;">Masuk Platform &rarr;</a>
        @endauth
    </div>

    <!-- MAIN PAGE CONTENT -->
    <main>
        <!-- 2. HERO SECTION WITH CINEMATIC VIDEO & TELEMETRY STRIP -->
        <section id="home" class="hero-section">
            <!-- Fullscreen Video Element: Autoplay, Loop, Muted, Playsinline -->
            <video class="hero-video" id="hero-bg-video" autoplay loop muted playsinline preload="auto">
                <source src="{{ asset('video.mp4') }}" type="video/mp4">
            </video>
            
            <!-- Dark Emerald Overlay -->
            <div class="hero-overlay" aria-hidden="true"></div>

            <!-- Hero Text Content -->
            <div class="hero-content">
                <div class="hero-badge-pill">
                    <span class="hero-pulse-dot"></span>
                    <span>MEUKARYA TEAM • INFEST HACKATHON 2026</span>
                </div>

                <h1 class="hero-title">
                    Kecerdasan Korporat Kini di Genggaman <span class="hero-title-highlight">Juragan &amp; UMKM Indonesia</span>
                </h1>

                <p class="hero-subtitle">
                    Demokratisasi data intelligence ritel dengan Explainable AI transparan, integrasi sinyal pasar multi-channel real-time, serta teknologi on-device offline untuk daerah 3T tanpa internet.
                </p>

                <!-- Responsive Buttons -->
                <div class="hero-btn-group">
                    <a href="{{ route('login') }}" class="hero-cta-main">
                        <span>Jelajahi Demo 4 Role</span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                    <a href="#lite" class="hero-cta-alt">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.516 0c.85.493 1.508 1.333 1.508 2.316V18"/></svg>
                        <span>Mode Offline &amp; Sinkronisasi POS (LARIS Lite)</span>
                    </a>
                </div>

                <!-- Live Telemetry KPI Metrics Strip -->
                <div class="hero-metrics-strip">
                    <div class="metric-card">
                        <div class="metric-value">12.400<span class="highlight">+</span></div>
                        <div class="metric-label">Gerai UMKM Terhubung</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-value">Rp 184 Miliar<span class="highlight">+</span></div>
                        <div class="metric-label">Efisiensi Modal Belanja Stok</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-value">94.2<span class="highlight">%</span></div>
                        <div class="metric-label">Akurasi Prediksi Tren</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-value">0<span class="highlight"> Detik</span></div>
                        <div class="metric-label">Downtime di Wilayah 3T</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. MULTI-CHANNEL CONNECTOR STRIP -->
        <section class="connector-strip">
            <div class="connector-inner">
                <span class="connector-label">Terhubung Langsung dengan Ekosistem Ritel, Marketplace, &amp; Finansial Nasional</span>
                <div class="connector-badges">
                    <div class="connector-badge">
                        <span class="connector-dot" style="background: #4285F4;"></span>
                        <span>Google Trends API</span>
                    </div>
                    <div class="connector-badge">
                        <span class="connector-dot" style="background: #E37400;"></span>
                        <span>Google Analytics 4</span>
                    </div>
                    <div class="connector-badge">
                        <span class="connector-dot" style="background: #FE2C55;"></span>
                        <span>TikTok Shop Intelligence</span>
                    </div>
                    <div class="connector-badge">
                        <span class="connector-dot" style="background: #03AC0E;"></span>
                        <span>Tokopedia Official Store</span>
                    </div>
                    <div class="connector-badge">
                        <span class="connector-dot" style="background: #EE4D2D;"></span>
                        <span>Shopee Open Platform</span>
                    </div>
                    <div class="connector-badge">
                        <span class="connector-dot" style="background: #005E9E;"></span>
                        <span>QRIS Bank Indonesia</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. REDESIGNED MISSION & SOCIAL IMPACT SECTION (LARIS OBSIDIAN THEME) -->
        <section id="about" class="mission-section">
            <div class="mission-inner">
                <span class="section-tag">Misi Inovasi Sosial &amp; Ekonomi</span>
                <h2>Membawa Kecerdasan Korporat ke Warung &amp; UMKM Indonesia</h2>
                <p>
                    Selama ini, sistem analitik cerdas dan AI prediktif hanya dinikmati oleh jaringan ritel modern raksasa dengan modal triliunan rupiah. Pemilik warung dan UMKM tradisional harus berspekulasi dengan modal terbatas, sering terjebak dead-stock, atau kehabisan stok saat permintaan melonjak.
                </p>
                <p>
                    <strong>LARIS hadir sebagai jawaban nyata untuk tema "AI for All: Intelligent Solutions for an Equitable Future".</strong> Kami mendemokratisasi akses ke data intelligence dengan antarmuka yang ramah bagi semua usia, Explainable AI yang menyertakan alasan transparan (Confidence Score &amp; Why Factor), serta mekanisme On-Device Edge AI agar UMKM di daerah 3T yang minim sinyal internet tetap berdaya dan sejahtera.
                </p>

                <!-- 3 Pillars Grid -->
                <div class="mission-highlight-card">
                    <div class="mission-pill-item">
                        <div class="mission-pill-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/></svg>
                        </div>
                        <div class="mission-pill-title">Zero-Complexity UI</div>
                        <div class="mission-pill-desc">Dirancang ramah usia. Tanpa rumus rumit, insight disajikan dalam bahasa sehari-hari juragan warung.</div>
                    </div>
                    <div class="mission-pill-item">
                        <div class="mission-pill-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                        </div>
                        <div class="mission-pill-title">Explainable AI (XAI)</div>
                        <div class="mission-pill-desc">Bukan black-box. Setiap saran restock menyertakan alasan transparan dan tingkat keyakinan (Confidence Score).</div>
                    </div>
                    <div class="mission-pill-item">
                        <div class="mission-pill-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.516 0c.85.493 1.508 1.333 1.508 2.316V18"/></svg>
                        </div>
                        <div class="mission-pill-title">Pemerataan 3T Inklusif</div>
                        <div class="mission-pill-desc">Memastikan toko di pelosok pulau terpencil tetap dapat mencatat penjualan tanpa jaringan internet.</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. INTERACTIVE 5 ROLES EXPLORER SECTION -->
        <section id="roles" class="section-container">
            <div class="section-header">
                <span class="section-tag">Arsitektur 5 Role Terpadu</span>
                <h2 class="section-title">5 Pilihan Peran, 1 Ekosistem Terpadu</h2>
                <p class="section-desc">
                    Masing-masing role memiliki kredensial sesi, hak akses, dan dashboard khusus terisolasi. Klik tab di bawah untuk melihat alur kerja operasional tiap peran:
                </p>
            </div>

            <!-- Role Tabs Selector -->
            <div class="role-tabs-nav">
                <button type="button" class="role-tab-btn active" onclick="switchRoleTab('admin', this)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                    <span>1. Super Admin</span>
                </button>
                <button type="button" class="role-tab-btn" onclick="switchRoleTab('owner', this)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                    <span>2. Juragan UMKM (Owner)</span>
                </button>
                <button type="button" class="role-tab-btn" onclick="switchRoleTab('cashier', this)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0-8.25h19.5m0 0v8.25m0-8.25v-.75a.75.75 0 0 0-.75-.75h-.75m0 0V4.5m-18 0h18"/></svg>
                    <span>3. Kasir Toko (Smart POS)</span>
                </button>
                <button type="button" class="role-tab-btn" onclick="switchRoleTab('inventory', this)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                    <span>4. Staf Gudang (Smart Inventory)</span>
                </button>
                <button type="button" class="role-tab-btn" onclick="switchRoleTab('user', this)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                    <span>5. User (Pembeli / Konsumen)</span>
                </button>
            </div>

            <!-- Role Panel 1: SUPER ADMIN -->
            <div id="role-panel-admin" class="role-showcase-card active">
                <div>
                    <span class="role-card-badge">Pusat Tata Kelola Platform</span>
                    <h3 class="role-card-title">Super Administrator Platform</h3>
                    <p class="role-card-summary">
                        Mengontrol operasional seluruh ekosistem ritel secara nasional. Dilengkapi metrik GMV agregat, kontrol verifikasi gerai UMKM, aktivasi kebijakan pengantaran gerai, dan manajemen multi-role terpusat.
                    </p>
                    <ul class="role-bullet-list">
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Verifikasi &amp; Audit Gerai:</strong> Kurasi gerai UMKM terdaftar lintas sektor sebelum tampil di marketplace konsumen.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Regulasi Layanan Pengantaran:</strong> Mengaktifkan atau menonaktifkan opsi delivery dan tarif ongkir tiap merchant.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Pusat Pengguna 4 Role:</strong> Tambah user baru dan atur hak akses peran (Admin, Juragan, Kasir, User).</span>
                        </li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn-nav-primary" style="padding: 12px 28px; font-size: 13.5px;">Coba Akun Super Admin &rarr;</a>
                </div>

                <div class="role-mockup-preview">
                    <div class="mockup-header">
                        <span>SUPER_ADMIN_CONSOLE.PHP</span>
                        <div class="mockup-live-indicator">
                            <span class="mockup-pulse-dot"></span>
                            <span>PLATFORM AKTIF</span>
                        </div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: 12px; padding: 14px; margin-bottom: 12px;">
                        <div style="font-size: 11px; color: var(--text-muted);">Total GMV Nasional Terproses</div>
                        <div style="font-size: 22px; font-weight: 800; color: #FFFFFF; margin: 4px 0;">Rp 128.450.000</div>
                        <div style="font-size: 11.5px; color: var(--laris-mint);">6 Gerai Terdaftar • 5 Sektor UMKM Aktif</div>
                    </div>
                    <div style="background: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.25); border-radius: 10px; padding: 12px; font-size: 12px; color: #E2E8F0;">
                        Toko Berkah (Sembako): <strong style="color: var(--laris-cyber-lime);">Terverifikasi • Delivery Aktif</strong>
                    </div>
                </div>
            </div>

            <!-- Role Panel 2: OWNER (JURAGAN) -->
            <div id="role-panel-owner" class="role-showcase-card">
                <div>
                    <span class="role-card-badge">Pusat Kendali Eksekutif</span>
                    <h3 class="role-card-title">Juragan UMKM (Owner)</h3>
                    <p class="role-card-summary">
                        Membantu pemilik bisnis mengambil keputusan tanpa spekulasi. Dilengkapi prediksi kelayakan restock (LARIS Predict), Trend Hunter multi-channel, dan asisten AI Juragan Copilot.
                    </p>
                    <ul class="role-bullet-list">
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Prediksi Restock AI:</strong> Analisis margin, proyeksi permintaan pasar, dan risiko dead-stock sebelum belanja modal stok baru.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Trend Hunter 5 Sinyal:</strong> Pantau data TikTok Shop, Google Trends, Tokopedia, Shopee, dan tren wilayah sekitar.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Juragan AI Copilot:</strong> Konsultasikan strategi harga, status stok kritis, dan proyeksi permintaan pasar.</span>
                        </li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn-nav-primary" style="padding: 12px 28px; font-size: 13.5px;">Coba Akun Juragan &rarr;</a>
                </div>

                <div class="role-mockup-preview">
                    <div class="mockup-header">
                        <span>BUSINESS_DASHBOARD.PHP</span>
                        <div class="mockup-live-indicator">
                            <span class="mockup-pulse-dot"></span>
                            <span>TELEMETRI AKTIF</span>
                        </div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: 12px; padding: 14px; margin-bottom: 12px;">
                        <div style="font-size: 11px; color: var(--text-muted);">Omzet Penjualan Hari Ini</div>
                        <div style="font-size: 22px; font-weight: 800; color: #FFFFFF; margin: 4px 0;">Rp 4.750.000</div>
                        <div style="font-size: 11px; color: var(--laris-mint);">+18.4% vs target harian (Runway 12 Hari)</div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: 10px; padding: 12px; font-size: 12px; color: #CBD5E1; line-height: 1.5;">
                        <span style="color: var(--laris-cyber-lime); font-weight: 700;">Juragan AI:</span> "Permintaan Kopi Susu Aren naik 35%. AI sarankan reorder 2 karton sirup sebelum hari Jumat."
                    </div>
                </div>
            </div>

            <!-- Role Panel 3: CASHIER -->
            <div id="role-panel-cashier" class="role-showcase-card">
                <div>
                    <span class="role-card-badge">Operasional Frontliner</span>
                    <h3 class="role-card-title">Kasir Toko (Smart POS)</h3>
                    <p class="role-card-summary">
                        Mesin kasir berbasis web yang sangat cepat dan ringan. Mendukung pemotongan stok otomatis real-time, cetak struk profesional, input kasbon, dan pembayaran QRIS instan.
                    </p>
                    <ul class="role-bullet-list">
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Pencatatan 1-Klik:</strong> Tambah item ke keranjang kasir dalam hitungan detik tanpa lag.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Pemotongan Stok Atomik:</strong> Setiap transaksi kasir langsung memotong kuantitas fisik di gudang.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Multi-Metode Bayar:</strong> Mendukung Tunai (otomatis hitung kembalian) dan QRIS dinamis.</span>
                        </li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn-nav-primary" style="padding: 12px 28px; font-size: 13.5px;">Coba Akun Kasir &rarr;</a>
                </div>

                <div class="role-mockup-preview">
                    <div class="mockup-header">
                        <span>SMART_POS_TERMINAL.PHP</span>
                        <div class="mockup-live-indicator">
                            <span class="mockup-pulse-dot"></span>
                            <span>POS SIAP LAYANI</span>
                        </div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: 12px; padding: 14px; margin-bottom: 12px;">
                        <div style="display: flex; justify-content: space-between; font-size: 12.5px; color: #CBD5E1;">
                            <span>Kopi Arabika Gayo x 2</span>
                            <strong>Rp 70.000</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 12.5px; color: #CBD5E1; margin-top: 6px;">
                            <span>Gula Aren Cair 500ml x 1</span>
                            <strong>Rp 24.000</strong>
                        </div>
                        <div style="border-top: 1px dashed rgba(255,255,255,0.15); margin-top: 10px; padding-top: 10px; display: flex; justify-content: space-between; font-size: 14px; font-weight: 800; color: #FFFFFF;">
                            <span>Total Belanja:</span>
                            <span style="color: var(--laris-cyber-lime);">Rp 94.000</span>
                        </div>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <button type="button" style="flex: 1; background: var(--laris-emerald); border: none; padding: 10px; border-radius: 8px; color: #FFF; font-size: 11.5px; font-weight: 700;">Bayar Tunai</button>
                        <button type="button" style="flex: 1; background: rgba(255, 255, 255, 0.1); border: 1px solid var(--laris-border-subtle); padding: 10px; border-radius: 8px; color: #FFF; font-size: 11.5px; font-weight: 700;">Bayar QRIS</button>
                    </div>
                </div>
            </div>

            <!-- Role Panel 4: STAF GUDANG & LOGISTIK (SMART INVENTORY) -->
            <div id="role-panel-inventory" class="role-showcase-card">
                <div>
                    <span class="role-card-badge">Pusat Logistik &amp; Runway Stok</span>
                    <h3 class="role-card-title">Staf Gudang &amp; Logistik (Smart Inventory)</h3>
                    <p class="role-card-summary">
                        Mengontrol pergerakan fisik barang dengan asistensi AI. Dilengkapi kalkulasi ketahanan operasional (Stock Runway Days), deteksi dini stok kritis, reorder pintar otomatis, dan audit penyesuaian stok real-time tanpa resiko selisih fisik.
                    </p>
                    <ul class="role-bullet-list">
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Kalkulasi Runway Stok AI:</strong> Mengetahui secara presisi berapa hari stok akan bertahan berdasarkan laju penjualan riil POS.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Peringatan Dini Stok Kritis:</strong> Alarm otomatis ketika kuantitas fisik mendekati ambang batas minimum gerai.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Reorder 1-Klik Otomatis:</strong> Eksekusi order ulang ke supplier resmi dengan kuantitas yang dihitung secara presisi.</span>
                        </li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn-nav-primary" style="padding: 12px 28px; font-size: 13.5px;">Coba Akun Staf Gudang &rarr;</a>
                </div>

                <div class="role-mockup-preview">
                    <div class="mockup-header">
                        <span>SMART_INVENTORY_SYSTEM.PHP</span>
                        <div class="mockup-live-indicator">
                            <span class="mockup-pulse-dot"></span>
                            <span>INVENTORY SINKRON</span>
                        </div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: 12px; padding: 14px; margin-bottom: 12px;">
                        <div style="font-size: 11px; color: var(--text-muted);">Status Kesehatan Stok Keseluruhan</div>
                        <div style="font-size: 20px; font-weight: 800; color: #FFFFFF; margin: 4px 0;">34 SKU Aktif • 97% Sehat</div>
                        <div style="font-size: 11.5px; color: #10B981;">Rata-rata Runway: 18.4 Hari Operasional</div>
                    </div>
                    <div style="background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 10px; padding: 12px; font-size: 12px; color: #FECDD3;">
                        <strong style="color: #F87171;">Perlu Restock:</strong> Kopi Arabika Gayo (Tersisa 4 pack • Runway 2 Hari).
                    </div>
                </div>
            </div>

            <!-- Role Panel 5: USER (PEMBELI & WARGA SEKITAR) -->
            <div id="role-panel-user" class="role-showcase-card">
                <div>
                    <span class="role-card-badge">Portal Konsumen Ekosistem</span>
                    <h3 class="role-card-title">User (Pembeli / Warga Sekitar)</h3>
                    <p class="role-card-summary">
                        Pengalaman berbelanja ala Gojek Marketplace untuk warga dan konsumen. Jelajah semua gerai UMKM terdekat, pesan barang dengan opsi Delivery atau Self-Pickup, dan klaim diskon voucher.
                    </p>
                    <ul class="role-bullet-list">
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Multi-Gerai Lintas Sektor:</strong> Temukan warung sembako, kuliner, fesyen, kriya, dan jasa di sekitar Anda.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Opsi Delivery vs Ambil Sendiri:</strong> Pesanan diantar jika toko menyediakan delivery, atau ambil langsung ke gerai jika toko pickup-only.</span>
                        </li>
                        <li class="role-bullet-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span><strong>Voucher &amp; Pelacakan Real-Time:</strong> Gunakan kupon diskon (DISKON10K, GRATISONGKIR) dan pantau status pesanan hingga selesai.</span>
                        </li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn-nav-primary" style="padding: 12px 28px; font-size: 13.5px;">Coba Akun User (Pembeli) &rarr;</a>
                </div>

                <div class="role-mockup-preview">
                    <div class="mockup-header">
                        <span>USER_MARKETPLACE.PHP</span>
                        <div class="mockup-live-indicator">
                            <span class="mockup-pulse-dot"></span>
                            <span>MARKETPLACE AKTIF</span>
                        </div>
                    </div>
                    <div style="background: rgba(204, 255, 0, 0.08); border: 1px solid rgba(204, 255, 0, 0.25); border-radius: 12px; padding: 12px; margin-bottom: 12px;">
                        <div style="font-size: 10.5px; font-weight: 800; color: var(--laris-cyber-lime); text-transform: uppercase;">KUPON AKTIF: DISKON10K (-Rp 10.000)</div>
                        <div style="font-size: 13px; font-weight: 700; color: #FFFFFF; margin-top: 4px;">Toko Berkah (Sembako &amp; Kelontong)</div>
                        <div style="font-size: 11.5px; color: var(--laris-mint); margin-top: 2px;">Bisa Diantar (Delivery 5 km) • Biaya Ongkir: Rp 5.000</div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: 10px; padding: 10px; font-size: 11.5px; color: var(--text-dim); display: flex; justify-content: space-between;">
                        <span>Pelacakan Pesanan:</span>
                        <strong style="color: var(--laris-mint);">Disiapkan Gerai &rarr;</strong>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. DEDICATED SECTION: LARIS LITE (MODE OFFLINE 3T & SYNC WHEN ONLINE) -->
        <section id="lite" class="lite-section">
            <div class="lite-container">
                <div>
                    <span class="mvp-badge">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/></svg>
                        <span>Teknologi Inklusif 3T • Status: Active MVP</span>
                    </span>

                    <h2 class="section-title" style="text-align: left;">
                        LARIS Lite: Tetap Beroperasi Penuh <span style="color: var(--laris-cyber-lime);">Tanpa Sinyal Internet</span>
                    </h2>

                    <p class="section-desc" style="text-align: left; margin-bottom: 24px;">
                        Solusi nyata bagi jutaan UMKM di wilayah Terdepan, Terluar, dan Tertinggal (3T) atau saat cuaca buruk memutus jaringan internet. Transaksi kasir dan stok tetap berjalan 100% menggunakan memori browser lokal.
                    </p>

                    <!-- 4 Sub-features -->
                    <div class="lite-feature-grid">
                        <div class="lite-feature-item">
                            <h4>
                                <svg width="18" height="18" fill="none" stroke="var(--laris-mint)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Local-First Storage</span>
                            </h4>
                            <p>Data tersimpan di SQLite / IndexedDB lokal. Kasir tetap bisa input barang dan cetak struk fisik.</p>
                        </div>
                        <div class="lite-feature-item">
                            <h4>
                                <svg width="18" height="18" fill="none" stroke="var(--laris-cyber-lime)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                                <span>Sync When Online</span>
                            </h4>
                            <p>Begitu perangkat mendeteksi koneksi internet, seluruh antrean lokal otomatis terunggah ke cloud.</p>
                        </div>
                        <div class="lite-feature-item">
                            <h4>
                                <svg width="18" height="18" fill="none" stroke="var(--laris-mint)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                                <span>Zero Data Conflict</span>
                            </h4>
                            <p>Mekanisme stempel waktu otomatis mencegah duplikasi transaksi dan salah hitung stok.</p>
                        </div>
                        <div class="lite-feature-item">
                            <h4>
                                <svg width="18" height="18" fill="none" stroke="var(--laris-cyber-lime)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                                <span>Ringan &amp; Hemat Baterai</span>
                            </h4>
                            <p>Dapat berjalan lancar pada smartphone Android murah dengan RAM 2GB sekalipun.</p>
                        </div>
                    </div>

                    <!-- MVP Roadmap Notice -->
                    <div class="mvp-disclaimer-box">
                        <strong>Catatan Transparansi Pengembangan (Roadmap):</strong><br>
                        Fitur pencatatan transaksi offline dan sinkronisasi otomatis dua arah saat online saat ini berstatus <strong>MVP (Minimum Viable Product) yang aktif berfungsi</strong>. Arsitektur model TinyLLM offline mandiri serta sinkronisasi mesh peer-to-peer antar-gerai tetangga dijadwalkan pada rilis pembaruan berikutnya.
                    </div>
                </div>

                <!-- Interactive Simulator Widget for LARIS Lite -->
                <div class="simulator-interactive-box">
                    <div class="simulator-header">
                        <div>
                            <div style="font-size: 14px; font-weight: 800; color: #FFFFFF;">Mode Offline &amp; Sinkronisasi POS LARIS Lite</div>
                            <div style="font-size: 11.5px; color: var(--text-muted);">Pencatatan kasir lokal &amp; sinkronisasi otomatis ke server</div>
                        </div>

                        <!-- Connectivity Toggle -->
                        <div class="sim-status-toggle">
                            <button type="button" id="sim-btn-online" class="sim-toggle-btn active online" onclick="setSimMode('online')">Online</button>
                            <button type="button" id="sim-btn-offline" class="sim-toggle-btn" onclick="setSimMode('offline')">Offline (3T)</button>
                        </div>
                    </div>

                    <!-- Screen Area -->
                    <div class="sim-screen">
                        <div class="sim-screen-title">
                            <span id="sim-status-text" style="color: var(--laris-mint); font-weight: 800;">● Terhubung ke Cloud Server (Online)</span>
                            <span id="sim-queue-counter">0 Transaksi Pending</span>
                        </div>

                        <div class="sim-queue-list" id="sim-queue-container">
                            <div class="sim-queue-item" style="color: var(--text-dim); justify-content: center;">
                                Belum ada antrean transaksi lokal. Coba ubah mode ke Offline.
                            </div>
                        </div>
                    </div>

                    <!-- Action Controls -->
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <button type="button" class="sim-action-btn" onclick="simulateOfflineTransaction()">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            <span>Catat Transaksi Kasir POS</span>
                        </button>

                        <button type="button" id="btn-sync-cloud" class="sim-action-btn" style="background: rgba(255, 255, 255, 0.08); color: var(--text-dim); cursor: not-allowed;" onclick="syncSimData()" disabled>
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                            <span id="sync-btn-label">Sinkronkan ke Cloud (Menunggu Sinyal)</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- 7. FIVE LAYER CLOSED-LOOP INTELLIGENCE PIPELINE -->
        <section id="loop" class="section-container">
            <div class="section-header">
                <span class="section-tag">Arsitektur Intelligence Loop</span>
                <h2 class="section-title">Pola 5 Lapisan Tertutup Menuju Keputusan Pasti</h2>
                <p class="section-desc">
                    Mengubah jutaan data mentah dari mesin kasir dan tren digital menjadi tindakan nyata pemilik toko tanpa dugaan kosong:
                </p>
            </div>

            <div class="pipeline-grid">
                <div class="pipeline-card">
                    <div class="pipeline-number">Lapisan 1</div>
                    <div class="pipeline-title">Data Layer</div>
                    <div class="pipeline-desc">Pencatatan real-time POS kasir, e-commerce, biaya HPP per produk, dan struktur margin keuntungan.</div>
                </div>
                <div class="pipeline-card">
                    <div class="pipeline-number">Lapisan 2</div>
                    <div class="pipeline-title">Signal Layer</div>
                    <div class="pipeline-desc">Sensor tren TikTok Shop (+142% velocity), lonjakan Google Trends, dan kebutuhan geo-radius 5 km.</div>
                </div>
                <div class="pipeline-card">
                    <div class="pipeline-number">Lapisan 3</div>
                    <div class="pipeline-title">AI Intelligence</div>
                    <div class="pipeline-desc">LARIS Engine v3.8, Time-Series Depletion, Demand Forecasting, dan Opportunity Profit Engine.</div>
                </div>
                <div class="pipeline-card">
                    <div class="pipeline-number">Lapisan 4</div>
                    <div class="pipeline-title">Decision Layer</div>
                    <div class="pipeline-desc">Explainable AI menyertakan skor potensi produk (87/100), 88.2% Confidence Score, dan alasan "Why Factor".</div>
                </div>
                <div class="pipeline-card" style="border-color: var(--laris-border-emerald);">
                    <div class="pipeline-number" style="color: var(--laris-mint);">Lapisan 5</div>
                    <div class="pipeline-title">Action Layer</div>
                    <div class="pipeline-desc">Eksekusi 1-klik: Draf Auto-Bundle PO ke distributor, Flash Sale Cuci Gudang Jam 7 Malam, atau Pengadaan Grosir Bersama.</div>
                </div>
            </div>
        </section>

        <!-- 8. CORE 6 INNOVATIONS GRID WITH INTERACTIVE MODAL DETAILS -->
        <section id="features" class="section-container" style="padding-top: 20px;">
            <div class="section-header">
                <span class="section-tag">Teknologi Berdampak Nyata</span>
                <h2 class="section-title">6 Inovasi Utama Platform LARIS</h2>
                <p class="section-desc">
                    Dirancang dari masalah riil pemilik toko kelontong di lapangan dengan pendekatan Explainable AI. Klik tiap kartu untuk melihat rincian teknis lengkapnya:
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
                        <p>Prediksi sebelum pengadaan stok. AI memprediksi apakah suatu produk baru akan laku, menghitung margin aman, dan risiko dead-stock.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>

                <!-- Feature 2 -->
                <article class="feature-card" onclick="openFeatureModal('trends')">
                    <div>
                        <div class="feature-icon-circle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"/></svg>
                        </div>
                        <h3>Multi-Channel Trend Hunter</h3>
                        <p>Koneksi langsung ke Google Trends, TikTok Shop, Tokopedia, dan Shopee untuk menangkap tren produk sebelum kompetitor tahu.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>

                <!-- Feature 3 -->
                <article class="feature-card" onclick="openFeatureModal('copilot')">
                    <div>
                        <div class="feature-icon-circle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/></svg>
                        </div>
                        <h3>Juragan AI Copilot</h3>
                        <p>Asisten AI cerdas untuk berkonsultasi mengenai kesehatan keuangan bisnis, kebutuhan reorder stok, dan ekspor ringkasan ke WhatsApp.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>

                <!-- Feature 4 -->
                <article class="feature-card" onclick="openFeatureModal('flash')">
                    <div>
                        <div class="feature-icon-circle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z"/></svg>
                        </div>
                        <h3>Flash Sale Cuci Gudang Jam 7 Malam</h3>
                        <p>Dynamic Markdown otomatis. Barang yang mendekati masa kadaluarsa dijual kilat dengan diskon terhitung untuk memulihkan modal tunai.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>

                <!-- Feature 5 -->
                <article class="feature-card" onclick="openFeatureModal('pool')">
                    <div>
                        <div class="feature-icon-circle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>
                        </div>
                        <h3>Pengadaan Grosir Bersama (B2B Pool)</h3>
                        <p>Menggabungkan kuota belanja antar-juragan gerai sekecamatan untuk mendapatkan harga grosir langsung dari prinsipal pabrik.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>

                <!-- Feature 6 -->
                <article class="feature-card" onclick="openFeatureModal('xai')">
                    <div>
                        <div class="feature-icon-circle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                        </div>
                        <h3>Explainable AI (XAI)</h3>
                        <p>Transparan dan dapat diverifikasi. Setiap rekomendasi dilengkapi rincian faktor pemicu ("Why Factor") dan skor keyakinan.</p>
                    </div>
                    <span class="feature-card-action">Lihat Rincian Teknis &rarr;</span>
                </article>
            </div>
        </section>

        <!-- 9. INTERACTIVE ROI & PROFIT SIMULATOR -->
        <section id="roi" class="roi-section">
            <div class="section-container" style="padding-top: 0; padding-bottom: 0;">
                <div class="section-header">
                    <span class="section-tag">Kalkulator Penghematan</span>
                    <h2 class="section-title">Hitung Potensi Efisiensi Warung Anda</h2>
                    <p class="section-desc">
                        Geser slider modal belanja Anda untuk melihat estimasi penghematan dari eliminasi dead-stock dan peningkatan margin penjualan:
                    </p>
                </div>

                <div class="roi-calculator-box">
                    <div>
                        <!-- Slider 1 -->
                        <div class="roi-slider-group">
                            <div class="roi-slider-label">
                                <span>Modal Belanja Stok Bulanan</span>
                                <span class="roi-slider-val" id="val-capital">Rp 15.000.000</span>
                            </div>
                            <input type="range" min="3000000" max="80000000" step="1000000" value="15000000" class="roi-slider" id="slider-capital" oninput="updateRoiCalc()">
                        </div>

                        <!-- Slider 2 -->
                        <div class="roi-slider-group">
                            <div class="roi-slider-label">
                                <span>Estimasi Kerugian Dead-Stock Saat Ini</span>
                                <span class="roi-slider-val" id="val-deadstock">15%</span>
                            </div>
                            <input type="range" min="5" max="35" step="1" value="15" class="roi-slider" id="slider-deadstock" oninput="updateRoiCalc()">
                        </div>

                        <div style="font-size: 12.5px; color: var(--text-dim); line-height: 1.6; margin-top: 20px;">
                            *Dihitung berdasarkan data rata-rata perbaikan perputaran modal dari 120 warung percontohan mitra LARIS.
                        </div>
                    </div>

                    <!-- Output Card -->
                    <div class="roi-result-card">
                        <div>
                            <div class="roi-kpi-row">
                                <div class="roi-kpi-sub">Estimasi Penghematan Modal per Bulan</div>
                                <div class="roi-kpi-big" id="res-monthly-save">Rp 1.575.000</div>
                            </div>
                            <div class="roi-kpi-row" style="border: none;">
                                <div class="roi-kpi-sub">Potensi Tambahan Laba Bersih Tahunan</div>
                                <div class="roi-kpi-big" style="color: var(--laris-cyber-lime);" id="res-annual-gain">Rp 18.900.000</div>
                            </div>
                        </div>

                        <a href="{{ route('login') }}" class="btn-nav-primary" style="justify-content: center; width: 100%;">
                            <span>Amankan Penghematan Toko Saya &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 10. REAL TESTIMONIALS & SUCCESS STORIES -->
        <section class="section-container">
            <div class="section-header">
                <span class="section-tag">Cerita Nyata Mitra</span>
                <h2 class="section-title">Dipercaya oleh Ribuan Juragan Ritel</h2>
                <p class="section-desc">
                    Bagaimana teknologi Explainable AI dan mode offline membantu pemilik usaha kecil bertahan dan berkembang:
                </p>
            </div>

            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p class="testimonial-quote">
                        "Dulu roti dan susu sering basi di rak karena overstock. Dengan fitur Flash Sale Cuci Gudang jam 7 malam dan prediksi stok AI, modal saya yang selamat mencapai Rp 3,8 juta tiap bulan."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">SB</div>
                        <div>
                            <div class="author-name">Ibu Siti Badriah</div>
                            <div class="author-shop">Warung Sembako Berkah, Cimahi</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-quote">
                        "Fitur Trend Hunter memberi sinyal sirup aren dan matcha viral sebelum warung sekitar sadar. Saya belanja stok lebih dulu dan omzet minuman melonjak 40%."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar" style="background: rgba(204, 255, 0, 0.15); color: var(--laris-cyber-lime);">DA</div>
                        <div>
                            <div class="author-name">Dimas Anggara</div>
                            <div class="author-shop">Kedai Kopi Senja, Bandung</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-quote">
                        "Di pulau kami sinyal sering hilang berhari-hari saat cuaca buruk. Fitur LARIS Lite tetap mencatat kasir tanpa internet, lalu sinkron otomatis begitu sinyal muncul kembali."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar" style="background: rgba(14, 165, 233, 0.2); color: var(--laris-sky);">HW</div>
                        <div>
                            <div class="author-name">Hendra Wahyudi</div>
                            <div class="author-shop">Toko Kelontong Rote, NTT</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 11. FAQ ACCORDION -->
        <section id="faq" class="section-container" style="padding-top: 10px;">
            <div class="section-header">
                <span class="section-tag">Tanya Jawab</span>
                <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
                <p class="section-desc">
                    Segala hal yang perlu Anda ketahui mengenai implementasi platform LARIS:
                </p>
            </div>

            <div class="faq-accordion-box">
                <div class="faq-item active" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>Apakah warung kelontong kecil bisa menggunakan LARIS?</span>
                        <svg class="faq-icon-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                    </div>
                    <div class="faq-answer">
                        Tentu saja! LARIS dirancang khusus untuk warung kelontong tradisional, kedai kopi, butik pakaian, kriya, dan UMKM mikro. Antarmukanya menggunakan bahasa sehari-hari tanpa istilah teknis yang membingungkan.
                    </div>
                </div>

                <div class="faq-item" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>Bagaimana cara kerja fitur offline LARIS Lite di daerah 3T?</span>
                        <svg class="faq-icon-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                    </div>
                    <div class="faq-answer">
                        LARIS Lite menggunakan basis data lokal di peramban (browser) HP atau komputer Anda. Saat tidak ada sinyal internet, kasir tetap bisa mencatat transaksi dan struk. Begitu perangkat mendeteksi sinyal internet, data langsung disinkronkan otomatis ke cloud tanpa risiko bentrok.
                    </div>
                </div>

                <div class="faq-item" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>Apakah saya harus membeli perangkat keras (hardware) kasir khusus?</span>
                        <svg class="faq-icon-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                    </div>
                    <div class="faq-answer">
                        Tidak perlu. LARIS berbasis web (Web-App) yang dapat dibuka melalui smartphone Android/iOS, laptop bekas, tablet, atau komputer kasir apa pun yang memiliki peramban web modern.
                    </div>
                </div>

                <div class="faq-item" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>Bagaimana sistem rekomendasi Explainable AI (XAI) bekerja?</span>
                        <svg class="faq-icon-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                    </div>
                    <div class="faq-answer">
                        AI kami bukan black-box misterius. Setiap saran restock atau prediksi produk viral menyertakan tingkat kepercayaan (Confidence Score, misal: 88%) dan alasan logis di baliknya (misal: "Kecepatan penjualan naik 40% dan tren pencarian di TikTok Shop meningkat +142%").
                    </div>
                </div>

                <div class="faq-item" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>Bagaimana kebijakan pengantaran barang di marketplace sisi konsumen?</span>
                        <svg class="faq-icon-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                    </div>
                    <div class="faq-answer">
                        Pengantaran fleksibel ditentukan oleh masing-masing pemilik gerai. Jika gerai menyediakan opsi delivery, konsumen dapat memilih "Diantar ke Alamat" atau "Ambil Sendiri". Namun jika gerai tidak menyediakan kurir toko, sistem secara otomatis mengharuskan konsumen untuk "Ambil di Tempat (Self-Pickup)".
                    </div>
                </div>
            </div>
        </section>

        <!-- 12. FINAL CALL-TO-ACTION SECTION -->
        <section class="cta-bottom-section">
            <div class="cta-bottom-box">
                <span class="section-tag">Siap Melangkah Maju</span>
                <h2 class="section-title">Wujudkan UMKM Cerdas, Tangguh, dan Mandiri</h2>
                <p class="section-desc" style="max-width: 600px; margin: 0 auto 36px auto;">
                    Gabung bersama ribuan pelaku usaha yang telah membuktikan efisiensi kecerdasan korporat dalam genggaman warung.
                </p>
                <div style="display: flex; justify-content: center; gap: 14px; flex-wrap: wrap;">
                    <a href="{{ route('login') }}" class="hero-cta-main">
                        <span>Coba Demo 5 Role Sekarang</span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                    <a href="{{ url('/marketplace') }}" target="_blank" class="hero-cta-alt">
                        <span>Kunjungi Marketplace Publik ↗</span>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- 13. SITE FOOTER WITH AI ECOSYSTEM ILLUSTRATION -->
    <footer class="site-footer" style="background: linear-gradient(180deg, #080D11 0%, #060A0D 100%); border-top: 1px solid rgba(16, 185, 129, 0.2); position: relative; overflow: hidden; padding-top: 60px;">
        
        <!-- HIGH-TECH ECOSYSTEM VECTOR ILLUSTRATION CARD -->
        <div style="max-width: 1280px; margin: 0 auto 50px auto; padding: 0 24px;">
            <div style="background: radial-gradient(100% 120% at 50% 0%, rgba(16, 185, 129, 0.08) 0%, rgba(14, 22, 28, 0.75) 100%); border: 1px solid rgba(52, 211, 153, 0.2); border-radius: 24px; padding: 32px 36px; position: relative; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
                
                <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 32px; align-items: center;">
                    <div>
                        <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(204, 255, 0, 0.1); border: 1px solid rgba(204, 255, 0, 0.3); padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; color: var(--laris-cyber-lime); letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 12px;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="9" stroke-width="2"/><path d="M12 6v6l4 2" stroke-width="2"/></svg>
                            <span>Arsitektur AI Terdistribusi Nasional</span>
                        </div>
                        <h3 style="font-size: clamp(20px, 3vw, 28px); font-weight: 800; color: #FFFFFF; line-height: 1.3; margin-bottom: 12px;">
                            Ekosistem 5 Sisi yang Terhubung Secara Presisi
                        </h3>
                        <p style="font-size: 13.5px; color: var(--text-muted); line-height: 1.7; margin-bottom: 20px;">
                            Dari terminal Kasir offline di pelosok desa, kalkulasi Runway Stok Gudang, sensor tren BPS, hingga etalase Marketplace Konsumen — seluruh sinyal data diolah langsung oleh LARIS Neural Engine.
                        </p>
                        
                        <!-- Telemetry Stat Chips -->
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 8px 14px; border-radius: 10px;">
                                <div style="font-size: 10px; color: var(--text-dim); font-weight: 700; text-transform: uppercase;">Standar Sinyal</div>
                                <div style="font-size: 13px; font-weight: 800; color: var(--laris-mint); margin-top: 2px;">5 Multi-Channel</div>
                            </div>
                            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 8px 14px; border-radius: 10px;">
                                <div style="font-size: 10px; color: var(--text-dim); font-weight: 700; text-transform: uppercase;">Ketahanan 3T</div>
                                <div style="font-size: 13px; font-weight: 800; color: var(--laris-cyber-lime); margin-top: 2px;">100% Offline-First</div>
                            </div>
                            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 8px 14px; border-radius: 10px;">
                                <div style="font-size: 10px; color: var(--text-dim); font-weight: 700; text-transform: uppercase;">Mata Uang</div>
                                <div style="font-size: 13px; font-weight: 800; color: #FFFFFF; margin-top: 2px;">Rupiah (IDR)</div>
                            </div>
                            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 8px 14px; border-radius: 10px;">
                                <div style="font-size: 10px; color: var(--text-dim); font-weight: 700; text-transform: uppercase;">Reliabilitas</div>
                                <div style="font-size: 13px; font-weight: 800; color: #10B981; margin-top: 2px;">99.98% SLA Live</div>
                            </div>
                        </div>
                    </div>

                    <!-- VECTOR ILLUSTRATION SVG: LARIS DATA FLOW -->
                    <div style="display: flex; justify-content: center; align-items: center; position: relative;">
                        <svg width="100%" height="220" viewBox="0 0 460 220" fill="none" xmlns="http://www.w3.org/2000/svg" style="max-width: 440px;">
                            <defs>
                                <linearGradient id="hubGrad" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0%" stop-color="#10B981"/>
                                    <stop offset="100%" stop-color="#CCFF00"/>
                                </linearGradient>
                                <linearGradient id="wireGrad1" x1="0" y1="0" x2="1" y2="0">
                                    <stop offset="0%" stop-color="#10B981" stop-opacity="0.2"/>
                                    <stop offset="100%" stop-color="#10B981" stop-opacity="0.8"/>
                                </linearGradient>
                            </defs>

                            <!-- Connecting Network Wires -->
                            <path d="M80 50 C 150 50, 160 110, 230 110" stroke="url(#wireGrad1)" stroke-width="2" stroke-dasharray="4 3"/>
                            <path d="M80 170 C 150 170, 160 110, 230 110" stroke="url(#wireGrad1)" stroke-width="2" stroke-dasharray="4 3"/>
                            <path d="M380 50 C 310 50, 300 110, 230 110" stroke="url(#wireGrad1)" stroke-width="2" stroke-dasharray="4 3"/>
                            <path d="M380 170 C 310 170, 300 110, 230 110" stroke="url(#wireGrad1)" stroke-width="2" stroke-dasharray="4 3"/>

                            <!-- Center Hub: LARIS AI Core Engine -->
                            <circle cx="230" cy="110" r="42" fill="#0A181D" stroke="url(#hubGrad)" stroke-width="2.5"/>
                            <circle cx="230" cy="110" r="54" fill="none" stroke="#10B981" stroke-opacity="0.25" stroke-width="1.5" stroke-dasharray="6 4"/>
                            <circle cx="230" cy="110" r="66" fill="none" stroke="#CCFF00" stroke-opacity="0.12" stroke-width="1"/>
                            
                            <!-- Hub Icon / Spark -->
                            <path d="M230 92 L234 104 L246 108 L234 112 L230 124 L226 112 L214 108 L226 104 Z" fill="url(#hubGrad)"/>
                            <text x="230" y="142" font-size="9" font-weight="800" fill="#CCFF00" text-anchor="middle" letter-spacing="1">LARIS AI CORE</text>

                            <!-- Node 1: Smart POS (Top Left) -->
                            <rect x="20" y="24" width="110" height="48" rx="12" fill="#0E1A22" stroke="rgba(255,255,255,0.12)" stroke-width="1.5"/>
                            <circle cx="42" cy="48" r="10" fill="rgba(16,185,129,0.15)"/>
                            <path d="M38 48h8M42 44v8" stroke="#34D399" stroke-width="1.5" stroke-linecap="round"/>
                            <text x="60" y="44" font-size="10" font-weight="700" fill="#FFFFFF">Smart POS</text>
                            <text x="60" y="58" font-size="8.5" fill="#94A3B8">Kasir &amp; QRIS</text>

                            <!-- Node 2: Smart Inventory (Bottom Left) -->
                            <rect x="20" y="146" width="110" height="48" rx="12" fill="#0E1A22" stroke="rgba(255,255,255,0.12)" stroke-width="1.5"/>
                            <circle cx="42" cy="170" r="10" fill="rgba(204,255,0,0.15)"/>
                            <path d="M38 167l4 4 6-6" stroke="#CCFF00" stroke-width="1.5" stroke-linecap="round"/>
                            <text x="60" y="166" font-size="10" font-weight="700" fill="#FFFFFF">Gudang &amp; Stok</text>
                            <text x="60" y="180" font-size="8.5" fill="#94A3B8">Runway &amp; Reorder</text>

                            <!-- Node 3: Juragan Copilot (Top Right) -->
                            <rect x="330" y="24" width="110" height="48" rx="12" fill="#0E1A22" stroke="rgba(255,255,255,0.12)" stroke-width="1.5"/>
                            <circle cx="352" cy="48" r="10" fill="rgba(14,165,233,0.15)"/>
                            <path d="M348 48a4 4 0 1 0 8 0 4 4 0 0 0-8 0" stroke="#38BDF8" stroke-width="1.5"/>
                            <text x="370" y="44" font-size="10" font-weight="700" fill="#FFFFFF">Juragan AI</text>
                            <text x="370" y="58" font-size="8.5" fill="#94A3B8">Owner Telemetri</text>

                            <!-- Node 4: Marketplace Konsumen (Bottom Right) -->
                            <rect x="330" y="146" width="110" height="48" rx="12" fill="#0E1A22" stroke="rgba(255,255,255,0.12)" stroke-width="1.5"/>
                            <circle cx="352" cy="170" r="10" fill="rgba(244,63,94,0.15)"/>
                            <path d="M348 168h8l-1 5h-6z" stroke="#FB7185" stroke-width="1.5"/>
                            <text x="370" y="166" font-size="10" font-weight="700" fill="#FFFFFF">Marketplace</text>
                            <text x="370" y="180" font-size="8.5" fill="#94A3B8">Warga Sekitar</text>
                        </svg>
                    </div>
                </div>

                <!-- Verified Compliance & Standards Badges -->
                <div style="border-top: 1px solid rgba(255,255,255,0.08); margin-top: 24px; padding-top: 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
                    <span style="font-size: 11px; font-weight: 700; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.5px;">Standar Kepatuhan &amp; Integrasi Resmi:</span>
                    <div style="display: flex; gap: 14px; flex-wrap: wrap; align-items: center;">
                        <span style="display: inline-flex; align-items: center; gap: 6px; font-size: 11.5px; color: #CBD5E1; background: rgba(255,255,255,0.03); padding: 4px 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.06);">
                            <svg width="13" height="13" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span>Standar QRIS Bank Indonesia</span>
                        </span>
                        <span style="display: inline-flex; align-items: center; gap: 6px; font-size: 11.5px; color: #CBD5E1; background: rgba(255,255,255,0.03); padding: 4px 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.06);">
                            <svg width="13" height="13" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span>API Sinyal Pasar BPS &amp; E-Commerce</span>
                        </span>
                        <span style="display: inline-flex; align-items: center; gap: 6px; font-size: 11.5px; color: #CBD5E1; background: rgba(255,255,255,0.03); padding: 4px 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.06);">
                            <svg width="13" height="13" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span>Protokol Offline-First 3T Kemendag RI</span>
                        </span>
                    </div>
                </div>

            </div>
        </div>

        <div class="footer-inner">
            <div class="footer-brand">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="{{ asset('logo.png') }}" alt="LARIS Logo" style="height: 32px; width: auto;">
                    <span style="font-size: 11px; font-weight: 800; color: var(--laris-cyber-lime); background: rgba(204,255,0,0.1); padding: 3px 8px; border-radius: 12px;">v2.0.0</span>
                </div>
                <p>
                    Platform AI Business Intelligence &amp; Decision Support System untuk mendemokratisasi akses data intelligence bagi UMKM Indonesia.
                </p>
                <div style="margin-top: 14px; font-size: 12px; color: var(--laris-mint);">
                    Karya Meukarya Team • INFEST Hackathon 2026
                </div>
            </div>

            <div class="footer-col">
                <h5>Ekosistem 5 Role</h5>
                <ul>
                    <li><a href="{{ route('login') }}">1. Super Admin Platform</a></li>
                    <li><a href="{{ route('login') }}">2. Juragan UMKM (Owner)</a></li>
                    <li><a href="{{ route('login') }}">3. Kasir Toko (Smart POS)</a></li>
                    <li><a href="{{ route('login') }}">4. Staf Gudang (Smart Inventory)</a></li>
                    <li><a href="{{ url('/marketplace') }}">5. User (Marketplace Publik)</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Fitur Cerdas AI</h5>
                <ul>
                    <li><a href="#features">LARIS Predict ("What If")</a></li>
                    <li><a href="#features">Multi-Channel Trend Hunter</a></li>
                    <li><a href="#features">Juragan AI Copilot</a></li>
                    <li><a href="#lite">Mode Offline 3T (LARIS Lite)</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Kemitraan &amp; Bantuan</h5>
                <ul>
                    <li><a href="#faq">Pusat Bantuan &amp; FAQ</a></li>
                    <li><a href="{{ route('help.index') }}">Panduan Operasional</a></li>
                    <li><a href="mailto:kontak@laris.id">kontak@laris.id</a></li>
                    <li><a href="tel:+6281234567890">+62 812-3456-7890</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div>
                &copy; {{ date('Y') }} LARIS BI Platform — Meukarya Team. All rights reserved. Tema: <em>AI for All: Intelligent Solutions for an Equitable Future</em>.
            </div>
            <div style="display: flex; gap: 16px; align-items: center;">
                <span style="display: inline-flex; align-items: center; gap: 6px; color: var(--laris-mint); font-weight: 700;">
                    <span style="width: 7px; height: 7px; border-radius: 50%; background: #10B981; display: inline-block; box-shadow: 0 0 8px #10B981;"></span>
                    <span>Server Status: Normal (100% Uptime)</span>
                </span>
            </div>
        </div>
    </footer>

    <!-- INTERACTIVE MODAL DIALOG (DETAIL FITUR TEKNIS) -->
    <div class="feature-modal-backdrop" id="feature-modal" onclick="closeFeatureModal(event)">
        <div class="feature-modal-box" onclick="event.stopPropagation()">
            <button type="button" class="modal-close-btn" onclick="closeFeatureModal()" aria-label="Tutup Dialog">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div id="modal-content">
                <!-- Dynamically populated via JS -->
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC & SIMULATORS -->
    <script>
        /* 1. Header Scroll Glassmorphism */
        window.addEventListener('scroll', function() {
            const header = document.getElementById('site-header');
            if (window.scrollY > 40) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        /* 2. Mobile Menu Toggle */
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-dropdown-menu');
            menu.classList.toggle('active');
        }

        /* 3. Interactive Role Tabs Switcher */
        function switchRoleTab(roleKey, btnElement) {
            // Remove active from all tabs
            document.querySelectorAll('.role-tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.role-showcase-card').forEach(card => card.classList.remove('active'));

            // Set active tab
            btnElement.classList.add('active');
            const targetPanel = document.getElementById('role-panel-' + roleKey);
            if (targetPanel) {
                targetPanel.classList.add('active');
            }
        }

        /* 4. Interactive LARIS Lite Offline Simulator */
        let simMode = 'online';
        let pendingTransactions = [];

        function setSimMode(mode) {
            simMode = mode;
            const btnOnline = document.getElementById('sim-btn-online');
            const btnOffline = document.getElementById('sim-btn-offline');
            const statusText = document.getElementById('sim-status-text');
            const syncBtn = document.getElementById('btn-sync-cloud');
            const syncLabel = document.getElementById('sync-btn-label');

            if (mode === 'online') {
                btnOnline.className = 'sim-toggle-btn active online';
                btnOffline.className = 'sim-toggle-btn';
                statusText.innerHTML = '● Terhubung ke Cloud Server (Online)';
                statusText.style.color = 'var(--laris-mint)';

                if (pendingTransactions.length > 0) {
                    syncBtn.disabled = false;
                    syncBtn.style.background = 'var(--laris-cyber-lime)';
                    syncBtn.style.color = '#080D11';
                    syncBtn.style.cursor = 'pointer';
                    syncLabel.textContent = `Sinkronkan ${pendingTransactions.length} Transaksi Sekarang!`;
                }
            } else {
                btnOnline.className = 'sim-toggle-btn';
                btnOffline.className = 'sim-toggle-btn active offline';
                statusText.innerHTML = '● Mode Offline 3T (Tanpa Internet / Sinyal Padam)';
                statusText.style.color = '#EF4444';

                syncBtn.disabled = true;
                syncBtn.style.background = 'rgba(255, 255, 255, 0.08)';
                syncBtn.style.color = 'var(--text-dim)';
                syncBtn.style.cursor = 'not-allowed';
                syncLabel.textContent = 'Sinkronkan ke Cloud (Menunggu Sinyal Internet)';
            }
        }

        function simulateOfflineTransaction() {
            const items = ['Kopi Susu Aren 250ml', 'Beras Ramos 5kg', 'Minyak Goreng 2L', 'Gula Pasir 1kg', 'Sabun Cuci Piring'];
            const randomItem = items[Math.floor(Math.random() * items.length)];
            const randomPrice = 'Rp ' + (Math.floor(Math.random() * 40) + 10) + '.000';
            const timestamp = new Date().toLocaleTimeString('id-ID');

            pendingTransactions.push({
                item: randomItem,
                price: randomPrice,
                time: timestamp,
                id: 'TRX-OFFLINE-' + Math.floor(Math.random() * 8999 + 1000)
            });

            renderSimQueue();
        }

        function renderSimQueue() {
            const container = document.getElementById('sim-queue-container');
            const counter = document.getElementById('sim-queue-counter');
            const syncBtn = document.getElementById('btn-sync-cloud');
            const syncLabel = document.getElementById('sync-btn-label');

            counter.textContent = `${pendingTransactions.length} Transaksi Tersimpan Lokal`;

            if (pendingTransactions.length === 0) {
                container.innerHTML = '<div class="sim-queue-item" style="color: var(--text-dim); justify-content: center;">Semua data tersinkronisasi ke Cloud. Antrean lokal kosong.</div>';
                syncBtn.disabled = true;
                syncBtn.style.background = 'rgba(255, 255, 255, 0.08)';
                syncBtn.style.color = 'var(--text-dim)';
                syncBtn.style.cursor = 'not-allowed';
                syncLabel.textContent = 'Data Sudah Tersinkron';
                return;
            }

            container.innerHTML = '';
            pendingTransactions.forEach(trx => {
                const row = document.createElement('div');
                row.className = 'sim-queue-item';
                row.innerHTML = `
                    <div>
                        <strong style="color: #FFFFFF;">${trx.item}</strong>
                        <div style="font-size: 10.5px; color: var(--text-dim);">${trx.id} • ${trx.time} (Local Cache)</div>
                    </div>
                    <span style="color: var(--laris-cyber-lime); font-weight: 800;">${trx.price}</span>
                `;
                container.appendChild(row);
            });

            if (simMode === 'online') {
                syncBtn.disabled = false;
                syncBtn.style.background = 'var(--laris-cyber-lime)';
                syncBtn.style.color = '#080D11';
                syncBtn.style.cursor = 'pointer';
                syncLabel.textContent = `Sinkronkan ${pendingTransactions.length} Transaksi Sekarang!`;
            }
        }

        function syncSimData() {
            if (simMode !== 'online' || pendingTransactions.length === 0) return;

            const syncLabel = document.getElementById('sync-btn-label');
            syncLabel.textContent = 'Mengunggah data dua arah ke Cloud...';

            setTimeout(() => {
                larisAlert('Sinkronisasi Cloud Berhasil', `<strong>Hebat!</strong> Sebanyak <strong>${pendingTransactions.length} transaksi offline</strong> berhasil disinkronkan ke Cloud Server tanpa konflik atau duplikasi data.`, 'success');
                pendingTransactions = [];
                renderSimQueue();
            }, 800);
        }

        /* 5. Interactive ROI Calculator */
        function updateRoiCalc() {
            const capital = parseInt(document.getElementById('slider-capital').value, 10);
            const deadstockPct = parseInt(document.getElementById('slider-deadstock').value, 10);

            document.getElementById('val-capital').textContent = 'Rp ' + capital.toLocaleString('id-ID');
            document.getElementById('val-deadstock').textContent = deadstockPct + '%';

            // Calculations:
            // Saved deadstock = capital * (deadstockPct / 100) * 0.7 (70% prevented with AI)
            const monthlySavings = Math.round(capital * (deadstockPct / 100) * 0.7);
            const annualGain = monthlySavings * 12;

            document.getElementById('res-monthly-save').textContent = 'Rp ' + monthlySavings.toLocaleString('id-ID');
            document.getElementById('res-annual-gain').textContent = 'Rp ' + annualGain.toLocaleString('id-ID');
        }

        /* 6. FAQ Accordion Toggle */
        function toggleFaq(element) {
            const isActive = element.classList.contains('active');
            document.querySelectorAll('.faq-item').forEach(item => item.classList.remove('active'));
            if (!isActive) {
                element.classList.add('active');
            }
        }

        /* 7. Interactive Feature Details Modal */
        const featureDetailsData = {
            predict: {
                title: 'LARIS Predict ("What If I Sell This?")',
                subtitle: 'Prediksi Kelayakan Finansial & Risiko Dead-Stock Sebelum Belanja Stok',
                content: `
                    <p style="margin-bottom: 14px; font-size: 14px; color: var(--text-body); line-height: 1.7;">
                        Fitur ini menjawab kegelisahan terbesar pemilik UMKM: <em>"Kalau saya belanja stok barang baru ini, kira-kira bakal laku atau malah mengendap jadi uang mati?"</em>
                    </p>
                    <div style="background: rgba(255,255,255,0.04); border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                        <h4 style="color: var(--laris-cyber-lime); font-size: 13.5px; margin-bottom: 8px;">Arsitektur Perhitungan Cerdas:</h4>
                        <ul style="padding-left: 18px; font-size: 13px; color: var(--text-muted); line-height: 1.6;">
                            <li><strong>Margin Safety Checker:</strong> Menghitung keuntungan bersih terhadap biaya operasional harian.</li>
                            <li><strong>Break-Even Estimator:</strong> Memprediksi berapa unit yang harus terjual agar modal kembali.</li>
                            <li><strong>1-Click Add to Inventory:</strong> Hasil analisis prediksi yang disetujui langsung masuk draf inventori toko.</li>
                        </ul>
                    </div>
                `
            },
            trends: {
                title: 'Multi-Channel Trend Hunter',
                subtitle: 'Sensor Permintaan Pasar Real-Time Lintas Platform Digital',
                content: `
                    <p style="margin-bottom: 14px; font-size: 14px; color: var(--text-body); line-height: 1.7;">
                        Menggabungkan data pencarian dari <strong>Google Trends, Google Analytics, TikTok Shop, Tokopedia, dan Shopee</strong> dalam satu dasbor terpadu.
                    </p>
                    <div style="background: rgba(255,255,255,0.04); border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                        <h4 style="color: var(--laris-mint); font-size: 13.5px; margin-bottom: 8px;">Pilihan Prediksi Berdasarkan Wilayah:</h4>
                        <p style="font-size: 13px; color: var(--text-muted); line-height: 1.6;">
                            Juragan dapat memfilter sinyal permintaan khusus wilayah: <strong>Bandung &amp; Jawa Barat, Jabodetabek, Surabaya &amp; Jawa Timur, dan Semarang &amp; Jawa Tengah</strong> agar pasokan toko pas dengan selera warga sekitarnya.
                        </p>
                    </div>
                `
            },
            copilot: {
                title: 'Juragan AI Copilot',
                subtitle: 'Konsultan Bisnis Ritel Pribadi Berbasis LLM & Retrieval-Augmented Generation',
                content: `
                    <p style="margin-bottom: 14px; font-size: 14px; color: var(--text-body); line-height: 1.7;">
                        Asisten percakapan cerdas yang dapat Anda ajak bicara layaknya rekan bisnis berpengalaman. Anda bisa bertanya:
                    </p>
                    <div style="background: rgba(16, 185, 129, 0.1); border-left: 3px solid var(--laris-mint); padding: 12px 16px; margin-bottom: 16px; font-size: 13px; color: #E2E8F0;">
                        <em>"Barang apa yang stoknya paling kritis hari ini?", "Berapa proyeksi laba kotor toko bulan ini?", atau "Produk apa yang cocok dibuat paket bundling?"</em>
                    </div>
                `
            },
            flash: {
                title: 'Flash Sale Cuci Gudang Jam 7 Malam',
                subtitle: 'Dynamic Markdown Otomatis untuk Mencegah Kerugian Kadaluarsa',
                content: `
                    <p style="margin-bottom: 14px; font-size: 14px; color: var(--text-body); line-height: 1.7;">
                        Produk roti, susu, atau makanan basah yang mendekati masa habis secara otomatis didaftarkan ke flash sale sore hari. Konsumen sekitar mendapatkan diskon menarik, sementara pemilik toko berhasil memulihkan modal tunai.
                    </p>
                `
            },
            pool: {
                title: 'Pengadaan Grosir Bersama (Collective Procurement Pooling)',
                subtitle: 'Gotong Royong Pembelian Skala Besar untuk Harga Grosir Pabrik',
                content: `
                    <p style="margin-bottom: 14px; font-size: 14px; color: var(--text-body); line-height: 1.7;">
                        Gerai kecil biasanya membeli sedikit sehingga terkena harga eceran mahal. Dengan Pengadaan Grosir Bersama, puluhan gerai di satu kecamatan digabungkan kuotanya agar mendapatkan diskon langsung tingkat distributor utama.
                    </p>
                `
            },
            xai: {
                title: 'Explainable AI (XAI Engine)',
                subtitle: 'Keputusan Transparan: Menyertakan Alasan (Why Factor) & Tingkat Keyakinan',
                content: `
                    <p style="margin-bottom: 14px; font-size: 14px; color: var(--text-body); line-height: 1.7;">
                        Pemilik toko tidak perlu menebak-nebak mengapa AI memberi saran tertentu. Sistem menampilkan rincian data pendukung: kecepatan penjualan harian, tren pencarian, sisa runway stok, dan estimasi waktu restock supplier.
                    </p>
                `
            }
        };

        function openFeatureModal(key) {
            const data = featureDetailsData[key];
            if (!data) return;

            const modalContent = document.getElementById('modal-content');
            modalContent.innerHTML = `
                <div style="font-size: 11px; font-weight: 800; color: var(--laris-cyber-lime); text-transform: uppercase; margin-bottom: 6px;">Spesifikasi Teknologi</div>
                <h3 style="font-size: 22px; font-weight: 800; color: #FFFFFF; margin-bottom: 4px;">${data.title}</h3>
                <div style="font-size: 13px; color: var(--laris-mint); margin-bottom: 18px; font-weight: 600;">${data.subtitle}</div>
                ${data.content}
                <div style="margin-top: 24px; text-align: right;">
                    <button type="button" class="btn-nav-primary" onclick="closeFeatureModal()">Tutup Dialog</button>
                </div>
            `;

            document.getElementById('feature-modal').classList.add('active');
        }

        function closeFeatureModal() {
            document.getElementById('feature-modal').classList.remove('active');
        }
    </script>

    @include('partials.laris_alert')
</body>
</html>
