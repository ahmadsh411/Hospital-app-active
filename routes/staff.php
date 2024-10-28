<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() { //

           Route::get('/staff/dashboard', function () {
               return view('Dashboard.Staffs.Auth.dashboard');
                  })->middleware(['auth:staff'])->name('staff.dashboard');




           Route::middleware(['auth:staff'])->group(function () {

               Route::get('x-rays',[\App\Http\Controllers\Staffs\X_RaysStaffController::class,'index'])->name('staff.x-rays');
               Route::get('x-ray-edit/{id}',[\App\Http\Controllers\Staffs\X_RaysStaffController::class,'edit'])->name('staff.x-ray-edit');
               Route::post('x-ray-update/{id}',[\App\Http\Controllers\Staffs\X_RaysStaffController::class,'update'])->name('staff.x-ray-update');
//              #######################################Profile################################################################################################
               Route::get('staff-profile',[\App\Http\Controllers\Staffs\ProfileController::class,'show'])->name('staff.staff-profile');
               Route::get('edit-staff-profile',[\App\Http\Controllers\Staffs\ProfileController::class,'edit'])->name('staff.edit');
               Route::put('update-staff-profile',[\App\Http\Controllers\Staffs\ProfileController::class,'update'])->name('staff.update-profile');






          });




});

require __DIR__.'/auth.php';

