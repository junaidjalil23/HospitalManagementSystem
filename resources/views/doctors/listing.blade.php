@extends('layouts.app')

@section('content')
<head>

<link href="{{ asset('css/table.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

</head>
    <div class="container">
        <h1>Doctors List</h1>
        <table class="table table-dark mb-0" id="simpleDoctorsTable">
            <thead style="background-color: #393939;">
                <tr class="text-uppercase text-success">
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Specialization</th>
                    <th scope="col">License Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->doc_name }}</td>
                        <td>{{ $doctor->doc_email }}</td>
                        <td>{{ $doctor->specialization }}</td>
                        <td>{{ $doctor->license_number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#simpleDoctorsTable').DataTable();
        });
    </script>
@endsection
