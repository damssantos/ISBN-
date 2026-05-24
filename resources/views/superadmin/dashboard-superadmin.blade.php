<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Super Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary:        #3BC3BD;
            --primary-bright: #5CD9D4;
            --primary-dim:    #2E9B96;
            --primary-glow:   rgba(59, 195, 189, 0.15);
            --accent:         #3BC3BD;
            --bg-body:        #0f1d26;
            --bg-sidebar:     #0c1a22;
            --bg-card:        #1B2B38;
            --bg-card-hover:  #2e4255;
            --bg-input:       #111f2a;
            --bg-elevated:    #2B3D49;
            --border-color:   #2e4459;
            --border-light:   #1e3040;
            --text-primary:   #F0F6FA;
            --text-secondary: #B8CDD8;
            --text-muted:     #7A9BAA;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 64px;
        }

        * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter', sans-serif; }
        body { background:var(--bg-body); color:var(--text-primary); display:flex; min-height:100vh; font-size:14px; line-height:1.5; overflow-x:hidden; }

        /* ─── Sidebar ─────────────────────────────────────────── */
        .sidebar { width:var(--sidebar-width); background:var(--bg-sidebar); border-right:1px solid var(--border-color); display:flex; flex-direction:column; position:fixed; height:100vh; transition:width 0.3s cubic-bezier(.4,0,.2,1); overflow:hidden; z-index:100; }
        .sidebar.collapsed { width:var(--sidebar-collapsed-width); }

        .brand { padding:18px 14px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid var(--border-color); min-height:66px; }
        .brand-content { display:flex; align-items:center; gap:10px; overflow:hidden; }
        .brand-icon { font-size:1.1rem; color:var(--primary); flex-shrink:0; width:28px; text-align:center; }
        .brand-info { overflow:hidden; }
        .brand-text { font-size:.9375rem; font-weight:700; color:var(--primary); white-space:nowrap; transition:opacity 0.2s; }
        .brand-subtitle { font-size:.72rem; color:var(--text-muted); white-space:nowrap; margin-top:1px; }
        .sidebar.collapsed .brand-text,
        .sidebar.collapsed .brand-subtitle { opacity:0; width:0; }
        .sidebar-toggle { width:30px; height:30px; display:flex; align-items:center; justify-content:center; border:none; background:transparent; color:var(--text-muted); border-radius:7px; cursor:pointer; flex-shrink:0; font-size:.95rem; transition:background 0.2s, color 0.2s; }
        .sidebar-toggle:hover { background:var(--bg-card); color:var(--primary); }

        .nav-menu { list-style:none; padding:12px 8px; flex:1; overflow-y:auto; overflow-x:hidden; }
        .nav-item { margin-bottom:2px; }
        .nav-link { display:flex; align-items:center; gap:12px; padding:10px 12px; text-decoration:none; color:var(--text-muted); border-radius:10px; font-size:.875rem; font-weight:500; transition:all 0.2s; white-space:nowrap; overflow:hidden; }
        .nav-link i { width:20px; min-width:20px; text-align:center; font-size:1rem; flex-shrink:0; }
        .nav-link-text { transition:opacity 0.2s; }
        .sidebar.collapsed .nav-link-text { opacity:0; width:0; overflow:hidden; }
        .nav-link.active { background:linear-gradient(90deg, rgba(59,195,189,0.16), rgba(59,195,189,0.06)); color:var(--primary-bright); font-weight:600; border-left:2px solid var(--primary); }
        .nav-link:hover:not(.active) { background:var(--bg-card); color:var(--text-secondary); }

        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); margin-top:auto; }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; font-weight:500; font-size:.875rem; border-radius:10px; transition:all 0.2s; white-space:nowrap; cursor:pointer; border:none; background:transparent; width:100%; }
        .logout-btn i { width:20px; min-width:20px; text-align:center; flex-shrink:0; }
        .logout-btn:hover { color:#f87171; background:rgba(248,113,113,0.08); }
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }

        /* ─── Main Content ────────────────────────────────────── */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 36px 48px; transition:margin-left 0.3s cubic-bezier(.4,0,.2,1); }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width); }

        /* ─── Top Header ─────────────────────────────────────── */
        .top-header { display:flex; justify-content:space-between; align-items:center; padding:20px 0; }
        .search-container { position:relative; width:340px; }
        .search-container i { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:.875rem; }
        .search-input { width:100%; padding:10px 14px 10px 38px; border:1px solid var(--border-color); background:var(--bg-card); border-radius:10px; font-size:.875rem; outline:none; color:var(--text-primary); transition:border-color 0.2s, box-shadow 0.2s; }
        .search-input::placeholder { color:var(--text-muted); }
        .search-input:focus { border-color:var(--primary-dim); box-shadow:0 0 0 3px var(--primary-glow); }

        .header-actions { display:flex; align-items:center; background:rgba(15,29,38,0.7); border:1px solid var(--border-color); padding:4px 12px 4px 4px; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.2); gap:0; }
        .header-icon-btn { width:38px; height:38px; display:flex; align-items:center; justify-content:center; border-radius:12px; border:none; background:transparent; color:var(--text-secondary); cursor:pointer; transition:all 0.2s; position:relative; font-size:1.1rem; }
        .header-icon-btn:hover { background:rgba(255,255,255,0.05); color:var(--primary-bright); }
        .header-divider { width:1px; height:24px; background:var(--border-color); margin:0 12px 0 8px; opacity:0.6; }
        .notif-dot { position:absolute; top:10px; right:10px; width:6px; height:6px; background:#f87171; border-radius:50%; border:1.5px solid var(--bg-card); }
        .user-avatar-circle { width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg, var(--primary), var(--primary-dim)); display:flex; align-items:center; justify-content:center; overflow:hidden; border:1px solid var(--border-color); box-shadow:0 4px 10px rgba(0,0,0,0.2); }
        .user-avatar-circle img { width:100%; height:100%; object-fit:cover; }

        /* ─── Stats Grid ──────────────────────────────────────── */
        .stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-top:10px; }

        .stat-card {
            background:var(--bg-card);
            border:1px solid var(--border-color);
            border-radius:16px;
            padding:22px 22px 20px;
            position:relative;
            overflow:hidden;
            display:flex;
            flex-direction:column;
            gap:10px;
            transition:all 0.25s cubic-bezier(0.16,1,0.3,1);
            box-shadow:0 4px 16px rgba(0,0,0,0.18);
        }
        .stat-card::after { content:''; position:absolute; inset:0; border-radius:16px; background:linear-gradient(145deg, rgba(59,195,189,0.04), transparent 55%); pointer-events:none; }
        .stat-card:hover { transform:translateY(-4px); box-shadow:0 16px 36px rgba(0,0,0,0.3); border-color:rgba(59,195,189,0.3); }

        .stat-card-top {
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
        }
        .stat-label {
            font-size:.68rem;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:1.1px;
            color:var(--text-muted);
            line-height:1;
        }
        .stat-icon-box {
            width:38px; height:38px;
            border-radius:10px;
            display:flex; align-items:center; justify-content:center;
            font-size:1rem;
            flex-shrink:0;
        }
        .stat-icon-box.teal   { background:rgba(59,195,189,0.13);  color:var(--primary); }
        .stat-icon-box.yellow { background:rgba(245,158,11,0.13);  color:#FBBF24; }
        .stat-icon-box.red    { background:rgba(239,68,68,0.13);   color:#f87171; }
        .stat-icon-box.purple { background:rgba(168,85,247,0.13);  color:#C084FC; }
        .stat-icon-box.gray   { background:rgba(120,150,170,0.13); color:var(--text-muted); }

        .stat-value {
            font-size:2.4rem;
            font-weight:800;
            color:var(--text-primary);
            letter-spacing:-1px;
            line-height:1;
        }
        .stat-desc {
            font-size:.8rem;
            color:var(--text-muted);
            line-height:1.45;
            margin-top:2px;
        }

        /* ─── Workflow Log Table ──────────────────────────────── */
        .section-header { display:flex; align-items:center; justify-content:space-between; margin:32px 0 20px; }
        .section-title { display:flex; align-items:center; gap:10px; font-size:1.15rem; font-weight:700; color:var(--text-primary); }
        .section-title i { color:var(--primary); font-size:1rem; }
        .section-actions { display:flex; gap:10px; }

        .btn-filter { display:flex; align-items:center; gap:7px; padding:8px 16px; background:transparent; border:1px solid var(--border-color); border-radius:10px; color:var(--text-secondary); font-size:.85rem; font-weight:500; cursor:pointer; transition:all 0.2s; }
        .btn-filter:hover { border-color:var(--primary-dim); color:var(--primary-bright); background:var(--primary-glow); }
        .btn-export { display:flex; align-items:center; gap:7px; padding:8px 18px; background:var(--primary); border:none; border-radius:10px; color:#0f1d26; font-size:.85rem; font-weight:700; cursor:pointer; transition:all 0.2s; }
        .btn-export:hover { background:var(--primary-bright); transform:translateY(-2px); box-shadow:0 4px 12px var(--primary-glow); }

        .table-card { background:var(--bg-card); border:1px solid var(--border-color); border-radius:20px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.2); }

        .log-table { width:100%; border-collapse:collapse; }
        .log-table thead tr { background:#162230; }
        .log-table th { padding:14px 20px; text-align:left; font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted); border-bottom:1px solid var(--border-color); }
        .log-table td { padding:22px 20px; border-bottom:1px solid var(--border-light); vertical-align:middle; }
        .log-table tbody tr:last-child td { border-bottom:none; }
        .log-table tbody tr { transition:background 0.15s; }
        .log-table tbody tr:hover { background:rgba(59,195,189,0.035); }

        .col-no { font-size:.85rem; font-weight:700; color:var(--text-muted); }
        .col-tahap { min-width:130px; }
        .col-aksi { font-size:.875rem; color:var(--text-secondary); line-height:1.5; }
        .col-respon { font-size:.875rem; line-height:1.5; }
        .col-pengaturan { text-align:center; }

        /* Tahap Badges */
        .tahap-badge { display:inline-flex; align-items:center; padding:5px 12px; border-radius:20px; font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px; }
        .tahap-badge.login       { background:rgba(59,195,189,0.15);  color:var(--primary-bright); border:1px solid rgba(59,195,189,0.25); }
        .tahap-badge.cek-bayar   { background:rgba(245,158,11,0.15);  color:#FBBF24;               border:1px solid rgba(245,158,11,0.25); }
        .tahap-badge.verifikasi  { background:rgba(168,85,247,0.15);  color:#C084FC;               border:1px solid rgba(168,85,247,0.25); }
        .tahap-badge.proses-isbn { background:rgba(59,195,189,0.1);   color:#5CD9D4;               border:1px solid rgba(59,195,189,0.2); font-size:.65rem; }
        .tahap-badge.finalisasi  { background:rgba(16,185,129,0.15);  color:#34D399;               border:1px solid rgba(16,185,129,0.25); }

        /* Respon Icons */
        .respon-item { display:flex; align-items:flex-start; gap:7px; }
        .respon-icon { margin-top:2px; font-size:.8rem; flex-shrink:0; }
        .respon-icon.green  { color:#2dce89; }
        .respon-icon.yellow { color:#FBBF24; }
        .respon-icon.teal   { color:var(--primary-bright); }
        .respon-icon.wait   { color:#C084FC; }
        .respon-link { font-size:.875rem; font-weight:600; color:var(--primary-bright); text-decoration:none; line-height:1.45; }
        .respon-link:hover { text-decoration:underline; }
        .respon-text { font-size:.875rem; color:var(--text-secondary); line-height:1.45; }

        .settings-btn { width:32px; height:32px; display:flex; align-items:center; justify-content:center; background:transparent; border:1px solid var(--border-color); border-radius:8px; color:var(--text-muted); cursor:pointer; transition:all 0.2s; font-size:.9rem; margin:0 auto; }
        .settings-btn:hover { border-color:var(--primary-dim); color:var(--primary); background:var(--primary-glow); }
    </style>
</head>
<body>

    <!-- ═══════════════════ SIDEBAR ═══════════════════ -->
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-content">
                <div class="brand-icon"><i class="fa-solid fa-book-bookmark"></i></div>
                <div class="brand-info">
                    <div class="brand-text">ISBN YPIK PAM JAYA</div>
                    <div class="brand-subtitle">Super Admin Portal</div>
                </div>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="/superadmin/dashboard" class="nav-link active">
                        <i class="fa-solid fa-border-all"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/superadmin/cek-pembayaran" class="nav-link">
                        <i class="fa-solid fa-credit-card"></i>
                        <span class="nav-link-text">Cek Pembayaran</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/superadmin/verifikasi" class="nav-link">
                        <i class="fa-solid fa-check-circle"></i>
                        <span class="nav-link-text">Verifikasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/superadmin/finalisasi" class="nav-link">
                        <i class="fa-solid fa-flag-checkered"></i>
                        <span class="nav-link-text">Finalisasi</span>
                    </a>
                </li>
            </ul>

        <div class="sidebar-footer">
            <button class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Sign Out</span>
            </button>
        </div>
    </aside>

    <!-- ═══════════════════ MAIN CONTENT ═══════════════════ -->
    <main class="main-content" id="mainContent">

        <!-- Top Header -->
        <div class="top-header">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="search-input" placeholder="Cari naskah atau ISBN...">
            </div>
            <div class="header-actions">
                <button class="header-icon-btn" title="Notifikasi">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <div class="header-divider"></div>
                <div class="user-avatar-circle">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=80&fit=crop&q=80" alt="Super Admin">
                </div>
            </div>
        </div>

        <!-- ─── Stats Grid ─── -->
        <div class="stats-grid">

            <!-- Card 1: Peninjauan -->
            <div class="stat-card">
                <div class="stat-card-top">
                    <span class="stat-label">Peninjauan</span>
                    <div class="stat-icon-box teal"><i class="fa-regular fa-file-lines"></i></div>
                </div>
                <div class="stat-value">12</div>
                <div class="stat-desc">Naskah dalam peninjauan</div>
            </div>

            <!-- Card 2: Diterbitkan -->
            <div class="stat-card">
                <div class="stat-card-top">
                    <span class="stat-label">Diterbitkan</span>
                    <div class="stat-icon-box teal"><i class="fa-solid fa-circle-check"></i></div>
                </div>
                <div class="stat-value">48</div>
                <div class="stat-desc">Naskah telah diterbitkan</div>
            </div>

            <!-- Card 3: Penulis -->
            <div class="stat-card">
                <div class="stat-card-top">
                    <span class="stat-label">Penulis</span>
                    <div class="stat-icon-box yellow"><i class="fa-solid fa-user"></i></div>
                </div>
                <div class="stat-value">07</div>
                <div class="stat-desc">Total penulis terdaftar</div>
            </div>

            <!-- Card 4: Draf -->
            <div class="stat-card">
                <div class="stat-card-top">
                    <span class="stat-label">Draf</span>
                    <div class="stat-icon-box gray"><i class="fa-regular fa-inbox"></i></div>
                </div>
                <div class="stat-value">03</div>
                <div class="stat-desc">Total draf naskah</div>
            </div>

        </div>

        <!-- ─── Workflow Log ─── -->
        <div class="section-header">
            <div class="section-title">
                <i class="fa-solid fa-list-check"></i>
                Log Urutan Alur Kerja
            </div>
            <div class="section-actions">
                <button class="btn-filter">
                    <i class="fa-solid fa-sliders"></i> Filter
                </button>
                <button class="btn-export">
                    <i class="fa-solid fa-download"></i> Ekspor
                </button>
            </div>
        </div>

        <div class="table-card">
            <table class="log-table">
                <thead>
                    <tr>
                        <th style="width:8%;">NO</th>
                        <th style="width:18%;">TAHAP</th>
                        <th style="width:26%;">AKSI ADMIN</th>
                        <th style="width:28%;">RESPON SISTEM</th>
                        <th style="width:10%; text-align:center;">PENGATURAN</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr>
                        <td class="col-no">01</td>
                        <td class="col-tahap">
                            <span class="tahap-badge login">Login</span>
                        </td>
                        <td class="col-aksi">Input Kredensial<br>Super Admin</td>
                        <td class="col-respon">
                            <div class="respon-item">
                                <i class="respon-icon green fa-solid fa-circle-check"></i>
                                <div>
                                    <a href="#" class="respon-link">Akses Dashboard<br>Terbuka</a>
                                </div>
                            </div>
                        </td>
                        <td class="col-pengaturan">
                            <button class="settings-btn" title="Pengaturan"><i class="fa-solid fa-sliders"></i></button>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr>
                        <td class="col-no">02</td>
                        <td class="col-tahap">
                            <span class="tahap-badge cek-bayar">Cek Pembayaran</span>
                        </td>
                        <td class="col-aksi">Validasi Bukti Transfer<br>Bank</td>
                        <td class="col-respon">
                            <div class="respon-item">
                                <i class="respon-icon yellow fa-solid fa-rotate"></i>
                                <div>
                                    <span class="respon-text">Update Status<br>"Lunas"</span>
                                </div>
                            </div>
                        </td>
                        <td class="col-pengaturan">
                            <button class="settings-btn" title="Pengaturan"><i class="fa-solid fa-sliders"></i></button>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr>
                        <td class="col-no">03</td>
                        <td class="col-tahap">
                            <span class="tahap-badge verifikasi">Verifikasi</span>
                        </td>
                        <td class="col-aksi">Review Kelengkapan<br>Naskah</td>
                        <td class="col-respon">
                            <div class="respon-item">
                                <i class="respon-icon teal fa-solid fa-bolt"></i>
                                <div>
                                    <span class="respon-text">Notifikasi Email<br>Penulis</span>
                                </div>
                            </div>
                        </td>
                        <td class="col-pengaturan">
                            <button class="settings-btn" title="Pengaturan"><i class="fa-solid fa-sliders"></i></button>
                        </td>
                    </tr>
                    <!-- Row 4 -->
                    <tr>
                        <td class="col-no">04</td>
                        <td class="col-tahap">
                            <span class="tahap-badge proses-isbn">Proses ISBN</span>
                        </td>
                        <td class="col-aksi">Submit Form<br>ke Perpusnas</td>
                        <td class="col-respon">
                            <div class="respon-item">
                                <i class="respon-icon wait fa-solid fa-hourglass-half"></i>
                                <div>
                                    <a href="#" class="respon-link">Menunggu<br>Kode ISBN</a>
                                </div>
                            </div>
                        </td>
                        <td class="col-pengaturan">
                            <button class="settings-btn" title="Pengaturan"><i class="fa-solid fa-sliders"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

    <script>
        const sidebar     = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });
    </script>
</body>
</html>
