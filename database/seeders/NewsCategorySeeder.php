<?php

namespace Database\Seeders;

use App\Models\Blog\Category;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(
            ['slug' => 'news'],
            [
                'name' => 'News',
                'description' => 'League News and Announcements',
                'is_active' => true,
            ]
        );
    }
}