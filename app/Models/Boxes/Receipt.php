<?php

namespace App\Models\Boxes;

use App\Models\Patients\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $table="receipts";
    protected $guarded=[];

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function fundshedule(){
        return $this->hasMany(Fund_Schedule::class,'receipt_id','id');
    }
    public function patientAccount(){
        return $this->hasMany(PatientAccount::class,'receipt_id','id');
    }
}
