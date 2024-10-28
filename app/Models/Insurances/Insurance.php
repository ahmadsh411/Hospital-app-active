<?php

namespace App\Models\Insurances;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory,Translatable;
    protected  $fillable=['company_code','company_email','patient_tolerance','company_rate','status'
    ,'company_name','notes'
    ];

    public $translatedAttributes=['company_name','notes'];
}
