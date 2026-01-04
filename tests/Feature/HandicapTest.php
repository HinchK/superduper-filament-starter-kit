<?php

namespace Tests\Feature;

use App\Livewire\SuperDuper\Pages\ScoreEntry;
use App\Models\Course;
use App\Models\Event;
use App\Models\Score;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class HandicapTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function score_entry_calculates_net_score_correctly()
    {
        // User with handicap of 10
        $user = User::factory()->create(['handicap' => 10]);
        $course = Course::factory()->create(['holes_count' => 18, 'par' => 72]);
        $event = Event::factory()->create(['course_id' => $course->id]);

        $this->actingAs($user);

        // User shoots 82 (10 over par)
        // Net Score should be 82 - 10 = 72.
        
        $holeScores = [];
        for ($i = 1; $i <= 18; $i++) {
            // 4 * 18 = 72. + 10 = 82.
            // Let's just make 10 holes 5 (bogey) and 8 holes 4 (par).
            // 10*5 = 50. 8*4 = 32. Total 82.
            $holeScores[$i] = ($i <= 10) ? 5 : 4; 
        }

        Livewire::test(ScoreEntry::class, ['event' => $event])
            ->set('holeScores', $holeScores)
            ->call('save')
            ->assertNotified();

        $this->assertDatabaseHas('scores', [
            'event_id' => $event->id,
            'user_id' => $user->id,
            'total_score' => 82,
            'net_score' => 72,
        ]);
    }
    
    /** @test */
    public function partial_round_calculates_proportional_handicap()
    {
        // Handicap 18 (1 shot per hole)
        $user = User::factory()->create(['handicap' => 18]);
        $course = Course::factory()->create(['holes_count' => 18, 'par' => 72]);
        $event = Event::factory()->create(['course_id' => $course->id]);

        $this->actingAs($user);

        // Play 9 holes. Expected handicap allowance = 18 * (9/18) = 9.
        // Shoot 45 (9 bogeys). 
        // Gross 45. Net = 45 - 9 = 36.

        $holeScores = [];
        for ($i = 1; $i <= 9; $i++) {
            $holeScores[$i] = 5; 
        }

        Livewire::test(ScoreEntry::class, ['event' => $event])
            ->set('holeScores', $holeScores)
            ->call('save');

        $this->assertDatabaseHas('scores', [
            'total_score' => 45,
            'net_score' => 36,
        ]);
    }

    /** @test */
    public function leaderboard_displays_net_score()
    {
        $user = User::factory()->create(['handicap' => 10, 'firstname' => 'Tiger', 'lastname' => 'Woods']);
        $event = Event::factory()->create();
        
        Score::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'hole_scores' => [],
            'total_score' => 80,
            'to_par' => 8,
            'net_score' => 70,
        ]);

        Livewire::test(\App\Livewire\SuperDuper\Components\EventLeaderboard::class, ['event' => $event])
            ->assertSee('Tiger Woods')
            ->assertSee('70') // Net Score
            ->assertSee('10'); // Handicap
    }
}
