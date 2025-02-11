<?php

namespace Tests\Feature\Api\Blog;

use Tests\TestCase;
use App\Models\Blog;
use App\Models\User;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Blog\BlogCategoryResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetBlogTest extends TestCase
{
    use RefreshDatabase;
     /**
     * Get Blog test.
     *
     * @return void
     */
    public function test_get_blog_()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->create();

        $categoryResource = new BlogCategoryResource($blog->category);
        $userResource = new UserResource($blog->author);

        $response = $this->actingAs($user)->getJson('api/blog/show/' . $blog->slug);
        $response->assertOk();
        $response->assertJson(
            [
                'data' => [
                    'title' => $blog->title,
                    'subtitle' => $blog->subtitle,
                    'slug' => $blog->slug,
                    'description' => $blog->description,
                    'content' => $blog->content,
                    'is_active' => $blog->is_active,
                    'category_id' => $blog->category_id,
                    'category' => [
                        'id' => $categoryResource->id,
                        'category' => $categoryResource->category
                    ],
                    'author' => [
                        'id' => $userResource->id,
                        'name' => $userResource->name,
                        'email' => $userResource->email
                    ],
                    'image_filename' => $blog->image_filename,
                    'created_at' => $blog->created_at->format('Y-m-d\TH:i:s.u\Z'),
                    'live_date' => $blog->live_date->format('Y-m-d\TH:i:s.u\Z'),
                ],
            ]
        );
    }

     /**
     * Get user list test.
     *
     * @return void
     */
    public function test_get_blogs_()
    {
        $user = User::factory()->create();

        Blog::factory(50)->create();

        $response = $this->actingAs($user)->getJson('api/blog');
        $response->assertOk();
        $response->assertJsonCount(30, 'data.*');
    }
}

