<?php

namespace App\Http\Controllers;

use App\Models\location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // ফর্ম দেখানোর জন্য
    public function create()
    {
        $locations = Location::paginate(20);

        return view('backend.locations.create', compact('locations'));
    }

    // ডাটাবেজে লোকেশন সেভ করার জন্য
    public function store(Request $request)
    {
        // ভ্যালিডেশন
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // লোকেশন তৈরি করা
        Location::create([
            'name' => $request->name,
        ]);

        // সফল হলে redirect এবং success message দেখানো
        return redirect()->route('locations.create')->with('success', 'Location stored successfully!');
    }
}
