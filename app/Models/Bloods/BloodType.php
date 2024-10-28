<?php

namespace App\Models\Bloods;

use App\Models\Patients\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    use HasFactory;

    protected $fillable=['type'];

    public function patients()
    {
        return $this->hasMany(Patient::class,'blood_id','id');
    }
}
