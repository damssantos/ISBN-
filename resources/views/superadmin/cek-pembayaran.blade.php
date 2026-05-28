<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Cek Pembayaran</title>
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
            --status-review-bg:      rgba(59, 130, 246, 0.12);
            --status-review-text:    #60A5FA;
            --status-published-bg:   rgba(59, 195, 189, 0.15);
            --status-published-text: #3BC3BD;
            --status-draft-bg:       rgba(122, 155, 170, 0.15);
            --status-draft-text:     #7A9BAA;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 64px;
        }

        * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter', sans-serif; }
        body { background:var(--bg-body); color:var(--text-primary); display:flex; min-height:100vh; font-size:14px; line-height:1.5; overflow-x:hidden; }

        /* ─── Sidebar ───────────────────────────────────────────── */
        .sidebar { width:var(--sidebar-width); background:var(--bg-sidebar); border-right:1px solid var(--border-color); display:flex; flex-direction:column; position:fixed; height:100vh; transition:width 0.3s cubic-bezier(.4,0,.2,1); overflow:hidden; z-index:100; }
        .sidebar.collapsed { width:var(--sidebar-collapsed-width); }

        .brand { padding:18px 14px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid var(--border-color); min-height:66px; }
        .brand-content { display:flex; align-items:center; gap:10px; overflow:hidden; }
        .brand-icon { font-size:1.2rem; color:var(--primary); flex-shrink:0; width:28px; text-align:center; }
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

        /* ─── Main Content ───────────────────────────────────────── */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 36px 48px; transition:margin-left 0.3s cubic-bezier(.4,0,.2,1); }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width); }

        /* ─── Top Header ─────────────────────────────────────────── */
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
        
        .user-wrapper { position:relative; }
        .user-header { display:flex; align-items:center; gap:12px; padding:4px 8px; border-radius:12px; cursor:pointer; transition:all 0.2s; }
        .user-header:hover { background:rgba(255,255,255,0.05); }
        .user-avatar { width:40px; height:40px; background:linear-gradient(135deg, var(--primary), var(--primary-dim)); color:#fff; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1rem; box-shadow: 0 4px 12px rgba(59, 195, 189,0.3); overflow:hidden; }
        .user-header-info { display:flex; flex-direction:column; gap:0; }
        .user-header-name { font-weight:700; font-size:.9375rem; color:var(--text-primary); line-height:1.2; }
        .user-header-role { font-size:.75rem; color:var(--text-muted); line-height:1.2; font-weight: 500; }

        .user-dropdown {
            position:absolute;
            top:calc(100% + 12px);
            right:0;
            width:240px;
            background:var(--bg-card);
            border:1px solid var(--border-color);
            border-radius:16px;
            box-shadow:0 10px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(59, 195, 189,0.08);
            display:none;
            flex-direction:column;
            z-index:1000;
            overflow:hidden;
            transform-origin: top right;
            animation: dropdownFadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes dropdownFadeIn { from{opacity:0;transform:scale(.95) translateY(-10px)} to{opacity:1;transform:scale(1) translateY(0)} }
        .user-dropdown.show { display:flex; }
        .user-dropdown-item { padding:14px 20px; display:flex; align-items:center; gap:16px; color:var(--text-secondary); text-decoration:none; font-size:.875rem; font-weight:500; transition:all .2s; cursor:pointer; }
        .user-dropdown-item:hover { background:var(--bg-card-hover); color:var(--primary); padding-left:24px; }
        .user-dropdown-item i { width:20px; font-size:1.1rem; text-align:center; color:var(--text-muted); transition:color .2s; }
        .user-dropdown-item:hover i { color:var(--primary); }
        .user-dropdown-divider { height:1px; background:var(--border-color); margin:8px 0; }
        .user-dropdown-item.logout { color:#f87171; }
        .user-dropdown-item.logout i { color:#f87171; }
        .user-dropdown-item.logout:hover { background:rgba(248,113,113,0.08); color:#f87171; }

        /* ─── Page Header ────────────────────────────────────────── */
        .page-header { margin-top:10px; margin-bottom:28px; }
        .page-title { font-size:1.75rem; font-weight:700; color:var(--text-primary); margin-bottom:4px; }
        .page-subtitle { font-size:.9rem; color:var(--text-muted); }

        /* ─── Stat Cards ─────────────────────────────────────────── */
        .stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:18px; margin-bottom:28px; }

        .stat-card {
            background:var(--bg-card);
            border:1px solid var(--border-color);
            border-top:3px solid var(--primary-dim);
            border-radius:18px;
            padding:24px;
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
            position:relative;
            overflow:hidden;
            transition:all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .stat-card::after { content:''; position:absolute; inset:0; border-radius:18px; background:linear-gradient(145deg, rgba(59, 195, 189, 0.05), transparent 60%); pointer-events:none; }
        .stat-card:hover {
            transform:translateY(-8px);
            border-top-color:var(--primary);
            box-shadow:0 20px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(59, 195, 189, 0.1);
        }

        .stat-card-top { display:flex; align-items:flex-start; justify-content:space-between; }
        .stat-label { font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:1.1px; color:var(--text-muted); line-height:1; }
        .stat-value { font-size:2.4rem; font-weight:800; color:var(--text-primary); letter-spacing:-1px; line-height:1; }
        .stat-value.danger { color:#f87171; }
        .stat-desc { font-size:.8rem; color:var(--text-muted); line-height:1.45; margin-top:2px; }
        .stat-icon-box { width:38px; height:38px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1rem; flex-shrink:0; }
        .stat-icon-box.teal   { background:rgba(59,195,189,0.13);  color:var(--primary); }
        .stat-icon-box.yellow { background:rgba(245,158,11,0.13);  color:#FBBF24; }
        .stat-icon-box.red    { background:rgba(239,68,68,0.13);   color:#f87171; }

        /* ─── Transaksi Section ──────────────────────────────────── */
        .section-card {
            background:var(--bg-card);
            border:1px solid var(--border-color);
            border-top:2px solid var(--primary-dim);
            border-radius:20px;
            padding:28px;
            box-shadow:0 10px 30px rgba(0,0,0,0.2);
            position:relative;
            transition:transform .25s, box-shadow .25s;
        }
        .section-card::after { content:''; position:absolute; inset:0; border-radius:20px; background:linear-gradient(145deg,rgba(59, 195, 189,0.03),transparent 60%); pointer-events:none; }
        .section-card:hover { transform:translateY(-4px); border-top-color:var(--primary); box-shadow:0 12px 32px rgba(0,0,0,.3),0 0 0 1px rgba(59, 195, 189,0.1); }

        .section-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
        .section-title-group {}
        .section-title { font-size:1.1rem; font-weight:700; color:var(--text-primary); }
        .section-total { font-size:.85rem; color:var(--text-muted); margin-left:8px; }
        .section-actions { display:flex; gap:8px; }

        .btn-icon { width:34px; height:34px; display:flex; align-items:center; justify-content:center; border:1px solid var(--border-color); background:transparent; color:var(--text-muted); border-radius:9px; cursor:pointer; transition:all 0.2s; font-size:.9rem; }
        .btn-icon:hover { border-color:var(--primary-dim); color:var(--primary); background:var(--primary-glow); }

        /* ─── Table ──────────────────────────────────────────────── */
        .table-container { width:100%; overflow-x:auto; }
        table { width:100%; border-collapse:collapse; }
        th { text-align:left; padding:12px 16px 18px; font-size:.72rem; color:var(--text-muted); font-weight:700; text-transform:uppercase; letter-spacing:0.8px; border-bottom:1px solid var(--border-color); }
        td { padding:20px 16px; border-bottom:1px solid rgba(46,68,89,0.35); vertical-align:middle; }
        tbody tr:last-child td { border-bottom:none; }
        tbody tr { transition:background 0.15s; }
        tbody tr:hover { background:rgba(59,195,189,0.035); }

        .invoice-id { font-weight:700; font-size:.9rem; color:var(--primary-bright); }
        .penulis-name { font-size:.875rem; color:var(--text-secondary); font-weight:500; }
        .jumlah-text { font-size:.9rem; font-weight:600; color:var(--text-primary); }
        .tanggal-text { font-size:.875rem; color:var(--text-secondary); }
        .metode-text { font-size:.875rem; color:var(--text-muted); }

        /* Status Badges — sama persis dengan daftar-pengajuan */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 600;
            white-space: nowrap;
        }
        .status-badge::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        /* Menunggu — abu-abu (seperti status-draft di daftar naskah) */
        .status-badge.waiting {
            background: rgba(122, 155, 170, 0.15);
            color: #7A9BAA;
        }
        .status-badge.waiting::before { background: #7A9BAA; }
        /* Disetujui — teal (seperti status-published di daftar naskah) */
        .status-badge.approved {
            background: rgba(59, 195, 189, 0.15);
            color: #3BC3BD;
        }
        .status-badge.approved::before { background: #3BC3BD; }
        /* Ditolak — merah soft, tone gelap yang nyaman di mata */
        .status-badge.rejected {
            background: rgba(239, 68, 68, 0.12);
            color: #F87171;
        }
        .status-badge.rejected::before { background: #F87171; }

        /* Action Icon Button */
        .aksi-btn { width:34px; height:34px; display:flex; align-items:center; justify-content:center; border:none; background:transparent; color:var(--primary); font-size:1.1rem; cursor:pointer; border-radius:8px; transition:all 0.2s; }
        .aksi-btn:hover { background:var(--primary-glow); color:var(--primary-bright); }

        /* ─── Table Footer / Pagination ─────────────────────────── */
        .table-footer { display:flex; align-items:center; justify-content:space-between; margin-top:24px; padding:4px 0; }
        .footer-text { font-size:.85rem; color:var(--text-muted); font-weight:500; }
        .pagination-container { display:flex; align-items:center; gap:6px; }
        .page-btn { width:32px; height:32px; display:flex; align-items:center; justify-content:center; border-radius:10px; border:1px solid var(--border-color); background:transparent; color:var(--text-secondary); font-size:.85rem; font-weight:600; cursor:pointer; transition:all 0.2s; }
        .page-btn:hover:not(.disabled):not(.active) { border-color:var(--primary); color:var(--primary); background:var(--primary-glow); }
        .page-btn.active { background:var(--primary); color:var(--bg-body); border-color:var(--primary); font-weight:700; }
        .page-btn.disabled { opacity:0.3; cursor:not-allowed; }

        /* ─── Modal Overlay ─────────────────────────────────────── */
        .modal-overlay {
            display:none;
            position:fixed; inset:0; z-index:999;
            background:rgba(0,0,0,0.65);
            backdrop-filter:blur(4px);
            align-items:center;
            justify-content:center;
            padding:24px;
        }
        .modal-overlay.open { display:flex; }

        .modal-box {
            background:var(--bg-card);
            border:1px solid var(--border-color);
            border-radius:24px;
            width:100%;
            max-width:680px;
            box-shadow:0 30px 60px rgba(0,0,0,0.5);
            overflow:hidden;
            animation:modalIn 0.28s cubic-bezier(0.16,1,0.3,1);
        }
        @keyframes modalIn {
            from { opacity:0; transform:scale(0.94) translateY(16px); }
            to   { opacity:1; transform:scale(1) translateY(0); }
        }

        /* Modal Header */
        .modal-header {
            display:flex; align-items:center; justify-content:space-between;
            padding:22px 28px 18px;
            border-bottom:1px solid var(--border-color);
        }
        .modal-title-group {}
        .modal-title { font-size:1.1rem; font-weight:700; color:var(--text-primary); }
        .modal-subtitle { font-size:.8rem; color:var(--text-muted); margin-top:2px; }
        .modal-close-btn {
            width:34px; height:34px; display:flex; align-items:center; justify-content:center;
            background:transparent; border:1px solid var(--border-color); border-radius:9px;
            color:var(--text-muted); cursor:pointer; font-size:1rem; transition:all 0.2s;
        }
        .modal-close-btn:hover { border-color:#f87171; color:#f87171; background:rgba(248,113,113,0.08); }

        /* Modal Body */
        .modal-body { padding:24px 28px; display:flex; flex-direction:column; gap:24px; }

        /* Invoice Section */
        .modal-section-label {
            font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:1px;
            color:var(--primary); margin-bottom:14px;
        }
        .invoice-grid {
            display:grid; grid-template-columns:1fr 1fr; gap:14px 28px;
        }
        .inv-field { display:flex; flex-direction:column; gap:3px; }
        .inv-label { font-size:.72rem; color:var(--text-muted); font-weight:600; }
        .inv-value { font-size:.9rem; color:var(--text-primary); font-weight:600; }
        .inv-value.highlight { color:var(--primary-bright); }

        .inv-divider { height:1px; background:var(--border-light); margin:4px 0; }

        /* Bukti Pembayaran */
        .bukti-box {
            background:var(--bg-elevated);
            border:1px dashed var(--border-color);
            border-radius:14px;
            padding:18px;
            display:flex; align-items:center; gap:14px;
        }
        .bukti-thumb {
            width:56px; height:56px; border-radius:10px;
            background:rgba(59,195,189,0.12);
            display:flex; align-items:center; justify-content:center;
            color:var(--primary); font-size:1.4rem; flex-shrink:0;
        }
        .bukti-info { flex:1; }
        .bukti-name { font-size:.875rem; font-weight:600; color:var(--text-primary); }
        .bukti-size { font-size:.75rem; color:var(--text-muted); margin-top:2px; }
        .bukti-download {
            display:inline-flex; align-items:center; gap:7px;
            padding:8px 16px; background:transparent;
            border:1px solid var(--primary-dim); border-radius:9px;
            color:var(--primary); font-size:.8rem; font-weight:600;
            cursor:pointer; transition:all 0.2s;
        }
        .bukti-download:hover { background:var(--primary-glow); border-color:var(--primary); }

        /* Modal Footer Actions */
        .modal-footer {
            display:flex; align-items:center; justify-content:flex-end; gap:10px;
            padding:16px 28px 24px;
        }
        .btn-modal-reject {
            padding:10px 22px; background:transparent;
            border:1px solid rgba(248,113,113,0.4); border-radius:12px;
            color:#f87171; font-size:.875rem; font-weight:600; cursor:pointer; transition:all 0.2s;
        }
        .btn-modal-reject:hover { background:rgba(248,113,113,0.08); border-color:#f87171; }
        .btn-modal-approve {
            padding:10px 24px; background:var(--primary);
            border:none; border-radius:12px;
            color:var(--bg-body); font-size:.875rem; font-weight:700; cursor:pointer; transition:all 0.2s;
        }
        .btn-modal-approve:hover { background:var(--primary-bright); transform:translateY(-2px); box-shadow:0 6px 16px var(--primary-glow); }
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
                <a href="/superadmin/dashboard" class="nav-link">
                    <i class="fa-solid fa-border-all"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/superadmin/cek-pembayaran" class="nav-link active">
                    <i class="fa-solid fa-credit-card"></i>
                    <span class="nav-link-text">Cek Pembayaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/superadmin/verifikasi" class="nav-link">
                    <i class="fa-solid fa-circle-check"></i>
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
        <header class="top-header">
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
                <div class="user-wrapper">
                    <div class="user-header" id="userToggle">
                        <div class="user-avatar">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=80&fit=crop&q=80" alt="Super Admin" style="width:100%; height:100%; object-fit:cover; border-radius:12px;">
                        </div>
                        <div class="user-header-info">
                            <div class="user-header-name">Super Admin</div>
                            <div class="user-header-role">Super Admin</div>
                        </div>
                        <i class="fa-solid fa-chevron-down" style="font-size:.625rem;color:var(--text-muted);margin-left:4px"></i>
                    </div>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="/profile" class="user-dropdown-item"><i class="fa-regular fa-user"></i><span>Profil Saya</span></a>
                        <a href="/akun" class="user-dropdown-item"><i class="fa-regular fa-id-badge"></i><span>Informasi Akun</span></a>
                        <a href="/pengaturan" class="user-dropdown-item"><i class="fa-solid fa-gear"></i><span>Pengaturan</span></a>
                        <div class="user-dropdown-divider"></div>
                        <a href="#" class="user-dropdown-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Cek Pembayaran</h1>
            <p class="page-subtitle">Verifikasi transaksi penulis dan kelola alur kerja keuangan.</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <!-- Card 1 -->
            <div class="stat-card">
                <div class="stat-card-top">
                    <span class="stat-label">Pembayaran Tertunda</span>
                    <div class="stat-icon-box teal"><i class="fa-regular fa-calendar-check"></i></div>
                </div>
                <div class="stat-value">24</div>
                <div class="stat-desc">Menunggu konfirmasi pembayaran</div>
            </div>
            <!-- Card 2 -->
            <div class="stat-card">
                <div class="stat-card-top">
                    <span class="stat-label">Total Terverifikasi Hari Ini</span>
                    <div class="stat-icon-box yellow"><i class="fa-solid fa-circle-check"></i></div>
                </div>
                <div class="stat-value">158</div>
                <div class="stat-desc">Pembayaran berhasil diverifikasi</div>
            </div>
            <!-- Card 3 -->
            <div class="stat-card">
                <div class="stat-card-top">
                    <span class="stat-label">Masalah Pembayaran</span>
                    <div class="stat-icon-box red"><i class="fa-solid fa-circle-exclamation"></i></div>
                </div>
                <div class="stat-value danger">03</div>
                <div class="stat-desc">Transaksi bermasalah atau ditolak</div>
            </div>
        </div>

        <!-- Transaksi Pembayaran Table -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-title-group">
                    <span class="section-title">Transaksi Pembayaran</span>
                    <span class="section-total">(482 Total)</span>
                </div>
                <div class="section-actions">
                    <button class="btn-icon" title="Filter"><i class="fa-solid fa-sliders"></i></button>
                    <button class="btn-icon" title="Urutkan"><i class="fa-solid fa-sort"></i></button>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID Faktur</th>
                            <th>Nama Penulis</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="paymentTableBody">
                        <!-- Row 1 -->
                        <tr data-status="cek-bayar">
                            <td><span class="invoice-id">#INV-2023-0891</span></td>
                            <td><span class="penulis-name">Dr. Ahmad Subagyo</span></td>
                            <td><span class="jumlah-text">Rp 2.500.000</span></td>
                            <td><span class="tanggal-text">24 Oct 2023</span></td>
                            <td><span class="metode-text">Bank Transfer</span></td>
                            <td><span class="status-badge waiting">Menunggu</span></td>
                            <td>
                                <button class="aksi-btn" title="Lihat Detail"
                                    data-inv="#INV-2023-0891" data-penulis="Dr. Ahmad Subagyo"
                                    data-jumlah="Rp 2.500.000" data-tanggal="24 Oktober 2023"
                                    data-metode="Bank Transfer" data-status="Cek Pembayaran"
                                    data-bank="BCA" data-norek="1234567890"
                                    data-bukti="bukti_transfer_0891.pdf"
                                    onclick="openModal(this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr data-status="published">
                            <td><span class="invoice-id">#INV-2023-0890</span></td>
                            <td><span class="penulis-name">Siti Aminah, M.Pd</span></td>
                            <td><span class="jumlah-text">Rp 1.200.000</span></td>
                            <td><span class="tanggal-text">23 Oct 2023</span></td>
                            <td><span class="metode-text">E-Wallet</span></td>
                            <td><span class="status-badge approved">Disetujui</span></td>
                            <td>
                                <button class="aksi-btn" title="Lihat Detail"
                                    data-inv="#INV-2023-0890" data-penulis="Siti Aminah, M.Pd"
                                    data-jumlah="Rp 1.200.000" data-tanggal="23 Oktober 2023"
                                    data-metode="E-Wallet" data-status="Published"
                                    data-bank="GoPay" data-norek="08123456789"
                                    data-bukti="https://via.placeholder.com/600x400"
                                    onclick="openModal(this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr data-status="proses-isbn">
                            <td><span class="invoice-id">#INV-2023-0889</span></td>
                            <td><span class="penulis-name">Budi Santoso</span></td>
                            <td><span class="jumlah-text">Rp 3.750.000</span></td>
                            <td><span class="tanggal-text">23 Oct 2023</span></td>
                            <td><span class="metode-text">Credit Card</span></td>
                            <td><span class="status-badge waiting">Menunggu</span></td>
                            <td>
                                <button class="aksi-btn" title="Lihat Detail"
                                    data-inv="#INV-2023-0889" data-penulis="Budi Santoso"
                                    data-jumlah="Rp 3.750.000" data-tanggal="23 Oktober 2023"
                                    data-metode="Credit Card" data-status="Proses ISBN"
                                    data-bank="Visa **** 4291" data-norek="-"
                                    data-bukti="bukti_cc_0889.pdf"
                                    onclick="openModal(this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr data-status="rejected">
                            <td><span class="invoice-id">#INV-2023-0888</span></td>
                            <td><span class="penulis-name">Prof. Laila Sari</span></td>
                            <td><span class="jumlah-text">Rp 2.000.000</span></td>
                            <td><span class="tanggal-text">22 Oct 2023</span></td>
                            <td><span class="metode-text">Bank Transfer</span></td>
                            <td><span class="status-badge rejected">Ditolak</span></td>
                            <td>
                                <button class="aksi-btn" title="Lihat Detail"
                                    data-inv="#INV-2023-0888" data-penulis="Prof. Laila Sari"
                                    data-jumlah="Rp 2.000.000" data-tanggal="22 Oktober 2023"
                                    data-metode="Bank Transfer" data-status="Rejected"
                                    data-bank="Mandiri" data-norek="9876543210"
                                    data-bukti="bukti_transfer_0888.pdf"
                                    onclick="openModal(this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table Footer / Pagination -->
            <div class="table-footer">
                <span class="footer-text">Menampilkan 1 sampai 10 dari 482 entri</span>
                <div class="pagination-container">
                    <button class="page-btn disabled"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

    </main>

    <!-- ═══════════════════ MODAL INVOICE ═══════════════════ -->
    <div class="modal-overlay" id="invoiceModal" onclick="handleOverlayClick(event)">
        <div class="modal-box">
            <div class="modal-header">
                <div class="modal-title-group">
                    <div class="modal-title" id="modalTitle">Detail Invoice</div>
                    <div class="modal-subtitle" id="modalSubtitle">Informasi transaksi dan bukti pembayaran</div>
                </div>
                <button class="modal-close-btn" onclick="closeModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="modal-body">
                <!-- Invoice Info -->
                <div>
                    <div class="modal-section-label"><i class="fa-solid fa-file-invoice" style="margin-right:6px;"></i>Informasi Invoice</div>
                    <div class="invoice-grid">
                        <div class="inv-field">
                            <span class="inv-label">ID Faktur</span>
                            <span class="inv-value highlight" id="mInvId">-</span>
                        </div>
                        <div class="inv-field">
                            <span class="inv-label">Status</span>
                            <span class="inv-value" id="mStatus">-</span>
                        </div>
                        <div class="inv-field">
                            <span class="inv-label">Nama Penulis</span>
                            <span class="inv-value" id="mPenulis">-</span>
                        </div>
                        <div class="inv-field">
                            <span class="inv-label">Tanggal Transaksi</span>
                            <span class="inv-value" id="mTanggal">-</span>
                        </div>
                        <div class="inv-field">
                            <span class="inv-label">Jumlah</span>
                            <span class="inv-value highlight" id="mJumlah">-</span>
                        </div>
                        <div class="inv-field">
                            <span class="inv-label">Metode Pembayaran</span>
                            <span class="inv-value" id="mMetode">-</span>
                        </div>
                        <div class="inv-field">
                            <span class="inv-label">Bank / Penyedia</span>
                            <span class="inv-value" id="mBank">-</span>
                        </div>
                        <div class="inv-field">
                            <span class="inv-label">No. Rekening / Akun</span>
                            <span class="inv-value" id="mNorek">-</span>
                        </div>
                    </div>
                </div>

                <div class="inv-divider"></div>

                <!-- Bukti Pembayaran -->
                <div>
                    <div class="modal-section-label"><i class="fa-solid fa-image" style="margin-right:6px;"></i>Bukti Pembayaran</div>
                    <div class="bukti-box" style="flex-direction:column; align-items:flex-start; gap:12px;">
                        <div style="display:flex; align-items:center; gap:10px; width:100%;">
                            <div class="bukti-thumb">
                                <i class="fa-solid fa-image"></i>
                            </div>
                            <div class="bukti-info">
                                <div class="bukti-name" id="mBuktiName">bukti_transfer.pdf</div>
                                <div class="bukti-size">PNG / JPG &bull; Diunggah oleh Penulis</div>
                            </div>
                        </div>
                        <img id="buktiImg" src="" alt="Bukti Pembayaran"
                             style="width:100%; max-height:320px; object-fit:contain; border-radius:10px; border:1px solid var(--border-color); background:var(--bg-body);">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-modal-reject" onclick="closeModal()"><i class="fa-solid fa-xmark" style="margin-right:6px;"></i>Tolak</button>
                <button class="btn-modal-approve"><i class="fa-solid fa-check" style="margin-right:6px;"></i>Verifikasi & Setujui</button>
            </div>
        </div>
    </div>

    <script>
        const sidebar     = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');
        userToggle.addEventListener('click', (e) => { e.stopPropagation(); userDropdown.classList.toggle('show'); });
        document.addEventListener('click', (e) => { if(!userDropdown.contains(e.target)&&!userToggle.contains(e.target)) userDropdown.classList.remove('show'); });

        function openModal(btn) {
            const d = btn.dataset;
            document.getElementById('mInvId').textContent    = d.inv;
            document.getElementById('mPenulis').textContent  = d.penulis;
            document.getElementById('mJumlah').textContent   = d.jumlah;
            document.getElementById('mTanggal').textContent  = d.tanggal;
            document.getElementById('mMetode').textContent   = d.metode;
            document.getElementById('mStatus').textContent   = d.status;
            document.getElementById('mBank').textContent     = d.bank;
            document.getElementById('mNorek').textContent    = d.norek;
            document.getElementById('mBuktiName').textContent= d.bukti;
            document.getElementById('buktiImg').src = d.bukti;
            document.getElementById('modalSubtitle').textContent = d.inv + ' · ' + d.penulis;
            document.getElementById('invoiceModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('invoiceModal').classList.remove('open');
            document.body.style.overflow = '';
        }

        function handleOverlayClick(e) {
            if (e.target === document.getElementById('invoiceModal')) closeModal();
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</body>
</html>
