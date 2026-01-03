<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Event;
use App\Enums\Golf\EventFormat;
use App\Enums\Golf\EventStatus;
use App\Enums\Golf\EventType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'start' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'allDay' => false,
            'description' => $this->faker->paragraph(),
            'course_id' => Course::factory(),
            'type' => EventType::Weekly,
            'format' => EventFormat::StrokePlay,
            'status' => EventStatus::Upcoming,
        ];
    }
}
