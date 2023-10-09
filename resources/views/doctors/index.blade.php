

@extends('layouts.app')

@section('content')
<div class="container">
    @if(auth()->user()->isDoctor())

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('doctors.create') }}" class="btn btn-primary">Add New Doctor</a>
    @endif
    </div>
    <h1>Doctors List</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Doctor Name</th>
                <th scope="col">Email</th>
                <th scope="col">Specialization</th>
                <th scope="col">License Number</th>
                @if(auth()->user()->isDoctor() == false)
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->doc_name }}</td>
                    <td>{{ $doctor->doc_email }}</td>
                    <td>{{ $doctor->specialization }}</td>
                    <td>{{ $doctor->license_number }}</td>
                    <td>
                        <a href="{{ route('doctors.show', $doctor->doc_id) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('doctors.edit', $doctor->doc_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('doctors.destroy', $doctor->doc_id) }}" method="POST" style="display: inline;">
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
