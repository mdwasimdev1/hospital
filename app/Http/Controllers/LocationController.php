<?php

namespace App\Http\Controllers;

use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function create(Request $request)
    {
        $query = location::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        $locations = $query->paginate(10);

        return view('backend.locations.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);


        location::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('locations.create')->with('success', 'Location stored successfully!');
    }


    public function edit($id)
    {
        $location = location::findOrFail($id);
        return view('backend.locations.edit', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location = location::findOrFail($id);
        $location->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('locations.create')->with('success', 'Location updated.');
    }


    public function destroy($id)
    {
        $location = location::findOrFail($id);
        $location->delete();

        return response()->json(['success' => true]);
    }
}
