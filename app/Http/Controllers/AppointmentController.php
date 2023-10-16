<?php

namespace App\Http\Controllers;

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

    $appointment = Appointment::findOrFail($id);

    $appointment->delete();

    return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully');
}

    public function create(Request $request)
    {
        // $departments = Doctor::all(['specialization']);
        // if ($request->has('specialization')) {
        //     $selectedDepartment = $request->input('specialization');
        //     $doctors = Doctor::where('specialization', $selectedDepartment)->get();
        // } else {
        //     $doctors = null;
        // }
        // $doctors = Doctor::all();

        // return view('appointments.create', compact('departments', 'doctors'));
        $departments = Doctor::distinct('specialization')->pluck('specialization');
 
            // $departments = Doctor::all(['specialization']);

        // Assuming you have the department ID in the request
        $selectedDepartment = $request->input('department');

        // Get the doctors for the selected department
        $doctors = Doctor::where('specialization', $selectedDepartment)->get();

        return view('appointments.create', compact('departments', 'doctors', 'selectedDepartment'));

    }

    public function store(Request $request)
    {
        // Validation logic here
        $user = Auth::user();
        // dd($request->department);
        // Create a new appointment
        $appointment = Appointment::create([
            'patient_id' => $user->patient_id,
            'doc_id' => $request->input('doctor'),
            'department' => $request->input('department'),
            'appointment_date' => $request->input('appointment_date'),
            'description' => $request->input('description'),

        ]);
         // Send email to the patient
             // Send email to the doctor
        $doctor = Doctor::find($request->input('doctor'));
         Mail::to($user->email)->send(new PatientAppointmentConfirmation($user->patient_name,$appointment->appointment_date, $doctor->doc_name));


     Mail::to($doctor->doc_email)->send(new DoctorAppointmentNotification($user->patient_name,$appointment->appointment_date, $doctor->doc_name));

        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'))->with('success', 'Appointment created successfully');
        // Redirect or do whatever you need after creating the appointment
    }

    public function getDoctors($department)
{
    $doctors = Doctor::where('specialization', $department)->get();
    return response()->json($doctors);
}
public function getAvailableHours($doctorId, $date)
{
    $doctor = Doctor::findOrFail($doctorId);
    $availableHours = AvailableHour::where('doc_id', $doctor)
    ->whereDate('start_time', '=', $date)
    ->whereDate('end_time', '=', $date)
    ->where('is_booked', false)
    ->get();
    // $availableHours = $doctor->availableHours()
    //     ->whereDate('start_time', $date)
    //     ->where('is_booked', false)
    //     ->get();

    return response()->json($availableHours);
}

}
//Old create function
// public function create(Request $request)
// {
//     $departments = Doctor::all(['specialization']);
//     if ($request->has('specialization')) {
//         $selectedDepartment = $request->input('specialization');
//         $doctors = Doctor::where('specialization', $selectedDepartment)->get();
//     } else {
//         // If no department is selected, set $doctors to null
//         $doctors = null;
//     }
//     $doctors = Doctor::all();

//     return view('appointments.create', compact('departments', 'doctors'));
// }
