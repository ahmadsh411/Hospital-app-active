<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Appointments\Appointment as Ap;
class Appointment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->delete();
        $names = ['الجمعة', 'الخميس', 'الاربعاء', 'الثلاثاء', 'الاثنين', 'الاحد', 'السبت'];
        foreach ($names as $name) {
            Ap::create([
                'name' => $name,
            ]);
        }
    }
}
