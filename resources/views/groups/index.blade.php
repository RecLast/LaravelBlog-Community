<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Groups</h1>
                <a href="{{ route('groups.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    Create New Group
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($groups as $group)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <img src="{{ $group->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($group->name) }}" 
                                     alt="{{ $group->name }}" 
                                     class="w-12 h-12 rounded-full mr-4">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800">
                                        <a href="{{ route('groups.show', $group) }}" class="hover:text-blue-600">
                                            {{ $group->name }}
                                        </a>
                                    </h2>
                                    <p class="text-sm text-gray-500">{{ $group->members_count }} members</p>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-4">{{ Str::limit($group->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Created {{ $group->created_at->diffForHumans() }}</span>
                                @if (!$group->members->contains(auth()->user()))
                                    <form action="{{ route('groups.join', $group) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:text-blue-800">
                                            Join Group
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-center text-gray-500">
                                No groups found. Be the first to create one!
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($groups->hasPages())
                <div class="mt-6">
                    {{ $groups->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>