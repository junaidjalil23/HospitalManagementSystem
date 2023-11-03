@extends('layouts.app')

@section('content')
@auth('doctor')
<head>
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        function confirmCancellation() {
            return confirm("Do you really want to cancel the appointment?");
        }
    </script>
</head>
    <div class="container">
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
                                                        <th scope="col">Booked Slot ( Date / Time )</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col"> </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($appointments as $appointment)
                                                    @if($appointment->doc_id === auth('doctor')->id())
                                                        <tr>
                                                            <td>{{ $appointment->doctor->doc_name }}</td>
                                                            <td>{{ $appointment->patient->patient_name }}</td>
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
                                                            <td>
                                                                    @if($appointment->status != 'canceled')     
                                                                    <form action="{{ route('appointments.cancel', $appointment->apt_id) }}" method="POST" onsubmit="return confirmCancellation();" style="display: inline;">
                                                                        @csrf
                                                                        @method('POST')
                                                                        <button type="submit" class="btn">❌</button>
                                                                        </form> 
                                                                    </td> 
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
    @endauth
@endsection
