<?php

namespace App\Livewire\SuperDuper\Pages;

use App\Models\Score;
use Livewire\Component;

class MyStats extends Component
{
    public function render()
    {
        $userId = auth()->id();

        $scores = Score::where('user_id', $userId)
            ->with(['event.course'])
            ->join('events', 'scores.event_id', '=', 'events.id') // Join to sort by event date
            ->orderBy('events.start', 'desc')
            ->select('scores.*') // Select score columns to avoid collision
            ->get();

        $stats = [
            'events_played' => $scores->count(),
            'avg_score' => $scores->count() > 0 ? round($scores->avg('total_score'), 1) : 0,
            'best_score' => $scores->min('total_score') ?? '-',
        ];

        return view('livewire.superduper.pages.my-stats', [
            'scores' => $scores,
            'stats' => $stats,
        ]);
    }
}