<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Themes
        \App\Models\Theme::factory()->create([
            'name' => 'Default',
            //
            'bgColour' => 'bg-gray-900',
            'bgTextColour' => 'text-gray-900',
            //
            'secondBgColour' => 'bg-gray-800',
            'secondBgHoverColour' => 'hover:bg-gray-800',
            'secondColour' => 'bg-indigo-600',
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
        ]);

        \App\Models\Theme::factory()->create([
            'name' => 'Green',
            //
            'bgColour' => 'bg-green-900',
            'bgTextColour' => 'text-green-900',
            //
            'secondBgColour' => 'bg-green-700',
            'secondBgHoverColour' => 'hover:bg-green-700',
            'secondColour' => 'bg-green-600',
            'secondBgTextColour' => 'border-green-600 text-green-600',
            'secondFocusColour' => 'focus:border-green-600 focus:ring-green-600',
            'secondHoverColour' => 'hover:bg-green-700',
            //
            'textColour' => 'text-white',
            'textHoverColour' => 'hover:text-white',
            'textBgHoverColour' => 'hover:bg-gray-200',
            //
            'secondTextColour' => 'text-gray-900',
            'secondTextHoverColour' => 'hover:text-gray-200',
            //
            'thirdTextColour' => 'text-white',
            //
            'mainButtonColour' => 'bg-white',
            'mainButtonHoverColour' => 'hover:bg-white/70',
            //
            'is_active' => '0',
        ]);


    }
}
