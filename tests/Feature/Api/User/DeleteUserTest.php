<?php

namespace Tests\Feature\Api\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;
     /**
     * Delete user test.
     *
     * @return void
     */
    public function test_delete_user_()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->deleteJson('api/user/delete/' . $user->id);
        $response->assertOk();
        $response->assertJson(
            [
                'status' => true,
                'message' => 'User Deleted'
            ]
        );
    }
}

