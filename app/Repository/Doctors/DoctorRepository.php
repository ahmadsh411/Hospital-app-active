<?php
namespace App\Repository\Doctors;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Mail\ActivationDoctorMail;
use App\Mail\DeleteDoctorMail;
use App\Mail\JoinDoctorMail;
use App\Mail\PasswordChangedMail;
use App\Models\Appointments\Appointment;
use App\Models\Doctors\Doctor;
use App\Models\Sections\Section;
use App\Traits\deleteImage;
use App\Traits\UploadImage;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class DoctorRepository implements  DoctorRepositoryInterface
{
    use deleteImage;
    use UploadImage;
  public  function index()
  {
      $doctors=Doctor::all();
      return view('Dashboard.Doctors.index',compact('doctors'));
  }
  public function create()
  {
      $sections=Section::all();
      $appointments=Appointment::all();
      return view('Dashboard.Doctors.add',compact('sections','appointments'));
  }
  public function store($request)
  {
      try {
          DB::beginTransaction();
          $doctor=new Doctor();
          $doctor->name=$request->name;
          $doctor->email=$request->email;
          $doctor->password=Hash::make($request->password);
          $doctor->phone_number=$request->phone_number;
          $doctor->section_id=$request->section_id;
          $doctor->status=1;

           $doctor->save();
          $doctor->appointments()->attach($request->appointment_id);

          //image Storage
         $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctor->id,'App\Models\Doctors\Doctor');
         Mail::to($doctor->email)->send(new JoinDoctorMail($doctor));
         DB::commit();
         session()->flash('add');
          return redirect()->route('doctor.index');
      }catch (Exception $e){
          DB::rollBack();
          return redirect()->back()->withErrors($e->getMessage());
      }


  }
    // TODO: Implement destroy() method.
  public function destroy($request)
  {


     if($request->page_id==1){
         //delete only doctor
         $doctor=Doctor::findOrFail($request->id);
     if ($doctor->image){
          $this->deleteattach('upload_image','doctors/'.$doctor->image->filename,$doctor->image->filename,
              'App\Models\Doctors\Doctor', $doctor->id);

     }

         Mail::to($doctor->email)->send(new DeleteDoctorMail($doctor ));


         $doctor->delete();

     }else{
         //delete selected doctors
         $deleted_select_id=explode(',',$request->delete_select_id);
         foreach ($deleted_select_id as $ids_doctors){
             $doctor=Doctor::findOrFail($ids_doctors);
             if ($doctor->image){
                 $this->deleteattach('upload_image','doctors/'.$doctor->image->filename,$doctor->image->filename,
                     'App\Models\Doctors\Doctor', $doctor->id);

             }
             $doctor->delete();

         }
     }
     session()->flash('delete');
     return redirect()->back();
  }

    // TODO: Implement edit() method.
  public function edit($id)
  {
     $doctor=Doctor::findOrFail($id);
     $sections=Section::all();
     $appointments=Appointment::all();
     return view('Dashboard.Doctors.update',compact('doctor','sections','appointments'));
  }
    // TODO: Implement update() method.
  public function update($id, $request)
  {
     try{
         DB::beginTransaction();
         $doctor=Doctor::findOrFail($id);
         $oldstatus=$doctor->status;
         $doctor->name=$request->name;
         $doctor->email=$request->email;
         $doctor->password=Hash::make($request->password);
         $doctor->phone_number=$request->phone_number;
         $doctor->section_id=$request->section_id;
         $doctor->status=$oldstatus;
         $doctor->save();
         $doctor->appointments()->sync($request->appointments);
         if ($request->hasFile('photo')) {
             if ($doctor->image) {
                 $this->deleteattach('upload_image', 'doctors/' . $doctor->image->filename, $doctor->image->filename,
                     'App\Models\Doctors\Doctor', $doctor->id);
             }
             $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $doctor->id, 'App\Models\Doctors\Doctor');
         }
         DB::commit();
         session()->flash('edit');
         return redirect()->route('doctor.index');

     }catch (Exception $e){
         DB::rollBack();
         return redirect()->back()->withErrors('error',$e->getMessage());
     }
  }
  public function changepassword($request,$id)
  {
      try {
          $doctor = Doctor::findOrFail($id);
          $password=$request->password;
          $doctor->password = Hash::make($request->password);
          $doctor->save();

          // إرسال رسالة إلكترونية إلى الطبيب
          Mail::to($doctor->email)->send(new PasswordChangedMail($doctor,$password));

          session()->flash('edit', 'Password changed successfully.');
          return redirect()->back();
      }catch (Exception $e){
          return redirect()->back()->withErrors(['error',$e->getMessage()]);
      }
  }

    public  function changestatus($id,$request){
        $validation=Validator::make($request->all(),[
            'status'=>'required|in:0,1 '
        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors(['error',$validation->errors()]);
        }else{
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->status = $request->status;
            $doctor->save();
            $status = $doctor->status;
            Mail::to($doctor->email)->send(new ActivationDoctorMail($doctor, $status));
            session()->flash('edit');
            return redirect()->back();
        }catch (Exception $r){
            return redirect()->back()->withErrors(['error',$r->getMessage()]);
        }
    }
    }

    
}
