<?php

namespace Tests\Feature\Api\Consumer;

use App\Models\User;
use App\Models\Consumer;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

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

