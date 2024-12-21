<?php
namespace Database\Factories\Patients;

use App\Models\Bloods\BloodType;
use App\Models\Genders\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;

class patientFactory extends Factory{

    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'email'=>$this->faker->unique()->safeEmail(),
            'id_number'=>$this->faker->unique()->randomNumber(9),
            'phone'=>$this->faker->phoneNumber(),
            'date_of_birth' => $this->faker->date('Y-m-d'), // صيغة تاريخ الميلاد,
            'gender_id'=>Gender::all()->random()->id,
            'blood_id'=>BloodType::all()->random()->id,
            'address'=>$this->faker->address(),
            ];
    }
}
