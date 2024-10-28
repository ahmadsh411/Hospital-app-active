<?php

namespace App\Models\Invoices;

use App\Models\Boxes\Fund_Schedule;
use App\Models\Boxes\PatientAccount;
use App\Models\Doctors\Doctor;
use App\Models\Patients\Patient;
use App\Models\Sections\Section;
use App\Models\Service\MultiService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_Invoice extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }

    public function section(){
        return $this->belongsTo(Section::class,'section_id','id');
    }

    public function patientAccount(){
        return $this->hasMany(PatientAccount::class,'group_invoice_id','id');
    }
    public function FundSchedule(){
        return $this->hasMany(Fund_Schedule::class,'group_invoice_id','id');
    }

    public function multiservice(){
        return $this->belongsTo(MultiService::class,'group_id','id');
    }
}
