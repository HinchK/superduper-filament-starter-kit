<?php

namespace Tests\Feature;

use App\Enums\Blog\PostStatus;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\User;
use Database\Seeders\NewsCategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class NewsAnnouncementIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function full_announcement_workflow()
    {
        Mail::fake();
        $this->seed(NewsCategorySeeder::class);
        $newsCategory = Category::where('slug', 'news')->first();
        
        // 1. Admin creates a draft news post
        $post = Post::factory()->create([
            'blog_category_id' => $newsCategory->id,
            'status' => PostStatus::DRAFT,
            'title' => 'Tournament Update',
            'content_raw' => 'The tournament is rescheduled.',
        ]);

        Mail::assertNothingQueued();

        // 2. Admin publishes the post
        $post->update(['status' => PostStatus::PUBLISHED]);

        // 3. System sends emails to all users
        Mail::assertQueued(\App\Mail\NewAnnouncementMail::class);
        $this->assertNotNull($post->fresh()->notification_sent_at);
    }
}
