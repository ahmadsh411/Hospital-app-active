<?php

namespace App\Http\Controllers;

use App\Interfaces\passwords\ForgetPasswordInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    protected $passwordReset;
 public function  __construct(ForgetPasswordInterface $passwordReset)
 {
     $this->passwordReset=$passwordReset;
 }
 public function getpageReset(Request $request)
 {
     return $this->passwordReset->resetpassword($request);
 }
 public function verificy(Request $request)
 {
     return $this->passwordReset->verifyCode($request);
 }

 public function create()
 {
  return $this->passwordReset->create();
 }

 public function show()
 {
     return $this->passwordReset->show();
 }

    public function showResetForm()
    {
        return $this->passwordReset->showResetForm();
    }

    // معالجة تغيير كلمة المرور
    public function resetPasswords(Request $request)
    {
      return $this->passwordReset->resetPasswords($request);
    }

    // Reset For Doctor #############################################################

    public function createDoctor(){
        return $this->passwordReset->createDoctor();
    }
    public function showDoctor()
    {
        return $this->passwordReset->showDoctor();
    }


    public function resetpasswordDoctor(Request $request){
     return $this->passwordReset->resetpasswordDoctor($request);
    }

    public function getpageResetDoctor(Request $request){
        return $this->passwordReset->resetpasswordDoctor($request);
    }

    public function verificyDoctor(Request $request){
        return $this->passwordReset->verifyCodeDoctor($request);
    }

    public function showResetFormDoctor(){
        return $this->passwordReset->showResetFormDoctor();
    }

    public function resetPasswordsDoctor(Request $request){
        return $this->passwordReset->resetPasswordsDoctor($request);
    }
}
