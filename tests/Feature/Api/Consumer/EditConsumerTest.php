<?php

namespace Tests\Feature\Api\Consumer;

use App\Models\User;
use App\Models\Consumer;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class EditConsumerTest extends TestCase
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
        $consumer = Consumer::factory()->create();

        $response = $this->actingAs($user)->patchJson('api/user/edit/' . $consumer->id, []);
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
    public function test_edit_consumer_()
    {
        $user = User::factory()->create();
        $consumer = Consumer::factory()->create();

        $response = $this->actingAs($user)->patchJson('api/consumer/edit/' . $consumer->id, [
            'name' => 'User Name',
            'email' => 'user@email.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertOK();
    }

    /**
     * Update consumer details test.
     *
     * @return void
     */
    public function test_edit_consumer_details_()
    {
        $consumer = Consumer::factory()->create();

        $response = $this->actingAs($consumer, 'consumer')->patchJson('api/consumer/updateDetails/' . $consumer->id, [
            'name' => 'User Name',
            'email' => 'user@email.com',
        ]);

        $response->assertOK();
    }

         /**
     * Update consumer password test.
     *
     * @return void
     */
    public function test_edit_consumer_password_()
    {
        $consumer = Consumer::factory()->create();

        $response = $this->actingAs($consumer, 'consumer')->patchJson('api/consumer/updatePassword/' . $consumer->id, [
            'current_password' => 'password',
            'password' => 'password2',
            'password_confirmation' => 'password2'
        ]);

        $response->assertOK();
    }
}

