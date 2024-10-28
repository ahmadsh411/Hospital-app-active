<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            AdminSeeder::class,
            BloodTableSeeder::class,
            GenderTableSeeder::class,
            SectionTableSeeder::class,
            Appointment::class,
            DoctorTableSeeder::class,
            ImageTableSeeder::class,
        ]);

    }
}
