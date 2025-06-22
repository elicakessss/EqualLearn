<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Creator Dashboard</h1>
                    <p>Welcome to your creator dashboard. Here you can manage your videos and upload new content.</p>

                    <div class="mt-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold">Your Videos</h2>
                            <a href="{{ route('videos.create') }}" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                                Upload New Video
                            </a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Video placeholders -->
                            @for ($i = 1; $i <= 3; $i++)
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <div class="bg-gray-300 h-32 rounded-md mb-2"></div>
                                <h3 class="font-medium">My Video {{ $i }}</h3>
                                <div class="flex justify-between mt-2 text-sm">
                                    <span class="text-gray-600">Views: 125</span>
                                    <span class="text-yellow-600">Pending approval</span>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
