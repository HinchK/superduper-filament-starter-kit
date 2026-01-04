<?php

namespace App\Livewire\SuperDuper\Pages;

use App\Models\Event;
use App\Models\Score;
use Livewire\Component;
use Filament\Notifications\Notification;

class ScoreEntry extends Component
{
    public Event $event;
    public array $holeScores = [];
    public int $holesCount = 18;

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->holesCount = $event->course->holes_count ?? 18;

        // Load existing score
        $score = Score::where('event_id', $event->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($score) {
            $this->holeScores = $score->hole_scores;
        } else {
            // Initialize empty array
            for ($i = 1; $i <= $this->holesCount; $i++) {
                $this->holeScores[$i] = null;
            }
        }
    }

    public function save()
    {
        // Check if score already exists (Locking)
        $existingScore = Score::where('event_id', $this->event->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($existingScore) {
            Notification::make()
                ->title('Score already recorded')
                ->body('Scores cannot be edited once saved. Please contact an admin for corrections.')
                ->danger()
                ->send();
            return;
        }

        $totalScore = collect($this->holeScores)
            ->map(fn($score) => (int) $score)
            ->sum();

        // Calculate To Par proportionally
        $holesPlayed = collect($this->holeScores)->filter(fn($score) => !is_null($score) && $score !== '')->count();
        $coursePar = $this->event->course->par ?? 72;
        $courseHoles = $this->event->course->holes_count ?? 18;

        // Avoid division by zero
        $currentPar = ($courseHoles > 0 && $holesPlayed > 0)
            ? round(($coursePar / $courseHoles) * $holesPlayed)
            : 0;

        $toPar = $totalScore - $currentPar;

        // Calculate Net Score
        // Net Score = Total Score - (Handicap * (Holes Played / Course Holes))
        // Using simple gross - handicap for now, assuming full round or proportional.
        $userHandicap = auth()->user()->handicap ?? 0;
        
        // Proportional handicap for partial rounds? Let's just do simple subtraction for now as per Assumptions
        // But if holesPlayed < courseHoles, we probably shouldn't subtract full handicap.
        // Let's scale it: round(Handicap * (HolesPlayed / HolesCount))
        $playedHandicap = ($courseHoles > 0 && $holesPlayed > 0)
            ? round($userHandicap * ($holesPlayed / $courseHoles))
            : 0;

        $netScore = $totalScore - $playedHandicap;

        Score::create([
            'event_id' => $this->event->id,
            'user_id' => auth()->id(),
            'hole_scores' => $this->holeScores,
            'total_score' => $totalScore,
            'to_par' => $toPar,
            'net_score' => $netScore,
        ]);

        Notification::make()
            ->title('Scorecard saved successfully')
            ->success()
            ->send();

        $this->redirect(route('event.details', $this->event), navigate: true);
    }

    public function getTotalScoreProperty()
    {
        return collect($this->holeScores)->filter()->sum();
    }

    public function getToParProperty()
    {
        // Calculate total score for holes played
        $totalScore = collect($this->holeScores)
            ->filter(fn($score) => !is_null($score) && $score !== '')
            ->map(fn($score) => (int) $score)
            ->sum();

        // Calculate "Current Par" based on specific holes played
        $currentPar = 0;
        $holePars = $this->event->course->hole_pars ?? [];
        // Default average par if no hole data
        $avgPar = ($this->event->course->par ?? 72) / ($this->event->course->holes_count ?? 18);

        foreach ($this->holeScores as $holeNumber => $score) {
            if (!is_null($score) && $score !== '') {
                // Use specific par if available, otherwise fallback to average
                $currentPar += $holePars[$holeNumber] ?? (int) round($avgPar);
            }
        }

        return $totalScore - $currentPar;
    }

    public function render()
    {
        return view('livewire.superduper.pages.score-entry');
    }
}