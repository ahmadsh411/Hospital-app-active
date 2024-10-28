<?php

namespace Database\Factories\Sections;


use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
           'name'=>$this->faker->unique()->randomElement(['قسم العظام','المخبر','قسم الاشعة','قسم الاطفال','قسم المخ والاعصاب','قسم الجراحة']),
            'description'=>$this->faker->unique()->paragraph(),
        ];
    }
}
