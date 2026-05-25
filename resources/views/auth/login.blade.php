<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Masuk</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3BC3BD;
            --primary-dim: #2E9B96;
            --bg-body: #0f1d26;
            --bg-card: #1B2B38;
            --border-color: #2e4459;
            --text-primary: #F0F6FA;
            --text-muted: #7A9BAA;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: var(--bg-body); color: var(--text-primary); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .auth-card { background: var(--bg-card); border: 1px solid var(--border-color); border-top: 3px solid var(--primary); border-radius: 16px; padding: 40px; width: 100%; max-width: 400px; box-shadow: 0 8px 32px rgba(0,0,0,0.3); }
        .brand { text-align: center; margin-bottom: 32px; }
        .brand i { font-size: 2.5rem; color: var(--primary); margin-bottom: 12px; }
        .brand h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-primary); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 0.875rem; color: var(--text-muted); margin-bottom: 8px; font-weight: 500; }
        .input-wrapper { position: relative; }
        .input-wrapper i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size:.875rem; }
        .form-control { width: 100%; padding: 12px 14px 12px 40px; background: #111f2a; border: 1px solid var(--border-color); border-radius: 10px; color: var(--text-primary); outline: none; transition: all 0.2s; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(59, 195, 189, 0.15); }
        .btn-submit { width: 100%; background: linear-gradient(135deg, var(--primary), var(--primary-dim)); color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.2s; margin-top: 10px; }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(59, 195, 189, 0.3); }
        .auth-footer { text-align: center; margin-top: 24px; font-size: 0.875rem; color: var(--text-muted); }
        .auth-footer a { color: var(--primary); text-decoration: none; font-weight: 500; }
        .alert-error { background: rgba(248, 113, 113, 0.15); border: 1px solid #f87171; color: #f87171; padding: 12px; border-radius: 10px; margin-bottom: 20px; font-size: 0.875rem; font-weight: 500; }
        .alert-success { background: rgba(59, 195, 189, 0.15); border: 1px solid var(--primary); color: var(--primary-bright); padding: 12px; border-radius: 10px; margin-bottom: 20px; font-size: 0.875rem; font-weight: 500; text-align: center; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="brand">
            <i class="fa-solid fa-book-bookmark"></i>
            <h1>ISBN YPIK PAM JAYA</h1>
        </div>

        @if (session('status'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required value="{{ old('email') }}">
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                </div>
            </div>
            <button type="submit" class="btn-submit">Masuk</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="/auth-register">Daftar Sekarang</a>
        </div>
    </div>
</body>
</html>