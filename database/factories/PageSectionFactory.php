<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\PageSectionTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageSectionTemplate>
 */
class PageSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order' => fake()->randomDigit(),
            'data' => 'Data goes here later',
            'page_id' => Page::factory(),
            'page_section_template_id' => PageSectionTemplate::factory()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
