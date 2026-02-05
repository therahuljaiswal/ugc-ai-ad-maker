<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlockedUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_blocked_user_cannot_access_dashboard()
    {
        $user = User::factory()->create([
            'is_blocked' => true,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_unblocked_user_can_access_dashboard()
    {
        $user = User::factory()->create([
            'is_blocked' => false,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }
}
