
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-end mb-3">
    
    @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('patients.create') }}" class="btn btn-primary">Add New Patient</a>
    @endif
    </div>
    @if(auth()->check() && (auth()->user()->hasRole('doctor') || auth()->user()->hasRole('admin'))) 
    <h1>Patients List</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Patient Name</th>
                <th scope="col">Disease</th>
                <th scope="col">Contact</th>
                <th scope="col">Address</th>
        @endif
                @if(auth()->user()->hasRole('admin'))
                <th scope="col">Actions</th>
                @endif 
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
            @if(auth()->check() && (auth()->user()->hasRole('doctor') || auth()->user()->hasRole('admin'))) 
                <tr>
                    <td>{{ $patient->patient_name }}</td>
                    <td>{{ $patient->disease }}</td>
                    <td>{{ $patient->contact }}</td>
                    <td>{{ $patient->address }}</td>
                    <td>
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('patients.show', $patient->patient_id) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('patients.edit', $patient->patient_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('patients.destroy', $patient->patient_id) }}" method="POST" style="display: inline;">
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
