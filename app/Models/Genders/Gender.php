<?php

namespace App\Models\Genders;

use App\Models\Patients\Patient;
use App\Models\Staffs\Staff;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory,Translatable;
    protected  $fillable=['gender_name'];
    public  $timestamps=false;

    public $translatedAttributes=['gender_name'];

    public function patients()
    {
        return $this->hasMany(Patient::class,'gender_id','id');
    }
    public function satffs(){
        return $this->hasMany(Staff::class,'gender_id','id');
    }
}
