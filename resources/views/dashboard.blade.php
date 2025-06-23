<x-app-layout>
    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 50%, #d0e6fa 100%);
            border-radius: 28px;
            padding: 40px;
            margin-bottom: 32px;
            box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08);
            border: 1.5px solid #f6e6e6;
        }
        
        .dashboard-header h1 {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #55565a;
            margin-bottom: 12px;
            text-align: center;
        }
        
        .dashboard-header p {
            color: #8a95a9;
            font-size: 1.1rem;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .video-card {
            background: linear-gradient(135deg, #fff 0%, #fef7f7 100%);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08);
            border: 1.5px solid #f6e6e6;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .video-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 48px 0 rgba(254, 138, 139, 0.15);
        }

        .video-placeholder {
            background: linear-gradient(135deg, #ffd5de 0%, #d0e6fa 100%);
            height: 180px;
            border-radius: 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #55565a;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .video-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: #55565a;
            margin-bottom: 8px;
        }

        .video-description {
            color: #8a95a9;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .browse-link {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #ff91a4 0%, #ff7a92 100%);
            color: white;
            padding: 16px 32px;
            border-radius: 16px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 24px 0 rgba(255, 145, 164, 0.25);
        }

        .browse-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px 0 rgba(255, 145, 164, 0.35);
            color: white;
            text-decoration: none;
        }
    </style>

    <div class="dashboard-header">
        <h1>Student Dashboard ✨</h1>
        <p>Welcome to your learning journey! Explore amazing educational content and discover new topics that inspire you.</p>
    </div>

    <div>
        <h2 style="font-family: 'Quicksand', sans-serif; font-size: 1.6rem; font-weight: 700; color: #55565a; margin-bottom: 24px;">Recent Videos</h2>
        <div class="video-grid">
            @for ($i = 1; $i <= 3; $i++)
            <div class="video-card">
                <div class="video-placeholder">
                    🎬 Sample Video {{ $i }}
                </div>
                <h3 class="video-title">Interesting Learning Topic {{ $i }}</h3>
                <p class="video-description">Discover amazing educational content that will expand your knowledge and spark your curiosity.</p>
            </div>
            @endfor
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('home') }}" class="browse-link">
                🎥 Browse All Videos →
            </a>
        </div>
    </div>
</x-app-layout>
