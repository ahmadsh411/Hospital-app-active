<?php

namespace App\Repository\Staffs;

use App\Interfaces\Staffs\StaffInterface;
use App\Models\Appointments\Appointment;
use App\Models\Genders\Gender;
use App\Models\Sections\Section;
use App\Models\Staffs\Staff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class StaffRepository implements StaffInterface
{

    public function index()
    {
      $staffs = Staff::all();
      $genders = Gender::all();
      $appointments=Appointment::all();
      $sections=Section::all();
      return view('Dashboard.staffs.index', compact('staffs','genders','appointments','sections'));
    }

    public function store($request)
    {
       try{
           DB::beginTransaction();
           $staff = new Staff();
           $staff->name=$request->name;
           $staff->email=$request->email;
           $staff->password=Hash::make($request->password);
           $staff->phone=$request->phone;
           $staff->address=$request->address;
           $staff->gender_id=$request->gender_id;
           $staff->section_id=$request->section_id;
           $staff->save();

            $app_Ids=$request->appointment_ids;
            foreach ($app_Ids as $app_Id){
                $staff->appointments()->attach($app_Id);
            }
            DB::commit();
           toastr()->success(trans('تم حفظ البيانات بنجاح'));
            return back();


       }catch (\Exception $exception){
           DB::rollBack();
           return redirect()->back()->withErrors(['error', $exception->getMessage()]);
       }
    }

    public function edit($id)
    {
        $staff=Staff::findOrFail($id);
        $genders = Gender::all();
        $appointments=Appointment::all();
        $sections=Section::all();
        return view('Dashboard.staffs.edit', compact('staff','genders','appointments','sections'));
    }

    public function update($request, $id)
    {
        try{
            DB::beginTransaction();
            $staff = Staff::find($id);
            $staff->name=$request->name;
            $staff->email=$request->email;
             if($request->password){
                 $staff->password=Hash::make($request->password);
             }
            $staff->phone=$request->phone;
            $staff->address=$request->address;
            $staff->gender_id=$request->gender_id;
            $staff->section_id=$request->section_id;
            $staff->save();

            $app_Ids=$request->appointment_ids;
                $staff->appointments()->sync($app_Ids);

            DB::commit();

            toastr()->success(trans('تم تعديل البيانات بنجاح'));
            return redirect()->route('staff-hospital.index');


        }catch (Exception $exception){
            DB::rollBack();
            return redirect()->back()->withErrors(['error', $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $staff=Staff::findOrFail($id);
        $staff->delete();
        toastr()->info('تم حذف البيانات بنجاح');
        return back();
    }
}
