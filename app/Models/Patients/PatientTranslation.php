<?php

namespace App\Models\Patients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTranslation extends Model
{
    use HasFactory;
    protected $fillable=['name','address'];
    public $timestamps=false;
}
