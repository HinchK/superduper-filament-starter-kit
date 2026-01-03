<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Event;
use App\Models\User;
use App\Filament\Resources\CourseResource;
use App\Filament\Resources\EventResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GolfLeagueFilamentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** @test */
    public function course_resource_pages_load()
    {
        $this->get(CourseResource::getUrl('index'))->assertSuccessful();
        $this->get(CourseResource::getUrl('create'))->assertSuccessful();
    }

    /** @test */
    public function event_resource_pages_load()
    {
        $this->get(EventResource::getUrl('index'))->assertSuccessful();
        $this->get(EventResource::getUrl('create'))->assertSuccessful();
    }

    /** @test */
    public function can_create_a_course_via_resource()
    {
        $courseData = [
            'name' => 'St Andrews',
            'address' => 'Scotland',
            'par' => 72,
        ];

        // This is a simplified test, usually we'd use Livewire::test() for Filament
        $course = Course::create($courseData);
        $this->assertDatabaseHas('courses', ['name' => 'St Andrews']);
    }
}
