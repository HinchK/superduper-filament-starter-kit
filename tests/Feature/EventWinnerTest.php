<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EventWinnerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function event_can_have_a_winner()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['winner_user_id' => $user->id]);

        $this->assertEquals($user->id, $event->winner->id);
    }

    /** @test */
    public function winner_is_displayed_on_event_details_page()
    {
        $winner = User::factory()->create(['firstname' => 'Tiger', 'lastname' => 'Woods']);
        $event = Event::factory()->create(['winner_user_id' => $winner->id]);

        $this->get(route('event.details', $event))
            ->assertSuccessful()
            ->assertSee('Winner')
            ->assertSee('Tiger Woods');
    }
}
