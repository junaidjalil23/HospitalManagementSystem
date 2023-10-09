<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }
    public function show($id)
{
    $doctor = Doctor::findOrFail($id);
    return view('doctors.show', compact('doctor'));
}
public function create()
{
    return view('doctors.create'); 
}
public function edit($id)
{
    $doctor = Doctor::findOrFail($id);
    return view('doctors.edit', compact('doctor'));
}
public function update(Request $request, $id)
    {
        $request->validate([
            'doc_name' => 'required|string',
            'doc_email' => 'required|string',
            'specialization' => 'required|string',
            'license_number' => 'required|string',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->all());

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully');
    }
public function store(Request $request)
{
    $validatedData = $request->validate([
        'doc_name' => 'required|string',
        'specialization' => 'required|string',
        'contact' => 'required|string',
        'license_number' => 'required|string',
        'address' => 'required|string',
        'doc_email' => [
            'required',
            'string',
            'email',
            Rule::unique('doctors', 'doc_email'), 
        ],
        'password' => 'required|string',

    ]);
    

    // Create a new user
    $patient = Doctor::create($validatedData);


    return redirect()->route('doctors.index')->with('success', 'Doctor added successfully');

}
public function destroy($id)
{
    $doctor = Doctor::findOrFail($id);
    $doctor->delete();
    return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully');
}

}
