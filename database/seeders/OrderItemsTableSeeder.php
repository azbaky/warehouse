<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;



class OrderItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Assuming you have existing orders and items
        $orders = \App\Models\Order::pluck('id')->toArray();
        $items = \App\Models\Item::pluck('id')->toArray();

        foreach (range(1, 50) as $index) { // Generate 50 fake order items
            DB::table('order_items')->insert([
                'item_id' => $faker->randomElement($items),
                'order_id' => $faker->randomElement($orders),
                'quantity' => $faker->numberBetween(1, 10), // Random quantity between 1 and 10
                'price' => $faker->randomFloat(2, 1, 100), // Random price between 1 and 100
                'total' => $faker->randomFloat(2, 1, 1000), // Random total between 1 and 1000
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    }

