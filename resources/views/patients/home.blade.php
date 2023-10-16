<!-- resources/views/patients/home.blade.php -->

@extends('welcome')  <!-- Assuming 'welcome' is your main layout file -->

@section('content')
    <div class="p-6">
        <h2 class="text-lg font-semibold mb-4">Patient Dashboard</h2>

        <div class="flex justify-between">
            <!-- Left side - My Appointments -->
            <div>
                <a href="{{ route('appointments.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    My Appointments
                </a>
            </div>

            <!-- Right side - Create Appointments -->
            <div>
                <a href="{{ route('appointments.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Create Appointment
                </a>
            </div>
        </div>
    </div>
@endsection
