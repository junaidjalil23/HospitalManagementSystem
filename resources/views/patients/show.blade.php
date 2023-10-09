@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Patient Details</h1>

    <div class="mb-3">
        <strong>Patient Name:</strong> {{ $patient->patient_name }}
    </div>
    <div class="mb-3">
        <strong>Disease:</strong> {{ $patient->disease }}
    </div>
    <div class="mb-3">
        <strong>Contact:</strong> {{ $patient->contact }}
    </div>
    <div class="mb-3">
        <strong>Address:</strong> {{ $patient->address }}
    </div>

    <div class="mb-3">
        <a href="{{ route('patients.edit', $patient->patient_id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('patients.destroy', $patient->patient_id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
    
    <a href="{{ route('patients.index') }}" class="btn btn-secondary">Back to Patients List</a>
</div>
@endsection
