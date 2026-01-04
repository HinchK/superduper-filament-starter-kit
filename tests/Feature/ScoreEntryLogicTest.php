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

class ScoreEntryLogicTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function partial_round_calculates_proportional_par()
    {
        $user = User::factory()->create();
        // 18 hole course, par 72
        $course = Course::factory()->create(['holes_count' => 18, 'par' => 72]);
        $event = Event::factory()->create(['course_id' => $course->id]);

        $this->actingAs($user);

        // Play only Front 9 (9 holes). All pars (e.g. 4s)
        // Par for 9 holes should be (72/18)*9 = 36.
        // User shoots 40.
        // To Par should be 40 - 36 = +4.

        $holeScores = [];
        for ($i = 1; $i <= 9; $i++) {
            $holeScores[$i] = 4; // 9 * 4 = 36 if par is 4. Let's make user shoot 5s on first 4 holes.
        }
        // Actually let's just force specific score.
        // If user enters 4 on all 9 holes. Total = 36.
        // Course Par = 72. 18 holes.
        // Proportional Par = 36.
        // To Par = 36 - 36 = 0.

        Livewire::test(ScoreEntry::class, ['event' => $event])
            ->set('holeScores', $holeScores)
            ->call('save');

        $this->assertDatabaseHas('scores', [
            'total_score' => 36,
            'to_par' => 0,
        ]);

        // Test Case 2: User shoots 45 (Bogey golf) on 9 Holes.
        // To Par should be +9.
        $user2 = User::factory()->create();
        $this->actingAs($user2);

        $holeScores2 = [];
        for ($i = 1; $i <= 9; $i++) {
            $holeScores2[$i] = 5;
        }

        Livewire::test(ScoreEntry::class, ['event' => $event])
            ->set('holeScores', $holeScores2)
            ->call('save');

        $this->assertDatabaseHas('scores', [
            'user_id' => $user2->id,
            'total_score' => 45,
            'to_par' => 9,
        ]);
    }

    /** @test */
    public function calculates_to_par_correctly_with_variable_hole_pars()
    {
        $user = User::factory()->create();
        // 9 hole course. 
        // Hole 1: Par 3. Hole 2: Par 5.
        $course = Course::factory()->create([
            'holes_count' => 9, 
            'par' => 36, 
            'hole_pars' => [1 => 3, 2 => 5]
        ]);
        $event = Event::factory()->create(['course_id' => $course->id]);

        $this->actingAs($user);

        // User scores Par on Hole 1 (3) and Birdie on Hole 2 (4).
        // Total Score: 3 + 4 = 7.
        // Total Par: 3 + 5 = 8.
        // To Par: -1.

        Livewire::test(ScoreEntry::class, ['event' => $event])
            ->set('holeScores', [1 => 3, 2 => 4])
            ->call('save');

        $this->assertDatabaseHas('scores', [
            'user_id' => $user->id,
            'total_score' => 7,
            'to_par' => -1,
        ]);
    }
    
    /** @test */
    public function score_cannot_be_edited_once_saved()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $event = Event::factory()->create(['course_id' => $course->id]);

        $this->actingAs($user);

        // Create initial score
        Score::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'hole_scores' => [1 => 4],
            'total_score' => 4,
            'to_par' => 0
        ]);

        // Try to save again with different score via Livewire
        Livewire::test(ScoreEntry::class, ['event' => $event])
            ->set('holeScores', [1 => 5]) // Try to cheat/change to 5
            ->call('save')
            ->assertNotified('Score already recorded'); // Expect error notification

        // Assert DB hasn't changed
        $this->assertDatabaseHas('scores', [
            'user_id' => $user->id,
            'total_score' => 4, // Still 4, not 5
        ]);
    }
}
