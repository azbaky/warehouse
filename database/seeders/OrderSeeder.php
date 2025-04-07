<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;



class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('orders')->insert([
                'total' => $faker->randomFloat(2, 10, 500), // Random total between 10 and 500
                'status' => $faker->randomElement(['pending', 'completed', 'overdue']), // Random status
                'payment_type' => $faker->randomElement(['credit_card', 'paypal', 'bank_transfer']), // Random payment type
                'date' => $faker->date(), // Random date
                'customer_id' => $faker->numberBetween(1, 3), // Assuming you have 50 customers
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    }

