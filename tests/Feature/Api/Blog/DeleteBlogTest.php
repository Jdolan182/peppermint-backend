<?php

namespace Tests\Feature\Api\blog;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteBlogTest extends TestCase
{
    use RefreshDatabase;

     /**
     * Delete blog test.
     *
     * @return void
     */
    public function test_delete_blog_()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->create();


        $response = $this->actingAs($user)->deleteJson('api/blog/delete/' . $blog->slug);

        $response->assertOk();
        $response->assertJson(
            [
                'status' => true,
                'message' => 'Blog Deleted'
            ]
        );
    }
}

