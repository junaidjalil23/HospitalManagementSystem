@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Patient</h1>

    <form action="{{ route('patients.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="patient_name" class="form-label">Patient Name</label>
            <input type="text" class="form-control" id="patient_name" name="patient_name" required>
        </div>

        <div class="mb-3">
            <label for="disease" class="form-label">Disease</label>
            <input type="text" class="form-control" id="disease" name="disease" required>
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Set Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
   

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
