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

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .section-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #55565a;
        }

        .upload-btn {
            background: linear-gradient(135deg, #ff91a4 0%, #ff7a92 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 16px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 24px 0 rgba(255, 145, 164, 0.25);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px 0 rgba(255, 145, 164, 0.35);
            color: white;
            text-decoration: none;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
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
            margin-bottom: 12px;
        }

        .video-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
        }

        .views-count {
            color: #8a95a9;
        }

        .status-badge {
            background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%);
            color: #55565a;
            padding: 4px 12px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.85rem;
        }
    </style>

    <div class="dashboard-header">
        <h1>Creator Dashboard 🎨</h1>
        <p>Welcome to your creative space! Manage your videos, upload new content, and share your knowledge with the world.</p>
    </div>

    <div>
        <div class="section-header">
            <h2 class="section-title">Your Videos</h2>
            <a href="{{ route('videos.create') }}" class="upload-btn">
                ✨ Upload New Video
            </a>
        </div>

        <div class="video-grid">
            @for ($i = 1; $i <= 3; $i++)
            <div class="video-card">
                <div class="video-placeholder">
                    🎬 My Video {{ $i }}
                </div>
                <h3 class="video-title">My Educational Content {{ $i }}</h3>
                <div class="video-stats">
                    <span class="views-count">👀 125 views</span>
                    <span class="status-badge">✅ Published</span>
                </div>
            </div>
            @endfor
        </div>
    </div>
</x-app-layout>
