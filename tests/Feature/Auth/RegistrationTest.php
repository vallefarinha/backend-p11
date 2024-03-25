<?php

namespace Tests\Feature\Auth;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    // use RefreshDatabase;

    public function test_new_users_can_register()
    {
        $response = $this->postJson(route('register'), [
            'name' => 'Test User',
            'email' => 'email000@example.com',
            'address' => '123 Test St',
            'phone' => '123456789',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
    }
}