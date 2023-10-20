
@extends('layouts.app')

@section('content')

@if (auth()->user()->hasRole('admin'))
    <div class="container">
        <h2>Create Available Hours</h2>
        <form action="{{ route('available-hours.store') }}" method="POST">
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
            <button type="submit" class="btn btn-primary">Create Available Hours</button>
        </form>
    </div>
@else

<h1>You are not allowed to visit this section</h1>

@endif
    <script>


    // Fetching available hours based on the selected doctor and date
    document.getElementById('doctor').addEventListener('change', function () {
        let doctorId = this.value;
        let date = document.getElementById('appointment_date').value;
        fetchAvailableHours(doctorId, date);
    });

    function fetchAvailableHours(doctorId, date) {
        fetch(`/appointments/get-available-hours/${doctorId}/${date}`)
            .then(response => response.json())
            .then(data => {
                // Updating the available hours dropdown with the fetched data
                updateAvailableHoursDropdown(data);
            })
            .catch(error => {
                console.error('Error fetching available hours:', error);
            });
    }

    // Updating the available hours dropdown
    function updateAvailableHoursDropdown(data) {
        let availableHourSelect = document.getElementById('available_hour');
        availableHourSelect.innerHTML = '<option value="" disabled selected>Select Available Hour</option>';

        // Adding the fetched available hours as options
        data.forEach(hour => {
            let option = document.createElement('option');
            option.value = hour.id; 
            option.textContent = `${hour.start_time} - ${hour.end_time}`;
            availableHourSelect.appendChild(option);
        });
    }
</script>
@endsection
