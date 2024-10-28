<?php

namespace Database\Seeders;

use App\Models\Service\SingleService;
use Illuminate\Database\Seeder;

class SingleServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SingleService::factory(30)->create();
    }
}
