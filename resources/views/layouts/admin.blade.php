<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin OWEW</title>

    <!-- Favicons -->
    @include('partials.favicons')

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        :root {
            --primary: #4B0082;
            --secondary: #FF9800;
            --dark: #1A1A2E;
            --light: #F8F9FA;
            --white: #FFFFFF;
            --sidebar-width: 280px;
            --topbar-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #F0F2F5;
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary) 0%, #3a0066 100%);
            color: var(--white);
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }

        .sidebar-brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .sidebar-brand-text h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .sidebar-brand-text small {
            opacity: 0.8;
            font-size: 0.75rem;
        }

        .sidebar-menu {
            padding: 1.5rem 0;
        }

        .menu-label {
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            opacity: 0.6;
            letter-spacing: 1px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.9rem 1.5rem;
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .menu-item i {
            width: 24px;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            color: var(--secondary);
        }

        .menu-item.active {
            background: rgba(255,152,0,0.2);
            border-left: 4px solid var(--secondary);
            color: var(--secondary);
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 100%;
            background: var(--secondary);
        }

        .badge-count {
            margin-left: auto;
            background: var(--secondary);
            color: var(--white);
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
            font-weight: 600;
        }

        /* Overlay pour mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            padding: 0 2rem;
            z-index: 999;
            transition: all 0.3s ease;
        }

        /* Menu toggle button (mobile) */
        .menu-toggle {
            display: none;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: #F3F4F6;
            color: #6B7280;
            border: none;
            cursor: pointer;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            background: var(--primary);
            color: var(--white);
        }

        .topbar-search {
            flex: 1;
            max-width: 500px;
            position: relative;
        }

        .topbar-search input {
            width: 100%;
            padding: 0.7rem 1rem 0.7rem 3rem;
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .topbar-search input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(75,0,130,0.1);
        }

        .topbar-search i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-left: auto;
        }

        .topbar-btn {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F3F4F6;
            color: #6B7280;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .topbar-btn:hover {
            background: var(--primary);
            color: var(--white);
        }

        .topbar-btn .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #EF4444;
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.4rem;
            border-radius: 10px;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.5rem 1rem;
            background: #F3F4F6;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-dropdown:hover {
            background: #E5E7EB;
        }

        .user-dropdown img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary);
        }

        .user-info h6 {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .user-info small {
            color: #6B7280;
            font-size: 0.75rem;
        }

        /* Language Switcher */
        .lang-switcher .lang-btn {
            color: #6B7280;
            background: #F3F4F6;
        }

        .lang-switcher .lang-btn:hover {
            background: var(--primary);
            color: var(--white);
        }

        .lang-switcher .lang-btn.active {
            background: var(--primary);
            color: var(--white);
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 2rem;
            min-height: calc(100vh - var(--topbar-height));
            transition: all 0.3s ease;
        }

        /* ===== CARDS ===== */
        .stat-card {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border-color: var(--primary);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-label {
            color: #6B7280;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
        }

        .stat-change {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.85rem;
            padding: 0.3rem 0.6rem;
            border-radius: 8px;
            margin-top: 0.5rem;
        }

        .stat-change.up {
            background: #D1FAE5;
            color: #059669;
        }

        .stat-change.down {
            background: #FEE2E2;
            color: #DC2626;
        }

        /* ===== DATA TABLE ===== */
        .data-table {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .table-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .table-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark);
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
        }

        table thead th {
            padding: 1rem;
            background: #F9FAFB;
            font-weight: 600;
            font-size: 0.85rem;
            color: #6B7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #F3F4F6;
            color: var(--dark);
        }

        table tbody tr:hover {
            background: #F9FAFB;
        }

        .status-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-badge.success {
            background: #D1FAE5;
            color: #059669;
        }

        .status-badge.warning {
            background: #FEF3C7;
            color: #D97706;
        }

        .status-badge.danger {
            background: #FEE2E2;
            color: #DC2626;
        }

        .status-badge.info {
            background: #DBEAFE;
            color: #2563EB;
        }

        /* ===== CHART CARD ===== */
        .chart-card {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        /* ===== BUTTONS ===== */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: var(--white);
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(75,0,130,0.3);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .topbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .topbar-search {
                max-width: 300px;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .topbar {
                padding: 0 1rem;
            }

            .main-content {
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .topbar-search {
                display: none;
            }

            .user-info {
                display: none;
            }

            .topbar-actions {
                gap: 0.5rem;
            }

            .stat-value {
                font-size: 1.3rem;
            }

            .data-table {
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .topbar {
                padding: 0 0.5rem;
            }

            .main-content {
                padding: 0.5rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .topbar-btn {
                width: 40px;
                height: 40px;
            }
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-in {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('frontend/img/logos/logo.png') }}" alt="OWEW Logo">
            <div class="sidebar-brand-text">
                <h4>OWEW</h4>
                <small>Administration</small>
            </div>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Principal</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Dashboard' : 'Dashboard' }}</span>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="menu-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <i class="fas fa-project-diagram"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Projects' : 'Projets' }}</span>
            </a>
            <a href="{{ route('admin.donations.index') }}" class="menu-item {{ request()->routeIs('admin.donations.*') ? 'active' : '' }}">
                <i class="fas fa-hand-holding-usd"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Donations' : 'Dons' }}</span>
            </a>

            <div class="menu-label">{{ app()->getLocale() == 'en' ? 'Content' : 'Contenu' }}</div>
            <a href="{{ route('admin.blog.index') }}" class="menu-item {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                <i class="fas fa-blog"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Blog' : 'Blog' }}</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fas fa-folder"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Categories' : 'Catégories' }}</span>
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="menu-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="fas fa-quote-right"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Testimonials' : 'Témoignages' }}</span>
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="menu-item {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Gallery' : 'Galerie' }}</span>
            </a>

            <div class="menu-label">{{ app()->getLocale() == 'en' ? 'Communication' : 'Communication' }}</div>
            <a href="{{ route('admin.messages.index') }}" class="menu-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Messages' : 'Messages' }}</span>
            </a>
            <a href="{{ route('admin.volunteers.index') }}" class="menu-item {{ request()->routeIs('admin.volunteers.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Volunteers' : 'Bénévoles' }}</span>
            </a>
            <a href="{{ route('admin.partnerships.index') }}" class="menu-item {{ request()->routeIs('admin.partnerships.*') ? 'active' : '' }}">
                <i class="fas fa-handshake"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Partnerships' : 'Partenariats' }}</span>
            </a>
            <a href="{{ route('admin.subscribers.index') }}" class="menu-item {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
                <i class="fas fa-paper-plane"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Newsletter' : 'Newsletter' }}</span>
            </a>

            <div class="menu-label">{{ app()->getLocale() == 'en' ? 'Settings' : 'Paramètres' }}</div>
            <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Users' : 'Utilisateurs' }}</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="menu-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>{{ app()->getLocale() == 'en' ? 'Settings' : 'Paramètres' }}</span>
            </a>

            <div class="menu-label">{{ app()->getLocale() == 'en' ? 'Other' : 'Autres' }}</div>
            <a href="{{ route('home') }}" class="menu-item" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                <span>{{ app()->getLocale() == 'en' ? 'View Website' : 'Voir le site' }}</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="menu-item" style="background: none; border: none; width: 100%; text-align: left; cursor: pointer; color: inherit; padding: 0.9rem 1.5rem;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>{{ app()->getLocale() == 'en' ? 'Logout' : 'Déconnexion' }}</span>
                </button>
            </form>
        </nav>
    </aside>

    <!-- Topbar -->
    <header class="topbar">
        <!-- Menu Toggle Button (Mobile) -->
        <button class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>

        <div class="topbar-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="{{ app()->getLocale() == 'en' ? 'Search...' : 'Rechercher...' }}">
        </div>

        <div class="topbar-actions">

            <!-- Language Switcher -->
            <div class="lang-switcher" style="display: flex; align-items: center; gap: 0.5rem; margin-right: 1rem;">
                <a href="{{ route('lang.switch', 'fr') }}" class="lang-btn {{ app()->getLocale() == 'fr' ? 'active' : '' }}" style="padding: 0.5rem 0.75rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">FR</a>
                <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}" style="padding: 0.5rem 0.75rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">EN</a>
            </div>

            <div class="user-dropdown">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="User" style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4B0082&color=fff" alt="User" style="width:40px; height:40px; border-radius:50%;">
                @endif
                <div class="user-info">
                    <h6>{{ Auth::user()->name }}</h6>
                    <small>{{ ucfirst(Auth::user()->role) }}</small>
                </div>
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
        }

        menuToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking on a menu item (mobile)
        if (window.innerWidth <= 992) {
            document.querySelectorAll('.menu-item').forEach(item => {
                item.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                });
            });
        }
    </script>
</body>
</html>
