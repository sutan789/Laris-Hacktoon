<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sisi Pembeli & Konsumen - Toko Berkah Utama | LARIS AI</title>
    
    <!-- Modern Typography & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}?v={{ time() }}">

    <style>
        :root {
            --primary: #0B1215;
            --primary-surface: #162228;
            --accent-lime: #CCFF00;
            --accent-lime-hover: #b8e600;
            --accent-green: #16A34A;
            --accent-green-light: #DCFCE7;
            --bg-page: #F8FAFC;
            --surface-card: #FFFFFF;
            --text-main: #0F172A;
            --text-muted: #64748B;
            --border-light: #E2E8F0;
            --danger: #EF4444;
            --danger-light: #FEE2E2;
            --amber: #F59E0B;
            --amber-light: #FEF3C7;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-page);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* TOP NAVIGATION */
        .consumer-nav {
            background-color: var(--primary);
            color: #FFFFFF;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #1E2D33;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .brand-section {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo {
            height: 32px;
            width: auto;
            filter: drop-shadow(0 0 10px rgba(204, 255, 0, 0.5));
        }

        .nav-store-badge {
            background: #162228;
            border: 1px solid #23343D;
            border-radius: 99px;
            padding: 4px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #E2E8F0;
        }

        .dot-pulse {
            width: 8px;
            height: 8px;
            background: var(--accent-lime);
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 8px var(--accent-lime);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-switch-juragan {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid #334155;
            color: #E2E8F0;
            font-size: 12px;
            font-weight: 600;
            padding: 7px 14px;
            border-radius: 99px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-switch-juragan:hover {
            background: rgba(204, 255, 0, 0.15);
            color: var(--accent-lime);
            border-color: var(--accent-lime);
        }

        /* HERO STORE CARD */
        .store-hero {
            background: linear-gradient(135deg, #0B1215 0%, #162228 100%);
            color: #FFFFFF;
            padding: 32px 20px 40px 20px;
            position: relative;
            overflow: hidden;
        }

        .store-hero::after {
            content: '';
            position: absolute;
            right: -5%;
            bottom: -20%;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(204, 255, 0, 0.12) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 24px;
            position: relative;
            z-index: 2;
        }

        .store-main-info {
            display: flex;
            gap: 18px;
            align-items: center;
        }

        .store-avatar-box {
            width: 72px;
            height: 72px;
            background: #23343D;
            border: 2px solid var(--accent-lime);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            flex-shrink: 0;
        }

        .store-title-h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge-verified {
            background: var(--accent-green);
            color: #FFFFFF;
            font-size: 10px;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 6px;
        }

        .store-meta-p {
            font-size: 13px;
            color: #94A3B8;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .store-meta-p span {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .hero-quick-badges {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .badge-pill-dark {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 8px 14px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            color: #F1F5F9;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge-pill-dark strong {
            color: var(--accent-lime);
        }

        /* MAIN CONTENT CONTAINER */
        .content-container {
            max-width: 1200px;
            margin: -20px auto 40px auto;
            padding: 0 20px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 28px;
            position: relative;
            z-index: 10;
        }

        /* ALERTS */
        .alert-toast-success {
            background: #DCFCE7;
            border: 1px solid #86EFAC;
            color: #15803D;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.1);
        }

        /* FLASH SALE CUCI RAK SECTION */
        .flash-sale-panel {
            background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
            border: 2px solid #FCD34D;
            border-radius: 18px;
            padding: 22px 24px;
            box-shadow: 0 8px 24px rgba(245, 158, 11, 0.12);
            position: relative;
            overflow: hidden;
        }

        .fs-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 18px;
        }

        .fs-title-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .fs-icon-flame {
            font-size: 24px;
            animation: bounce 1.5s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        .fs-main-title {
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: #92400E;
            letter-spacing: -0.3px;
        }

        .fs-sub-desc {
            font-size: 12px;
            color: #B45309;
            margin-top: 2px;
        }

        .fs-countdown-box {
            background: #78350F;
            color: #FFFFFF;
            padding: 6px 14px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: 0.5px;
        }

        .fs-countdown-time {
            font-family: monospace;
            font-size: 14px;
            color: var(--accent-lime);
        }

        .fs-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .fs-card {
            background: #FFFFFF;
            border: 1px solid #FDE68A;
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .fs-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(180, 83, 9, 0.12);
        }

        .fs-card-thumb {
            width: 100%;
            height: 120px;
            object-fit: cover;
            position: relative;
        }

        .fs-badge-discount {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #DC2626;
            color: #FFFFFF;
            font-size: 11px;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 6px;
        }

        .fs-card-body {
            padding: 12px 14px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1;
        }

        .fs-item-name {
            font-size: 13px;
            font-weight: 700;
            color: #0F172A;
            line-height: 1.3;
        }

        .fs-price-row {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-top: 4px;
        }

        .fs-price-now {
            font-size: 15px;
            font-weight: 800;
            color: #DC2626;
        }

        .fs-price-old {
            font-size: 11px;
            color: #94A3B8;
            text-decoration: line-through;
        }

        .fs-reason-tag {
            font-size: 10px;
            color: #64748B;
            background: #F1F5F9;
            padding: 3px 6px;
            border-radius: 4px;
            display: inline-block;
        }

        .fs-card-action {
            padding: 10px 14px 14px 14px;
        }

        .btn-claim-sale {
            width: 100%;
            background: #D97706;
            color: #FFFFFF;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-claim-sale:hover {
            background: #B45309;
        }

        /* STOCK FINDER & CATALOG */
        .catalog-section {
            background: #FFFFFF;
            border: 1px solid var(--border-light);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .catalog-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .cat-title-wrap h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.3px;
        }

        .cat-title-wrap p {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .search-catalog-bar {
            display: flex;
            gap: 10px;
            width: 100%;
            max-width: 480px;
        }

        .search-input-wrap {
            position: relative;
            flex: 1;
        }

        .search-input-wrap svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
        }

        .search-input-wrap input {
            width: 100%;
            background: #F8FAFC;
            border: 1px solid #CBD5E1;
            padding: 10px 14px 10px 38px;
            border-radius: 10px;
            font-size: 13px;
            color: var(--text-main);
            outline: none;
            transition: border-color 0.2s;
        }

        .search-input-wrap input:focus {
            border-color: #0F172A;
            background: #FFFFFF;
        }

        .btn-filter-submit {
            background: var(--primary);
            color: #FFFFFF;
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-filter-submit:hover {
            background: var(--primary-surface);
        }

        /* CATEGORY PILLS */
        .cat-pills-row {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 4px;
            scrollbar-width: none;
        }

        .cat-pills-row::-webkit-scrollbar {
            display: none;
        }

        .cat-pill {
            background: #F1F5F9;
            color: #475569;
            border: 1px solid #E2E8F0;
            padding: 6px 14px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.15s ease;
        }

        .cat-pill:hover, .cat-pill.active {
            background: #0B1215;
            color: #CCFF00;
            border-color: #0B1215;
        }

        /* PRODUCTS GRID */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .prod-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .prod-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        }

        .prod-img-box {
            height: 140px;
            background: #F8FAFC;
            position: relative;
            overflow: hidden;
        }

        .prod-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-stock-status {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 10px;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 6px;
        }

        .stock-ready {
            background: #DCFCE7;
            color: #15803D;
        }

        .stock-low {
            background: #FEF3C7;
            color: #B45309;
        }

        .stock-empty {
            background: #FEE2E2;
            color: #DC2626;
        }

        .prod-content {
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1;
        }

        .prod-cat-sub {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .prod-name {
            font-size: 14px;
            font-weight: 800;
            color: #0F172A;
            line-height: 1.3;
            min-height: 36px;
        }

        .prod-price {
            font-size: 16px;
            font-weight: 800;
            color: #16A34A;
            margin-top: 4px;
        }

        .prod-stock-runway {
            font-size: 11px;
            color: #64748B;
        }

        .prod-actions {
            padding: 0 14px 14px 14px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .btn-qris-sim {
            width: 100%;
            background: #0B1215;
            color: #CCFF00;
            border: 1px solid #1E2D33;
            padding: 8px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.15s ease;
        }

        .btn-qris-sim:hover {
            background: #162228;
            border-color: #CCFF00;
        }

        .btn-preorder-trigger {
            width: 100%;
            background: #F1F5F9;
            color: #334155;
            border: 1px solid #CBD5E1;
            padding: 8px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.15s ease;
        }

        .btn-preorder-trigger:hover {
            background: #E2E8F0;
            color: #0F172A;
        }

        /* GUARANTEED PRE-ORDER (TITIP KULAKAN) SECTION */
        .preorder-banner-panel {
            background: linear-gradient(135deg, #0B1215 0%, #162228 100%);
            color: #FFFFFF;
            border-radius: 18px;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .po-left {
            max-width: 680px;
        }

        .po-tag {
            font-size: 10px;
            font-weight: 800;
            color: var(--accent-lime);
            letter-spacing: 0.8px;
            margin-bottom: 4px;
        }

        .po-title {
            font-family: 'Outfit', sans-serif;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.3px;
        }

        .po-desc {
            font-size: 13px;
            color: #CBD5E1;
            line-height: 1.5;
            margin-top: 6px;
        }

        .btn-lime-lg {
            background-color: var(--accent-lime);
            color: #000000;
            font-weight: 800;
            font-size: 14px;
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.18s ease;
            box-shadow: 0 4px 14px rgba(204, 255, 0, 0.3);
            white-space: nowrap;
        }

        .btn-lime-lg:hover {
            background-color: var(--accent-lime-hover);
            transform: translateY(-1px);
        }

        /* PRE-ORDER HISTORY TABLE */
        .po-history-box {
            background: #FFFFFF;
            border: 1px solid var(--border-light);
            border-radius: 16px;
            padding: 20px;
        }

        .po-hist-title {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .po-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .po-item-row {
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .po-item-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .po-icon-circle {
            width: 36px;
            height: 36px;
            background: #DCFCE7;
            color: #15803D;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .po-item-name {
            font-size: 13px;
            font-weight: 700;
            color: #0F172A;
        }

        .po-cust-meta {
            font-size: 11px;
            color: #64748B;
        }

        .po-badge-status {
            background: #FEF3C7;
            color: #B45309;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
        }

        /* MODAL STYLES */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(11, 18, 21, 0.7);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999;
            padding: 20px;
        }

        .modal-box {
            background: #FFFFFF;
            border-radius: 18px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            animation: modalFade 0.2s ease-out;
        }

        @keyframes modalFade {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-top {
            padding: 18px 22px;
            background: #F8FAFC;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-top h3 {
            font-size: 16px;
            font-weight: 800;
        }

        .btn-close-modal {
            background: none;
            border: none;
            font-size: 22px;
            cursor: pointer;
            color: #64748B;
        }

        .modal-content-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .modal-form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .modal-form-group label {
            font-size: 12px;
            font-weight: 700;
            color: #334155;
        }

        .modal-form-group input, .modal-form-group textarea {
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 9px 12px;
            font-size: 13px;
            color: #0F172A;
            font-family: inherit;
        }

        .modal-bottom {
            padding: 16px 22px;
            background: #F8FAFC;
            border-top: 1px solid #E2E8F0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-cancel {
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        /* QRIS MODAL */
        .qris-card-preview {
            background: #FFFFFF;
            border: 2px dashed #CBD5E1;
            border-radius: 14px;
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .qris-merchant-title {
            font-size: 15px;
            font-weight: 800;
            color: #0F172A;
        }

        .qris-img-dummy {
            width: 180px;
            height: 180px;
            background: #F1F5F9;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 12px;
        }

        /* FOOTER */
        .consumer-footer {
            margin-top: auto;
            background: #0B1215;
            color: #94A3B8;
            padding: 30px 20px;
            border-top: 1px solid #1E2D33;
            font-size: 12px;
            text-align: center;
        }

        .consumer-footer a {
            color: var(--accent-lime);
            text-decoration: none;
            font-weight: 600;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .fs-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .fs-grid {
                grid-template-columns: 1fr;
            }
            .products-grid {
                grid-template-columns: 1fr;
            }
            .store-hero {
                padding: 24px 16px 32px 16px;
            }
            .store-main-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .search-catalog-bar {
                flex-direction: column;
            }
            .preorder-banner-panel {
                flex-direction: column;
                align-items: flex-start;
            }
            .btn-lime-lg {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <!-- TOP NAVIGATION -->
    <nav class="consumer-nav">
        <div class="nav-inner">
            <a href="{{ url('/pembeli') }}" class="brand-section">
                <img src="{{ asset('logo.png') }}?v={{ time() }}" alt="LARIS" class="brand-logo">
                <span style="font-size: 11px; font-weight: 800; color: var(--accent-lime); letter-spacing: 0.5px;">SISI PEMBELI</span>
            </a>

            <div class="nav-store-badge">
                <span class="dot-pulse"></span>
                <span>Radius 400m dari lokasimu • Buka s.d. 22:00</span>
            </div>

            <div class="nav-actions">
                <a href="{{ url('/') }}" class="btn-switch-juragan" title="Buka Dashboard Pemilik Usaha">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                    <span>Mode Juragan (Pemilik Toko)</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- STORE HERO -->
    <header class="store-hero">
        <div class="hero-inner">
            <div class="store-main-info">
                <div class="store-avatar-box">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.651h.008v.008H6.75v-.008Zm0 3h.008v.008H6.75v-.008Zm0 3h.008v.008H6.75v-.008Z"/></svg>
                </div>
                <div>
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 2px;">
                        <h1 class="store-title-h1">{{ $store->name ?? 'Toko Berkah Utama' }}</h1>
                        <span class="badge-verified">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            <span>Terverifikasi LARIS</span>
                        </span>
                    </div>
                    <div class="store-meta-p">
                        <span style="display: inline-flex; align-items: center; gap: 4px;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                            {{ $store->address ?? 'Jl. Braga No. 45, Bandung, Jawa Barat' }}
                        </span>
                        <span style="display: inline-flex; align-items: center; gap: 4px;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            {{ $store->operating_hours ?? '08:00 - 22:00 WIB' }}
                        </span>
                        <span style="display: inline-flex; align-items: center; gap: 4px;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                            {{ $store->phone ?? '0812-3456-7890' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="hero-quick-badges">
                <div class="badge-pill-dark">
                    <span style="display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/></svg>
                        Pembayaran:
                    </span>
                    <strong>QRIS &amp; Tunai</strong>
                </div>
                <div class="badge-pill-dark">
                    <span style="display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                        Garansi Stok:
                    </span>
                    <strong>Real-time AI Sync</strong>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="content-container">

        <!-- NOTIFICATION TOASTS -->
        @if(session('success_preorder'))
            <div class="alert-toast-success">
                <span>{{ session('success_preorder') }}</span>
                <button onclick="this.parentElement.remove()" style="background:none; border:none; font-size:18px; cursor:pointer; color:#15803D;">&times;</button>
            </div>
        @endif

        @if(session('success_coupon'))
            <div style="background: #FEF3C7; border: 1px solid #FCD34D; color: #92400E; padding: 14px 18px; border-radius: 12px; font-size: 13px; font-weight: 600; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="16" height="16" fill="none" stroke="#D97706" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/></svg>
                    <div>
                        <strong>{{ session('success_coupon')['item'] }}:</strong>
                        <span>{{ session('success_coupon')['message'] }}</span>
                    </div>
                </div>
                <button onclick="this.parentElement.remove()" style="background:none; border:none; font-size:18px; cursor:pointer; color:#92400E;">&times;</button>
            </div>
        @endif

        <!-- 1. FLASH SALE CUCI RAK JAM 7 MALAM (ANTI-BASI) -->
        <section class="flash-sale-panel" id="cuci-rak-section">
            <div class="fs-header">
                <div class="fs-title-box">
                    <span class="fs-icon-flame">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z"/></svg>
                    </span>
                    <div>
                        <h3 class="fs-main-title">Flash Sale Cuci Rak Jam 7 Malam (Anti-Basi)</h3>
                        <p class="fs-sub-desc">Diskon kilat 30% - 50% untuk produk roti, susu segar &amp; buah siap santap sebelum toko tutup. Hemat belanja warga, bebas buang makanan!</p>
                    </div>
                </div>

                <div class="fs-countdown-box">
                    <span>CUCI RAK BERAKHIR:</span>
                    <span class="fs-countdown-time" id="fs-timer">01 : 14 : 20</span>
                </div>
            </div>

            <div class="fs-grid">
                @foreach($flashSaleItems as $fs)
                    <div class="fs-card">
                        <div style="position: relative;">
                            <img src="{{ $fs['image'] }}" alt="{{ $fs['name'] }}" class="fs-card-thumb">
                            <span class="fs-badge-discount">-{{ $fs['discount_pct'] }}% OFF</span>
                        </div>
                        <div class="fs-card-body">
                            <h4 class="fs-item-name">{{ $fs['name'] }}</h4>
                            <div class="fs-price-row">
                                <span class="fs-price-now">Rp {{ number_format($fs['discount_price'], 0, ',', '.') }}</span>
                                <span class="fs-price-old">Rp {{ number_format($fs['original_price'], 0, ',', '.') }}</span>
                            </div>
                            <span class="fs-reason-tag">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.516 0c.85.493 1.508 1.333 1.508 2.316V18"/></svg>
                                {{ $fs['reason'] }}
                            </span>
                            <div style="font-size: 11px; color: #DC2626; font-weight: 700; margin-top: 4px; display: flex; align-items: center; gap: 4px;">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                                Sisa {{ $fs['stock_left'] }} {{ $fs['unit'] }} di rak toko
                            </div>
                        </div>
                        <div class="fs-card-action">
                            <form action="{{ route('consumer.claim_flash_sale') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_name" value="{{ $fs['name'] }}">
                                <button type="submit" class="btn-claim-sale">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/></svg>
                                    <span>Klaim Kupon Diskon</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 2. LARIS NEARBY STOCK FINDER (KATALOG LOKAL) -->
        <section class="catalog-section" id="katalog-stok">
            <div class="catalog-header">
                <div class="cat-title-wrap">
                    <h2>Katalog Stok Real-Time</h2>
                    <p>Cek ketersediaan sembako &amp; kebutuhan harian di Toko Berkah Utama secara langsung tanpa perlu datang bolak-balik.</p>
                </div>

                <form action="{{ url('/pembeli') }}" method="GET" class="search-catalog-bar">
                    <div class="search-input-wrap">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang, beras, kopi, indomie...">
                    </div>
                    <button type="submit" class="btn-filter-submit">Cari Stok</button>
                </form>
            </div>

            <!-- CATEGORY PILLS -->
            <div class="cat-pills-row">
                <a href="{{ url('/pembeli') }}" class="cat-pill {{ !request('category') || request('category') == 'all' ? 'active' : '' }}">Semua Produk</a>
                @foreach($categories as $cat)
                    <a href="{{ url('/pembeli') }}?category={{ urlencode($cat) }}" class="cat-pill {{ request('category') == $cat ? 'active' : '' }}">{{ $cat }}</a>
                @endforeach
            </div>

            <!-- PRODUCT GRID -->
            <div class="products-grid">
                @forelse($products as $prod)
                    @php
                        $isOut = $prod->current_stock <= 0;
                        $isLow = $prod->current_stock > 0 && $prod->current_stock <= 20;
                    @endphp
                    <div class="prod-card">
                        <div class="prod-img-box">
                            <img src="{{ $prod->image_url ?? 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=200&auto=format&fit=crop&q=80' }}" alt="{{ $prod->name }}" class="prod-img">
                            @if($isOut)
                                <span class="badge-stock-status stock-empty">Stok Habis</span>
                            @elseif($isLow)
                                <span class="badge-stock-status stock-low">Sisa {{ $prod->current_stock }} {{ $prod->unit ?? 'Unit' }}</span>
                            @else
                                <span class="badge-stock-status stock-ready">Ready ({{ $prod->current_stock }} {{ $prod->unit ?? 'Unit' }})</span>
                            @endif
                        </div>

                        <div class="prod-content">
                            <span class="prod-cat-sub">{{ $prod->category }}</span>
                            <h4 class="prod-name">{{ $prod->name }}</h4>
                            <div class="prod-price">Rp {{ number_format($prod->selling_price, 0, ',', '.') }}</div>
                            <div class="prod-stock-runway">
                                @if($isOut)
                                    <span style="color: #DC2626; font-weight: 600;">Stok habis di rak toko</span>
                                @else
                                    <span>Laju laku: {{ $prod->ai_velocity }} unit/hari</span>
                                @endif
                            </div>
                        </div>

                        <div class="prod-actions">
                            @if(!$isOut)
                                <button type="button" class="btn-qris-sim" onclick="openQrisModal('{{ addslashes($prod->name) }}', {{ $prod->selling_price }})">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"/></svg>
                                    <span>Beli &amp; Scan QRIS</span>
                                </button>
                            @else
                                <button type="button" class="btn-preorder-trigger" onclick="openPreOrderModal('{{ addslashes($prod->name) }}')">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                    <span>Titip Kulakan ke Juragan</span>
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748B;">
                        Tidak ada produk yang cocok dengan pencarian Anda. Butuh barang ini? 
                        <a href="javascript:void(0)" onclick="openPreOrderModal('{{ request('search') }}')" style="color: #16A34A; font-weight: 700;">Titip kulakan ke Juragan sekarang &rarr;</a>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- 3. GUARANTEED PRE-ORDER (TITIP KULAKAN) -->
        <section class="preorder-banner-panel" id="titip-kulakan-section">
            <div class="po-left">
                <div class="po-tag">DEMAND AGGREGATOR • ZERO RISK PRE-ORDER</div>
                <h3 class="po-title">Barang Habis? Titip Kulakan ke Juragan Toko!</h3>
                <p class="po-desc">
                    Jika produk yang Anda cari sedang habis, catat pesanan Anda di sini. Juragan akan membelanjakannya saat kulakan ke pasar induk &amp; distributor besok pagi pukul 06.00 WIB tanpa biaya tambahan. Anda tinggal ambil saat barang tiba!
                </p>
            </div>
            <div>
                <button type="button" class="btn-lime-lg" onclick="openPreOrderModal('')">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    <span>+ Titip Pesanan Kulakan Baru</span>
                </button>
            </div>
        </section>

        <!-- PRE-ORDER ACTIVE QUEUE -->
        <div class="po-history-box">
            <h4 class="po-hist-title">
                <span style="display: inline-flex; align-items: center; gap: 6px;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/></svg>
                    Antrean Titip Kulakan Warga Terkini
                </span>
                <span style="font-size: 11px; background: #DCFCE7; color: #15803D; padding: 2px 8px; border-radius: 99px; font-weight: 700;">Auto-Sync ke HP Juragan</span>
            </h4>
            <div class="po-list">
                @foreach($preOrders as $po)
                    <div class="po-item-row">
                        <div class="po-item-left">
                            <div class="po-icon-circle">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                            </div>
                            <div>
                                <div class="po-item-name">{{ $po['item_name'] }} ({{ $po['quantity'] }} pcs)</div>
                                <div class="po-cust-meta">Pemesan: {{ $po['customer_name'] }} ({{ $po['phone'] }}) • {{ $po['time'] }}</div>
                            </div>
                        </div>
                        <span class="po-badge-status">{{ $po['status'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="consumer-footer">
        <p>&copy; 2026 LARIS - AI Business Intelligence &amp; Decision Platform for MSMEs. Meukarya Team.</p>
        <p style="margin-top: 6px;">Menghubungkan Warung Tetangga dengan Konsumen Sekitar demi Ekosistem Ekonomi yang Berkeadilan.</p>
    </footer>

    <!-- MODAL FORM TITIP KULAKAN (PRE-ORDER) -->
    <div id="modal-preorder" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-top">
                <h3>Form Titip Kulakan ke Juragan</h3>
                <button type="button" class="btn-close-modal" onclick="closePreOrderModal()">&times;</button>
            </div>
            <form action="{{ route('consumer.pre_order') }}" method="POST">
                @csrf
                <div class="modal-content-body">
                    <p style="font-size: 12px; color: #64748B; line-height: 1.4;">
                        Pesanan ini akan otomatis masuk ke daftar belanja kulakan Juragan Toko Berkah Utama untuk dibeli besok pagi.
                    </p>
                    <div class="modal-form-group">
                        <label>Nama Anda</label>
                        <input type="text" name="customer_name" placeholder="Misal: Bu Siti / Pak RT Joko" required>
                    </div>
                    <div class="modal-form-group">
                        <label>Nomor WhatsApp (Untuk Notifikasi saat Barang Datang)</label>
                        <input type="text" name="phone" placeholder="081234567890" required>
                    </div>
                    <div class="modal-form-group">
                        <label>Nama Barang yang Ingin Dititipkan</label>
                        <input type="text" name="item_name" id="preorder-item-name" placeholder="Misal: Minyak Bimoli 2L / Beras Ramos 5kg" required>
                    </div>
                    <div class="modal-form-group">
                        <label>Jumlah Unit</label>
                        <input type="number" name="quantity" value="1" min="1" max="50" required>
                    </div>
                    <div class="modal-form-group">
                        <label>Catatan Tambahan (Merk/Ukuran Khusus)</label>
                        <textarea name="notes" rows="2" placeholder="Contoh: Kalau Bimoli habis, ganti Sania tidak apa-apa"></textarea>
                    </div>
                </div>
                <div class="modal-bottom">
                    <button type="button" class="btn-cancel" onclick="closePreOrderModal()">Batal</button>
                    <button type="submit" class="btn-filter-submit" style="background: #16A34A;">Kirim ke Juragan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL SCAN QRIS SIMULATION -->
    <div id="modal-qris" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-top">
                <h3>Pembayaran Instan QRIS LARIS</h3>
                <button type="button" class="btn-close-modal" onclick="closeQrisModal()">&times;</button>
            </div>
            <div class="modal-content-body">
                <div class="qris-card-preview">
                    <div style="font-size: 11px; font-weight: 800; color: #64748B; letter-spacing: 0.5px;">STANDAR QRIS NASIONAL (NMID: ID1029384756)</div>
                    <h4 class="qris-merchant-title">{{ $store->name ?? 'Toko Berkah Utama' }}</h4>
                    
                    <!-- SVG QR Code Generator Representation -->
                    <div class="qris-img-dummy">
                        <svg width="140" height="140" viewBox="0 0 100 100" fill="#0F172A">
                            <rect x="5" y="5" width="25" height="25" fill="#0F172A"/>
                            <rect x="10" y="10" width="15" height="15" fill="#FFFFFF"/>
                            <rect x="13" y="13" width="9" height="9" fill="#0F172A"/>
                            <rect x="70" y="5" width="25" height="25" fill="#0F172A"/>
                            <rect x="75" y="10" width="15" height="15" fill="#FFFFFF"/>
                            <rect x="78" y="13" width="9" height="9" fill="#0F172A"/>
                            <rect x="5" y="70" width="25" height="25" fill="#0F172A"/>
                            <rect x="10" y="75" width="15" height="15" fill="#FFFFFF"/>
                            <rect x="13" y="78" width="9" height="9" fill="#0F172A"/>
                            <!-- Random Pattern Blocks -->
                            <rect x="35" y="10" width="10" height="10"/>
                            <rect x="50" y="15" width="12" height="6"/>
                            <rect x="35" y="35" width="30" height="30"/>
                            <rect x="42" y="42" width="16" height="16" fill="#FFFFFF"/>
                            <rect x="45" y="45" width="10" height="10" fill="#CCFF00"/>
                            <rect x="70" y="35" width="8" height="18"/>
                            <rect x="80" y="45" width="15" height="10"/>
                            <rect x="35" y="75" width="15" height="15"/>
                            <rect x="55" y="70" width="20" height="8"/>
                            <rect x="80" y="75" width="15" height="15"/>
                        </svg>
                        <span style="font-size: 10px; font-weight: 800; color: #16A34A;">BCA • GoPay • OVO • Dana • ShopeePay</span>
                    </div>

                    <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 10px; width: 100%;">
                        <div style="display: flex; justify-content: space-between; font-size: 12px;">
                            <span style="color: #64748B;">Produk:</span>
                            <strong id="qris-item-label">-</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 14px; margin-top: 4px;">
                            <span style="color: #64748B;">Total Tagihan:</span>
                            <strong id="qris-price-label" style="color: #16A34A; font-size: 16px;">Rp 0</strong>
                        </div>
                    </div>

                    <div style="background: #DCFCE7; color: #15803D; font-size: 11px; font-weight: 700; padding: 6px 12px; border-radius: 6px; display: flex; align-items: center; gap: 6px;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/></svg>
                        <span>Kupon Diskon Tetangga Rp 2.500 Otomatis Terpasang!</span>
                    </div>
                </div>
            </div>
            <div class="modal-bottom">
                <button type="button" class="btn-cancel" onclick="closeQrisModal()">Tutup</button>
                <button type="button" class="btn-filter-submit" style="background: #0B1215; color: #CCFF00; display: inline-flex; align-items: center; gap: 6px;" onclick="simulateQrisSuccess()">
                    <span>Simulasikan Pembayaran Selesai</span>
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        // FLASH SALE CUCI RAK COUNTDOWN TIMER
        let fsSeconds = 4460;
        function updateFsTimer() {
            const h = Math.floor(fsSeconds / 3600);
            const m = Math.floor((fsSeconds % 3600) / 60);
            const s = fsSeconds % 60;
            const timerEl = document.getElementById('fs-timer');
            if (timerEl) {
                timerEl.textContent = 
                    String(h).padStart(2, '0') + ' : ' + 
                    String(m).padStart(2, '0') + ' : ' + 
                    String(s).padStart(2, '0');
            }
            if (fsSeconds > 0) fsSeconds--;
        }
        setInterval(updateFsTimer, 1000);
        updateFsTimer();

        // PRE-ORDER MODAL
        function openPreOrderModal(itemName) {
            document.getElementById('preorder-item-name').value = itemName || '';
            document.getElementById('modal-preorder').style.display = 'flex';
        }

        function closePreOrderModal() {
            document.getElementById('modal-preorder').style.display = 'none';
        }

        // QRIS MODAL
        function openQrisModal(itemName, price) {
            document.getElementById('qris-item-label').textContent = itemName;
            document.getElementById('qris-price-label').textContent = 'Rp ' + Number(price).toLocaleString('id-ID');
            document.getElementById('modal-qris').style.display = 'flex';
        }

        function closeQrisModal() {
            document.getElementById('modal-qris').style.display = 'none';
        }

        function simulateQrisSuccess() {
            closeQrisModal();
            alert('Pembayaran QRIS Sukses Terverifikasi! Struk transaksi telah dikirimkan ke mesin kasir Toko Berkah Utama.');
        }

        // Close on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePreOrderModal();
                closeQrisModal();
            }
        });
    </script>
</body>
</html>
