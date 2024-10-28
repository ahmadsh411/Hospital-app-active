<?php
namespace  App\Repository\Profiles;

use App\Interfaces\Profiles\DoctorProfileInterface;
use App\Models\Sections\Section;
use App\Traits\deleteImage;
use App\Traits\UploadImage;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorProfileRepository implements  DoctorProfileInterface{

    use UploadImage,deleteImage;

    public function show()
    {
        $doctor=auth('doctor')->user();
        return view('Dashboard.Doctors.Profile.show',compact('doctor'));
    }

    public function update( $request)
    {
        try {
            // بدء المعاملة
            DB::beginTransaction();

            $doctor = auth('doctor')->user();
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->section_id = $request->section_id;

            if ($request->input('password')) {
                $doctor->password = Hash::make($request->password);
            }

            $doctor->phone_number = $request->phone_number;
            $doctor->save();

            // التحقق من رفع صورة جديدة
            if ($request->hasFile('photo')) {
                // حذف الصورة السابقة إذا كانت موجودة
                if ($doctor->image) {
                    $this->deleteattach('upload_image', 'doctors', $doctor->image->filename, 'App\Models\Doctors\Doctor', $doctor->id);
                }

                // رفع وحفظ الصورة الجديدة
                $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $doctor->id, 'App\Models\Doctors\Doctor');
            }

            // إنهاء المعاملة بنجاح
            DB::commit();
            toastr()->success('تم تعديل البروفايل بنجاح');

            return redirect()->route('doctor.profile')->with('success', 'تم تحديث البيانات بنجاح!');

        } catch (\Exception $e) {
            // إلغاء المعاملة في حالة الخطأ
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function edit()
    {
        $doctor=auth('doctor')->user();
        $sections=Section::all();
        return view('Dashboard.Doctors.Profile.edit',compact('doctor','sections'));
    }
}
