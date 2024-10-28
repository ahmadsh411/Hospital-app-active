<?php

use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Service\SingleServiceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Service\MultiServiceController;
use App\Http\Controllers\Insurances\InsuranceController;
use App\Http\Controllers\Ambulances\AmbulanceController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Invoices\Allinvoices\InvoiceController;
use App\Http\Controllers\Invoices\Group\GroupInvoicesController;
use App\Http\Controllers\Invoices\ReceiptConroller;
use App\Http\Controllers\Invoices\SingleInvoiceController;
use App\Http\Controllers\Invoices\SpendingMoneyController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
//############user_Dashboard########################//
Route::get('/user/dashboard', function () {
    return view('Dashboard.User.dashboard');
})->middleware(['auth'])->name('dashboard');

//##########################Admin_Dashboard##########################################//

Route::get('/admin/dashboard', function () {

    return view('Dashboard.Admin.dashboard');
})->middleware(['auth:admin'])->name('admin.dashboard');
//#####################End_dashboard_Admin##########################################//



        //##############Admin_Functions##########################################//
Route::group([

    'middleware'=>'AuthMiddleware'
      ],function (){
     Route::get('all/sections/in/hospital',[SectionController::class,'index'])->name('section.all');
     Route::post('add/nes/section/in/hospital',[SectionController::class,'store'])->name('section.store');
     Route::post('update/the/section/{id}',[SectionController::class,'update'])->name('section.update');
     Route::delete('delete/the/section/{id}',[SectionController::class,'destroy'])->name('section.delete');
     Route::get('information/about/section/{id}',[SectionController::class,'show'])->name('section.show');
     //#########End_Sections#######################################

    //#########Doctors#############################################################################################//
       Route::get('all/doctors/in/system',[DoctorController::class,'index'])->name('doctor.index');
       Route::get('create/new/doctor',[DoctorController::class,'create'])->name('doctor.create');
       Route::post('store/the/doctor',[DoctorController::class,'store'])->name('doctor.store');
       Route::delete('delete/doctor',[DoctorController::class,'destroy'])->name('doctor.destroy');
       Route::get('edit/the/information/{id}',[DoctorController::class,'edit'])->name('doctor.edit');
       Route::post('update/the/information/{id}',[DoctorController::class,'update'])->name('doctor.update');
       Route::post('change/password/{id}',[DoctorController::class,'update_password'])->name('chang.passowrd');
       Route::post('change/doctor/status/{id}',[DoctorController::class,'changestatus'])->name('doctor.changestatus');
    //#################################################################################################################service_single###################
       Route::resource('services',SingleServiceController::class);
       //##################################### Livewire_Groups ###################################################################
    Route::view('Add-Group-Service','livewire.GroupService.Include_create')->name('Add_service_group');
    ///################################Multi_Service##############################################################################
    Route::resource('multi-services',MultiServiceController::class);
//    #################################Insurances################################################################################
    Route::resource('insurance-company',InsuranceController::class);
//    ##################################Ambulances############################################################
    Route::resource('ambulance-hospital',AmbulanceController::class);
//    ##################################Patients##############################################################
    Route::resource('patient-hospital',\App\Http\Controllers\Patients\PatientController::class);
    // ######################################Invices#############################################################
    Route::resource('single-invoices',SingleInvoiceController::class);
    // ########################################Recepts##############################################################
    Route::resource('receipt-box',ReceiptConroller::class);
    // ####################################################################################SpendingMony####################
    Route::resource('paiment-box',SpendingMoneyController::class);
    // #########################################EmailRouting##########################################
    Route::get('/inbox', [EmailController::class, 'fetchInboxMessages'])->name('inbox');
    Route::post('/reply/{messageId}', [EmailController::class, 'replyToMessage'])->name('reply');
    // ##############################Group_Invoices#######################################################
    Route::resource('group-invoices',GroupInvoicesController::class);
    // #################################All_Invoices################################################################
    Route::resource('/invoices',InvoiceController::class);
//    ########################################### Staff####################################################################
    Route::resource('staff-hospital',\App\Http\Controllers\Staffs\StaffController::class);



});











});

require __DIR__.'/auth.php';
