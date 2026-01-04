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


}
