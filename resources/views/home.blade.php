<x-app-layout>
    <div class="py-12 text-center">
        <div style="position: relative; margin-bottom: 50px;">
            @if($selectedCategory)
                <h1 style="font-family: 'Bubblegum Sans', 'Quicksand', sans-serif; font-size: 2.5rem; color: #fe8a8b; margin-bottom: 1.5rem;">{{ $selectedCategory->name }} Videos</h1>
                <p style="font-size: 1.3rem; color: #8a95a9; margin-bottom: 2rem; font-weight: 500;">Discover amazing {{ strtolower($selectedCategory->name) }} content for kids</p>
            @else
                <h1 style="font-family: 'Bubblegum Sans', 'Quicksand', sans-serif; font-size: 2.5rem; color: #fe8a8b; margin-bottom: 1.5rem;">Educational Videos</h1>
                <p style="font-size: 1.3rem; color: #8a95a9; margin-bottom: 2rem; font-weight: 500;">Discover amazing learning content for kids</p>
            @endif
        </div>
        
        <style>
            .video-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }
            
            /* For tablets and smaller screens */
            @media (max-width: 1024px) {
                .video-grid {
                    grid-template-columns: repeat(3, 1fr);
                    gap: 16px;
                }
            }
            
            /* For mobile screens */
            @media (max-width: 768px) {
                .video-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 12px;
                }
            }
            
            /* For very small screens */
            @media (max-width: 480px) {
                .video-grid {
                    grid-template-columns: 1fr;
                    gap: 16px;
                }
            }
            
            .video-card {
                background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%);
                border-radius: 20px;
                box-shadow: 0 6px 24px 0 rgba(254, 138, 139, 0.08), 0 1px 6px 0 rgba(208, 230, 250, 0.10);
                overflow: hidden;
                border: 1.5px solid #f6e6e6;
                transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s;
                position: relative;
            }
            .video-card:hover {
                transform: translateY(-6px) scale(1.02);
                box-shadow: 0 12px 32px 0 rgba(254, 138, 139, 0.14), 0 2px 10px 0 rgba(208, 230, 250, 0.12);
            }
            .video-thumbnail {
                width: 100%;
                aspect-ratio: 16/9;
                object-fit: cover;
                border-radius: 16px 16px 0 0;
                background: #f8f9fc;
                border-bottom: 1.5px solid #ffe6e6;
            }
            .video-info {
                padding: 16px 14px 14px 14px;
                text-align: left;
            }
            .video-title {
                font-family: 'Quicksand', sans-serif;
                font-size: 1rem;
                font-weight: 700;
                color: #fe8a8b;
                margin-bottom: 6px;
                line-height: 1.3;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            .video-meta {
                font-size: 0.85rem;
                color: #8a95a9;
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
                align-items: center;
            }
            .video-meta span {
                font-size: 0.85rem;
                color: #8a95a9;
            }
            .video-card .duration-badge {
                position: absolute;
                bottom: 14px;
                right: 14px;
                background: rgba(255,255,255,0.9);
                color: #fe8a8b;
                font-size: 0.8rem;
                font-weight: 700;
                padding: 3px 8px;
                border-radius: 8px;
                box-shadow: 0 2px 6px rgba(254, 138, 139, 0.08);
            }
        </style>

        <div class="video-grid">
            @forelse($videos as $video)
            <div class="video-card">
                <a href="{{ route('videos.show', $video) }}" class="block" style="text-decoration: none;">
                    <div style="position: relative;">
                        <img src="{{ Storage::url($video->thumbnail) }}"
                             alt="{{ $video->title }}"
                             class="video-thumbnail">
                        <span class="duration-badge">
                            {{ gmdate('H:i:s', $video->duration ?? 0) }}
                        </span>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">{{ $video->title }}</h3>
                        <div class="video-meta">
                            <span>{{ $video->user->name }}</span>
                            <span>•</span>
                            <span>{{ number_format($video->views) }} views</span>
                            <span>•</span>
                            <span>{{ $video->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px 20px; background: white; border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.03);">
                <div style="width: 80px; height: 80px; background-color: #f8f9fc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <div style="font-size: 2rem;">🎬</div>
                </div>
                <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 10px; color: #55565a;">No videos found</h3>
                <p style="color: #8a95a9; font-size: 1.1rem;">
                    @if($selectedCategory)
                        No videos in this category yet.
                    @else
                        No videos available yet. Check back soon!
                    @endif
                </p>
            </div>
            @endforelse
        </div>

        <div style="margin-top: 40px;">
            {{ $videos->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>
