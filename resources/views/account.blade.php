<x-app-layout>
    <div class="py-12 text-center">
        <div style="position: relative; margin-bottom: 50px;">
            <h1 style="font-family: 'Bubblegum Sans', 'Quicksand', sans-serif; font-size: 2.5rem; color: #fe8a8b; margin-bottom: 1.5rem;">My Account</h1>
            <p style="font-size: 1.3rem; color: #8a95a9; margin-bottom: 2rem; font-weight: 500;">
                {{ auth()->user()->hasRole('creator') ? 'Manage your educational content' : 'Your learning profile' }}
            </p>
        </div>

        <style>
            .account-card {
                background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%);
                border-radius: 28px;
                box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08), 0 1.5px 8px 0 rgba(208, 230, 250, 0.10);
                border: 1.5px solid #f6e6e6;
                padding: 32px;
                margin: 0 auto 32px auto;
                max-width: 800px;
                text-align: left;
            }
            .video-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 32px;
                max-width: 1200px;
                margin: 0 auto;
            }
            .video-card {
                background: linear-gradient(135deg, #e8f4fd 0%, #f5e8ff 100%);
                border-radius: 28px;
                box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08), 0 1.5px 8px 0 rgba(208, 230, 250, 0.10);
                overflow: hidden;
                border: 1.5px solid #f6e6e6;
                transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s;
            }
            .video-card:hover {
                transform: translateY(-8px) scale(1.03);
                box-shadow: 0 16px 40px 0 rgba(254, 138, 139, 0.16), 0 2px 12px 0 rgba(208, 230, 250, 0.13);
            }
            .video-thumbnail {
                width: 100%;
                aspect-ratio: 16/9;
                background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 2rem;
                font-weight: bold;
            }
            .video-info {
                padding: 20px;
            }
            .video-title {
                font-family: 'Quicksand', sans-serif;
                font-size: 1.1rem;
                font-weight: 700;
                color: #fe8a8b;
                margin-bottom: 10px;
            }
            .upload-btn {
                background: linear-gradient(135deg, #ff7675 0%, #fd79a8 100%);
                border: none;
                border-radius: 18px;
                color: white;
                padding: 15px 32px;
                font-size: 1.1rem;
                font-weight: 600;
                font-family: 'Quicksand', sans-serif;
                text-decoration: none;
                display: inline-block;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px 0 rgba(255, 118, 117, 0.25);
            }
            .upload-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px 0 rgba(255, 118, 117, 0.4);
                color: white;
                text-decoration: none;
            }
            .status-badge {
                padding: 6px 14px;
                border-radius: 20px;
                font-size: 0.85rem;
                font-weight: 600;
                color: white;
            }
            .status-approved {
                background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
            }
            .status-pending {
                background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
            }
        </style>

        @if(auth()->user()->hasRole('creator'))
            <div class="account-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 style="font-family: 'Quicksand', sans-serif; font-size: 1.8rem; font-weight: 700; color: #fe8a8b; margin: 0;">My Videos</h2>
                    <a href="{{ route('videos.create') }}" class="upload-btn">
                        🎥 Upload New Video
                    </a>
                </div>
                
                @if(auth()->user()->videos->count() > 0)
                    <div class="video-grid">
                        @foreach(auth()->user()->videos as $video)
                            <div class="video-card">
                                <div class="video-thumbnail">
                                    🎬
                                </div>
                                <div class="video-info">
                                    <h3 class="video-title">{{ $video->title }}</h3>
                                    <div class="flex justify-between items-center mt-3">
                                        <span style="color: #8a95a9; font-weight: 500;">👀 {{ $video->views }} views</span>
                                        <span class="status-badge {{ $video->is_approved ? 'status-approved' : 'status-pending' }}">
                                            {{ $video->is_approved ? '✅ Approved' : '⏳ Pending' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 40px 20px; color: #8a95a9;">
                        <div style="font-size: 4rem; margin-bottom: 20px;">🎬</div>
                        <h3 style="font-family: 'Quicksand', sans-serif; font-size: 1.5rem; font-weight: 600; color: #fe8a8b; margin-bottom: 10px;">No videos yet</h3>
                        <p style="font-size: 1.1rem; margin-bottom: 25px;">Start creating amazing educational content for kids!</p>
                        <a href="{{ route('videos.create') }}" class="upload-btn">
                            🚀 Create Your First Video
                        </a>
                    </div>
                @endif
            </div>
        @else
            <div class="account-card">
                <div style="text-align: center; padding: 20px;">
                    <div style="font-size: 4rem; margin-bottom: 20px;">👨‍🎓</div>
                    <h2 style="font-family: 'Quicksand', sans-serif; font-size: 1.8rem; font-weight: 700; color: #fe8a8b; margin-bottom: 15px;">Welcome, {{ auth()->user()->name }}!</h2>
                    <p style="font-size: 1.2rem; color: #8a95a9; margin-bottom: 25px;">Keep exploring and learning amazing things!</p>
                    
                    <div style="background: rgba(255, 255, 255, 0.6); border-radius: 18px; padding: 25px; margin-top: 30px;">
                        <h3 style="font-family: 'Quicksand', sans-serif; font-size: 1.3rem; font-weight: 600; color: #fe8a8b; margin-bottom: 15px;">📊 Your Learning Stats</h3>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; text-align: center;">
                            <div>
                                <div style="font-size: 2rem; font-weight: bold; color: #00b894;">🎯</div>
                                <p style="color: #8a95a9; margin: 5px 0;">Videos Watched</p>
                                <p style="font-size: 1.5rem; font-weight: bold; color: #fe8a8b;">Coming Soon</p>
                            </div>
                            <div>
                                <div style="font-size: 2rem; font-weight: bold; color: #fd79a8;">⭐</div>
                                <p style="color: #8a95a9; margin: 5px 0;">Achievements</p>
                                <p style="font-size: 1.5rem; font-weight: bold; color: #fe8a8b;">Coming Soon</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
