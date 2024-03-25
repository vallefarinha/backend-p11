<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['Processing', 'Cancelled', 'Confirmed', 'Shipping', 'Delivered']),
            'user_id' => $this->faker->numberBetween(1, 6),
            'quantity' => $this->faker->randomNumber(1, 50),
            'subtotal_cart' => $this->faker->randomFloat(2, 1, 100),
            'total_cart' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
