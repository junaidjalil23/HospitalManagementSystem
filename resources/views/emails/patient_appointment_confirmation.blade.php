<!-- resources/views/emails/patient_appointment_confirmation.blade.php -->
<p>Dear {{ $patient_name }},</p>
<p>Your appointment has been confirmed. Details:</p>
<ul>
    <li>Doctor: {{ $doc_name }}</li>
    <li>Appointment Date: {{ $appointment_date }}</li>
    <!-- Add more details as needed -->
</ul>
