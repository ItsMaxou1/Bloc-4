<?php
// database/factories/OrderFactory.php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;    // ← Ajout du point-virgule manquant

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $statuses = ['pending', 'paid', 'shipped', 'cancelled'];

        return [
            'user_id' => User::factory(),
            'total_without_tax' => $this->faker->randomFloat(2, 10, 200),
            'tax_amount' => $this->faker->randomFloat(2, 1, 50),
            'total_included_tax' => function (array $attrs) {
                return $attrs['total_without_tax'] + $attrs['tax_amount'];
            },
            'status' => $this->faker->randomElement($statuses),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
