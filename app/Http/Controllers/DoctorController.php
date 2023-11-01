<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        $doctor = auth()->guard('doctor')->user();
         $doctors = Doctor::all();  // Fetch all doctors if needed
        $user = Auth::user();
        return view('doctors.index', compact('doctors', 'user','doctor'));
    }
    public function Listing()
    {
        $doctors = Doctor::all();
        return view('doctors.listing', compact('doctors'));
    }
    public function home(){
        return view('doctors.home');
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

    $hashedPassword = Hash::make($validatedData['password']);

    $doctor = Doctor::create([
        'doc_name' => $validatedData['doc_name'],
        'specialization' => $validatedData['specialization'],
        'contact' => $validatedData['contact'],
        'license_number' => $validatedData['license_number'],
        'address' => $validatedData['address'],
        'doc_email' => $validatedData['doc_email'],
        'password' => $hashedPassword,
    ]);

    return redirect()->route('doctors.index')->with('success', 'Doctor added successfully');

}
public function destroy($id)
{
    $doctor = Doctor::findOrFail($id);
    $doctor->delete();
    return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully');
}

}
