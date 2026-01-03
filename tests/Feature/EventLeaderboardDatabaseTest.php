<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Enums\Golf\EventStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventLeaderboardDatabaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function event_has_result_notes_field()
    {
        $event = Event::factory()->create([
            'result_notes' => 'Winner decided by playoff on hole 18.',
        ]);

        $this->assertEquals('Winner decided by playoff on hole 18.', $event->result_notes);
    }

    /** @test */
    public function event_has_completed_scope()
    {
        Event::factory()->create(['status' => EventStatus::Completed]);
        Event::factory()->create(['status' => EventStatus::Upcoming]);

        $completedEvents = Event::where('status', EventStatus::Completed)->get();

        $this->assertCount(1, $completedEvents);
    }
}
