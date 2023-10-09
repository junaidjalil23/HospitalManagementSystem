@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <select name="department" id="department" class="form-control">
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->doc_id }}">{{ $doctor->specialization }}</option>
                    @endforeach
                </select>
            </div>
            @if ($doctors)
            <div class="mb-3">
                <label for="doctor" class="form-label">Doctor</label>
                <select name="doctor" id="doctor" class="form-control">
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->doc_name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="mb-3">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
