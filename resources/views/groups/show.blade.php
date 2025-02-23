<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('groups.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Groups
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center">
                            <img src="{{ $group->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($group->name) }}" 
                                 alt="{{ $group->name }}" 
                                 class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">{{ $group->name }}</h1>
                                <p class="text-gray-600 mt-1">{{ $group->description }}</p>
                                <div class="flex items-center mt-2 text-sm text-gray-500">
                                    <span class="mr-4">{{ $group->members_count }} members</span>
                                    <span>Created {{ $group->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                        @if (!$group->members->contains(auth()->user()))
                            <form action="{{ route('groups.join', $group) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                    Join Group
                                </button>
                            </form>
                        @else
                            <form action="{{ route('groups.leave', $group) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                                    Leave Group
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Members</h2>
                    <div class="space-y-4">
                        @php
                            $owner = $group->members->firstWhere('id', $group->user_id);
                            $otherMembers = $group->members->filter(function($member) use ($group) {
                                return $member->id !== $group->user_id;
                            });
                        @endphp

                        @if($owner)
                            <div class="flex items-center justify-between bg-purple-50 p-3 rounded-lg">
                                <div class="flex items-center">
                                    <img src="{{ $owner->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($owner->name) }}" 
                                         alt="{{ $owner->name }}" 
                                         class="w-10 h-10 rounded-full mr-3 border-2 border-purple-500">
                                    <div>
                                        <span class="text-gray-800 font-medium">{{ $owner->name }}</span>
                                        <div class="text-sm text-purple-600">Group Master</div>
                                    </div>
                                </div>
                                <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Master</span>
                            </div>
                        @endif

                        @foreach ($otherMembers as $member)
                            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                                <div class="flex items-center">
                                    <img src="{{ $member->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($member->name) }}" 
                                         alt="{{ $member->name }}" 
                                         class="w-8 h-8 rounded-full mr-3">
                                    <span class="text-gray-800">{{ $member->name }}</span>
                                </div>
                                <span class="text-sm text-gray-500">Member</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>