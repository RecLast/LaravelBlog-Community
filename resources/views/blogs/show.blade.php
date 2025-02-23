<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($blog->featured_image)
                    <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-96 object-cover">
                @endif
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ $blog->category->name }}</span>
                            <span class="text-sm text-gray-500">{{ $blog->published_at ? $blog->published_at->format('F j, Y') : 'Not published' }}</span>
                        </div>
                        @if (Auth::id() === $blog->user_id)
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('blogs.edit', $blog) }}" class="text-blue-500 hover:text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600" onclick="return confirm('Are you sure you want to delete this post?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $blog->title }}</h1>
                    
                    <div class="prose max-w-none mb-6">
                        {!! $blog->content !!}
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                        <div class="flex items-center space-x-4">
                            <span class="flex items-center text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ $blog->views }}
                            </span>
                            <button class="flex items-center text-gray-500 hover:text-red-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                {{ $blog->likes }}
                            </button>
                        </div>
                        <div class="flex items-center">
                            <img src="{{ $blog->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($blog->user->name) }}" alt="{{ $blog->user->name }}" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-gray-600">{{ $blog->user->name }}</span>
                        </div>
                    </div>

                    @if ($blog->tags->count() > 0)
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($blog->tags as $tag)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Comments Section -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Comments</h2>
                
                @auth
                    <form action="{{ route('blogs.comments.store', $blog) }}" method="POST" class="mb-8">
                        @csrf
                        <div class="mb-4">
                            <textarea name="content" rows="3" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md" placeholder="Write a comment..."></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Post Comment
                            </button>
                        </div>
                    </form>
                @else
                    <div class="bg-gray-50 rounded-lg p-4 mb-8">
                        <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500">log in</a> to post a comment.</p>
                    </div>
                @endauth

                <div class="space-y-6">
                    @foreach ($blog->comments as $comment)
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-start space-x-3">
                                <img src="{{ $comment->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($comment->user->name) }}" alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-medium text-gray-900">{{ $comment->user->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-700">
                                        <p>{{ $comment->content }}</p>
                                    </div>
                                    <div class="mt-2 flex items-center space-x-4">
                                        <button class="text-sm text-gray-500 hover:text-gray-700">
                                            Reply
                                        </button>
                                        <span class="text-gray-500">·</span>
                                        <button class="flex items-center text-sm text-gray-500 hover:text-red-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                            {{ $comment->likes }}
                                        </button>
                                    </div>

                                    @if ($comment->replies->count() > 0)
                                        <div class="mt-4 space-y-4 pl-6 border-l-2 border-gray-200">
                                            @foreach ($comment->replies as $reply)
                                                <div class="flex items-start space-x-3">
                                                    <img src="{{ $reply->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($reply->user->name) }}" alt="{{ $reply->user->name }}" class="w-8 h-8 rounded-full">
                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex items-center justify-between">
                                                            <h4 class="text-sm font-medium text-gray-900">{{ $reply->user->name }}</h4>
                                                            <p class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                                        </div>
                                                        <div class="mt-1 text-sm text-gray-700">
                                                            <p>{{ $reply->content }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>