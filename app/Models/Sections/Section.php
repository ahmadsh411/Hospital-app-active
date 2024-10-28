<?php

namespace App\Models\Sections;

use App\Models\Doctors\Doctor;
use App\Models\Invoices\OneTable\Invoice;
use App\Models\Invoices\SingleInvoice;
use App\Models\Staffs\Staff;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    use Translatable;
   protected $fillable=['name','description'];
    public $translatedAttributes = ['name','description'];

    public function doctors()
    {
       return $this->hasMany(Doctor::class,'section_id','id');
    }
    public function invoces(){
        return $this->hasMany(SingleInvoice::class,'section_id','id');
    }
    public function section_invoices(){
        return $this->hasMany(Invoice::class,'section_id','id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class,'section_id','id');
    }



}
