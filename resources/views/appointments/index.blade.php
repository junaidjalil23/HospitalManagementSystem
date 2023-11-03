@extends('layouts.app')

@section('content')
<head>
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        function confirmCancellation() {
            return confirm("Do you really want to cancel the appointment?");
        }
    </script>
<style>
    /* Add this to your CSS file */
.date-time-block {
    background-color: slategrey;
    padding: 5px;
    border-radius: 5px;
    display: inline-block;
}

.date {
    font-weight: bold;
}

.time {
    font-weight: bold;
    color: white;
}

</style>
</head>

<div class="container">
    <div class="d-flex justify-content-end mb-3">
        @if(auth()->check() && (auth()->user()->hasRole('patient'))) 
            <a href="{{ route('appointments.create') }}" class="btn btn-primary">Create New Appointment</a>
        @endif
    </div>
    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('patient') || auth()->user()->hasRole('doctor') )) 
        <h1>Appointments Record</h1>
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
                                                        <th scope="col">Appointment Created on</th>
                                                        <th scope="col">Booked Slot ( Date / Time )</th>
                                                            <th scope="col">Status</th>
                                                            
                                                            @if(auth()->user()->hasRole('admin'))
                                                            <th scope="col">Actions</th>
                                                            @else
                                                            <th scope="col"> </th>
                                                            @endif                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($appointments as $appointment)
                                                        @if(auth()->user()->hasRole('patient') && $appointment->patient_id != auth()->user()->patient_id) 
                                                            @continue
                                                        @endif  
                                                        @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('patient') || auth()->user()->hasRole('doctor') ) ) 
                                                            <tr>
                                                                <td>{{ $appointment->doctor->doc_name }}</td>
                                                                <td>{{ $appointment->patient->patient_name }}</td>
                                                                <td>{{ $appointment->appointment_date }}</td>
                                                                    
                                                                    <td>
                                                                    @if ($appointment->availableHour)
                                                                    <div class="date-time-block">
                                                                        <span class="date">{{ \Carbon\Carbon::parse($appointment->availableHour->start_time)->format('d-m-Y') }}</span>
                                                                        <span class="time">{{ \Carbon\Carbon::parse($appointment->availableHour->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($appointment->availableHour->end_time)->format('h:i A') }}</span>
                                                                    </div>
                                                                        @else
                                                                            No available hours
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $appointment->status }}</td>
                                                                    @if(auth()->user()->hasRole('admin'))
                                                                    <td>             
                                                                    @if($appointment->status != 'canceled')                   
                                                                    <form action="{{ route('appointments.cancel', $appointment->apt_id) }}" method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('POST')
                                                                        <button type="submit" class="btn btn-warning">Cancel</button>
                                                                        </form>  
                                                                        @endif
                                                                        @if($appointment->status != 'confirmed')                                       
                                                                        <form action="{{ route('appointments.confirm', $appointment->apt_id) }}" method="POST" style="display: inline;">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-success">Confirm</button>
                                                                        </form>
                                                                        @endif
                                                                        <form action="{{ route('appointments.destroy', $appointment->apt_id) }}" method="POST" style="display: inline;">
                                                                             @csrf
                                                                             @method('DELETE')
                                                                           <button type="submit" class="btn btn-danger">Delete</button>
                                                                        </form>                                                                      
                                                                    </td>
                                                                    @elseif(auth()->user()->hasRole('patient'))
                                                                    <td>
                                                                    @if($appointment->status != 'canceled')     
                                                                    <form action="{{ route('appointments.cancel', $appointment->apt_id) }}" method="POST" onsubmit="return confirmCancellation();" style="display: inline;">
                                                                        @csrf
                                                                        @method('POST')
                                                                        <button type="submit" class="btn">❌</button>
                                                                        </form> 
                                                                    </td> 
                                                                    @endif
                                                                    @endif
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
    @endif
</div>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#appointmentsTable').DataTable({
            "columnDefs": [
            { "orderable": false, "targets": -1 } 
        ]
        });
    });
</script>
@endsection
