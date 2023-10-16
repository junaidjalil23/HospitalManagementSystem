@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
  
                    <div class="mt-3">
                        <a href="{{ route('doctors.index') }}" class="btn btn-primary">Doctors lists</a><br><br>
                        <a href="{{ route('patients.index') }}" class="btn btn-success">Patients lists</a><br><br>
                        <a href="{{ route('appointments.index') }}" class="btn btn-primary">Appointment lists</a><br><br>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
