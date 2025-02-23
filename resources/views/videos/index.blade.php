<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .aspect-w-16 {
            position: relative;
            padding-bottom: 56.25%;
        }
        .aspect-w-16 img {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            object-fit: cover;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Videos</h1>
                <a href="{{ route('videos.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-150 ease-in-out">
                    Share Video
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($videos as $video)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition duration-150 ease-in-out relative">
                        @if (!$video->is_approved)
                            <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-xs z-10">
                                Not Published
                            </div>
                        @endif
                        <div class="aspect-w-16 aspect-h-9 relative">
                            <img src="https://img.youtube.com/vi/{{ $video->getYoutubeVideoId() }}/maxresdefault.jpg" 
                                 alt="{{ $video->title }}" 
                                 class="object-cover w-full h-full rounded-t-lg">
                            <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 px-2 py-1 rounded text-xs text-white">
                                <i class="fas fa-eye mr-1"></i> {{ $video->views }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2 hover:text-blue-600">
                                <a href="{{ route('videos.show', $video->slug) }}">
                                    {{ $video->title }}
                                </a>
                            </h2>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $video->description }}</p>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center">
                                    <img src="{{ $video->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($video->user->name) }}" 
                                         alt="{{ $video->user->name }}" 
                                         class="w-6 h-6 rounded-full mr-2">
                                    <span class="truncate">{{ $video->user->name }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span><i class="fas fa-heart mr-1"></i>{{ $video->likes }}</span>
                                    <span>{{ $video->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $videos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>