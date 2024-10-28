<?php

namespace App\Models\Invoices\OneTable;

use App\Models\Boxes\Fund_Schedule;
use App\Models\Boxes\PatientAccount;
use App\Models\Diagnoses\Diagnosis;
use App\Models\Doctors\Doctor;
use App\Models\Laboratories\Laboratory;
use App\Models\NotesMedicals\Medical_Diagnosis;
use App\Models\Patients\Patient;
use App\Models\Rays\Ray;
use App\Models\Sections\Section;
use App\Models\Service\MultiService;
use App\Models\Service\SingleService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="invoices";

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }

    public function section(){
        return $this->belongsTo(Section::class,'section_id','id');
    }
    public function service(){
        return $this->belongsTo(SingleService::class,'service_id','id');
    }
    public function group(){
        return $this->belongsTo(MultiService::class,'group_id','id');
    }
    public function patientAccount(){
        return $this->hasMany(PatientAccount::class,'invoice_id','id');
    }
    public function FundSchedule(){
        return $this->hasMany(Fund_Schedule::class,'invoice_id','id');
    }
    public function Medical_Diagnosises(){
        return $this->hasMany(Diagnosis::class,'invoice_id','id');
    }
    public function rayes(){
        return $this->hasMany(Ray::class,'invoice_id','id');
    }

    public function laboratories()
    {
        return $this->hasMany(Laboratory::class,'invoice_id','id');
    }


}
