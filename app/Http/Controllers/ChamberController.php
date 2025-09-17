<?php

namespace App\Http\Controllers;

use App\Models\Chamber;
use App\Models\Doctor;
use App\Models\hospital;
use App\Models\location;
use Illuminate\Http\Request;

class ChamberController extends Controller
{
    public function create()
    {
        $locations = location::all();
        $hospitals = hospital::all();
        $doctors = Doctor::all();
        return view(
            'backend.doctors.chamber',
            [
                'locations' => $locations,
                'hospitals' => $hospitals,
                'doctors' => $doctors
            ]
        );
    }





    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'doctor_id' => 'required|exists:doctors,id',
            'visiting_hour' => 'nullable|string',
            'phone' => 'nullable|string',
            'hospitals' => 'required|array',
            'hospitals.*' => 'exists:hospitals,id',
            'addresses' => 'required|array',
            'addresses.*' => 'required|string',
        ]);
        $combinedAddress = implode(', ', $validated['addresses']);
        // Create the chamber
        $chamber = Chamber::create([
            'location_id' => $validated['location_id'],
            'doctor_id' => $validated['doctor_id'],
            'visiting_hour' => $validated['visiting_hour'],
            'phone' => $validated['phone'],
            'address' => $combinedAddress,
        ]);

        // Attach hospitals with address
        foreach ($validated['hospitals'] as $hospitalId) {
            $address = $validated['addresses'][$hospitalId] ?? null;
            $chamber->hospitals()->attach($hospitalId, ['address' => $address]);
        }

        return back()->with('success', 'Chamber added successfully!');
    }
    // public function getByLocation($location_id)
    // {
    //     $doctors = Doctor::where('location_id', $location_id)->get(['id', 'name']); // Only return needed fields

    //     return response()->json($doctors);
    // }
}
