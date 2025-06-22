<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6" style="color: #fe8a8b; font-family: 'Quicksand', sans-serif;">User Management</h1>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
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
                        .role-badge {
                            padding: 6px 14px;
                            border-radius: 20px;
                            font-size: 0.85rem;
                            font-weight: 600;
                            color: white;
                            display: inline-block;
                        }
                        .bg-admin { background: linear-gradient(135deg, #fd63a6 0%, #e17055 100%); }
                        .bg-creator { background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%); }
                        .bg-student { background: linear-gradient(135deg, #00b894 0%, #00cec9 100%); }
                        .icon-btn {
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            width: 36px;
                            height: 36px;
                            border-radius: 50%;
                            border: none;
                            background: linear-gradient(135deg, #74b9ff 0%, #fd79a8 100%);
                            color: #fff;
                            font-size: 1.2rem;
                            margin-right: 6px;
                            transition: background 0.2s, box-shadow 0.2s;
                            box-shadow: 0 2px 8px rgba(254, 138, 139, 0.10);
                            cursor: pointer;
                            position: relative;
                        }
                        .icon-btn:last-child { margin-right: 0; }
                        .icon-btn:hover {
                            background: linear-gradient(135deg, #fdcb6e 0%, #fd79a8 100%);
                        }
                        .icon-btn[title]:hover::after {
                            content: attr(title);
                            position: absolute;
                            left: 50%;
                            top: 110%;
                            transform: translateX(-50%);
                            background: #fff7c2;
                            color: #fe8a8b;
                            font-size: 0.85rem;
                            padding: 4px 10px;
                            border-radius: 8px;
                            white-space: nowrap;
                            box-shadow: 0 2px 8px rgba(254, 138, 139, 0.10);
                            z-index: 10;
                        }
                        .select-role {
                            border: 2px solid #ffe6e6;
                            border-radius: 10px;
                            padding: 6px 10px;
                            font-size: 0.95rem;
                            font-family: 'Quicksand', sans-serif;
                            background: #fff7f7;
                            color: #55565a;
                            margin-right: 8px;
                        }
                    </style>

                    <div class="overflow-x-auto">
                        <table class="pretty-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Current Role</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="font-medium">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="role-badge 
                                            @if($user->roles->first()->name == 'admin') bg-admin
                                            @elseif($user->roles->first()->name == 'creator') bg-creator
                                            @else bg-student @endif">
                                            @if($user->roles->first()->name == 'admin') 👑
                                            @elseif($user->roles->first()->name == 'creator') 🎬
                                            @else 👨‍🎓 @endif
                                            {{ ucfirst($user->roles->first()->name) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($user->id != auth()->id())
                                        <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" class="inline-flex items-center space-x-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="role_id" class="select-role">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $user->roles->first()->id == $role->id ? 'selected' : '' }}>
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="icon-btn" title="Update">
                                                🔄
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-gray-400 text-sm">Current User</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
