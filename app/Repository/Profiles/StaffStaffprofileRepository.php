<?php

namespace  App\Repository\Profiles;

use App\Interfaces\Profiles\staffprofileInterface;
use App\Models\Genders\Gender;
use App\Models\Sections\Section;

class StaffStaffprofileRepository implements staffprofileInterface
{

    public function show()
    {
        $staff= auth('staff')->user();

        return view('Dashboard.Staffs.Profile.show',compact('staff'));

    }



    public function edit()
    {
        $staff= auth('staff')->user();
        $genders = Gender::all();
        $sections = Section::all();
        return view('Dashboard.Staffs.Profile.edit',compact('staff','genders','sections'));
    }

    public function update( $request)
    {
       try{
           $staff= auth('staff')->user();
           $staff->name = $request->name;
           $staff->email = $request->email;
           $staff->phone = $request->phone;
           $staff->gender_id = $request->gender_id;
           $staff->section_id = $request->section_id;
           $staff->phone = $request->phone;
           $staff->address = $request->address;
           $staff->save();
           toastr()->success('تم تعديل الملف بنجاح');
           return redirect()->route('staff.staff-profile');
       }catch (\Exception $exception){
           return redirect()->back()->withErrors([$exception->getMessage()]);
       }

    }
}
