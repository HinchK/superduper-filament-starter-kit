<div class="max-w-4xl mx-auto py-8">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $event->title }}</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">Scorecard</p>
        </div>
        <div class="text-right">
            @if($event->course)
                <p class="text-sm font-medium text-gray-500">{{ $event->course->name }}</p>
            @endif
            <p class="text-xs text-gray-400">{{ $event->start->format('M j, Y') }}</p>
        </div>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Front 9 --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <div class="bg-emerald-800 px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-white">Front 9</h3>
                </div>
                <div class="p-4 space-y-3">
                    @for ($i = 1; $i <= 9; $i++)
                        <div class="flex items-center justify-between">
                            <label for="hole_{{ $i }}"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 w-12">
                                {{ $i }}
                            </label>
                            <div class="flex-1 ml-4">
                                <input type="number" id="hole_{{ $i }}" wire:model="holeScores.{{ $i }}" min="1" max="15"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm dark:bg-gray-900 dark:border-gray-700 dark:text-white text-center"
                                    placeholder="-">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            {{-- Back 9 --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <div class="bg-emerald-800 px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-white">Back 9</h3>
                </div>
                <div class="p-4 space-y-3">
                    @for ($i = 10; $i <= 18; $i++)
                        <div class="flex items-center justify-between">
                            <label for="hole_{{ $i }}"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 w-12">
                                {{ $i }}
                            </label>
                            <div class="flex-1 ml-4">
                                <input type="number" id="hole_{{ $i }}" wire:model="holeScores.{{ $i }}" min="1" max="15"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm dark:bg-gray-900 dark:border-gray-700 dark:text-white text-center"
                                    placeholder="-">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        {{-- Summary & Actions --}}
        <div
            class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex flex-col sm:flex-row items-center justify-between">
            <div class="mb-4 sm:mb-0">
                <span class="text-gray-600 dark:text-gray-400 text-lg">Total Score:</span>
                <span class="ml-2 text-4xl font-bold text-emerald-600">{{ $this->totalScore }}</span>
                @if($event->course && $event->course->par)
                    <span class="ml-2 text-sm text-gray-500">
                        ({{ $this->totalScore - $event->course->par > 0 ? '+' : '' }}{{ $this->totalScore - $event->course->par }}
                        to Par)
                    </span>
                @endif
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('event.details', $event) }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    Save Scorecard
                </button>
            </div>
        </div>
    </form>
</div>