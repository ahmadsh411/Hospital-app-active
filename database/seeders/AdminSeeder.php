<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('admins')->delete();
            Admin::create([
                'name' => 'admin',
                'email' => 'admin@admin',
                'email_verified_at' => now(),
                'password' => Hash::make('123123123'), // password
                'remember_token' => STr::random(10),
            ]);
    }
}
