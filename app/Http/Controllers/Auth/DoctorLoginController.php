<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class DoctorLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/doctors/home'; 

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.doctor_login'); 
    }
    public function doctorLogin(Request $request)
    {
        $this->validate($request, [
            'doc_email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        if (Auth::guard('doctor')->attempt(['doc_email' => $request->doc_email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('doctors.home'));
        }
    
        return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Invalid email or password']);
    }
    protected function guard()
    {
        return Auth::guard('doctor');
    }


}
