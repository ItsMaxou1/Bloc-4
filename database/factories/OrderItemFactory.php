<?php
// database/factories/OrderItemFactory.php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        $variant = ProductVariant::inRandomOrder()->first()
            ?? ProductVariant::factory()->create();

        return [
            'order_id' => null, // sera fixé dans le seeder
            'product_variant_id' => $variant->id,
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $variant->price,
        ];
    }
}

