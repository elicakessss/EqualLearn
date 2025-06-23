<x-app-layout>
    <div class="flex h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <div class="flex-1 overflow-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <a href="{{ route('admin.categories.index') }}"
                           class="mr-4 p-2 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-pink-400 to-yellow-300 bg-clip-text text-transparent">
                                Add New Category
                            </h1>
                            <p class="text-gray-600 mt-2">Create a new video category</p>
                        </div>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="max-w-2xl">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-pink-100">
                        <div class="bg-gradient-to-r from-pink-400 to-yellow-300 px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">Category Details</h2>
                        </div>
                        <form method="POST" action="{{ route('admin.categories.store') }}" class="p-6">
                            @csrf
                            <!-- Category Name -->
                            <div class="mb-6">
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Category Name *
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-4 focus:ring-pink-100 focus:border-pink-400 transition-all duration-200 @error('name') border-red-500 @enderror"
                                       placeholder="Enter category name"
                                       required>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Description -->
                            <div class="mb-6">
                                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Description (Optional)
                                </label>
                                <textarea name="description" id="description" rows="3"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-4 focus:ring-pink-100 focus:border-pink-400 transition-all duration-200 @error('description') border-red-500 @enderror"
                                          placeholder="Describe this category (optional)">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Action Buttons -->
                            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                                <a href="{{ route('admin.categories.index') }}"
                                   class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors duration-200">
                                    Cancel
                                </a>
                                <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-pink-400 to-yellow-300 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
                                    Create Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
