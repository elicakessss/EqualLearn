<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header -->
                    <div class="mb-8 flex items-start justify-between">
                        <div>
                            <a href="{{ route('admin.categories.index') }}"
                               style="color: #8a95a9; text-decoration: none; font-size: 14px; display: flex; align-items: center; gap: 6px; margin-bottom: 8px;">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Back to Categories
                            </a>
                            <h1 style="font-family: 'Quicksand', sans-serif; font-size: 1.8rem; font-weight: 700; color: #55565a; margin-bottom: 0.5rem;">
                                {{ $category->name }} Videos
                            </h1>
                            <p style="color: #8a95a9; font-size: 1.1rem;">{{ $videos->total() }} videos in this category</p>
                        </div>
                    </div>

                    <!-- Videos Grid -->
                    @if($videos->count() > 0)
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; margin-bottom: 32px;">
                            @foreach($videos as $video)
                                <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: all 0.3s ease; cursor: pointer;"
                                     onclick="openVideoModal('{{ $video->id }}', '{{ $video->title }}', '{{ $video->video_url }}', '{{ $video->thumbnail ? Storage::url($video->thumbnail) : '/images/default-thumbnail.jpg' }}')">

                                    <!-- Thumbnail -->
                                    <div style="position: relative; aspect-ratio: 16/9; background: #f8fafc; overflow: hidden;">
                                        <img src="{{ $video->thumbnail ? Storage::url($video->thumbnail) : '/images/default-thumbnail.jpg' }}"
                                             alt="{{ $video->title }}"
                                             style="width: 100%; height: 100%; object-fit: cover;">

                                        <!-- Play Button Overlay -->
                                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                                    background: rgba(0,0,0,0.7); border-radius: 50%; width: 60px; height: 60px;
                                                    display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
                                            <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </div>

                                        <!-- Status Badge -->
                                        <div style="position: absolute; top: 12px; right: 12px;">
                                            @if($video->is_approved)
                                                <span style="background: #10b981; color: white; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                                    Approved
                                                </span>
                                            @else
                                                <span style="background: #f59e0b; color: white; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                                    Pending
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Video Info -->
                                    <div style="padding: 16px;">
                                        <h3 style="font-weight: 600; font-size: 16px; color: #374151; margin-bottom: 8px; line-height: 1.4;">
                                            {{ Str::limit($video->title, 60) }}
                                        </h3>

                                        <div style="display: flex; align-items: center; margin-bottom: 12px;">
                                            <div style="width: 32px; height: 32px; background: #f0f8ff; border-radius: 50%;
                                                        display: flex; align-items: center; justify-content: center;
                                                        font-weight: bold; color: #a5d8e6; font-size: 14px; margin-right: 10px;">
                                                {{ substr($video->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div style="font-size: 14px; color: #374151; font-weight: 500;">{{ $video->user->name }}</div>
                                                <div style="font-size: 12px; color: #6b7280;">{{ $video->country->name ?? 'Unknown' }}</div>
                                            </div>
                                        </div>

                                        <div style="display: flex; justify-content: between; align-items: center; font-size: 12px; color: #6b7280;">
                                            <span>{{ number_format($video->views) }} views</span>
                                            <span style="margin: 0 8px;">•</span>
                                            <span>{{ $video->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($videos->hasPages())
                            <div style="margin-top: 24px;">
                                {{ $videos->links() }}
                            </div>
                        @endif

                    @else
                        <!-- Empty State -->
                        <div style="text-align: center; padding: 80px 20px; color: #6b7280;">
                            <div style="font-size: 64px; margin-bottom: 24px;">🎬</div>
                            <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 12px; color: #374151;">No Videos Yet</h3>
                            <p style="margin-bottom: 24px; max-width: 400px; margin-left: auto; margin-right: auto;">
                                This category doesn't have any videos yet. Videos will appear here once creators upload content in this category.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Video Modal -->
    <div id="videoModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                                background: rgba(0,0,0,0.9); z-index: 1000; justify-content: center; align-items: center;">
        <div style="max-width: 90vw; max-height: 90vh; background: white; border-radius: 16px; overflow: hidden; position: relative;">
            <!-- Close Button -->
            <button onclick="closeVideoModal()"
                    style="position: absolute; top: 16px; right: 16px; background: rgba(0,0,0,0.7);
                           border: none; border-radius: 50%; width: 40px; height: 40px;
                           display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10;">
                <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>

            <!-- Video Player -->
            <div id="modalVideoContainer" style="aspect-ratio: 16/9; background: #000;">
                <!-- Video will be inserted here -->
            </div>

            <!-- Video Title -->
            <div style="padding: 20px;">
                <h2 id="modalVideoTitle" style="font-size: 18px; font-weight: 600; color: #374151; margin: 0;"></h2>
            </div>
        </div>
    </div>

    <style>
        .video-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
        }

        .video-card:hover .play-button {
            background: rgba(0,0,0,0.9) !important;
            transform: translate(-50%, -50%) scale(1.1);
        }
    </style>

    <script>
        function openVideoModal(videoId, title, videoUrl, thumbnail) {
            const modal = document.getElementById('videoModal');
            const container = document.getElementById('modalVideoContainer');
            const titleElement = document.getElementById('modalVideoTitle');

            titleElement.textContent = title;

            // Clear previous content
            container.innerHTML = '';

            if (videoUrl.startsWith('videos/')) {
                // Local video file
                const video = document.createElement('video');
                video.controls = true;
                video.style.width = '100%';
                video.style.height = '100%';
                video.style.background = '#000';

                const source = document.createElement('source');
                source.src = `/storage/${videoUrl}`;
                source.type = 'video/mp4';

                video.appendChild(source);
                container.appendChild(video);
            } else {
                // External video (YouTube, etc.)
                const iframe = document.createElement('iframe');
                iframe.src = videoUrl;
                iframe.style.width = '100%';
                iframe.style.height = '100%';
                iframe.frameBorder = '0';
                iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                iframe.allowFullscreen = true;

                container.appendChild(iframe);
            }

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeVideoModal() {
            const modal = document.getElementById('videoModal');
            const container = document.getElementById('modalVideoContainer');

            modal.style.display = 'none';
            document.body.style.overflow = 'auto';

            // Stop video playback
            container.innerHTML = '';
        }

        // Close modal when clicking outside
        document.getElementById('videoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVideoModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeVideoModal();
            }
        });
    </script>
</x-app-layout>
