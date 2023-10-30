<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Mail\DoctorAppointmentNotification;
use App\Mail\PatientAppointmentConfirmation;
use App\Models\Appointment;
use App\Models\AvailableHour;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }
    public function confirm($id)
    {
        $appointment = Appointment::findOrFail($id);

    $appointment->status = 'confirmed';
    $appointment->save();

    Mail::to($appointment->patient->email)
        ->send(new PatientAppointmentConfirmation(
            $appointment->patient->patient_name,
            $appointment->appointment_date,
            $appointment->doctor->doc_name
        ));

    Mail::to($appointment->doctor->doc_email)
        ->send(new DoctorAppointmentNotification(
            $appointment->patient->patient_name,
            $appointment->appointment_date,
            $appointment->doctor->doc_name
        ));

        return redirect()->route('appointments.index')->with('success', 'Appointment confirmed successfully');
    }

    public function cancel($id)
    {

        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'canceled';
        $appointment->save();
        return redirect()->route('appointments.index')->with('warning', 'Appointment canceled');
    }
    
    public function destroy($id)
{
        // Find the appointment by ID
        $appointment = Appointment::find($id);

        if (!$appointment) {
            // Handle the case where the appointment is not found
            abort(404);
        }

        // Perform the deletion
        $appointment->delete();

    return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully');
}

    public function create(Request $request)
    {

        $departments = Doctor::distinct('specialization')->pluck('specialization');

        $selectedDepartment = $request->input('department');


        $doctors = Doctor::where('specialization', $selectedDepartment)->get();

        return view('appointments.create', compact('departments', 'doctors', 'selectedDepartment'));

    }

    public function store(Request $request)
    {
      
        $user = Auth::user();
        // dd($request->department);

        $selectedHourId = $request->input('available_hour');
        AvailableHour::where('id', $selectedHourId)->update(['is_booked' => 1]);
        $appointment = Appointment::create([
            'patient_id' => $user->patient_id,
            'doc_id' => $request->input('doctor'),
            'department' => $request->input('department'),
            'appointment_date' => $request->input('appointment_date'),
            'description' => $request->input('description'),

        ]);

        $doctor = Doctor::find($request->input('doctor'));


        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'))->with('success', 'Appointment created successfully');
   }

    public function getDoctors($department)
{
    $doctors = Doctor::where('specialization', $department)->get();
    return response()->json($doctors);
}

public function getAvailableHours($doctorId, $date)
{
    $availableHours = AvailableHour::where('doc_id', $doctorId)
        ->whereDate('start_time', $date)
        ->where('is_booked', false)
        ->get();

    return response()->json($availableHours);
}
}
