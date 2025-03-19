<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductVariant;

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
            'name' => $this->faker->word,
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'alcool_volume' => $this->faker->randomFloat(2, 4, 12),
            'category_id' => Category::count() ? Category::inRandomOrder()->first()->id : Category::factory(),
            'brand_id' => Brand::count() ? Brand::inRandomOrder()->first()->id : Brand::factory(),
            // 'image_url' => $this->faker->imageUrl(),
        ];

    }
}
