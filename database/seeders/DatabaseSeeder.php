<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pizza;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Database\Factories\OrderFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        $order = Order::factory()->create();
        Pizza::factory(3)->create([
            'order_id' => $order->id,
        ]);

        $order = Order::factory()->create();
        Pizza::factory(2)->create([
            'order_id' => $order->id,
        ]);

        Pizza::factory()->create();
    }
}
