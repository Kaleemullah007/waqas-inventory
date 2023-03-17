<?php

namespace Database\Factories;

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
            'sale_price'=>rand(1,1000),
            'price'=>rand(1,1000),
            'name'=>$this->faker->name(),
            'stock'=>0,
            'stock_alert'=>5,
            'owner_id'=>1
        ];
    }
}
