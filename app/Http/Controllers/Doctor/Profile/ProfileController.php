<?php

namespace App\Http\Controllers\Doctor\Profile;

use App\Http\Controllers\Controller;
use App\Interfaces\Profiles\DoctorProfileInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   protected $doctor;

   public function __construct(DoctorProfileInterface $doctor){
       $this->doctor=$doctor;
   }

   public function show(){
       return $this->doctor->show();
   }

   public function edit(){
       return $this->doctor->edit();
   }


   public function update(Request  $request){
    
    return $this->doctor->update($request);
   }
}
