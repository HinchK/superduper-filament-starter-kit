<?php

namespace Tests\Feature;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Database\Seeders\NewsCategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsAnnouncementDatabaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function news_category_can_be_seeded()
    {
        $this->seed(NewsCategorySeeder::class);

        $this->assertDatabaseHas('blog_categories', [
            'slug' => 'news',
            'name' => 'News',
        ]);
    }

    /** @test */
    public function post_can_have_notification_sent_at_column()
    {
        $this->seed(NewsCategorySeeder::class);
        $category = Category::where('slug', 'news')->first();

        $post = Post::factory()->create([
            'blog_category_id' => $category->id,
            'notification_sent_at' => null,
        ]);

        $this->assertNull($post->notification_sent_at);

        $post->update(['notification_sent_at' => now()]);

        $this->assertNotNull($post->fresh()->notification_sent_at);
    }
}
