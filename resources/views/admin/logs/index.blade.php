<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">                    <h1 class="text-2xl font-bold mb-6" style="color: #fe8a8b; font-family: 'Quicksand', sans-serif;">System Logs</h1>
                    <p class="text-gray-600 mb-4">Track all actions performed in the system</p>

                    @if(isset($error))
                        <div style="background: #fff5f5; color: #fe8a8b; border: 1px solid #ffdede; padding: 20px; border-radius: 15px; margin-bottom: 20px;">
                            <h3 style="font-weight: 600; margin-bottom: 10px;">⚠️ System Logs Table Missing</h3>
                            <p style="margin-bottom: 15px;">{{ $error }}</p>
                            <a href="{{ $createUrl }}" style="background: #fe8a8b; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                Create System Logs Table
                            </a>
                        </div>
                    @endif

                    <style>
                        .pretty-table {
                            width: 100%;
                            border-radius: 18px;
                            overflow: hidden;
                            box-shadow: 0 4px 24px 0 rgba(254, 138, 139, 0.08);
                        }
                        .pretty-table thead {
                            background: linear-gradient(90deg, #fff7c2 0%, #ffd5de 100%);
                        }
                        .pretty-table th {
                            color: #fe8a8b;
                            font-family: 'Quicksand', sans-serif;
                            font-weight: 700;
                            font-size: 1rem;
                            letter-spacing: 1px;
                            border-bottom: 2px solid #ffe6e6;
                            padding: 16px 12px;
                        }
                        .pretty-table td {
                            font-family: 'Quicksand', sans-serif;
                            font-size: 1rem;
                            color: #55565a;
                            padding: 16px 12px;
                        }
                        .pretty-table tbody tr {
                            transition: background 0.18s;
                        }
                        .pretty-table tbody tr:hover {
                            background: #fff7f7;
                        }
                        .action-badge {
                            padding: 6px 14px;
                            border-radius: 20px;
                            font-size: 0.95rem;
                            font-weight: 600;
                            color: white;
                            display: inline-flex;
                            align-items: center;
                            gap: 6px;
                        }
                        .action-user_registered { background: linear-gradient(135deg, #00b894 0%, #00cec9 100%); }
                        .action-role_changed { background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%); }
                        .action-category_created { background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%); }
                        .action-video_uploaded { background: linear-gradient(135deg, #fd63a6 0%, #e84393 100%); }
                        .action-default { background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%); }
                    </style>                    @if(!isset($error))
                    <div class="overflow-x-auto">
                        <table class="pretty-table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                <tr>
                                    <td class="font-medium">{{ $log->user ? $log->user->name : 'System' }}</td>
                                    <td>
                                        <span class="action-badge action-{{ str_replace(' ', '_', strtolower($log->action)) }}">
                                            @switch($log->action)
                                                @case('User Registered')
                                                    ✨ User Registered
                                                    @break
                                                @case('Role Changed')
                                                    🔄 Role Changed
                                                    @break
                                                @case('Category Created')
                                                    📁 Category Created
                                                    @break
                                                @case('Video Uploaded')
                                                    🎬 Video Uploaded
                                                    @break
                                                @default
                                                    📝 {{ $log->action }}
                                            @endswitch
                                        </span>
                                    </td>
                                    <td>{{ $log->description }}</td>
                                    <td>{{ $log->created_at->format('M d, Y H:i:s') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        No logs found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $logs->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
