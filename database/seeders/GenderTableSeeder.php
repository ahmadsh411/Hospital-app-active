<?php

namespace Database\Seeders;

use App\Models\Genders\Gender; // افتراضًا أن هذا هو الموديل الرئيسي لـ Gender
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();
        $genders = [
            'male' => ['en' => 'Male', 'ar' => 'ذكر'],
            'feminine' => ['en' => 'Feminine', 'ar' => 'أنثى'],
        ];

        foreach ($genders as $key => $translations) {
            $gender = Gender::create(); // إنشاء السجل الرئيسي في جدول genders

            // إضافة الترجمات في جدول gender_translations
            foreach ($translations as $locale => $gender_name) {
                $gender->translations()->create([
                    'locale' => $locale,
                    'gender_name' => $gender_name,
                ]);
            }
        }
    }
}
