<?php

namespace Database\Factories\Doctors;

use App\Models\Appointments\Appointment;
use App\Models\Doctors\Doctor;
use App\Models\Sections\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model=Doctor::class;
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone_number'=>$this->faker->phoneNumber(),

            'name'=>$this->faker->name(),
//            'appointments'=>$this->faker->randomElement(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']),
            'status'=>$this->faker->randomElement([1,0]),
            'section_id'=>Section::all()->random()->id,
//
        ];
    }

}
