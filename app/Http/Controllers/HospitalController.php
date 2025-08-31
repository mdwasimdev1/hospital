<?php

namespace App\Http\Controllers;

use App\Models\hospital;
use App\Models\location;
use Illuminate\Http\Request;

class HospitalController extends Controller
{

    public function index()
{
    $hospitals = Hospital::with('locations')->latest()->paginate(10);
    return view('backend.hospitals.index', compact('hospitals'));
}

    public function create()
    {
        $locations = location::all();
        return view('backend.hospitals.create', compact('locations'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name'      => 'required|string|max:255',
        'contact'   => 'required|string|max:20',
        'locations' => 'required|array',
        'locations.*' => 'exists:locations,id',
        'addresses' => 'required|array',
        'addresses.*' => 'string|max:255',
        'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('hospitals', 'public');
    }

    $hospital = Hospital::create([
        'name'    => $request->name,
        'contact' => $request->contact,
        'image'   => $imagePath,
    ]);

    // Prepare pivot data array for locations with address
    $syncData = [];

    foreach ($request->locations as $locationId) {
        $address = $request->addresses[$locationId] ?? null;
        $syncData[$locationId] = ['address' => $address];
    }

    $hospital->locations()->sync($syncData);

    return redirect()->route('hospitals.create')->with('success', 'Hospital created successfully!');
}













    public function addHospital()
    {
        return view('admin.add_hospital');
    }
}
