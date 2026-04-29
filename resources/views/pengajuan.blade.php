<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN Tirta Jaya - Pengajuan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #2dd4bf;
            --primary-bright: #5eead4;
            --primary-dim: #14b8a6;
            --accent: #99f6e4;

            --bg-body: #0c1513;
            --bg-sidebar: #081210;
            --bg-card: #1a2f2a;
            --bg-card-hover: #243d36;
            --bg-input: #1a2f2a;
            --bg-elevated: #243d36;

            --border-color: #2a4a42;
            --border-light: #223d36;

            --text-primary: #f0fdf9;
            --text-secondary: #a7d7cd;
            --text-muted: #5f9b8e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
            font-size: 14px;
            line-height: 1.5;
        }

        .sidebar {
            width: 250px;
            background-color: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
        }

        .brand {
            padding: 28px 24px;
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border-color);
        }

        .nav-menu {
            list-style: none;
            padding: 16px 12px;
            flex: 1;
        }

        .nav-item { margin-bottom: 2px; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            text-decoration: none;
            color: var(--text-muted);
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-link i { width: 20px; text-align: center; font-size: 1rem; }

        .nav-link.active {
            background-color: rgba(38, 166, 154, 0.15);
            color: var(--primary-bright);
            font-weight: 600;
        }

        .nav-link:hover:not(.active) {
            background-color: var(--bg-card);
            color: var(--text-secondary);
        }

        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid var(--border-color);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            transition: color 0.2s;
        }

        .logout-btn:hover { color: #f87171; }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 0 36px 48px;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            background-color: var(--bg-body);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .search-container { position: relative; width: 360px; }

        .search-container i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        .search-input {
            width: 100%;
            padding: 10px 14px 10px 38px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-input);
            border-radius: 10px;
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            color: var(--text-primary);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input::placeholder { color: var(--text-muted); }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(38, 166, 154, 0.15);
        }

        .header-actions { display: flex; align-items: center; gap: 8px; }

        .header-icon-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: var(--bg-card);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            font-size: 1rem;
        }

        .header-icon-btn:hover {
            background-color: var(--bg-elevated);
            border-color: var(--primary);
            color: var(--primary);
        }

        .notif-dot {
            position: absolute;
            top: 9px; right: 10px;
            width: 7px; height: 7px;
            background-color: #ef4444;
            border-radius: 50%;
            border: 1.5px solid var(--bg-card);
        }

        .header-divider {
            width: 1px;
            height: 28px;
            background-color: var(--border-color);
            margin: 0 8px;
        }

        .user-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 10px 6px 6px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .user-header:hover { background-color: var(--bg-card); }

        .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dim));
            color: #ffffff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.875rem;
        }

        .user-header-info .user-header-name {
            font-weight: 600;
            font-size: 0.8125rem;
            color: var(--text-primary);
            line-height: 1.3;
        }

        .user-header-info .user-header-role {
            font-size: 0.75rem;
            color: var(--text-muted);
            line-height: 1.3;
        }

        .page-title-section {
            margin: 16px 0 32px;
        }

        .page-title-section h1 {
            font-size: 1.625rem;
            font-weight: 700;
            color: var(--text-primary);
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">ISBN TIRTA JAYA</div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/" class="nav-link">
                    <i class="fa-solid fa-border-all"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="/pengajuan" class="nav-link active">
                    <i class="fa-regular fa-file-lines"></i> Pengajuan
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-regular fa-user"></i> Informasi Penulis
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <a href="#" class="logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
            </a>
        </div>
    </aside>

    <main class="main-content">

        <header class="top-header">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="search-input" placeholder="Cari naskah, penulis, atau ISBN...">
            </div>
            <div class="header-actions">
                <button class="header-icon-btn" title="Notifikasi">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <div class="header-divider"></div>
                <div class="user-header">
                    <div class="user-avatar">P</div>
                    <div class="user-header-info">
                        <div class="user-header-name">Pradama</div>
                        <div class="user-header-role">Kontributor</div>
                    </div>
                    <i class="fa-solid fa-chevron-down" style="font-size: 0.625rem; color: var(--text-muted); margin-left: 4px;"></i>
                </div>
            </div>
        </header>

        <section class="page-title-section">
            <h1>Pengajuan</h1>
        </section>

    </main>

</body>

</html>
