<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $event->title }}</h1>

        @if($event->winner)
            <div
                class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-400 text-yellow-800 dark:text-yellow-200 rounded flex items-center">
                <div class="mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.699-3.181A1 1 0 0118 2.75V13a1 1 0 01-.553.894l-4.553 2.277V19a1 1 0 11-2 0v-3H9v3a1 1 0 11-2 0v-2.829l-4.553-2.277A1 1 0 012 13V2.75a1 1 0 011.347-.946L5 4.323V3a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-lg">Winner</h4>
                    <p class="text-lg">{{ $event->winner->firstname }} {{ $event->winner->lastname }}</p>
                </div>
            </div>
        @endif

        <div class="mb-4 text-gray-600 dark:text-gray-400">
            @if($event->allDay)
                <p><span class="font-semibold">Date:</span> {{ $event->start->format('F j, Y') }} (All Day)</p>
            @else
                <p><span class="font-semibold">Start:</span> {{ $event->start->format('F j, Y g:i A') }}</p>
                @if($event->end)
                    <p><span class="font-semibold">End:</span> {{ $event->end->format('F j, Y g:i A') }}</p>
                @endif
            @endif
        </div>

        @if($event->description)
            <div class="prose dark:prose-invert max-w-none">
                {{ $event->description }}
            </div>
        @endif

        <livewire:superduper.components.event-leaderboard :event="$event" />

        <div class="mt-8 flex justify-between items-center">
            <a href="{{ route('calendar') }}" class="text-primary-600 hover:text-primary-700 font-medium">
                &larr; Back to Calendar
            </a>

            @auth
                <a href="{{ route('event.score', $event) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Enter Score
                </a>
            @endauth
        </div>
    </div>
</div>