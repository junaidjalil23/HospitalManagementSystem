<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

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
    public function create(Request $request)
    {
        $departments = Doctor::all(['specialization']);
        if ($request->has('specialization')) {
            $selectedDepartment = $request->input('specialization');
            $doctors = Doctor::where('specialization', $selectedDepartment)->get();
        } else {
            // If no department is selected, set $doctors to null
            $doctors = null;
        }
        $doctors = Doctor::all();

        return view('appointments.create', compact('departments', 'doctors'));
    }

    public function store(Request $request)
    {
        // Validation logic here

        // Create a new appointment
        Appointment::create([
            'department' => $request->input('departments'),
            'doc_id' => $request->input('doctor'),
            'appointment_date' => $request->input('appointment_date'),
            'description' => $request->input('description'),
            // Add other fields as needed
        ]);

        // Redirect or do whatever you need after creating the appointment
    }

}