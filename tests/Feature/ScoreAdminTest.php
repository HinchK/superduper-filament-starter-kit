<?php

namespace Tests\Feature;

use App\Filament\Resources\ScoreResource;
use App\Models\Score;
use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScoreAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function score_resource_pages_load()
    {
        $this->get(ScoreResource::getUrl('index'))->assertSuccessful();
        $this->get(ScoreResource::getUrl('create'))->assertSuccessful();
    }

    /** @test */
    public function can_edit_score_via_resource()
    {
        $event = Event::factory()->create();
        $user = User::factory()->create();
        $score = Score::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'total_score' => 72,
            'hole_scores' => [],
        ]);

        $this->get(ScoreResource::getUrl('edit', ['record' => $score]))->assertSuccessful();
    }
}
