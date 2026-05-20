<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN Tirta Jaya - Daftar Akun</title>
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
        
        /* Tambahan style flex biar input dan tombol mata sejajar horizontal tanpa merusak css lama */
        .input-wrapper { position: relative; display: flex; align-items: center; background: #111f2a; border: 1px solid var(--border-color); border-radius: 10px; overflow: hidden; }
        .input-wrapper i.fa-solid, .input-wrapper i.fa-regular:not(.toggle-icon) { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); pointer-events: none; }
        
        /* Form control diatur flex 1 dan border bawaannya dilepas karena dipindah ke wrapper */
        .form-control { flex: 1; padding: 12px 40px 12px 40px; background: transparent; border: none; color: var(--text-primary); outline: none; transition: all 0.2s; height: 100%; }
        
        /* Efek fokus dipindah ke input-wrapper biar estetik */
        .input-wrapper:focus-within { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(59, 195, 189, 0.15); }
        
        /* Style tombol mata ala UI/UX profesional */
        .btn-toggle-password { background: #1b2e3c; border: none; color: var(--primary); padding: 0 15px; height: 45px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; border-left: 1px solid var(--border-color); }
        
        .btn-submit { width: 100%; background: linear-gradient(135deg, var(--primary), var(--primary-dim)); color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.2s; margin-top: 10px; }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(59, 195, 189, 0.3); }
        .auth-footer { text-align: center; margin-top: 24px; font-size: 0.875rem; color: var(--text-muted); }
        .auth-footer a { color: var(--primary); text-decoration: none; font-weight: 500; }
        .alert-error { background: rgba(248, 113, 113, 0.15); border: 1px solid #f87171; color: #f87171; padding: 12px; border-radius: 10px; margin-bottom: 20px; font-size: 0.875rem; font-weight: 500; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="brand">
            <i class="fa-solid fa-book-bookmark"></i>
            <h1>ISBN TIRTA JAYA</h1>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="name" class="form-control" placeholder="Nama lengkap Anda" required value="{{ old('name') }}">
                </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email aktif Anda" required value="{{ old('email') }}">
                </div>
            </div>
            
            <div class="form-group">
                <label>Password (Min. 8 Karakter)</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Buat password baru" required>
                    <button type="button" class="btn-toggle-password" onclick="togglePasswordVisibility('password', this)">
                        <i class="fa-regular fa-eye-slash toggle-icon"></i>
                    </button>
                </div>
            </div>
            
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-shield-halved"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password baru" required>
                    <button type="button" class="btn-toggle-password" onclick="togglePasswordVisibility('password_confirmation', this)">
                        <i class="fa-regular fa-eye-slash toggle-icon"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn-submit">Daftar Akun</button>
        </form>

        <div class="auth-footer">Sudah punya akun? <a href="/auth-login">Masuk ke Sistem</a>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, buttonElement) {
            const passwordInput = document.getElementById(inputId);
            const icon = buttonElement.querySelector('.toggle-icon');
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
                // Berubah jadi warna primer cerah pas melek aktif
                buttonElement.style.background = 'var(--primary)';
                buttonElement.style.color = '#0f1d26';
            } else {
                passwordInput.type = "password";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                // Balikin ke warna redup semula
                buttonElement.style.background = '#1b2e3c';
                buttonElement.style.color = 'var(--primary)';
            }
        }
    </script>
</body>
</html>