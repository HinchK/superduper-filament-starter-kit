<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Event;
use App\Models\Score;
use App\Models\User;
use Illuminate\Database\Seeder;

class GolfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Courses
        $courses = Course::factory()->count(5)->create();

        // 2. Create Events
        // Past Events (with scores)
        $pastEvents = Event::factory()
            ->count(5)
            ->sequence(fn($sequence) => [
                'course_id' => $courses->random()->id,
                'start' => now()->subWeeks($sequence->index + 1),
                'end' => now()->subWeeks($sequence->index + 1)->addHours(4),
                'status' => \App\Enums\Golf\EventStatus::Completed,
            ])
            ->create();

        // Future Events (no scores)
        Event::factory()
            ->count(5)
            ->sequence(fn($sequence) => [
                'course_id' => $courses->random()->id,
                'start' => now()->addWeeks($sequence->index + 1),
                'end' => now()->addWeeks($sequence->index + 1)->addHours(4),
                'status' => \App\Enums\Golf\EventStatus::Upcoming,
            ])
            ->create();

        // 3. Create Scores for Past Events
        // Get all users (or a subset)
        $users = User::all();

        if ($users->isEmpty()) {
            $users = User::factory()->count(10)->create();
        }

        foreach ($pastEvents as $event) {
            // Assign random scores for each user for this event
            foreach ($users as $user) {
                // Determine random par for the course (fallback to 72)
                $par = $event->course->par ?? 72;

                Score::factory()->create([
                    'event_id' => $event->id,
                    'user_id' => $user->id,
                    // We let the factory handle hole_scores, but we can override total if we want strict consistency with par.
                    // The factory calculates total and to_par based on its internal logic, which is fine for seeding.
                ]);
            }
        }
    }
}
