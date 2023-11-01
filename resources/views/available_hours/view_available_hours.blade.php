@extends('layouts.app')

@section('content')
<head>
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<div class="container">
    <h2>View Available Hours</h2>
    <section class="intro">
        <div class="bg-image h-100" style="background-color: #f5f7fa;">
            <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card shadow-2-strong">
                                <div class="card-body p-0">
                                    <div class="mb-3">
                                        <label for="selectedDate" class="form-label">Please Select the Date</label>
                                        <input type="date" class="form-control" id="selectedDate" onchange="updateAvailableHours()">
                                    </div>
                                    <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px; display: none;">
                                        <table class="table table-dark mb-0" id="availabletb">
                                            <thead style="background-color: #393939;">
                                                <tr class="text-uppercase text-success">
                                                    <th>Doctor Name</th>
                                                    <th>Available Hours</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($doctors as $doctor)
                                                    <tr>
                                                        <td>{{ $doctor->doc_name }}</td>
                                                        <td>
                                                            <div class="available-hours">
                                                                @foreach($doctor->availableHours as $availableHour)
                                                                    <a href="{{ $availableHour->is_booked ? '#' : route('appointments.create', ['doctor' => $doctor->doc_id, 'hour' => $availableHour->id]) }}"
                                                                        class="hour-slot {{ $availableHour->is_booked ? 'booked' : 'available' }}"
                                                                        data-date="{{ \Carbon\Carbon::parse($availableHour->start_time)->toDateString() }}">
                                                                        {{ \Carbon\Carbon::parse($availableHour->start_time)->format('h:i A') }}
                                                                        -
                                                                        {{ \Carbon\Carbon::parse($availableHour->end_time)->format('h:i A') }}
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                    </tr>
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
        $('#availabletb').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": [1, 2]  } 
        ]
    });
    });

    function updateAvailableHours() {
        let selectedDate = document.getElementById('selectedDate').value;

        // If no date is selected, use the current date
        selectedDate = selectedDate || new Date().toISOString().split('T')[0];

        let availableHours = document.querySelectorAll('.hour-slot');
        availableHours.forEach(function (hour) {
            let hourDate = hour.getAttribute('data-date');
            hour.style.display = hourDate === selectedDate ? 'inline-block' : 'none';
        });

        // Show the table once the date is selected
        document.querySelector('.table-scroll').style.display = 'block';
    }
</script>
@endsection
