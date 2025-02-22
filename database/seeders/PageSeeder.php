<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Page::factory()->create([
            'id' => 1,
            'title' => 'Home',
            'slug' => 'home',
            'show_footer' => 1,
            'is_active' => 1,
        ]);

        \App\Models\Page::factory()->create([
            'id' => 2,
            'title' => 'About',
            'slug' => 'about',
            'show_footer' => 1,
            'is_active' => 1,
        ]);

        \App\Models\Page::factory()->create([
            'id' => 3,
            'title' => 'Contact',
            'slug' => 'contact',
            'show_footer' => 1,
            'is_active' => 1,
        ]);


        //Home page
        \App\Models\PageSection::factory()->create([
            'order' => '1',
            'data' => 'Data goes here later',
            'page_id' => 1,
            'page_section_template_id' => 1,
        ]);

        \App\Models\PageSection::factory()->create([
            'order' => '2',
            'data' => 'Data goes here later',
            'page_id' => 1,
            'page_section_template_id' => 2
        ]);

        \App\Models\PageSection::factory()->create([
            'order' => '3',
            'data' => 'Data goes here later',
            'page_id' => 1,
            'page_section_template_id' => 6
        ]);

        \App\Models\PageSection::factory()->create([
            'order' => '4',
            'data' => 'Data goes here later',
            'page_id' => 1,
            'page_section_template_id' => 5
        ]);

        //About page
        \App\Models\PageSection::factory()->create([
            'order' => '1',
            'data' => 'Data goes here later',
            'page_id' => 2,
            'page_section_template_id' => 12
        ]);
        
        //Contact page
        \App\Models\PageSection::factory()->create([
            'order' => '1',
            'data' => 'Data goes here later',
            'page_id' => 3,
            'page_section_template_id' => 13
        ]);

    }
}
