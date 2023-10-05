<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

    //Admin Routes 
Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('/admin/dashboard', 'AdminController@index')->name('admin.dashboard');
    // Route::get('/admin/patients', 'AdminController@viewPatients')->name('admin.viewPatients');
    // Route::get('/admin/doctors', 'AdminController@viewDoctors')->name('admin.viewDoctors');
    // Route::get('/admin/appointments', 'AdminController@viewAppointments')->name('admin.viewAppointments');
    // Route::get('/admin/set-hours', 'AdminController@setDoctorHours')->name('admin.setDoctorHours');
    // // Add more routes for update and delete actions
    // //CRUD for patients
    // Route::resource('/admin/patients', 'AdminController\PatientsController');
    
    // // CRUD for Doctors
    // Route::resource('/admin/doctors', 'AdminController\DoctorsController');

    // // Set Available Hours for Doctors
    // Route::get('/admin/doctors/{doctor}/set-hours', 'AdminController\DoctorsController@setHoursForm')->name('doctors.setHoursForm');
    // Route::post('/admin/doctors/{doctor}/set-hours', 'AdminController\DoctorsController@setHours')->name('doctors.setHours');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
