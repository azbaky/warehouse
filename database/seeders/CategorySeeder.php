<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\category;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Category::factory(20)->create();
        $faker = Faker::create();

        // Generate 50 fake products
        for ($i = 0; $i < 50; $i++) {
            DB::table('categories')->insert([
                'name' => $faker->word, // Random word as product name
                'description' => $faker->sentence, // Random sentence as description
                'status' => $faker->boolean, // Random boolean for status
                'created_at' => now(), // Current timestamp
                'updated_at' => now(), // Current timestamp
            ]);
        }
    }
        
    }

