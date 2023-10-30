<?php


namespace App\Http\Controllers;

use App\Models\AvailableHour;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AvailableHourController extends Controller
{
    public function create()
    {
        $doctors = Doctor::all();
        return view('available_hours.create_available_hours', compact('doctors'));
    }
    public function getAvailableHoursForDoctor($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $availableHours = $doctor->availableHours;
    
        return view('doctors.available_hours', compact('doctor', 'availableHours'));
    }
    
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'doc_id' => 'required|exists:doctors,doc_id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
    
        // Combine the selected date with start and end times
        $startTime = $request->input('date') . ' ' . $request->input('start_time') . ':00';
        $endTime = $request->input('date') . ' ' . $request->input('end_time') . ':00';
    
        // Create the available hour record
        $availableHour = AvailableHour::create([
            'doc_id' => $request->input('doc_id'),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'is_booked' => false,
        ]);
    
        return response()->json($availableHour, 201);
    }
    

public function viewAvailableHours()
{
    
    $doctors = Doctor::with('availableHours')->get();

    return view('available_hours.view_available_hours', compact('doctors'));
}
}