<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">                    <!-- Header -->
                    <div class="mb-8">
                        <div>
                            <h1 style="font-family: 'Quicksand', sans-serif; font-size: 1.8rem; font-weight: 700; color: #55565a; margin-bottom: 0.5rem;">User Management</h1>
                            <p style="color: #8a95a9; font-size: 1.1rem;">Manage user roles and permissions</p>
                        </div>
                    </div>

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Users Table -->
                    <style>
                        .admin-table {
                            width: 100%;
                            border-collapse: collapse;
                            background: white;
                            border-radius: 16px;
                            overflow: hidden;
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
                        }
                        .admin-table th {
                            background: linear-gradient(90deg, #fe8a8b 0%, #fff7c2 100%);
                            color: white;
                            padding: 16px;
                            text-align: left;
                            font-weight: 600;
                            font-size: 14px;
                            text-transform: uppercase;
                            letter-spacing: 0.5px;
                        }
                        .admin-table td {
                            padding: 16px;
                            border-bottom: 1px solid #f1f5f9;
                            vertical-align: middle;
                        }
                        .admin-table tbody tr:hover {
                            background-color: #fff7c2;
                        }
                        .user-avatar {
                            width: 32px;
                            height: 32px;
                            background: linear-gradient(135deg, #fe8a8b 0%, #fff7c2 100%);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: white;
                            font-weight: bold;
                            font-size: 12px;
                            margin-right: 12px;
                        }
                        .role-badge {
                            background: #fff7c2;
                            color: #fe8a8b;
                            padding: 4px 8px;
                            border-radius: 8px;
                            font-size: 12px;
                            font-weight: 600;
                        }
                        .role-badge.admin {
                            background: linear-gradient(135deg, #fd63a6 0%, #e17055 100%);
                            color: white;
                        }
                        .role-badge.creator {
                            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
                            color: white;
                        }
                        .role-badge.student {
                            background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
                            color: white;
                        }
                        .action-btn {
                            padding: 8px;
                            border: none;
                            border-radius: 8px;
                            cursor: pointer;
                            transition: all 0.2s;
                            margin: 0 2px;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            text-decoration: none;
                        }
                        .action-btn.update {
                            background: #3b82f6;
                            color: white;
                        }
                        .action-btn:hover {
                            transform: translateY(-1px);
                            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
                        }
                        .select-role {
                            border: 2px solid #ffe6e6;
                            border-radius: 8px;
                            padding: 4px 8px;
                            font-size: 12px;
                            font-family: 'Quicksand', sans-serif;
                            background: #fff;
                            color: #374151;
                            margin-right: 8px;
                        }
                    </style>

                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center;">
                                            <div class="user-avatar">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div style="font-weight: 600; color: #374151;">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="color: #6b7280;">{{ $user->email }}</span>
                                    </td>
                                    <td>
                                        <span class="role-badge {{ $user->roles->first()->name }}">
                                            @if($user->roles->first()->name == 'admin') 👑
                                            @elseif($user->roles->first()->name == 'creator') 🎬
                                            @else 👨‍🎓 @endif
                                            {{ ucfirst($user->roles->first()->name) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="color: #6b7280;">{{ $user->created_at->format('M d, Y') }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        @if($user->id != auth()->id())
                                            <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" style="display: inline-flex; align-items: center;">
                                                @csrf
                                                @method('PUT')
                                                <select name="role_id" class="select-role">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}" {{ $user->roles->first()->id == $role->id ? 'selected' : '' }}>
                                                            {{ ucfirst($role->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="action-btn update" title="Update Role">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <span style="color: #9ca3af; font-size: 14px;">Current User</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px; color: #6b7280;">
                                        <div style="font-size: 48px; margin-bottom: 16px;">👥</div>
                                        <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 8px;">No Users Found</h3>
                                        <p style="margin-bottom: 16px;">No users are available in the system.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if($users->hasPages())
                        <div style="margin-top: 24px;">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
