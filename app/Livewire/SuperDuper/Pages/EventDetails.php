<?php

namespace App\Livewire\SuperDuper\Pages;

use Livewire\Component;

class EventDetails extends Component
{
    public \App\Models\Event $event;

    public function mount(\App\Models\Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        return view('livewire.superduper.pages.event-details')
            ->layout('components.superduper.main', [
                'pageTitle' => $this->event->title,
                'pageDescription' => 'Event Details',
            ]);
    }
}
