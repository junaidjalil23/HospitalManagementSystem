
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-end mb-3">
    @if(auth()->user()->isDoctor() == false)
        <a href="{{ route('patients.create') }}" class="btn btn-primary">Add New Patient</a>
        @endif
    </div>
    <h1>Patients List</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Patient Name</th>
                <th scope="col">Disease</th>
                <th scope="col">Contact</th>
                <th scope="col">Address</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient->patient_name }}</td>
                    <td>{{ $patient->disease }}</td>
                    <td>{{ $patient->contact }}</td>
                    <td>{{ $patient->address }}</td>
                    @if(auth()->user()->isDoctor() == false)
                    <td>
                        <a href="{{ route('patients.show', $patient->patient_id) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('patients.edit', $patient->patient_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('patients.destroy', $patient->patient_id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
