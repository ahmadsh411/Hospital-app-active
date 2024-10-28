<?php

namespace App\Models\Doctors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorTranslation extends Model
{
    use HasFactory;

     protected  $fillable=['name'];

    public  $timestamps=false;
}

