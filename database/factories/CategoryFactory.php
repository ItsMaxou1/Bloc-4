<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;

class CategoryFactory extends Factory
{

    use HasFactory;
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => fake()->sentence(nbWords: 12),
        ];
    }
}