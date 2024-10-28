<?php

namespace App\Models\Boxes;

use App\Models\Invoices\SingleInvoice;
use App\Models\Boxes\Paiment;
use App\Models\Invoices\Group_Invoice;
use App\Models\Invoices\OneTable\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund_Schedule extends Model
{
    use HasFactory;
    protected   $table='fund_schedules';
    protected $guarded=[];

    public function singleInvoice(){
        return $this->belongsTo(SingleInvoice::class,'single_invoice_id','id');
    }

    public function receipt(){
        return $this->belongsTo(Receipt::class,'receipt_id','id');
    }

    public function payment(){
        return $this->belongsTo(Paiment::class,'paiment_id','id');
    }
    public function groupInvoice(){
        return $this->belongsTo(Group_Invoice::class,'group_invoice_id','id');
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }

    public function section_invoices(){
        return $this->hasMany(Invoice::class,'section_id','id');
    }
}
