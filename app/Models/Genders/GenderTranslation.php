<?php

namespace App\Models\Genders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenderTranslation extends Model
{
    use HasFactory;
    protected $fillable=['gender_name'];
    public  $timestamps=false;
}
