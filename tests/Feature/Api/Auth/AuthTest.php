<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use App\Models\Consumer;
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
     * Consumer auth test.
     *
     * @return void
     */
    public function test_consumer_auth_()
    {
        $consumer = Consumer::factory()->create();

        $response = $this->actingAs($consumer, 'consumer')->postJson('api/consumer/login', [
            'email' => $consumer->email,
            'password' => 'password'
        ]); 

        $response->assertOk();
        $response->assertJson(
            [
                'status' => true,
                "message" => "User Logged in Successfully",
                'name'   => $consumer->name,
                'id'  => $consumer->id,
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

    /**
     * Consumer logout test.
     *
     * @return void
     */
    public function test_consumer_logout_()
    {
        $consumer = Consumer::factory()->create();

        $response = $this->actingAs($consumer, 'consumer')->postJson('api/consumer/logout'); 

        $response->assertOk();
        $response->assertJson(
            [
                'status' => true,
                'message' => 'User Logged out Successfully',
            ]
        );
    }
}

