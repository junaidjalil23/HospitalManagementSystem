<!-- resources/views/appointments/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-end mb-3">
    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('patient'))) 
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Create New Appointment</a>
    @endif
    </div>
    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('patient'))) 
    <h1>Appointments List</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Doctor Name</th>
                <th scope="col">Patient Name</th>
                <th scope="col">Appointment Date</th>
    @endif
                @if(auth()->user()->hasRole('admin'))
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
                @endif
            </tr>
            <tbody>
            </thead>
            @foreach ($appointments as $appointment)
            @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('patient'))) 
                <tr>
                    <td>{{ $appointment->doctor->doc_name }}</td>
                    <td>{{ $appointment->patient->patient_name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    @if(auth()->user()->hasRole('admin'))
                    <td>{{ $appointment->status }}</td>
                    <td>
                        <form action="{{ route('appointments.confirm', $appointment->apt_id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Confirm</button>
                        </form>
                        <form action="{{ route('appointments.cancel', $appointment->apt_id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning">Cancel</button>
                        </form>
                        <form action="{{ route('appointments.destroy', $appointment->apt_id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
