<x-app-layout>
    <div class="mb-8">
        <h1 style="font-family: 'Quicksand', sans-serif; font-size: 1.8rem; font-weight: 700; color: #55565a; margin-bottom: 0.5rem;">Educational Videos</h1>
        <p style="color: #8a95a9; font-size: 1.1rem;">Discover amazing learning content for kids</p>
    </div>

    <style>
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 32px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .video-card {
            background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%);
            border-radius: 28px;
            box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08), 0 1.5px 8px 0 rgba(208, 230, 250, 0.10);
            overflow: hidden;
            border: 1.5px solid #f6e6e6;
            transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s;
            position: relative;
        }
        .video-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 16px 40px 0 rgba(254, 138, 139, 0.16), 0 2px 12px 0 rgba(208, 230, 250, 0.13);
        }
        .video-thumbnail {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            border-radius: 22px 22px 0 0;
            background: #f8f9fc;
            border-bottom: 1.5px solid #ffe6e6;
        }
        .video-info {
            padding: 22px 20px 18px 20px;
            text-align: left;
        }
        .video-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.18rem;
            font-weight: 700;
            color: #fe8a8b;
            margin-bottom: 8px;
            line-height: 1.3;
        }
        .video-meta {
            font-size: 0.98rem;
            color: #8a95a9;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }
        .video-meta span {
            font-size: 0.98rem;
            color: #8a95a9;
        }
        .video-card .duration-badge {
            position: absolute;
            bottom: 16px;
            right: 18px;
            background: rgba(255,255,255,0.85);
            color: #fe8a8b;
            font-size: 0.92rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(254, 138, 139, 0.08);
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
                        {{ gmdate('H:i:s', $video->duration) }}
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
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiM4YTk1YTkiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cGF0aCBkPSJNMjIuNTQgNi40MmE0LjA2IDQuMDYgMCAwIDAtNS43MiAwTDE2IDcuMjRsLTEuODQtMS44NHY0LjF2LTQuMWExIDEgMCAwIDAtMS40MSAwTDEwIDcuMjRsLTEuODQtMS44NGE0LjA2IDQuMDYgMCAwIDAtNS43MiA1LjcybDcuMDcgNy4wN2E0LjA2IDQuMDYgMCAwIDAgNS43MiAwbDcuMDctNy4wN2E0LjA2IDQuMDYgMCAwIDAgMC01LjcyeiIvPjwvc3ZnPg==" alt="No videos icon">
            </div>
            <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 10px; color: #55565a;">No videos found</h3>
            <p style="color: #8a95a9; font-size: 1.1rem;">{{ request()->query('search') ? 'Try different search terms' : 'Videos will appear here once added' }}</p>
        </div>
        @endforelse
    </div>

    <div style="margin-top: 40px;">
        {{ $videos->links() }}
    </div>
</x-app-layout>
