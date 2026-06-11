<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Pembayaran</title>
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

        /* ─── Sidebar ──────────────────────────────────── */
        .sidebar { width:var(--sidebar-width); background:var(--bg-sidebar); border-right:1px solid var(--border-color); display:flex; flex-direction:column; position:fixed; height:100vh; transition:width 0.3s cubic-bezier(.4,0,.2,1); overflow:hidden; z-index:100; }
        .sidebar.collapsed { width:var(--sidebar-collapsed-width); }
        .brand { padding:18px 14px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid var(--border-color); min-height:66px; }
        .brand-content { display:flex; align-items:center; gap:10px; overflow:hidden; }
        .brand-icon { font-size:1.2rem; color:var(--primary); flex-shrink:0; width:28px; text-align:center; }
        .brand-text { font-size:.9375rem; font-weight:700; color:var(--primary); white-space:nowrap; transition:opacity 0.2s; }
        .sidebar.collapsed .brand-text { opacity:0; width:0; }
        .sidebar-toggle { width:30px; height:30px; display:flex; align-items:center; justify-content:center; border:none; background:transparent; color:var(--text-muted); border-radius:7px; cursor:pointer; flex-shrink:0; font-size:.95rem; transition:background 0.2s, color 0.2s; }
        .sidebar-toggle:hover { background:var(--bg-card); color:var(--primary); }
        .nav-menu { list-style:none; padding:12px 8px; flex:1; overflow-y:auto; overflow-x:hidden; }
        .nav-item { margin-bottom:2px; }
        .nav-link { display:flex; align-items:center; gap:12px; padding:10px 12px; text-decoration:none; color:var(--text-muted); border-radius:10px; font-size:.875rem; font-weight:500; transition:all 0.2s; white-space:nowrap; overflow:hidden; }
        .nav-link i { width:20px; min-width:20px; text-align:center; font-size:1rem; flex-shrink:0; }
        .nav-link-text { transition:opacity 0.2s; }
        .sidebar.collapsed .nav-link-text { opacity:0; width:0; overflow:hidden; }
        .nav-link.active { background:linear-gradient(90deg, rgba(59, 195, 189, 0.16), rgba(59, 195, 189, 0.06)); color:var(--primary-bright); font-weight:600; border-left:2px solid var(--primary); }
        .nav-link:hover:not(.active) { background:var(--bg-card); color:var(--text-secondary); }
        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); margin-top:auto; }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; font-weight:500; font-size:.875rem; border-radius:10px; transition:all 0.2s; white-space:nowrap; cursor:pointer; }
        .logout-btn i { width:20px; min-width:20px; text-align:center; flex-shrink:0; }
        .logout-btn:hover { color:#f87171; background:rgba(248, 113, 113, 0.08); }
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }

        /* ─── Main Content ─────────────────────────────── */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 36px 48px; transition:margin-left 0.3s cubic-bezier(.4,0,.2,1); }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width); }

        /* ─── Top Header ───────────────────────────────── */
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
        .user-avatar { width:40px; height:40px; background:linear-gradient(135deg, var(--primary), var(--primary-dim)); color:#fff; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1rem; box-shadow:0 4px 12px rgba(59, 195, 189, 0.3); }
        .user-header-info { display:flex; flex-direction:column; gap:0; }
        .user-header-name { font-weight:700; font-size:.9375rem; color:var(--text-primary); line-height:1.2; }
        .user-header-role { font-size:.75rem; color:var(--text-muted); line-height:1.2; font-weight:500; }
        .user-dropdown { position:absolute; top:calc(100% + 12px); right:0; width:240px; background:var(--bg-card); border:1px solid var(--border-color); border-radius:16px; box-shadow:0 10px 40px rgba(0,0,0,0.5); display:none; flex-direction:column; z-index:1000; overflow:hidden; }
        .user-dropdown.show { display:flex; }
        .user-dropdown-item { padding:14px 20px; display:flex; align-items:center; gap:16px; color:var(--text-secondary); text-decoration:none; font-size:.875rem; font-weight:500; transition:all 0.2s; cursor:pointer; }
        .user-dropdown-item:hover { background:var(--bg-card-hover); color:var(--primary); }
        .user-dropdown-item i { width:20px; font-size:1.1rem; text-align:center; color:var(--text-muted); }
        .user-dropdown-divider { height:1px; background:var(--border-color); margin:8px 0; }
        .user-dropdown-item.logout { color:#f87171; }
        .user-dropdown-item.logout i { color:#f87171; }
        .user-dropdown-item.logout:hover { background:rgba(248,113,113,0.08); }

        /* ─── Page Title ───────────────────────────────── */
        .page-title { font-size:1.75rem; font-weight:800; color:var(--text-primary); margin-top:10px; margin-bottom:6px; }
        .page-subtitle { font-size:.9rem; color:var(--text-muted); margin-bottom:28px; font-weight:500; }
        /* ─── Table Card ───────────────────────────────── */
        .table-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-top: 2px solid var(--primary-dim);
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            transition: transform .25s, box-shadow .25s;
        }
        .table-card::after {
            content:'';
            position: absolute;
            inset: 0;
            border-radius: 18px;
            background: linear-gradient(145deg, rgba(59,195,189,0.03), transparent 60%);
            pointer-events: none;
        }
        .card-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:22px; }
        .card-title { font-size:1.1rem; font-weight:700; color:var(--text-primary); display:flex; align-items:center; gap:10px; }
        .card-title i { color:var(--primary); }
        .card-badge {
            background: rgba(59,195,189,0.15);
            color: var(--primary-bright);
            border-radius: 20px;
            padding: 4px 12px;
            font-size: .75rem;
            font-weight: 700;
        }

        /* ─── Table ────────────────────────────────────── */
        .table-container { width:100%; overflow-x:auto; }
        table { width:100%; border-collapse:collapse; }
        th { text-align:left; padding:0 0 14px; font-size:.72rem; color:var(--text-muted); font-weight:700; text-transform:uppercase; letter-spacing:.8px; border-bottom:1px solid var(--border-color); }
        td { padding:18px 0; border-bottom:1px solid var(--border-light); vertical-align:middle; }
        tr:last-child td { border-bottom:none; }
        tbody tr { transition: background 0.15s; }
        tbody tr:hover { background: rgba(59,195,189,0.025); }

        .naskah-title { font-weight:700; font-size:.9375rem; color:var(--text-primary); margin-bottom:3px; }
        .naskah-id { font-size:.75rem; color:var(--primary); font-weight:600; }
        .genre-badge {
            display: inline-flex; align-items:center;
            padding: 4px 10px;
            background: rgba(107,114,128,0.15);
            color: #9CA3AF;
            border-radius: 8px;
            font-size: .72rem;
            font-weight: 600;
        }

        /* ─── Status Badges ────────────────────────────── */
        .status-badge { display:inline-flex; align-items:center; gap:5px; padding:5px 12px; border-radius:20px; font-size:.75rem; font-weight:600; white-space:nowrap; }
        .status-badge::before { content:''; display:inline-block; width:6px; height:6px; border-radius:50%; flex-shrink:0; }
        .status-disetujui { background:rgba(59,195,189,0.15); color:#3BC3BD; }
        .status-disetujui::before { background:#3BC3BD; }
        .status-menunggu { background:rgba(245,158,11,0.12); color:#FBBF24; }
        .status-menunggu::before { background:#FBBF24; }
        .status-lunas { background:rgba(16,185,129,0.12); color:#34D399; }
        .status-lunas::before { background:#34D399; }

        /* ─── Jumlah Text ──────────────────────────────── */
        .jumlah-text { font-size:.9375rem; font-weight:700; color:var(--primary-bright); }
        .tanggal-text { font-size:.825rem; color:var(--text-secondary); font-weight:500; }

        /* ─── Action Button ────────────────────────────── */
        .btn-bayar {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--primary);
            color: var(--bg-body);
            border: none;
            border-radius: 20px;
            padding: 9px 20px;
            font-size: .825rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            white-space: nowrap;
        }
        .btn-bayar:hover { background:var(--primary-bright); transform:translateY(-2px); box-shadow:0 6px 16px var(--primary-glow); }
        .btn-sudah-bayar {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            color: #34D399;
            border: 1px solid rgba(52,211,153,0.3);
            border-radius: 20px;
            padding: 9px 18px;
            font-size: .825rem;
            font-weight: 600;
            cursor: default;
            white-space: nowrap;
        }

        /* ─── Modal Overlay ────────────────────────────── */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(8, 18, 25, 0.85);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 500;
            padding: 20px;
            animation: fadeIn 0.2s ease;
        }
        .modal-overlay.show { display:flex; }
        @keyframes fadeIn { from{opacity:0} to{opacity:1} }

        .modal-box {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 22px;
            width: 100%;
            max-width: 560px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 30px 80px rgba(0,0,0,0.6), 0 0 0 1px rgba(59,195,189,0.08);
            animation: slideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes slideUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }

        /* Modal Scrollbar */
        .modal-box::-webkit-scrollbar { width:6px; }
        .modal-box::-webkit-scrollbar-track { background: transparent; }
        .modal-box::-webkit-scrollbar-thumb { background:var(--border-color); border-radius:3px; }

        /* ─── Modal Header ─────────────────────────────── */
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 24px 28px 20px;
            border-bottom: 1px solid var(--border-light);
        }
        .modal-title { font-size: 1.15rem; font-weight: 800; color: var(--text-primary); margin-bottom: 4px; }
        .modal-subtitle { font-size: .8rem; color: var(--text-muted); font-weight: 500; }
        .modal-close {
            width: 36px; height: 36px;
            display: flex; align-items:center; justify-content:center;
            background: var(--bg-elevated);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1rem;
            flex-shrink: 0;
        }
        .modal-close:hover { background: rgba(248,113,113,0.1); color: #f87171; border-color: rgba(248,113,113,0.3); }

        /* ─── Modal Body ───────────────────────────────── */
        .modal-body { padding: 24px 28px; display:flex; flex-direction:column; gap:20px; }

        /* Info rekening singkat di modal */
        .modal-rekening-info {
            background: rgba(59,195,189,0.06);
            border: 1px solid rgba(59,195,189,0.15);
            border-radius: 14px;
            padding: 16px 18px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .modal-rekening-label {
            font-size: .68rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1px; color: var(--primary); margin-bottom: 6px;
            display: flex; align-items:center; gap:7px;
        }
        .modal-rekening-row { display:flex; justify-content:space-between; align-items:center; }
        .modal-rek-key { font-size: .8rem; color: var(--text-muted); font-weight: 500; }
        .modal-rek-val { font-size: .875rem; color: var(--text-primary); font-weight: 700; }
        .modal-rek-val.big { font-size: 1.05rem; color: var(--primary-bright); letter-spacing:.3px; }

        /* Section Label */
        .section-label {
            font-size: .68rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1px; color: var(--primary);
            display: flex; align-items:center; gap: 7px;
            margin-bottom: 14px;
        }

        /* ─── Form Styles ──────────────────────────────── */
        .form-group { display: flex; flex-direction:column; gap:6px; }
        .form-label { font-size: .8rem; font-weight: 600; color: var(--text-secondary); }
        .form-label span.req { color: #f87171; margin-left: 2px; }
        .form-control {
            width: 100%;
            padding: 11px 14px;
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            border-radius: 11px;
            font-size: .875rem;
            color: var(--text-primary);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .form-control::placeholder { color: var(--text-muted); }
        .form-control:focus { border-color: var(--primary-dim); box-shadow: 0 0 0 3px var(--primary-glow); }
        .form-control option { background: var(--bg-card); }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        /* File Upload */
        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            background: var(--bg-input);
        }
        .file-upload-area:hover, .file-upload-area.dragover {
            border-color: var(--primary-dim);
            background: rgba(59,195,189,0.05);
        }
        .file-upload-area input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .file-upload-icon { font-size: 1.8rem; color: var(--primary-dim); margin-bottom: 8px; }
        .file-upload-text { font-size: .875rem; color: var(--text-secondary); font-weight: 500; }
        .file-upload-hint { font-size: .75rem; color: var(--text-muted); margin-top: 4px; }
        .file-preview {
            display: none;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(59,195,189,0.06);
            border: 1px solid rgba(59,195,189,0.15);
            border-radius: 10px;
            margin-top: 10px;
        }
        .file-preview.show { display: flex; }
        .file-preview-icon { width:40px; height:40px; border-radius:8px; background:rgba(59,195,189,0.12); display:flex; align-items:center; justify-content:center; color:var(--primary); font-size:1.1rem; flex-shrink:0; }
        .file-preview-name { font-size:.825rem; font-weight:600; color:var(--text-primary); }
        .file-preview-size { font-size:.72rem; color:var(--text-muted); margin-top:1px; }
        .file-remove { margin-left:auto; width:28px; height:28px; display:flex; align-items:center; justify-content:center; border-radius:7px; border:none; background:transparent; color:var(--text-muted); cursor:pointer; transition:all 0.2s; }
        .file-remove:hover { color:#f87171; background:rgba(248,113,113,0.1); }

        /* ─── Modal Footer ─────────────────────────────── */
        .modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 28px 24px;
            border-top: 1px solid var(--border-light);
        }
        .btn-cancel {
            padding: 10px 22px;
            background: transparent;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-secondary);
            font-size: .875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-cancel:hover { border-color: var(--text-secondary); color: var(--text-primary); }
        .btn-submit {
            padding: 10px 28px;
            background: var(--primary);
            border: none;
            border-radius: 12px;
            color: var(--bg-body);
            font-size: .875rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex; align-items:center; gap:8px;
        }
        .btn-submit:hover { background: var(--primary-bright); transform:translateY(-1px); box-shadow:0 6px 18px var(--primary-glow); }

        /* ─── Empty State ──────────────────────────────── */
        .empty-state { text-align:center; padding: 60px 20px; }
        .empty-icon { font-size: 3rem; color: var(--text-muted); margin-bottom: 14px; }
        .empty-title { font-size: 1rem; font-weight:700; color:var(--text-primary); margin-bottom: 6px; }
        .empty-desc { font-size: .875rem; color:var(--text-muted); }

        /* ─── Toast Notification ────────────────────────── */
        .toast {
            position: fixed;
            bottom: 30px; right: 30px;
            background: var(--bg-card);
            border: 1px solid rgba(52,211,153,0.3);
            border-left: 4px solid #34D399;
            border-radius: 14px;
            padding: 16px 20px;
            display: none;
            align-items: center;
            gap: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            z-index: 9999;
            min-width: 280px;
            animation: slideRight 0.3s ease;
        }
        .toast.show { display:flex; }
        @keyframes slideRight { from{opacity:0;transform:translateX(40px)} to{opacity:1;transform:translateX(0)} }
        .toast-icon { font-size:1.2rem; color:#34D399; }
        .toast-title { font-size:.875rem; font-weight:700; color:var(--text-primary); }
        .toast-desc { font-size:.78rem; color:var(--text-muted); margin-top:1px; }
    </style>
</head>
<body>

    <!-- ─── Sidebar ─────────────────────────────────────── -->
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-content">
                <i class="fa-solid fa-book-bookmark brand-icon"></i>
                <span class="brand-text">ISBN YPIK PAM JAYA</span>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <ul class="nav-menu">
            <li class="nav-item"><a href="/dashboard" class="nav-link"><i class="fa-solid fa-border-all"></i><span class="nav-link-text">Dashboard</span></a></li>
            <li class="nav-item"><a href="/pengajuan" class="nav-link"><i class="fa-regular fa-file-lines"></i><span class="nav-link-text">Pengajuan</span></a></li>
            <li class="nav-item"><a href="/daftar-pengajuan" class="nav-link"><i class="fa-solid fa-list-check"></i><span class="nav-link-text">Daftar Naskah</span></a></li>
            <li class="nav-item"><a href="/draf" class="nav-link"><i class="fa-solid fa-inbox"></i><span class="nav-link-text">Draf Naskah</span></a></li>
            <li class="nav-item"><a href="/pembayaran" class="nav-link active"><i class="fa-solid fa-credit-card"></i><span class="nav-link-text">Pembayaran</span></a></li>
            <li class="nav-item"><a href="/informasi" class="nav-link"><i class="fa-regular fa-user"></i><span class="nav-link-text">Informasi Penulis</span></a></li>
        </ul>

        <div class="sidebar-footer">
            <a href="/logout" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
        </div>
    </aside>

    <!-- ─── Main Content ─────────────────────────────────── -->
    <main class="main-content" id="mainContent">
        <header class="top-header">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Cari naskah atau ISBN...">
            </div>
            <div class="header-actions">
                <button class="header-icon-btn" id="notifToggle">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <div class="header-divider"></div>
                <div class="user-wrapper">
                    <div class="user-header" id="userToggle">
                        <div class="user-avatar">{{ strtoupper(substr(session('user_name', 'P'), 0, 1)) }}</div>
                        <div class="user-header-info">
                            <div class="user-header-name">{{ session('user_name', 'Pradama') }}</div>
                        </div>
                        <i class="fa-solid fa-chevron-down" style="font-size:.625rem;color:var(--text-muted);margin-left:4px"></i>
                    </div>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="/profile" class="user-dropdown-item"><i class="fa-regular fa-user"></i><span>Profil Saya</span></a>
                        <div class="user-dropdown-divider"></div>
                        <a href="/logout" class="user-dropdown-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Title -->
        <h1 class="page-title">Pembayaran</h1>
        <p class="page-subtitle">Kelola pembayaran untuk naskah yang telah disetujui oleh admin.</p>
        <!-- ─── Naskah Table Card ──────────────────────── -->
        <div class="table-card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    Daftar Naskah Disetujui
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NASKAH</th>
                            <th>GENRE</th>
                            <th>TANGGAL DISETUJUI</th>
                            <th>JUMLAH</th>
                            <th>STATUS BAYAR</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Row 1 — Belum bayar -->
                        <tr>
                            <td>
                                <div class="naskah-title">Analisis Perubahan Iklim Global</div>
                                <div class="naskah-id">ID: MS-8829</div>
                            </td>
                            <td><span class="genre-badge">Sains & Alam</span></td>
                            <td><span class="tanggal-text">14 Mei 2026</span></td>
                            <td><span class="jumlah-text">Rp 2.500.000</span></td>
                            <td><span class="status-badge status-menunggu">Menunggu Bayar</span></td>
                            <td>
                                <button class="btn-bayar"
                                    onclick="openModal('MS-8829', 'Analisis Perubahan Iklim Global', 'Rp 2.500.000')"
                                    id="btn-MS-8829">
                                    <i class="fa-solid fa-upload"></i> Bayar Sekarang
                                </button>
                            </td>
                        </tr>
                        <!-- Row 2 — Belum bayar -->
                        <tr>
                            <td>
                                <div class="naskah-title">Metodologi Penelitian Kuantitatif</div>
                                <div class="naskah-id">ID: MS-7741</div>
                            </td>
                            <td><span class="genre-badge">Akademik</span></td>
                            <td><span class="tanggal-text">20 Mei 2026</span></td>
                            <td><span class="jumlah-text">Rp 1.800.000</span></td>
                            <td><span class="status-badge status-menunggu">Menunggu Bayar</span></td>
                            <td>
                                <button class="btn-bayar"
                                    onclick="openModal('MS-7741', 'Metodologi Penelitian Kuantitatif', 'Rp 1.800.000')"
                                    id="btn-MS-7741">
                                    <i class="fa-solid fa-upload"></i> Bayar Sekarang
                                </button>
                            </td>
                        </tr>
                        <!-- Row 3 — Belum bayar -->
                        <tr>
                            <td>
                                <div class="naskah-title">Kumpulan Puisi Senja Nusantara</div>
                                <div class="naskah-id">ID: MS-6612</div>
                            </td>
                            <td><span class="genre-badge">Sastra</span></td>
                            <td><span class="tanggal-text">24 Mei 2026</span></td>
                            <td><span class="jumlah-text">Rp 1.200.000</span></td>
                            <td><span class="status-badge status-menunggu">Menunggu Bayar</span></td>
                            <td>
                                <button class="btn-bayar"
                                    onclick="openModal('MS-6612', 'Kumpulan Puisi Senja Nusantara', 'Rp 1.200.000')"
                                    id="btn-MS-6612">
                                    <i class="fa-solid fa-upload"></i> Bayar Sekarang
                                </button>
                            </td>
                        </tr>
                        <!-- Row 4 — Sudah bayar (lunas) -->
                        <tr>
                            <td>
                                <div class="naskah-title">Data Science for Business Intelligence</div>
                                <div class="naskah-id">ID: MS-5503</div>
                            </td>
                            <td><span class="genre-badge">Teknologi</span></td>
                            <td><span class="tanggal-text">02 Mei 2026</span></td>
                            <td><span class="jumlah-text">Rp 3.000.000</span></td>
                            <td><span class="status-badge status-lunas">Lunas</span></td>
                            <td>
                                <span class="btn-sudah-bayar">
                                    <i class="fa-solid fa-circle-check"></i> Sudah Dibayar
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- ─── Modal Input Pembayaran ───────────────────────── -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-box" id="modalBox">
            <!-- Modal Header -->
            <div class="modal-header">
                <div>
                    <div class="modal-title">Input Data Pembayaran</div>
                    <div class="modal-subtitle" id="modalSubtitle">Lengkapi data transfer untuk naskah Anda</div>
                </div>
                <button class="modal-close" onclick="closeModal()" id="btnCloseModal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="modal-body">

                <!-- Info Naskah -->
                <div>
                    <div class="section-label"><i class="fa-solid fa-file-lines"></i>Informasi Naskah</div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px 24px;">
                        <div style="display:flex; flex-direction:column; gap:3px;">
                            <span style="font-size:.72rem; color:var(--text-muted); font-weight:600; text-transform:uppercase;">ID Naskah</span>
                            <span style="font-size:.9rem; color:var(--primary-bright); font-weight:700;" id="mNaskahId">-</span>
                        </div>
                        <div style="display:flex; flex-direction:column; gap:3px;">
                            <span style="font-size:.72rem; color:var(--text-muted); font-weight:600; text-transform:uppercase;">Total Tagihan</span>
                            <span style="font-size:.9rem; color:var(--primary-bright); font-weight:700;" id="mJumlah">-</span>
                        </div>
                        <div style="display:flex; flex-direction:column; gap:3px; grid-column:span 2;">
                            <span style="font-size:.72rem; color:var(--text-muted); font-weight:600; text-transform:uppercase;">Judul Naskah</span>
                            <span style="font-size:.875rem; color:var(--text-primary); font-weight:600;" id="mJudul">-</span>
                        </div>
                    </div>
                </div>

                <div style="height:1px; background:var(--border-light);"></div>

                <!-- Info Rekening tujuan -->
                <div class="modal-rekening-info">
                    <div class="modal-rekening-label"><i class="fa-solid fa-building-columns"></i>Transfer ke Rekening</div>
                    <div class="modal-rekening-row">
                        <span class="modal-rek-key">Bank</span>
                        <span class="modal-rek-val">Bank Central Asia (BCA)</span>
                    </div>
                    <div class="modal-rekening-row">
                        <span class="modal-rek-key">No. Rekening</span>
                        <span class="modal-rek-val big">1234 5678 90</span>
                    </div>
                    <div class="modal-rekening-row">
                        <span class="modal-rek-key">Atas Nama</span>
                        <span class="modal-rek-val">YPIK PAM JAYA</span>
                    </div>
                </div>

                <div style="height:1px; background:var(--border-light);"></div>

                <!-- Form Data Transfer -->
                <div>
                    <div class="section-label"><i class="fa-solid fa-file-invoice"></i>Data Transfer Anda</div>

                    <div style="display:flex; flex-direction:column; gap:14px;">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="inputMetode">Metode Pembayaran <span class="req">*</span></label>
                                <select class="form-control" id="inputMetode">
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="transfer_antar_bank">Transfer Antar Bank</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="inputTanggal">Tanggal Transfer <span class="req">*</span></label>
                                <input type="date" class="form-control" id="inputTanggal">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="inputBank">Bank Pengirim <span class="req">*</span></label>
                                <select class="form-control" id="inputBank">
                                    <option value="">-- Pilih Bank --</option>
                                    <option>BCA</option>
                                    <option>BNI</option>
                                    <option>BRI</option>
                                    <option>Mandiri</option>
                                    <option>BTN</option>
                                    <option>CIMB Niaga</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="inputNoRek">No. Rekening Pengirim <span class="req">*</span></label>
                                <input type="text" class="form-control" id="inputNoRek" placeholder="Contoh: 0987654321">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="inputNamaRek">Nama Pemilik Rekening <span class="req">*</span></label>
                            <input type="text" class="form-control" id="inputNamaRek" placeholder="Sesuai nama di buku tabungan">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="inputJumlahTransfer">Jumlah Transfer (Rp) <span class="req">*</span></label>
                            <input type="text" class="form-control" id="inputJumlahTransfer" placeholder="Contoh: 2.500.000">
                        </div>

                        <!-- Upload Bukti -->
                        <div class="form-group">
                            <label class="form-label">Bukti Pembayaran <span class="req">*</span></label>
                            <div class="file-upload-area" id="fileUploadArea">
                                <input type="file" id="buktiFile" accept="image/*,.pdf" onchange="handleFileChange(event)">
                                <div id="uploadPlaceholder">
                                    <div class="file-upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                    <div class="file-upload-text">Klik atau seret file ke sini</div>
                                    <div class="file-upload-hint">PNG, JPG, atau PDF • Maks. 5 MB</div>
                                </div>
                            </div>
                            <div class="file-preview" id="filePreview">
                                <div class="file-preview-icon"><i class="fa-solid fa-file-image"></i></div>
                                <div>
                                    <div class="file-preview-name" id="previewName">—</div>
                                    <div class="file-preview-size" id="previewSize">—</div>
                                </div>
                                <button class="file-remove" onclick="removeFile()" title="Hapus file"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="inputCatatan">Catatan (Opsional)</label>
                            <textarea class="form-control" id="inputCatatan" rows="2" placeholder="Tambahkan catatan jika diperlukan..." style="resize:none;"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal()">Batal</button>
                <button class="btn-submit" onclick="submitPembayaran()">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Data Pembayaran
                </button>
            </div>
        </div>
    </div>

    <!-- ─── Toast ─────────────────────────────────────────── -->
    <div class="toast" id="toastNotif">
        <div class="toast-icon"><i class="fa-solid fa-circle-check"></i></div>
        <div>
            <div class="toast-title">Pembayaran Berhasil Dikirim!</div>
            <div class="toast-desc">Data Anda sedang diverifikasi oleh admin.</div>
        </div>
    </div>

    <script>
        // ── Sidebar toggle ──────────────────────────────
        const sidebar     = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // ── User dropdown ───────────────────────────────
        const userToggle   = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');
        userToggle.addEventListener('click', e => { e.stopPropagation(); userDropdown.classList.toggle('show'); });
        document.addEventListener('click', () => userDropdown.classList.remove('show'));

        // ── State ───────────────────────────────────────
        let currentNaskahId = null;

        // ── Open Modal ──────────────────────────────────
        function openModal(id, judul, jumlah) {
            currentNaskahId = id;
            document.getElementById('mNaskahId').textContent = id;
            document.getElementById('mJudul').textContent    = judul;
            document.getElementById('mJumlah').textContent   = jumlah;
            document.getElementById('modalSubtitle').textContent = judul;

            // Reset form
            document.getElementById('inputMetode').value        = '';
            document.getElementById('inputTanggal').value       = '';
            document.getElementById('inputBank').value          = '';
            document.getElementById('inputNoRek').value         = '';
            document.getElementById('inputNamaRek').value       = '';
            document.getElementById('inputJumlahTransfer').value = '';
            document.getElementById('inputCatatan').value       = '';
            removeFile();

            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('inputTanggal').value = today;

            document.getElementById('modalOverlay').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        // ── Close Modal ─────────────────────────────────
        function closeModal() {
            document.getElementById('modalOverlay').classList.remove('show');
            document.body.style.overflow = '';
        }

        // Close on overlay click
        document.getElementById('modalOverlay').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // ── File Handling ───────────────────────────────
        function handleFileChange(event) {
            const file = event.target.files[0];
            if (!file) return;
            const area = document.getElementById('fileUploadArea');
            area.style.display = 'none';

            document.getElementById('previewName').textContent = file.name;
            const kb = (file.size / 1024).toFixed(1);
            const mb = (file.size / (1024*1024)).toFixed(2);
            document.getElementById('previewSize').textContent = file.size > 1024*1024 ? `${mb} MB` : `${kb} KB`;

            const icon = document.getElementById('filePreview').querySelector('.file-preview-icon i');
            if (file.type.startsWith('image/')) icon.className = 'fa-solid fa-file-image';
            else if (file.type === 'application/pdf') icon.className = 'fa-solid fa-file-pdf';
            else icon.className = 'fa-solid fa-file';

            document.getElementById('filePreview').classList.add('show');
        }

        function removeFile() {
            document.getElementById('buktiFile').value = '';
            document.getElementById('filePreview').classList.remove('show');
            document.getElementById('fileUploadArea').style.display = '';
        }

        // ── Drag & Drop ─────────────────────────────────
        const dropArea = document.getElementById('fileUploadArea');
        dropArea.addEventListener('dragover', e => { e.preventDefault(); dropArea.classList.add('dragover'); });
        dropArea.addEventListener('dragleave', () => dropArea.classList.remove('dragover'));
        dropArea.addEventListener('drop', e => {
            e.preventDefault();
            dropArea.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('buktiFile').files = dt.files;
                handleFileChange({ target: document.getElementById('buktiFile') });
            }
        });

        // ── Submit ──────────────────────────────────────
        function submitPembayaran() {
            const metode   = document.getElementById('inputMetode').value;
            const tanggal  = document.getElementById('inputTanggal').value;
            const bank     = document.getElementById('inputBank').value;
            const noRek    = document.getElementById('inputNoRek').value.trim();
            const namaRek  = document.getElementById('inputNamaRek').value.trim();
            const jumlah   = document.getElementById('inputJumlahTransfer').value.trim();
            const file     = document.getElementById('buktiFile').files[0];

            if (!metode || !tanggal || !bank || !noRek || !namaRek || !jumlah || !file) {
                alert('Harap lengkapi semua data yang wajib diisi dan upload bukti pembayaran.');
                return;
            }

            closeModal();

            // Update button to "Sudah Dibayar"
            const btn = document.getElementById('btn-' + currentNaskahId);
            if (btn) {
                const newSpan = document.createElement('span');
                newSpan.className = 'btn-sudah-bayar';
                newSpan.innerHTML = '<i class="fa-solid fa-circle-check"></i> Sedang Diverifikasi';
                btn.parentNode.replaceChild(newSpan, btn);
            }

            // Update status badge
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const idEl = row.querySelector('.naskah-id');
                if (idEl && idEl.textContent.includes(currentNaskahId)) {
                    const badge = row.querySelector('.status-badge');
                    if (badge) {
                        badge.className = 'status-badge status-disetujui';
                        badge.textContent = 'Menunggu Verifikasi';
                    }
                }
            });

            // Show toast
            const toast = document.getElementById('toastNotif');
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 4000);
        }
    </script>
</body>
</html>
