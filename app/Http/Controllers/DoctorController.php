<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\hospital;
use App\Models\location;
use App\Models\Specialization;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function create()
    {
        $specializations = Specialization::all();
        $hospitals = hospital::all();
        $locations = location::all();
        return view('backend.doctors.index', [
            'specializations' => $specializations,
            'hospitals' => $hospitals,
            'locations' => $locations,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:doctors',
            'phone' => 'required',
            'specialization_id' => 'required',
            'hospital_id' => 'required',
            'designation' => 'required',
            'location_id' => 'required',
            'chamber_name' => 'required',
            'chamber_address' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('doctor_photos', 'public');
        }

        Doctor::create($data);

        return redirect()->route('doctors.create')->with('success', 'Doctor added successfully.');
    }



    public function doctor_list()
    {
        // Doctor model theke sob doctor data niye ashbo
        $doctors = Doctor::with(['specialization', 'hospital', 'location'])->paginate(10);

        return view('backend.doctors.list', compact('doctors'));
    }
}
