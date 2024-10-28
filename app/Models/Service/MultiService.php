<?php

namespace App\Models\Service;

use App\Models\Invoices\Group_Invoice;
use App\Models\Invoices\OneTable\Invoice;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiService extends Model
{
    use HasFactory,Translatable;
    protected $fillable=['name','notes','total_before_discount','discount_value','total_after_discount','tax_rate','total_with_tax','quantity'];
    protected $table='multi_services';

    public $translatedAttributes=['name','notes'];

    public function service_group()
    {
        return $this->belongsToMany(SingleService::class, 'service_groups', 'group_id', 'service_id')
            ->withPivot('quantity'); // إضافة الـ quantity من الجدول الوسيط
    }

    public function groupInvoice(){
        return $this->hasMany(Group_Invoice::class,'group_id','id');
    }

    public function invoices(){
        return $this->hasMany(Invoice::class,'group_id','id');
    }


}
