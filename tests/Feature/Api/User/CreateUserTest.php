<?php

namespace Tests\Feature\Api\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

     /**
     * Create user test.
     *
     * @return void
     */
    public function test_create_user_()
    {
        $user = User::factory()->create();
        $count = User::count();

        $response = $this->actingAs($user)->postJson('api/user/create', [
            'name' => 'User Name',
            'email' => 'user@email.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertCreated();
        $this->assertGreaterThan($count, User::count(), 'Record has been created');
    }
}

