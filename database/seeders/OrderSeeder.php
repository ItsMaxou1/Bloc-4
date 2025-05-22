<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::factory()
            ->count(20)
            ->create()
            ->each(function ($order) {
                OrderItem::factory()
                    ->count(rand(1, 5))
                    ->state(['order_id' => $order->id])
                    ->create();
            });
    }
}
