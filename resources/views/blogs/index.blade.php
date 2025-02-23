<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Blog Posts</h2>
                @auth
                    <a href="{{ route('blogs.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        Create New Post
                    </a>
                @endauth
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @if ($blog->featured_image)
                            <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-sm text-gray-500">{{ $blog->category->name }}</span>
                                <span class="text-sm text-gray-500">{{ $blog->published_at ? $blog->published_at->diffForHumans() : 'Not published' }}</span>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">
                                <a href="{{ route('blogs.show', $blog) }}" class="text-gray-800 hover:text-blue-500">
                                    {{ $blog->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($blog->content), 150) }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        {{ $blog->views }}
                                    </span>
                                    <span class="flex items-center text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        {{ $blog->likes }}
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <img src="{{ $blog->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($blog->user->name) }}" alt="{{ $blog->user->name }}" class="w-6 h-6 rounded-full mr-2">
                                    <span class="text-sm text-gray-600">{{ $blog->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>