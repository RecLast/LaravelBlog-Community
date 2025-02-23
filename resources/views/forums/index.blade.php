<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Forums</h2>
                @auth
                    <a href="{{ route('forums.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-150 ease-in-out transform hover:scale-105">
                        Create New Topic
                    </a>
                @endauth
            </div>

            <!-- Categories -->
            @foreach($categories as $category)
                <div class="mb-8">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4 rounded-t-lg">
                        <h3 class="text-lg font-semibold text-white">{{ $category->name }}</h3>
                    </div>
                    <div class="bg-white shadow-lg rounded-b-lg divide-y divide-gray-100">
                        @foreach($category->forums as $forum)
                            <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="flex justify-between items-start gap-4">
                                    <div class="flex-1">
                                        <h3 class="mb-3">
                                            <a href="{{ route('forums.show', $forum) }}" class="text-xl font-semibold text-blue-600 hover:text-blue-800 hover:underline transition duration-150 ease-in-out">
                                                {{ $forum->name }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 mb-4">{{ $forum->description }}</p>
                                        <div class="flex items-center space-x-6 text-sm text-gray-500">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                                </svg>
                                                {{ $forum->posts_count ?? 0 }} posts
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $forum->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end space-y-2">
                                        <div class="flex items-center space-x-3">
                                            <div class="text-right">
                                                <span class="text-sm font-medium text-gray-900">{{ $forum->user->name }}</span>
                                            </div>
                                            <img src="{{ $forum->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($forum->user->name) }}" 
                                                 alt="{{ $forum->user->name }}" 
                                                 class="w-10 h-10 rounded-full border-2 border-blue-100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>