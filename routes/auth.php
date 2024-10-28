<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\DoctorAuthLoginController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\StaffAuthControoler;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
                  // ##########AdminLogin############################################################
                Route::get('admin/login', [AdminAuthController::class, 'create'])
                ->name('admin.login');

                Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.user');
                // ##########AdminLogin############################################################
                Route::post('admin/login', [AdminAuthController::class, 'store'])->name('login.admin');
                // ###############Doctor Login #####################################################
                Route::get('doctor/login',[DoctorAuthLoginController::class,'create'])
                ->name('doctor.login');
                Route::post('doctor/login',[DoctorAuthLoginController::class,'store'])->name('login.Doctor');
                //######################################Staff Login#############################################################
                 Route::get('staff/login',[\App\Http\Controllers\Auth\StaffAuthControoler::class,'create'])->name('staff.login');
                 Route::post('staff/login',[StaffAuthControoler::class,'store'])->name('login.Staff');



    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
//    #############################################################################user forget password #######################################
    Route::post('make-pasword-new',[PasswordResetController::class,'getpageReset'])->name('get.password');
    Route::get('show/reset/password',[PasswordResetController::class,'create'])->name('show.password.reset');
    Route::get('show/verification/code',[PasswordResetController::class,'show'])->name('password.show');
    Route::post('verify/the/code',[PasswordResetController::class,'verificy'])->name('assess.password');
    Route::get('code/reset-password', [PasswordResetController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPasswords'])->name('password.reset');
    // ################################################################################Doctor Forget Passord ################################################
    Route::get('show/reset/doctor/password',[PasswordResetController::class,'createDoctor'])->name('show.password.reset.doctor');
    Route::get('show/verification/code',[PasswordResetController::class,'showDoctor'])->name('password.showDoctor');
    Route::post('make-pasword-new',[PasswordResetController::class,'getpageResetDoctor'])->name('get.password.Doctor');
    Route::post('verify/the/code',[PasswordResetController::class,'verificyDoctor'])->name('assess.password.Doctor');
    Route::get('code/reset-password/doctor', [PasswordResetController::class, 'showResetFormDoctor'])->name('password.reset.form.Doctor');
    Route::post('doctor/reset-password', [PasswordResetController::class, 'resetPasswordsDoctor'])->name('password.reset.Doctor');

});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout.user');


});



Route::middleware('auth:admin')->group(function(){
    Route::post('admin/logout', [AdminAuthController::class, 'destroyAdmin'])
    ->name('logout.admin');
});

Route::middleware('auth:doctor')->group(function(){
    Route::post('doctor/logout', [DoctorAuthLoginController::class, 'destroy'])
    ->name('logout.doctor');
});

Route::middleware('auth:staff')->group(function(){
    Route::post('staff/logout', [\App\Http\Controllers\Auth\StaffAuthControoler::class, 'destroyStaff'])
        ->name('logout.staff');
});
