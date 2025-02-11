<?php

namespace Tests\Feature\Api\Consumer;

use App\Models\User;
use App\Models\Consumer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetConsumerTest extends TestCase
{
    use RefreshDatabase;
     /**
     * Get consumer test.
     *
     * @return void
     */
    public function test_get_consumer_()
    {
        $user = User::factory()->create();
        $consumer = Consumer::factory()->create();

        $response = $this->actingAs($user)->getJson('api/consumer/show/' . $consumer->id);
        $response->assertOk();
        $response->assertJson(
            [
                'data' => [
                    'id' => $consumer->id,
                    'name' => $consumer->name,
                    'email' => $consumer->email,
                ],
            ]
        );
    }

     /**
     * Get current user test.
     *
     * @return void
     */
    public function test_get_current_consumer_()
    {
        $consumer = Consumer::factory()->create();

        $response = $this->actingAs($consumer, 'consumer')->getJson('api/consumer/getUser');
        $response->assertOk();
        $response->assertJson(
            [
                'data' => [
                    'id' => $consumer->id,
                    'name' => $consumer->name,
                    'email' => $consumer->email,
                ],
            ]
        );
    }

     /**
     * Get user list test.
     *
     * @return void
     */
    public function test_get_consumers_()
    {
        $user = User::factory()->create();

        Consumer::factory(50)->create();

        $response = $this->actingAs($user)->getJson('api/consumer');
        $response->assertOk();
        $response->assertJsonCount(30, 'data.*');
    }
}

