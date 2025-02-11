<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

     /**
     * Admin auth test.
     *
     * @return void
     */
    public function test_admin_auth_()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('api/auth/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertOk();
        $response->assertJson(
            [
                'status' => true,
                "message" => "User Logged in Successfully",
                'name'   => $user->name,
                'id'  => $user->id,
            ]
        );
    }

    /**
     * Admin logout test.
     *
     * @return void
     */
    public function test_admin_logout_()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('api/auth/logout'); 

        $response->assertOk();
        $response->assertJson(
            [
                'status' => true,
                'message' => 'User Logged out Successfully',
            ]
        );
    }
}

