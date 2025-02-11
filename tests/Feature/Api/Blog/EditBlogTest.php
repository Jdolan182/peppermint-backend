<?php

namespace Tests\Feature\Api\Blog;

use Tests\TestCase;
use App\Models\Blog;
use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditBlogTest extends TestCase
{
    use RefreshDatabase;

     /**
     * Update user test.
     *
     * @return void
     */
    public function test_edit_blog_()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->create();
        $category = BlogCategory::factory()->create();

        $response = $this->actingAs($user)->patchJson('api/blog/edit/' . $blog->slug, [
            'title' => 'Blog Title',
            'subtitle' => 'This is a blog',
            'slug' => 'blog-title',
            'description' => 'Blog Description',
            'content' => 'Blog Content',
            'category_id' => $category->id,
            'author_id' => $user->id
        ]);
       // dd($response); 

        $response->assertOK();
    }
}

