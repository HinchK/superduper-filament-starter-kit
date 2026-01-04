<div class="max-w-full mx-auto pb-24 px-2 sm:px-6 lg:px-8" x-data="{
    holePars: @js($event->course->hole_pars ?? []),
    holeScores: @entangle('holeScores'),
    
    getPar(hole) {
        return parseInt(this.holePars[hole]) || 4; 
    },
    
    getOutTotal() {
        let sum = 0;
        for(let i=1; i<=9; i++) sum += (parseInt(this.holeScores[i]) || 0);
        return sum;
    },
    
    getInTotal() {
        let sum = 0;
        for(let i=10; i<=18; i++) sum += (parseInt(this.holeScores[i]) || 0);
        return sum;
    },

    getTotal() {
        return this.getOutTotal() + this.getInTotal();
    },

    getOutParTotal() {
        let sum = 0;
        for(let i=1; i<=9; i++) sum += this.getPar(i);
        return sum;
    },

    getInParTotal() {
        let sum = 0;
        for(let i=10; i<=18; i++) sum += this.getPar(i);
        return sum;
    },

    getTotalPar() {
        return this.getOutParTotal() + this.getInParTotal();
    }
}">
    {{-- Header Info --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $event->title }}</h1>
        <p class="text-sm text-gray-500">{{ $event->course->name ?? 'Unknown Course' }}</p>
    </div>

    {{-- Scorecard Grid --}}
    <form wire:submit="save">
        <div class="overflow-x-auto shadow-md sm:rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden">
                    <table
                        class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-center font-mono text-sm leading-tight">
                        {{-- Hole Numbers Header --}}
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th scope="col"
                                    class="sticky left-0 z-10 bg-gray-900 px-3 py-3 text-left text-xs font-bold uppercase tracking-wider w-24 border-r border-gray-600">
                                    Hole
                                </th>
                                @for($i = 1; $i <= 9; $i++)
                                    <th scope="col" class="px-2 py-3 w-12 border-r border-gray-700">{{ $i }}</th>
                                @endfor
                                <th scope="col"
                                    class="px-2 py-3 w-16 font-bold bg-gray-900 border-r border-gray-700 text-yellow-500">
                                    OUT</th>

                                @for($i = 10; $i <= 18; $i++)
                                    <th scope="col" class="px-2 py-3 w-12 border-r border-gray-700">{{ $i }}</th>
                                @endfor
                                <th scope="col"
                                    class="px-2 py-3 w-16 font-bold bg-gray-900 border-r border-gray-700 text-yellow-500">
                                    IN</th>
                                <th scope="col" class="px-2 py-3 w-20 font-bold bg-black text-yellow-500">TOT</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            {{-- Par Row --}}
                            <tr class="bg-emerald-100 dark:bg-emerald-900/30">
                                <td
                                    class="sticky left-0 z-10 bg-emerald-100 dark:bg-emerald-900/40 px-3 py-2 text-left text-xs font-bold text-emerald-800 dark:text-emerald-300 uppercase w-24 border-r border-emerald-200 dark:border-emerald-700">
                                    Par
                                </td>
                                @for($i = 1; $i <= 9; $i++)
                                    <td class="px-2 py-2 border-r border-emerald-200 dark:border-emerald-700 font-semibold text-emerald-700 dark:text-emerald-400"
                                        x-text="getPar({{ $i }})">
                                        4
                                    </td>
                                @endfor
                                <td class="px-2 py-2 font-bold bg-emerald-200 dark:bg-emerald-900/50 border-r border-emerald-300 dark:border-emerald-600 text-emerald-900 dark:text-emerald-200"
                                    x-text="getOutParTotal()">
                                    36
                                </td>

                                @for($i = 10; $i <= 18; $i++)
                                    <td class="px-2 py-2 border-r border-emerald-200 dark:border-emerald-700 font-semibold text-emerald-700 dark:text-emerald-400"
                                        x-text="getPar({{ $i }})">
                                        4
                                    </td>
                                @endfor
                                <td class="px-2 py-2 font-bold bg-emerald-200 dark:bg-emerald-900/50 border-r border-emerald-300 dark:border-emerald-600 text-emerald-900 dark:text-emerald-200"
                                    x-text="getInParTotal()">
                                    36
                                </td>
                                <td class="px-2 py-2 font-black bg-emerald-300 dark:bg-emerald-800 text-emerald-900 dark:text-white"
                                    x-text="getTotalPar()">
                                    72
                                </td>
                            </tr>

                            {{-- Player Score Input Row --}}
                            <tr>
                                <td
                                    class="sticky left-0 z-10 bg-white dark:bg-gray-800 px-3 py-3 text-left text-sm font-bold text-gray-900 dark:text-white w-24 border-r border-gray-200 dark:border-gray-700 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.1)]">
                                    {{ auth()->user()->name }}
                                </td>
                                @for($i = 1; $i <= 9; $i++)
                                    <td class="p-0 border-r border-gray-200 dark:border-gray-700 h-10 w-12 relative">
                                        <input type="number" wire:model.live.debounce.500ms="holeScores.{{ $i }}"
                                            class="w-full h-full border-0 p-0 text-center bg-transparent focus:ring-0 focus:bg-blue-50 dark:focus:bg-blue-900/30 text-lg font-bold text-gray-900 dark:text-white"
                                            placeholder="-">
                                    </td>
                                @endfor
                                <td class="px-2 py-2 font-bold bg-gray-50 dark:bg-gray-700 border-r border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white"
                                    x-text="getOutTotal()">
                                    0
                                </td>

                                @for($i = 10; $i <= 18; $i++)
                                    <td class="p-0 border-r border-gray-200 dark:border-gray-700 h-10 w-12 relative">
                                        <input type="number" wire:model.live.debounce.500ms="holeScores.{{ $i }}"
                                            class="w-full h-full border-0 p-0 text-center bg-transparent focus:ring-0 focus:bg-blue-50 dark:focus:bg-blue-900/30 text-lg font-bold text-gray-900 dark:text-white"
                                            placeholder="-">
                                    </td>
                                @endfor
                                <td class="px-2 py-2 font-bold bg-gray-50 dark:bg-gray-700 border-r border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white"
                                    x-text="getInTotal()">
                                    0
                                </td>
                                <td class="px-2 py-2 font-black bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-white text-lg"
                                    x-text="getTotal()">
                                    0
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Verification / Save --}}
        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('event.details', $event) }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none ring-offset-2 ring-emerald-500">
                Cancel
            </a>
            <button type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                Sign & Submit Scorecard
            </button>
        </div>
    </form>
</div>