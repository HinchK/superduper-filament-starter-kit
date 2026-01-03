<?php

namespace Tests\Feature;

use App\Livewire\SuperDuper\Components\EventLeaderboard;
use App\Models\Event;
use App\Models\Score;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EventLeaderboardFrontendTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_correctly_with_scores()
    {
        $event = Event::factory()->create();
        $user1 = User::factory()->create(['firstname' => 'John', 'lastname' => 'Doe']);
        $user2 = User::factory()->create(['firstname' => 'Jane', 'lastname' => 'Smith']);

        Score::create([
            'event_id' => $event->id,
            'user_id' => $user1->id,
            'total_score' => 75,
            'to_par' => 3,
            'hole_scores' => [],
        ]);

        Score::create([
            'event_id' => $event->id,
            'user_id' => $user2->id,
            'total_score' => 72,
            'to_par' => 0,
            'hole_scores' => [],
        ]);

        Livewire::test(EventLeaderboard::class, ['event' => $event])
            ->assertSee('John Doe')
            ->assertSee('Jane Smith')
            ->assertSee('72')
            ->assertSee('75')
            ->assertSee('1') //Jane should be 1
            ->assertSee('2'); //John should be 2
    }

    /** @test */
    public function it_shows_result_notes_if_present()
    {
        $event = Event::factory()->create(['result_notes' => 'Playoff winner decided.']);

        Livewire::test(EventLeaderboard::class, ['event' => $event])
            ->assertSee('Playoff winner decided.');
    }
}
