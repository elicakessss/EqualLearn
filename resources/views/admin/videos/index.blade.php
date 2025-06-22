<x-app-layout>
    <div class="admin-container">
        <div class="admin-header">
            <h1 style="font-family: 'Quicksand', sans-serif; font-size: 1.8rem; font-weight: 700; color: #55565a; margin-bottom: 0.5rem;">Video Management</h1>
            <p style="color: #8a95a9; font-size: 1.1rem;">Approve or reject user-uploaded videos</p>
        </div>

        <style>
            .admin-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 1rem;
            }
            .admin-header {
                margin-bottom: 2rem;
            }
            .video-tabs {
                display: flex;
                margin-bottom: 1.5rem;
                border-radius: 16px;
                background: #fff;
                box-shadow: 0 2px 8px rgba(254, 138, 139, 0.08);
                overflow: hidden;
                border: 1.5px solid #f6e6e6;
            }
            .video-tab {
                flex: 1;
                padding: 12px 20px;
                text-align: center;
                cursor: pointer;
                font-family: 'Quicksand', sans-serif;
                font-weight: 600;
                transition: all 0.2s;
                border: none;
                background: transparent;
            }
            .video-tab.active {
                background: linear-gradient(135deg, #ffd5de 0%, #fff7c2 100%);
                color: #fe8a8b;
            }
            .video-tab:not(.active) {
                color: #8a95a9;
            }
            .video-tab:not(.active):hover {
                background: #f8f9fc;
                color: #fe8a8b;
            }
            .video-table {
                background: #fff;
                border-radius: 16px;
                box-shadow: 0 4px 16px rgba(254, 138, 139, 0.08);
                border: 1.5px solid #f6e6e6;
                overflow: hidden;
            }
            .video-table table {
                width: 100%;
                border-collapse: collapse;
            }
            .video-table th {
                background: linear-gradient(135deg, #ffd5de 0%, #fff7c2 100%);
                padding: 16px 20px;
                text-align: left;
                font-family: 'Quicksand', sans-serif;
                font-weight: 700;
                color: #fe8a8b;
                border-bottom: 1.5px solid #f6e6e6;
            }
            .video-table td {
                padding: 16px 20px;
                border-bottom: 1px solid #f0f0f0;
                vertical-align: top;
            }
            .video-table tr:last-child td {
                border-bottom: none;
            }
            .video-table tr:hover {
                background: #fafbfc;
            }
            .video-thumbnail-small {
                width: 80px;
                height: 45px;
                object-fit: cover;
                border-radius: 8px;
                border: 1px solid #f0f0f0;
            }
            .video-title {
                font-family: 'Quicksand', sans-serif;
                font-weight: 600;
                color: #55565a;
                margin-bottom: 4px;
            }
            .video-meta {
                font-size: 0.9rem;
                color: #8a95a9;
            }
            .action-buttons {
                display: flex;
                gap: 8px;
            }
            .btn-approve {
                background: linear-gradient(135deg, #d0f7d6 0%, #fff7c2 100%);
                color: #4ade80;
                border: 1px solid #86efac;
                padding: 6px 12px;
                border-radius: 8px;
                font-size: 0.9rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s;
            }
            .btn-approve:hover {
                background: linear-gradient(135deg, #bbf7d0 0%, #fef3c7 100%);
                transform: translateY(-1px);
            }
            .btn-reject {
                background: linear-gradient(135deg, #fecaca 0%, #fed7d7 100%);
                color: #ef4444;
                border: 1px solid #fca5a5;
                padding: 6px 12px;
                border-radius: 8px;
                font-size: 0.9rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s;
            }
            .btn-reject:hover {
                background: linear-gradient(135deg, #fca5a5 0%, #fbb6ce 100%);
                transform: translateY(-1px);
            }
            .btn-unapprove {
                background: linear-gradient(135deg, #ddd6fe 0%, #e0e7ff 100%);
                color: #7c3aed;
                border: 1px solid #c4b5fd;
                padding: 6px 12px;
                border-radius: 8px;
                font-size: 0.9rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s;
            }
            .btn-unapprove:hover {
                background: linear-gradient(135deg, #c4b5fd 0%, #ddd6fe 100%);
                transform: translateY(-1px);
            }
            .tab-content {
                display: none;
            }
            .tab-content.active {
                display: block;
            }
            .empty-state {
                text-align: center;
                padding: 3rem 2rem;
                color: #8a95a9;
            }
            .empty-state h3 {
                font-family: 'Quicksand', sans-serif;
                font-size: 1.2rem;
                margin-bottom: 0.5rem;
                color: #fe8a8b;
            }
        </style>

        <!-- Tab Navigation -->
        <div class="video-tabs">
            <button class="video-tab active" onclick="showTab('pending')">
                Pending Approval ({{ $pendingVideos->total() }})
            </button>
            <button class="video-tab" onclick="showTab('approved')">
                Approved Videos ({{ $approvedVideos->total() }})
            </button>
        </div>

        <!-- Pending Videos Tab -->
        <div id="pending-tab" class="tab-content active">
            <div class="video-table">
                @if($pendingVideos->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Video</th>
                                <th>Title & Creator</th>
                                <th>Category</th>
                                <th>Uploaded</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingVideos as $video)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="Thumbnail" class="video-thumbnail-small">
                                    </td>
                                    <td>
                                        <div class="video-title">{{ $video->title }}</div>
                                        <div class="video-meta">By {{ $video->user->name }}</div>
                                    </td>
                                    <td>
                                        <span style="background: #fff7c2; color: #fe8a8b; padding: 4px 8px; border-radius: 6px; font-size: 0.9rem; font-weight: 600;">
                                            {{ $video->category->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="video-meta">{{ $video->created_at->format('M j, Y') }}</div>
                                        <div class="video-meta">{{ $video->created_at->format('g:i A') }}</div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <form action="{{ route('admin.videos.approve', $video) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn-approve">✓ Approve</button>
                                            </form>
                                            <form action="{{ route('admin.videos.reject', $video) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to reject and delete this video? This action cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-reject">✗ Reject</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="padding: 20px;">
                        {{ $pendingVideos->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <h3>No Pending Videos</h3>
                        <p>All videos have been reviewed! 🎉</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Approved Videos Tab -->
        <div id="approved-tab" class="tab-content">
            <div class="video-table">
                @if($approvedVideos->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Video</th>
                                <th>Title & Creator</th>
                                <th>Category</th>
                                <th>Approved</th>
                                <th>Views</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($approvedVideos as $video)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="Thumbnail" class="video-thumbnail-small">
                                    </td>
                                    <td>
                                        <div class="video-title">{{ $video->title }}</div>
                                        <div class="video-meta">By {{ $video->user->name }}</div>
                                    </td>
                                    <td>
                                        <span style="background: #fff7c2; color: #fe8a8b; padding: 4px 8px; border-radius: 6px; font-size: 0.9rem; font-weight: 600;">
                                            {{ $video->category->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="video-meta">{{ $video->updated_at->format('M j, Y') }}</div>
                                        <div class="video-meta">{{ $video->updated_at->format('g:i A') }}</div>
                                    </td>
                                    <td>
                                        <div class="video-meta">{{ number_format($video->views) }} views</div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('videos.show', $video->slug) }}" class="btn-approve" style="text-decoration: none;">👁 View</a>
                                            <form action="{{ route('admin.videos.unapprove', $video) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to unapprove this video? It will be hidden from public view.')">
                                                @csrf
                                                <button type="submit" class="btn-unapprove">↩ Unapprove</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="padding: 20px;">
                        {{ $approvedVideos->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <h3>No Approved Videos</h3>
                        <p>No videos have been approved yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.video-tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Show selected tab
            document.getElementById(tabName + '-tab').classList.add('active');
            event.target.classList.add('active');
        }
    </script>
</x-app-layout>
