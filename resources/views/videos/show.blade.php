<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('videos.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Videos
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-5xl mx-auto p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $video->title }}</h1>
                    
                    <div class="relative w-full" style="padding-bottom: 56.25%">
                        <iframe
                            src="{{ $video->getEmbedUrl() }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            class="absolute top-0 left-0 w-full h-full rounded-lg shadow-lg"
                        ></iframe>
                    </div>

                    <div class="flex items-center justify-between mb-6 border-b pb-4">
                        <div class="flex items-center">
                            <img src="{{ $video->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($video->user->name) }}" 
                                 alt="{{ $video->user->name }}" 
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium text-gray-800">{{ $video->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $video->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-6">
                            <button class="flex items-center text-gray-500 hover:text-red-500 transition duration-150">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="text-lg">{{ $video->likes }}</span>
                            </button>
                            <div class="flex items-center text-gray-500">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span class="text-lg">{{ $video->views }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="prose max-w-none mb-8">
                        <p class="text-gray-700 text-lg leading-relaxed">{{ $video->description }}</p>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Comments</h3>
                        
                        <form action="{{ route('videos.comments.store', $video) }}" method="POST" class="mb-8">
                            @csrf
                            <div class="mb-4">
                                <textarea
                                    name="content"
                                    rows="3"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150"
                                    placeholder="Add a comment..."
                                    required
                                >{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-150">
                                    Post Comment
                                </button>
                            </div>
                        </form>

                        <div class="space-y-6">
                            @foreach($video->comments as $comment)
                                <div class="flex space-x-4">
                                    <img src="{{ $comment->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($comment->user->name) }}" 
                                         alt="{{ $comment->user->name }}" 
                                         class="w-12 h-12 rounded-full">
                                    <div class="flex-1">
                                        <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition duration-150">
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="font-medium text-gray-800">{{ $comment->user->name }}</div>
                                                <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-700">{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>