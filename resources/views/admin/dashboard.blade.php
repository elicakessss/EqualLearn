<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
                    <p>Welcome to the admin dashboard. Here you can manage users, categories, and view system logs.</p>

                    <div class="mt-6">
                        <h2 class="text-xl font-semibold mb-4">Admin Functions</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="block p-6 bg-gray-100 rounded-lg">
                                <h3 class="font-bold text-lg mb-2">User Management</h3>
                                <p>View all users, change roles (student, creator, admin), and manage permissions.</p>
                            </div>

                            <div class="block p-6 bg-gray-100 rounded-lg">
                                <h3 class="font-bold text-lg mb-2">Category Management</h3>
                                <p>Create, edit, and delete video categories. Categories are used by creators when uploading videos and appear in the sidebar for all users.</p>
                            </div>

                            <div class="block p-6 bg-gray-100 rounded-lg">
                                <h3 class="font-bold text-lg mb-2">System Logs</h3>
                                <p>Track actions performed in the system for auditing and troubleshooting.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
