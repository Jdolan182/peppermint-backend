<?php

namespace Tests\Feature\Api\Consumer;

use App\Models\User;
use App\Models\Consumer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteConsumerTest extends TestCase
{
    use RefreshDatabase;
     /**
     * Delete consumer test.
     *
     * @return void
     */
    public function test_delete_consumer_()
    {
        $user = User::factory()->create();
        $consumer = Consumer::factory()->create();

        $response = $this->actingAs($user)->deleteJson('api/consumer/delete/' . $consumer->id);
        $response->assertOk();
        $response->assertJson(
            [
                'status' => true,
                'message' => 'Consumer Deleted'
            ]
        );
    }
}

