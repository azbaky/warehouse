<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //

        'car_num'=>$this->faker->numberBetween(70, 777),
        'car_name'=>$this->faker->word,
        'car_status'=>$this->faker->boolean(35),
        'made_in'=>$this->faker->word
            
        ];
    }
}
