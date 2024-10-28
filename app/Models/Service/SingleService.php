<?php

namespace App\Models\Service;

use App\Models\Invoices\OneTable\Invoice;
use App\Models\Invoices\SingleInvoice;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleService extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable=['price','name','single_service_id','name','description','status'];
    protected  $table='single_services';

    public $translatedAttributes=['name','description'];

    public function service_group()
    {
        return $this->belongsToMany(SingleService::class, 'service_groups', 'service_id', 'group_id')
            ->withPivot('quantity');
    }
    public function invoces(){
        return $this->hasMany(SingleInvoice::class,'service_id','id');
    }
    public function invoices(){
        return $this->hasMany(Invoice::class,'service_id','id');
    }

}
