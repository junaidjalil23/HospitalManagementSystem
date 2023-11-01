<?php

// app/Http/Controllers/DoctorLoginController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.doctor-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'doc_email' => 'required|email',
            'password' => 'required',
        ]);

        $doctor = Doctor::where('doc_email', $request->doc_email)->first();

        if ($doctor && Hash::check($request->password, $doctor->password)) {
        // Authentication successful
        auth()->guard('doctor')->login($doctor);
        
        return redirect()->route('doctors.home');
    }


        // Authentication failed
        return back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
