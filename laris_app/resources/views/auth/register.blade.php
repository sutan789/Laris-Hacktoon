<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Toko Baru - LARIS AI Business Platform</title>
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
            background: #080E14 radial-gradient(circle at 50% 0%, rgba(16, 185, 129, 0.12) 0%, transparent 60%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: #FFFFFF;
        }
        .auth-card {
            width: 100%;
            max-width: 480px;
            background: #0F1A24;
            border: 1px solid #1E3347;
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.35);
        }
        .auth-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .auth-logo img {
            height: 40px;
            filter: drop-shadow(0 0 12px rgba(16, 185, 129, 0.45));
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
            margin-bottom: 24px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #CBD5E1;
        }
        .form-input, .form-select {
            width: 100%;
            background: #142332;
            border: 1px solid #1E3347;
            color: #FFFFFF;
            padding: 11px 14px;
            border-radius: 10px;
            font-size: 13px;
            outline: none;
            transition: all 0.2s;
        }
        .form-input:focus, .form-select:focus {
            border-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        .btn-submit {
            width: 100%;
            background: #10B981;
            color: #FFFFFF;
            border: none;
            padding: 13px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
        }
        .btn-submit:hover {
            background: #059669;
            transform: translateY(-1px);
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

        <h2 class="auth-title">Daftar Akun LARIS</h2>
        <p class="auth-sub">Tumbuhkan Bisnis UMKM dengan Kecerdasan Buatan</p>

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-input" placeholder="Juragan Bambang" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Toko/Usaha</label>
                    <input type="text" name="store_name" class="form-input" placeholder="Toko Berkah Utama" value="{{ old('store_name') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Email Usaha</label>
                <input type="email" name="email" class="form-input" placeholder="bambang@berkahutama.id" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Peran Pengguna (Role)</label>
                <select name="role" class="form-select">
                    <option value="owner" selected>Pemilik Toko (Juragan / Akses Eksekutif & AI)</option>
                    <option value="staff_cashier">Kasir Toko (Frontliner / Smart POS)</option>
                    <option value="staff_inventory">Staf Gudang (Logistik & Manajemen Stok)</option>
                    <option value="customer">Pelanggan / Konsumen (Warga Sekitar Toko)</option>
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <div class="form-group">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-input" placeholder="Min. 6 karakter" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi Sandi</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi sandi" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">Daftarkan Toko Sekarang &rarr;</button>
        </form>

        <div class="auth-footer">
            Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>

</body>
</html>
