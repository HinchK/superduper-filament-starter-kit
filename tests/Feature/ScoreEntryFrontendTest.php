<?php

namespace Tests\Feature;

use App\Livewire\SuperDuper\Pages\ScoreEntry;
use App\Models\Course;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ScoreEntryFrontendTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function score_entry_page_loads()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create(['holes_count' => 9]);
        $event = Event::factory()->create(['course_id' => $course->id]);

        $this->actingAs($user);

        Livewire::test(ScoreEntry::class, ['event' => $event])
            ->assertStatus(200)
            ->assertSee($event->title);
    }

    /** @test */
    public function can_save_score()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create(['holes_count' => 9, 'par' => 36]);
        $event = Event::factory()->create(['course_id' => $course->id]);

        $this->actingAs($user);

        $holeScores = [
            1 => 4, 2 => 4, 3 => 4, 4 => 4, 5 => 4, 6 => 4, 7 => 4, 8 => 4, 9 => 4
        ];

        Livewire::test(ScoreEntry::class, ['event' => $event])
            ->set('holeScores', $holeScores)
            ->call('save')
            ->assertNotified();

        $this->assertDatabaseHas('scores', [
            'event_id' => $event->id,
            'user_id' => $user->id,
            'total_score' => 36,
        ]);
    }
}
