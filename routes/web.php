<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AvailableHourController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleMail;

use App\Http\Controllers\PageController;


// Default Laravel Auth routes
Auth::routes();
Route::get('/doctor/login', [DoctorLoginController::class, 'showLoginForm'])->name('doctor.login');
Route::post('/doctor/login', [DoctorLoginController::class, 'login']);
Route::post('/doctor/logout', [DoctorLoginController::class, 'logout'])->name('doctor.logout')->middleware('auth:doctor');

Route::get('/doctors/listing', [DoctorController::class, 'Listing'])->name('doctors.listing');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Test email route
Route::get('/test-email', function () {
    $to = 'junaid.jalil@vaival.com';
    Mail::to($to)->send(new SampleMail());
    return "Test email sent to $to";
});

// Authenticated user routes
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/patients/home', [UserController::class , 'home'])->name('patients.home');
    Route::get('/appointments/listing', [AppointmentController::class, 'listing'])->name('appointments.listing');

    Route::resource('appointments', AppointmentController::class);
    Route::get('/patients/listing', [UserController::class, 'Listing'])->name('patients.listing');
 
});
  // Doctor routes... wk
Route::middleware(['web', 'auth:doctor'])->group(function () {
  
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');

    Route::get('/doctors/home', [DoctorDashboardController::class, 'index'])->name('doctors.home');



    Route::get('/appointments/listing', [AppointmentController::class, 'listing'])->name('appointments.listing');


    // Add other doctor-specific routes here
});

//Patient dashboard wk
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/patients/home', [UserController::class , 'home'])->name('patients.home');

});

Route::middleware(['web', 'auth', 'checkRole:admin'])->group(function () {
    Route::resource('patients', UserController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('appointments', AppointmentController::class);
    
    Route::get('/get-doctors/{department}', [AppointmentController::class, 'getDoctors']);
    Route::get('/get-available-hours/{doctorId}/{date}', [AppointmentController::class, 'getAvailableHours']);
    Route::get('/available-hours/create', [AvailableHourController::class, 'create'])->name('available-hours.create');
    Route::get('/available-hours/view', [AvailableHourController::class, 'viewAvailableHours'])->name('available-hours.view');
    // Route for storing the created available hours
    Route::post('/available-hours/store', [AvailableHourController::class, 'store'])->name('available-hours.store');
Route::post('/available-hours/store', [AvailableHourController::class, 'store'])->name('available-hours.store');

    Route::post('appointments/{id}/confirm', [AppointmentController::class, 'confirm'])->name('appointments.confirm');
    Route::post('appointments/cancel/{id}', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

});

// Patient routes
Route::middleware(['web', 'auth', 'checkRole:patient'])->group(function () {
    Route::resource('patients', UserController::class);
    Route::get('/patients/home', [UserController::class , 'home'])->name('patients.home');
    Route::resource('doctors', DoctorController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('available-hours', AvailableHourController::class);
    Route::get('/available-hours/view', [AvailableHourController::class, 'viewAvailableHours'])->name('available-hours.view');
    Route::get('/get-available-hours/{doctorId}/{date}', [AppointmentController::class, 'getAvailableHours']);
    Route::post('/available-hours/store', [AvailableHourController::class, 'store'])->name('available-hours.store');    


    Route::get('/get-doctors/{department}', [AppointmentController::class, 'getDoctors']);
    Route::post('appointments/cancel/{id}', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

});

// Doctor routes
Route::middleware(['web', 'auth', 'checkRole:doctor'])->group(function () {
    Route::resource('doctors', DoctorController::class);
    Route::resource('patients', UserController::class)->only(['index', 'show']);
    Route::resource('appointments', AppointmentController::class)->only(['index', 'show']);

});
 Route::resource('patients', UserController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::get('/get-doctors/{department}', [AppointmentController::class, 'getDoctors']);
    Route::get('/available-hours/{doctorId}', [AvailableHourController::class, 'getAvailableHoursForDoctor']);
    Route::get('/available-hours/create', [AvailableHourController::class, 'create'])->name('available-hours.create');


    Route::post('/available-hours/store', [AvailableHourController::class, 'store'])->name('available-hours.store');
    Route::get('/available-hours/view', [AvailableHourController::class, 'viewAvailableHours'])->name('available-hours.view');
    Route::get('/doctors/home', [DoctorController::class , 'home'])->name('doctors.home');