<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - LARIS AI Business Platform</title>
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #080E14;
            --accent-brand: #10B981;
            --accent-brand-hover: #059669;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #080E14;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: #FFFFFF;
            position: relative;
            overflow-x: hidden;
        }

        /* Video Background & Dynamic Topographic Signals */
        .video-background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        .bg-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            filter: brightness(0.62) contrast(1.2) saturate(1.15);
        }
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(8, 14, 20, 0.45) 0%, rgba(4, 7, 10, 0.85) 100%),
                        linear-gradient(180deg, rgba(8, 14, 20, 0.3) 0%, rgba(8, 14, 20, 0.85) 100%);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
        }

        /* Glassmorphism Auth Card */
        .auth-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            background: rgba(15, 26, 36, 0.82);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 24px;
            padding: 38px 34px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6), inset 0 1px 1px rgba(255, 255, 255, 0.15);
            animation: fadeInCard 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeInCard {
            from {
                opacity: 0;
                transform: translateY(14px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .ambient-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(16, 185, 129, 0.14);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34D399;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 9999px;
            margin-bottom: 14px;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15);
        }
        .pulse-dot {
            width: 6px;
            height: 6px;
            background: #10B981;
            border-radius: 50%;
            box-shadow: 0 0 8px #10B981;
            animation: pulseGlow 2s infinite ease-in-out;
        }
        @keyframes pulseGlow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(0.8); }
        }

        .auth-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        .auth-logo img {
            height: 44px;
            filter: drop-shadow(0 0 14px rgba(16, 185, 129, 0.45));
        }
        .auth-title {
            font-size: 22px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 6px;
            color: #FFFFFF;
            letter-spacing: -0.02em;
        }
        .auth-sub {
            font-size: 13px;
            color: #94A3B8;
            text-align: center;
            margin-bottom: 26px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #CBD5E1;
        }
        .form-input {
            width: 100%;
            background: rgba(20, 35, 50, 0.75);
            border: 1px solid rgba(30, 51, 71, 0.85);
            color: #FFFFFF;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
            backdrop-filter: blur(8px);
        }
        .form-input:focus {
            background: rgba(20, 35, 50, 0.95);
            border-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25);
        }
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: #FFFFFF;
            border: none;
            padding: 13px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.35);
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.45);
        }
        .quick-accounts {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(30, 51, 71, 0.6);
        }
        .qa-title {
            font-size: 11px;
            color: #64748B;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 10px;
            text-align: center;
            letter-spacing: 0.5px;
        }
        .qa-chips {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .qa-btn {
            background: rgba(22, 36, 43, 0.75);
            border: 1px solid rgba(36, 53, 62, 0.85);
            color: #94A3B8;
            font-size: 11px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.15s;
            backdrop-filter: blur(8px);
        }
        .qa-btn:hover {
            color: #FFFFFF;
            border-color: #10B981;
            background: rgba(16, 185, 129, 0.15);
        }
        .auth-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
            color: #94A3B8;
        }
        .auth-footer a {
            color: #10B981;
            text-decoration: none;
            font-weight: 700;
        }
        .auth-footer a:hover {
            text-decoration: underline;
        }
        .alert-error {
            background: rgba(220, 38, 38, 0.2);
            border: 1px solid #DC2626;
            color: #F87171;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>

    <!-- VIDEO BACKGROUND CONTAINER -->
    <div class="video-background-container">
        <video class="bg-video" autoplay loop muted playsinline preload="auto">
            <source src="{{ asset('videos/login_bg.mp4') }}" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    </div>

    <div class="auth-card">
        <div class="auth-logo">
            <div class="ambient-badge">
                <span class="pulse-dot"></span>
                <span>Dynamic Topographic Signals &bull; Live</span>
            </div>
            <a href="{{ url('/') }}">
                <img src="{{ asset('logo.png') }}" alt="LARIS Logo">
            </a>
        </div>

        <h2 class="auth-title">Masuk ke LARIS</h2>
        <p class="auth-sub">AI Business Intelligence Platform for UMKM</p>

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('info'))
            <div style="background: rgba(56, 189, 248, 0.15); border: 1px solid rgba(56, 189, 248, 0.4); color: #7DD3FC; padding: 10px 14px; border-radius: 8px; font-size: 12px; margin-bottom: 18px; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        @if(session('warning'))
            <div style="background: rgba(245, 158, 11, 0.18); border: 1px solid rgba(245, 158, 11, 0.5); color: #FDE68A; padding: 10px 14px; border-radius: 8px; font-size: 12px; margin-bottom: 18px; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ session('warning') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid #22C55E; color: #4ADE80; padding: 10px 14px; border-radius: 8px; font-size: 12px; margin-bottom: 18px; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" id="form-login">
            @csrf
            <div class="form-group">
                <label class="form-label">Email Usaha</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="contoh@toko.id" value="{{ old('email', 'juragan@laris.id') }}" required autofocus>
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                    <label class="form-label" style="margin: 0;">Kata Sandi</label>
                    <a href="{{ route('password.request') }}" style="color: var(--accent-lime); font-size: 12px; text-decoration: none;">Lupa Sandi?</a>
                </div>
                <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" value="password123" required>
            </div>

            <button type="submit" class="btn-submit" id="btn-submit-login">Masuk ke Dashboard &rarr;</button>
        </form>

        <!-- PINTASAN AKUN DEMO (4 ROLE RESMI) -->
        <div class="quick-accounts">
            <div class="qa-title">Pilih Akun Demo (4 Role Platform)</div>
            <div class="qa-chips">
                <button type="button" class="qa-btn" id="qa-superadmin" onclick="fillAccount('superadmin@laris.id', 'super_admin', this)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -2px; margin-right: 4px;"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    <span>Super Admin</span>
                </button>
                <button type="button" class="qa-btn" id="qa-owner" onclick="fillAccount('juragan@laris.id', 'owner', this)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -2px; margin-right: 4px;"><path d="M2 4l3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14"/></svg>
                    <span>Juragan (Owner)</span>
                </button>
                <button type="button" class="qa-btn" id="qa-cashier" onclick="fillAccount('kasir@laris.id', 'cashier', this)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -2px; margin-right: 4px;"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                    <span>Kasir Toko</span>
                </button>
                <button type="button" class="qa-btn" id="qa-inventory" onclick="fillAccount('gudang@laris.id', 'inventory', this)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -2px; margin-right: 4px;"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                    <span>Staf Gudang</span>
                </button>
                <button type="button" class="qa-btn" id="qa-user" onclick="fillAccount('user@laris.id', 'user', this)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -2px; margin-right: 4px;"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span>User (Pembeli)</span>
                </button>
            </div>
            <div id="qa-hint" style="font-size: 11px; color: #94A3B8; text-align: center; margin-top: 10px;">
                Login sebagai <strong>Owner Toko</strong> &rarr; Masuk ke Business Dashboard &amp; Prediksi AI
            </div>
        </div>

        <div class="auth-footer">
            Belum punya akun toko? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>

    <script>
        const hints = {
            'super_admin': 'Login sebagai <strong>Super Administrator Platform</strong> &rarr; Kontrol Semua Gerai UMKM, GMV &amp; Manajemen Pengguna',
            'owner': 'Login sebagai <strong>Owner Toko (Juragan)</strong> &rarr; Masuk ke Business Dashboard, LARIS Predict, Trend Hunter &amp; Juragan AI',
            'cashier': 'Login sebagai <strong>Kasir Toko (Smart POS)</strong> &rarr; Masuk langsung ke Antarmuka POS, QRIS &amp; Kasbon',
            'inventory': 'Login sebagai <strong>Staf Gudang</strong> &rarr; Masuk ke Monitoring Stok &amp; PO Supplier',
            'user': 'Login sebagai <strong>User / Pembeli (Gojek Marketplace)</strong> &rarr; Belanja Semua Gerai UMKM, Pesan Antar / Pickup &amp; Kupon Diskon',
            'customer': 'Login sebagai <strong>User / Pembeli</strong> &rarr; Belanja Semua Gerai UMKM &amp; Flash Sale Cuci Gudang'
        };

        function fillAccount(email, role, btnEl) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = 'password123';
            
            document.querySelectorAll('.qa-btn').forEach(b => {
                b.style.borderColor = '#24353E';
                b.style.color = '#94A3B8';
                b.style.background = '#16242B';
            });

            if (btnEl) {
                btnEl.style.borderColor = '#10B981';
                btnEl.style.color = '#FFFFFF';
                btnEl.style.background = '#10B981';
            }

            const hintEl = document.getElementById('qa-hint');
            if (hintEl && hints[role]) {
                hintEl.innerHTML = hints[role];
            }
        }

        // Initialize active state for default email
        window.addEventListener('DOMContentLoaded', () => {
            const currentEmail = document.getElementById('email').value;
            if (currentEmail === 'superadmin@laris.id') {
                fillAccount('superadmin@laris.id', 'super_admin', document.getElementById('qa-superadmin'));
            } else if (currentEmail === 'kasir@laris.id') {
                fillAccount('kasir@laris.id', 'cashier', document.getElementById('qa-cashier'));
            } else if (currentEmail === 'user@laris.id') {
                fillAccount('user@laris.id', 'user', document.getElementById('qa-user'));
            } else {
                fillAccount('juragan@laris.id', 'owner', document.getElementById('qa-owner'));
            }
        });
    </script>

    @include('partials.laris_alert')
</body>
</html>
