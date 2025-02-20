<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>'Add New Purchase',
            'user_id' => 1,
            'qty' => 0,
            'price' => 0,
            'sale_price' => 0, // 20% markup
            'total' =>0,
            'owner_id' => 1,
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
