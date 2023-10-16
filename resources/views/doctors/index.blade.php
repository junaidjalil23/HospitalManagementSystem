    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('doctors.create') }}" class="btn btn-primary">Add New Doctor</a>
        @endif
        </div>
        @if(auth()->check() && (auth()->user()->hasRole('doctor') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('patient'))) 
        <h1>Doctors List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Specialization</th>
                    <th scope="col">License Number</th>
        @endif
                @if(auth()->user()->hasRole('admin'))
                    <th scope="col">Actions</th>
                @endif    
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                @if(auth()->check() && (auth()->user()->hasRole('doctor') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('patient'))) 
                    <tr>
                        <td>{{ $doctor->doc_name }}</td>
                        <td>{{ $doctor->doc_email }}</td>
                        <td>{{ $doctor->specialization }}</td>
                        <td>{{ $doctor->license_number }}</td>
                        <td>
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('doctors.show', $doctor->doc_id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('doctors.edit', $doctor->doc_id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('doctors.destroy', $doctor->doc_id) }}" method="POST" style="display: inline;">
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
