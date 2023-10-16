<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AvailableHourController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleMail;
// Default Laravel Auth routes
Auth::routes();

// Landing page
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Test email route
Route::get('/test-email', function () {
    $to = 'hashim.tayyab.shah@vaival.com';
    Mail::to($to)->send(new SampleMail());
    return "Test email sent to $to";
});

// Authenticated user routes
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Admin routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

//Patient dashboard
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/patients/home', [UserController::class , 'home'])->name('patients.home');
});
//Doctor Dashboard
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/doctors/home', [DoctorController::class , 'home'])->name('doctors.home');
});
Route::middleware(['web', 'auth', 'checkRole:admin'])->group(function () {
    Route::resource('patients', UserController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::post('appointments/{id}/confirm', [AppointmentController::class, 'confirm'])->name('appointments.confirm');
    Route::post('appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::put('/available-hours/{id}/update-booking-status', [AvailableHourController::class, 'updateBookingStatus']);
});

// Patient routes
Route::middleware(['web', 'auth', 'checkRole:patient'])->group(function () {
    Route::resource('patients', UserController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('appointments', AppointmentController::class);
    
    Route::post('appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::put('/available-hours/{id}/update-booking-status', [AvailableHourController::class, 'updateBookingStatus']);
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
