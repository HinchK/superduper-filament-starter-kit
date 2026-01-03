<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->word();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'is_active' => true,
            'locale' => 'en',
        ];
    }
}
