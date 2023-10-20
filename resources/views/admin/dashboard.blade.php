
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Admin Dashboard') }}</div>

                    <div class="card-body">
                        <div class="btn-group">
                            <a href="{{ route('patients.index') }}" class="btn btn-primary">Patients List</a>
                            <a href="{{ route('doctors.index') }}" class="btn btn-primary">Doctors List</a>
                            <a href="{{ route('appointments.index') }}" class="btn btn-primary">Appointments List</a>
                            <a href="{{ route('set.available.hours') }}" class="btn btn-primary">Set Available Hours</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
