<?php

namespace Database\Seeders;

use App\Models\Patients\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->delete();
        Patient::factory(10)->create();
    }
}
