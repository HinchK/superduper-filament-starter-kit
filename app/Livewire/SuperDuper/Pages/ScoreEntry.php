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
        // Validation could go here (e.g. all holes filled)

        $totalScore = collect($this->holeScores)
            ->map(fn($score) => (int) $score)
            ->sum();
        $par = $this->event->course->par ?? 72; // Simplified, ideally hole-by-hole par
        $toPar = $totalScore - $par;

        Score::updateOrCreate(
            [
                'event_id' => $this->event->id,
                'user_id' => auth()->id(),
            ],
            [
                'hole_scores' => $this->holeScores,
                'total_score' => $totalScore,
                'to_par' => $toPar,
            ]
        );

        Notification::make()
            ->title('Scorecard saved successfully')
            ->success()
            ->send();
    }

    public function getTotalScoreProperty()
    {
        return collect($this->holeScores)->filter()->sum();
    }

    public function render()
    {
        return view('livewire.superduper.pages.score-entry');
    }
}