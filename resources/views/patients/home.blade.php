<!-- resources/views/patients/home.blade.php -->

@extends('layouts.app')  <!-- Assuming 'welcome' is your main layout file -->

@section('content')
<link rel="stylesheet" href="{{ asset('css/patientdashboard.css') }}">

    <div class="p-6">
    <h2 class="text-lg font-semibold mb-4 text-center">Patient Dashboard</h2>

        <div class="flex justify-between">
       
            <div>
                <button><a href="{{ route('appointments.index') }}">
                    My Appointments
                </a></button>
            </div>

            <div>
                <button><a href="{{ route('appointments.create') }}" >
                    Create Appointment
                </a></button>
            </div>
        </div>
    </div>
@endsection
