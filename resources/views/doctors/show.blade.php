
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Doctor Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Doctor Name: {{ $doctor->doc_name }}</h5>
            <p class="card-text">Email: {{ $doctor->doc_email }}</p>
            <p class="card-text">Specialization: {{ $doctor->specialization }}</p>
            <p class="card-text">License Number: {{ $doctor->license_number }}</p>

            <a href="{{ route('doctors.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
@endsection
