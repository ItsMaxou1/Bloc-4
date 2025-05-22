<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ShopDataSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // 1) Désactivation des FK pour tout le bloc
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 2) Vidage des tables, dans l'ordre "enfants" d'abord
        DB::table('product_variants')->truncate();
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::table('brands')->truncate();

        // 1) Marques
        DB::table('brands')->insert([
            ['id' => 1, 'name' => 'Mousstache', 'logo_url' => 'mousstachelogo.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Mountain Bear', 'logo_url' => 'mountainbearlogo.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Storm Brew', 'logo_url' => 'stormbrewlogo.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'Dark Beer', 'logo_url' => 'darkbeerlogo.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'Happy Valley', 'logo_url' => 'happyvalleylogo.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'Buffalo Power', 'logo_url' => 'buffalopowerlogo.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'name' => 'Clockwork Brew', 'logo_url' => 'clockworkbrewlogo.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'name' => 'Lucky Brew', 'logo_url' => 'luckybrewlogo.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'name' => 'Moustache', 'logo_url' => 'moustachelogo.png', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 2) Catégories
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Blonde', 'description' => '', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Brune', 'description' => '', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Rousse', 'description' => '', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'IPA', 'description' => '', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 3) Produits
        DB::table('products')->insert([
            ['id' => 1, 'name' => 'Golden Moose', 'short_description' => '', 'description' => '', 'alcool_volume' => 5.20, 'category_id' => 1, 'brand_id' => 2, 'image_url' => 'Goldenmoose.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Sunny Draft', 'short_description' => '', 'description' => '', 'alcool_volume' => 5.00, 'category_id' => 1, 'brand_id' => 5, 'image_url' => 'Sunnydraft.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Buffalo Light', 'short_description' => '', 'description' => '', 'alcool_volume' => 4.10, 'category_id' => 1, 'brand_id' => 6, 'image_url' => 'Buffalolight.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'Happy Sun Ale', 'short_description' => '', 'description' => '', 'alcool_volume' => 5.30, 'category_id' => 1, 'brand_id' => 8, 'image_url' => 'Happysunale.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'Dark Fang', 'short_description' => '', 'description' => '', 'alcool_volume' => 6.80, 'category_id' => 2, 'brand_id' => 4, 'image_url' => 'Darkfang.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'Bear Brew Black', 'short_description' => '', 'description' => '', 'alcool_volume' => 7.20, 'category_id' => 2, 'brand_id' => 2, 'image_url' => 'Bearbrewblack.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'name' => 'Smoky Clock', 'short_description' => '', 'description' => '', 'alcool_volume' => 6.50, 'category_id' => 2, 'brand_id' => 7, 'image_url' => 'Smokyclock.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'name' => 'Midnight Power', 'short_description' => '', 'description' => '', 'alcool_volume' => 7.00, 'category_id' => 2, 'brand_id' => 6, 'image_url' => 'MidnightPower.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'name' => 'Red Valley', 'short_description' => '', 'description' => '', 'alcool_volume' => 5.60, 'category_id' => 3, 'brand_id' => 5, 'image_url' => 'Redvalley.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'Amber Brewstorm', 'short_description' => '', 'description' => '', 'alcool_volume' => 5.80, 'category_id' => 3, 'brand_id' => 3, 'image_url' => 'Amberbrewstorm.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'name' => 'Lucky Flame', 'short_description' => '', 'description' => '', 'alcool_volume' => 5.40, 'category_id' => 3, 'brand_id' => 8, 'image_url' => 'LuckyFlame.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 12, 'name' => 'Fire Moustache', 'short_description' => '', 'description' => '', 'alcool_volume' => 6.00, 'category_id' => 3, 'brand_id' => 9, 'image_url' => 'Firemoustache.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 13, 'name' => 'Storm Hop', 'short_description' => '', 'description' => '', 'alcool_volume' => 6.50, 'category_id' => 4, 'brand_id' => 3, 'image_url' => 'Stormhop.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 14, 'name' => 'Clockwork IPA', 'short_description' => '', 'description' => '', 'alcool_volume' => 7.00, 'category_id' => 4, 'brand_id' => 7, 'image_url' => 'Clockworkipa.png', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 15, 'name' => 'Wild Mountain IPA', 'short_description' => '', 'description' => '', 'alcool_volume' => 6.80, 'category_id' => 4, 'brand_id' => 2, 'image_url' => 'Wildmountainipa.png', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 4) Variantes
        DB::table('product_variants')->insert([
            // Golden Moose
            ['product_id' => 1, 'format' => '33cl', 'price' => 3.43, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 1, 'format' => '50cl', 'price' => 5.20, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 1, 'format' => '70cl', 'price' => 7.28, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Sunny Draft
            ['product_id' => 2, 'format' => '33cl', 'price' => 3.30, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 2, 'format' => '50cl', 'price' => 5.00, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 2, 'format' => '70cl', 'price' => 7.00, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Buffalo Light
            ['product_id' => 3, 'format' => '33cl', 'price' => 2.71, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 3, 'format' => '50cl', 'price' => 4.10, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 3, 'format' => '70cl', 'price' => 5.74, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Happy Sun Ale
            ['product_id' => 4, 'format' => '33cl', 'price' => 3.50, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 4, 'format' => '50cl', 'price' => 5.30, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 4, 'format' => '70cl', 'price' => 7.42, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Dark Fang
            ['product_id' => 5, 'format' => '33cl', 'price' => 2.84, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 5, 'format' => '50cl', 'price' => 4.30, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 5, 'format' => '70cl', 'price' => 6.02, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Bear Brew Black
            ['product_id' => 6, 'format' => '33cl', 'price' => 4.75, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 6, 'format' => '50cl', 'price' => 7.20, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 6, 'format' => '70cl', 'price' => 10.08, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Smoky Clock
            ['product_id' => 7, 'format' => '33cl', 'price' => 4.29, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 7, 'format' => '50cl', 'price' => 6.50, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 7, 'format' => '70cl', 'price' => 9.10, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Midnight Power
            ['product_id' => 8, 'format' => '33cl', 'price' => 4.62, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 8, 'format' => '50cl', 'price' => 7.00, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 8, 'format' => '70cl', 'price' => 9.80, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Red Valley
            ['product_id' => 9, 'format' => '33cl', 'price' => 3.70, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 9, 'format' => '50cl', 'price' => 5.60, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 9, 'format' => '70cl', 'price' => 7.84, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Amber Brewstorm
            ['product_id' => 10, 'format' => '33cl', 'price' => 3.83, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 10, 'format' => '50cl', 'price' => 5.80, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 10, 'format' => '70cl', 'price' => 8.12, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Lucky Flame
            ['product_id' => 11, 'format' => '33cl', 'price' => 3.56, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 11, 'format' => '50cl', 'price' => 5.40, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 11, 'format' => '70cl', 'price' => 7.56, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Fire Moustache
            ['product_id' => 12, 'format' => '33cl', 'price' => 3.96, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 12, 'format' => '50cl', 'price' => 6.00, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 12, 'format' => '70cl', 'price' => 8.40, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Storm Hop
            ['product_id' => 13, 'format' => '33cl', 'price' => 4.29, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 13, 'format' => '50cl', 'price' => 6.50, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 13, 'format' => '70cl', 'price' => 9.10, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Clockwork IPA
            ['product_id' => 14, 'format' => '33cl', 'price' => 4.62, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 14, 'format' => '50cl', 'price' => 7.00, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 14, 'format' => '70cl', 'price' => 9.80, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            // Wild Mountain IPA
            ['product_id' => 15, 'format' => '33cl', 'price' => 4.49, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 15, 'format' => '50cl', 'price' => 6.80, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['product_id' => 15, 'format' => '70cl', 'price' => 9.52, 'stock' => 100, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 6) Réactivation des FK
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}