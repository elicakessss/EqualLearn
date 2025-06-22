<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EqualLearn') }}</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            background-color: #0F0F0F;
            color: #FFFFFF;
            line-height: 1.5;
        }

        /* Layout components */
        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background-color: #0F0F0F;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            padding: 12px;
            border-right: 1px solid #282828;
            transition: width 0.3s ease;
        }

        .sidebar.collapsed {
            width: 72px;
        }

        .brand {
            display: flex;
            align-items: center;
            padding: 12px;
            margin-bottom: 24px;
        }

        .brand-text {
            font-size: 20px;
            font-weight: bold;
            color: #FF0000;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: background-color 0.2s;
        }

        .sidebar-link:hover {
            background-color: #282828;
        }

        .sidebar-link i {
            margin-right: 24px;
            font-size: 20px;
            width: 24px;
            text-align: center;
        }

        .divider {
            height: 1px;
            background-color: #282828;
            margin: 16px 0;
        }

        /* Main content area */
        .main-content {
            flex: 1;
            margin-left: 240px;
            padding: 24px;
            padding-top: 80px; /* Account for fixed header */
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            right: 0;
            left: 240px;
            height: 56px;
            background-color: #0F0F0F;
            display: flex;
            align-items: center;
            padding: 0 16px;
            justify-content: space-between;
            border-bottom: 1px solid #282828;
            z-index: 100;
            transition: left 0.3s ease;
        }

        .search-container {
            flex: 0 1 732px;
            margin: 0 auto;
        }

        .search-box {
            width: 100%;
            background: #121212;
            border: 1px solid #303030;
            padding: 8px 16px;
            border-radius: 20px;
            color: #FFFFFF;
            font-size: 16px;
            outline: none;
        }

        .search-box:focus {
            border-color: #FF0000;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-menu span {
            color: #FFFFFF;
        }

        /* Video grid */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        .video-card {
            background: #1F1F1F;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .video-card:hover {
            transform: translateY(-4px);
        }

        .video-thumbnail {
            width: 100%;
            aspect-ratio: 16/9;
            background: #282828;
            object-fit: cover;
        }

        .video-info {
            padding: 12px;
        }

        .video-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .video-meta {
            font-size: 14px;
            color: #AAAAAA;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .sidebar {
                width: 72px;
            }
            .sidebar-link span,
            .brand-text {
                display: none;
            }
            .sidebar-link i {
                margin-right: 0;
            }
            .main-content,
            .header {
                margin-left: 72px;
                left: 72px;
            }
        }

        @media (max-width: 768px) {
            .search-container {
                display: none;
            }
            .header {
                justify-content: flex-end;
            }
            .video-grid {
                gap: 16px;
            }
            .main-content {
                padding: 16px;
                padding-top: 72px;
            }
        }

        /* Form elements */
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            border-radius: 20px;
            border: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .button-primary {
            background-color: #FF0000;
            color: #FFFFFF;
        }

        .button-primary:hover {
            background-color: #CC0000;
        }

        /* Messages */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .alert-success {
            background-color: #0A2F0A;
            color: #4CAF50;
        }

        .alert-error {
            background-color: #2F0A0A;
            color: #F44336;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="layout">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="brand">
                <span class="brand-text">EqualLearn</span>
            </div>

            <a href="{{ route('home') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>

            @auth
                @if(auth()->user()->isCreator())
                <a href="{{ route('videos.create') }}" class="sidebar-link">
                    <i class="fas fa-plus"></i>
                    <span>Upload Video</span>
                </a>
                @endif

                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.videos.index') }}" class="sidebar-link">
                    <i class="fas fa-cog"></i>
                    <span>Manage Videos</span>
                </a>
                @endif
            @endauth

            <div class="divider"></div>

            <div class="sidebar-section">
                @foreach(\App\Models\Category::all() as $category)
                <a href="{{ route('home', ['category' => $category->id]) }}" class="sidebar-link">
                    <i class="fas fa-folder"></i>
                    <span>{{ $category->name }}</span>
                </a>
                @endforeach
            </div>
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
                @auth
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="button button-primary">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="ml-2">Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="button button-primary">
                        <i class="fas fa-sign-in-alt"></i>
                        <span class="ml-2">Login</span>
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
</body>
</html>
