<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiServiceTranslation extends Model
{
    use HasFactory;
    protected $fillable=['name','notes'];
    public $timestamps=false;
}
