<?php

namespace Database\Factories\Blog;

use App\Enums\Blog\PostStatus;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'blog_author_id' => User::factory(),
            'blog_category_id' => Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'content_raw' => $this->faker->paragraphs(3, true),
            'status' => PostStatus::DRAFT,
            'published_at' => now(),
            'locale' => 'en',
        ];
    }
}
