@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Appointment</h2>
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="department" class="form-label">Select Department</label>
                <select class="form-control" id="department" name="department" required>
                    <option value="" disabled selected>Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department }}">{{ $department }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="doctor" class="form-label">Select Doctor</label>
                <select class="form-control" id="doctor" name="doctor" required>
                    
                </select>
            </div>
            <div class="mb-3">
                <label for="appointment_date" class="form-label">Select Date</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
            </div>
            <div class="form-group">
                <label for="available_hour">Select Available Hour</label>
                <select name="available_hour" id="available_hour" class="form-control" required>
                    <option value="" disabled selected>Select Available Hour</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Appointment</button>
        </form>
    </div>
    <script>
        // Fetching doctors based on the selected department
        $('#department').change(function () {
            let department = $(this).val();
            fetchDoctors(department);
        });

        function fetchDoctors(department) {
            fetch(`/get-doctors/${department}`)
                .then(response => response.json())
                .then(data => {
                    let doctorSelect = document.getElementById('doctor');
                    doctorSelect.innerHTML = '<option value="" disabled selected>Select Doctor</option>';
                    data.forEach(doctor => {
                        let option = document.createElement('option');
                        option.value = doctor.doc_id;
                        option.textContent = doctor.doc_name;
                        doctorSelect.appendChild(option);
                    });
                });
        }

        // Fetching available hours when a doctor is selected
        function fetchAvailableHours(doctorId, date) {
            $.ajax({
                url: `/get-available-hours/${doctorId}/${date}`,
                type: 'GET',
                success: function (response) {
                    updateAvailableHoursDropdown(response);
                },
                error: function (error) {
                    console.error('Error fetching available hours:', error);
                }
            });
        }

        // updating the available hours dropdown
        function updateAvailableHoursDropdown(hours) {
            let availableHourSelect = $('#available_hour');
            availableHourSelect.empty();
            availableHourSelect.append('<option value="" disabled selected>Select Available Hour</option>');
            hours.forEach(function (hour) {
                availableHourSelect.append($('<option>', {
                    value: hour.id,
                    text: `${hour.start_time} - ${hour.end_time}`
                }));
            });
        }

        // creating an appointment
        function createAppointment() {
            let selectedDoctorId = $('#doctor').val();
            let selectedDate = $('#appointment_date').val();
            let selectedHourId = $('#available_hour').val();

            $.ajax({
                url: '/create-appointment', 
                type: 'POST',
                data: {
                    doctor_id: selectedDoctorId,
                    appointment_date: selectedDate,
                    available_hour: selectedHourId,
                   
                },
                success: function (response) {
                   
                },
                error: function (error) {
                    console.error('Error creating appointment:', error);
                }
            });
        }

        // Handling changes to the doctor and date inputs
        $('#doctor, #appointment_date').change(function () {
            fetchAvailableHours($('#doctor').val(), $('#appointment_date').val());
        });
    </script>
@endsection
