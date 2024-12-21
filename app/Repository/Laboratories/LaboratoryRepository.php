<?php

namespace App\Repository\Laboratories;

use App\Events\send_laboratory;
use App\Interfaces\Laboratories\LaboratoryInterface;
use App\Models\Laboratories\Laboratory;
use App\Models\Notifications\Notification;
use App\Traits\deleteImage;
use App\Traits\UploadImage;
use Illuminate\Support\Facades\DB;

class LaboratoryRepository implements LaboratoryInterface
{
    use UploadImage, deleteImage;

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $laboratory = new Laboratory();
            $laboratory->description = $request->description;
            $laboratory->doctor_id = $request->doctor_id;
            $laboratory->invoice_id = $request->invoice_id;
            $laboratory->patient_id = $request->patient_id;
            $laboratory->status = 0;
            $laboratory->save();

            $this->verifyAndStoreImage($request, 'image',
                'Laboratory/Send' . '/' . $laboratory->patient->name . '/' . $laboratory->id,
                'upload_image',
                $laboratory->id, 'App\Models\Laboratories\Laboratory');

            $notification = new Notification();
            $notification->user_id = 2;
            $notification->message = 'اشعار طلب انجاز تحليل ';
            $notification->read_status = 0;
            $notification->save();

            event(new send_laboratory(
                $laboratory->doctor->name,
                2,
                'اشعار طلب انجاز تحليل',
                $laboratory->description,
            ));

            DB::commit();
            session()->flash('add');
            return back();

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error', $exception->getMessage()]);
        }
    }

    public function edit($id)
    {
        $laboratory = Laboratory::findOrFail($id);
        return view('Dashboard.Doctors.DoctorDashboard.Invoices.Laboratory.edit', compact('laboratory'));
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            // جلب السجل المطلوب للتعديل
            $laboratory = Laboratory::findOrFail($id);
            $laboratory->description = $request->description;
            $laboratory->patient_id = $request->patient_id;
            $laboratory->invoice_id = $request->invoice_id;
            $laboratory->doctor_id = $request->doctor_id;
            $laboratory->status = 0;
            $laboratory->save();

            // التحقق من وجود الصور القديمة وحذفها إذا كانت موجودة
            if ($laboratory->image) {

                $this->deleteattach('upload_image', 'Laboratory/' . $laboratory->patient->name . '/' . $laboratory->id, $laboratory->image->filename, 'App\Models\Laboratories\Laboratory', $laboratory->id);

            }


            // رفع صور جديدة (إن وجدت)
            if ($request->hasFile('image')) {
                $this->verifyAndStoreImage($request, 'image', 'Laboratory/' . $laboratory->patient->name . '/' . $laboratory->id, 'upload_image', $laboratory->id, 'App\Models\Laboratories\Laboratory');
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->route('patient.details', ['id' => $laboratory->patient->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $laboratory = Laboratory::findOrFail($id);
        $this->deleteattach('upload_image',
            'Laboratory/' . $laboratory->patient->name . '/' . $laboratory->id,
            $laboratory->image->filename, 'App\Models\Laboratories\Laboratory',
            $laboratory->id);
        $laboratory->delete();
        session()->flash('delete');
        return back();
    }
}
