<?php

namespace Tests\Feature\Api\User;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

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

