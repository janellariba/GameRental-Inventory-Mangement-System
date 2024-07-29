<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //For Testing [Item Generator]
        return [
            // 'item_name' => fake()->word(),
            // 'item_brand' => fake()->word(),
            // 'item_category' => fake()->word(),
            // 'item_quantity' => fake()->numberBetween($min = 20, $max=100),
            // 'item_status' => fake()->word(),
        ];
    }
}
