<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\AboutUs;
use App\Models\Advertisement;
use App\Models\AdvertisementPosition;
use App\Models\Chamber;
use App\Models\Disclaimer;
use App\Models\Doctor;
use App\Models\DoctorRequest;
use App\Models\hospital;
// use App\Models\location;
use App\Models\Location;
use App\Models\PaymentCondintion;
use App\Models\Privacy;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class FrontendController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\TrackBreadcrumbs::class);
    }



    public function home(Request $request)
    {
        $locationId = $request->input('location');
        $specializationParam = $request->input('specialization');
        $hospitalParam = $request->input('hospital');

        $locations = Location::all();
        $specializations = collect();
        $hospitals = collect();

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

        $doctors = $doctorsQuery->orderBy('created_at', 'desc')->get();

        $location = Location::find(1);
        $specialization = Specialization::find(1);

        $doctor = Doctor::take(10)->get();
        $aboutUs = AboutUs::first();

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
            'doctor' => $doctor,
            'aboutUs' => $aboutUs
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

    //dortor Url for specialization
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



    public function showHospitalDoctors($hospitalSlug)
    {
        $hospital = Hospital::with(['locations', 'chambers.doctor'])
            ->where('slug', $hospitalSlug)->firstOrFail();


        $doctors = $hospital->chambers->map->doctor->filter()->unique('id');

        $locations = Location::all();



        return view('user.hospital_details', compact('hospital', 'doctors', 'locations'));
    }




    // public function showDoctorsByLocationAndSpecialization($slug)
    // {
    //     $parts = explode('-', $slug);


    //     $locationSlug = array_pop($parts);


    //     $specializationSlug = implode('-', $parts);


    //     $location = location::where('slug', $locationSlug)->firstOrFail();
    //     $specialization = Specialization::where('slug', $specializationSlug)->firstOrFail();


    //     $doctors = Doctor::where('specialization_id', $specialization->id)
    //         ->where('location_id', $location->id)
    //         ->orderByRaw('position IS NULL')
    //         ->orderBy('position')
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     $specializations = Specialization::where('location_id', $location->id)->get();
    //     $locations = Location::all();

    //     return view('user.doctors_list', compact('doctors', 'location', 'specialization', 'locations', 'specializations'));
    // }


    public function showDoctorsByLocationAndSpecialization($slug)
    {
       
        $specialization = Specialization::where('slug', $slug)->firstOrFail();

        $doctors = Doctor::where('specialization_id', $specialization->id)
            ->orderByRaw('position IS NULL')
            ->orderBy('position')
            ->orderBy('created_at', 'desc')
            ->get();

        $locations = Location::all();
        $specializations = Specialization::all();

        return view('user.doctors_list', compact('doctors', 'specialization', 'locations', 'specializations'));
    }








    public function add_profile()
    {
        $locations = Location::all();
        $paymants = PaymentCondintion::first();
        return view('user.footer.add_doctor_profile', ['locations' => $locations, 'paymants' => $paymants]);
    }





    public function about_us()
    {
        $locations = Location::all();
        $aboutUs = AboutUs::first();
        return view('user.footer.about', ['locations' => $locations, 'aboutUs' => $aboutUs]);
    }

    public function privacy_policy()
    {
        $locations = Location::all();
        $privacy = Privacy::first();
        return view('user.footer.privacy', ['privacy' => $privacy, 'locations' => $locations]);
    }

    public function disclaimer_statement()
    {
        $locations = Location::all();
        $disclaimer = Disclaimer::first();
        return view('user.footer.disclaimer', ['disclaimer' => $disclaimer, 'locations' => $locations]);
    }

    public function contact_us()
    {
        $locations = Location::all();
        return view('user.footer.contact', ['locations' => $locations]);
    }
    public function doctor_advertisement(){
        $locations = Location::all();
        $advertisement = Advertisement::first();
        $advertisementPosition = AdvertisementPosition::all();
        return view('user.footer.advertisement', ['locations' => $locations, 'advertisement' => $advertisement, 'advertisementPosition' => $advertisementPosition]);
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'personal_phone' => 'required|string|max:20',
            'bmdc_number' => 'required|string|max:50',
            'degrees' => 'required|string|max:255',
            'fellowships' => 'nullable|string',
            'specialty' => 'required|string|max:255',
            'workplace' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'chamber_name' => 'required|string|max:255',
            'chamber_address' => 'required|string|max:255',
            'visiting_hour' => 'required|string|max:255',
            'appointment_number' => 'required|string|max:50',
            'bKash_transaction' => 'required|string|max:50',
            'about' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Store image
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('doctor_request', 'uploads');
            $validated['photo'] = 'uploads/' . $photoPath;
        }

        // ✅ Create record
        DoctorRequest::create($validated);

        return back()->with('success', 'Doctor request submitted successfully!');
    }
}
