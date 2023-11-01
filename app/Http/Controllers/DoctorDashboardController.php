<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $doctor = auth()->guard('doctor')->user();
        return view('doctors.home', compact('doctor'));
    }
}
