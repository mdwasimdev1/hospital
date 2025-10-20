<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorRequest;
use App\Models\hospital;
use App\Models\location;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:doctors,slug',
            'hospital_id' => 'required|exists:hospitals,id',
            'hospital_name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'specialization_id' => 'integer|exists:specializations,id',
            'speciality' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'about' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'preview_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_links' => 'nullable|url',
            'position' => 'nullable|integer',
        ]);


        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/doctors/photos'), $photoName);


            $photoPath = 'uploads/doctors/photos/' . $photoName;
        }


        $previewImagePaths = [];
        if ($request->hasFile('preview_images')) {
            foreach ($request->file('preview_images') as $image) {
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/doctors/previews'), $imageName);
                $previewImagePaths[] = 'uploads/doctors/previews/' . $imageName;
            }
        }


        $doctor = Doctor::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'hospital_id' => $validated['hospital_id'],
            'hospital_name' => $validated['hospital_name'],
            'location_id' => $validated['location_id'],
            'specialization_id' => $validated['specialization_id'],
            'speciality' => $validated['speciality'],
            'designation' => $validated['designation'],
            'degree' => $validated['degree'],
            'photo' => $photoPath,
            'about' => $validated['about'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'preview_images' => !empty($previewImagePaths) ? json_encode($previewImagePaths) : null,
            'video_links' => $validated['video_links'] ?? null,
            'position' => $validated['position'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Doctor added successfully!');
    }



    public function edit_doctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $specializations = Specialization::all();
        $hospitals = hospital::all();
        $locations = location::all();
        return view('backend.doctors.edit_doctor', [
            'doctor' => $doctor,
            'specializations' => $specializations,
            'hospitals' => $hospitals,
            'locations' => $locations,
        ]);
    }

    public function update(Request $request, $id)
    {

        $doctor = Doctor::findOrFail($id);


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:doctors,slug,' . $doctor->id,
            'hospital_id' => 'required|exists:hospitals,id',
            'hospital_name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'specialization_id' => 'integer|exists:specializations,id',
            'speciality' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'about' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'preview_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_links' => 'nullable|url',
            'position' => 'nullable|integer',
        ]);


        if ($request->hasFile('photo')) {
            if ($doctor->photo && file_exists(public_path($doctor->photo))) {
                unlink(public_path($doctor->photo));
            }

            $photo = $request->file('photo');
            $photoName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/doctors/photos'), $photoName);
            $doctor->photo = 'uploads/doctors/photos/' . $photoName;
        }

        $previewImagePaths = json_decode($doctor->preview_images ?? '[]', true); //

        if ($request->hasFile('preview_images')) {

            foreach ($previewImagePaths as $oldPath) {
                if (file_exists(public_path($oldPath))) {
                    unlink(public_path($oldPath));
                }
            }

            $previewImagePaths = [];
            foreach ($request->file('preview_images') as $image) {
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/doctors/previews'), $imageName);
                $previewImagePaths[] = 'uploads/doctors/previews/' . $imageName;
            }
        }

        $doctor->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'hospital_id' => $validated['hospital_id'],
            'hospital_name' => $validated['hospital_name'],
            'location_id' => $validated['location_id'],
            'specialization_id' => $validated['specialization_id'],
            'speciality' => $validated['speciality'],
            'designation' => $validated['designation'],
            'degree' => $validated['degree'],
            'photo' => $doctor->photo,
            'about' => $validated['about'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'preview_images' => !empty($previewImagePaths) ? json_encode($previewImagePaths) : null,
            'video_links' => $validated['video_links'] ?? null,
            'position' => $validated['position'] ?? null,
        ]);

        return redirect()->route('doctors.list')->with('success', 'Doctor updated successfully!');
    }





    public function destroy($id)
    {
        $doctors = Doctor::findOrFail($id);
        $doctors->delete();

        return response()->json(['success' => true]);
    }
    public function doctor_list(Request $request)
    {
        $query = Doctor::with(['specialization', 'hospital', 'location']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $doctors = $query->paginate(10);

        return view('backend.doctors.list', compact('doctors'));
    }




    public function getSpecializationsByLocation($location_id)
    {
        $specializations = Specialization::where('location_id', $location_id)->get();
        return response()->json($specializations);
    }





    public function doctor_request()
    {
        $doctors = DoctorRequest::paginate(10);
        return view('backend.doctors.doctor_request', compact('doctors'));
    }


    public function doctor_request_view($id)
    {
        $doctorView = DoctorRequest::findOrFail($id);
        return view('backend.doctors.doctor_request_view', compact('doctorView'));
    }




    public function doctor_request_destroy($id)
    {
        $doctorRequest = DoctorRequest::findOrFail($id);
        $doctorRequest->delete();

        return response()->json(['success' => true]);
    }
}
