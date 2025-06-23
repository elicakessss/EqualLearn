<x-app-layout>
    <div class="dashboard-container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="welcome-content">
                <div class="user-info">
                    <div class="user-avatar">
                        @if(auth()->user()->hasRole('admin'))
                            👑
                        @elseif(auth()->user()->hasRole('creator'))
                            🎬
                        @else
                            👨‍🎓
                        @endif
                    </div>
                    <div class="user-details">
                        <h1 class="welcome-title">Welcome back, {{ auth()->user()->name }}!</h1>
                        <p class="user-role">
                            @if(auth()->user()->hasRole('admin'))
                                Administrator Dashboard
                            @elseif(auth()->user()->hasRole('creator'))
                                Content Creator Dashboard
                            @else
                                Student Dashboard
                            @endif
                        </p>
                    </div>
                </div>
                <div class="user-actions">
                    <a href="{{ route('profile.show') }}" class="action-btn primary">
                        <i class="fas fa-user-edit"></i>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="stats-grid">
            @if(auth()->user()->hasRole('admin'))
                <div class="stat-card">
                    <div class="stat-icon admin">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ \App\Models\User::count() }}</h3>
                        <p>Total Users</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon video">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ \App\Models\Video::count() }}</h3>
                        <p>Total Videos</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon category">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ \App\Models\Category::count() }}</h3>
                        <p>Categories</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon country">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ \App\Models\Country::count() }}</h3>
                        <p>Countries</p>
                    </div>
                </div>
            @elseif(auth()->user()->hasRole('creator'))
                <div class="stat-card">
                    <div class="stat-icon video">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ auth()->user()->videos()->count() }}</h3>
                        <p>My Videos</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon views">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ auth()->user()->videos()->sum('views') ?? 0 }}</h3>
                        <p>Total Views</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon likes">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ auth()->user()->videos()->withCount('likes')->get()->sum('likes_count') ?? 0 }}</h3>
                        <p>Total Likes</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon pending">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ auth()->user()->videos()->where('is_approved', false)->count() }}</h3>
                        <p>Pending Approval</p>
                    </div>
                </div>
            @else
                <div class="stat-card">
                    <div class="stat-icon likes">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ auth()->user()->likedVideos()->count() }}</h3>
                        <p>Liked Videos</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon video">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ \App\Models\Video::where('is_approved', true)->count() }}</h3>
                        <p>Available Videos</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon category">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ \App\Models\Category::count() }}</h3>
                        <p>Categories</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon time">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ auth()->user()->created_at->format('M Y') }}</h3>
                        <p>Member Since</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions-section">
            <h2 class="section-title">Quick Actions</h2>
            <div class="actions-grid">
                @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.categories.index') }}" class="action-card">
                        <div class="action-icon categories">
                            <i class="fas fa-list"></i>
                        </div>
                        <h3>Manage Categories</h3>
                        <p>Add, edit, or remove video categories</p>
                    </a>
                    <a href="{{ route('admin.countries.index') }}" class="action-card">
                        <div class="action-icon countries">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3>Manage Countries</h3>
                        <p>Add, edit, or remove countries</p>
                    </a>
                    <a href="{{ route('admin.videos.index') }}" class="action-card">
                        <div class="action-icon videos">
                            <i class="fas fa-video"></i>
                        </div>
                        <h3>Manage Videos</h3>
                        <p>Review and approve user videos</p>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="action-card">
                        <div class="action-icon users">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Manage Users</h3>
                        <p>View and manage user accounts</p>
                    </a>
                    <a href="{{ route('admin.logs.index') }}" class="action-card">
                        <div class="action-icon logs">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3>System Logs</h3>
                        <p>View system activity logs</p>
                    </a>
                @elseif(auth()->user()->hasRole('creator'))
                    <a href="{{ route('videos.create') }}" class="action-card">
                        <div class="action-icon upload">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <h3>Upload Video</h3>
                        <p>Share new educational content</p>
                    </a>
                @endif
                    <a href="{{ route('home') }}" class="action-card">
                        <div class="action-icon home">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3>Browse Videos</h3>
                        <p>Explore educational content</p>
                    </a>
                    <a href="{{ route('profile.show') }}" class="action-card">
                        <div class="action-icon profile">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <h3>Edit Profile</h3>
                        <p>Update your account information</p>
                    </a>
            </div>
        </div>

        <!-- Recent Content -->
        <div class="recent-content-section">
            <h2 class="section-title">
                @if(auth()->user()->hasRole('creator'))
                    My Recent Videos
                @elseif(auth()->user()->hasRole('admin'))
                    Recent Videos (Pending Approval)
                @else
                    Recently Liked Videos
                @endif
            </h2>
            <div class="content-grid">
                @if(auth()->user()->hasRole('creator'))
                    @forelse(auth()->user()->videos()->latest()->take(4)->get() as $video)
                        <div class="content-card">
                            <div class="content-thumbnail">
                                @if($video->thumbnail_path)
                                    <img src="{{ Storage::url($video->thumbnail_path) }}" alt="{{ $video->title }}">
                                @else
                                    <div class="placeholder-thumbnail">
                                        <i class="fas fa-video"></i>
                                    </div>
                                @endif
                                <div class="video-status {{ $video->is_approved ? 'approved' : 'pending' }}">
                                    {{ $video->is_approved ? 'Approved' : 'Pending' }}
                                </div>
                            </div>
                            <div class="content-info">
                                <h4>{{ Str::limit($video->title, 40) }}</h4>
                                <p>{{ $video->views ?? 0 }} views • {{ $video->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-video"></i>
                            <p>No videos uploaded yet</p>
                            <a href="{{ route('videos.create') }}" class="btn-primary">Upload Your First Video</a>
                        </div>
                    @endforelse
                @elseif(auth()->user()->hasRole('admin'))
                    @forelse(\App\Models\Video::where('is_approved', false)->latest()->take(4)->get() as $video)
                        <div class="content-card">
                            <div class="content-thumbnail">
                                @if($video->thumbnail_path)
                                    <img src="{{ Storage::url($video->thumbnail_path) }}" alt="{{ $video->title }}">
                                @else
                                    <div class="placeholder-thumbnail">
                                        <i class="fas fa-video"></i>
                                    </div>
                                @endif
                                <div class="video-status pending">Pending Review</div>
                            </div>
                            <div class="content-info">
                                <h4>{{ Str::limit($video->title, 40) }}</h4>
                                <p>By {{ $video->user->name }} • {{ $video->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-check-circle"></i>
                            <p>No videos pending approval</p>
                        </div>
                    @endforelse
                @else
                    @forelse(auth()->user()->likedVideos()->latest('video_likes.created_at')->take(4)->get() as $video)
                        <a href="{{ route('videos.show', $video->slug) }}" class="content-card">
                            <div class="content-thumbnail">
                                @if($video->thumbnail_path)
                                    <img src="{{ Storage::url($video->thumbnail_path) }}" alt="{{ $video->title }}">
                                @else
                                    <div class="placeholder-thumbnail">
                                        <i class="fas fa-video"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="content-info">
                                <h4>{{ Str::limit($video->title, 40) }}</h4>
                                <p>{{ $video->views ?? 0 }} views • {{ $video->created_at->diffForHumans() }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-heart"></i>
                            <p>No liked videos yet</p>
                            <a href="{{ route('home') }}" class="btn-primary">Explore Videos</a>
                        </div>
                    @endforelse
                @endif
            </div>
        </div>
    </div>

    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, #fe8a8b 0%, #fff7c2 100%);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(254, 138, 139, 0.15);
        }

        .welcome-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .welcome-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            margin: 0 0 4px 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-role {
            font-family: 'Nunito', sans-serif;
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
            font-weight: 500;
        }

        .user-actions .action-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .user-actions .action-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(227, 231, 240, 0.8);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(254, 138, 139, 0.12);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .stat-icon.admin { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stat-icon.video { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .stat-icon.category { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .stat-icon.country { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .stat-icon.views { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
        .stat-icon.likes { background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); }
        .stat-icon.pending { background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); }
        .stat-icon.time { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); }

        .stat-info h3 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #55565a;
            margin: 0;
        }

        .stat-info p {
            color: #8a95a9;
            margin: 0;
            font-weight: 500;
        }

        /* Sections */
        .section-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #55565a;
            margin: 0 0 20px 0;
        }

        .quick-actions-section {
            margin-bottom: 40px;
        }

        /* Actions Grid */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .action-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(227, 231, 240, 0.8);
            display: block;
        }

        .action-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(254, 138, 139, 0.15);
            text-decoration: none;
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            margin-bottom: 16px;
        }

        .action-icon.categories { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .action-icon.countries { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .action-icon.videos { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .action-icon.users { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .action-icon.logs { background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); }
        .action-icon.upload { background: linear-gradient(135deg, #a8e6cf 0%, #88d8c0 100%); }
        .action-icon.home { background: linear-gradient(135deg, #ffa726 0%, #ff7043 100%); }
        .action-icon.profile { background: linear-gradient(135deg, #ab47bc 0%, #8e24aa 100%); }

        .action-card h3 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: #55565a;
            margin: 0 0 8px 0;
        }

        .action-card p {
            color: #8a95a9;
            margin: 0;
            font-size: 14px;
            line-height: 1.4;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .content-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(227, 231, 240, 0.8);
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
        }

        .content-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(254, 138, 139, 0.12);
            text-decoration: none;
        }

        .content-thumbnail {
            width: 100%;
            height: 140px;
            position: relative;
            overflow: hidden;
        }

        .content-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .placeholder-thumbnail {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f8f9fc 0%, #e3e7f0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8a95a9;
            font-size: 24px;
        }

        .video-status {
            position: absolute;
            top: 8px;
            right: 8px;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .video-status.approved {
            background: #effbf7;
            color: #0cc396;
        }

        .video-status.pending {
            background: #fff5f5;
            color: #fe8a8b;
        }

        .content-info {
            padding: 16px;
        }

        .content-info h4 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: #55565a;
            margin: 0 0 8px 0;
            line-height: 1.3;
        }

        .content-info p {
            color: #8a95a9;
            margin: 0;
            font-size: 13px;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            color: #8a95a9;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        /* Buttons */
        .action-btn, .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .action-btn.primary, .btn-primary {
            background: linear-gradient(135deg, #fe8a8b 0%, #ff7b7c 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(254, 138, 139, 0.25);
        }

        .action-btn.primary:hover, .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(254, 138, 139, 0.35);
            text-decoration: none;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 0 16px;
            }

            .welcome-content {
                flex-direction: column;
                text-align: center;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 16px;
            }

            .actions-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .content-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 16px;
            }
        }
    </style>
</x-app-layout>
