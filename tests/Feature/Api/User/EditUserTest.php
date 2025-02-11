<?php

namespace Tests\Feature\Api\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Update user validation test.
     *
     * @return void
     */
    public function test_edit_user_validation_()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patchJson('api/user/edit/' . $user->id, []);
        $response->assertInvalid([
            'name',
            'email',
        ]);
    }

     /**
     * Update user test.
     *
     * @return void
     */
    public function test_edit_user_()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patchJson('api/user/edit/' . $user->id, [
            'name' => 'User Name',
            'email' => 'user@email.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertOK();
    }

    
}

