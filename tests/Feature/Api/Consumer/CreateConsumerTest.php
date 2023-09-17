<?php

namespace Tests\Feature\Api\Consumer;

use App\Models\User;
use App\Models\Consumer;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class CreateConsumerTest extends TestCase
{
    use RefreshDatabase;

     /**
     * Create consumer test.
     *
     * @return void
     */
    public function test_create_consumer_()
    {
        $user = User::factory()->create();
        $count = Consumer::count();

        $response = $this->actingAs($user)->postJson('api/consumer/signup', [
            'name' => 'User Name',
            'email' => 'user@email.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertCreated();
        $this->assertGreaterThan($count, Consumer::count(), 'Record has been created');
    }
}

