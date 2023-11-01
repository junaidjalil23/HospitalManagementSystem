@extends('layouts.app')
@section('content')

@auth('doctor')
<link rel="stylesheet" href="{{ asset('css/doctordashboard.css') }}">

    <div class="p-6">
    <h1>Doctor Dashboard</h1>
        <h2 class="text-lg font-semibold mb-4">Welcome {{ auth('doctor')->user()->doc_name }}</h2>

        <div class="flex justify-between">
            
            <div>
                <button><a href="{{ route('appointments.listing') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    View Your Appointments
                </a></button>
            <br><br>

            </div>
        </div>
    </div>
    @endauth
@endsection
