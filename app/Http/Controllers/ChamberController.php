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

        'hospitals' => 'required|array',
        'hospitals.*' => 'exists:hospitals,id',

        'addresses' => 'required|array',
        'addresses.*' => 'required|string',

        'phones' => 'required|array',
        'phones.*' => 'nullable|string',

        'visiting_hours' => 'required|array',
        'visiting_hours.*' => 'nullable|string',
    ]);

    // Just for Chamber's own table — optional global fields
    $combinedAddress = implode(', ', $validated['addresses']);
    $combinedPhone = implode(', ', array_filter($validated['phones']));
    $combinedVisiting = implode(', ', array_filter($validated['visiting_hours']));

    // Create Chamber
    $chamber = Chamber::create([
        'location_id' => $validated['location_id'],
        'doctor_id' => $validated['doctor_id'],
        'address' => $combinedAddress,
        'phone' => $combinedPhone,
        'visiting_hour' => $combinedVisiting,
    ]);

    // Attach each hospital with pivot data
    foreach ($validated['hospitals'] as $hospitalId) {
        $chamber->hospitals()->attach($hospitalId, [
            'address' => $validated['addresses'][$hospitalId] ?? null,
            'phone' => $validated['phones'][$hospitalId] ?? null,
            'visiting_hour' => $validated['visiting_hours'][$hospitalId] ?? null,
        ]);
    }

    return back()->with('success', 'Chamber added successfully!');
}





    public function chambers_list()
    {
        $chambers = Chamber::with(['location', 'hospitals'])->paginate(10);
        return view('backend.doctors.chamber_list', compact('chambers'));
    }








    // public function getByLocation($location_id)
    // {
    //     $doctors = Doctor::where('location_id', $location_id)->get(['id', 'name']); // Only return needed fields

    //     return response()->json($doctors);
    // }
}
