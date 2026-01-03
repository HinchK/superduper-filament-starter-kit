<?php

namespace App\Livewire\SuperDuper\Components;

use App\Models\Event;
use App\Models\Score;
use App\Enums\Golf\EventStatus;
use App\Services\RankingService;
use Livewire\Component;

class RecentResults extends Component
{
    public function render(RankingService $rankingService)
    {
        $latestEvent = Event::where('status', EventStatus::Completed)
            ->orderBy('start', 'desc')
            ->first();

        $scores = collect();
        if ($latestEvent) {
            $scores = Score::where('event_id', $latestEvent->id)
                ->with('user')
                ->get();
            $scores = $rankingService->rankScores($scores)->take(3);
        }

        return view('livewire.super-duper.components.recent-results', [
            'latestEvent' => $latestEvent,
            'topScores' => $scores,
        ]);
    }
}