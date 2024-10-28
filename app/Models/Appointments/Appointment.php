<?php

namespace App\Models\Appointments;

use App\Models\Doctors\Doctor;
use App\Models\Staffs\Staff;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable=['name'];

    public $translatedAttributes=['name'];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctors_appointments');
    }

    public function staffs(){
        return $this->belongsToMany(Staff::class,'staff_appointments','appointment_id','staff_id');
    }
}
