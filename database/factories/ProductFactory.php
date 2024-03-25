<?php

namespace Database\Factories;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->name,
            'slug' => $this->faker->name,
            'stock' => $this->faker->randomNumber(1, 50),
            'price_product' => $this->faker->randomFloat(2, 1, 100),
            'discounted_price_product' => $this->faker->randomFloat(2, 1, 100),
            'category' => $this->faker->randomElement(['Brincos', 'Colares', 'Pulseiras', 'Anéis', 'Casa']),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),

        ];
    }
}
