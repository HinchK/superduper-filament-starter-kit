<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header & Navigation --}}
        <div
            class="flex flex-col md:flex-row justify-between items-center mb-8 bg-white p-6 rounded-lg shadow-sm border-t-4 border-[#006747]">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-[#006747] flex items-center gap-3">
                    <span class="text-4xl">{{ $monthName }}</span>
                    <span class="text-gray-400 font-light">{{ $year }}</span>
                </h1>
            </div>

            <div class="flex items-center gap-4">
                <button wire:click="previousMonth"
                    class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-50 hover:text-[#006747] transition-colors focus:outline-none focus:ring-2 focus:ring-[#006747] focus:ring-offset-2">
                    &larr; Previous
                </button>
                <button wire:click="nextMonth"
                    class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-50 hover:text-[#006747] transition-colors focus:outline-none focus:ring-2 focus:ring-[#006747] focus:ring-offset-2">
                    Next &rarr;
                </button>
            </div>
        </div>

        {{-- Calendar Grid --}}
        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            {{-- Day Headers --}}
            <div class="grid grid-cols-7 border-b border-gray-200 bg-[#006747] text-white">
                @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $dayHeader)
                    <div class="py-3 text-center font-semibold text-sm uppercase tracking-wider">
                        {{ $dayHeader }}
                    </div>
                @endforeach
            </div>

            {{-- Days --}}
            <div class="grid grid-cols-7 bg-gray-200 gap-px border-b border-gray-200">
                {{-- Empty slots for previous month --}}
                @for ($i = 0; $i < $startOfWeek; $i++)
                    <div class="bg-white min-h-[120px] p-2 opacity-50"></div>
                @endfor

                {{-- Current Month Days --}}
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    @php
                        $isHoliday = isset($holidays[$day]);
                        $holidayName = $isHoliday ? $holidays[$day] : '';
                    @endphp

                    <div class="bg-white min-h-[120px] p-2 relative group hover:bg-gray-50 transition-colors">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium
                                {{ $isHoliday ? 'bg-[#CFB53B] text-white' : 'text-gray-700' }}">
                            {{ $day }}
                        </span>

                        @if($isHoliday)
                            <div class="mt-2 text-xs font-semibold text-[#006747] bg-[#006747]/10 p-1 rounded border-l-2 border-[#006747] truncate"
                                title="{{ $holidayName }}">
                                {{ $holidayName }}
                            </div>
                        @endif
                    </div>
                @endfor

                {{-- Empty slots for next month to complete the grid (optional but looks better) --}}
                @php
                    $totalSlots = $startOfWeek + $daysInMonth;
                    $remainingSlots = 7 - ($totalSlots % 7);
                    if ($remainingSlots == 7)
                        $remainingSlots = 0;
                @endphp
                @for ($i = 0; $i < $remainingSlots; $i++)
                    <div class="bg-white min-h-[120px] p-2 opacity-50"></div>
                @endfor
            </div>
        </div>
    </div>
</div>