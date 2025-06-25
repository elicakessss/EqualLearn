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

        /* Hide mobile logo on desktop */
        .mobile-logo {
            display: none;
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

        /* Responsive Design - Desktop */
        @media (max-width: 1200px) {
            .sidebar {
                width: 72px;
            }
            .sidebar-link span {
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

        /* Mobile responsive - YouTube-style bottom navigation */
        @media (max-width: 768px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                top: auto;
                width: 100%;
                height: 70px;
                z-index: 3000;
                background: #ffffff;
                box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
                border-radius: 0;
                padding: 0;
                display: flex;
                justify-content: space-around;
                align-items: center;
                overflow-x: auto;
                overflow-y: hidden;
            }

            .sidebar::-webkit-scrollbar {
                display: none;
            }

            .logo-container,
            .sidebar .logo-container,
            .sidebar .logo {
                display: none !important;
            }

            /* Mobile logo in header */
            .mobile-logo {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 16px;
                flex-shrink: 0;
            }

            .mobile-logo-img {
                height: 32px;
                width: auto;
                max-width: 100px;
                object-fit: contain;
                filter: drop-shadow(0 1px 4px rgba(255, 213, 222, 0.3));
            }

            .sidebar-section {
                display: flex;
                width: 100%;
                justify-content: space-around;
                align-items: center;
            }

            .sidebar-link {
                flex-direction: column;
                padding: 8px 12px;
                margin: 0;
                border-radius: 8px;
                min-width: 60px;
                text-align: center;
                height: auto;
                gap: 4px;
                font-size: 11px;
                font-weight: 500;
                background: transparent;
            }

            .sidebar-link i {
                margin: 0;
                font-size: 20px;
                margin-bottom: 2px;
            }

            .sidebar-link span {
                display: block !important;
                font-size: 10px;
                line-height: 1;
                white-space: nowrap;
            }

            .sidebar-link.active {
                background: rgba(254, 138, 139, 0.1);
                color: #fe8a8b;
            }

            .sidebar-link:hover {
                background: rgba(254, 138, 139, 0.05);
            }

            .divider {
                display: none;
            }

            .main-content {
                margin-left: 0;
                margin-bottom: 70px;
                padding: 20px 16px;
                padding-top: 90px;
            }

            .header {
                left: 0;
                right: 0;
                margin-left: 0;
                padding: 0 16px;
                height: 60px;
                border-radius: 0;
            }

            .search-container {
                flex: 1;
                margin: 0 16px;
                max-width: none;
            }

            .search-box {
                height: 38px;
                font-size: 14px;
                padding: 0 16px;
            }

            .user-menu {
                flex-shrink: 0;
                padding-right: 0;
            }

            .user-menu span {
                display: none;
            }

            .button {
                height: 36px;
                padding: 0 12px;
                font-size: 13px;
            }

            /* Mobile video grid - vertical stack */
            .video-grid {
                grid-template-columns: 1fr;
                gap: 16px;
                max-width: 100%;
            }

            .video-card {
                border-radius: 16px;
                overflow: hidden;
                background: #ffffff;
                box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            }

            .video-thumbnail {
                aspect-ratio: 16/9;
                width: 100%;
            }

            .video-info {
                padding: 16px;
            }

            .video-title {
                font-size: 16px;
                line-height: 1.3;
                margin-bottom: 8px;
                -webkit-line-clamp: 2;
            }

            .video-meta {
                font-size: 13px;
            }

            /* Mobile dashboard adjustments */
            .dashboard-header {
                padding: 24px 20px;
                border-radius: 16px;
                margin-bottom: 20px;
            }

            .dashboard-header h1 {
                font-size: 1.8rem;
            }

            .dashboard-header p {
                font-size: 1rem;
            }

            .page-header {
                padding: 24px 20px;
                border-radius: 16px;
                margin-bottom: 20px;
            }

            .page-title {
                font-size: 1.8rem;
            }

            .page-subtitle {
                font-size: 1rem;
            }

            /* Mobile forms */
            .form-input, .form-select, .form-textarea {
                font-size: 16px; /* Prevents zoom on iOS */
            }

            /* Mobile tables */
            .data-table {
                font-size: 14px;
            }

            .data-table th,
            .data-table td {
                padding: 12px 8px;
            }

            /* Mobile modals */
            .modal-content {
                margin: 20px;
                padding: 24px;
                max-height: calc(100vh - 40px);
            }

            /* Mobile cards */
            .card {
                padding: 20px;
                border-radius: 16px;
                margin-bottom: 16px;
            }
        }

        /* Extra small mobile devices */
        @media (max-width: 480px) {
            .main-content {
                padding: 16px 12px;
                padding-top: 80px;
            }

            .header {
                padding: 0 12px;
                height: 55px;
            }

            /* Hide sidebar logo on mobile */
            .logo-container,
            .sidebar .logo-container,
            .sidebar .logo {
                display: none !important;
            }

            /* Mobile logo in header */
            .mobile-logo {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 16px;
                flex-shrink: 0;
            }

            .mobile-logo-img {
                height: 28px;
                max-width: 80px;
            }

            .sidebar {
                height: 65px;
            }

            .sidebar-link {
                min-width: 50px;
                padding: 6px 8px;
            }

            .sidebar-link i {
                font-size: 18px;
            }

            .sidebar-link span {
                font-size: 9px;
            }

            .dashboard-header h1, .page-title {
                font-size: 1.6rem;
            }

            .button {
                height: 34px;
                padding: 0 10px;
                font-size: 12px;
            }

            .search-box {
                height: 34px;
                font-size: 13px;
            }
        }

        /* Mobile utility classes */
        @media (max-width: 768px) {
            .mobile-hidden { display: none !important; }
            .mobile-block { display: block !important; }
            .mobile-flex { display: flex !important; }
            .mobile-text-center { text-align: center !important; }
            .mobile-p-2 { padding: 8px !important; }
            .mobile-p-4 { padding: 16px !important; }
            .mobile-mb-2 { margin-bottom: 8px !important; }
            .mobile-mb-4 { margin-bottom: 16px !important; }
        }
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
            <!-- Mobile Logo -->
            <div class="mobile-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Equal Learn" class="mobile-logo-img">
            </div>

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
                    <a href="{{ route('welcome') }}" class="button button-primary">
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
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            const header = document.querySelector('.header');
            
            // Handle responsive layout changes
            function handleResponsiveLayout() {
                const isMobile = window.innerWidth <= 768;
                const isTablet = window.innerWidth <= 1200 && window.innerWidth > 768;
                
                if (isMobile) {
                    // Mobile layout - bottom navigation
                    sidebar.classList.remove('collapsed');
                    document.body.classList.add('mobile-layout');
                } else if (isTablet) {
                    // Tablet layout - collapsed sidebar
                    sidebar.classList.add('collapsed');
                    document.body.classList.remove('mobile-layout');
                } else {
                    // Desktop layout - full sidebar
                    sidebar.classList.remove('collapsed');
                    document.body.classList.remove('mobile-layout');
                }
            }

            // Initial setup
            handleResponsiveLayout();
            
            // Listen for window resize
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(handleResponsiveLayout, 100);
            });

            // Mobile search toggle functionality
            function setupMobileSearch() {
                if (window.innerWidth <= 768) {
                    const searchContainer = document.querySelector('.search-container');
                    let searchToggle = document.querySelector('.mobile-search-toggle');
                    
                    if (!searchToggle && searchContainer) {
                        searchToggle = document.createElement('button');
                        searchToggle.className = 'button button-secondary mobile-search-toggle';
                        searchToggle.innerHTML = '<i class="fas fa-search"></i>';
                        searchToggle.style.marginRight = '8px';
                        
                        searchToggle.addEventListener('click', function() {
                            const isHidden = searchContainer.style.display === 'none';
                            searchContainer.style.display = isHidden ? 'flex' : 'none';
                            searchToggle.innerHTML = isHidden ? '<i class="fas fa-times"></i>' : '<i class="fas fa-search"></i>';
                        });

                        const userMenu = document.querySelector('.user-menu');
                        if (userMenu) {
                            userMenu.insertBefore(searchToggle, userMenu.firstChild);
                        }
                    }
                }
            }

            // Setup mobile search
            setupMobileSearch();

            // Handle orientation change on mobile devices
            window.addEventListener('orientationchange', function() {
                setTimeout(handleResponsiveLayout, 100);
            });

            // Smooth scrolling for mobile navigation
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        // Add visual feedback on mobile
                        this.style.backgroundColor = 'rgba(254, 138, 139, 0.2)';
                        setTimeout(() => {
                            this.style.backgroundColor = '';
                        }, 200);
                    }
                });
            });

            // Prevent video grid layout shift on mobile
            const videoCards = document.querySelectorAll('.video-card');
            videoCards.forEach(card => {
                card.addEventListener('touchstart', function() {
                    this.style.transform = 'scale(0.98)';
                });
                
                card.addEventListener('touchend', function() {
                    this.style.transform = '';
                });
            });
        });

        // Handle mobile viewport height for better layout
        function setMobileViewportHeight() {
            if (window.innerWidth <= 768) {
                const vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', `${vh}px`);
            }
        }

        setMobileViewportHeight();
        window.addEventListener('resize', setMobileViewportHeight);
        window.addEventListener('orientationchange', () => {
            setTimeout(setMobileViewportHeight, 100);
        });
    </script>
    @stack('scripts')
</body>
</html>
