<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Student Dashboard</h1>
                    <p>Welcome to your student dashboard. Here you can explore videos and learning materials.</p>

                    <div class="mt-6">
                        <h2 class="text-xl font-semibold mb-2">Recent Videos</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Video placeholders -->
                            @for ($i = 1; $i <= 3; $i++)
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <div class="bg-gray-300 h-32 rounded-md mb-2"></div>
                                <h3 class="font-medium">Sample Video {{ $i }}</h3>
                                <p class="text-sm text-gray-600">Learn about interesting topics</p>
                            </div>
                            @endfor
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Browse all videos →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
