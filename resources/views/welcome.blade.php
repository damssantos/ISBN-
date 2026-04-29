<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN Tirta Jaya - Dashboard</title>
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

            --status-review-bg: rgba(251, 191, 36, 0.1);
            --status-review-text: #fbbf24;
            --status-published-bg: rgba(52, 211, 153, 0.1);
            --status-published-text: #6ee7b7;
            --status-draft-bg: rgba(148, 163, 184, 0.08);
            --status-draft-text: #cbd5e1;
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

        /* ========== Sidebar ========== */
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

        .nav-item {
            margin-bottom: 2px;
        }

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

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

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

        .logout-btn:hover {
            color: #f87171;
        }

        /* ========== Main Content ========== */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 0 36px 48px;
        }

        /* ========== Top Header ========== */
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

        .search-container {
            position: relative;
            width: 360px;
        }

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

        .search-input::placeholder {
            color: var(--text-muted);
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(38, 166, 154, 0.15);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

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
            top: 9px;
            right: 10px;
            width: 7px;
            height: 7px;
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

        .user-header:hover {
            background-color: var(--bg-card);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
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

        /* ========== Welcome Section ========== */
        .welcome-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin: 16px 0 28px;
            background: linear-gradient(135deg, #0d4a3e 0%, #147a68 50%, #1a9480 100%);
            border: 1px solid rgba(45, 212, 191, 0.2);
            border-radius: 16px;
            padding: 32px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(20, 184, 166, 0.1);
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 220px;
            height: 220px;
            background: rgba(38, 166, 154, 0.08);
            border-radius: 50%;
        }

        .welcome-section::after {
            content: '';
            position: absolute;
            bottom: -70px;
            right: 60px;
            width: 160px;
            height: 160px;
            background: rgba(38, 166, 154, 0.05);
            border-radius: 50%;
        }

        .welcome-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.3;
        }

        .welcome-text p {
            font-size: 0.875rem;
            color: var(--accent);
            margin-top: 6px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            position: relative;
            z-index: 1;
        }

        .btn-primary:hover {
            background-color: var(--primary-bright);
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(38, 166, 154, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* ========== Stats Grid ========== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 20px;
            position: relative;
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(45, 212, 191, 0.12), 0 4px 12px rgba(0, 0, 0, 0.3);
            border-color: var(--primary-dim);
        }

        .stat-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .icon-teal {
            background-color: rgba(38, 166, 154, 0.15);
            color: var(--primary-bright);
        }

        .icon-orange {
            background-color: rgba(245, 158, 11, 0.12);
            color: #fbbf24;
        }

        .icon-blue {
            background-color: rgba(59, 130, 246, 0.12);
            color: #60a5fa;
        }

        .icon-gray {
            background-color: rgba(148, 163, 184, 0.12);
            color: #94a3b8;
        }

        .stat-badge {
            background-color: rgba(52, 211, 153, 0.12);
            color: #34d399;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 0.6875rem;
            font-weight: 600;
        }

        .stat-title {
            font-size: 0.8125rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.2;
        }

        /* ========== Content Layout ========== */
        .content-layout {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 20px;
        }

        /* ========== Card Common ========== */
        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .link-teal {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.8125rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .link-teal:hover {
            color: var(--primary-bright);
        }

        /* ========== Table Styles ========== */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 0 0 14px 0;
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 14px 0;
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
            font-size: 0.875rem;
        }

        tr:last-child td {
            border-bottom: none;
            padding-bottom: 0;
        }

        tr:hover td {
            background-color: var(--bg-card-hover);
        }

        .ms-title {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--text-primary);
        }

        .ms-id {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .status-review {
            background-color: var(--status-review-bg);
            color: var(--status-review-text);
        }

        .status-review::before {
            background-color: var(--status-review-text);
        }

        .status-published {
            background-color: var(--status-published-bg);
            color: var(--status-published-text);
        }

        .status-published::before {
            background-color: var(--status-published-text);
        }

        .status-draft {
            background-color: var(--status-draft-bg);
            color: var(--status-draft-text);
        }

        .status-draft::before {
            background-color: var(--status-draft-text);
        }

        .date-text {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .action-btn {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background-color: rgba(38, 166, 154, 0.12);
            color: var(--primary);
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .action-btn:hover {
            background-color: var(--primary);
            color: #ffffff;
        }

        /* ========== Activity Feed ========== */
        .activity-feed {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .activity-item {
            display: flex;
            gap: 14px;
            align-items: flex-start;
        }

        .activity-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .activity-body {
            flex: 1;
            min-width: 0;
        }

        .activity-content {
            font-size: 0.8125rem;
            color: var(--text-secondary);
            line-height: 1.5;
        }

        .activity-content strong {
            font-weight: 600;
            color: var(--text-primary);
        }

        .activity-content .highlight {
            color: var(--primary-bright);
            font-weight: 600;
        }

        .activity-time {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 3px;
        }

        .btn-outline {
            width: 100%;
            padding: 10px;
            background-color: transparent;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.8125rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            margin-top: 16px;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            background-color: var(--bg-elevated);
            border-color: var(--primary-dim);
            color: var(--primary);
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">ISBN TIRTA JAYA</div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/" class="nav-link active">
                    <i class="fa-solid fa-border-all"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="/pengajuan" class="nav-link">
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

        <section class="welcome-section">
            <div class="welcome-text">
                <h1>Selamat datang kembali, Pradama 👋</h1>
                <p>Berikut ringkasan aktivitas naskah Anda hari ini.</p>
            </div>
            <button class="btn-primary">
                <i class="fa-solid fa-plus"></i> Pengajuan Baru
            </button>
        </section>

        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-top">
                    <div class="stat-icon icon-teal">
                        <i class="fa-regular fa-file-alt"></i>
                    </div>
                    <span class="stat-badge">+2 minggu ini</span>
                </div>
                <div class="stat-title">Naskah Aktif</div>
                <div class="stat-value">12</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-top">
                    <div class="stat-icon icon-orange">
                        <i class="fa-regular fa-eye"></i>
                    </div>
                </div>
                <div class="stat-title">Dalam Peninjauan</div>
                <div class="stat-value">04</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-top">
                    <div class="stat-icon icon-blue">
                        <i class="fa-regular fa-circle-check"></i>
                    </div>
                </div>
                <div class="stat-title">Diterbitkan</div>
                <div class="stat-value">08</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-top">
                    <div class="stat-icon icon-gray">
                        <i class="fa-solid fa-inbox"></i>
                    </div>
                </div>
                <div class="stat-title">Draf</div>
                <div class="stat-value">03</div>
            </div>
        </section>

        <section class="content-layout">

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Naskah Terbaru</h2>
                    <a href="#" class="link-teal">Lihat semua →</a>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Judul Naskah</th>
                                <th>Status</th>
                                <th>Terakhir Diperbarui</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="ms-title">Analisis Perubahan Iklim 2024</div>
                                    <div class="ms-id">ID: MS-8829</div>
                                </td>
                                <td><span class="status-badge status-review">Dalam Peninjauan</span></td>
                                <td>
                                    <div class="date-text">12 Okt 2023</div>
                                </td>
                                <td style="text-align: center;">
                                    <a href="#" class="action-btn" title="Lihat detail">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ms-title">Metodologi Medan Kuantum</div>
                                    <div class="ms-id">ID: MS-7741</div>
                                </td>
                                <td><span class="status-badge status-published">Diterbitkan</span></td>
                                <td>
                                    <div class="date-text">28 Sep 2023</div>
                                </td>
                                <td style="text-align: center;">
                                    <a href="#" class="action-btn" title="Lihat detail">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ms-title">Dinamika Perencanaan Kota</div>
                                    <div class="ms-id">ID: MS-4122</div>
                                </td>
                                <td><span class="status-badge status-draft">Draf</span></td>
                                <td>
                                    <div class="date-text">15 Sep 2023</div>
                                </td>
                                <td style="text-align: center;">
                                    <a href="#" class="action-btn" title="Lihat detail">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Aktivitas Terbaru</h2>
                </div>
                <div class="activity-feed">

                    <div class="activity-item">
                        <div class="activity-icon icon-teal">
                            <i class="fa-regular fa-comment-dots"></i>
                        </div>
                        <div class="activity-body">
                            <div class="activity-content">
                                <strong>Editor Julian Smith</strong> menambahkan komentar pada <span class="highlight">Analisis Perubahan Iklim.</span>
                            </div>
                            <div class="activity-time">2 jam yang lalu</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon icon-blue">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="activity-body">
                            <div class="activity-content">
                                Naskah <span class="highlight">Metodologi Medan Kuantum</span> telah resmi diterbitkan.
                            </div>
                            <div class="activity-time">Kemarin</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon icon-orange">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <div class="activity-body">
                            <div class="activity-content">
                                Peninjauan tahap ke-2 dimulai untuk <span class="highlight">Kerangka Keberlanjutan.</span>
                            </div>
                            <div class="activity-time">10 Okt 2023</div>
                        </div>
                    </div>

                </div>
                <button class="btn-outline">Hapus Semua Notifikasi</button>
            </div>

        </section>
    </main>

</body>

</html>