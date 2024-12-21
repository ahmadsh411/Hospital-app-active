<?php

use App\Http\Controllers\Conversations\StaffConversationController;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () { //

    Route::get('/staff/dashboard', function () {
        return view('Dashboard.Staffs.Auth.dashboard');
    })->middleware(['auth:staff'])->name('staff.dashboard');


    Route::middleware(['auth:staff'])->group(function () {

        Route::group(['middleware' => 'x_ray'], function () {

            Route::get('x-rays', [\App\Http\Controllers\Staffs\X_RaysStaffController::class, 'index'])->name('staff.x-rays');
            Route::get('x-ray-edit/{id}', [\App\Http\Controllers\Staffs\X_RaysStaffController::class, 'edit'])->name('staff.x-ray-edit')->middleware('x_ray_edit');
            Route::post('x-ray-update/{id}', [\App\Http\Controllers\Staffs\X_RaysStaffController::class, 'update'])->name('staff.x-ray-update');
            Route::get('x-rays-show', [\App\Http\Controllers\Staffs\X_RaysStaffController::class, 'show'])->name('staff.x-rays-show');
            Route::get('x-ray-information/{id}', [\App\Http\Controllers\Staffs\X_RaysStaffController::class, 'getInformationRay'])->name('staff.x-ray-information');

        });
//              #######################################Profile################################################################################################
        Route::get('staff-profile', [\App\Http\Controllers\Staffs\ProfileController::class, 'show'])->name('staff.staff-profile');
        Route::get('edit-staff-profile', [\App\Http\Controllers\Staffs\ProfileController::class, 'edit'])->name('staff.edit');
        Route::put('update-staff-profile', [\App\Http\Controllers\Staffs\ProfileController::class, 'update'])->name('staff.update-profile');
//               ###############################Laboratory############################################################################################################

        Route::group(['middleware' => 'lab'], function () {
            Route::get('all-laboratory', [\App\Http\Controllers\Staffs\Laboratory_StaffController::class, 'index'])->name('staff.all-laboratory');
            Route::get('edit-laboratory/{id}', [\App\Http\Controllers\Staffs\Laboratory_StaffController::class, 'edit'])->name('staff.laboratory-edit')->middleware('lab_edit');
            Route::post('update-laboratory/{id}', [\App\Http\Controllers\Staffs\Laboratory_StaffController::class, 'update'])->name('staff.laboratory-update');
            Route::get('laboratory-show', [\App\Http\Controllers\Staffs\Laboratory_StaffController::class, 'show'])->name('staff.laboratory-show');
            Route::get('show-information-laboratory/{id}', [\App\Http\Controllers\Staffs\Laboratory_StaffController::class, 'getIformation'])->name('staff.laboratory-show-information');
        });
        // ###############################$$Conversations####################################################################################################################
         Route::get('staff-chat-list', \App\Http\Livewire\Chat\Staff\CreateChat::class)->name('staff.chat-list');
         Route::get('show-staff-message',\App\Http\Livewire\Chat\Staff\Main::class)->name('showstaff.messages');


    });


});

require __DIR__ . '/auth.php';

