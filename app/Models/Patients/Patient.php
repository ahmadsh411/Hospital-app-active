<?php

namespace App\Models\Patients;

use App\Models\Bloods\BloodType;
use App\Models\Boxes\Paiment;
use App\Models\Boxes\PatientAccount;
use App\Models\Boxes\Receipt;
use App\Models\Diagnoses\Diagnosis;
use App\Models\Genders\Gender;
use App\Models\Invoices\OneTable\Invoice;
use App\Models\Invoices\SingleInvoice;
use App\Models\Laboratories\Laboratory;
use App\Models\NotesMedicals\Medical_Diagnosis;
use App\Models\Rays\Ray;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory,Translatable;
    protected $guarded=[];

    public $translatedAttributes=['name','address'];

    public function gender()
    {
        return $this->belongsTo(Gender::class,'gender_id','id');
    }
    public function bloodtype()
    {
        return $this->belongsTo(BloodType::class,'blood_id','id');
    }
    public function invoces(){
        return $this->hasMany(SingleInvoice::class,'patient_id','id');
    }
    public function patientAccount(){
        return $this->hasMany(PatientAccount::class,'patient_id','id');
    }
    public function receipt(){
        return $this->hasMany(Receipt::class,'patient_id','id');
    }
    public function paiments(){
        return $this->hasMany(Paiment::class,'patient_id','id');
    }
    public function invoices(){
        return $this->hasMany(Invoice::class,'patient_id','id');
    }
    public function Medical_Diagnosises(){
        return $this->hasMany(Diagnosis::class,'patient_id','id');
    }
    public function rayes(){
        return $this->hasMany(Ray::class,'patient_id','id');
    }
    public function laboratories()
    {
        return $this->hasMany(Laboratory::class,'patient_id','id');
    }


}
