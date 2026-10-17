<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - LARIS AI Business Platform</title>
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
            line-height: 1.5;
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
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="auth-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('logo.png') }}" alt="LARIS Logo">
            </a>
        </div>

        <h2 class="auth-title">Pulihkan Sandi</h2>
        <p class="auth-sub">Masukkan email yang terdaftar untuk menerima tautan pemulihan akun usaha Anda.</p>

        @if(session('status'))
            <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid #22C55E; color: #4ADE80; padding: 12px 16px; border-radius: 10px; font-size: 13px; margin-bottom: 20px;">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: rgba(220, 38, 38, 0.2); border: 1px solid #DC2626; color: #F87171; padding: 12px 16px; border-radius: 10px; font-size: 13px; margin-bottom: 20px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Email Terdaftar</label>
                <input type="email" name="email" class="form-input" placeholder="contoh@toko.id" value="{{ old('email') }}" required autofocus>
            </div>

            <button type="submit" class="btn-submit">Kirim Tautan Pemulihan &rarr;</button>
        </form>

        <div class="auth-footer">
            Ingat kata sandi Anda? <a href="{{ route('login') }}">Kembali ke Login</a>
        </div>
    </div>

</body>
</html>
