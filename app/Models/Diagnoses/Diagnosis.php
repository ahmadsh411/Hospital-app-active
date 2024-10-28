<?php

namespace App\Models\Diagnoses;

use App\Models\Doctors\Doctor;
use App\Models\Invoices\OneTable\Invoice;
use App\Models\Patients\Patient;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['review_date','date', 'medicals', 'invoice_id', 'patient_id', 'doctor_id','diagnoses_notes'];


    // الحقول التي سيتم ترجمتها
    public $translatedAttributes = ['diagnoses_notes'];

    // العلاقات
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }
}
