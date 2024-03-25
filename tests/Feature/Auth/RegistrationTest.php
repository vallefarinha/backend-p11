<?php

namespace Tests\Feature\Auth;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    // use RefreshDatabase;

    public function test_new_users_can_register()
    {
<<<<<<< HEAD
        $response = $this->postJson(route('register'), [
            'name' => 'Test User',
            'email' => 'email000@example.com',
            'address' => '123 Test St',
            'phone' => '123456789',
=======
        $faker = Faker::create();
        $response = $this->post('/register', [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'address' => '123 calle',
            'phone' => '12346564',
            'rol_id' => 1,
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
    }
}