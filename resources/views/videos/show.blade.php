<x-app-layout>
    <!-- Video Player -->
    <div style="aspect-ratio: 16/9; background: #000; border-radius: 20px; overflow: hidden; margin-bottom: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
        @if(Str::startsWith($video->video_url, 'videos/'))
            <video controls style="width: 100%; height: 100%; background: #000;">
                <source src="{{ Storage::url($video->video_url) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
            <iframe
                style="width: 100%; height: 100%;"
                src="{{ $video->video_url }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        @endif
    </div>

    <!-- Video Title and Meta -->
    <div style="margin-bottom: 20px;">
        <h1 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 15px; color: #55565a; font-family: 'Quicksand', sans-serif;">{{ $video->title }}</h1>

        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="color: #8a95a9; font-size: 15px;">
                    <span>{{ number_format($video->views) }} views</span>
                    <span style="margin: 0 8px;">•</span>
                    <span>{{ $video->created_at->format('M d, Y') }}</span>
                </div>

                @auth
                    @if(auth()->user()->hasRole('student'))
                        @php
                            try {
                                $hasLiked = auth()->user()->hasLikedVideo($video);
                                $likesCount = $video->likesCount();
                            } catch (\Exception $e) {
                                $hasLiked = false;
                                $likesCount = 0;
                            }
                        @endphp

                        <!-- Like Button for Students -->
                        <button id="like-btn"
                                onclick="toggleLike();"
                                style="display: flex; align-items: center; gap: 6px; background: {{ $hasLiked ? '#e91e63' : '#f1f3f4' }};
                                       color: {{ $hasLiked ? 'white' : '#8a95a9' }};
                                       border: none; border-radius: 20px; padding: 8px 16px; font-size: 14px; font-weight: 600;
                                       cursor: pointer; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span id="like-text">{{ $hasLiked ? 'Liked' : 'Like' }}</span>
                            <span id="like-count">({{ $likesCount }})</span>
                        </button>
                    @endif
                @endauth
            </div>

            @if(auth()->user()?->isAdmin())
            <div style="display: flex; align-items: center; gap: 10px;">
                @if(!$video->is_approved)
                <form action="{{ route('admin.videos.approve', $video) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" style="padding: 8px 16px; background: #0cc396; color: white; border-radius: 12px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(12, 195, 150, 0.2);">
                        Approve
                    </button>
                </form>
                @endif

                <form action="{{ route('admin.videos.reject', $video) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="padding: 8px 16px; background: #fe8a8b; color: white; border-radius: 12px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(254, 138, 139, 0.2);">
                        Delete
                    </button>
                </form>
            </div>
            @elseif(auth()->user() && $video->user_id === auth()->id())
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="{{ route('videos.edit', $video) }}" style="padding: 8px 16px; background: #3b82f6; color: white; border-radius: 12px; text-decoration: none; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.2); display: inline-flex; align-items: center; gap: 6px;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Video
                </a>
            </div>
            @endif
        </div>

        <!-- Creator Info -->
        <div style="display: flex; align-items: center; margin-bottom: 20px;">
            <div style="width: 50px; height: 50px; background: #f0f8ff; border-radius: 50%; overflow: hidden; margin-right: 15px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #a5d8e6; font-size: 20px;">
                {{ substr($video->user->name, 0, 1) }}
            </div>
            <div>
                <h3 style="font-weight: 600; font-size: 16px; color: #55565a;">{{ $video->user->name }}</h3>
                <span style="color: #8a95a9; font-size: 14px;">Creator</span>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    <div style="background: #fff; border-radius: 20px; padding: 25px; box-shadow: 0 6px 20px rgba(0,0,0,0.04); border: 1px solid rgba(227, 231, 240, 0.8); margin-bottom: 30px;">
        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 15px; color: #55565a; font-family: 'Quicksand', sans-serif;">Description</h3>
        <div style="background: #f8f9fc; border-radius: 16px; padding: 20px; font-size: 15px; color: #55565a; line-height: 1.7;">
            <p style="white-space: pre-line;">{{ $video->description }}</p>
        </div>
    </div>

    <!-- Related Videos Section -->
    <div style="margin-bottom: 30px;">
        <h2 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 20px; color: #55565a; font-family: 'Quicksand', sans-serif;">Related Videos</h2>

        <!-- Horizontal Scrolling Container -->
        <div style="overflow-x: auto; padding-bottom: 10px;">
            <div style="display: flex; gap: 20px; min-width: max-content; padding: 5px;">
                @foreach($relatedVideos as $relatedVideo)
                <a href="{{ route('videos.show', $relatedVideo) }}" style="display: block; text-decoration: none; flex-shrink: 0; width: 280px; background: #fff; border-radius: 16px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 1px solid rgba(227, 231, 240, 0.8);">
                    <div style="width: 100%; height: 160px; overflow: hidden;">
                        <img src="{{ Storage::url($relatedVideo->thumbnail) }}"
                            alt="{{ $relatedVideo->title }}"
                            style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                    </div>
                    <div style="padding: 15px;">
                        <h3 style="font-size: 15px; font-weight: 600; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; color: #55565a; margin-bottom: 8px; line-height: 1.4; min-height: 42px;">
                            {{ $relatedVideo->title }}
                        </h3>
                        <p style="color: #8a95a9; font-size: 13px; margin-bottom: 4px; font-weight: 500;">{{ $relatedVideo->user->name }}</p>
                        <div style="display: flex; align-items: center; color: #8a95a9; font-size: 12px;">
                            <span>{{ number_format($relatedVideo->views) }} views</span>
                            <span style="margin: 0 6px;">•</span>
                            <span>{{ $relatedVideo->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function toggleLike() {
            const btn = document.getElementById('like-btn');
            const text = document.getElementById('like-text');
            const count = document.getElementById('like-count');

            if (!btn || !text || !count) return;

            btn.disabled = true;
            btn.style.opacity = '0.7';

            const url = '{{ route("videos.like", $video) }}';
            const csrfToken = document.querySelector('meta[name="csrf-token"]');

            if (!csrfToken) {
                btn.disabled = false;
                btn.style.opacity = '1';
                return;
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.liked) {
                    btn.style.background = '#e91e63';
                    btn.style.color = 'white';
                    text.textContent = 'Liked';
                } else {
                    btn.style.background = '#f1f3f4';
                    btn.style.color = '#8a95a9';
                    text.textContent = 'Like';
                }
                count.textContent = `(${data.likes_count})`;
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                btn.disabled = false;
                btn.style.opacity = '1';
            });
        }
    </script>
</x-app-layout>
