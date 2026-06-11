/* Shared Responsive CSS Styles */

@media (max-width: 1024px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 16px !important;
    }
    .content-layout {
        grid-template-columns: 1fr !important;
        gap: 24px !important;
    }
    .page-grid {
        grid-template-columns: 1fr !important;
        gap: 20px !important;
    }
    .detail-layout {
        grid-template-columns: 1fr !important;
        gap: 24px !important;
    }
}

@media (max-width: 768px) {
    body {
        overflow-x: hidden !important;
        position: relative;
    }
    
    /* Responsive Sidebar sliding menu overlay */
    .sidebar {
        position: fixed !important;
        left: -280px !important;
        width: 280px !important;
        height: 100vh !important;
        z-index: 9999 !important;
        transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 5px 0 25px rgba(0, 0, 0, 0.5);
    }
    
    .sidebar.collapsed {
        left: 0 !important;
        width: 280px !important;
    }
    
    /* Keep text visible on mobile when sidebar is sliding open */
    .sidebar.collapsed .brand-text,
    .sidebar.collapsed .nav-link-text,
    .sidebar.collapsed .logout-btn span,
    .sidebar.collapsed .sidebar-footer span {
        opacity: 1 !important;
        width: auto !important;
        overflow: visible !important;
        display: inline-block !important;
    }
    
    /* Floated Sidebar Toggle Hamburger Button on Mobile */
    .sidebar-toggle {
        position: fixed !important;
        left: 16px !important;
        top: 16px !important;
        z-index: 10000 !important;
        background: var(--bg-card) !important;
        border: 1px solid var(--border-color) !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4) !important;
        display: flex !important;
        opacity: 1 !important;
        width: 40px !important;
        height: 40px !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 10px !important;
        color: var(--text-primary) !important;
        cursor: pointer;
    }
    
    /* Toggle Button position reset when Sidebar is sliding open */
    .sidebar.collapsed .sidebar-toggle {
        position: absolute !important;
        left: auto !important;
        right: 14px !important;
        top: 18px !important;
        box-shadow: none !important;
        border: none !important;
        background: transparent !important;
        width: 30px !important;
        height: 30px !important;
    }
    
    /* Main Content offsets on Mobile */
    .main-content {
        margin-left: 0 !important;
        padding: 80px 16px 24px !important; /* Extra top padding for floated toggle */
        width: 100% !important;
        max-width: 100vw !important;
    }
    
    .main-content.expanded {
        margin-left: 0 !important;
    }
    
    /* Top Header stacking on Mobile */
    .top-header {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 16px !important;
        padding: 12px 0 !important;
    }
    
    .search-container {
        width: 100% !important;
    }
    
    .header-actions {
        width: 100% !important;
        justify-content: flex-end !important;
        gap: 12px !important;
        padding: 6px 12px !important;
    }
    
    /* Welcome banner header mobile layout */
    .welcome-section {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 16px !important;
        padding: 20px !important;
    }
    
    .welcome-meta {
        text-align: left !important;
        width: 100% !important;
    }
    
    .welcome-date {
        width: 100% !important;
        justify-content: flex-start !important;
    }
    
    /* Grid system stack on Mobile */
    .stats-grid {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
    }
    
    .form-grid, .form-grid-2, .form-grid-3, .form-grid-4 {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
    }
    
    /* Table overflow scroll container */
    .table-container {
        width: 100% !important;
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch;
    }
    
    /* Modal responsive box styling */
    .modal-box {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        border-radius: 16px !important;
    }
    
    /* Profile headers stacking */
    .profile-header {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 16px !important;
        padding: 20px !important;
    }
    
    .profile-header-right {
        width: 100% !important;
        justify-content: flex-start !important;
    }
}

@media (max-width: 480px) {
    .auth-card {
        padding: 30px 20px !important;
        border-radius: 16px !important;
    }
    .brand h1 {
        font-size: 1.35rem !important;
    }
}
