<?php

namespace App\Models\Staffs;

use App\Models\Appointments\Appointment;
use App\Models\Genders\Gender;
use App\Models\Laboratories\Laboratory;
use App\Models\Rays\Ray;
use App\Models\Sections\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected  $guarded=[];

    protected $table='staff';

    protected $hidden = [
        'password',
        ];

    public  function gender()
    {
        return $this->belongsTo(Gender::class,'gender_id','id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id','id');
    }
    public function appointments()
    {
            return $this->belongsToMany(Appointment::class,'staff_appointments','staff_id','appointment_id');
    }

    public function rays()
    {
        return $this->hasMany(Ray::class,'staff_id','id');
    }

    public function laboratories(){
        return $this->hasMany(Laboratory::class,'staff_id','id');
    }




}
