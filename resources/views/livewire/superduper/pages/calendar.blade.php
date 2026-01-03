<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-lg shadow-xl overflow-hidden border-t-4 border-[#006747] p-6">
            <div id='calendar'></div>
        </div>

    </div>

    {{-- FullCalendar Styles & Overrides --}}
    <style>
        :root {
            --fc-border-color: #e5e7eb;
            --fc-button-text-color: #006747;
            --fc-button-bg-color: #ffffff;
            --fc-button-border-color: #d1d5db;
            --fc-button-hover-bg-color: #f9fafb;
            --fc-button-hover-border-color: #9ca3af;
            --fc-button-active-bg-color: #f3f4f6;
            --fc-button-active-border-color: #6b7280;
            --fc-event-bg-color: #CFB53B;
            --fc-event-border-color: #CFB53B;
            --fc-event-text-color: #ffffff;
            --fc-today-bg-color: rgba(207, 181, 59, 0.1);
            --fc-page-bg-color: #ffffff;
            --fc-neutral-bg-color: #f9fafb;
            --fc-list-event-hover-bg-color: #f3f4f6;
            --fc-highlight-color: rgba(0, 103, 71, 0.1);
        }

        /* Title styling */
        .fc-toolbar-title {
            color: #006747 !important;
            font-weight: 700 !important;
            font-size: 1.75rem !important;
        }

        /* Header cells (Days of week) */
        .fc-col-header-cell {
            background-color: #006747;
            color: #ffffff;
            padding: 12px 0 !important;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Event styling */
        .holiday-event {
            border: none !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-weight: 600;
            padding: 2px 4px;
        }

        /* Today highlight border */
        .fc-day-today {
            background-color: var(--fc-today-bg-color) !important;
        }

        /* Grid Links */
        .fc a {
            color: inherit;
            text-decoration: none;
        }

        /* Button overrides */
        .fc-button-primary {
            color: #006747 !important;
            background-color: white !important;
            border-color: #d1d5db !important;
            font-weight: 600 !important;
            text-transform: capitalize;
        }

        .fc-button-primary:hover {
            background-color: #f9fafb !important;
            border-color: #006747 !important;
        }

        .fc-button-primary:focus {
            box-shadow: 0 0 0 2px rgba(0, 103, 71, 0.5) !important;
        }

        .fc-button-active {
            background-color: #006747 !important;
            color: white !important;
            border-color: #006747 !important;
        }
    </style>

    {{-- Initialize FullCalendar --}}
    @vite(['resources/js/calendar.js'])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.initCalendar) {
                window.initCalendar(@json($events));
            } else {
                // Fallback or wait for load
                var checkInterval = setInterval(function() {
                    if (window.initCalendar) {
                        clearInterval(checkInterval);
                        window.initCalendar(@json($events));
                    }
                }, 100);
            }
        });
    </script>
</div>