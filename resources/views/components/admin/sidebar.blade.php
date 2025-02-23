<aside class="bg-gray-800 text-white w-64 min-h-screen px-4 py-6">
    <nav>
        <div class="space-y-4">
            <!-- Dashboard -->
            <div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- Content Management -->
            <div class="space-y-2">
                <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase">Content Management</h3>
                
                <!-- Blogs -->
                <a href="{{ route('admin.blogs.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.blogs.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"></path>
                    </svg>
                    <span>Blogs</span>
                </a>

                <!-- Forums -->
                <a href="{{ route('admin.forums.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.forums.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                    </svg>
                    <span>Forums</span>
                </a>

                <!-- Videos -->
                <a href="{{ route('admin.videos.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.videos.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <span>Videos</span>
                </a>

                <!-- Groups -->
                <a href="{{ route('admin.groups.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.groups.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Groups</span>
                </a>
            </div>

            <!-- Site Configuration -->
            <div class="space-y-2">
                <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase">Site Configuration</h3>
                
                <!-- Categories -->
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span>Categories</span>
                </a>

                <!-- Comments -->
                <a href="{{ route('admin.comments.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.comments.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    <span>Comments</span>
                </a>

                <!-- Achievements -->
                <a href="{{ route('admin.achievements.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.achievements.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    <span>Achievements</span>
                </a>
            </div>

            <!-- User Management -->
            <div class="space-y-2">
                <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase">User Management</h3>
                
                <!-- Users -->
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Users</span>
                </a>

                <!-- Roles -->
                <a href="{{ route('admin.roles.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.roles.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    <span>Roles</span>
                </a>
            </div>

            <!-- System Settings -->
            <div class="space-y-2">
                <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase">System</h3>
                
                <!-- Site Settings -->
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Site Settings</span>
                </a>
            </div>
        </div>
    </nav>
</aside>