<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\hospital;
use App\Models\location;
use App\Models\Specialization;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home(Request $request)
    {

        $locationId = $request->input('location');
        $specializationParam = $request->input('specialization');
        $hospitalParam = $request->input('hospital');

        $locations = Location::all();
        $specializations = collect();
        $hospitals = collect();

        if ($specializationParam === 'all' && $locationId) {
            $specializations = Specialization::with('location')
                ->where('location_id', $locationId)
                ->get();
        } elseif ($hospitalParam === 'all' && $locationId) {
            $hospitals = Hospital::with('locations')
                ->whereHas('locations', function ($query) use ($locationId) {
                    $query->where('locations.id', $locationId);
                })->get();
        }


        $doctors = Doctor::with(['specialization', 'hospital', 'location'])->get();

        return view('user.home', [
            'doctors' => $doctors,
            'locations' => $locations,
            'specializations' => $specializations,
            'hospitals' => $hospitals,
        ]);
    }






    public function showHospitalsByLocation($locationName)
    {
        $location = Location::where('slug', $locationName)->firstOrFail();

        $hospitals = Hospital::with('locations')
            ->whereHas('locations', function ($query) use ($location) {
                $query->where('locations.id', $location->id);
            })->get();

        return view('user.home', [
            'doctors' => collect(),
            'locations' => Location::all(),
            'specializations' => collect(),
            'hospitals' => $hospitals,
            'selectedLocation' => $location,
        ]);
    }


    public function showSpecializationsByLocation($locationName)
    {
        $location = Location::where('slug', $locationName)->firstOrFail();

        $specializations = Specialization::with('location')
            ->where('location_id', $location->id)
            ->get();

        return view('user.home', [
            'doctors' => collect(),
            'locations' => Location::all(),
            'specializations' => $specializations,
            'hospitals' => collect(),
            'selectedLocation' => $location,
        ]);
    }
}
