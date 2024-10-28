<?php

namespace App\Models\Insurances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceTranslation extends Model
{
    use HasFactory;
    protected  $fillable=['company_name','notes','insurance_id'];
    public $timestamps=false;
}
