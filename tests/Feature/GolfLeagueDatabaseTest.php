<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Event;
use App\Models\User;
use App\Enums\Golf\EventType;
use App\Enums\Golf\EventStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GolfLeagueDatabaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_course_can_be_created()
    {
        $course = Course::factory()->create([
            'name' => 'Pebble Beach',
            'par' => 72,
        ]);

        $this->assertEquals('Pebble Beach', $course->name);
        $this->assertEquals(72, $course->par);
    }

    /** @test */
    public function an_event_can_belong_to_a_course()
    {
        $course = Course::factory()->create();
        $event = Event::factory()->create(['course_id' => $course->id]);

        $this->assertEquals($course->id, $event->course->id);
        $this->assertCount(1, $course->events);
    }

    /** @test */
    public function event_registration_logic_works_for_tournaments()
    {
        $event = Event::factory()->create([
            'type' => EventType::Tournament,
            'status' => EventStatus::Open,
            'registration_starts_at' => now()->subDay(),
            'registration_ends_at' => now()->addDay(),
        ]);

        $this->assertTrue($event->isRegistrationOpen());

        $event->update(['status' => EventStatus::Closed]);
        $this->assertFalse($event->isRegistrationOpen());
        
        $event->update([
            'status' => EventStatus::Open,
            'registration_starts_at' => now()->addDay(),
        ]);
        $this->assertFalse($event->isRegistrationOpen(), 'Registration should be false if start date is in the future');

        $event->update([
            'registration_starts_at' => now()->subDays(2),
            'registration_ends_at' => now()->subDay(),
        ]);
        $this->assertFalse($event->isRegistrationOpen(), 'Registration should be false if end date is in the past');
    }

    /** @test */
    public function weekly_league_events_never_have_open_registration()
    {
        $event = Event::factory()->create([
            'type' => EventType::Weekly,
            'status' => EventStatus::Open,
        ]);

        $this->assertFalse($event->isRegistrationOpen());
    }

    /** @test */
    public function users_can_register_for_events()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['type' => EventType::Tournament]);

        $event->registrations()->attach($user, ['status' => 'registered']);

        $this->assertCount(1, $event->registrations);
        $this->assertEquals($user->id, $event->registrations->first()->id);
        $this->assertCount(1, $user->registeredEvents);
    }
}