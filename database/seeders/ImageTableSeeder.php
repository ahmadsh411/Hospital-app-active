<?php

namespace Database\Seeders;

use App\Models\Images\Image;
use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Image::factory(30)->create();
    }
}
