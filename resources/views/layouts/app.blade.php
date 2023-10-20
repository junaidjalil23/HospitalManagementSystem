<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hospital Management System') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">


</head>
<body style="background-color:#E3F6FC;">
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-light-blue shadow-sm custom-navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Hospital Management System') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
       
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">{{ __('About') }}</a>        
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact Us') }}</a>        
                        </li>
  
            @auth
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('doctor'))
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('patients.index') }}">{{ __('Patients List') }}</a>        
                        </li>              
            @endif
                        @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('available-hours.create') }}">{{ __('Set Available Hours') }}</a>
                        </li>
                        @endif
                        @if(auth()->user()->hasRole('patient') || auth()->user()->hasRole('admin') )
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('available-hours.view') }}">{{ __('View Available Hours') }}</a>
                        </li>
                        @endif
                        @if(auth()->user()->hasRole('patient'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('appointments.create') }}">{{ __('Book New Appointment') }}</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('doctors.index') }}">{{ __('Doctors List') }}</a>
                        </li>
                        @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('appointments.index') }}">{{ __('Appointment List') }}</a>
                        </li>
                        @endif
                    </ul>                    
            @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        @auth
                        @if(auth()->user()->hasRole('patient'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patients.home') }}">{{ __('Dashboard') }}</a>        
                        </li>
                        @endif
                        @if(auth()->user()->hasRole('doctor'))
                         <li class="nav-item">
                        <a class="nav-link" href="{{ route('doctors.home') }}">{{ __('Dashboard') }}</a>        
                        </li>
                        @endif
                        @if(auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('Dashboard') }}</a>        
                        </li>
                        @endif
                        @endauth
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{  Auth::user()->patient_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <marquee>Welcome to the Hospital Management System. </marquee> 
        <main class="py-4">
            @yield('content')
        </main>


        
    </div>


</body>
</html>
