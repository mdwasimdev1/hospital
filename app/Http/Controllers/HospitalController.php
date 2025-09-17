<?php

namespace App\Http\Controllers;

use App\Models\hospital;
use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('hospitals', 'public');
    }

    $slug = Str::slug($request->name); // 🔥 Auto-generate slug from name

    // Ensure unique slug if same name is added multiple times
    $originalSlug = $slug;
    $i = 1;
    while (Hospital::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $i++;
    }

    $hospital = Hospital::create([
        'name'    => $request->name,
        'slug'    => $slug, // ✅ Save slug
        'contact' => $request->contact,
        'meta_title' => $request->meta_title,
        'meta_description' => $request->meta_description,
        'image'   => $imagePath,
    ]);

    // Pivot data for hospital_location table
    $syncData = [];
    foreach ($request->locations as $locationId) {
        $address = $request->addresses[$locationId] ?? null;
        $syncData[$locationId] = ['address' => $address];
    }

    $hospital->locations()->sync($syncData);

    return back()->with('success', 'Hospital created successfully!');
}














    public function addHospital()
    {
        return view('admin.add_hospital');
    }
}
