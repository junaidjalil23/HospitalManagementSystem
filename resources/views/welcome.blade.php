@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Management System</title>

    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">

    
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">


</head>
<body style="background-color: #E3F6FC;">
    
            @if(Request::is('about') || Request::is('contact'))            
                <div class="content">
                    <h1>Hospital Management System</h1>
                    <h2>Digital Hospital Management at one place</h2>
                    @yield('content')
                </div>
                 @else

                <div class="content">
                    <h1>Hospital Management System</h1>
                    <h2>Digital Hospital Management at one place</h2>    
            </div>

            <div class="center-image">
               <img src="{{ asset('start.jpg') }}" alt="Welcome Image" class="">
            </div>
            @endif


                <div class="site-section bg-primary py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mb-4 mb-md-0">
            <h2 class="mb-0 text-white">Want to Book an Appointment?</h2>
            <p class="mb-0 opa-7">Register Now to book appointments Digitally.</p>
          </div>
          <div class="col-lg-5 text-white">
            <a>
          <button class="register-button" href="{{ route('register') }}">Register
            </button>
            </a>
          </div>
        </div>
      </div>
    </div>

<br>
    <footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <h2 class="footer-heading mb-4">HMS</h2>
              <p>This webiste is build on laravel. </p>
              <ul class="list-unstyled social">
                <li><a href="#"><span class="icon-facebook"></span></a></li>
                <li><a href="#"><span class="icon-instagram"></span></a></li>
                <li><a href="#"><span class="icon-twitter"></span></a></li>
                <li><a href="#"><span class="icon-linkedin"></span></a></li>
              </ul>
            </div>
            <div class="col-lg-8 ml-auto">
              <div class="row">

                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Discover</h2>
                  <ul class="list-unstyled">
                  <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
              <div class="border-top pt-5">
                <p>

              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 

              </p>
              </div>
            </div>

          </div>
        </div>
      </footer>

    
</body>
</html>
@endsection