<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header -->
                    <div class="mb-6">
                        <div class="flex items-center mb-4">
                            <a href="{{ route('admin.countries.index') }}"
                               class="mr-4 p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </a>
                            <h1 class="text-2xl font-bold" style="color: #fe8a8b; font-family: 'Quicksand', sans-serif;">
                                Add New Country
                            </h1>
                        </div>
                    </div>                    <!-- Form -->
                    <style>
                        .form-group {
                            margin-bottom: 24px;
                        }
                        .form-label {
                            display: block;
                            margin-bottom: 8px;
                            font-weight: 600;
                            color: #374151;
                        }
                        .form-input {
                            width: 100%;
                            padding: 12px 16px;
                            border: 2px solid #e5e7eb;
                            border-radius: 12px;
                            font-size: 16px;
                            transition: border-color 0.2s;
                        }
                        .form-input:focus {
                            outline: none;
                            border-color: #fe8a8b;
                            box-shadow: 0 0 0 3px rgba(254, 138, 139, 0.1);
                        }
                        .form-input.error {
                            border-color: #ef4444;
                        }
                        .error-text {
                            margin-top: 8px;
                            color: #ef4444;
                            font-size: 14px;
                        }
                        .btn {
                            padding: 12px 24px;
                            border-radius: 12px;
                            font-weight: 600;
                            text-decoration: none;
                            transition: all 0.2s;
                            cursor: pointer;
                            border: none;
                            font-size: 16px;
                        }
                        .btn-primary {
                            background: linear-gradient(90deg, #fe8a8b 0%, #fff7c2 100%);
                            color: white;
                        }
                        .btn-primary:hover {
                            transform: translateY(-1px);
                            box-shadow: 0 4px 8px rgba(254, 138, 139, 0.3);
                        }
                        .btn-secondary {
                            background: #f3f4f6;
                            color: #374151;
                        }
                        .btn-secondary:hover {
                            background: #e5e7eb;
                        }
                    </style>

                    <form action="{{ route('admin.countries.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="form-label">Country Name *</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="form-input @error('name') error @enderror"
                                   placeholder="Enter country name"
                                   required>
                            @error('name')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="code" class="form-label">Country Code *</label>
                            <input type="text"
                                   id="code"
                                   name="code"
                                   value="{{ old('code') }}"
                                   class="form-input @error('code') error @enderror"
                                   placeholder="e.g., US, PH, UK"
                                   maxlength="10"
                                   required>
                            <p style="margin-top: 4px; color: #6b7280; font-size: 14px;">Enter a unique country code (2-10 characters)</p>
                            @error('code')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div style="display: flex; gap: 16px; padding-top: 24px; border-top: 1px solid #e5e7eb;">
                            <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Create Country
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
