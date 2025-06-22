<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold flex items-center gap-6" style="color: #fe8a8b; font-family: 'Quicksand', sans-serif;">
                            Category Management
                            <button id="openAddCategoryModal" type="button" class="icon-btn" title="Add Category">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </h1>
                    </div>

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
                            margin-bottom: 0;
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
                        .action-icons {
                            display: flex;
                            gap: 12px;
                            align-items: center;
                        }
                        .icon-btn {
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            width: 36px;
                            height: 36px;
                            border-radius: 50%;
                            border: none;
                            background: linear-gradient(135deg, #fd79a8 0%, #74b9ff 100%);
                            color: #fff;
                            font-size: 1.2rem;
                            transition: background 0.2s, box-shadow 0.2s;
                            box-shadow: 0 2px 8px rgba(254, 138, 139, 0.10);
                            cursor: pointer;
                            position: relative;
                        }
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
                        .modal {
                            display: none;
                            position: fixed;
                            z-index: 50;
                            left: 0;
                            top: 0;
                            width: 100%;
                            height: 100%;
                            overflow: auto;
                            background-color: rgba(0,0,0,0.4);
                            backdrop-filter: blur(2px);
                        }
                        .modal-content {
                            background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%);
                            margin: 8% auto;
                            padding: 2.5rem 2rem 2rem 2rem;
                            border-radius: 1.5rem;
                            box-shadow: 0 4px 24px 0 rgba(254, 138, 139, 0.18);
                            width: 100%;
                            max-width: 420px;
                            position: relative;
                            font-family: 'Quicksand', sans-serif;
                            border: 2px solid #fe8a8b;
                            animation: popin 0.2s;
                        }
                        @keyframes popin {
                            0% { transform: scale(0.8); opacity: 0; }
                            100% { transform: scale(1); opacity: 1; }
                        }
                        .close {
                            color: #aaa;
                            position: absolute;
                            top: 1rem;
                            right: 1rem;
                            font-size: 2rem;
                            font-weight: bold;
                            cursor: pointer;
                            transition: color 0.2s;
                        }
                        .close:hover,
                        .close:focus {
                            color: #fe8a8b;
                            text-decoration: none;
                            cursor: pointer;
                        }
                        .modal-content h2 {
                            color: #fe8a8b;
                            font-size: 1.5rem;
                            font-weight: bold;
                            margin-bottom: 1.5rem;
                            text-align: center;
                            letter-spacing: 1px;
                        }
                        .modal-content label {
                            color: #fe8a8b;
                            font-weight: 600;
                            margin-bottom: 0.3rem;
                            display: block;
                            letter-spacing: 0.5px;
                        }
                        .modal-content input[type="text"],
                        .modal-content textarea {
                            width: 100%;
                            border-radius: 0.75rem;
                            border: 1.5px solid #ffd5de;
                            background: #fff7f7;
                            padding: 0.7rem 1rem;
                            font-size: 1rem;
                            color: #55565a;
                            margin-bottom: 0.7rem;
                            font-family: 'Quicksand', sans-serif;
                            transition: border 0.2s;
                        }
                        .modal-content input[type="text"]:focus,
                        .modal-content textarea:focus {
                            border: 1.5px solid #fe8a8b;
                            outline: none;
                            background: #fff;
                        }
                        .modal-content .flex {
                            gap: 0.5rem;
                        }
                        .modal-content button[type="submit"] {
                            background: linear-gradient(90deg, #fe8a8b 0%, #ffd5de 100%);
                            color: #fff;
                            font-weight: 700;
                            border: none;
                            border-radius: 0.75rem;
                            padding: 0.6rem 1.5rem;
                            font-size: 1rem;
                            box-shadow: 0 2px 8px rgba(254, 138, 139, 0.10);
                            transition: background 0.2s, box-shadow 0.2s;
                        }
                        .modal-content button[type="submit"]:hover {
                            background: linear-gradient(90deg, #ffd5de 0%, #fe8a8b 100%);
                            color: #fe8a8b;
                        }
                        .modal-content button[type="button"] {
                            background: #ffe6e6;
                            color: #fe8a8b;
                            font-weight: 600;
                            border: none;
                            border-radius: 0.75rem;
                            padding: 0.6rem 1.2rem;
                            font-size: 1rem;
                            transition: background 0.2s, color 0.2s;
                        }
                        .modal-content button[type="button"]:hover {
                            background: #ffd5de;
                            color: #fd79a8;
                        }
                    </style>

                    <div class="overflow-x-auto">
                        <table class="pretty-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Videos Count</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td class="font-medium">{{ $category->name }}</td>
                                    <td>{{ $category->description ?? 'No description' }}</td>
                                    <td>{{ $category->videos_count ?? 0 }}</td>
                                    <td>
                                        <div class="action-icons">
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="icon-btn" title="Edit">
                                                ✏️
                                            </a>
                                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="icon-btn" title="Delete" onclick="return confirm('Are you sure?')">🗑️</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Overlay -->
                    <div id="addCategoryModal" class="modal">
                        <div class="modal-content">
                            <span class="close" id="closeAddCategoryModal">&times;</span>
                            <h2 class="text-xl font-bold mb-4" style="color: #fe8a8b; font-family: 'Quicksand', sans-serif;">Add New Category</h2>
                            <form method="POST" action="{{ route('admin.categories.store') }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-pink-400 focus:ring-pink-400" required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                                    <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-pink-400 focus:ring-pink-400">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex justify-end space-x-3">
                                    <button type="button" id="cancelAddCategoryModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">Cancel</button>
                                    <button type="submit" class="bg-pink-400 hover:bg-pink-500 text-white py-2 px-4 rounded">Create Category</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var modal = document.getElementById('addCategoryModal');
                            var openBtn = document.getElementById('openAddCategoryModal');
                            var closeBtn = document.getElementById('closeAddCategoryModal');
                            var cancelBtn = document.getElementById('cancelAddCategoryModal');
                            // Open modal
                            openBtn.onclick = function() {
                                modal.style.display = 'block';
                            };
                            // Close modal on X or Cancel
                            closeBtn.onclick = cancelBtn.onclick = function() {
                                modal.style.display = 'none';
                            };
                            // Close modal when clicking outside modal-content
                            window.onclick = function(event) {
                                if (event.target == modal) {
                                    modal.style.display = 'none';
                                }
                            };
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
