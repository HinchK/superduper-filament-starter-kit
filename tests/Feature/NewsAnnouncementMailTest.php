<?php

namespace Tests\Feature;

use App\Enums\Blog\PostStatus;
use App\Mail\NewAnnouncementMail;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\User;
use Database\Seeders\NewsCategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class NewsAnnouncementMailTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(NewsCategorySeeder::class);
        Mail::fake();
    }

    /** @test */
    public function email_is_queued_when_news_post_is_published()
    {
        $newsCategory = Category::where('slug', 'news')->first();
        User::factory()->count(3)->create();

        $post = Post::factory()->create([
            'blog_category_id' => $newsCategory->id,
            'status' => PostStatus::DRAFT,
            'notification_sent_at' => null,
        ]);

        Mail::assertNothingQueued();

        $post->update(['status' => PostStatus::PUBLISHED]);

        Mail::assertQueued(NewAnnouncementMail::class, 4); // 3 created + 1 from post factory creator? Wait, factory might create users.
        // Let's check exactly how many users exist.
        $this->assertEquals(User::count(), 4); // 3 + 1 (from post factory blog_author_id)

        $this->assertNotNull($post->fresh()->notification_sent_at);
    }

    /** @test */
    public function email_is_not_sent_if_not_news_category()
    {
        $otherCategory = Category::factory()->create(['slug' => 'not-news']);
        User::factory()->create();

        Post::factory()->create([
            'blog_category_id' => $otherCategory->id,
            'status' => PostStatus::PUBLISHED,
        ]);

        Mail::assertNothingQueued();
    }

    /** @test */
    public function email_is_only_sent_once()
    {
        $newsCategory = Category::where('slug', 'news')->first();
        User::factory()->create();

        $post = Post::factory()->create([
            'blog_category_id' => $newsCategory->id,
            'status' => PostStatus::PUBLISHED,
        ]);

        Mail::assertQueued(NewAnnouncementMail::class);
        $sentAt = $post->fresh()->notification_sent_at;
        $this->assertNotNull($sentAt);

        Mail::fake(); // Reset fake
        $post->update(['title' => 'Updated Title']);

        Mail::assertNothingQueued();
        $this->assertEquals($sentAt, $post->fresh()->notification_sent_at);
    }
}
