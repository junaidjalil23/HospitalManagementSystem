<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function viewPatients()
    {
        $patients = User::all();
        return view('admin.viewPatients', compact('patients'));
    }

    public function viewDoctors()
    {
        $doctors = Doctor::all();
        return view('admin.viewDoctors', compact('doctors'));
    }

    public function viewAppointments()
    {
        $appointments = Appointment::all();
        return view('admin.viewAppointments', compact('appointments'));
    }

    public function setDoctorHours()
    {
        // Logic to set available hours for doctors
        return view('admin.setDoctorHours');
    }

    // Add more methods for update and delete actions
}
