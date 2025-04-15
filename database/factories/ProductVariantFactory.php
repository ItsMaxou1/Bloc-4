<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()?->id ?? Product::factory(),
            'format' => $this->faker->randomElement(['33cl', '50cl', '75cl']),
            'price' => $this->faker->randomFloat(2, 2, 15),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
