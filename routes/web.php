<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HrController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\ProfileController;

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
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/redirects',[HomeController::class,'index']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //officer
        Route::middleware(['check0'])->group(function () {
        Route::controller(OfficerController::class)->group(function () {
            Route::get('/officer/profile','profile');

                //ดูวันลาของตัวเอง
                Route::get('/officer/my_leave_table','my_leave_table');
                Route::get('/officer/my_leave_table/approve','my_leave_table_approve');
                Route::get('/officer/my_leave_table/disapprove','my_leave_table_disapprove');

                //แจ้งลา
                Route::get('/officer/leave_main','main');

                Route::get('/officer/sick_form','sick_form');
                Route::post('/officer/sick_form/store','sick_form_store');
                Route::get('/officer/sick_form_edit/{id}','sick_form_edit');
                Route::post('/officer/sick_form_edit/update/{id}','sick_form_update');
                Route::get('/officer/sick_form/delete/{id}','sick_form_delete');

                Route::get('/officer/business_form','business_form');
                Route::post('/officer/business_form/store','business_form_store');
                Route::get('/officer/business_form_edit/{id}','business_form_edit');
                Route::post('/officer/business_form_edit/update/{id}','business_form_update');
                Route::get('/officer/business_form/delete/{id}','business_form_delete');

                Route::get('/officer/annual_form','annual_form');
                Route::post('/officer/annual_form/store','annual_form_store');
                Route::get('/officer/annual_form_edit/{id}','annual_form_edit');
                Route::post('/officer/annual_form_edit/update/{id}','annual_form_update');
                Route::get('/officer/annual_form/delete/{id}','annual_form_delete');

                });
        });

    //HR
        Route::middleware(['check1'])->group(function () {

            Route::controller(HrController::class)->group(function () {
            Route::get('/hr/profile','profile');
            //ข้อมูลพนักงาน
            Route::get('/hr/officer_table','officer_table');
            Route::get('/hr/officer_form','officer_form');
            Route::post('/hr/officer_form/store','store');
            Route::get('/hr/officer_form/delete/{id}','delete');
            Route::get('/hr/officer_form_edit/{id}','officer_form_edit');
            Route::post('/hr/officer_form_edit/update/{id}','update');
            //วันลาตัวเอง
            Route::get('/hr/my_leave_table','my_leave_table');
            Route::get('/hr/my_leave_table/approve','my_leave_table_approve');
            Route::get('/hr/my_leave_table/disapprove','my_leave_table_disapprove');
            //ดูวันลาพนักงาน
            Route::get('/hr/leave_table','leave_table');

            //แจ้งลา
            Route::get('/hr/leave_main','main');

            Route::get('/hr/sick_form','sick_form');
            Route::post('/hr/sick_form/store','sick_form_store');
            Route::get('/hr/sick_form_edit/{id}','sick_form_edit');
            Route::post('/hr/sick_form_edit/update/{id}','sick_form_update');
            Route::get('/hr/sick_form/delete/{id}','sick_form_delete');

            Route::get('/hr/business_form','business_form');
            Route::post('/hr/business_form/store','business_form_store');
            Route::get('/hr/business_form_edit/{id}','business_form_edit');
            Route::post('/hr/business_form_edit/update/{id}','business_form_update');
            Route::get('/hr/business_form/delete/{id}','business_form_delete');

            Route::get('/hr/annual_form','annual_form');
            Route::post('/hr/annual_form/store','annual_form_store');
            Route::get('/hr/annual_form_edit/{id}','annual_form_edit');
            Route::post('/hr/annual_form_edit/update/{id}','annual_form_update');
            Route::get('/hr/annual_form/delete/{id}','annual_form_delete');

        });
        });

        Route::middleware(['check2'])->group(function () {
        Route::controller(LeadController::class)->group(function () {

                Route::get('/lead/profile','profile');
                //ข้อมูลพนง
                Route::get('/lead/officer_table','officer_table');

                //แก้ไขสถานะวันลา
                Route::get('/lead/leave_table','leave_table');

                Route::get('/lead/annual_status_form/{id}','annual_status_form');
                Route::post('/lead/annual_status_update/{id}{user_id}','annual_status_update');

                Route::get('/lead/business_status_form/{id}','business_status_form');
                Route::post('/lead/business_status_update/{id}{user_id}','business_status_update');

                Route::get('/lead/sick_status_form/{id}','sick_status_form');
                Route::post('/lead/sick_status_update/{id}{user_id}','sick_status_update');


                /////แจ้งลา
                Route::get('/lead/leave_main','main');

                Route::get('/lead/sick_form','sick_form');
                Route::post('/lead/sick_form/store','sick_form_store');
                Route::get('/lead/sick_form_edit/{id}','sick_form_edit');
                Route::post('/lead/sick_form_edit/update/{id}','sick_form_update');
                Route::get('/lead/sick_form/delete/{id}','sick_form_delete');

                Route::get('/lead/business_form','business_form');
                Route::post('/lead/business_form/store','business_form_store');
                Route::get('/lead/business_form_edit/{id}','business_form_edit');
                Route::post('/lead/business_form_edit/update/{id}','business_form_update');
                Route::get('/lead/business_form/delete/{id}','business_form_delete');

                Route::get('/lead/annual_form','annual_form');
                Route::post('/lead/annual_form/store','annual_form_store');
                Route::get('/lead/annual_form_edit/{id}','annual_form_edit');
                Route::post('/lead/annual_form_edit/update/{id}','annual_form_update');
                Route::get('/lead/annual_form/delete/{id}','annual_form_delete');


                //วันลาตัวเอง
                Route::get('/lead/my_leave_table','my_leave_table');
                Route::get('/lead/my_leave_table/approve','my_leave_table_approve');
                Route::get('/lead/my_leave_table/disapprove','my_leave_table_disapprove');

            });
        });

    //Leader

});













require __DIR__.'/auth.php';
