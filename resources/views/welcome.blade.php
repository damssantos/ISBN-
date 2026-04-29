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
            --primary-color: #00796b;
            --primary-light: #e0f2f1;
            --text-dark: #1f2937;
            --text-gray: #6b7280;
            --text-light: #9ca3af;
            --bg-body: #f9fafb;
            --bg-card: #ffffff;
            --border-color: #f3f4f6;

            /* Status Colors */
            --status-review-bg: #fffbeb;
            --status-review-text: #b45309;
            --status-published-bg: #ecfdf5;
            --status-published-text: #047857;
            --status-draft-bg: #f3f4f6;
            --status-draft-text: #374151;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background-color: var(--bg-card);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
        }

        .brand {
            padding: 24px;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .user-profile-sidebar {
            padding: 0 24px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar-initial {
            width: 40px;
            height: 40px;
            background-color: #fde68a;
            color: var(--primary-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .user-info .name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info .role {
            font-size: 0.8rem;
            color: var(--text-gray);
        }

        .nav-menu {
            list-style: none;
            padding: 0 12px;
            flex: 1;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px;
            text-decoration: none;
            color: var(--text-gray);
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-link i {
            width: 24px;
            font-size: 1.1rem;
        }

        .nav-link.active {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .nav-link:hover:not(.active) {
            background-color: var(--border-color);
        }

        .logout {
            padding: 24px;
            border-top: 1px solid var(--border-color);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 0 40px 40px;
        }

        /* Top Header */
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
            width: 400px;
        }

        .search-container i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .search-input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: none;
            background-color: #f9fafb;
            border-radius: 8px;
            font-size: 0.9rem;
            outline: none;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification {
            color: var(--text-gray);
            font-size: 1.2rem;
            cursor: pointer;
        }

        .avatar-img {
            width: 36px;
            height: 36px;
            background-color: #d1d5db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Welcome Section */
        .welcome-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 30px 0 40px;
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #111827;
            line-height: 1.2;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #00695c;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 16px;
        }

        .icon-teal {
            background-color: #e0f2f1;
            color: #00796b;
        }

        .icon-orange {
            background-color: #fff7ed;
            color: #ea580c;
        }

        .icon-blue {
            background-color: #eff6ff;
            color: #2563eb;
        }

        .icon-gray {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        .stat-title {
            font-size: 0.85rem;
            color: var(--text-gray);
            margin-bottom: 8px;
            font-weight: 500;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .stat-badge {
            position: absolute;
            top: 24px;
            right: 24px;
            background-color: #ecfdf5;
            color: #047857;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Content Layout */
        .content-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        /* Card Common */
        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .link-teal {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Table Styles */
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
            padding-bottom: 16px;
            font-size: 0.8rem;
            color: var(--text-gray);
            font-weight: 600;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
            padding-bottom: 0;
        }

        .ms-title {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-dark);
        }

        .ms-id {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-top: 4px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-review {
            background-color: var(--status-review-bg);
            color: var(--status-review-text);
        }

        .status-published {
            background-color: var(--status-published-bg);
            color: var(--status-published-text);
        }

        .status-draft {
            background-color: var(--status-draft-bg);
            color: var(--status-draft-text);
        }

        .date-text {
            font-size: 0.9rem;
            color: var(--text-gray);
        }

        .date-year {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .action-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Activity Feed Styles */
        .activity-feed {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .activity-item {
            display: flex;
            gap: 16px;
        }

        .activity-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .activity-content {
            font-size: 0.9rem;
            color: var(--text-dark);
            line-height: 1.5;
        }

        .activity-content strong {
            font-weight: 600;
        }

        .activity-content .highlight {
            color: var(--primary-color);
            font-weight: 600;
        }

        .activity-time {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-top: 4px;
        }

        .btn-outline {
            width: 100%;
            padding: 12px;
            background-color: transparent;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-dark);
            font-weight: 500;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.2s;
        }

        .btn-outline:hover {
            background-color: #f9fafb;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">ISBN TIRTA JAYA</div>

        <div class="user-profile-sidebar">
            <div class="avatar-initial">P</div>
            <div class="user-info">
                <div class="name">Pradama</div>
                <div class="role">Contributor</div>
            </div>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="fa-solid fa-border-all"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-regular fa-file-lines"></i> Pengajuan
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-regular fa-user"></i> Informasi Penulis
                </a>
            </li>
        </ul>

        <div class="logout">
            <a href="#" class="logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-content">

        <header class="top-header">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="search-input" placeholder="Cari">
            </div>
            <div class="header-actions">
                <i class="fa-regular fa-bell notification"></i>
                <div class="avatar-img"><i class="fa-solid fa-user"></i></div>
            </div>
        </header>

        <section class="welcome-section">
            <h1>Selamat datang kembali,<br>Pradama</h1>
            <button class="btn-primary">
                <i class="fa-solid fa-plus"></i> Mulai pengajuan baru
            </button>
        </section>

        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-teal">
                    <i class="fa-regular fa-file-alt"></i>
                </div>
                <span class="stat-badge">+2 this week</span>
                <div class="stat-title">Active Manuscripts</div>
                <div class="stat-value">12</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-orange">
                    <i class="fa-regular fa-eye"></i>
                </div>
                <div class="stat-title">Dalam Peninjauan</div>
                <div class="stat-value">04</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-blue">
                    <i class="fa-regular fa-circle-check"></i>
                </div>
                <div class="stat-title">Diterbitkan</div>
                <div class="stat-value">08</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-gray">
                    <i class="fa-solid fa-inbox"></i>
                </div>
                <div class="stat-title">Draf</div>
                <div class="stat-value">03</div>
            </div>
        </section>

        <section class="content-layout">

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Naskah Terbaru</h2>
                    <a href="#" class="link-teal">Lihat semua</a>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Judul Naskah</th>
                                <th>Status</th>
                                <th>Terakhir Diperbarui</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="ms-title">Climate Shift Analysis 2024</div>
                                    <div class="ms-id">ID: MS-8829</div>
                                </td>
                                <td><span class="status-badge status-review">Dalam peninjauan</span></td>
                                <td>
                                    <div class="date-text">Oct 12,</div>
                                    <div class="date-year">2023</div>
                                </td>
                                <td><a href="#" class="action-link">Lihat</a></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ms-title">Quantum Field Methodology</div>
                                    <div class="ms-id">ID: MS-7741</div>
                                </td>
                                <td><span class="status-badge status-published">Diterbitkan</span></td>
                                <td>
                                    <div class="date-text">Sep 28,</div>
                                    <div class="date-year">2023</div>
                                </td>
                                <td><a href="#" class="action-link">Lihat</a></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ms-title">Urban Planning Dynamics</div>
                                    <div class="ms-id">ID: MS-4122</div>
                                </td>
                                <td><span class="status-badge status-draft">Draf</span></td>
                                <td>
                                    <div class="date-text">Sep 15,</div>
                                    <div class="date-year">2023</div>
                                </td>
                                <td><a href="#" class="action-link">Lihat</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Activity Feed</h2>
                </div>
                <div class="activity-feed">

                    <div class="activity-item">
                        <div class="activity-icon icon-teal">
                            <i class="fa-regular fa-comment-dots"></i>
                        </div>
                        <div class="activity-content">
                            <div><strong>Editor Julian Smith</strong> added a comment to <span class="highlight">Climate
                                    Shift Analysis.</span></div>
                            <div class="activity-time">2 hours ago</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon icon-blue">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="activity-content">
                            <div>Your manuscript Quantum Field Methodology has been officially published.</div>
                            <div class="activity-time">Yesterday</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon icon-orange">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <div class="activity-content">
                            <div>Peer review round #2 started for <span class="highlight">Sustainability
                                    Frameworks.</span></div>
                            <div class="activity-time">Oct 10, 2023</div>
                        </div>
                    </div>

                </div>
                <button class="btn-outline">Clear Notifications</button>
            </div>

        </section>
    </main>

</body>

</html>