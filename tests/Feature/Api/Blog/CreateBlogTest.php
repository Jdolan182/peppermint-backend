<?php

namespace Tests\Feature\Api\blog;

use App\Models\User;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateBlogTest extends TestCase
{
    use RefreshDatabase;

     /**
     * Create blog test.
     *
     * @return void
     */
    public function test_create_blog_()
    {
        $user = User::factory()->create();
        $count = Blog::count();
        $category = BlogCategory::factory()->create();

        $response = $this->actingAs($user)->postJson('api/blog/create', [
            'title' => 'Blog Title',
            'subtitle' => 'This is a blog',
            'slug' => 'blog-title',
            'description' => 'Blog Description',
            'content' => 'Blog Content',
            'category_id' => $category->id,
            'author_id' => $user->id
        ]);

        $response->assertOk();
        $this->assertGreaterThan($count, blog::count(), 'Record has been created');
    }
}

