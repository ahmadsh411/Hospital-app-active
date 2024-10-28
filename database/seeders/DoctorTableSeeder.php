<?php

namespace Database\Seeders;

use App\Models\Doctors\Doctor;
use Illuminate\Database\Seeder;
use App\Models\Appointments\Appointment;
class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Doctors\Doctor::factory(30)->create();
       $Appointments=Appointment::all();
       Doctor::all()->each(function ($doctor) use($Appointments){
           $doctor->appointments()->attach($Appointments->random(rand(1,7))->pluck('id')->toArray());
       });

//       Doctor::all()->each(function ($doctor) use($Appointments){
//          $doctor->appointments()->attach($Appointments->
//          random(rand(1,7))->pluck('id')->toArray());
//       });

    }
}
