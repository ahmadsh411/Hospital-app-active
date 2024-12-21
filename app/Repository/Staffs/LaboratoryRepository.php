<?php

namespace App\Repository\Staffs;

use App\Events\laboratory_event;
use App\Events\send_laboratory;
use App\Interfaces\Staffs\LaboratoryInterface;
use App\Mail\SendRequestLaboratory;
use App\Models\Laboratories\Laboratory;
use App\Models\Notifications\Notification;

use App\Traits\UploadImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LaboratoryRepository implements LaboratoryInterface
{

    use UploadImage;

    public function index()
    {

        $laboratories = Laboratory::where('status', 0)->whereNull('staff_id')->get();
        return view('Dashboard.Staffs.laboratories.index', compact('laboratories'));
    }

    public function show()
    {
        $staff = auth('staff')->user();
        $laboratories = Laboratory::where('status', 1)->where('staff_id', $staff->id)->get();
        return view('Dashboard.Staffs.laboratories.show', compact('laboratories'));
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $laboratory = Laboratory::find($id);
            $laboratory->status = 1;
            $laboratory->staff_id = auth('staff')->user()->id;
            $laboratory->staff_name = auth('staff')->user()->name;
            $laboratory->staff_description = $request->staff_description;
            $laboratory->staff_date = $request->staff_date;
            $laboratory->save();


            $this->verifyAndStoreImages(
                $request,
                'images',
                'Laboratory/Returned' . '/' . $laboratory->patient->name . '/' . $laboratory->id,
                'upload_image',
                $laboratory->id,
                'App\Models\Laboratories\Laboratory');

            $notification = new Notification();
            $notification->user_id = $laboratory->doctor->id;
            $notification->message = 'تم انجاز التحيلي للمريض ' . $laboratory->patient->name;
            $notification->read_status = 0;
            $notification->save();


            event(new laboratory_event(
                'تم انجاز التحيلي للمريض ' . $laboratory->patient->name,
                $laboratory->doctor_id,
                $laboratory->patient->name,
                $laboratory->description,
            ));

            Mail::to($laboratory->patient->email)->send(new SendRequestLaboratory(
                $laboratory->doctor,
                $laboratory->patient,
            ));




            DB::commit();
            toastr()->success(trans('تم انجاز التحليل بنجاح'));
            return redirect()->route('staff.all-laboratory');

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error', $exception->getMessage()]);
        }
    }

    public function edit($id)
    {
        $laboratory = Laboratory::where('status', 0)->whereNull('staff_id')->where('id', $id)->first();
        return view('Dashboard.Staffs.laboratories.edit', compact('laboratory'));
    }

    public function getLaboratoryInformation($id)
    {
        $staff = auth('staff')->user();
        $laboratory = Laboratory::where('staff_id', $staff->id)
            ->where('id', $id)->first();
        if (!$laboratory) {
            toastr()->error('ليس من صلاحياتك الولوج لهنا ');
            return back();
        }
        return view('Dashboard.Staffs.laboratories.getInformation', compact('laboratory'));
    }
}
