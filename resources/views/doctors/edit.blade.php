
@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h1>Edit Doctor</h1>

    <form action="{{ route('doctors.update', $doctor->doc_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="doc_name" class="form-label">Doctor Name</label>
            <input type="text" class="form-control" id="doc_name" name="doc_name" value="{{ $doctor->doc_name }}" required>
        </div>

        <div class="mb-3">
            <label for="doc_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="doc_email" name="doc_email" value="{{ $doctor->doc_email }}" required>
        </div>

        <div class="mb-3">
            <label for="specialization" class="form-label">Specialization</label>
            <input type="text" class="form-control" id="specialization" name="specialization" value="{{ $doctor->specialization }}" required>
        </div>

        <div class="mb-3">
            <label for="license_number" class="form-label">License Number</label>
            <input type="text" class="form-control" id="license_number" name="license_number" value="{{ $doctor->license_number }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
