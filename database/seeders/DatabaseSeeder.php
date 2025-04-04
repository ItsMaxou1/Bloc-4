<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'remember_token' => null,
            'email_verified_at' => now(),
        ]);


        // Création des catégories et marques
        User::factory(10)->create();
        Category::factory(10)->create();
        Product::factory(10)->create();
        Brand::factory(10)->create();


    }
}
