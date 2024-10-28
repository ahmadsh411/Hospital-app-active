<?php

namespace App\Models\Ambulances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbulanceTranslation extends Model
{
    use HasFactory;
    protected $fillable=['name','notes'];
    public $timestamps=false;
}
