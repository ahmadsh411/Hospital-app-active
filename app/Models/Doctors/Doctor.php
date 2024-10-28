<?php

namespace App\Models\Doctors;

use App\Models\Appointments\Appointment;
use App\Models\Diagnoses\Diagnosis;
use App\Models\Images\Image;
use App\Models\Invoices\OneTable\Invoice;
use App\Models\Invoices\SingleInvoice;
use App\Models\Laboratories\Laboratory;
use App\Models\NotesMedicals\Medical_Diagnosis;
use App\Models\Rays\Ray;
use App\Models\Sections\Section;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasFactory;
    use Translatable,Notifiable,HasApiTokens;
    protected  $table='doctors';
    protected $fillable=['section_id','name','email','password','email_verified_at','phone_number'];

    public $translatedAttributes=['name'];

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
    public function section()
    {
        return $this->belongsTo(Section::class,'section_id','id');
    }
    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'doctors_appointments');
    }
    public function invoces(){
        return $this->hasMany(SingleInvoice::class,'doctor_id','id');
    }
    public function allinvoices(){
        return $this->hasMany(Invoice::class,'doctor_id','id');
    }
    public function Medical_Diagnosises(){
        return $this->hasMany(Diagnosis::class,'doctor_id','id');
    }
    public function rayes(){
        return $this->hasMany(Ray::class,'doctor_id','id');
    }
    public function laboratories(){
        return $this->hasMany(Laboratory::class,'doctor_id','id');
    }

       /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
