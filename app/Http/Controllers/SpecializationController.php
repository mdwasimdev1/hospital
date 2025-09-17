<?php

namespace App\Http\Controllers;

// app/Http/Controllers/SpecializationController.php

use App\Models\location;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpecializationController extends Controller
{


    public function index()
{
    $locations = location::all();
    $specializations = Specialization::with('location')->paginate(20);
    return view('backend.specializations.index',['locations' => $locations, 'specializations' => $specializations]);
}




    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
        ]);

        // Store into database
        Specialization::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'location_id' => $request->location_id,
        ]);

        return redirect()->back()->with('success', 'Specialization created successfully.');
    }
}

