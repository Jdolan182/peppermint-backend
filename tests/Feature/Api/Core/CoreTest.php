<?php

namespace Tests\Feature\Api\Core;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class CoreTest extends TestCase
{
    use RefreshDatabase;

     /**
     * Dashboard stats test.
     *
     * @return void
     */
    public function test_dashbord_stats_()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('api/stats');

        $response->assertOk();
    }
}

