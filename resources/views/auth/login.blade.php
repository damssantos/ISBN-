<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Masuk</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3BC3BD;
            --primary-bright: #4ce5de;
            --primary-dim: #2E9B96;
            --primary-glow: rgba(59, 195, 189, 0.15);
            --bg-body: #080f14;
            --bg-card: rgba(27, 43, 56, 0.65);
            --border-color: rgba(46, 68, 89, 0.6);
            --border-focus: rgba(59, 195, 189, 0.6);
            --text-primary: #F0F6FA;
            --text-secondary: #B9D1DC;
            --text-muted: #7A9BAA;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: var(--bg-body);
            background-image: 
                radial-gradient(at 0% 0%, rgba(59, 195, 189, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(46, 155, 150, 0.08) 0px, transparent 50%);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            overflow-x: hidden;
            position: relative;
        }

        /* Background Decorative Blur Blobs */
        .ambient-blob-1 {
            position: absolute;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(59, 195, 189, 0.12) 0%, transparent 70%);
            top: 15%;
            left: 10%;
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
            z-index: 0;
            animation: float-blob-1 12s infinite alternate ease-in-out;
        }

        .ambient-blob-2 {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(46, 155, 150, 0.1) 0%, transparent 70%);
            bottom: 10%;
            right: 5%;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 0;
            animation: float-blob-2 15s infinite alternate ease-in-out;
        }

        @keyframes float-blob-1 {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(40px) scale(1.1); }
        }

        @keyframes float-blob-2 {
            0% { transform: translateY(0) scale(1.1); }
            100% { transform: translateY(-45px) scale(0.9); }
        }

        /* Glassmorphism Auth Card */
        .auth-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            animation: card-appear 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .auth-card {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-top: 3px solid var(--primary);
            border-radius: 24px;
            padding: 46px 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(59, 195, 189, 0.05);
            position: relative;
            overflow: hidden;
        }

        .auth-card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 24px;
            background: linear-gradient(135deg, rgba(59, 195, 189, 0.05) 0%, transparent 40%);
            pointer-events: none;
        }

        @keyframes card-appear {
            0% { opacity: 0; transform: translateY(30px) scale(0.97); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Brand / Logo section */
        .brand {
            text-align: center;
            margin-bottom: 36px;
        }

        .logo-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            background: rgba(59, 195, 189, 0.1);
            border: 1px solid rgba(59, 195, 189, 0.3);
            border-radius: 20px;
            margin-bottom: 16px;
            box-shadow: 0 8px 24px rgba(59, 195, 189, 0.15);
            position: relative;
        }

        .logo-container i {
            font-size: 1.8rem;
            color: var(--primary);
            z-index: 2;
        }

        .logo-container::after {
            content: '';
            position: absolute;
            width: 80%;
            height: 80%;
            background: var(--primary);
            filter: blur(15px);
            opacity: 0.25;
            z-index: 1;
        }

        .brand h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .brand p {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-bottom: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i.field-icon {
            position: absolute;
            left: 16px;
            color: var(--text-muted);
            font-size: 1rem;
            transition: color 0.2s;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 14px 44px 14px 46px;
            background: rgba(13, 25, 36, 0.7);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 0.925rem;
            font-weight: 500;
            outline: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control::placeholder {
            color: rgba(122, 155, 170, 0.6);
        }

        .form-control:focus {
            border-color: var(--primary);
            background: rgba(13, 25, 36, 0.95);
            box-shadow: 0 0 0 3px var(--primary-glow);
        }

        .form-control:focus + i.field-icon {
            color: var(--primary);
        }

        /* Password Visibility Toggle */
        .toggle-password {
            position: absolute;
            right: 16px;
            color: var(--text-muted);
            cursor: pointer;
            transition: color 0.2s;
            font-size: 1rem;
            padding: 4px;
            user-select: none;
        }

        .toggle-password:hover {
            color: var(--primary);
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dim));
            color: #080f14;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(59, 195, 189, 0.15);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--primary-bright), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 195, 189, 0.35);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Footer links */
        .auth-footer {
            text-align: center;
            margin-top: 28px;
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
            margin-left: 2px;
        }

        .auth-footer a:hover {
            color: var(--primary-bright);
            text-decoration: underline;
        }

        /* Beautiful Modern Alerts */
        .alert-error {
            background: rgba(248, 113, 113, 0.08);
            border: 1px solid rgba(248, 113, 113, 0.3);
            border-left: 4px solid #f87171;
            color: #fca5a5;
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: alert-shake 0.4s ease;
        }

        .alert-success {
            background: rgba(59, 195, 189, 0.08);
            border: 1px solid rgba(59, 195, 189, 0.3);
            border-left: 4px solid var(--primary);
            color: var(--primary-bright);
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @keyframes alert-shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
        }


    </style>
</head>
<body>
    <!-- Decorative background blobs -->
    <div class="ambient-blob-1"></div>
    <div class="ambient-blob-2"></div>

    <div class="auth-container">
        <div class="auth-card">
            <div class="brand">
                <div class="logo-container">
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
                <h1>ISBN YPIK PAM JAYA</h1>
                <p>Silakan masuk untuk mengakses dashboard Anda</p>
            </div>

            @if (session('status'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf


                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Masukkan email Anda" required value="{{ old('email') }}">
                        <i class="fa-regular fa-envelope field-icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                        <i class="fa-solid fa-lock field-icon"></i>
                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                            <i class="fa-regular fa-eye" id="togglePasswordIcon"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn-submit">
                    <span>Masuk</span>
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>
            </form>

            <div class="auth-footer">
                Belum punya akun? <a href="/auth-register">Daftar Sekarang</a>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('inputPassword');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'fa-regular fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'fa-regular fa-eye';
            }
        }


    </script>
</body>
</html>