<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333333;
        }
        p {
            color: #666666;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }
        li {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Appointment Confirmation</h2>
        <p>Dear {{ $doc_name }},</p>
        <p>An appointment has been confirmed. Details:</p>
        <ul>
            <li><strong>Patient Name:</strong> {{ $patient_name }}</li>
            <li><strong>Appointment Created on:</strong> {{ $appointment_date }}</li>
            <li><strong>Booked slot:</strong> {{ $start_time }} {{ $end_time }} </li>
        </ul>
    </div>
</body>
</html>
