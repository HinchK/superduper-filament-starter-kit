<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $event->title }}</h2>
            <p class="text-gray-600 dark:text-gray-400">{{ $event->course->name }}</p>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-6 md:grid-cols-9 gap-4 mb-8">
            @for ($i = 1; $i <= $holesCount; $i++)
                <div class="flex flex-col items-center">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hole {{ $i }}</label>
                    <input 
                        type="number" 
                        wire:model.live="holeScores.{{ $i }}"
                        min="1" 
                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-center"
                    >
                </div>
            @endfor
        </div>

        <div class="flex justify-between items-center pt-6 border-t border-gray-200 dark:border-gray-700">
            <div>
                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Score:</span>
                <span class="text-2xl font-bold text-indigo-600 ml-2">{{ $this->totalScore }}</span>
            </div>
            
            <button 
                wire:click="save"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Save Scorecard
            </button>
        </div>
    </div>
</div>