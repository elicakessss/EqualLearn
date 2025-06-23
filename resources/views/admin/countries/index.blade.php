<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">                    <!-- Header -->
                    <div class="admin-header-container">
                        <div class="admin-header-content">
                            <h1>Country Management</h1>
                            <p>Manage countries for the platform</p>
                        </div>                        <div class="admin-header-button">
                            <button onclick="openCountryModal()"
                               class="icon-btn" title="Add Country">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
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
                    @endif                    <!-- Countries Table -->
                    <style>
                        /* Header alignment fix with stronger specificity */
                        .admin-header-container {
                            display: flex !important;
                            align-items: center !important;
                            justify-content: space-between !important;
                            margin-bottom: 2rem !important;
                            width: 100% !important;
                        }

                        .admin-header-content {
                            flex: 1 !important;
                            margin-right: 1.5rem !important;
                        }

                        .admin-header-content h1 {
                            font-family: 'Quicksand', sans-serif !important;
                            font-size: 1.8rem !important;
                            font-weight: 700 !important;
                            color: #55565a !important;
                            margin-bottom: 0.5rem !important;
                            line-height: 1.2 !important;
                            margin-top: 0 !important;
                        }

                        .admin-header-content p {
                            color: #8a95a9 !important;
                            font-size: 1.1rem !important;
                            margin: 0 !important;
                            line-height: 1.4 !important;
                        }

                        .admin-header-button {
                            flex-shrink: 0 !important;
                            align-self: center !important;
                        }

                        .icon-btn {
                            background: linear-gradient(90deg, #fe8a8b 0%, #fff7c2 100%);
                            padding: 12px;
                            border-radius: 50%;
                            border: none;
                            color: white;
                            font-size: 16px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            text-decoration: none;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            width: 48px;
                            height: 48px;
                            box-shadow: 0 4px 6px rgba(254, 138, 139, 0.3);
                        }
                        .icon-btn:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 6px 12px rgba(254, 138, 139, 0.4);
                        }
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
                        .country-avatar {
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
                        .country-code-badge {
                            background: #fff7c2;
                            color: #fe8a8b;
                            padding: 4px 8px;
                            border-radius: 8px;
                            font-size: 12px;
                            font-weight: 600;
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
                        .action-btn.edit {
                            background: #3b82f6;
                            color: white;
                        }
                        .action-btn.delete {
                            background: #ef4444;
                            color: white;
                        }
                        .action-btn:hover {
                            transform: translateY(-1px);
                            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
                        }
                    </style>

                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>Code</th>
                                <th>Videos</th>
                                <th>Created</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($countries as $country)
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center;">
                                            <div class="country-avatar">
                                                {{ strtoupper(substr($country->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div style="font-weight: 600; color: #374151;">{{ $country->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="country-code-badge">{{ $country->code }}</span>
                                    </td>
                                    <td>
                                        <span style="color: #6b7280;">{{ $country->videos()->count() }} videos</span>
                                    </td>
                                    <td>
                                        <span style="color: #6b7280;">{{ $country->created_at->format('M d, Y') }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('admin.countries.edit', $country) }}"
                                           class="action-btn edit" title="Edit Country">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.countries.destroy', $country) }}"
                                              method="POST"
                                              style="display: inline;"
                                              onsubmit="return confirm('Are you sure you want to delete this country? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="action-btn delete"
                                                    title="Delete Country">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px; color: #6b7280;">
                                        <div style="font-size: 48px; margin-bottom: 16px;">🌍</div>
                                        <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 8px;">No Countries Found</h3>
                                        <p style="margin-bottom: 16px;">Get started by creating your first country.</p>
                                        <a href="{{ route('admin.countries.create') }}"
                                           style="background: linear-gradient(90deg, #fe8a8b 0%, #fff7c2 100%); color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                            Add Country
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if($countries->hasPages())
                        <div style="margin-top: 24px;">
                            {{ $countries->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Country Modal -->
    <div id="countryModal" class="modal-overlay" onclick="closeCountryModal()">
        <div class="modal-container" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 class="modal-title">Add New Country</h2>
                <button onclick="closeCountryModal()" class="modal-close">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="countryForm" method="POST" action="{{ route('admin.countries.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="modal_country_name" class="form-label">Country Name *</label>
                        <input type="text"
                               id="modal_country_name"
                               name="name"
                               class="form-input"
                               placeholder="Enter country name"
                               required>
                        <div class="error-message" id="name_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="modal_country_code" class="form-label">Country Code *</label>
                        <input type="text"
                               id="modal_country_code"
                               name="code"
                               class="form-input"
                               placeholder="e.g., US, PH, CA"
                               maxlength="3"
                               style="text-transform: uppercase;"
                               required>
                        <div class="error-message" id="code_error"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="closeCountryModal()" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">Create Country</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .modal-overlay.show {
            display: flex;
            opacity: 1;
        }

        .modal-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(254, 138, 139, 0.15);
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow: hidden;
            transform: scale(0.9) translateY(20px);
            transition: all 0.3s ease;
            border: 2px solid rgba(254, 138, 139, 0.1);
        }

        .modal-overlay.show .modal-container {
            transform: scale(1) translateY(0);
        }

        .modal-header {
            background: linear-gradient(135deg, #fe8a8b 0%, #fff7c2 100%);
            padding: 20px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .modal-body {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            color: #55565a;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e3e7f0;
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Nunito', sans-serif;
            color: #55565a;
            background: #f8f9fc;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: #fe8a8b;
            background: white;
            box-shadow: 0 0 0 3px rgba(254, 138, 139, 0.1);
        }

        .form-input.error {
            border-color: #fe8a8b;
            background: #fff5f5;
        }

        .error-message {
            margin-top: 6px;
            color: #fe8a8b;
            font-size: 12px;
            font-weight: 500;
            display: none;
        }

        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #f0f2f7;
        }

        .btn-primary, .btn-secondary {
            padding: 12px 24px;
            border-radius: 10px;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            outline: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #fe8a8b 0%, #ff7b7c 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(254, 138, 139, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(254, 138, 139, 0.35);
        }

        .btn-secondary {
            background: #f8f9fc;
            color: #8a95a9;
            border: 1px solid #e3e7f0;
        }

        .btn-secondary:hover {
            background: #f0f2f7;
            color: #55565a;
        }
    </style>

    <script>
        function openCountryModal() {
            document.getElementById('countryModal').classList.add('show');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                document.getElementById('modal_country_name').focus();
            }, 300);
        }

        function closeCountryModal() {
            document.getElementById('countryModal').classList.remove('show');
            document.body.style.overflow = 'auto';
            // Reset form
            document.getElementById('countryForm').reset();
            // Clear errors
            document.querySelectorAll('.error-message').forEach(el => {
                el.style.display = 'none';
                el.textContent = '';
            });
            document.querySelectorAll('.form-input').forEach(el => {
                el.classList.remove('error');
            });
        }

        // Auto-uppercase country code
        document.getElementById('modal_country_code').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCountryModal();
            }
        });

        // Handle form submission
        document.getElementById('countryForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => {
                el.style.display = 'none';
                el.textContent = '';
            });
            document.querySelectorAll('.form-input').forEach(el => {
                el.classList.remove('error');
            });

            // Submit form via fetch
            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeCountryModal();
                    // Reload page to show new country
                    window.location.reload();
                } else if (data.errors) {
                    // Show validation errors
                    Object.keys(data.errors).forEach(field => {
                        const errorEl = document.getElementById(field + '_error');
                        const inputEl = document.getElementById('modal_country_' + field);
                        if (errorEl && inputEl) {
                            errorEl.textContent = data.errors[field][0];
                            errorEl.style.display = 'block';
                            inputEl.classList.add('error');
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    </script>
</x-app-layout>
