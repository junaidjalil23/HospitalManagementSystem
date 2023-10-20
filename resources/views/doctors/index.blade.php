    @extends('layouts.app')

    @section('content')
<head>
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

</head>
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('doctors.create') }}" class="btn btn-primary">Add New Doctor</a>
        @endif
        </div>
        @if(auth()->check() && (auth()->user()->hasRole('doctor') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('patient'))) 
        <h1>Doctors List</h1>
        <section class="intro">
  <div class="bg-image h-100" style="background-color: #f5f7fa;">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card shadow-2-strong">
              <div class="card-body p-0">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                  <table class="table table-dark mb-0" id="doctorsTable">
                    <thead style="background-color: #393939;">
                        <tr class="text-uppercase text-success">
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    </div>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#doctorsTable').DataTable();
        });
    </script>
    @endsection
