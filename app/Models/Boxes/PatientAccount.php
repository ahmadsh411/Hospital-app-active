<?php

namespace App\Models\Boxes;

use App\Models\Invoices\Group_Invoice;
use App\Models\Invoices\SingleInvoice;
use App\Models\Patients\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    use HasFactory;

    protected  $table="patient_accounts";
    protected  $guarded=[];
    public function singleInvoice(){
        return $this->belongsTo(SingleInvoice::class,'single_invoice_id','id');
    }
    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }

    public function payment(){
        return $this->belongsTo(Paiment::class,'payment_id','id');
    }
    public function receipt(){
        return $this->belongsTo(Receipt::class,'receipt_id','id');
    }
    public function groupInvoice(){
        return $this->belongsTo(Group_Invoice::class,'group_invoice_id','id');
    }
}
