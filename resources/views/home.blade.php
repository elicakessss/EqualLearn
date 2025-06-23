<x-app-layout>
    <div class="py-12 text-center">
        <div class="home-background" style="position: relative; margin-bottom: 24px;">
            <div class="hero-header">
                <div class="hero-text">
                    @if($selectedCategory && $selectedCountry)
                        <h1 class="hero-title">{{ $selectedCategory->name }} Videos from {{ $selectedCountry->name }}</h1>
                        <p class="hero-subtitle">Discover amazing {{ strtolower($selectedCategory->name) }} content from {{ $selectedCountry->name }}</p>
                    @elseif($selectedCategory)
                        <h1 class="hero-title">{{ $selectedCategory->name }} Videos</h1>
                        <p class="hero-subtitle">Discover amazing {{ strtolower($selectedCategory->name) }} content for kids</p>
                    @elseif($selectedCountry)
                        <h1 class="hero-title">Videos from {{ $selectedCountry->name }}</h1>
                        <p class="hero-subtitle">Discover amazing educational content from {{ $selectedCountry->name }}</p>
                    @else
                        <h1 class="hero-title">Educational Videos</h1>
                        <p class="hero-subtitle">Discover amazing learning content for kids</p>
                    @endif
                </div>

                @auth
                    @if(auth()->user()->role === 'creator')
                        <div class="hero-action">
                            <a href="{{ route('videos.create') }}" class="upload-btn">
                                <span class="upload-icon">+</span>
                                Upload Video
                            </a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section" style="margin-bottom: 30px;">
            <form method="GET" action="{{ route('home') }}" class="filter-form">
                <div class="filter-row">
                    <select name="category" onchange="this.form.submit()" class="filter-dropdown">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request()->query('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="country" onchange="this.form.submit()" class="filter-dropdown">
                        <option value="">All Countries</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ request()->query('country') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>

                    @if(request()->query('category') || request()->query('country'))
                        <a href="{{ route('home') }}" class="clear-filters-btn">
                            Clear Filters
                        </a>
                    @endif
                </div>

                <!-- Preserve search if exists -->
                @if(request()->query('search'))
                    <input type="hidden" name="search" value="{{ request()->query('search') }}">
                @endif
            </form>
        </div>

        <style>
            .home-background {
                background: linear-gradient(135deg, #a8e6cf 0%, #dcedc1 25%, #ffd3a5 50%, #fd9853 75%, #ff6b9d 100%);
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                border-radius: 20px;
                padding: 50px 40px;
                position: relative;
                overflow: hidden;
            }

            .home-background::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(168, 230, 207, 0.05) 0%, rgba(220, 237, 193, 0.05) 25%, rgba(255, 211, 165, 0.05) 50%, rgba(253, 152, 83, 0.05) 75%, rgba(255, 107, 157, 0.05) 100%);
                z-index: 1;
            }

            .home-background > * {
                position: relative;
                z-index: 2;
            }

            .hero-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 20px;
            }

            .hero-text {
                flex: 1;
                text-align: left;
            }

            .hero-action {
                flex-shrink: 0;
            }

            .upload-btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: linear-gradient(135deg, #ff6b9d 0%, #ffc3a0 100%);
                color: white;
                text-decoration: none;
                padding: 12px 24px;
                border-radius: 12px;
                font-weight: 600;
                font-size: 1rem;
                box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
            }

            .upload-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(255, 107, 157, 0.4);
                text-decoration: none;
                color: white;
            }

            .upload-icon {
                background: rgba(255, 255, 255, 0.2);
                width: 24px;
                height: 24px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                font-weight: bold;
            }

            /* Filter Section Styles */
            .filter-section {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            .filter-form {
                background: white;
                border-radius: 16px;
                padding: 20px;
                box-shadow: 0 4px 20px rgba(254, 138, 139, 0.08);
                border: 1.5px solid #f6e6e6;
            }

            .filter-row {
                display: flex;
                gap: 12px;
                align-items: center;
                flex-wrap: wrap;
                justify-content: flex-start;
            }

            .filter-dropdown {
                padding: 8px 12px;
                border: 2px solid #ffe6e6;
                border-radius: 12px;
                background: #fff7c2;
                color: #fe8a8b;
                font-weight: 600;
                font-size: 14px;
                font-family: 'Nunito', 'Quicksand', sans-serif;
                min-width: 120px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .filter-dropdown:focus {
                outline: none;
                border-color: #fe8a8b;
                box-shadow: 0 0 0 3px rgba(254, 138, 139, 0.1);
            }

            .filter-dropdown:hover {
                background: #ffd5de;
            }

            .clear-filters-btn {
                padding: 12px 20px;
                background: linear-gradient(135deg, #ff6b9d 0%, #ffc3a0 100%);
                color: white;
                text-decoration: none;
                border-radius: 12px;
                font-weight: 600;
                transition: all 0.3s ease;
                box-shadow: 0 2px 10px rgba(255, 107, 157, 0.2);
            }

            .clear-filters-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);
                text-decoration: none;
                color: white;
            }

            @media (max-width: 768px) {
                .home-background {
                    padding: 30px 20px;
                    margin-bottom: 20px;
                    border-radius: 16px;
                }

                .hero-header {
                    flex-direction: column;
                    text-align: center;
                    gap: 20px;
                }

                .hero-text {
                    text-align: center;
                }

                .hero-title {
                    font-size: 1.8rem;
                    margin-bottom: 0.5rem;
                }

                .hero-subtitle {
                    font-size: 1rem;
                }

                .upload-btn {
                    font-size: 0.9rem;
                    padding: 12px 20px;
                    border-radius: 12px;
                }

                .filter-section {
                    padding: 0 16px;
                }

                .filter-form {
                    padding: 16px;
                    border-radius: 12px;
                    margin-bottom: 20px;
                }

                .filter-row {
                    flex-direction: column;
                    gap: 12px;
                    align-items: stretch;
                }

                .filter-dropdown {
                    width: 100%;
                    min-width: auto;
                    padding: 12px 16px;
                    font-size: 15px;
                    border-radius: 12px;
                }

                .clear-filters-btn {
                    width: 100%;
                    text-align: center;
                    padding: 12px 20px;
                    margin-top: 8px;
                }

                /* Mobile video grid */
                .video-grid {
                    grid-template-columns: 1fr;
                    gap: 16px;
                    padding: 0 16px;
                }

                .video-card {
                    border-radius: 16px;
                    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
                }

                .video-info {
                    padding: 16px;
                }

                .video-title {
                    font-size: 16px;
                    line-height: 1.3;
                }

                .video-meta {
                    font-size: 13px;
                }
            }

            @media (max-width: 480px) {
                .home-background {
                    padding: 24px 16px;
                    margin-bottom: 16px;
                }

                .hero-title {
                    font-size: 1.6rem;
                }

                .hero-subtitle {
                    font-size: 0.9rem;
                }

                .upload-btn {
                    font-size: 0.85rem;
                    padding: 10px 16px;
                }

                .filter-form {
                    padding: 12px;
                }

                .filter-dropdown {
                    padding: 10px 14px;
                    font-size: 14px;
                }

                .video-grid {
                    padding: 0 12px;
                    gap: 12px;
                }

                .video-info {
                    padding: 12px;
                }
            }
                }
            }

            .hero-title {
                font-family: 'Quicksand', sans-serif;
                font-size: 2.2rem;
                font-weight: 700;
                color: #ffffff;
                margin-bottom: 0.3rem;
                text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                letter-spacing: -0.02em;
                line-height: 1.2;
            }

            .hero-subtitle {
                font-family: 'Quicksand', sans-serif;
                font-size: 1rem;
                font-weight: 500;
                color: #ffffff;
                margin-bottom: 0;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
                opacity: 0.95;
                letter-spacing: 0.01em;
                line-height: 1.4;
            }

            @media (max-width: 768px) {
                .hero-title {
                    font-size: 2rem;
                }
                .hero-subtitle {
                    font-size: 1rem;
                }
                .home-background {
                    padding: 40px 30px;
                }
            }
            .video-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            /* Responsive design for smaller screens */
            @media (max-width: 1024px) {
                .video-grid {
                    grid-template-columns: repeat(3, 1fr);
                    gap: 16px;
                }
            }

            @media (max-width: 768px) {
                .video-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 12px;
                }
            }

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
                            <span>{{ $video->country->name }}</span>
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
                    @if($selectedCategory && $selectedCountry)
                        No {{ strtolower($selectedCategory->name) }} videos from {{ $selectedCountry->name }} yet.
                    @elseif($selectedCategory)
                        No videos in this category yet.
                    @elseif($selectedCountry)
                        No videos from {{ $selectedCountry->name }} yet.
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
