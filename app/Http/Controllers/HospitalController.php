<?php

namespace App\Http\Controllers;

use App\Models\hospital;
use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class HospitalController extends Controller
{

    public function index(Request $request)
    {
        $query = Hospital::with('locations');
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        $hospitals = $query->latest()->paginate(10);
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
            'slug'      => 'required|string|max:255',
            'title'     => 'required|string|max:255',
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
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Make sure the directory exists
            $destinationPath = public_path('uploads/hospitals');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move the uploaded file
            $image->move($destinationPath, $imageName);

            // Save the relative path in DB
            $imagePath = 'uploads/hospitals/' . $imageName;
        }



        $hospital = Hospital::create([
            'name'    => $request->name,
            'slug'    => $request->slug,
            'title'   => $request->title,
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

    public function edit($id)
    {
        $hospital = hospital::with('locations')->findOrFail($id);
        $locations = location::all();
        return view('backend.hospitals.edit', compact('hospital', 'locations'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'slug'      => 'required|string|max:255',
            'title'     => 'required|string|max:255',
            'contact'   => 'required|string|max:20',
            'locations' => 'required|array',
            'locations.*' => 'exists:locations,id',
            'addresses' => 'required|array',
            'addresses.*' => 'string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Fetch the hospital
        $hospital = Hospital::findOrFail($id);  // ← This is the key fix!

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($hospital->image && File::exists(public_path($hospital->image))) {
                File::delete(public_path($hospital->image));
            }

            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/hospitals');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $hospital->image = 'uploads/hospitals/' . $imageName;
        }


        // ✅ Update hospital fields
        $hospital->name = $request->name;
        $hospital->slug = $request->slug;
        $hospital->title = $request->title;
        $hospital->contact = $request->contact;
        $hospital->meta_title = $request->meta_title;
        $hospital->meta_description = $request->meta_description;


        $hospital->save();


        $syncData = [];
        foreach ($request->locations as $locationId) {
            $address = $request->addresses[$locationId] ?? null;
            $syncData[$locationId] = ['address' => $address];
        }

        $hospital->locations()->sync($syncData);

        return redirect()->route('hospitals.index')->with('success', 'Hospital updated successfully!');
    }





    public function destroy($id)
    {
        $hospitals = Hospital::findOrFail($id);
        $hospitals->delete();

        return response()->json(['success' => true]);
    }










    public function addHospital()
    {
        return view('admin.add_hospital');
    }
}
