<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Event;
use App\Models\Score;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScoreModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function score_can_be_created_with_hole_data()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();
        
        $holeScores = [
            1 => 4, 2 => 5, 3 => 3, 4 => 4, 5 => 4, 6 => 5, 7 => 3, 8 => 4, 9 => 4,
            10 => 4, 11 => 5, 12 => 3, 13 => 4, 14 => 4, 15 => 5, 16 => 3, 17 => 4, 18 => 4
        ];

        $score = Score::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'hole_scores' => $holeScores,
            'total_score' => 72,
            'to_par' => 0,
        ]);

        $this->assertDatabaseHas('scores', [
            'event_id' => $event->id,
            'user_id' => $user->id,
            'total_score' => 72,
        ]);

        $this->assertEquals($holeScores, $score->fresh()->hole_scores);
    }

    /** @test */
    public function course_has_holes_count()
    {
        $course = Course::factory()->create(['holes_count' => 9]);
        $this->assertEquals(9, $course->holes_count);
    }
}
