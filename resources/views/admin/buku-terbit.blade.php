<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISBN YPIK PAM JAYA - Buku Terbit</title>
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
        body { background:var(--bg-body); color:var(--text-primary); display:flex; min-height:100vh; font-size:14px; line-height:1.5; overflow-x: hidden; }

        /* Sidebar */
        .sidebar { width:var(--sidebar-width); background:var(--bg-sidebar); border-right:1px solid var(--border-color); display:flex; flex-direction:column; position:fixed; height:100vh; transition:width 0.3s cubic-bezier(.4, 0, .2, 1); overflow:hidden; z-index:100; }
        .sidebar.collapsed { width:var(--sidebar-collapsed-width); }
        .brand { padding:18px 14px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid var(--border-color); min-height:66px; }
        .brand-content { display:flex; align-items:center; gap:10px; overflow:hidden; }
        .brand-icon { font-size:1.2rem; color:var(--primary); flex-shrink:0; width:28px; text-align:center; }
        .brand-text { font-size:.9375rem; font-weight:700; color:var(--primary); white-space:nowrap; transition:opacity 0.2s; }
        .sidebar.collapsed .brand-text { opacity:0; width:0; }
        .sidebar.collapsed .brand-subtitle { display:none; }
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
        
        .sidebar-footer { padding:14px 8px; border-top:1px solid var(--border-color); margin-top: auto; }
        .logout-btn { display:flex; align-items:center; gap:12px; padding:10px 12px; color:var(--text-muted); text-decoration:none; font-weight:500; font-size:.875rem; border-radius:10px; transition:all 0.2s; white-space:nowrap; cursor: pointer; }
        .logout-btn i { width:20px; min-width:20px; text-align:center; flex-shrink:0; }
        .logout-btn:hover { color:#f87171; background:rgba(248, 113, 113, 0.08); }
        .sidebar.collapsed .logout-btn span { opacity:0; width:0; overflow:hidden; }

        /* Main Content */
        .main-content { flex:1; margin-left:var(--sidebar-width); padding:0 36px 48px; transition:margin-left 0.3s cubic-bezier(.4, 0, .2, 1); }
        .main-content.expanded { margin-left:var(--sidebar-collapsed-width); }

        /* Top Header */
        .top-header { display:flex; justify-content:space-between; align-items:center; padding:20px 0; }
        .search-container { position:relative; width:340px; }
        .search-container i { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:.875rem; }
        .search-input { width:100%; padding:10px 14px 10px 38px; border:1px solid var(--border-color); background:var(--bg-card); border-radius:10px; font-size:.875rem; outline:none; color:var(--text-primary); transition:border-color 0.2s, box-shadow 0.2s; }
        .search-input::placeholder { color:var(--text-muted); }
        .search-input:focus { border-color:var(--primary-dim); box-shadow:0 0 0 3px var(--primary-glow); }

        .header-actions { 
            display:flex; 
            align-items:center; 
            background: rgba(15, 29, 38, 0.7);
            border: 1px solid var(--border-color);
            padding: 4px 12px 4px 4px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            gap: 0;
        }
        .header-icon-btn { width:38px; height:38px; display:flex; align-items:center; justify-content:center; border-radius:12px; border:none; background:transparent; color:var(--text-secondary); cursor:pointer; transition:all 0.2s; position:relative; font-size:1.1rem; }
        .header-icon-btn:hover { background:rgba(255,255,255,0.05); color:var(--primary-bright); }
        .header-divider { width:1px; height:24px; background:var(--border-color); margin:0 12px 0 8px; opacity: 0.6; }
        .notif-dot { position:absolute; top:10px; right:10px; width:6px; height:6px; background:#f87171; border-radius:50%; border:1.5px solid var(--bg-card); }
        
        .user-avatar-circle { 
            width: 32px; 
            height: 32px; 
            border-radius: 50%; 
            background: linear-gradient(135deg, var(--primary), var(--primary-dim)); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            overflow: hidden; 
            border: 1px solid var(--border-color); 
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .user-avatar-circle img { width: 100%; height: 100%; object-fit: cover; }

        /* Custom Styles for Buku Terbit page */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 24px;
            margin-bottom: 28px;
        }
        .page-header h1 {
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }
        .page-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
            max-width: 600px;
            line-height: 1.5;
        }
        .action-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .btn-filter {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border: 1px solid var(--border-color);
            background: rgba(27, 43, 56, 0.5);
            color: var(--text-secondary);
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-filter:hover {
            background: var(--bg-card);
            border-color: var(--primary);
            color: var(--primary);
        }
        .btn-export {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border: none;
            background: var(--primary);
            color: #0f1d26;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-export:hover {
            background: var(--primary-bright);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--primary-glow);
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--bg-elevated);
            min-width: 200px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            z-index: 10;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            margin-top: 8px;
        }
        .dropdown-content a {
            color: var(--text-secondary);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 0.875rem;
            transition: background 0.2s, color 0.2s;
        }
        .dropdown-content a:hover {
            background-color: var(--bg-card-hover);
            color: var(--primary);
        }
        .dropdown-content.show { 
            display: block; 
            animation: fadeIn 0.2s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card { 
            background: var(--bg-card); 
            border: 1px solid var(--border-color); 
            border-top: 2px solid var(--primary-dim); 
            border-radius: 14px; 
            padding: 24px; 
            box-shadow: 0 4px 20px rgba(0,0,0,.2); 
            position: relative; 
            overflow: hidden; 
            transition: transform .25s, box-shadow .25s; 
        }
        .card::after { 
            content: ''; 
            position: absolute; 
            inset: 0; 
            border-radius: 14px; 
            background: linear-gradient(145deg, rgba(59, 195, 189, 0.03), transparent 60%); 
            pointer-events: none; 
        }
        .card:hover { 
            transform: translateY(-4px); 
            border-top-color: var(--primary); 
            box-shadow: 0 12px 32px rgba(0,0,0,.3), 0 0 0 1px rgba(59, 195, 189, 0.1); 
        }

        /* Table */
        .table-container { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { 
            text-align: left; 
            padding: 0 0 14px; 
            font-size: .75rem; 
            color: var(--text-muted); 
            font-weight: 600; 
            text-transform: uppercase; 
            letter-spacing: .4px; 
            border-bottom: 1px solid var(--border-color); 
        }
        td { 
            padding: 16px 0; 
            border-bottom: 1px solid var(--border-light); 
            vertical-align: middle; 
            font-size: .875rem; 
        }
        tr:last-child td { border-bottom: none; }

        .judul-naskah-terbit {
            font-weight: 600;
            font-size: .875rem;
            color: var(--text-primary);
        }
        .penulis-naskah-terbit, .waktu-naskah-terbit {
            font-size: .875rem;
            color: var(--text-secondary);
            font-weight: 500;
        }
        .isbn-naskah-terbit {
            font-weight: 600;
            font-size: .875rem;
            color: var(--text-primary);
        }

        .action-btn { 
            width: 36px; 
            height: 36px; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 10px; 
            background: rgba(59, 195, 189, .1); 
            color: var(--primary); 
            text-decoration: none; 
            font-size: .875rem; 
            transition: all .2s; 
        }
        .action-btn:hover { 
            background: var(--primary); 
            color: #0f1d26; 
            transform: translateY(-2px); 
        }

        .table-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
            padding: 4px 16px;
        }
        .footer-text {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }
        
        .pagination-container {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .page-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .page-btn:hover:not(.disabled):not(.active) {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-glow);
        }
        .page-btn.active {
            background: var(--primary);
            color: var(--bg-body);
            border-color: var(--primary);
            font-weight: 700;
        }
        .page-btn.disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
    
        /* User Wrapper & Dropdown from User Profile */
        .user-wrapper { position:relative; }
        .user-header { display:flex; align-items:center; gap:12px; padding:4px 8px; border-radius:12px; cursor:pointer; transition:all 0.2s; }
        .user-header:hover { background:rgba(255,255,255,0.05); }
        .user-avatar-sm { width:40px; height:40px; background:linear-gradient(135deg, var(--primary), var(--primary-dim)); color:#fff; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1rem; box-shadow: 0 4px 12px rgba(59, 195, 189,0.3); }
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
        @keyframes dropdownFadeIn {
            from { opacity:0; transform:scale(0.95) translateY(-10px); }
            to { opacity:1; transform:scale(1) translateY(0); }
        }
        .user-dropdown-item {
            display:flex;
            align-items:center;
            gap:12px;
            padding:12px 18px;
            color:var(--text-secondary);
            text-decoration:none;
            font-size:.875rem;
            font-weight:600;
            transition:all 0.15s ease;
        }
        .user-dropdown-item:hover { background:rgba(59, 195, 189, 0.08); color:var(--primary-bright); }
        .user-dropdown-item.active { background:var(--primary-glow); color:var(--primary-bright); }
        .user-dropdown-item i { font-size:1.05rem; width:20px; text-align:center; }
        .user-dropdown-divider { height:1px; background:var(--border-color); margin:4px 0; }
</style>
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-content">
                <i class="fa-solid fa-book-bookmark brand-icon" style="font-size: 1.25rem; color: var(--primary);"></i>
                <div style="display: flex; flex-direction: column; overflow: hidden;">
                    <span class="brand-text">ISBN YPIK PAM JAYA</span>
                    <span class="brand-subtitle" style="font-size: 0.7rem; color: var(--text-muted); font-weight: 500; margin-top: -2px;">Admin Portal</span>
                </div>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/admin/dashboard" class="nav-link">
                    <i class="fa-solid fa-border-all"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/review-naskah" class="nav-link">
                    <i class="fa-solid fa-file-signature"></i>
                    <span class="nav-link-text">Review Naskah</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/buku-terbit" class="nav-link active">
                    <i class="fa-solid fa-book"></i>
                    <span class="nav-link-text">Buku Terbit</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/pengguna" class="nav-link">
                    <i class="fa-solid fa-users"></i>
                    <span class="nav-link-text">Pengguna</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-footer">
            <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket" style="transform: rotate(180deg);"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </aside>

    <main class="main-content" id="mainContent">
        <header class="top-header">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Cari naskah atau ISBN...">
            </div>
            <div class="header-actions" style="padding: 4px; border-radius: 16px;">
                <div class="user-wrapper">
                    @php
                        $db_user_name = Illuminate\Support\Facades\DB::table('akun_pengguna')->where('id', session('user_id'))->value('name') ?? session('user_name') ?? 'Admin';
                    @endphp
                    <div class="user-header" id="userToggle">
                        <div class="user-avatar-sm">{{ substr($db_user_name, 0, 1) }}</div>
                        <div class="user-header-info">
                            <div class="user-header-name">{{ $db_user_name }}</div>
                        </div>
                        <i class="fa-solid fa-chevron-down" style="font-size:.625rem;color:var(--text-muted);margin-left:4px"></i>
                    </div>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="/admin/profile" class="user-dropdown-item"><i class="fa-regular fa-user"></i><span>Profil Saya</span></a>
                        <div class="user-dropdown-divider"></div>
                        <a href="#" class="user-dropdown-item logout" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
                    </div>
                </div>
                <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

                <button class="btn-export" onclick="alert('Fitur ekspor data dalam pengembangan')">
                    <i class="fa-solid fa-download"></i> Ekspor Data
                </button>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 30%;">Judul Naskah</th>
                            <th style="width: 25%;">Nama Penulis</th>
                            <th style="width: 20%;">Waktu Terbit</th>
                            <th style="width: 20%;">Kode ISBN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($naskahs as $naskah)
                        <tr>
                            <td>
                                <div class="judul-naskah-terbit">{{ $naskah->judul }}</div>
                            </td>
                            <td>
                                <div class="penulis-naskah-terbit">{{ $naskah->penuliss->pluck('nama')->implode(', ') ?: 'Anonim' }}</div>
                            </td>
                            <td>
                                <div class="waktu-naskah-terbit">{{ $naskah->updated_at->format('d M Y, H:i') }}</div>
                            </td>
                            <td>
                                <div class="isbn-naskah-terbit">{{ $naskah->isbn }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 24px;">Belum ada buku terbit.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer / Pagination -->
            <div class="table-footer">
                <span class="footer-text">Menampilkan {{ $naskahs->firstItem() ?? 0 }}–{{ $naskahs->lastItem() ?? 0 }} dari {{ $naskahs->total() }} naskah</span>
                @if ($naskahs->hasPages())
                <div class="pagination-container">
                    @if ($naskahs->onFirstPage())
                        <span class="page-btn disabled" title="Sebelumnya"><i class="fa-solid fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $naskahs->previousPageUrl() }}" class="page-btn" title="Sebelumnya"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif

                    @foreach ($naskahs->getUrlRange(1, $naskahs->lastPage()) as $page => $url)
                        @if ($page == $naskahs->currentPage())
                            <span class="page-btn active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($naskahs->hasMorePages())
                        <a href="{{ $naskahs->nextPageUrl() }}" class="page-btn" title="Berikutnya"><i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <span class="page-btn disabled" title="Berikutnya"><i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // Dropdown toggle
        const filterBtn = document.getElementById('filterBtn');
        const filterDropdown = document.getElementById('filterDropdown');
        
        filterBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            filterDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown')) {
                if (filterDropdown.classList.contains('show')) {
                    filterDropdown.classList.remove('show');
                }
            }
        });
    </script>

    <script>
        // Toggle user dropdown
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');
        if (userToggle && userDropdown) {
            userToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.style.display = userDropdown.style.display === 'flex' ? 'none' : 'flex';
            });
            document.addEventListener('click', () => {
                userDropdown.style.display = 'none';
            });
        }
    </script>
</body>
</html>
