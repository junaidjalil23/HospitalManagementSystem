<!-- resources/views/appointments/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Create New Appointment</a>
    </div>
    <h1>Appointments List</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Doctor Name</th>
                <th scope="col">Patient Name</th>
                <th scope="col">Appointment Date</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->doctor->doc_name }}</td>
                    <td>{{ $appointment->patient->patient_name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
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
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
