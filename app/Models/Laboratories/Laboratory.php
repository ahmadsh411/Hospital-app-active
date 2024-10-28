<?php

namespace App\Models\Laboratories;

use App\Models\Doctors\Doctor;
use App\Models\Images\Image;
use App\Models\Invoices\OneTable\Invoice;
use App\Models\Patients\Patient;
use App\Models\Staffs\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    protected  $fillable=['description','invoice_id','doctor_id','patient_id','status','staff_id'
        ,'staff_description','staff_name','staff_date'];

    public function  patient(){

        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function invoice(){

        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
    public function  doctor(){

        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }

    public function image(){

        return $this->morphOne(Image::class,'imageable');

    }

    public function stuff()
    {
        return $this->belongsTo(Staff::class,'staff_id','id');
    }
}
