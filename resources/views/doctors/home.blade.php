
@extends('welcome') 

@section('content')
<link rel="stylesheet" href="{{ asset('css/doctordashboard.css') }}">

    <div class="p-6">
        <h2 class="text-lg font-semibold mb-4">Doctor Dashboard</h2>

        <div class="flex justify-between">
            
            <div>
                <button><a href="{{ route('appointments.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    View Appointments
                </a></button>
            <br><br>

            
            
                <button><a href="{{ route('doctors.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Doctors List
                </a></button>
                <br><br>

          
            
                <button><a href="{{ route('patients.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Patients List
                </a></button>
            </div>
        </div>
    </div>
@endsection
