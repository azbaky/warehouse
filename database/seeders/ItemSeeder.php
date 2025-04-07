<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('items')->insert([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'location' => $faker->address,
                'category_id' => $faker->numberBetween(1, 10), // Assuming you have categories with IDs from 1 to 10
                'quantity' => $faker->numberBetween(1, 100),
                'unit_price' => $faker->randomFloat(2, 1, 100), // Price between 1 and 100
                'reorder_level' => $faker->numberBetween(1, 20),
                'barcode' => $faker->ean13, // Generates a random EAN-13 barcode
                'created_at' => now(),
                'updated_at' => now(),
                'expiry_date' => $faker->dateTimeBetween('now', '+1 year'), // Expiry date within the next year
            ]);
        }
    }
}