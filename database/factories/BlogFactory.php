<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(3, true),
            'subtitle' => fake()->sentence(6, true),
            'slug' => fake()->slug(),
            'description' => fake()->text(25),
            'content' => fake()->text(100),
            'is_active' => 1,
            'category_id' => BlogCategory::factory(),
            'author_id' => User::factory(),
            'image_filename' => 'test.png',
            'live_date' => fake()->dateTime()
        ];
    }
}
