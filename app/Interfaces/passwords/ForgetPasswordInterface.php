<?php
namespace App\Interfaces\passwords;

use Illuminate\Http\Request;

interface ForgetPasswordInterface
{
    public function resetpassword($request);
    public function verifyCode( $request);
    public function create();
    public function show();
    public  function showResetForm();
    public function resetPasswords(Request $request);


    // Reset For Doctor
    public function createDoctor();
    public function resetpasswordDoctor($request);
   public function  showDoctor();
   public  function showResetFormDoctor();
   public function verifyCodeDoctor( $request);
   public function resetPasswordsDoctor(Request $request);


}
