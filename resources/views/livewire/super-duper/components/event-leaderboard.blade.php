<div class="mt-8">
    @if($event->result_notes)
        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/30 border-l-4 border-blue-400 text-blue-700 dark:text-blue-300 rounded">
            <h4 class="font-bold mb-1">Final Result Notes</h4>
            <p>{{ $event->result_notes }}</p>
        </div>
    @endif

    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100 sm:pl-6">Rank</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Player</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">To Par</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                @forelse($scores as $score)
                    <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-gray-100 sm:pl-6">
                            {{ $score->rank_display }}
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $score->user->firstname }} {{ $score->user->lastname }}
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold {{ $score->to_par <= 0 ? 'text-red-600 dark:text-red-400' : 'text-gray-900 dark:text-gray-100' }}">
                            {{ $score->to_par > 0 ? '+' . $score->to_par : ($score->to_par == 0 ? 'E' : $score->to_par) }}
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $score->total_score }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                            No scores recorded for this event yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>