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
      
        $currentDate = now()->toDateString();
        $availableHour = AvailableHour::create([
        'doc_id' => $request->input('doc_id'),
        'start_time' => "$currentDate {$request->input('start_time')}:00", 
        'end_time' => "$currentDate {$request->input('end_time')}:00",   
        'is_booked' => false,
    ]);
    return response()->json($availableHour, 201);
    // return redirect()->route('available-hours.create')->with('success', 'Available hours created successfully.');
}

public function viewAvailableHours()
{
    
    $doctors = Doctor::with('availableHours')->get();

    return view('available_hours.view_available_hours', compact('doctors'));
}
}