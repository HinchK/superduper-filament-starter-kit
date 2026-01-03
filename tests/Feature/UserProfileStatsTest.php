<?php

namespace Tests\Feature;

use App\Livewire\SuperDuper\Pages\MyStats;
use App\Models\Event;
use App\Models\Score;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserProfileStatsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function stats_page_is_accessible_by_auth_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('my-stats'))->assertSuccessful();
    }

    /** @test */
    public function stats_are_calculated_correctly()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create 2 events with scores
        $event1 = Event::factory()->create(['start' => now()->subDays(2)]);
        Score::create(['event_id' => $event1->id, 'user_id' => $user->id, 'total_score' => 80, 'hole_scores' => []]);

        $event2 = Event::factory()->create(['start' => now()->subDay()]);
        Score::create(['event_id' => $event2->id, 'user_id' => $user->id, 'total_score' => 70, 'hole_scores' => []]);

        Livewire::test(MyStats::class)
            ->assertSee('Events Played')
            ->assertSee('2') // Count
            ->assertSee('75') // Avg
            ->assertSee('70'); // Best
    }

    /** @test */
    public function history_table_is_rendered()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $event = Event::factory()->create(['title' => 'Masters Tournament']);
        Score::create([
            'event_id' => $event->id, 
            'user_id' => $user->id, 
            'total_score' => 72, 
            'to_par' => 0,
            'hole_scores' => []
        ]);

        Livewire::test(MyStats::class)
            ->assertSee('Masters Tournament')
            ->assertSee('72')
            ->assertSee('E');
    }
}
