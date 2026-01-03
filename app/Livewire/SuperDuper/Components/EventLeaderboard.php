<?php

namespace App\Livewire\SuperDuper\Components;

use App\Models\Event;
use App\Models\Score;
use App\Services\RankingService;
use Livewire\Component;

class EventLeaderboard extends Component
{
    public Event $event;

    public function render(RankingService $rankingService)
    {
        $scores = Score::where('event_id', $this->event->id)
            ->with('user')
            ->get();

        $rankedScores = $rankingService->rankScores($scores);

        return view('livewire.super-duper.components.event-leaderboard', [
            'scores' => $rankedScores,
        ]);
    }
}