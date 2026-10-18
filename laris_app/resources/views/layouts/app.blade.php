<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'LARIS - AI Business Intelligence & Decision Platform' }}</title>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    <!-- Professional Product Typography: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Google Analytics 4 (GA4) Ecosystem Integration -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LARISBI2026"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-LARISBI2026', {
        'app_name': 'LARIS BI Platform',
        'send_page_view': true
      });
    </script>
    
    <style>
        :root {
            --bg-sidebar: #0B131B;
            --bg-sidebar-hover: #162330;
            --sidebar-border: #1E2D3D;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 72px;

            /* Soft Pastel Minimalist UI Palette */
            --bg-canvas: #F8FAFC;
            --surface-card: #FFFFFF;
            --surface-subtle: #F1F5F9;
            --border-light: #E2E8F0;
            --border-subtle: #EDF2F7;
            
            --text-main: #0F172A;
            --text-body: #334155;
            --text-muted: #64748B;
            --text-subtle: #94A3B8;

            /* Soft Pastel Accents (No Harsh Glare) */
            --pastel-mint: #10B981;
            --pastel-mint-subtle: rgba(16, 185, 129, 0.12);
            --pastel-blue: #0284C7;
            --pastel-blue-subtle: rgba(2, 132, 199, 0.12);
            --pastel-amber: #D97706;
            --pastel-amber-subtle: rgba(217, 119, 6, 0.12);
            --pastel-rose: #E11D48;
            --pastel-rose-subtle: rgba(225, 29, 72, 0.12);
            --pastel-indigo: #6366F1;
            --pastel-indigo-subtle: rgba(99, 102, 241, 0.12);

            --accent-brand: #10B981;
            --accent-lime: #CCFF00;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-canvas);
            color: var(--text-body);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            letter-spacing: -0.01em;
            line-height: 1.5;
        }

        /* FLEXIBLE, SCROLLABLE & COLLAPSIBLE SIDEBAR */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--bg-sidebar);
            color: #FFFFFF;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            border-right: 1px solid var(--sidebar-border);
            padding: 18px 14px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            overflow-y: auto;
            overflow-x: hidden;
            transition: width 0.22s cubic-bezier(0.16, 1, 0.3, 1), transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            scrollbar-width: thin;
            scrollbar-color: rgba(148, 163, 184, 0.25) transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.25);
            border-radius: 99px;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 6px 6px 18px 6px;
            border-bottom: 1px solid var(--sidebar-border);
            margin-bottom: 20px;
            min-height: 58px;
        }

        .brand-logo-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            overflow: hidden;
        }

        .brand-full-logo {
            height: 34px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
            display: block;
            filter: drop-shadow(0 0 10px rgba(16, 185, 129, 0.35));
            transition: all 0.2s ease;
        }

        .brand-mini-icon {
            display: none;
            width: 34px;
            height: 34px;
            object-fit: contain;
            margin: 0 auto;
        }

        .btn-sidebar-collapse {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid var(--sidebar-border);
            color: #94A3B8;
            border-radius: 8px;
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.18s ease;
            flex-shrink: 0;
        }

        .btn-sidebar-collapse:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #FFFFFF;
            border-color: #475569;
        }

        .menu-heading {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.1px;
            color: #64748B;
            padding: 0 10px;
            margin-bottom: 10px;
            margin-top: 6px;
            white-space: nowrap;
        }

        .nav-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 24px;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            color: #94A3B8;
            transition: all 0.16s ease;
            white-space: nowrap;
        }

        .nav-item a:hover {
            color: #FFFFFF;
            background: var(--bg-sidebar-hover);
        }

        .nav-item.active a {
            background: rgba(16, 185, 129, 0.14);
            color: #34D399;
            font-weight: 700;
            box-shadow: inset 0 0 0 1px rgba(16, 185, 129, 0.3);
        }

        .nav-item svg {
            width: 18px;
            height: 18px;
            stroke-width: 2;
            flex-shrink: 0;
        }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid var(--sidebar-border);
            padding-top: 16px;
        }

        /* COLLAPSED SIDEBAR STATE (MINIMIZED) */
        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-collapsed-width);
            padding: 18px 8px;
        }
        body.sidebar-collapsed .main-wrapper {
            margin-left: var(--sidebar-collapsed-width);
        }
        body.sidebar-collapsed .brand-full-logo {
            display: none !important;
        }
        body.sidebar-collapsed .brand-mini-icon {
            display: block !important;
        }
        body.sidebar-collapsed .sidebar-brand {
            justify-content: center;
            padding-bottom: 14px;
        }
        body.sidebar-collapsed .btn-sidebar-collapse {
            display: none;
        }
        body.sidebar-collapsed .menu-heading {
            display: none !important;
        }
        body.sidebar-collapsed .nav-item a {
            justify-content: center;
            padding: 10px 0;
            gap: 0;
            border-radius: 10px;
        }
        body.sidebar-collapsed .nav-item a span {
            display: none !important;
        }
        body.sidebar-collapsed .sidebar-footer-info {
            display: none !important;
        }
        body.sidebar-collapsed .sidebar-footer-expand-btn {
            display: flex !important;
        }

        /* Expander button at bottom when collapsed */
        .sidebar-footer-expand-btn {
            display: none;
            width: 100%;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid var(--sidebar-border);
            color: #94A3B8;
            border-radius: 8px;
            padding: 8px 0;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: all 0.18s;
        }
        .sidebar-footer-expand-btn:hover {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.16);
        }

        /* MAIN WRAPPER & TOP BAR */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            transition: margin-left 0.22s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .top-bar {
            height: 64px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .search-container {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #F1F5F9;
            border: 1px solid transparent;
            padding: 8px 16px;
            border-radius: 20px;
            width: 360px;
            transition: all 0.2s;
        }

        .search-container:focus-within {
            background: #FFFFFF;
            border-color: #CBD5E1;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
        }

        .search-container input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 13px;
            width: 100%;
            color: var(--text-main);
        }

        .top-right-group {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .store-status-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #F1F5F9;
            border: 1px solid #E2E8F0;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            color: #334155;
            white-space: nowrap;
        }

        .status-dot-green {
            width: 8px;
            height: 8px;
            background-color: #10B981;
            border-radius: 50%;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.25);
        }

        .notification-btn {
            position: relative;
            background: transparent;
            border: 1px solid transparent;
            cursor: pointer;
            color: #64748B;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 7px;
            border-radius: 50%;
            transition: all 0.18s;
        }

        .notification-btn:hover {
            background: #F1F5F9;
            color: #0F172A;
            border-color: #E2E8F0;
        }

        .notification-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 7px;
            height: 7px;
            background-color: #EF4444;
            border-radius: 50%;
        }

        .user-profile-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 20px;
            border: 1px solid transparent;
            transition: all 0.2s;
        }

        .user-profile-badge:hover {
            background: #F1F5F9;
            border-color: #E2E8F0;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #E2E8F0;
        }

        .user-info {
            line-height: 1.25;
            text-align: left;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-main);
        }

        .user-role {
            font-size: 11px;
            font-weight: 600;
        }

        /* TOP BAR DROPDOWNS */
        .top-dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.08), 0 4px 10px rgba(15, 23, 42, 0.04);
            z-index: 100;
            display: none;
            overflow: hidden;
            animation: dropdownFadeIn 0.16s ease-out;
        }

        @keyframes dropdownFadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .notif-dropdown {
            width: 340px;
        }

        .notif-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            background: #F8FAFC;
            border-bottom: 1px solid #E2E8F0;
            font-size: 13px;
            font-weight: 700;
            color: #0F172A;
        }

        .notif-badge-count {
            background: #FEE2E2;
            color: #DC2626;
            font-size: 11px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 10px;
        }

        .notif-item {
            display: flex;
            gap: 10px;
            padding: 12px 16px;
            border-bottom: 1px solid #F1F5F9;
            text-decoration: none;
            color: inherit;
            transition: background 0.15s;
        }

        .notif-item:hover {
            background: #F8FAFC;
        }

        .notif-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-top: 5px;
            flex-shrink: 0;
        }

        .notif-dot.red { background: #DC2626; }
        .notif-dot.amber { background: #D97706; }
        .notif-dot.green { background: #10B981; }

        .notif-body {
            font-size: 12px;
        }

        .notif-title {
            font-weight: 700;
            color: #0F172A;
            margin-bottom: 2px;
        }

        .notif-desc {
            color: #64748B;
            line-height: 1.35;
        }

        .notif-footer {
            padding: 10px 16px;
            text-align: center;
            background: #F8FAFC;
            font-size: 12px;
            font-weight: 600;
        }

        .notif-footer a {
            color: #0284C7;
            text-decoration: none;
        }

        /* USER MENU */
        .user-dropdown {
            width: 250px;
            padding: 6px;
        }

        .user-dropdown-header {
            padding: 10px 12px;
            border-bottom: 1px solid #F1F5F9;
            margin-bottom: 4px;
        }

        .user-dropdown-header .u-name {
            font-size: 13px;
            font-weight: 700;
            color: #0F172A;
        }

        .user-dropdown-header .u-email {
            font-size: 11px;
            color: #64748B;
        }

        .user-dropdown .menu-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            font-size: 12px;
            font-weight: 600;
            color: #334155;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.15s;
        }

        .user-dropdown .menu-link:hover {
            background: #F1F5F9;
            color: #0F172A;
        }

        .user-dropdown .menu-link.logout {
            color: #DC2626;
        }

        .user-dropdown .menu-link.logout:hover {
            background: #FEE2E2;
        }

        /* CONTENT CONTAINER */
        .content-area {
            padding: 28px 32px 48px 32px;
        }

        /* SOFT UI BUTTONS & BADGES */
        .btn-soft-primary {
            background: #0284C7;
            color: #FFFFFF;
            font-weight: 700;
            font-size: 13px;
            padding: 9px 18px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.18s;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.2);
        }

        .btn-soft-primary:hover {
            background: #0369A1;
            transform: translateY(-1px);
        }

        .btn-soft-outline {
            background: #FFFFFF;
            color: #334155;
            border: 1px solid #CBD5E1;
            font-weight: 600;
            font-size: 13px;
            padding: 8px 14px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.16s;
            text-decoration: none;
        }

        .btn-soft-outline:hover {
            background: #F8FAFC;
            border-color: #94A3B8;
            color: #0F172A;
        }

        .card-panel {
            background: var(--surface-card);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
        }

        /* RESPONSIVE & MOBILE OFF-CANVAS STYLES */
        .btn-mobile-sidebar {
            display: none;
            background: #F1F5F9;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 7px 9px;
            cursor: pointer;
            color: #1E293B;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
            flex-shrink: 0;
        }
        .btn-mobile-sidebar:hover {
            background: #E2E8F0;
        }

        .btn-sidebar-close {
            display: none;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid var(--sidebar-border);
            color: #94A3B8;
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
        }
        .btn-sidebar-close:hover {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.18);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(11, 19, 27, 0.65);
            backdrop-filter: blur(4px);
            z-index: 998;
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        @media (max-width: 1024px) {
            .btn-mobile-sidebar {
                display: inline-flex;
            }
            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                width: 270px !important;
                transform: translateX(-100%);
                transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1);
                z-index: 1000;
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.6);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .sidebar-brand {
                justify-content: space-between;
                padding: 12px 10px 18px 10px;
            }
            .btn-sidebar-collapse {
                display: none !important;
            }
            .btn-sidebar-close {
                display: inline-flex;
            }
            .brand-full-logo {
                display: block !important;
            }
            .brand-mini-icon {
                display: none !important;
            }
            .menu-heading {
                display: block !important;
            }
            .nav-item a span {
                display: inline !important;
            }
            .main-wrapper {
                margin-left: 0 !important;
                width: 100%;
                min-width: 0;
            }
            .top-bar {
                padding: 0 20px;
            }
            .search-container {
                width: 260px;
            }
        }

        @media (max-width: 768px) {
            .top-bar {
                padding: 0 14px;
                height: 58px;
            }
            .search-container {
                max-width: 180px;
                padding: 6px 10px;
            }
            .search-container input {
                font-size: 12px;
            }
            .store-status-pill span:not(.status-dot-green) {
                display: none;
            }
            .store-status-pill {
                padding: 6px 10px;
            }
            .user-info {
                display: none;
            }
            .content-area {
                padding: 16px 14px 36px 14px;
            }
            .top-right-group {
                gap: 12px;
            }
        }

        @media (max-width: 520px) {
            .search-container {
                display: none;
            }
        }

        /* ==========================================================================
           GLOBAL GLOSSY PORCELAIN & GLASSMORPHISM DESIGN SYSTEM (SIMPLE & MEWAH)
           ========================================================================== */
        
        /* Spacing & Flex Utilities */
        .flex-align { display: flex; align-items: center; }
        .gap-4 { gap: 4px; }
        .gap-6 { gap: 6px; }
        .gap-8 { gap: 8px; }
        .gap-10 { gap: 10px; }
        .gap-12 { gap: 12px; }
        .gap-14 { gap: 14px; }
        .gap-16 { gap: 16px; }

        .mt-4 { margin-top: 4px; }
        .mt-6 { margin-top: 6px; }
        .mt-8 { margin-top: 8px; }
        .mt-10 { margin-top: 10px; }
        .mt-12 { margin-top: 12px; }
        .mt-14 { margin-top: 14px; }
        .mt-16 { margin-top: 16px; }
        .mt-20 { margin-top: 20px; }

        .mb-2 { margin-bottom: 2px; }
        .mb-4 { margin-bottom: 4px; }
        .mb-6 { margin-bottom: 6px; }
        .mb-8 { margin-bottom: 8px; }
        .mb-10 { margin-bottom: 10px; }
        .mb-12 { margin-bottom: 12px; }
        .mb-14 { margin-bottom: 14px; }
        .mb-16 { margin-bottom: 16px; }
        .mb-20 { margin-bottom: 20px; }
        .mb-24 { margin-bottom: 24px; }

        .text-green { color: #10B981 !important; }
        .text-amber { color: #D97706 !important; }
        .text-red { color: #DC2626 !important; }

        /* 1. Header Styles */
        .dash-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 6px;
        }

        .header-main-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .greeting-row {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .page-greeting {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .store-gradient-name {
            background: linear-gradient(135deg, #0F172A 0%, #10B981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .verified-store-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: linear-gradient(180deg, #F0FDF4 0%, #DCFCE7 100%);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #15803D;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 9999px;
            box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.8);
        }

        .live-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid #E2E8F0;
            color: #64748B;
            font-size: 11.5px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 9999px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .pulse-dot {
            width: 7px;
            height: 7px;
            background: #10B981;
            border-radius: 50%;
            box-shadow: 0 0 8px #10B981;
            display: inline-block;
        }

        .page-subtitle {
            font-size: 13.5px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .dash-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* 2. Glossy Buttons */
        .btn-timeframe-glossy {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            color: #1E293B;
            font-size: 12.5px;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 12px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04), inset 0 1px 1px rgba(255, 255, 255, 1);
            text-decoration: none;
        }

        .btn-timeframe-glossy:hover {
            border-color: #10B981;
            background: #F8FAFC;
            transform: translateY(-1px);
        }

        .btn-download-glossy {
            background: #0B131B;
            color: #FFFFFF;
            font-size: 12.5px;
            font-weight: 700;
            padding: 9px 18px;
            border-radius: 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(11, 19, 27, 0.25);
        }

        .btn-download-glossy:hover {
            background: #162432;
            color: #CCFF00;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(11, 19, 27, 0.35);
        }

        .btn-action-glossy {
            background: #0B131B;
            color: #FFFFFF;
            border: none;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 11.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-action-glossy:hover {
            background: #162432;
            color: #CCFF00;
        }

        .btn-spotlight-action {
            width: 100%;
            background: #0B131B;
            color: #CCFF00;
            padding: 10px 16px;
            border-radius: 12px;
            font-size: 12.5px;
            font-weight: 800;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(11, 19, 27, 0.2);
        }

        .btn-spotlight-action:hover {
            background: #162432;
            transform: translateY(-1px);
        }

        .btn-mini-sim {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
            padding: 8px 14px;
            border-radius: 9999px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04), inset 0 1px 1px rgba(255, 255, 255, 1);
        }

        .btn-mini-sim:hover {
            background: #F8FAFC;
            border-color: #CBD5E1;
            color: #0F172A;
            transform: translateY(-1px);
        }

        /* 3. Glossy Cards & Panels */
        .card-panel {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.92) 100%);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04), inset 0 1px 2px rgba(255, 255, 255, 1);
            backdrop-filter: blur(16px);
            transition: all 0.25s ease;
        }

        .card-panel:hover {
            box-shadow: 0 14px 30px -4px rgba(16, 185, 129, 0.10), inset 0 1px 2px rgba(255, 255, 255, 1);
            border-color: rgba(16, 185, 129, 0.25);
        }

        .card-glossy {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.92) 100%);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 22px 24px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04), inset 0 1px 2px rgba(255, 255, 255, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 145px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }

        .card-glossy:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px -4px rgba(16, 185, 129, 0.12), inset 0 1px 2px rgba(255, 255, 255, 1);
            border-color: rgba(16, 185, 129, 0.25);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .panel-title-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .panel-icon-circle {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: rgba(16, 185, 129, 0.12);
            color: #10B981;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .panel-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--text-main);
            margin: 0;
        }

        .panel-subtitle {
            font-size: 12.5px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .tag-pill-glossy {
            font-size: 10px;
            font-weight: 800;
            color: #059669;
            background: #DCFCE7;
            padding: 3px 10px;
            border-radius: 20px;
            border: 1px solid rgba(16, 185, 129, 0.25);
            box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.8);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* 4. Layout Columns & KPI Grid */
        .dash-columns {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 22px;
            align-items: flex-start;
        }

        .dash-columns.columns-equal,
        .predict-page .dash-columns {
            grid-template-columns: minmax(0, 1fr) minmax(0, 1.15fr);
            gap: 24px;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .kpi-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .kpi-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .kpi-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 9999px;
            box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.7);
        }

        .badge-mint {
            background: #DCFCE7;
            color: #15803D;
            border: 1px solid rgba(22, 163, 74, 0.2);
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 9999px;
            font-size: 11px;
        }

        .badge-blue {
            background: #E0F2FE;
            color: #0369A1;
            border: 1px solid rgba(2, 132, 199, 0.2);
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 9999px;
            font-size: 11px;
        }

        .badge-slate {
            background: #F1F5F9;
            color: #334155;
            border: 1px solid #E2E8F0;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 9999px;
            font-size: 11px;
        }

        .badge-lime {
            background: rgba(204, 255, 0, 0.2);
            color: #15803D;
            border: 1px solid rgba(204, 255, 0, 0.5);
            font-weight: 800;
            padding: 3px 10px;
            border-radius: 9999px;
            font-size: 11px;
        }

        .badge-danger-glossy {
            font-size: 10.5px;
            font-weight: 800;
            color: #B91C1C;
            background: #FEE2E2;
            padding: 3px 10px;
            border-radius: 9999px;
            border: 1px solid rgba(220, 38, 38, 0.2);
        }

        .badge-amber-glossy {
            font-size: 10.5px;
            font-weight: 800;
            color: #B45309;
            background: #FEF3C7;
            padding: 3px 10px;
            border-radius: 9999px;
            border: 1px solid rgba(217, 119, 6, 0.2);
        }

        .kpi-value-row {
            margin: 10px 0 6px 0;
        }

        .kpi-val {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .score-display {
            display: flex;
            align-items: baseline;
            gap: 4px;
        }

        .score-val {
            font-size: 30px;
            font-weight: 800;
            color: var(--text-main);
        }

        .score-max {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .kpi-status-foot {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .dot-green {
            width: 6px;
            height: 6px;
            background: #10B981;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-amber {
            width: 6px;
            height: 6px;
            background: #F59E0B;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-lime {
            width: 6px;
            height: 6px;
            background: #84CC16;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-red {
            width: 6px;
            height: 6px;
            background: #DC2626;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-gray {
            width: 6px;
            height: 6px;
            background: #94A3B8;
            border-radius: 50%;
            display: inline-block;
        }

        .kpi-progress-bar {
            height: 6px;
            background: #F1F5F9;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 4px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #10B981, #0284C7);
            border-radius: 10px;
        }

        /* 5. Instant Insight Banner */
        .instant-insight-banner {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(204, 255, 0, 0.05) 50%, rgba(255, 255, 255, 0.95) 100%);
            border: 1px solid rgba(16, 185, 129, 0.25);
            border-radius: 20px;
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.08), inset 0 1px 2px rgba(255, 255, 255, 1);
            backdrop-filter: blur(12px);
        }

        .insight-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .ai-gem-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: #CCFF00;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.6);
        }

        .insight-tag {
            font-size: 11px;
            font-weight: 800;
            color: #059669;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .insight-text p {
            font-size: 13.5px;
            color: #1E293B;
            line-height: 1.5;
            margin: 0;
        }

        .btn-insight-action {
            background: #0B131B;
            color: #CCFF00;
            padding: 10px 20px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
            border: none;
            cursor: pointer;
        }

        .btn-insight-action:hover {
            background: #162432;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
        }

        .insight-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #F0FDF4;
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #15803D;
            font-size: 11.5px;
            font-weight: 800;
            padding: 6px 14px;
            border-radius: 9999px;
            white-space: nowrap;
        }

        /* 6. Flash Alert */
        .glass-success-alert {
            background: linear-gradient(135deg, rgba(220, 252, 231, 0.95) 0%, rgba(187, 247, 208, 0.9) 100%);
            border: 1px solid rgba(134, 239, 172, 0.8);
            border-radius: 16px;
            padding: 14px 20px;
            color: #166534;
            font-size: 13.5px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.12), inset 0 1px 2px rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .alert-close-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #166534;
            line-height: 1;
        }

        /* 7. Operational Alert Items */
        .op-alert-card-glossy {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            padding: 14px 16px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
            transition: all 0.2s;
        }

        .op-alert-card-glossy:hover {
            border-color: #CBD5E1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .alert-card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .alert-card-top h4 {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .alert-icon-circle {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #FEE2E2;
            color: #DC2626;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* 8. Charts & SVGs */
        .chart-canvas-container {
            width: 100%;
            margin-top: 10px;
        }

        .main-trend-svg {
            width: 100%;
            height: 120px;
        }

        .chart-legend {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 11.5px;
            color: var(--text-muted);
        }

        .leg-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .line-black {
            width: 14px;
            height: 3px;
            background: #0F172A;
            border-radius: 2px;
            display: inline-block;
        }

        .line-green-dash {
            width: 14px;
            height: 3px;
            background: #10B981;
            border-radius: 2px;
            display: inline-block;
        }

        .chart-x-labels {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 6px;
            padding: 0 10px;
        }

        .chart-x-labels .active-today {
            color: #10B981;
            font-weight: 800;
        }

        .link-view-all {
            color: #10B981;
            text-decoration: none;
            font-weight: 700;
            font-size: 12.5px;
        }

        .link-view-all:hover {
            text-decoration: underline;
        }

        /* Global Responsive Breakpoints for Glossy System */
        @media (max-width: 1024px) {
            .kpi-grid { grid-template-columns: repeat(2, 1fr) !important; }
            .dash-columns { grid-template-columns: 1fr !important; }
        }

        @media (max-width: 640px) {
            .kpi-grid { grid-template-columns: 1fr !important; }
            .dash-header { flex-direction: column !important; }
            .instant-insight-banner { flex-direction: column !important; align-items: flex-start !important; }
        }

        /* Form Components */
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

        .gm-left { display: flex; align-items: center; gap: 12px; }
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
        .gm-label { font-size: 11.5px; font-weight: 800; color: #059669; text-transform: uppercase; display: block; }
        .gm-sub { font-size: 12.5px; font-weight: 700; color: var(--text-main); }
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

        .label-flex-between { display: flex; justify-content: space-between; align-items: center; }
        .stock-active-badge { font-size: 12px; font-weight: 800; color: #10B981; background: #DCFCE7; padding: 2px 8px; border-radius: 8px; }
        .stock-chips-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; margin-top: 6px; }
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
        .btn-predict-cta:hover { background: #162432; transform: translateY(-2px); box-shadow: 0 10px 24px rgba(11, 19, 27, 0.35); }

        .benchmark-card-glossy { display: flex; align-items: center; gap: 14px; padding: 16px 20px; }
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
        .bench-tag { font-size: 10.5px; font-weight: 800; color: #059669; letter-spacing: 0.5px; display: block; margin-bottom: 2px; }
        .bench-name { font-size: 14px; font-weight: 800; color: var(--text-main); margin-bottom: 2px; }
        .bench-stat { font-size: 12px; color: var(--text-muted); }

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
        .score-left { display: flex; align-items: center; gap: 16px; }
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
        .score-number { font-size: 22px; font-weight: 900; line-height: 1; }
        .score-total { font-size: 9.5px; font-weight: 700; color: #94A3B8; }
        .score-status-title { font-size: 16px; font-weight: 800; color: #0F172A; margin-bottom: 3px; }
        .score-status-desc { font-size: 12.5px; color: var(--text-muted); line-height: 1.4; }

        .forecast-two-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .f-box-glossy { background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 14px 16px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02); }
        .f-lbl { font-size: 11px; font-weight: 700; color: var(--text-muted); display: block; margin-bottom: 4px; }
        .f-val { font-size: 18px; font-weight: 800; color: var(--text-main); margin-bottom: 2px; }
        .f-sub { font-size: 11.5px; color: var(--text-muted); font-weight: 600; }

        .proj-chart-card { background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 16px 18px; }
        .proj-head-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
        .proj-title { font-size: 13.5px; font-weight: 800; color: var(--text-main); }
        .proj-sub { font-size: 11.5px; color: var(--text-muted); margin-top: 1px; }

        .chart-legend { display: flex; align-items: center; gap: 14px; }
        .leg-item { display: flex; align-items: center; gap: 6px; font-size: 11.5px; font-weight: 700; color: #475569; }
        .line-black { width: 14px; height: 3px; background: #0F172A; border-radius: 2px; display: inline-block; }
        .line-green-dash { width: 14px; height: 0; border-top: 2px dashed #10B981; display: inline-block; }
        .chart-canvas-container { position: relative; width: 100%; margin-top: 10px; }
        .main-trend-svg { width: 100%; height: auto; max-height: 160px; display: block; overflow: visible; }
        .chart-x-labels { display: flex; justify-content: space-between; align-items: center; font-size: 10.5px; font-weight: 700; color: #64748B; margin-top: 10px; padding: 0 4px; }
        .chart-x-labels span.active-today { color: #15803D; font-weight: 800; background: #DCFCE7; padding: 2px 8px; border-radius: 6px; border: 1px solid rgba(16, 185, 129, 0.25); }

        .insights-title { font-size: 13px; font-weight: 800; color: var(--text-main); margin-bottom: 10px; }
        .insights-list { display: flex; flex-direction: column; gap: 10px; }
        .ins-item-glossy { display: flex; gap: 12px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 12px 14px; }
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
        .ins-content strong { font-size: 12.5px; color: var(--text-main); display: block; margin-bottom: 2px; }
        .ins-content p { font-size: 12px; color: var(--text-muted); line-height: 1.4; margin: 0; }
        .result-action-footer { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; border-top: 1px solid #F1F5F9; padding-top: 16px; }
        .foot-left-actions { display: flex; gap: 10px; }
        .col-left, .col-right { display: flex; flex-direction: column; min-width: 0; }
        .input-wrap-glossy { position: relative; width: 100%; }
        .insights-container { background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 16px 18px; }
        .laris-modal-overlay { position: fixed; inset: 0; background: rgba(11, 19, 27, 0.65); backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; z-index: 999; padding: 20px; }

        /* Trend Hunter Components */
        .time-filter-glossy { display: flex; background: #FFFFFF; border: 1px solid #E2E8F0; padding: 3px; border-radius: 12px; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.03); }
        .t-pill { background: transparent; border: none; padding: 6px 14px; border-radius: 9px; font-size: 12px; font-weight: 700; color: #64748B; cursor: pointer; transition: all 0.2s; }
        .t-pill.active { background: #0B131B; color: #CCFF00; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15); }

        .channel-signals-strip { padding: 20px 24px; }
        .strip-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .strip-title { font-size: 13.5px; font-weight: 800; color: var(--text-main); }
        .strip-sub { font-size: 12px; color: var(--text-muted); }
        .channel-chips-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; }
        .channel-chip-glossy { background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 12px 14px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02); transition: all 0.2s; }
        .channel-chip-glossy:hover { border-color: #10B981; transform: translateY(-2px); }
        .chip-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px; }
        .c-name { font-size: 12px; font-weight: 800; color: var(--text-main); }
        .c-stat { font-size: 12.5px; font-weight: 700; color: #10B981; margin-bottom: 2px; }
        .c-desc { font-size: 11px; color: var(--text-muted); line-height: 1.35; }

        .regional-demand-card { display: grid; grid-template-columns: 1.2fr 1fr; gap: 24px; align-items: center; }
        .regional-title { font-size: 16px; font-weight: 800; color: var(--text-main); margin-bottom: 6px; }
        .regional-desc { font-size: 12.5px; color: var(--text-muted); line-height: 1.5; }
        .reg-select-box { display: flex; flex-direction: column; gap: 6px; margin-bottom: 10px; }
        .reg-label { font-size: 12px; font-weight: 700; color: var(--text-main); }
        .reg-prediction-box { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 12px 16px; display: flex; flex-direction: column; gap: 4px; font-size: 12px; }
        .reg-pred-stat { color: #10B981; font-weight: 700; }
        .reg-pred-items { color: #0F172A; }
        .reg-pred-advice { color: var(--text-muted); font-style: italic; }

        .hero-trend-card { padding: 24px; }
        .hero-top-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; }
        .hero-title-group { display: flex; align-items: center; gap: 14px; }
        .hero-sub-tag { font-size: 11px; font-weight: 800; color: #10B981; text-transform: uppercase; display: block; margin-bottom: 2px; }
        .hero-product-name { font-size: 22px; font-weight: 800; color: var(--text-main); letter-spacing: -0.01em; }
        .hero-stage-badge-box { display: flex; flex-direction: column; align-items: flex-end; gap: 2px; }
        .stage-sub { font-size: 11px; color: var(--text-muted); }

        .trending-grid-4col { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; }
        .trend-matrix-card { padding: 0; overflow: hidden; display: flex; flex-direction: column; }
        .thumb-rel-box { position: relative; height: 140px; overflow: hidden; }
        .trend-thumb-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
        .trend-matrix-card:hover .trend-thumb-img { transform: scale(1.05); }
        .thumb-badge { position: absolute; top: 10px; right: 10px; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 9999px; }
        .trend-card-body { padding: 16px; display: flex; flex-direction: column; gap: 8px; flex: 1; justify-content: space-between; }
        .t-name-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 6px; }
        .t-item-name { font-size: 13.5px; font-weight: 800; color: var(--text-main); line-height: 1.3; }
        .t-item-desc { font-size: 11.5px; color: var(--text-muted); line-height: 1.4; margin: 0; }
        .t-signal-row { display: flex; justify-content: space-between; align-items: center; font-size: 11px; color: var(--text-muted); padding-top: 4px; border-top: 1px solid #F1F5F9; }

        /* Inventory Components */
        .emergency-banner-glossy {
            background: linear-gradient(135deg, rgba(254, 242, 242, 0.95) 0%, rgba(254, 226, 226, 0.9) 100%);
            border: 1px solid rgba(239, 68, 68, 0.35);
            border-radius: 20px;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            box-shadow: 0 10px 25px -5px rgba(220, 38, 38, 0.1), inset 0 1px 2px rgba(255, 255, 255, 1);
            backdrop-filter: blur(12px);
            margin-bottom: 6px;
        }
        .em-left { display: flex; align-items: center; gap: 16px; }
        .em-product-title { font-size: 15px; font-weight: 700; color: #991B1B; margin: 0; }
        .em-desc { font-size: 12.5px; color: #7F1D1D; margin: 0; }
        .em-actions { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }

        .laris-table-glossy { width: 100%; border-collapse: separate; border-spacing: 0; font-size: 13px; }
        .laris-table-glossy th {
            background: #F8FAFC;
            padding: 12px 14px;
            font-size: 11px;
            font-weight: 800;
            color: var(--text-muted);
            letter-spacing: 0.5px;
            border-bottom: 1px solid #E2E8F0;
            text-align: left;
        }
        .laris-table-glossy td { padding: 14px; border-bottom: 1px solid #F1F5F9; vertical-align: middle; color: var(--text-main); }
        .laris-table-glossy tr:hover td { background: #F8FAFC; }
        .prod-cell { display: flex; align-items: center; gap: 12px; }
        .prod-thumb { width: 40px; height: 40px; border-radius: 10px; object-fit: cover; border: 1px solid #E2E8F0; }
        .prod-t-name { font-size: 13.5px; font-weight: 700; color: var(--text-main); display: block; }
        .prod-t-sub { font-size: 11px; color: var(--text-muted); }
        .sku-code-glossy { font-size: 11.5px; font-weight: 700; background: #F1F5F9; color: #334155; padding: 2px 8px; border-radius: 6px; }
        .min-threshold { display: block; font-size: 11px; color: var(--text-muted); }
        .table-foot-row { display: flex; justify-content: space-between; align-items: center; padding-top: 16px; margin-top: 8px; border-top: 1px solid #F1F5F9; }
        .foot-ai-hint { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #10B981; font-weight: 600; }
        .page-meta { font-size: 12px; color: var(--text-muted); }

        .kulakan-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin-top: 16px; }
        .pool-card-glossy {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 18px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            transition: all 0.2s;
        }
        .pool-card-glossy:hover { border-color: #10B981; transform: translateY(-2px); box-shadow: 0 10px 24px rgba(16, 185, 129, 0.08); }
        .pool-top-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; }
        .pool-supplier-tag { font-size: 11px; font-weight: 700; color: #64748B; }
        .pool-item-name { font-size: 15px; font-weight: 800; color: var(--text-main); margin-bottom: 8px; }
        .pool-price-box { display: flex; justify-content: space-between; align-items: center; background: #F8FAFC; padding: 10px 14px; border-radius: 12px; margin-bottom: 4px; }
        .pool-lbl { font-size: 10.5px; color: #64748B; display: block; }
        .pool-price-val { font-size: 16px; font-weight: 800; color: var(--text-main); }
        .pool-price-val small { font-size: 11px; color: #64748B; }
        .pool-sub-price { font-size: 11px; color: var(--text-muted); }
        .pool-progress-meta { display: flex; justify-content: space-between; font-size: 11.5px; margin-bottom: 4px; }
        .pool-participants { font-size: 11px; color: #64748B; margin-top: 6px; }

        /* Juragan AI Components */
        .business-health-card-glossy { display: flex; align-items: center; gap: 12px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 14px; padding: 8px 16px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03); }
        .health-lbl { font-size: 10px; font-weight: 800; color: #64748B; letter-spacing: 0.5px; display: block; }
        .health-val { font-size: 14px; font-weight: 800; }
        .profile-top-row { display: flex; align-items: center; gap: 12px; }
        .profile-photo-glossy { width: 46px; height: 46px; border-radius: 14px; object-fit: cover; border: 2px solid #FFFFFF; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); }
        .profile-name { font-size: 14px; font-weight: 800; color: var(--text-main); margin: 0; }
        .profile-store-id { font-size: 11.5px; color: var(--text-muted); }
        .profile-stat-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
        .stat-num { font-size: 13.5px; font-weight: 800; color: var(--text-main); }

        .topic-buttons-list { display: flex; flex-direction: column; gap: 8px; }
        .topic-btn-glossy {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: left;
        }
        .topic-btn-glossy:hover { border-color: #10B981; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(16, 185, 129, 0.06); }
        .topic-icon { width: 32px; height: 32px; border-radius: 8px; background: rgba(16, 185, 129, 0.1); color: #10B981; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .topic-text strong { font-size: 12px; font-weight: 700; color: var(--text-main); display: block; }
        .topic-text span { font-size: 10.5px; color: var(--text-muted); }

        .chat-container-glossy { padding: 0; overflow: hidden; display: flex; flex-direction: column; height: 640px; }
        .chat-top-bar { padding: 16px 20px; background: #F8FAFC; border-bottom: 1px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center; }
        .chat-copilot-info { display: flex; align-items: center; gap: 12px; }
        .copilot-title { font-size: 15px; font-weight: 800; color: var(--text-main); margin: 0; }
        .copilot-sub { font-size: 11.5px; color: var(--text-muted); }
        .chat-messages-stream { flex: 1; padding: 20px; overflow-y: auto; display: flex; flex-direction: column; gap: 16px; background: linear-gradient(180deg, #FFFFFF 0%, #F8FAFC 100%); }
        .chat-date-pill { text-align: center; font-size: 10.5px; font-weight: 800; color: #94A3B8; letter-spacing: 0.5px; margin-bottom: 8px; }
        .msg-row { display: flex; gap: 12px; max-width: 85%; }
        .ai-row { align-self: flex-start; }
        .user-row { align-self: flex-end; flex-direction: row-reverse; }
        .msg-avatar-ai { width: 32px; height: 32px; border-radius: 10px; background: #10B981; color: #FFFFFF; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .msg-avatar-user { width: 32px; height: 32px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }
        .msg-bubble-ai { background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; border-top-left-radius: 4px; padding: 14px 18px; font-size: 13px; color: var(--text-main); line-height: 1.55; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02); }
        .msg-bubble-user { background: #0B131B; color: #FFFFFF; border-radius: 16px; border-top-right-radius: 4px; padding: 14px 18px; font-size: 13px; line-height: 1.5; box-shadow: 0 4px 14px rgba(11, 19, 27, 0.2); }
        .msg-time-ai { display: block; font-size: 10.5px; color: #94A3B8; margin-top: 6px; }
        .msg-time-user { display: block; font-size: 10.5px; color: #64748B; margin-top: 4px; text-align: right; }
        .chat-input-wrapper { padding: 14px 18px; background: #FFFFFF; border-top: 1px solid #E2E8F0; display: flex; align-items: center; gap: 10px; }
        .chat-input-field { flex: 1; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 11px 16px; font-size: 13px; color: var(--text-main); outline: none; transition: all 0.2s; }
        .chat-input-field:focus { border-color: #10B981; background: #FFFFFF; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); }
        .btn-send-glossy { background: #0B131B; color: #CCFF00; border: none; border-radius: 12px; padding: 11px 18px; font-size: 13px; font-weight: 800; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; }
        .btn-send-glossy:hover { background: #162432; transform: translateY(-1px); }

        /* Report Components */
        .weekly-bar-chart-glossy { display: flex; justify-content: space-around; align-items: flex-end; height: 180px; padding: 20px 0 10px 0; border-bottom: 1px solid #F1F5F9; }
        .bar-col-item { display: flex; flex-direction: column; align-items: center; gap: 6px; }
        .bars-pair { display: flex; align-items: flex-end; gap: 6px; height: 130px; }
        .bar-gross { width: 18px; background: #0B131B; border-radius: 6px 6px 0 0; transition: height 0.5s ease; }
        .bar-net { width: 18px; background: #10B981; border-radius: 6px 6px 0 0; transition: height 0.5s ease; }
        .week-label { font-size: 11.5px; font-weight: 700; color: var(--text-main); }
        .week-val { font-size: 11px; color: var(--text-muted); }
        .channels-title { font-size: 12.5px; font-weight: 800; color: var(--text-main); }
        .channels-cards-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .exec-pillars-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .pillar-box-glossy { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px; position: relative; }
        .pillar-num-badge { width: 24px; height: 24px; border-radius: 8px; background: #0B131B; color: #CCFF00; font-size: 11.5px; font-weight: 800; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; }
        .pillar-head { font-size: 13px; font-weight: 800; color: var(--text-main); margin-bottom: 4px; }
        .pillar-text { font-size: 12px; color: var(--text-muted); line-height: 1.45; margin: 0; }

        /* Settings Components */
        .channels-grid-glossy { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; margin-top: 10px; }
        .channel-card-glossy { background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02); transition: all 0.2s; }
        .channel-card-glossy:hover { border-color: #10B981; transform: translateY(-1px); }
        .channel-left-info { display: flex; align-items: center; gap: 14px; }
        .channel-icon-avatar { width: 44px; height: 44px; border-radius: 12px; background: #F8FAFC; border: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .channel-title { font-size: 14px; font-weight: 800; color: var(--text-main); margin: 0; }
        .channel-meta { font-size: 11.5px; color: var(--text-muted); }
        .channel-right-action { display: flex; align-items: center; gap: 12px; }

        /* Help Components */
        .search-hero-panel { background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(204, 255, 0, 0.05) 50%, rgba(255, 255, 255, 0.95) 100%); border: 1px solid rgba(16, 185, 129, 0.25); text-align: center; padding: 32px 24px; }
        .search-hero-title { font-size: 22px; font-weight: 800; color: #0F172A; margin-bottom: 4px; }
        .search-hero-sub { font-size: 13px; color: #64748B; max-width: 580px; margin: 0 auto 20px auto; }
        .search-input-glossy-wrap { display: flex; align-items: center; gap: 12px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 9999px; padding: 10px 20px; max-width: 500px; margin: 0 auto; box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04); transition: all 0.2s; }
        .search-input-glossy-wrap:focus-within { border-color: #10B981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15); }
        .search-input-glossy-wrap input { border: none; outline: none; width: 100%; font-size: 13.5px; color: var(--text-main); }
        .pillar-card-title { font-size: 15px; font-weight: 800; color: var(--text-main); margin-bottom: 4px; }
        .pillar-card-desc { font-size: 12px; color: var(--text-muted); line-height: 1.45; margin: 0; }
        .faq-list { display: flex; flex-direction: column; gap: 10px; }
        .faq-item-glossy { border: 1px solid #E2E8F0; border-radius: 14px; overflow: hidden; background: #FFFFFF; transition: all 0.2s; }
        .faq-toggle-glossy { width: 100%; background: #FFFFFF; border: none; padding: 14px 18px; text-align: left; display: flex; justify-content: space-between; align-items: center; cursor: pointer; font-size: 13.5px; font-weight: 700; color: var(--text-main); transition: background 0.15s; }
        .faq-toggle-glossy:hover { background: #F8FAFC; }
        .faq-arrow-icon { font-size: 14px; color: #64748B; transition: transform 0.2s; }
        .faq-answer-glossy { display: none; padding: 0 18px 16px 18px; font-size: 13px; color: #475569; line-height: 1.55; border-top: 1px solid #F1F5F9; background: #F8FAFC; }
        .faq-answer-glossy p { margin: 12px 0 0 0; }
    </style>
    @stack('styles')
</head>
<body>

    @php
        $currentUser = Auth::user();
        $userRole = $currentUser?->role ?? 'guest';
        $userName = $currentUser?->name ?? 'Tamu / Pengunjung';
        $userEmail = $currentUser?->email ?? 'Silakan Masuk';
        
        $roleLabel = match($userRole) {
            'super_admin' => 'Super Administrator Platform',
            'staff_cashier' => 'Kasir Toko',
            'staff_inventory' => 'Staf Gudang',
            'user', 'customer' => 'User / Pembeli',
            'guest' => 'Pengunjung Marketplace',
            default => 'Juragan UMKM (Owner)',
        };

        $roleBadgeColor = match($userRole) {
            'super_admin' => '#6366F1',
            'staff_cashier' => '#0284C7',
            'staff_inventory' => '#D97706',
            'user', 'customer' => '#10B981',
            'guest' => '#64748B',
            default => '#10B981',
        };

        $homeUrl = match($userRole) {
            'super_admin' => route('admin.dashboard'),
            'staff_cashier' => route('cashier.dashboard'),
            'staff_inventory' => route('inventory_staff.dashboard'),
            'user', 'customer' => route('user.dashboard'),
            'guest' => url('/marketplace'),
            default => route('dashboard'),
        };

        $userAvatar = $currentUser?->avatar_url ?: match($userRole) {
            'super_admin' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&auto=format&fit=crop&q=80',
            'staff_cashier' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&auto=format&fit=crop&q=80',
            'staff_inventory' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80',
            'user', 'customer' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&auto=format&fit=crop&q=80',
            'guest' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&auto=format&fit=crop&q=80',
            default => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80',
        };
    @endphp

    <!-- LEFT SIDEBAR (ROLE DEDICATED, SCROLLABLE & COLLAPSIBLE) -->
    <aside class="sidebar" id="app-sidebar" aria-label="Sidebar Navigasi">
        <div class="sidebar-brand">
            <a href="{{ $homeUrl }}" class="brand-logo-wrap" title="LARIS Platform">
                <img class="brand-full-logo" src="{{ asset('logo.png') }}?v={{ time() }}" alt="LARIS Platform">
                <img class="brand-mini-icon" src="{{ asset('icon.png') }}" alt="LARIS Icon">
            </a>
            
            <!-- Desktop Collapse Button -->
            <button type="button" class="btn-sidebar-collapse" id="btn-sidebar-collapse" onclick="toggleSidebarCollapse()" title="Perkecil / Perbesar Sidebar" aria-label="Perkecil / Perbesar Sidebar">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
            </button>

            <!-- Mobile Close Button -->
            <button type="button" class="btn-sidebar-close" id="btn-sidebar-close" onclick="closeMobileSidebar()" aria-label="Tutup Menu">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- STRICT ROLE SEPARATION: 1 ROLE = 1 DEDICATED SIDEBAR --}}
        @if($userRole === 'guest')
            <!-- 0. SIDEBAR KHUSUS TAMU MARKETPLACE PUBLIK -->
            <div class="menu-heading">Marketplace Publik</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('marketplace*') ? 'active' : '' }}">
                    <a href="{{ url('/marketplace') }}" title="Jelajah Gerai & Menu">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.614A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.015a2.993 2.993 0 0 0 2.25 1.015c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0L6 3.75h12l2.25 5.599"/></svg>
                        <span>Jelajah Gerai UMKM</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" title="Masuk Akun">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                        <span>Masuk Akun</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" title="Daftar Pengguna Baru">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z"/></svg>
                        <span>Daftar Akun Baru</span>
                    </a>
                </li>
            </ul>

            <div class="menu-heading">Informasi</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="{{ url('/') }}" title="Landing Page LARIS">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        <span>Tentang LARIS</span>
                    </a>
                </li>
            </ul>
        @elseif($userRole === 'super_admin')
            <!-- 1. SIDEBAR KHUSUS SUPER ADMINISTRATOR PLATFORM -->
            <div class="menu-heading">Manajemen Platform</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('admin*') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" title="Platform Overview & GMV">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>Platform Overview</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}#stores-tab" title="Gerai UMKM Lintas Sektor">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>Gerai UMKM Nasional</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}#users-tab" title="Manajemen 4 Role Pengguna">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Manajemen Pengguna</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}#orders-tab" title="Telemetri Transaksi Nasional">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Telemetri Transaksi</span>
                    </a>
                </li>
            </ul>

            <div class="menu-heading">Bantuan &amp; Sistem</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('help*') ? 'active' : '' }}">
                    <a href="{{ route('help.index') }}" title="Panduan Platform">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/></svg>
                        <span>Pusat Bantuan</span>
                    </a>
                </li>
            </ul>

        @elseif($userRole === 'staff_cashier')
            <!-- 2. SIDEBAR KHUSUS ROLE KASIR -->
            <div class="menu-heading">Operasional Kasir</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('cashier*') ? 'active' : '' }}">
                    <a href="{{ route('cashier.dashboard') }}" title="Terminal POS Kasir">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0-8.25h19.5m0 0v8.25m0-8.25v-.75a.75.75 0 0 0-.75-.75h-.75m0 0V4.5m-18 0h18"/></svg>
                        <span>Terminal POS Kasir</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('smart-inventory*') ? 'active' : '' }}">
                    <a href="{{ url('/smart-inventory') }}" title="Cek Stok Barang">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                        <span>Cek Stok Barang</span>
                    </a>
                </li>
            </ul>

            <div class="menu-heading">Bantuan</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('help*') ? 'active' : '' }}">
                    <a href="{{ route('help.index') }}" title="Panduan Kasir">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/></svg>
                        <span>Panduan Kasir</span>
                    </a>
                </li>
            </ul>

        @elseif($userRole === 'staff_inventory')
            <!-- 3. SIDEBAR KHUSUS ROLE STAF GUDANG -->
            <div class="menu-heading">Operasional Gudang</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('inventory*') ? 'active' : '' }}">
                    <a href="{{ route('inventory_staff.dashboard') }}" title="Antarmuka Gudang">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m16.5 0v-1.5a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25v1.5m16.5 0H3.75"/></svg>
                        <span>Antarmuka Gudang</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('smart-inventory*') ? 'active' : '' }}">
                    <a href="{{ url('/smart-inventory') }}" title="Kelola Stok & PO">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                        <span>Kelola Stok &amp; PO</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('laris-predict*') ? 'active' : '' }}">
                    <a href="{{ url('/laris-predict') }}" title="Prediksi Restock AI">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/></svg>
                        <span>Prediksi Restock AI</span>
                    </a>
                </li>
            </ul>

            <div class="menu-heading">Bantuan</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('help*') ? 'active' : '' }}">
                    <a href="{{ route('help.index') }}" title="Panduan Gudang">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/></svg>
                        <span>Panduan Gudang</span>
                    </a>
                </li>
            </ul>

        @elseif($userRole === 'user' || $userRole === 'customer')
            <!-- 4. SIDEBAR KHUSUS USER (PEMBELI ALA GOJEK MARKETPLACE) -->
            <div class="menu-heading">Portal Belanja User</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('user/dashboard*') || request()->is('user/marketplace*') ? 'active' : '' }}">
                    <a href="{{ route('user.dashboard') }}" title="Jelajah Semua Gerai & Menu">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.614A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.015a2.993 2.993 0 0 0 2.25 1.015c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0L6 3.75h12l2.25 5.599"/></svg>
                        <span>Jelajah Gerai &amp; Menu</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('user/orders*') ? 'active' : '' }}">
                    <a href="{{ route('user.orders') }}" title="Pesanan Saya & Pelacakan">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.948c0-.621-.504-1.125-1.125-1.125H4.125C3.504 5.5 3 6.004 3 6.625v10.5c0 .621.504 1.125 1.125 1.125h1.5"/></svg>
                        <span>Pesanan Saya (Tracking)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.dashboard') }}#vouchers-section" title="Kupon & Voucher Diskon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/></svg>
                        <span>Kupon &amp; Voucher Diskon</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('pembeli*') ? 'active' : '' }}">
                    <a href="{{ url('/pembeli') }}" title="Flash Sale Cuci Gudang">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/></svg>
                        <span>Flash Sale Cuci Gudang</span>
                    </a>
                </li>
            </ul>

            <div class="menu-heading">Bantuan</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('help*') ? 'active' : '' }}">
                    <a href="{{ route('help.index') }}" title="Panduan User">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/></svg>
                        <span>Panduan User</span>
                    </a>
                </li>
            </ul>

        @else
            <!-- 5. SIDEBAR KHUSUS JURAGAN UMKM (OWNER) -->
            <div class="menu-heading">Menu Eksekutif</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('dashboard*') || request()->is('business-dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" title="Business Dashboard">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-1.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/></svg>
                        <span>Business Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('laris-predict*') ? 'active' : '' }}">
                    <a href="{{ url('/laris-predict') }}" title="LARIS Predict">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/></svg>
                        <span>LARIS Predict</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('trend-hunter*') ? 'active' : '' }}">
                    <a href="{{ url('/trend-hunter') }}" title="Trend Hunter">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        <span>Trend Hunter</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('smart-inventory*') ? 'active' : '' }}">
                    <a href="{{ url('/smart-inventory') }}" title="Smart Inventory">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                        <span>Smart Inventory</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('juragan-ai*') ? 'active' : '' }}">
                    <a href="{{ url('/juragan-ai') }}" title="Juragan AI Copilot">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/></svg>
                        <span>Juragan AI Copilot</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('business-report*') ? 'active' : '' }}">
                    <a href="{{ url('/business-report') }}" title="Business Report">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                        <span>Laporan Bisnis</span>
                    </a>
                </li>
            </ul>

            <div class="menu-heading">Pengaturan Toko</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('settings*') ? 'active' : '' }}">
                    <a href="{{ route('settings.index') }}" title="Pengaturan Toko">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        <span>Pengaturan Toko</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('help*') ? 'active' : '' }}">
                    <a href="{{ route('help.index') }}" title="Pusat Bantuan">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/></svg>
                        <span>Pusat Bantuan</span>
                    </a>
                </li>
            </ul>
        @endif

        <!-- SIDEBAR FOOTER -->
        <div class="sidebar-footer">
            <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                <div class="sidebar-footer-info" style="font-size: 11px; color: #64748B; line-height: 1.3;">
                    <div style="font-weight: 700; color: #94A3B8;">LARIS Platform</div>
                    <div>v2.4 • Edge AI</div>
                </div>
            </div>
            <!-- Collapsed state expand trigger button -->
            <button type="button" class="sidebar-footer-expand-btn" onclick="toggleSidebarCollapse()" title="Perbesar Menu Sidebar" aria-label="Perbesar Sidebar">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
            </button>
        </div>
    </aside>

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="sidebar-overlay" class="sidebar-overlay" onclick="closeMobileSidebar()"></div>

    <!-- MAIN BODY -->
    <div class="main-wrapper">
        <!-- GLOBAL TOP BAR -->
        <header class="top-bar">
            <div style="display: flex; align-items: center; gap: 10px;">
                <button type="button" class="btn-mobile-sidebar" id="btn-mobile-sidebar-toggle" onclick="toggleMobileSidebar()" aria-label="Buka Menu Navigasi">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
                <div class="search-container">
                    <svg width="16" height="16" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                    <input type="text" id="global-search-input" placeholder="Cari analitik, stok, insight AI... (Tekan Enter)" onkeypress="if(event.key === 'Enter') { if(this.value.trim()) window.location.href = '{{ url('/smart-inventory') }}?q=' + encodeURIComponent(this.value.trim()); }">
                </div>
            </div>

            <div class="top-right-group">
                @if($userRole === 'guest')
                    <div class="store-status-pill">
                        <span class="status-dot-green"></span>
                        <span>Marketplace Publik (Mode Tamu)</span>
                    </div>
                    <a href="{{ route('login') }}" style="background: #0B131B; color: #CCFF00; padding: 7px 18px; border-radius: 999px; font-size: 12.5px; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                        <span>Masuk ke Akun</span>
                    </a>
                @else
                    @if($userRole === 'super_admin')
                        <div class="store-status-pill">
                            <span class="status-dot-green"></span>
                            <span>Super Administrator • Ekosistem Nasional</span>
                        </div>
                    @elseif($userRole === 'user' || $userRole === 'customer')
                        <a href="{{ route('user.orders') }}" class="btn-soft-outline" style="font-weight: 700; color: #10B981; border-color: rgba(16, 185, 129, 0.3);">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span>Pesanan Saya</span>
                        </a>
                        <div class="store-status-pill">
                            <span class="status-dot-green"></span>
                            <span>User / Pembeli • Marketplace Gerai</span>
                        </div>
                    @elseif($userRole === 'staff_cashier')
                        <div class="store-status-pill">
                            <span class="status-dot-green"></span>
                            <span>Shift Kasir Aktif</span>
                        </div>
                    @elseif($userRole === 'staff_inventory')
                        <div class="store-status-pill">
                            <span class="status-dot-green"></span>
                            <span>Gudang Siap Operasi</span>
                        </div>
                    @else
                        <div class="store-status-pill">
                            <span class="status-dot-green"></span>
                            <span>Juragan UMKM • Toko Berkah Utama</span>
                        </div>
                    @endif

                    <!-- NOTIFICATION DROPDOWN -->
                    <div style="position: relative;">
                        <button type="button" class="notification-btn" id="btn-toggle-notif" onclick="toggleTopDropdown('dropdown-notif')" title="Notifikasi Realtime">
                            <span class="notification-badge" id="navbarNotifBadge" style="display: none;"></span>
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
                        </button>
                        <div id="dropdown-notif" class="top-dropdown-menu notif-dropdown">
                            <div class="notif-header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #E2E8F0; padding-bottom: 8px;">
                                <span style="font-size: 12px; font-weight: 800; color: #0F172A;">Pemberitahuan Realtime</span>
                                <span class="notif-badge-count" id="notifBadgeCount">Memuat...</span>
                            </div>
                            <div id="notifItemsContainer" style="max-height: 280px; overflow-y: auto;">
                                <div style="padding: 18px; text-align: center; color: #94A3B8; font-size: 11px;">Menghubungkan ke pusat notifikasi...</div>
                            </div>
                            <div style="padding: 8px 12px; background: #F8FAFC; border-top: 1px solid #E2E8F0; text-align: center;">
                                <button type="button" onclick="markAllNotificationsRead()" style="background: none; border: none; font-size: 11px; font-weight: 700; color: #10B981; cursor: pointer;">Tandai Semua Dibaca</button>
                            </div>
                        </div>
                    </div>

                    <!-- USER PROFILE DROPDOWN -->
                    <div style="position: relative;">
                        <div class="user-profile-badge" id="btn-toggle-user" onclick="toggleTopDropdown('dropdown-user')" title="Menu Profil">
                            <img class="user-avatar" src="{{ $userAvatar }}" alt="{{ $userName }}">
                            <div class="user-info">
                                <div class="user-name">{{ $userName }}</div>
                                <div class="user-role" style="color: {{ $roleBadgeColor }};">{{ $roleLabel }}</div>
                            </div>
                            <svg width="12" height="12" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                        </div>

                        <div id="dropdown-user" class="top-dropdown-menu user-dropdown">
                            <div class="user-dropdown-header">
                            <div class="u-name">{{ $userName }}</div>
                            <div class="u-email">{{ $userEmail }}</div>
                            <div style="margin-top: 6px;">
                                <span style="display: inline-block; font-size: 11px; padding: 2px 8px; border-radius: 999px; background: rgba(15, 23, 42, 0.06); color: {{ $roleBadgeColor }}; font-weight: 700; border: 1px solid rgba(15, 23, 42, 0.1);">
                                    {{ $roleLabel }}
                                </span>
                            </div>
                        </div>

                        {{-- Strict User Dropdown Links per Role --}}
                        @if($userRole === 'owner')
                            <a href="{{ route('dashboard') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-1.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/></svg>
                                <span>Business Dashboard</span>
                            </a>
                            <a href="{{ route('settings.index') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                <span>Pengaturan Akun &amp; Toko</span>
                            </a>
                        @elseif($userRole === 'staff_cashier')
                            <a href="{{ route('cashier.dashboard') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0-8.25h19.5m0 0v8.25m0-8.25v-.75a.75.75 0 0 0-.75-.75h-.75m0 0V4.5m-18 0h18"/></svg>
                                <span>Terminal POS Kasir</span>
                            </a>
                        @elseif($userRole === 'staff_inventory')
                            <a href="{{ route('inventory_staff.dashboard') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                                <span>Antarmuka Gudang</span>
                            </a>
                        @elseif($userRole === 'customer')
                            <a href="{{ route('customer.dashboard') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                                <span>Dashboard Pelanggan</span>
                            </a>
                            <a href="{{ url('/pembeli') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                <span>Katalog &amp; Flash Sale Cuci Gudang</span>
                            </a>
                        @endif

                        <a href="{{ route('help.index') }}" class="menu-link">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/></svg>
                            <span>Pusat Bantuan</span>
                        </a>

                        <div style="border-top: 1px solid #F1F5F9; margin-top: 4px; padding-top: 4px;">
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="menu-link logout" style="width: 100%; border: none; background: none; cursor: pointer; text-align: left;">
                                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/></svg>
                                    <span>Keluar (Logout)</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="content-area">
            @if(session('warning'))
                <div style="background: rgba(245, 158, 11, 0.12); border: 1px solid rgba(245, 158, 11, 0.35); color: #B45309; padding: 12px 18px; border-radius: 12px; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.08);">
                    <svg width="20" height="20" fill="none" stroke="#D97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>{{ session('warning') }}</span>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    <script>
        /* Top Navigation Dropdowns */
        function toggleTopDropdown(id) {
            const allDropdowns = document.querySelectorAll('.top-dropdown-menu');
            allDropdowns.forEach(d => {
                if (d.id !== id) d.style.display = 'none';
            });
            const target = document.getElementById(id);
            if (target) {
                target.style.display = target.style.display === 'block' ? 'none' : 'block';
            }
        }

        /* Sidebar Desktop Collapse / Expand */
        function toggleSidebarCollapse() {
            const isCollapsed = document.body.classList.toggle('sidebar-collapsed');
            try {
                localStorage.setItem('laris_sidebar_collapsed', isCollapsed ? 'true' : 'false');
            } catch(e) {}
        }

        /* Mobile Sidebar Drawer Functions */
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('app-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar && overlay) {
                const isOpen = sidebar.classList.contains('open');
                if (isOpen) {
                    closeMobileSidebar();
                } else {
                    sidebar.classList.add('open');
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }
        }

        function closeMobileSidebar() {
            const sidebar = document.getElementById('app-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar) sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        /* Auto-restore user's sidebar preference on load */
        (function() {
            try {
                if (localStorage.getItem('laris_sidebar_collapsed') === 'true' && window.innerWidth > 1024) {
                    document.body.classList.add('sidebar-collapsed');
                }
            } catch(e) {}
        })();

        /* Close Dropdowns on Click Outside */
        document.addEventListener('click', function(e) {
            const notifBtn = document.getElementById('btn-toggle-notif');
            const notifMenu = document.getElementById('dropdown-notif');
            const userBtn = document.getElementById('btn-toggle-user');
            const userMenu = document.getElementById('dropdown-user');

            if (notifBtn && notifMenu && !notifBtn.contains(e.target) && !notifMenu.contains(e.target)) {
                notifMenu.style.display = 'none';
            }
            if (userBtn && userMenu && !userBtn.contains(e.target) && !userMenu.contains(e.target)) {
                userMenu.style.display = 'none';
            }
        });

        /* Realtime Navbar Notification Polling */
        function fetchLiveNotifications() {
            fetch('/api/notifications/unread')
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        const badge = document.getElementById('navbarNotifBadge');
                        const badgeCount = document.getElementById('notifBadgeCount');
                        const container = document.getElementById('notifItemsContainer');

                        if (data.count > 0) {
                            if (badge) badge.style.display = 'block';
                            if (badgeCount) badgeCount.innerText = data.count + ' Baru';
                        } else {
                            if (badge) badge.style.display = 'none';
                            if (badgeCount) badgeCount.innerText = '0 Baru';
                        }

                        if (container) {
                            if (data.notifications && data.notifications.length > 0) {
                                let html = '';
                                data.notifications.forEach(n => {
                                    let dotColor = n.type === 'alert' ? 'red' : 'green';
                                    html += `
                                        <a href="${n.url}" class="notif-item">
                                            <span class="notif-dot ${dotColor}"></span>
                                            <div class="notif-body">
                                                <div class="notif-title">${n.title}</div>
                                                <div class="notif-desc">${n.desc}</div>
                                                <span style="font-size: 10px; color: #94A3B8; display: block; margin-top: 2px;">${n.time}</span>
                                            </div>
                                        </a>
                                    `;
                                });
                                container.innerHTML = html;
                            } else {
                                container.innerHTML = '<div style="padding: 20px; text-align: center; color: #94A3B8; font-size: 12px;">Tidak ada notifikasi baru saat ini.</div>';
                            }
                        }
                    }
                })
                .catch(e => console.warn('Notif fetch error:', e));
        }

        function markAllNotificationsRead() {
            fetch('/api/notifications/mark-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(() => fetchLiveNotifications());
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchLiveNotifications();
            setInterval(fetchLiveNotifications, 10000);
        });
    </script>

    @include('partials.laris_alert')

    @stack('scripts')
</body>
</html>
