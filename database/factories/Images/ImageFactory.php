<?php

namespace Database\Factories\Images;

use App\Models\Doctors\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'filename'=>$this->faker->randomElement(['1.jpg','2.jpg','3.jpg','4.jpg']),
            'imageable_id'=>Doctor::all()->random()->id,
            'imageable_type'=> 'App\Models\Doctors\Doctor'
        ];
    }
}
