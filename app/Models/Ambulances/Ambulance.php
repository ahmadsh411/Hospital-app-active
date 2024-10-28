<?php

namespace App\Models\Ambulances;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory,Translatable;
    protected $guarded=[];

    public $translatedAttributes=['name','notes'];
}
