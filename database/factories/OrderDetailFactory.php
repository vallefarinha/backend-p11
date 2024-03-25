<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_id' => $this->faker->numberBetween(1, 6),
            'product_id' => $this->faker->numberBetween(1, 6),
            'product_quantity' => $this->faker->randomNumber(1, 50),
            'subtotal_order_detail' => $this->faker->randomFloat(2, 1, 100),
            'total_order_detail' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
