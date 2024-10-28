<?php

namespace Database\Factories\Service;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SingleServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>    $this->faker->name(),
            'description'=>$this->faker->paragraph(),
            'price'=>$this->faker->randomElement(['350','400','500','1600']),
            'status'=>$this->faker->randomElement(['0','1']),



        ];
    }
}
