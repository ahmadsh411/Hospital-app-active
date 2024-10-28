<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

use App\Interfaces\Doctors\DoctorRepositoryInterface as DoctorRepositoryInterface;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Doctors\Doctor;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
   use UploadImage;
   private $doctorRepository;
   public function __construct(DoctorRepositoryInterface $doctorRepository)
   {
       $this->doctorRepository=$doctorRepository;
   }


    public function index()
    {
     return $this->doctorRepository->index();
    }


    public function create()
    {
        return $this->doctorRepository->create();
    }


    public function store(Request $request)
    {
       return  $this->doctorRepository->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->doctorRepository->edit($id);
    }


    public function update(Request $request, $id)
    {
        return $this->doctorRepository->update($id,$request);
    }


    public function destroy(Request $request)
    {
       return $this->doctorRepository->destroy($request);
    }

    public function update_password($id,Request  $request){
        $validate=Validator::make($request->all(),[
            'password'=>['required|confirmed|min:6'],
            'password_confirmation'=>['required|min:6'],
        ]);
        return $this->doctorRepository->changepassword($request,$id);
    }
    public function changestatus($id,Request $request)
    {
        return $this->doctorRepository->changestatus($id,$request);
    }





}
