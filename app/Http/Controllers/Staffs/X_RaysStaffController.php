<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use App\Models\Invoices\OneTable\Invoice;
use App\Models\Rays\Ray;
use App\Traits\UploadImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class X_RaysStaffController extends Controller
{
    use UploadImage;

     public function  index()
     {
         $invoices=Invoice::all();
         return view('Dashboard.Staffs.X_Rays.index',compact('invoices'));
     }

     public function edit($id)
     {
         $ray=Ray::findOrFail($id);
         return view('Dashboard.Staffs.X_Rays.edit',compact('ray'));
     }

     public function update( $id,Request $request,){

         try{
             DB::beginTransaction();
             $ray=Ray::find($id);
             $ray->status=1;
             $ray->staff_id=auth('staff')->user()->id;
             $ray->staff_description=$request->staff_description;
             $ray->staff_name=auth('staff')->user()->name;
             $ray->staff_date=Carbon::now()->format('Y-m-d');
             $ray->save();


             $this->verifyAndStoreImage($request, 'image',
                 'x-rays/'.$ray->patient->name.'/'.
                '/Ready/'.$ray->staff_name.'/'.$ray->id, 'upload_image',
                 $ray->id, 'App\Models\Rays\Ray');


             DB::commit();
             toastr()->success('تم ارفاق الصور بنجاح ');

             return redirect()->route('staff.x-rays');




         }catch (Exception $e){
             DB::rollBack();
             return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
         }



     }
}
