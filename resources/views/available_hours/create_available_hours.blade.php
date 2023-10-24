@extends('layouts.app')

@section('content')

@if (auth()->user()->hasRole('admin'))
    <div class="container">
        <h2>Create Available Hours</h2>
        <form action="{{ route('available-hours.store') }}" method="POST" id="createAvailableHoursForm">
            @csrf
            <div class="mb-3">
                <label for="doc_id" class="form-label">Select Doctor</label>
                <select class="form-control" id="doc_id" name="doc_id" required>
                    <option value="" disabled selected>Select Doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->doc_id }}">{{ $doctor->doc_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" class="form-control" id="start_time" name="start_time" required>
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" class="form-control" id="end_time" name="end_time" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="createAvailableHours()">Create Available Hours</button>
        </form>
    </div>
@else
    <h1>You are not allowed to visit this section</h1>
@endif

<script>
    function createAvailableHours() {
        let form = document.getElementById('createAvailableHoursForm');
        let formData = new FormData(form);

        fetch("/available-hours/store", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); 
        })
        .catch(error => {
            console.error('Error creating available hours:', error);
        });
    }
</script>

@endsection
