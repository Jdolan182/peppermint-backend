<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSectionTemplateSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 1,
            'template' => 'Hero',
            'is_active' => 1
        ]);
        
        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 2,
            'template' => 'Feature',
            'is_active' => 1
        ]);

        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 3,
            'template' => 'CTA',
            'is_active' => 0
        ]);

        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 4,
            'template' => 'Grid',
            'is_active' => 0
        ]);

        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 5,
            'template' => 'Pricing',
            'is_active' => 1
        ]);

        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 6,
            'template' => 'Header',
            'is_active' => 1
        ]);

        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 7,
            'template' => 'Stats',
            'is_active' => 0
        ]);

        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 8,
            'template' => 'Newsletter',
            'is_active' => 0
        ]);
       
        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 9,
            'template' => 'Testimonials',
            'is_active' => 0
        ]);

        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 10,
            'template' => 'Logo Clouds',
            'is_active' => 0
        ]);

        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 11,
            'template' => 'FAQs',
            'is_active' => 0
        ]);

        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 12,
            'template' => 'Contact',
            'is_active' => 1
        ]);

        \App\Models\PageSectionTemplate::factory()->create([
            'id' => 13,
            'template' => 'Content',
            'is_active' => 1
        ]);
    }
}
