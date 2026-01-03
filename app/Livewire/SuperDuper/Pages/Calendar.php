<?php

namespace App\Livewire\SuperDuper\Pages;

use Livewire\Component;

class Calendar extends Component
{
    public function render()
    {
        return view('livewire.superduper.pages.calendar', [
            'events' => $this->getEvents(),
        ])
            ->layout('components.superduper.main', [
                'pageTitle' => '2026 Calendar',
                'pageDescription' => '2026 Holiday Calendar',
            ]);
    }

    private function getEvents()
    {
        // 2026 Holidays
        return [
            [
                'title' => "New Year's Day",
                'start' => '2026-01-01',
                'allDay' => true,
                'className' => 'holiday-event'
            ],
            [
                'title' => "MLK Day",
                'start' => '2026-01-19',
                'allDay' => true,
                'className' => 'holiday-event'
            ],
            [
                'title' => "Presidents' Day",
                'start' => '2026-02-16',
                'allDay' => true,
                'className' => 'holiday-event'
            ],
            [
                'title' => "Memorial Day",
                'start' => '2026-05-25',
                'allDay' => true,
                'className' => 'holiday-event'
            ],
            [
                'title' => "Juneteenth",
                'start' => '2026-06-19',
                'allDay' => true,
                'className' => 'holiday-event'
            ],
            [
                'title' => "Independence Day",
                'start' => '2026-07-04',
                'allDay' => true,
                'className' => 'holiday-event'
            ],
            [
                'title' => "Labor Day",
                'start' => '2026-09-07',
                'allDay' => true,
                'className' => 'holiday-event'
            ],
            [
                'title' => "Columbus Day",
                'start' => '2026-10-12',
                'allDay' => true,
                'className' => 'holiday-event'
            ],
            [
                'title' => "Veterans Day",
                'start' => '2026-11-11',
                'allDay' => true,
                'className' => 'holiday-event'
            ],
            [
                'title' => "Thanksgiving",
                'start' => '2026-11-26',
                'allDay' => true,
                'className' => 'holiday-event'
            ],
            [
                'title' => "Christmas Day",
                'start' => '2026-12-25',
                'allDay' => true,
                'className' => 'holiday-event'
            ],
        ];
    }
}
