<x-app-layout>
    <div style="display: grid; grid-template-columns: 1fr; gap: 30px; max-width: 1400px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 1fr; gap: 30px;">
            <!-- Main Content -->
            <div style="grid-column: 1 / 4; display: grid; grid-template-columns: minmax(0, 2fr) minmax(300px, 1fr); gap: 30px;">
                <div>
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

                    <!-- Video Info -->
                    <div style="background: #fff; border-radius: 20px; padding: 25px; box-shadow: 0 6px 20px rgba(0,0,0,0.04); border: 1px solid rgba(227, 231, 240, 0.8);">
                        <h1 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 15px; color: #55565a; font-family: 'Quicksand', sans-serif;">{{ $video->title }}</h1>

                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #f0f2f7;">
                            <div style="display: flex; align-items: center; color: #8a95a9; font-size: 15px;">
                                <span>{{ number_format($video->views) }} views</span>
                                <span style="margin: 0 8px;">•</span>
                                <span>{{ $video->created_at->format('M d, Y') }}</span>
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
                            @endif
                        </div>

                        <div style="display: flex; align-items: center; margin-bottom: 20px;">
                            <div style="width: 50px; height: 50px; background: #f0f8ff; border-radius: 50%; overflow: hidden; margin-right: 15px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #a5d8e6; font-size: 20px;">
                                {{ substr($video->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 style="font-weight: 600; font-size: 16px; color: #55565a;">{{ $video->user->name }}</h3>
                                <span style="color: #8a95a9; font-size: 14px;">Creator</span>
                            </div>
                        </div>

                        <div style="background: #f8f9fc; border-radius: 16px; padding: 20px; font-size: 15px; color: #55565a; line-height: 1.7;">
                            <p style="white-space: pre-line;">{{ $video->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div>
                    <h2 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 20px; color: #55565a; font-family: 'Quicksand', sans-serif;">Related Videos</h2>

                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        @foreach($relatedVideos as $relatedVideo)
                        <a href="{{ route('videos.show', $relatedVideo) }}" style="display: flex; gap: 12px; text-decoration: none; background: #fff; border-radius: 16px; padding: 10px; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.03); border: 1px solid rgba(227, 231, 240, 0.8);">
                            <div style="flex-shrink: 0; width: 120px; height: 68px; overflow: hidden; border-radius: 10px;">
                                <img src="{{ Storage::url($relatedVideo->thumbnail) }}"
                                    alt="{{ $relatedVideo->title }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div style="flex: 1; min-width: 0; padding: 2px 0;">
                                <h3 style="font-size: 14px; font-weight: 600; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; color: #55565a; margin-bottom: 4px; line-height: 1.3;">
                                    {{ $relatedVideo->title }}
                                </h3>
                                <p style="color: #8a95a9; font-size: 12px; margin-bottom: 2px;">{{ $relatedVideo->user->name }}</p>
                                <div style="display: flex; align-items: center; color: #8a95a9; font-size: 12px;">
                                    <span>{{ number_format($relatedVideo->views) }} views</span>
                                    <span style="margin: 0 4px;">•</span>
                                    <span>{{ $relatedVideo->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        @media (max-width: 992px) {
            [style*="grid-template-columns: minmax(0, 2fr) minmax(300px, 1fr)"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
    @endpush
</x-app-layout>
