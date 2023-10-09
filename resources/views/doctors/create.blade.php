
@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Add New Doctor</h1>

    <form action="{{ route('doctors.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="doc_name" class="form-label">Doctor Name</label>
            <input type="text" class="form-control" id="doc_name" name="doc_name" required>
        </div>

        <div class="mb-3">
            <label for="doc_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="doc_email" name="doc_email" required>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="specialization" class="form-label">Specialization</label>
            <input type="text" class="form-control" id="specialization" name="specialization" required>
        </div>

        <div class="mb-3">
            <label for="license_number" class="form-label">License Number</label>
            <input type="text" class="form-control" id="license_number" name="license_number" required>
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
            <label for="password" class="form-label">Set Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
