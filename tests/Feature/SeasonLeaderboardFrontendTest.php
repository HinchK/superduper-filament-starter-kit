<?php

namespace Tests\Feature;

use App\Livewire\SuperDuper\Pages\SeasonStandings;
use App\Livewire\SuperDuper\Components\RecentResults;
use App\Models\Event;
use App\Models\Score;
use App\Models\User;
use App\Enums\Golf\EventStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SeasonLeaderboardFrontendTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_calculates_season_standings_correctly()
    {
        $user = User::factory()->create(['firstname' => 'John', 'lastname' => 'Doe']);
        $event1 = Event::factory()->create(['status' => EventStatus::Completed, 'start' => now()]);
        $event2 = Event::factory()->create(['status' => EventStatus::Completed, 'start' => now()]);

        Score::create([
            'event_id' => $event1->id,
            'user_id' => $user->id,
            'total_score' => 70,
            'to_par' => -2,
            'hole_scores' => [],
        ]);

        Score::create([
            'event_id' => $event2->id,
            'user_id' => $user->id,
            'total_score' => 80,
            'to_par' => 8,
            'hole_scores' => [],
        ]);

        Livewire::test(SeasonStandings::class)
            ->assertSee('John Doe')
            ->assertSee('75') // Avg of 70 and 80
            ->assertSee('+6'); // Sum of -2 and 8
    }

    /** @test */
    public function recent_results_widget_shows_latest_event()
    {
        $user = User::factory()->create(['firstname' => 'Jane', 'lastname' => 'Smith']);
        $event = Event::factory()->create([
            'title' => 'The Open',
            'status' => EventStatus::Completed,
            'start' => now()->subDay(),
        ]);

        Score::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'total_score' => 72,
            'to_par' => 0,
            'hole_scores' => [],
        ]);

        Livewire::test(RecentResults::class)
            ->assertSee('The Open')
            ->assertSee('Jane Smith')
            ->assertSee('E');
    }
}
