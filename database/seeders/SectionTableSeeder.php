<?php

namespace Database\Seeders;

use App\Models\Sections\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('sections')->delete();
        Section::factory(6)->create();
    }

}
