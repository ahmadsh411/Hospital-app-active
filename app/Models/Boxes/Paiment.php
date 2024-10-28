<?php

namespace App\Models\Boxes;

use App\Models\Invoices\OneTable\Invoice;
use App\Models\Patients\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiment extends Model
{
    use HasFactory;
    protected $table="paiments";
    protected $guarded=[];

    public function funcShedule(){

        return  $this->hasOne(Fund_Schedule::class,'paiment_id','id');
    }

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }

    public function patientAccounts(){
        return $this->hasMany(Paiment::class,'payment_id','id');
    }
}
