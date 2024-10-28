<?php

namespace App\Models\Appointments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTranslation extends Model
{
    use HasFactory;
    protected $fillable=['name','appointment_id'];
    public $timestamps=false;
}
