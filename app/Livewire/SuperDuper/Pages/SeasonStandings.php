<?php

namespace App\Livewire\SuperDuper\Pages;

use App\Models\Score;
use App\Models\Event;
use App\Enums\Golf\EventStatus;
use App\Services\RankingService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SeasonStandings extends Component
{
    public function render(RankingService $rankingService)
    {
        $year = now()->year;

        // Fetch all scores for completed events in the current year
        $scores = Score::whereHas('event', function ($query) use ($year) {
            $query->where('status', EventStatus::Completed)
                  ->whereYear('start', $year);
        })->with('user')->get();

        // Aggregate by user
        $standings = $scores->groupBy('user_id')->map(function ($userScores) {
            $user = $userScores->first()->user;
            
            return (object) [
                'user' => $user,
                'events_played' => $userScores->count(),
                'avg_score' => round($userScores->avg('total_score'), 1),
                'total_to_par' => $userScores->sum('to_par'),
                // For Wins, we'd need to check the rank of each score in its event. 
                // Simplified for now: just aggregate stats.
            ];
        })->sortBy('avg_score')->values();

        return view('livewire.super-duper.pages.season-standings', [
            'standings' => $standings,
        ]);
    }
}