<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@extends('welcome')

@section('content')
<head>
<link rel="stylesheet" href="fonts/icomoon/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">
</head>

<div class="container">
          <div class="row align-items-end ">
            <div class="col-lg-5">

              <div class="intro">
                <h1><strong>About</strong></h1>
                <div class="custom-breadcrumbs"><a href="{{route('welcome')}}">Home</a> <span class="mx-2">/</span> <strong>About</strong></div>
              </div>

            </div>
          </div>
        </div>
      </div>

    

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0 order-lg-2">
            <img src="about.jpg" alt="Image" class="img-fluid rounded">
          </div>
          <div class="col-lg-4 mr-auto">
            <h2>Digital Hospital MS</h2>
            <p>Welcome to Hospital Management System, a cutting-edge solution revolutionizing healthcare administration. At this website, we are committed to delivering a seamless and efficient platform tailored to meet the dynamic needs of modern healthcare facilities.</p>
            <p>Our mission is to empower healthcare providers with innovative tools that streamline operations, enhance patient care, and foster a collaborative and interconnected healthcare ecosystem.</p>
            <p>We believe in continuous innovation, staying ahead of industry trends, and adapting our system to the evolving landscape of healthcare.</p>
        </div>
        </div>
      </div>
    </div>
    <div class="site-section bg-primary py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mb-4 mb-md-0">
            <h2 class="mb-0 text-white">What are you waiting for?</h2>
            <p class="mb-0 opa-7">Join now to make your appointment Today</p>
          </div>
          <div class="col-lg-5 text-md-right">
            <a href="{{ route('register') }}" class="btn btn-primary btn-white">Register here</a>
          </div>
        </div>
      </div>
    </div>

      
      <footer class="site-footer">
        <div class="container">
          <div class="row">
                    <div class="col-lg-3">
                <h2 class="footer-heading mb-4">Explore us on our Socials </h2>
                <ul class="list-unstyled social d-flex justify-content-between">
                    <li><a href="#"><span class="icon-facebook"></span></a></li>
                    <li><a href="#"><span class="icon-instagram"></span></a></li>
                    <li><a href="#"><span class="icon-twitter"></span></a></li>
                    <li><a href="#"><span class="icon-linkedin"></span></a></li>
                </ul>
            </div>

        </div>

@endsection
