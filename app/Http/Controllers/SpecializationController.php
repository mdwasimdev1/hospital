<?php

namespace App\Http\Controllers;

// app/Http/Controllers/SpecializationController.php

use App\Models\location;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpecializationController extends Controller
{


    public function index(Request $request)
    {
        $query = Specialization::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $specializations = $query->paginate(10);
        $locations = location::all();

        return view('backend.specializations.index', compact('locations', 'specializations'));
    }





    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        // Store into database
        Specialization::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'location_id' => $request->location_id,
            'title' => $request->title,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->back()->with('success', 'Specialization created successfully.');
    }


    public function edit($id)
    {
        $specialization = Specialization::findOrFail($id);
        $locations = location::all();
        return view('backend.specializations.edit', ['specialization' => $specialization, 'locations' => $locations]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $specialization = Specialization::findOrFail($id);
        $specialization->update([
            'name' => $request->name,
            'location_id' => $request->location_id,
            'slug' => $request->slug,
            'title' => $request->title,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->route('specializations.index')->with('success', 'Specialization updated.');
    }



    public function destroy($id)
    {
        $specialization = Specialization::findOrFail($id);
        $specialization->delete();

        return response()->json(['success' => true]);
    }
}
