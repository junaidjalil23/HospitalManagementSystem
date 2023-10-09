<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
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

//Patient Routes
Route::resource('patients', UserController::class);
//Doctor Routes
Route::resource('doctors', DoctorController::class);
//Appointment Routes

Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');


Route::resource('appointments', AppointmentController::class);
Route::post('appointments/{id}/confirm', [AppointmentController::class, 'confirm'])->name('appointments.confirm');
Route::post('appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');


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
