<?php

namespace App\Models\Diagnoses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosisTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['locale', 'diagnosis_id', 'diagnoses_notes'];
}
