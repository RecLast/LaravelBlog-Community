<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Your Points & Achievements</h2>
                    
                    <!-- Total Points -->
                    <div class="mb-8 p-4 bg-blue-50 rounded-lg">
                        <h3 class="text-xl font-semibold mb-2">Total Points</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $totalPoints }}</p>
                    </div>

                    <!-- Achievements -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4">Your Achievements</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($achievements as $achievement)
                                <div class="p-4 border rounded-lg">
                                    @if($achievement->badge_image)
                                        <img src="{{ asset('storage/' . $achievement->badge_image) }}" 
                                             alt="{{ $achievement->name }}" 
                                             class="w-16 h-16 mb-2">
                                    @endif
                                    <h4 class="font-semibold">{{ $achievement->name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $achievement->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Next Achievements -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4">Next Achievements</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($nextAchievements as $achievement)
                                <div class="p-4 border rounded-lg bg-gray-50">
                                    <h4 class="font-semibold">{{ $achievement->name }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ $achievement->description }}</p>
                                    <p class="text-sm">Points needed: 
                                        <span class="font-semibold">{{ $achievement->points_required - $totalPoints }}</span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Points History -->
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Points History</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($points as $point)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $point->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium
                                                {{ $point->points > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $point->points > 0 ? '+' : '' }}{{ $point->points }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $point->description }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $points->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>