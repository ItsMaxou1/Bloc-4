<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    use HasFactory;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->sentence(10),
            'alcool_volume' => $this->faker->randomFloat(2, 4, 12),
            'category_id' => Category::count() ? Category::inRandomOrder()->first()->id : Category::factory(),
            'brand_id' => Brand::count() ? Brand::inRandomOrder()->first()->id : Brand::factory(),
            'image_url' => fake()->randomElement([
                'https://ih1.redbubble.net/image.5160944228.1058/raf,360x360,075,t,fafafa:ca443f4786.u6.jpg',
                'https://pictures.trbna.com/image/cfba80fb-24e6-4e1c-a911-57a8a0242358?width=1920&quality=70'
            ]),
        ];

    }
}
