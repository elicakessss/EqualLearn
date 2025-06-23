<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EqualLearn') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', 'Quicksand', sans-serif;
            background-color: #f8f9fc;
            color: #55565a;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Layout components */
        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #ffd5de 0%, #d0e6fa 40%, #d0f7d6 70%, #fff7c2 100%);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            padding: 0;
            transition: all 0.3s ease;
            z-index: 2000;
            box-shadow: 0 0 20px rgba(0,0,0,0.06);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f8f9fc;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #e3e7f0;
            border-radius: 10px;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0 15px 0;
            padding: 0 10px;
        }

        .sidebar .logo {
            max-width: 240px;
            height: auto;
            max-height: 150px;
            object-fit: contain;
            filter: drop-shadow(0 2px 8px rgba(255, 213, 222, 0.3));
            transition: all 0.3s ease;
        }

        .sidebar .logo:hover {
            transform: scale(1.05);
        }

        .brand {
            display: none !important;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 15px 24px;
            height: 56px;
            color: #8a95a9;
            text-decoration: none;
            transition: all 0.3s;
            margin: 6px 15px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
        }

        .sidebar-link:hover {
            background-color: #f8f9fc;
            color: #fe8a8b;
        }

        .sidebar-link.active {
            background-color: #fff9f9;
            color: #fe8a8b;
            box-shadow: 0 4px 10px rgba(254, 138, 139, 0.1);
        }

        .sidebar-link.active i {
            color: #fe8a8b;
        }

        .sidebar-link i {
            margin-right: 15px;
            font-size: 18px;
            width: 24px;
            text-align: center;
            color: #a1a7b3;
            transition: all 0.3s;
        }

        .sidebar-link:hover i {
            color: #fe8a8b;
        }

        .sidebar-link.active i {
            color: #fe8a8b;
        }

        .divider {
            height: 1px;
            background: #f0f2f7;
            margin: 20px 15px;
            position: relative;
        }

        /* Main content area */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 35px;
            padding-top: 90px;
            min-height: 100vh;
            background-color: #f8f9fc;
            transition: all 0.3s ease;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            right: 0;
            left: 260px;
            height: 80px;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            padding: 0 30px;
            justify-content: space-between;
            z-index: 1000;
            transition: left 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border-radius: 0 0 20px 20px;
        }

        .search-container {
            flex: 0 1 400px;
            margin: 0 30px;
            position: relative;
        }

        .search-box {
            width: 100%;
            height: 45px;
            background: #f8f9fc;
            border: 1px solid #e3e7f0;
            padding: 0 20px;
            padding-right: 45px;
            border-radius: 25px;
            color: #55565a;
            font-size: 15px;
            font-family: 'Nunito', sans-serif;
            outline: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .search-box:focus {
            border-color: #fe8a8b;
            box-shadow: 0 2px 8px rgba(254, 138, 139, 0.1);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: auto;
            padding-right: 16px;
        }

        .user-menu span {
            color: #55565a;
            font-size: 15px;
            font-weight: 600;
            margin-right: 10px;
        }

        /* Video grid */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }

        .video-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(0,0,0,0.04);
            border: 1px solid rgba(227, 231, 240, 0.8);
        }

        .video-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(254, 138, 139, 0.08);
            border-color: rgba(254, 138, 139, 0.1);
        }

        .video-thumbnail {
            width: 100%;
            aspect-ratio: 16/9;
            background: #f8f9fc;
            object-fit: cover;
        }

        .video-info {
            padding: 18px;
        }

        .video-title {
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #55565a;
            line-height: 1.4;
        }

        .video-meta {
            font-size: 14px;
            color: #a1a7b3;
        }

        /* Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 15px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .alert-success {
            background-color: #effbf7;
            color: #0cc396;
            border: 1px solid #d4f5e9;
        }

        .alert-error {
            background-color: #fff5f5;
            color: #fe8a8b;
            border: 1px solid #ffdede;
        }

        /* Button styling */
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 42px;
            padding: 0 20px;
            border-radius: 12px;
            border: none;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            gap: 8px;
            font-family: 'Nunito', sans-serif;
        }

        .button-primary {
            background-color: #fe8a8b;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(254, 138, 139, 0.2);
        }

        .button-primary:hover {
            background-color: #ff7b7c;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(254, 138, 139, 0.25);
            color: #ffffff;
            text-decoration: none;
        }

        .button-secondary {
            background-color: #f8f9fc;
            color: #8a95a9;
            border: 1px solid #e3e7f0;
        }

        .button-secondary:hover {
            background-color: #f0f2f7;
            color: #fe8a8b;
            border-color: #ffd5d5;
            text-decoration: none;
        }

        /* Additional universal styling for consistency */
        .page-header {
            background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 50%, #d0e6fa 100%);
            border-radius: 28px;
            padding: 40px;
            margin-bottom: 32px;
            box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08);
            border: 1.5px solid #f6e6e6;
            text-align: center;
        }

        .page-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #55565a;
            margin-bottom: 12px;
        }

        .page-subtitle {
            color: #8a95a9;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .section-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #55565a;
            margin-bottom: 24px;
        }

        .card {
            background: linear-gradient(135deg, #fff 0%, #fef7f7 100%);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08);
            border: 1.5px solid #f6e6e6;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 24px;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 48px 0 rgba(254, 138, 139, 0.15);
        }

        /* Form styling */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            color: #55565a;
            margin-bottom: 8px;
            font-size: 15px;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e3e7f0;
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Nunito', sans-serif;
            color: #55565a;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #fe8a8b;
            box-shadow: 0 0 0 3px rgba(254, 138, 139, 0.1);
        }

        .form-textarea {
            width: 100%;
            min-height: 120px;
            padding: 12px 16px;
            border: 1.5px solid #e3e7f0;
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Nunito', sans-serif;
            color: #55565a;
            background-color: #fff;
            transition: all 0.3s ease;
            resize: vertical;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #fe8a8b;
            box-shadow: 0 0 0 3px rgba(254, 138, 139, 0.1);
        }

        /* Table styling */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08);
            border: 1.5px solid #f6e6e6;
        }

        .data-table th {
            background: linear-gradient(135deg, #ffd5de 0%, #d0e6fa 100%);
            padding: 16px 20px;
            text-align: left;
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            color: #55565a;
            font-size: 15px;
            border-bottom: 1px solid #f0f2f7;
        }

        .data-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #f8f9fc;
            color: #55565a;
            font-size: 14px;
        }

        .data-table tr:hover {
            background-color: #fef7f7;
        }

        /* Action buttons */
        .btn-group {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-small {
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-edit {
            background-color: #f0f2f7;
            color: #8a95a9;
        }

        .btn-edit:hover {
            background-color: #e3e7f0;
            color: #55565a;
        }

        .btn-delete {
            background-color: #fff5f5;
            color: #fe8a8b;
        }

        .btn-delete:hover {
            background-color: #ffe5e5;
            color: #ff6b6c;
        }

        /* Badge styling */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: #effbf7;
            color: #0cc396;
        }

        .badge-warning {
            background: #fff7e6;
            color: #ff9500;
        }

        .badge-info {
            background: #e6f3ff;
            color: #007acc;
        }

        .badge-secondary {
            background: #f8f9fc;
            color: #8a95a9;
        }

        /* Modal styling */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 32px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            margin-bottom: 24px;
        }

        .modal-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #55565a;
            margin-bottom: 8px;
        }

        /* Loading states */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #fe8a8b;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Utility classes */
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .mb-0 { margin-bottom: 0 !important; }
        .mb-2 { margin-bottom: 8px; }
        .mb-3 { margin-bottom: 12px; }
        .mb-4 { margin-bottom: 16px; }
        .mb-6 { margin-bottom: 24px; }
        .mt-0 { margin-top: 0 !important; }
        .mt-2 { margin-top: 8px; }
        .mt-3 { margin-top: 12px; }
        .mt-4 { margin-top: 16px; }
        .mt-6 { margin-top: 24px; }
        .hidden { display: none; }
        .flex { display: flex; }
        .block { display: block; }
        .inline { display: inline; }
        .inline-block { display: inline-block; }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="layout">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="Equal Learn" class="logo">
            </div>
            <div class="sidebar-section">
                <a href="{{ route('home') }}" class="sidebar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="{{ url('/account') }}" class="sidebar-link {{ request()->is('account') ? 'active' : '' }}">
                    <i class="fas fa-user"></i>
                    <span>Account</span>
                </a>
            </div>
            @if(auth()->user() && auth()->user()->hasRole('admin'))
                <div class="divider"></div>
                <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fas fa-list"></i>
                    <span>Categories</span>
                </a>
                <a href="{{ route('admin.countries.index') }}" class="sidebar-link {{ request()->routeIs('admin.countries.*') ? 'active' : '' }}">
                    <i class="fas fa-globe"></i>
                    <span>Countries</span>
                </a>
                <a href="{{ route('admin.videos.index') }}" class="sidebar-link {{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">
                    <i class="fas fa-video"></i>
                    <span>Videos</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.logs.index') }}" class="sidebar-link {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i>
                    <span>System Logs</span>
                </a>
            @endif
        </nav>

        <!-- Header -->
        <header class="header">
            <div class="search-container">
                <form action="{{ route('home') }}" method="GET">
                    <input type="search"
                           name="search"
                           class="search-box"
                           placeholder="Search videos..."
                           value="{{ request()->query('search') }}">
                </form>
            </div>

            <div class="user-menu">
                <!-- Support Us Button -->
                <a href="{{ route('support') }}" class="button button-primary" style="margin-right: 12px; background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); box-shadow: 0 4px 10px rgba(255, 154, 158, 0.3);">
                    <i class="fas fa-heart"></i>
                    <span>Support Us!</span>
                </a>
                
                @auth
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="button button-secondary">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="button button-primary">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign In</span>
                    </a>
                @endauth
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    <script>
        // Mobile responsive handling
        document.addEventListener('DOMContentLoaded', function() {
            const mediaQuery = window.matchMedia('(max-width: 1200px)');
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            const header = document.querySelector('.header');

            function handleScreenSize(e) {
                if (e.matches) {
                    sidebar.classList.add('collapsed');
                } else {
                    sidebar.classList.remove('collapsed');
                }
            }

            mediaQuery.addListener(handleScreenSize);
            handleScreenSize(mediaQuery);

            // Handle search on mobile
            const searchToggle = document.createElement('button');
            searchToggle.className = 'button button-primary d-md-none';
            searchToggle.innerHTML = '<i class="fas fa-search"></i>';
            searchToggle.addEventListener('click', function() {
                const searchContainer = document.querySelector('.search-container');
                searchContainer.style.display = searchContainer.style.display === 'none' ? 'block' : 'none';
            });

            if (window.innerWidth <= 768) {
                document.querySelector('.header').insertBefore(
                    searchToggle,
                    document.querySelector('.user-menu')
                );
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
