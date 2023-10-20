

@extends('layouts.app')

@section('content')
<head>
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

</head>
<div class="container">
    <div class="d-flex justify-content-end mb-3">
    @if(auth()->check() && (auth()->user()->hasRole('patient'))) 
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Create New Appointment</a>
    @endif
    </div>
    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('patient') || auth()->user()->hasRole('doctor') )) 
    <h1>Appointments List</h1>
    <section class="intro">
  <div class="bg-image h-100" style="background-color: #f5f7fa;">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card shadow-2-strong">
              <div class="card-body p-0">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                  <table class="table table-dark mb-0" id="appointmentsTable">
                    <thead style="background-color: #393939;">
                    <tr class="text-uppercase text-success">
                <th scope="col">Doctor Name</th>
                <th scope="col">Patient Name</th>
                <th scope="col">Appointment Date</th>
    @endif
                @if(auth()->user()->hasRole('admin'))
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
                @endif
            </tr>
            <tbody>
            </thead>
            @foreach ($appointments as $appointment)
            @if(auth()->user()->hasRole('patient') && $appointment->patient_id != auth()->user()->patient_id) 
            @continue
            @endif  
            @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('patient') || auth()->user()->hasRole('doctor') ) ) 
                <tr>
                    <td>{{ $appointment->doctor->doc_name }}</td>
                    <td>{{ $appointment->patient->patient_name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    @if(auth()->user()->hasRole('admin'))
                    <td>{{ $appointment->status }}</td>
                    <td>
                        <form action="{{ route('appointments.confirm', $appointment->apt_id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Confirm</button>
                        </form>
                        <form action="{{ route('appointments.cancel', $appointment->apt_id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning">Cancel</button>
                        </form>
                        <form action="{{ route('appointments.destroy', $appointment->apt_id) }}" method="POST" style="display: inline;">
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
            $('#appointmentsTable').DataTable();
        });
    </script>
@endsection
