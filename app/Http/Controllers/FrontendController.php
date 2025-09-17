<?php

namespace App\Http\Controllers;

use App\Models\Chamber;
use App\Models\Doctor;
use App\Models\hospital;
use App\Models\location;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

        // Build doctor query
        $doctorsQuery = Doctor::with(['specialization', 'hospital', 'location']);

        if ($locationId) {
            $doctorsQuery->where('location_id', $locationId);

            $specializations = Specialization::where('location_id', $locationId)->get();

            $hospitals = Hospital::whereHas('locations', function ($query) use ($locationId) {
                $query->where('locations.id', $locationId);
            })->get();
        }

        if ($specializationParam && $specializationParam !== 'all') {
            $doctorsQuery->where('specialization_id', $specializationParam);
        }

        if ($hospitalParam && $hospitalParam !== 'all') {
            $doctorsQuery->where('hospital_id', $hospitalParam);
        }

        $doctors = $doctorsQuery->get();

        $location = Location::find(1); // or request()->input('location_id')
        $specialization = Specialization::find(1); // or request()->input('specialization_id')

        $doctor = Doctor::all();

        return view('user.home', [
            'doctors' => $doctors,
            'locations' => $locations,
            'specializations' => $specializations,
            'hospitals' => $hospitals,
            'selectedLocation' => $locationId,
            'selectedSpecialization' => $specializationParam,
            'selectedHospital' => $hospitalParam,
            'location' => $location,
            'specialization' => $specialization,
            'doctor' => $doctor
        ]);
    }




    // public function showSpecializationsByLocation($locationName)
    // {
    //     // 1. Find the location by slug
    //     $location = Location::where('slug', $locationName)->firstOrFail();

    //     // 2. Get all specializations for that location
    //     $specializations = Specialization::where('location_id', $location->id)->get();

    //     // 3. (Optional) Pick one specialization as the current one, or use request data
    //     $specialization = $specializations->first(); // or use request()->specialization_id

    //     // 4. Return the view and pass all needed data
    //     return view('user.home', compact('location', 'specializations', 'specialization'));
    // }






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

        $specializations = Specialization::where('location_id', $location->id)->get();

        $specialization = $specializations->first();

        return view('user.home', [
            'doctors' => collect(),
            'locations' => Location::all(),
            'specializations' => $specializations,
            'hospitals' => collect(),
            'selectedLocation' => $location,
            'specialization' => $specialization
        ]);
    }
    public function DoctorsBySpecializationAndLocation($specializationSlug, $locationSlug)
    {
        try {
            $location = Location::where('slug', $locationSlug)->firstOrFail();
            $specialization = Specialization::where('slug', $specializationSlug)
                ->where('location_id', $location->id)
                ->firstOrFail();

            $doctors = Doctor::with(['specialization', 'hospital', 'location'])
                ->where('location_id', $location->id)
                ->where('specialization_id', $specialization->id)
                ->get();

            return view('user.home', [
                'doctors' => $doctors,
                'locations' => Location::all(),
                'specializations' => collect(),
                'hospitals' => collect(),
                'selectedLocation' => $location,
                'selectedSpecialization' => $specialization,
            ]);
        } catch (ModelNotFoundException $e) {
            // Apni ekhane chaile custom error message pathate paren
            // return redirect()->back()->with('error', 'Data not found.');

            // Athoba ekta fallback view dekhate paren
            return view('user.home', [
                'doctors' => collect(),
                'locations' => Location::all(),
                'specializations' => collect(),
                'hospitals' => collect(),
                'selectedLocation' => null,
                'selectedSpecialization' => null,
                'error' => 'No data found for this specialization and location.',
            ]);
        }
    }



    public function HospitalDoctorList($hospitalSlug)
    {
        $hospital = Hospital::where('slug', $hospitalSlug)->firstOrFail();

        $doctors = Doctor::with(['specialization', 'location'])
            ->where('hospital_id', $hospital->id)
            ->get();

        return view('user.hospital_doctors', [
            'hospital' => $hospital,
            'doctors' => $doctors,
        ]);
    }






    public function doctor_chamber()
    {
        // $doctors = Doctor::with(['specialization', 'hospital', 'location'])->get();
        // $chambers = Chamber::with(['location', 'doctor', 'hospitals'])->get();
        $doctors = Doctor::with(['specialization', 'chambers.hospitals', 'chambers.location'])->get();

        return view('user.doctor_chamber', [
            'doctors' => $doctors,
            'locations' => Location::all(),
        ]);
    }


    public function show(Doctor $doctor)
    {
        // Load chambers with related hospitals and location
        $doctor->load(['specialization', 'chambers.hospitals', 'chambers.location']);
        $locations = Location::all();

        return view('user.doctor_show', compact('doctor', 'locations'));
    }




    public function showHospitalDoctors($locationSlug, $hospitalSlug)
    {
        $location = Location::where('slug', $locationSlug)->firstOrFail();

        $hospital = Hospital::with('locations')->where('slug', $hospitalSlug)
            ->whereHas('locations', function ($query) use ($location) {
                $query->where('locations.id', $location->id);
            })
            ->firstOrFail();

        $doctors = $hospital->chambers()->with('doctor')->get()->pluck('doctor')->unique('id');
        $locations = Location::all();

        return view('user.hospital_details', compact('location', 'hospital', 'doctors', 'locations'));
    }




    public function showDoctorsByLocationAndSpecialization($locationSlug, $specializationSlug)
    {
        $location = Location::where('slug', $locationSlug)->firstOrFail();
        $specialization = Specialization::where('slug', $specializationSlug)->firstOrFail();

        // Get doctors who have the specialization and have a chamber in that location
        $doctors = Doctor::where('specialization_id', $specialization->id)
            ->whereHas('chambers', function ($query) use ($location) {
                $query->where('location_id', $location->id);
            })
            ->get();

        $locations = Location::all(); // For navbar or reuse
        $specializations = Specialization::all(); // If needed

        return view('user.doctors_list', compact('doctors', 'location', 'specialization', 'locations', 'specializations'));
    }
}
