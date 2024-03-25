<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    // use RefreshDatabase;

    public function test_users_can_authenticate_using_the_login_screen(): void
    {

        // Attempt login
        $response = $this->post('/login', [
            'email' => 'maybell.anderson@example.org',
            'password' => 'password', // Use the actual password here
        ]);

        // Debug: Print the response content
        var_dump($response->getContent());

        // Check authentication status
        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }


    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson(route('logout'));

        $response->assertStatus(200);

        $this->assertGuest();
    }
}
