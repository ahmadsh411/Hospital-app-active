<?php

use App\Http\Controllers\Doctor\Doctor_Dashboard\DoctorInvoicesController;
use App\Http\Controllers\Doctor\Doctor_Dashboard\MedicalDiagnosesController;
use App\Http\Controllers\Doctor\Doctor_Dashboard\RayDoctorController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //




        Route::get('/doctor/dashboard', function () {

            return view('Dashboard.Doctors.Auth.Dashboard');


        })->middleware(['auth:doctor'])->name('doctor.dashboard');

        Route::middleware('auth:doctor')->group(function(){

            // ##########################Invoices##############################################
            Route::resource('doctor-invoices',DoctorInvoicesController::class);
            Route::get('complete-statements',[DoctorInvoicesController::class,'completeIndex'])->name('complete.statements');
            Route::get('reviews-statements',[DoctorInvoicesController::class,'reviews'])->name('reviews');

            // ##############################Medical Diagnoses#################################
            Route::resource('medicals', MedicalDiagnosesController::class);
            Route::post('add-review',[MedicalDiagnosesController::class,'storeReview'])->name('review.store');
            Route::post('rays',[\App\Http\Controllers\Doctor\Doctor_Dashboard\RayDoctorController::class,'store'])->name('rays.store');
            Route::get('edit-ray/{id}',[\App\Http\Controllers\Doctor\Doctor_Dashboard\RayDoctorController::class,'edit'])->name('rays.edit');
            Route::post('change-ray-type/{id}',[\App\Http\Controllers\Doctor\Doctor_Dashboard\RayDoctorController::class,'update'])->name('rays.update');
            Route::delete('delete-ray/{id}',[RayDoctorController::class,'destroy'])->name('rays.delete');
            Route::get('show-ray/{id}',[RayDoctorController::class,'show'])->name('rays.show');
            // #####################################################################################################

            Route::get('patient-details/{id}',[\App\Http\Controllers\Doctor\Doctor_Dashboard\PatientDetailsController::class,'index'])->name('patient.details');
           //##########################################################################Laboratory###################################################################
            Route::resource('laboratories',\App\Http\Controllers\Doctor\Doctor_Dashboard\LaboratoryDoctorController::class);
            // #######################################Profile####################################################################
            Route::get('doctor-show-profile',[\App\Http\Controllers\Doctor\Profile\ProfileController::class,'show'])->name('doctor.profile');
            Route::get('doctor-edit-profile',[\App\Http\Controllers\Doctor\Profile\ProfileController::class,'edit'])->name('doctor.profile.edit');
            Route::post('doctor-update-profile',[\App\Http\Controllers\Doctor\Profile\ProfileController::class,'update'])->name('doctor.profile.update');
        });



















require __DIR__.'/auth.php';


});

