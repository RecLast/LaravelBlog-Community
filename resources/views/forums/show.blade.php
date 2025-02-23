<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('forums.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Forums
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $forum->title }}</h1>
                            <p class="text-gray-600">{{ $forum->description }}</p>
                            <div class="flex items-center mt-4 text-sm text-gray-500">
                                <span class="flex items-center mr-4">
                                    <img src="{{ $forum->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($forum->user->name) }}" 
                                         alt="{{ $forum->user->name }}" 
                                         class="w-6 h-6 rounded-full mr-2">
                                    {{ $forum->user->name }}
                                </span>
                                <span>{{ $forum->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        @auth
                            <a href="{{ route('forums.posts.create', $forum) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Reply
                            </a>
                        @endauth
                    </div>

                    <!-- Posts -->
                    <div class="space-y-6">
                        @foreach($posts as $post)
                            <div class="border-t pt-6">
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-4">
                                        <img src="{{ $post->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($post->user->name) }}" 
                                             alt="{{ $post->user->name }}" 
                                             class="w-10 h-10 rounded-full">
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <span class="font-medium text-gray-900">{{ $post->user->name }}</span>
                                                <span class="text-sm text-gray-500 ml-2">{{ $post->created_at->format('M d, Y') }}</span>
                                            </div>
                                            @if(auth()->id() === $post->user_id)
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('forums.posts.edit', [$forum, $post]) }}" class="text-blue-600 hover:text-blue-800">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('forums.posts.destroy', [$forum, $post]) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="prose max-w-none text-gray-700">
                                            {!! $post->content !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>