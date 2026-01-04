<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Recent Results</h3>

    @if($latestEvent)
        <div class="mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $latestEvent->title }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $latestEvent->start->format('M j, Y') }}</p>
        </div>

        <ul class="space-y-3">
            @foreach($topScores as $score)
                <li class="flex justify-between items-center text-sm">
                    <span class="text-gray-600 dark:text-gray-400">
                        <span class="font-bold mr-2">{{ $score->rank_display }}</span>
                        {{ $score->user->firstname }} {{ $score->user->lastname }}
                    </span>
                    <span class="font-semibold {{ $score->to_par <= 0 ? 'text-red-600 dark:text-red-400' : 'text-gray-900 dark:text-gray-100' }}">
                        {{ $score->to_par > 0 ? '+' . $score->to_par : ($score->to_par == 0 ? 'E' : $score->to_par) }}
                    </span>
                </li>
            @endforeach
        </ul>

        <div class="mt-6">
            <a href="{{ route('event.details', $latestEvent) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                View Full Leaderboard &rarr;
            </a>
        </div>
    @else
        <p class="text-sm text-gray-500 dark:text-gray-400 italic">No completed events yet.</p>
    @endif
</div>