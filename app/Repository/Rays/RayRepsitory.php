<?php

namespace App\Repository\Rays;

use App\Events\SendX_Ray;
use App\Interfaces\Rays\RayInterface;
use App\Models\Images\Image;
use App\Models\Notifications\Notification;
use App\Models\Rays\Ray;
use App\Traits\deleteImage;
use App\Traits\UploadImage;

use Illuminate\Support\Facades\DB;

class RayRepsitory implements RayInterface
{

    use UploadImage, deleteImage;

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $ray = new Ray();
            $ray->description = $request->description;
            $ray->patient_id = $request->patient_id;
            $ray->invoice_id = $request->invoice_id;
            $ray->doctor_id = $request->doctor_id;
            $ray->status = 0;
            $ray->save();
            $this->verifyAndStoreImage($request, 'image',
                'x-rays/' . $ray->patient->name . '/send/' . $ray->id, 'upload_image', $ray->id,
                'App\Models\Rays\Ray');

            $notification = new Notification();
            $notification->user_id = 3;
            $notification->message = 'اشعار طلب تصوير شاعاي';
            $notification->read_status = 0;
            $notification->save();


            event(new SendX_Ray(
                $ray->doctor->name,
                'اشعار طلب تصوير شاعاي',
                $ray->description
                , 3,
            ));

            DB::commit();
            session()->flash('add');
            return back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $ray = Ray::findOrFail($id);
        return view('Dashboard.Doctors.DoctorDashboard.Invoices.Ray_Edit', compact('ray'));
    }


    public function update($id, $request)
    {
        try {
            DB::beginTransaction();

            // جلب السجل المطلوب للتعديل
            $ray = Ray::findOrFail($id);
            $ray->description = $request->description;
            $ray->patient_id = $request->patient_id;
            $ray->invoice_id = $request->invoice_id;
            $ray->doctor_id = $request->doctor_id;
            $ray->status = 0;
            $ray->save();

            // التحقق من وجود الصور القديمة وحذفها إذا كانت موجودة
            if ($ray->images->count() > 0) {
                foreach ($ray->images as $image) {
                    $this->deleteattach('upload_image', 'x-rays/' . $ray->patient->name . '/send/' . $ray->id, $image->filename, 'App\Models\Rays\Ray', $ray->id);
                }
            }


            // رفع صور جديدة (إن وجدت)
            if ($request->hasFile('image')) {
                $this->verifyAndStoreImage($request, 'image', 'x-rays/' . $ray->patient->name . '/send/' . $ray->id, 'upload_image', $ray->id, 'App\Models\Rays\Ray');
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->route('patient.details', ['id' => $ray->patient->id]);

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $ray = Ray::findOrFail($id);
        $images = $ray->images;
        foreach ($images as $image) {
            $this->deleteattach('upload_image', 'x-rays/' . $ray->patient->name . '/send/' . $ray->id, $image->filename, 'App\Models\Rays\Ray', $ray->id);
        }
        $ray->delete();
        session()->flash('delete');
        return back();
    }

    public function show($id)
    {
        $ray = Ray::where('doctor_id', auth('doctor')->user()->id)->where('id', $id)->first();
        if (!$ray) {
            toastr()->error('هذا المريض ليس مريضك');
            return back();
        }
        return view('Dashboard.Doctors.DoctorDashboard.Invoices.showResponseRays', compact('ray'));
    }

}

