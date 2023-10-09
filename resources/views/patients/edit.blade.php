@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Patient</h1>

    <form action="{{ route('patients.update', $patient->patient_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="patient_name" class="form-label">Patient Name</label>
            <input type="text" class="form-control" id="patient_name" name="patient_name" value="{{ $patient->patient_name }}" required>
        </div>

        <div class="mb-3">
            <label for="disease" class="form-label">Disease</label>
            <input type="text" class="form-control" id="disease" name="disease" value="{{ $patient->disease }}" required>
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" value="{{ $patient->contact }}" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $patient->address }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
