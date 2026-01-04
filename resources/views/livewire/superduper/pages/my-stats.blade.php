<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">My Statistics</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg text-center">
                <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Events Played</span>
                <span class="block text-3xl font-bold text-indigo-600">{{ $stats['events_played'] }}</span>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg text-center">
                <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Average Score</span>
                <span class="block text-3xl font-bold text-indigo-600">{{ $stats['avg_score'] }}</span>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg text-center">
                <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Best Score</span>
                <span class="block text-3xl font-bold text-green-600">{{ $stats['best_score'] }}</span>
            </div>
        </div>

        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Event History</h2>
        
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100 sm:pl-6">Date</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Event</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Course</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Score</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">To Par</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                    @forelse($scores as $score)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 dark:text-gray-400 sm:pl-6">
                                {{ $score->event->start->format('M j, Y') }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $score->event->title }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                {{ $score->event->course->name ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">
                                {{ $score->total_score }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold {{ $score->to_par <= 0 ? 'text-red-600 dark:text-red-400' : 'text-gray-900 dark:text-gray-100' }}">
                                {{ $score->to_par > 0 ? '+' . $score->to_par : ($score->to_par == 0 ? 'E' : $score->to_par) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                                No events played yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>