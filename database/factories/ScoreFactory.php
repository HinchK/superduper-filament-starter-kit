<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Score;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Score>
 */
class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate random scores for 18 holes (e.g., between 3 and 7)
        $holeScores = [];
        for ($i = 1; $i <= 18; $i++) {
            $holeScores[$i] = $this->faker->numberBetween(3, 7);
        }

        $totalScore = array_sum($holeScores);
        // Assuming a standard par of 72 for simplicity in the factory, 
        // though ideally this would come from the course.
        $par = 72;
        $toPar = $totalScore - $par;

        return [
            'event_id' => Event::factory(),
            'user_id' => User::factory(),
            'hole_scores' => $holeScores,
            'total_score' => $totalScore,
            'to_par' => $toPar,
        ];
    }
}
