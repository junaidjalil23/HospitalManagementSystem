<!-- resources/views/doctors/home.blade.php -->

@extends('welcome')  <!-- Assuming 'welcome' is your main layout file -->

@section('content')
    <div class="p-6">
        <h2 class="text-lg font-semibold mb-4">Doctor Dashboard</h2>

        <div class="flex justify-between">
            <!-- Button 1 - Scheduled Appointments -->
            <div>
                <a href="{{ route('appointments.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Scheduled Appointments
                </a>
            </div>

            <!-- Button 2 - Doctors List -->
            <div>
                <a href="{{ route('doctors.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Doctors List
                </a>
            </div>

            <!-- Button 3 - Patients List -->
            <div>
                <a href="{{ route('patients.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Patients List
                </a>
            </div>
        </div>
    </div>
@endsection
