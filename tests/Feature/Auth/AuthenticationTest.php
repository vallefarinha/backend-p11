<?php

namespace Tests\Feature\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    // use RefreshDatabase;
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
<<<<<<< HEAD

        // Attempt login
        $response = $this->post('/login', [
            'email' => 'maybell.anderson@example.org',
            'password' => 'password', // Use the actual password here
=======
        $response = $this->post('/login', [
            'email' => 'toy.hermina@example.net',
            'password' => '$2y$04$t75RjzKQFMNK3ftv/9li6ed7r2awQ.oq0/sXnXvuHDq3q3OrWKPnK',
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5
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
            'email' => 'luciana@gmail.com',
            'password' => '1234567',
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
