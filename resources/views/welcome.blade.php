<x-app-layout>
    <div class="bg-gray-900 min-h-screen w-full flex flex-col">
        <!-- Hero Section with Animated Background -->
        <div class="relative isolate px-6 pt-14 lg:px-8">
            <div class="absolute inset-x-0 -top-40 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-blue-600 to-purple-800 opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
            </div>

            <div class="mx-auto max-w-2xl py-32">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Welcome to Our Community Platform</h1>
                    <p class="mt-6 text-lg leading-8 text-gray-300">Join our vibrant community to discuss, share, and learn together.</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        @auth
                            <a href="{{ route('dashboard') }}" class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Get Started</a>
                            <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-gray-300 hover:text-white">Register <span aria-hidden="true">→</span></a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section with Hover Effects -->
        <div class="py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:text-center">
                    <h2 class="text-base font-semibold leading-7 text-blue-400">Everything you need</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">Explore Our Features</p>
                </div>
                <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                    <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                        <!-- Forums Feature Card -->
                        <div class="flex flex-col transition duration-300 transform hover:scale-105 bg-gray-800 rounded-xl p-6 ring-1 ring-white/10">
                            <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-white">
                                <svg class="h-5 w-5 flex-none text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                </svg>
                                Forums
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-300">
                                <p class="flex-auto">Join discussions, share your thoughts, and connect with other members in our community forums.</p>
                                <p class="mt-6">
                                    <a href="{{ route('forums.index') }}" class="text-sm font-semibold leading-6 text-blue-400 hover:text-blue-300">Browse Forums <span aria-hidden="true">→</span></a>
                                </p>
                            </dd>
                        </div>
                        <!-- Blogs Feature Card -->
                        <div class="flex flex-col transition duration-300 transform hover:scale-105 bg-gray-800 rounded-xl p-6 ring-1 ring-white/10">
                            <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-white">
                                <svg class="h-5 w-5 flex-none text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                                Blogs
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-300">
                                <p class="flex-auto">Read and write blog posts about various topics, share your knowledge and experiences.</p>
                                <p class="mt-6">
                                    <a href="{{ route('blogs.index') }}" class="text-sm font-semibold leading-6 text-blue-400 hover:text-blue-300">Read Blogs <span aria-hidden="true">→</span></a>
                                </p>
                            </dd>
                        </div>
                        <!-- Videos Feature Card -->
                        <div class="flex flex-col transition duration-300 transform hover:scale-105 bg-gray-800 rounded-xl p-6 ring-1 ring-white/10">
                            <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-white">
                                <svg class="h-5 w-5 flex-none text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                                </svg>
                                Videos
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-300">
                                <p class="flex-auto">Watch and share educational videos, tutorials, and other interesting content.</p>
                                <p class="mt-6">
                                    <a href="{{ route('videos.index') }}" class="text-sm font-semibold leading-6 text-blue-400 hover:text-blue-300">Watch Videos <span aria-hidden="true">→</span></a>
                                </p>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
