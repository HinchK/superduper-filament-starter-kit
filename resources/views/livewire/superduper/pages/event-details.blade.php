<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $event->title }}</h1>

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

        <livewire:super-duper.components.event-leaderboard :event="$event" />

        <div class="mt-8">
            <a href="{{ route('calendar') }}" class="text-primary-600 hover:text-primary-700 font-medium">
                &larr; Back to Calendar
            </a>
        </div>
    </div>
</div>