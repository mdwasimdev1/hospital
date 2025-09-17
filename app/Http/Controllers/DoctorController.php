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
        // ✅ Step 1: Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'phone' => 'required|string|max:20',
            'hospital_id' => 'required|exists:hospitals,id',
            'location_id' => 'required|exists:locations,id',
            'specialization_id' => 'required|exists:specializations,id',
            'designation' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            // Optional fields
            'about' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'preview_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_links' => 'nullable|array',
            'video_links.*' => 'nullable|url',
        ]);

        // ✅ Step 2: Handle file upload for photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('doctors/photos', 'public');
        }

        // ✅ Step 3: Handle multiple preview images
        $previewImagePaths = [];
        if ($request->hasFile('preview_images')) {
            foreach ($request->file('preview_images') as $image) {
                $path = $image->store('doctors/previews', 'public');
                $previewImagePaths[] = $path;
            }
        }

        // ✅ Step 4: Store in the database
        Doctor::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'hospital_id' => $validated['hospital_id'],
            'location_id' => $validated['location_id'],
            'specialization_id' => $validated['specialization_id'],
            'designation' => $validated['designation'],
            'photo' => $photoPath,
            'about' => $validated['about'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'preview_images' => !empty($previewImagePaths) ? json_encode($previewImagePaths) : null,
            'video_links' => isset($validated['video_links']) ? json_encode($validated['video_links']) : null,
        ]);

        return redirect()->back()->with('success', 'Doctor added successfully!');
    }




    public function doctor_list()
    {
        // Doctor model theke sob doctor data niye ashbo
        $doctors = Doctor::with(['specialization', 'hospital', 'location'])->paginate(10);

        return view('backend.doctors.list', compact('doctors'));
    }
}
