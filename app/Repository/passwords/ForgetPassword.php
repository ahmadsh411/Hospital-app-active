<?php
namespace App\Repository\passwords;

use App\Interfaces\passwords\ForgetPasswordInterface;
use App\Mail\PasswordChangedMail;
use App\Mail\passwordResetmail;
use App\Models\Doctors\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPassword implements  ForgetPasswordInterface {

    public function resetpassword($request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $verificationcode=Str::random(6);
        session(['email' => $request->email]);
        session(['verification_code' => $verificationcode]);
        $user = User::where('email', $request->email)->first();
        Mail::to($request->email)->send(new passwordResetmail($user,$verificationcode));
        return redirect()->route('password.show');
    }


    public function verifyCode( $request)
    {
        // تحقق من أن الكود المدخل يطابق الكود المخزن في الجلسة
        if ($request->code === session('verification_code')) {
            // الكود صحيح - يمكنك الآن السماح للمستخدم بإعادة تعيين كلمة المرور
            return redirect()->route('password.reset.form')->with('message', 'Code verified successfully.');
        } else {
            return back()->withErrors(['code' => 'The verification code is incorrect.']);
        }
    }
    public function create()
    {
      return view('Dashboard.User.Auth.passwors-reset');
    }
    public function show(){
        return view('Dashboard.User.Auth.verification-conde');
    }

    public  function showResetForm(){
        return view('Dashboard.User.Auth.update-password');
    }
    public function resetPasswords(Request $request){
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        // تحديث كلمة المرور للمستخدم
        $user = User::where('email', session('email'))->first();
        //dd($user);
        $user->password = Hash::make($request->password);
        $user->save();
         toastr()->success('Successfully Update The password');
        return redirect()->route('login')->with('message', 'Password has been successfully updated.');
    }


    // ResetFor Doctor ############################################################################################

    public function createDoctor()
    {
      return view('Dashboard.Doctors.Auth.passwors-reset');
    }

    public function resetpasswordDoctor($request)
    {
        $request->validate(['email' => 'required|email|exists:doctors,email']);
        $verificationcode=Str::random(6);
        session(['email' => $request->email]);
        session(['verification_code' => $verificationcode]);
        $doctor = Doctor::where('email', $request->email)->first();
        Mail::to($request->email)->send(new passwordResetmail($doctor,$verificationcode));
        return redirect()->route('password.showDoctor');
    }

    public function showDoctor(){
        return view('Dashboard.Doctors.Auth.verification-conde');
    }

    public function showResetFormDoctor()
    {
        return view('Dashboard.Doctors.Auth.update-password');
    }

    public function verifyCodeDoctor( $request){


        // تحقق من أن الكود المدخل يطابق الكود المخزن في الجلسة
        if ($request->code === session('verification_code')) {
            // الكود صحيح - يمكنك الآن السماح للمستخدم بإعادة تعيين كلمة المرور
            return redirect()->route('password.reset.form.Doctor')->with('message', 'Code verified successfully.');
        } else {
            return back()->withErrors(['code' => 'The verification code is incorrect.']);
        }
    }

    public function resetPasswordsDoctor(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        // تحديث كلمة المرور للمستخدم
        $doctor = Doctor::where('email', session('email'))->first();

        $doctor->password = Hash::make($request->password);
        $doctor->save();
         toastr()->success('Successfully Update The password');
        return redirect()->route('doctor.login')->with('message', 'Password has been successfully updated.');
    }



}
