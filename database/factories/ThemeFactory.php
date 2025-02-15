<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theme>
 */
class ThemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Default',
            //
            'bgColour' => 'bg-gray-900',
            'bgTextColour' => 'text-gray-900',
            //
            'secondBgColour' => 'bg-gray-800',
            'secondBgHoverColour' => 'hover:bg-gray-800',
            'secondColour' => 'bg-indigo-900',
            'secondBgTextColour' => 'border-indigo-600 text-indigo-600',
            'secondFocusColour' => 'focus:border-indigo-600 focus:ring-indigo-600',
            'secondHoverColour' => 'hover:bg-indigo-700',
            //
            'textColour' => 'text-white',
            'textHoverColour' => 'hover:text-white',
            'textBgHoverColour' => 'hover:bg-gray-200',
            //
            'secondTextColour' => 'text-gray-900',
            'secondTextHoverColour' => 'hover:text-gray-200',
            //
            'thirdTextColour' => 'text-gray-400',
            //
            'mainButtonColour' => 'bg-white',
            'mainButtonHoverColour' => 'hover:bg-white/70',
            //
            'is_active' => '1',
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
