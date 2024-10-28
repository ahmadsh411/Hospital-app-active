<?php

namespace Database\Seeders;

use App\Models\Doctors\Doctor;
use Illuminate\Database\Seeder;

class DoctorAppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $app=\App\Models\Appointments\Appointment::all();
     $doctors=Doctor::all();

    }
}
