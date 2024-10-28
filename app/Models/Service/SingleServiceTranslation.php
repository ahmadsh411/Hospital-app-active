<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleServiceTranslation extends Model
{
    use HasFactory;
    protected $fillable=['name','description'];
    public  $timestamps=false;
}
