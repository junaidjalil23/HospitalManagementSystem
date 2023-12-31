<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $guard = 'web';


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     protected function authenticated(Request $request, $user)
{

    if ($user->hasRole('admin')) {
        return redirect()->route('home');
    } elseif ($user->hasRole('doctor')) {
        return redirect()->route('doctors.home');
    } elseif ($user->hasRole('patient')) {
        return redirect()->route('patients.home');
    }

    return redirect()->route('/home');
}

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
