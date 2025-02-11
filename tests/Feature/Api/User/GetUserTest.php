<?php

namespace Tests\Feature\Api\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetUserTest extends TestCase
{
    use RefreshDatabase;

     /**
     * Get user test.
     *
     * @return void
     */
    public function test_get_user_()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('api/user/show/' . $user->id);
        $response->assertOk();
        $response->assertJson(
            [
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]
        );
    }

     /**
     * Get current user test.
     *
     * @return void
     */
    public function test_get_current_user_()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('api/user/getUser');
        $response->assertOk();
        $response->assertJson(
            [
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]
        );
    }

     /**
     * Get user list test.
     *
     * @return void
     */
    public function test_get_users_()
    {
        $user = User::factory()->create();

        User::factory(50)->create();

        $response = $this->actingAs($user)->getJson('api/user');
        $response->assertOk();
        $response->assertJsonCount(30, 'data.*');
    }
}

