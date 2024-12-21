<?php

namespace App\Http\Controllers\Staffs;

use App\Events\Ready_xRays;
use App\Http\Controllers\Controller;
use App\Mail\Response_X_Ray;
use App\Models\Invoices\OneTable\Invoice;
use App\Models\Notifications\Notification;
use App\Models\Rays\Ray;
use App\Traits\UploadImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\never;

class X_RaysStaffController extends Controller
{
    use UploadImage;

    public function index()
    {
        $invoices = Invoice::all();
        return view('Dashboard.Staffs.X_Rays.index', compact('invoices'));
    }

    public function edit($id)
    {
        $ray = Ray::findOrFail($id);
        return view('Dashboard.Staffs.X_Rays.edit', compact('ray'));
    }

    public function update($id, Request $request)
    {

        try {
            DB::beginTransaction();
            $ray = Ray::find($id);
            $ray->status = 1;
            $ray->staff_id = auth('staff')->user()->id;
            $ray->staff_description = $request->staff_description;
            $ray->staff_name = auth('staff')->user()->name;
            $ray->staff_date = Carbon::now()->format('Y-m-d');
            $ray->save();


            // إنشاء طلب مؤقت للصورة
            // استدعاء التابع verifyAndStoreImage لكل صورة
            $this->verifyAndStoreImages(
                $request,
                'image', // اسم الحقل المؤقت
                'x-rays/' . $ray->patient->name . '/Ready/' . $ray->staff_name . '/' . $ray->id, // مسار الحفظ
                'upload_image', // اسم الديسك
                $ray->id, // imageable_id
                'App\Models\Rays\Ray' // imageable_type
            );

            //ارسال اشعار للدكتور بان الاشعه اصبحت جاهزه
            $notification=new Notification();
            $notification->user_id=$ray->doctor->id;
            $notification->message='تم انجاز الطلب الاشعاعي  '.$ray->patient->name;
            $notification->read_status = 0;
            $notification->save();

            event(new  Ready_xRays(
                'تم انجاز الطلب الاشعاعي  ',
                $ray->patient->name,
                $ray->description,
                $ray->doctor->id,
            ));

            Mail::to($ray->patient->email)->send(new Response_X_Ray(
                $ray->patient->name,
                $ray->doctor->name,
            ));


            DB::commit();
            toastr()->success('تم ارفاق الصور بنجاح ');

            return redirect()->route('staff.x-rays');


        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function show()
    {
        $staff = auth('staff')->user();
        $rays = Ray::where('staff_id', auth('staff')->user()->id)->get();
        return view('Dashboard.Staffs.X_Rays.show', compact('rays', 'staff'));
    }

    public function getInformationRay($id)
    {
        $staff=auth('staff')->user();
        $ray=Ray::where('id', $id)->where('staff_id',$staff->id)->first();
        if(!$ray){
            toastr()->error('لاتملك صلاحية بالوصول للمريض');
            return redirect()->route('staff.x-rays-show');
        }
        return view('Dashboard.Staffs.X_Rays.information', compact('ray'));
    }
}
