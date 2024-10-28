<?php

namespace Database\Seeders;

use App\Models\Bloods\BloodType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blood_types')->delete();
       $types=['A+','B+','AB+','O+','O-','AB-','A-','B-'];
       foreach ($types as $type){
           BloodType::create([
               'type'=>$type
           ]);
       }
    }
}
