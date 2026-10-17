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
    
    <style>
        :root {
            --bg-sidebar: #0B1215;
            --bg-sidebar-hover: #162228;
            --sidebar-border: #1E2D33;
            --accent-lime: #CCFF00;
            --accent-lime-hover: #B4F000;
            --accent-lime-dark: #8FBF00;
            --accent-lime-subtle: rgba(204, 255, 0, 0.12);
            --bg-canvas: #F8FAF9;
            --surface-card: #FFFFFF;
            --border-light: #E5E7EB;
            --border-subtle: #F1F5F9;
            --text-main: #111827;
            --text-muted: #64748B;
            --text-subtle: #94A3B8;
            --badge-critical-bg: #FEE2E2;
            --badge-critical-text: #DC2626;
            --badge-warning-bg: #FEF3C7;
            --badge-warning-text: #D97706;
            --badge-healthy-bg: #DCFCE7;
            --badge-healthy-text: #16A34A;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-canvas);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            letter-spacing: -0.01em;
        }

        /* SIDEBAR STYLES */
        .sidebar {
            width: 250px;
            background-color: var(--bg-sidebar);
            color: #FFFFFF;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            border-right: 1px solid var(--sidebar-border);
            padding: 24px 16px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 8px 22px 8px;
            border-bottom: 1px solid var(--sidebar-border);
            margin-bottom: 24px;
        }

        .brand-logo-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-full-logo {
            height: 38px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            /* Filter aksen limau neon cerah #CCFF00 berkombinasi dengan teks putih bersih */
            filter: drop-shadow(0 0 12px rgba(204, 255, 0, 0.45));
            transition: all 0.25s ease;
        }

        .brand-full-logo:hover {
            filter: drop-shadow(0 0 18px rgba(204, 255, 0, 0.85));
            transform: scale(1.03);
        }

        .menu-heading {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #64748B;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .nav-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 32px;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            color: #94A3B8;
            transition: all 0.18s ease;
        }

        .nav-item a:hover {
            color: #FFFFFF;
            background: var(--bg-sidebar-hover);
        }

        .nav-item.active a {
            background-color: var(--accent-lime);
            color: #000000;
            font-weight: 700;
            box-shadow: 0 4px 16px rgba(204, 255, 0, 0.28);
        }

        .nav-item svg {
            width: 18px;
            height: 18px;
            stroke-width: 2;
        }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid var(--sidebar-border);
            padding-top: 16px;
        }

        /* MAIN CONTENT AREA */
        .main-wrapper {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* TOP GLOBAL BAR */
        .top-bar {
            height: 64px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
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
            width: 380px;
            transition: all 0.2s;
        }

        .search-container:focus-within {
            background: #FFFFFF;
            border-color: #CBD5E1;
            box-shadow: 0 0 0 3px rgba(204, 255, 0, 0.25);
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
            gap: 20px;
        }

        .store-status-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #F1F5F9;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            color: #334155;
        }

        .status-dot-green {
            width: 8px;
            height: 8px;
            background-color: #22C55E;
            border-radius: 50%;
            box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.2);
        }

        .notification-btn {
            position: relative;
            background: transparent;
            border: none;
            cursor: pointer;
            color: #64748B;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6px;
            border-radius: 50%;
            transition: background 0.15s;
        }

        .notification-btn:hover {
            background: #F1F5F9;
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
            transition: all 0.2s;
        }

        .user-profile-badge:hover {
            background: #F1F5F9;
        }

        /* TOP BAR DROPDOWNS */
        .top-dropdown-menu {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            box-shadow: 0 14px 35px rgba(0, 0, 0, 0.12), 0 4px 10px rgba(0, 0, 0, 0.05);
            z-index: 100;
            display: none;
            overflow: hidden;
            animation: dropdownFadeIn 0.18s ease-out;
        }

        @keyframes dropdownFadeIn {
            from { opacity: 0; transform: translateY(-6px); }
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
        .notif-dot.green { background: #16A34A; }

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
            line-height: 1.3;
        }

        .notif-footer {
            padding: 10px 16px;
            text-align: center;
            background: #F8FAFC;
            font-size: 12px;
            font-weight: 600;
        }

        .notif-footer a {
            color: #16A34A;
            text-decoration: none;
        }

        /* USER MENU */
        .user-dropdown {
            width: 240px;
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

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent-lime);
        }

        .user-info {
            line-height: 1.2;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-main);
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* CONTENT CONTAINER */
        .content-area {
            padding: 28px 32px 48px 32px;
        }

        /* UTILITY BUTTONS & BADGES */
        .btn-lime {
            background-color: var(--accent-lime);
            color: #000000;
            font-weight: 700;
            font-size: 13px;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.18s;
            box-shadow: 0 4px 12px rgba(204, 255, 0, 0.22);
        }

        .btn-lime:hover {
            background-color: var(--accent-lime-hover);
            transform: translateY(-1px);
        }

        .btn-dark {
            background-color: #0B1215;
            color: #FFFFFF;
            font-weight: 600;
            font-size: 13px;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #1E2D33;
            cursor: pointer;
            transition: all 0.18s;
        }

        .btn-dark:hover {
            background-color: #162228;
            color: #FFFFFF;
        }

        .btn-outline {
            background-color: #FFFFFF;
            color: #334155;
            border: 1px solid #E2E8F0;
            font-weight: 600;
            font-size: 13px;
            padding: 8px 14px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.15s;
        }

        .btn-outline:hover {
            background: #F8FAFC;
            border-color: #CBD5E1;
        }

        .btn-consumer-switch {
            background: #0B1215;
            color: #CCFF00;
            border: 1px solid #1E2D33;
            font-weight: 700;
            font-size: 12px;
            padding: 7px 14px;
            border-radius: 99px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .btn-consumer-switch:hover {
            background: #162228;
            border-color: #CCFF00;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(204, 255, 0, 0.25);
        }

        .pulse-indicator {
            width: 8px;
            height: 8px;
            background-color: #CCFF00;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 0 0 rgba(204, 255, 0, 0.7);
            animation: pulse-ring 1.8s infinite;
        }

        @keyframes pulse-ring {
            0% {
                box-shadow: 0 0 0 0 rgba(204, 255, 0, 0.7);
            }
            70% {
                box-shadow: 0 0 0 6px rgba(204, 255, 0, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(204, 255, 0, 0);
            }
        }


        .card-panel {
            background: var(--surface-card);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);
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
            color: #CCFF00;
            background: rgba(204, 255, 0, 0.15);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(11, 18, 21, 0.7);
            backdrop-filter: blur(4px);
            z-index: 998;
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* GLOBAL RESPONSIVE TABLE UTILITIES */
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
                width: 270px;
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
                z-index: 1000;
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.6);
                overflow-y: auto;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .sidebar-brand {
                justify-content: space-between;
                padding: 16px 14px 20px 14px;
            }
            .btn-sidebar-close {
                display: inline-flex;
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
                width: 280px;
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
            .top-bar {
                padding: 0 12px;
            }
            .content-area {
                padding: 14px 10px 28px 10px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    @php
        $currentUser = Auth::user();
        $userRole = $currentUser?->role ?? 'owner';
        $userName = $currentUser?->name ?? 'Pengguna LARIS';
        $userEmail = $currentUser?->email ?? 'pengguna@laris.id';
        
        $roleLabel = match($userRole) {
            'staff_cashier' => 'Kasir Toko',
            'staff_inventory' => 'Staf Gudang',
            default => 'Super Juragan (Owner)',
        };

        $roleBadgeColor = match($userRole) {
            'staff_cashier' => '#38BDF8',
            'staff_inventory' => '#FB923C',
            default => '#CCFF00',
        };

        $homeUrl = match($userRole) {
            'staff_cashier' => route('cashier.dashboard'),
            'staff_inventory' => route('inventory_staff.dashboard'),
            default => route('dashboard'),
        };

        $userAvatar = $currentUser?->avatar_url ?: match($userRole) {
            'staff_cashier' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&auto=format&fit=crop&q=80',
            'staff_inventory' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80',
            default => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80',
        };
    @endphp

    <!-- LEFT SIDEBAR -->
    <aside class="sidebar" id="app-sidebar">
        <div class="sidebar-brand">
            <a href="{{ $homeUrl }}" class="brand-logo-wrap" title="LARIS BI Platform">
                <img class="brand-full-logo" src="{{ asset('logo.png') }}?v={{ time() }}" alt="LARIS BI Platform">
            </a>
            <button type="button" class="btn-sidebar-close" id="btn-sidebar-close" onclick="closeMobileSidebar()" aria-label="Tutup Menu">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        @if($userRole === 'staff_cashier')
            <!-- MENU KHUSUS KASIR -->
            <div class="menu-heading">Operasional Kasir</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('cashier*') ? 'active' : '' }}">
                    <a href="{{ route('cashier.dashboard') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0-8.25h19.5m0 0v8.25m0-8.25v-.75a.75.75 0 0 0-.75-.75h-.75m0 0V4.5m-18 0h18"/></svg>
                        <span>Smart POS Kasir</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('smart-inventory*') ? 'active' : '' }}">
                    <a href="{{ url('/smart-inventory') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                        <span>Cek Stok Barang</span>
                    </a>
                </li>
            </ul>

            <div class="menu-heading">Bantuan</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('help*') ? 'active' : '' }}">
                    <a href="{{ route('help.index') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/></svg>
                        <span>Pusat Bantuan</span>
                    </a>
                </li>
            </ul>
        @elseif($userRole === 'staff_inventory')
            <!-- MENU KHUSUS STAF GUDANG -->
            <div class="menu-heading">Operasional Gudang</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('inventory*') ? 'active' : '' }}">
                    <a href="{{ route('inventory_staff.dashboard') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m16.5 0v-1.5a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25v1.5m16.5 0H3.75"/></svg>
                        <span>Antarmuka Gudang</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('smart-inventory*') ? 'active' : '' }}">
                    <a href="{{ url('/smart-inventory') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                        <span>Kelola Stok &amp; PO</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('laris-predict*') ? 'active' : '' }}">
                    <a href="{{ url('/laris-predict') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/></svg>
                        <span>Prediksi Restock AI</span>
                    </a>
                </li>
            </ul>

            <div class="menu-heading">Bantuan</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('help*') ? 'active' : '' }}">
                    <a href="{{ route('help.index') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/></svg>
                        <span>Pusat Bantuan</span>
                    </a>
                </li>
            </ul>
        @else
            <!-- MENU LENGKAP JURAGAN (OWNER) -->
            <div class="menu-heading">Menu Utama</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('dashboard*') || request()->is('business-dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-1.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/></svg>
                        <span>Business Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('laris-predict') ? 'active' : '' }}">
                    <a href="{{ url('/laris-predict') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/></svg>
                        <span>LARIS Predict</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('trend-hunter') ? 'active' : '' }}">
                    <a href="{{ url('/trend-hunter') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        <span>Trend Hunter</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('smart-inventory') ? 'active' : '' }}">
                    <a href="{{ url('/smart-inventory') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                        <span>Smart Inventory</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('juragan-ai') ? 'active' : '' }}">
                    <a href="{{ url('/juragan-ai') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/></svg>
                        <span>Juragan AI</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('business-report') ? 'active' : '' }}">
                    <a href="{{ url('/business-report') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                        <span>Business Report</span>
                    </a>
                </li>
            </ul>

            <div class="menu-heading">Akses Operasional</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('cashier*') ? 'active' : '' }}">
                    <a href="{{ route('cashier.dashboard') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0-8.25h19.5m0 0v8.25m0-8.25v-.75a.75.75 0 0 0-.75-.75h-.75m0 0V4.5m-18 0h18"/></svg>
                        <span>Smart POS Kasir</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('inventory*') ? 'active' : '' }}">
                    <a href="{{ route('inventory_staff.dashboard') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m16.5 0v-1.5a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25v1.5m16.5 0H3.75"/></svg>
                        <span>Antarmuka Gudang</span>
                    </a>
                </li>
            </ul>

            <div class="menu-heading">Konfigurasi</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('settings*') ? 'active' : '' }}">
                    <a href="{{ route('settings.index') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('help*') ? 'active' : '' }}">
                    <a href="{{ route('help.index') }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/></svg>
                        <span>Help</span>
                    </a>
                </li>
            </ul>
        @endif

        <div class="menu-heading" style="margin-top: 14px; color: #16A34A;">Sisi Pembeli</div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{ url('/pembeli') }}" target="_blank" style="background: rgba(204, 255, 0, 0.08); border: 1px dashed rgba(204, 255, 0, 0.35); color: #CCFF00;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                    <span>Portal Pembeli ↗</span>
                </a>
            </li>
        </ul>
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
                <a href="{{ url('/pembeli') }}" target="_blank" class="btn-consumer-switch" title="Buka Portal Sisi Pembeli & Konsumen">
                    <span class="pulse-indicator"></span>
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                    <span>Sisi Pembeli / Konsumen</span>
                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0; opacity: 0.7;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                </a>

                <div class="store-status-pill">
                    <span class="status-dot-green"></span>
                    <span>Toko Berkah Utama - Online</span>
                </div>

                <!-- NOTIFICATION DROPDOWN -->
                <div style="position: relative;">
                    <button type="button" class="notification-btn" id="btn-toggle-notif" onclick="toggleTopDropdown('dropdown-notif')" title="Notifikasi Peringatan Toko">
                        <span class="notification-badge"></span>
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
                    </button>
                    <div id="dropdown-notif" class="top-dropdown-menu notif-dropdown">
                        <div class="notif-header">
                            <span>Peringatan Operasional AI</span>
                            <span class="notif-badge-count">3 Mendesak</span>
                        </div>
                        <a href="{{ url('/#operational-alerts') }}" class="notif-item">
                            <span class="notif-dot red"></span>
                            <div class="notif-body">
                                <div class="notif-title">Stok Kritis: Kopi Arabika Gayo</div>
                                <div class="notif-desc">Sisa 12 unit (Runway 1.8 hari). AI sarankan restock darurat.</div>
                            </div>
                        </a>
                        <a href="{{ url('/#operational-alerts') }}" class="notif-item">
                            <span class="notif-dot amber"></span>
                            <div class="notif-body">
                                <div class="notif-title">Margin Drop: Sirup Karamel 750ml</div>
                                <div class="notif-desc">HPP supplier naik, margin turun di bawah batas aman 20%.</div>
                            </div>
                        </a>
                        <a href="{{ url('/#operational-alerts') }}" class="notif-item">
                            <span class="notif-dot red"></span>
                            <div class="notif-body">
                                <div class="notif-title">Dead Stock: Paper Cup 8oz</div>
                                <div class="notif-desc">Tidak ada penjualan selama 45 hari. Aktifkan bundling promo.</div>
                            </div>
                        </a>
                        <div class="notif-footer">
                            <a href="{{ route('dashboard') }}">Lihat Semua di Dashboard &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- USER PROFILE DROPDOWN -->
                <div style="position: relative;">
                    <div class="user-profile-badge" id="btn-toggle-user" onclick="toggleTopDropdown('dropdown-user')" title="Menu Profil">
                        <img class="user-avatar" src="{{ $userAvatar }}" alt="{{ $userName }}">
                        <div class="user-info">
                            <div class="user-name">{{ $userName }}</div>
                            <div class="user-role" style="color: {{ $roleBadgeColor }}; font-weight: 700;">{{ $roleLabel }}</div>
                        </div>
                        <svg width="12" height="12" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                    </div>

                    <div id="dropdown-user" class="top-dropdown-menu user-dropdown">
                        <div class="user-dropdown-header">
                            <div class="u-name">{{ $userName }}</div>
                            <div class="u-email">{{ $userEmail }}</div>
                            <div style="margin-top: 6px;">
                                <span style="display: inline-block; font-size: 11px; padding: 2px 8px; border-radius: 999px; background: rgba(255,255,255,0.08); color: {{ $roleBadgeColor }}; font-weight: 700; border: 1px solid rgba(255,255,255,0.12);">
                                    {{ $roleLabel }}
                                </span>
                            </div>
                        </div>

                        @if($userRole === 'owner')
                            <a href="{{ route('settings.index') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                <span>Pengaturan Akun &amp; Toko</span>
                            </a>
                            <a href="{{ route('cashier.dashboard') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0-8.25h19.5m0 0v8.25m0-8.25v-.75a.75.75 0 0 0-.75-.75h-.75m0 0V4.5m-18 0h18"/></svg>
                                <span>Buka Smart POS Kasir</span>
                            </a>
                            <a href="{{ route('inventory_staff.dashboard') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                                <span>Buka Antarmuka Gudang</span>
                            </a>
                        @elseif($userRole === 'staff_cashier')
                            <a href="{{ route('cashier.dashboard') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v8.25m0-8.25h19.5m0 0v8.25m0-8.25v-.75a.75.75 0 0 0-.75-.75h-.75m0 0V4.5m-18 0h18"/></svg>
                                <span>Buka Smart POS Kasir</span>
                            </a>
                            <a href="{{ url('/smart-inventory') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                                <span>Cek Stok Barang</span>
                            </a>
                        @elseif($userRole === 'staff_inventory')
                            <a href="{{ route('inventory_staff.dashboard') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                                <span>Buka Antarmuka Gudang</span>
                            </a>
                            <a href="{{ url('/smart-inventory') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                                <span>Kelola Stok &amp; PO</span>
                            </a>
                            <a href="{{ url('/laris-predict') }}" class="menu-link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/></svg>
                                <span>Prediksi Restock AI</span>
                            </a>
                        @endif

                        <a href="{{ route('help.index') }}" class="menu-link">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/></svg>
                            <span>Pusat Bantuan</span>
                        </a>
                        <a href="{{ url('/pembeli') }}" target="_blank" class="menu-link" style="color: #16A34A; font-weight: 700;">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            <span>Buka Sisi Pembeli (Konsumen) ↗</span>
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
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="content-area">
            @yield('content')
        </main>
    </div>

    <script>
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
    </script>

    @stack('scripts')
</body>
</html>
