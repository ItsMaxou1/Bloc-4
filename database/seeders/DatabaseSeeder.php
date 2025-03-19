<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductVariant;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        // Création des catégories et marques
        Category::factory(10)->create();
        Brand::factory(10)->create();

        // Création des produits avec leurs variantes
        Product::factory(30)->create()->each(function ($product) {
            ProductVariant::factory()->create([
                'product_id' => $product->id
            ]);
        });

    }
}
