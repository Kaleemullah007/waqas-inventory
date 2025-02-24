<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductionHistory;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionHistoryFactory extends Factory
{
    protected $model = ProductionHistory::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'purchase_id' => Purchase::factory(),
            'qty' => $this->faker->numberBetween(10, 50),
            'wastage_qty' => $this->faker->numberBetween(1, 10),
            'owner_id' => 1,
        ];
    }
}
