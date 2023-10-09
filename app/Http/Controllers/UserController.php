<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    public function index()
    {
        $patients = User::all();
        return view('patients.index', compact('patients'));
    }
    public function create()
    {
        return view('patients.create'); 
    }
    public function show($id)
    {
    $patient = User::findOrFail($id);
    return view('patients.show', compact('patient'));
    }

    public function edit($id)
    {
        $patient = User::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_name' => 'required|string',
            'disease' => 'required|string',
            'contact' => 'required|string|min:8',
            'address' => 'required|string',
        ]);

        $patient = User::findOrFail($id);
        $patient->update($request->all());

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully');
    }
    public function destroy($id)
    {
        $patient = User::findOrFail($id);
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_name' => 'required|string',
            'disease' => 'required|string',
            'contact' => 'required|string',
            'address' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email'), 
            ],
            'password' => 'required|string',
        ]);
        

        // Create a new user
        $patient = User::create($validatedData);


        return redirect()->route('patients.index')->with('success', 'Patient added successfully');

    }
    }
