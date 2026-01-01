<?php

namespace App\Livewire\SuperDuper\Pages;

use Livewire\Component;

class Calendar extends Component
{
    public $currentYear;
    public $currentMonth;

    public function mount()
    {
        $this->currentYear = 2026;
        $this->currentMonth = 1; // Start in January
    }

    public function nextMonth()
    {
        $this->currentMonth++;
        if ($this->currentMonth > 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        }
    }

    public function previousMonth()
    {
        $this->currentMonth--;
        if ($this->currentMonth < 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        }
    }

    public function render()
    {
        $dt = \Carbon\Carbon::createFromDate($this->currentYear, $this->currentMonth, 1);

        $daysInMonth = $dt->daysInMonth;
        $startOfWeek = $dt->dayOfWeek; // 0 (Sun) - 6 (Sat)

        // Holidays logic (simplified for 2026 and dynamic checking)
        $holidays = $this->getHolidays($this->currentYear, $this->currentMonth);

        return view('livewire.superduper.pages.calendar', [
            'monthName' => $dt->format('F'),
            'year' => $this->currentYear,
            'daysInMonth' => $daysInMonth,
            'startOfWeek' => $startOfWeek,
            'holidays' => $holidays,
        ])
            ->layout('components.superduper.main', [
                'pageTitle' => '2026 Calendar',
                'pageDescription' => '2026 Holiday Calendar',
            ]);
    }

    private function getHolidays($year, $month)
    {
        // Static definition for key 2026 holidays or calculate dynamically
        // This is a simplified list for demonstration based on the previous step's data
        $allHolidays = [
            2026 => [
                1 => [1 => "New Year's Day", 19 => "MLK Day"],
                2 => [16 => "Presidents' Day"],
                5 => [25 => "Memorial Day"],
                6 => [19 => "Juneteenth"],
                7 => [4 => "Independence Day"],
                9 => [7 => "Labor Day"],
                10 => [12 => "Columbus Day"],
                11 => [11 => "Veterans Day", 26 => "Thanksgiving"],
                12 => [25 => "Christmas Day"],
            ]
        ];

        return $allHolidays[$year][$month] ?? [];
    }
}
