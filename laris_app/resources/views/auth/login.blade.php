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
            --bg-dark: #0B1215;
            --accent-lime: #CCFF00;
            --accent-lime-hover: #B4F000;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #080D0F radial-gradient(circle at 50% 0%, rgba(204, 255, 0, 0.12) 0%, transparent 60%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: #FFFFFF;
        }
        .auth-card {
            width: 100%;
            max-width: 440px;
            background: #0E161A;
            border: 1px solid #1E2D33;
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.45);
        }
        .auth-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 24px;
        }
        .auth-logo img {
            height: 42px;
            filter: drop-shadow(0 0 12px rgba(204, 255, 0, 0.5));
        }
        .auth-title {
            font-size: 22px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 6px;
        }
        .auth-sub {
            font-size: 13px;
            color: #94A3B8;
            text-align: center;
            margin-bottom: 28px;
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
            background: #141E24;
            border: 1px solid #24353E;
            color: #FFFFFF;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }
        .form-input:focus {
            border-color: var(--accent-lime);
            box-shadow: 0 0 0 3px rgba(204, 255, 0, 0.2);
        }
        .btn-submit {
            width: 100%;
            background: var(--accent-lime);
            color: #000000;
            border: none;
            padding: 13px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background: var(--accent-lime-hover);
            transform: translateY(-1px);
        }
        .quick-accounts {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #1E2D33;
        }
        .qa-title {
            font-size: 11px;
            color: #64748B;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 10px;
            text-align: center;
        }
        .qa-chips {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .qa-btn {
            background: #16242B;
            border: 1px solid #24353E;
            color: #94A3B8;
            font-size: 11px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.15s;
        }
        .qa-btn:hover {
            color: #FFFFFF;
            border-color: var(--accent-lime);
        }
        .auth-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
            color: #94A3B8;
        }
        .auth-footer a {
            color: var(--accent-lime);
            text-decoration: none;
            font-weight: 600;
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

    <div class="auth-card">
        <div class="auth-logo">
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

        <!-- PINTASAN AKUN DEMO -->
        <div class="quick-accounts">
            <div class="qa-title">Pilih Akun Demo Cepat</div>
            <div class="qa-chips">
                <button type="button" class="qa-btn" id="qa-owner" onclick="fillAccount('juragan@laris.id', 'owner', this)">👑 Juragan (Owner)</button>
                <button type="button" class="qa-btn" id="qa-cashier" onclick="fillAccount('kasir@laris.id', 'cashier', this)">🛒 Kasir Toko</button>
                <button type="button" class="qa-btn" id="qa-inventory" onclick="fillAccount('gudang@laris.id', 'inventory', this)">📦 Staf Gudang</button>
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
            'owner': 'Login sebagai <strong>Owner Toko (Juragan)</strong> &rarr; Masuk ke Business Dashboard &amp; Prediksi AI',
            'cashier': 'Login sebagai <strong>Kasir Toko (Smart POS)</strong> &rarr; Masuk langsung ke Antarmuka POS &amp; Kasbon',
            'inventory': 'Login sebagai <strong>Staf Logistik/Gudang</strong> &rarr; Masuk langsung ke Monitoring Stok &amp; PO Supplier'
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
                btnEl.style.borderColor = '#CCFF00';
                btnEl.style.color = '#000000';
                btnEl.style.background = '#CCFF00';
            }

            const hintEl = document.getElementById('qa-hint');
            if (hintEl && hints[role]) {
                hintEl.innerHTML = hints[role];
            }
        }

        // Initialize active state for default email
        window.addEventListener('DOMContentLoaded', () => {
            const currentEmail = document.getElementById('email').value;
            if (currentEmail === 'kasir@laris.id') {
                fillAccount('kasir@laris.id', 'cashier', document.getElementById('qa-cashier'));
            } else if (currentEmail === 'gudang@laris.id') {
                fillAccount('gudang@laris.id', 'inventory', document.getElementById('qa-inventory'));
            } else {
                fillAccount('juragan@laris.id', 'owner', document.getElementById('qa-owner'));
            }
        });
    </script>
</body>
</html>
