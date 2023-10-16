@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control">
                 </div>

            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <select name="department" id="department" class="form-control">
                <option value="" disabled selected>Select the department</option>    
                @foreach ($departments as $department)
                        <option value="{{ $department }}" {{ $selectedDepartment == $department ? 'selected' : '' }}>
                            {{ $department }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="doctor" class="form-label">Doctor</label>
                <select name="doctor" id="doctor" class="form-control">
                <option value="" disabled selected>Select the Doctor</option>    
                @foreach ($doctors as $doctor)
                <option value="{{ $doctor->doc_id }}">{{ $doctor->doc_name}}</option>
                @endforeach
                </select>



                <div class="mb-3">
                <label for="available_hour" class="form-label">Available Hours</label>
                <select name="available_hour" id="available_hour" class="form-control">
    
                </select>
            </div>

            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
     // Fetch doctors based on the selected department
     document.getElementById('department').addEventListener('change', function () {
            var department = this.value;
            var doctorDropdown = document.getElementById('doctor');

            // Fetch doctors for the selected department
            fetch(`/get-doctors/${department}`)
                .then(response => response.json())
                .then(doctors => {
                    // Clear existing options
                    doctorDropdown.innerHTML = '';

                    // Populate doctor options
                    doctors.forEach(doctor => {
                        var option = document.createElement('option');
                        option.value = doctor.doc_id;
                        option.text = doctor.doc_name;
                        doctorDropdown.add(option);
                    });
                })
                .catch(error => console.error(error));
        });

//Available Hours List        
    $(document).ready(function () {
        $('#doctor').change(function () {
            var doctorId = $(this).val();

            var appointmentDate = $('#appointment_date').val();


            // Make an AJAX request to fetch available hours based on the selected doctor
            $.ajax({
                url: '/get-available-hours/' + doctorId + '/' + appointmentDate,
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    // Update the available_hour dropdown with the fetched data
                    var options = '<option value="">Select Available Hour</option>';
                    for (var i = 0; i < data.length; i++) {
                        var startDatePart = data[i].start_time.split(' ')[0];
                        if (startDatePart === appointmentDate) {
                        options += '<option value="' + data[i].id + '">' + data[i].start_time + ' - ' + data[i].end_time + '</option>';
                    }                    }
                    $('#available_hour').html(options);
                }
            });
        });
    });

         // Fetch doctors based on the selected department
         document.getElementById('department').addEventListener('change', function () {
            var department = this.value;
            var doctorDropdown = document.getElementById('doctor');

            // Fetch doctors for the selected department
            fetch(`/get-doctors/${department}`)
                .then(response => response.json())
                .then(doctors => {
                    // Clear existing options
                    doctorDropdown.innerHTML = '';

                    // Populate doctor options
                    doctors.forEach(doctor => {
                        var option = document.createElement('option');
                        option.value = doctor.doc_id;
                        option.text = doctor.doc_name;
                        doctorDropdown.add(option);
                    });
                })
                .catch(error => console.error(error));
        });


//  //available hours       
//         // Assuming you have elements for doctor and date selection
//     const doctorDropdown = document.getElementById('doctor');
//     const dateInput = document.getElementById('appointment_date');
//     const availableHourDropdown = document.getElementById('available_hour');

//     // Add an event listener to doctor dropdown
//     doctorDropdown.addEventListener('change', () => {
//         // Get selected doctor and date values
//         const selectedDoctorId = doctorDropdown.value;
//         const selectedDate = dateInput.value;

//         // Fetch available hours based on selected doctor and date
//         fetch(`/get-doctors-available-hours/${selectedDoctorId}/${selectedDate}`)
//             .then(response => response.json())
//             .then(availableHours => {
//                 // Clear existing options
//                 availableHourDropdown.innerHTML = '';

//                 // Populate available hour options
//                 availableHours.forEach(availableHour => {
//                     var option = document.createElement('option');
//                     option.value = availableHour.id;
//                     option.text = `${availableHour.start_time} - ${availableHour.end_time}`;
//                     availableHourDropdown.add(option);
//                 });
//             })
//             .catch(error => console.error(error));
//     });

</script>
@endsection