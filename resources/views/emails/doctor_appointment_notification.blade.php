<!-- resources/views/emails/doctor_appointment_notification.blade.php -->
<p>Dear Dr. {{ $doc_name }},</p>
<p>An appointment has been booked. Details:</p>
<ul>
    <li>Patient: {{ $patient_name }}</li>
    <li>Appointment Date: {{ $appointment_date }}</li>
    <!-- Add more details as needed -->
</ul>
