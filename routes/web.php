<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChamberController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SpecializationController;
use App\Models\Chamber;
use App\Models\Doctor;
use App\Models\DoctorRequest;
use App\Models\hospital;
use App\Models\Specialization;

// Route::get('/add/hospital', [HospitalController::class, 'addHospital'])->name('add.hospital');
// Route::post('/store/hospital', [HospitalController::class, 'storeHospital'])->name('hospitals.store');
















Route::middleware(['jwt.cookie', 'role:admin'])->group(function () {

    // Location routes for admin only
    Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
    Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
    Route::get('/locations/{id}/edit', [LocationController::class, 'edit'])->name('locations.edit');
    Route::put('/locations/{id}', [LocationController::class, 'update'])->name('locations.update');
    Route::delete('/locations/{id}', [LocationController::class, 'destroy'])->name('locations.destroy');


    // Hospital routes for admin only
    Route::get('/hospitals/index', [HospitalController::class, 'index'])->name('hospitals.index');
    Route::get('/hospitals/create', [HospitalController::class, 'create'])->name('hospitals.create');
    Route::post('/hospitals', [HospitalController::class, 'store'])->name('hospitals.store');
    Route::get('/hospitals/{id}/edit', [HospitalController::class, 'edit'])->name('hospitals.edit');
    Route::put('/hospitals/{id}', [HospitalController::class, 'update'])->name('hospitals.update');
    Route::delete('/hospitals/{id}', [HospitalController::class, 'destroy'])->name('hospitals.destroy');


    // Specialization routes for admin only
    Route::get('/specializations/index', [SpecializationController::class, 'index'])->name('specializations.index');
    Route::post('/specializations/store', [SpecializationController::class, 'store'])->name('specializations.store');
    Route::get('/specializations/{id}/edit', [SpecializationController::class, 'edit'])->name('specializations.edit');
    Route::put('/specializations/{id}', [SpecializationController::class, 'update'])->name('specializations.update');
    Route::delete('/specializations/{id}', [SpecializationController::class, 'destroy'])->name('specializations.destroy');


    Route::get('/doctors/list', [DoctorController::class, 'doctor_list'])->name('doctors.list');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit_doctor'])->name('doctors.edit');
    Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');
    Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');

    Route::get('/get-specializations/{location_id}', [DoctorController::class, 'getSpecializationsByLocation']);


    Route::get('/doctors/request', [DoctorController::class, 'doctor_request'])->name('doctors.request');
    Route::get('/doctors/request/view/{id}', [DoctorController::class, 'doctor_request_view'])->name('doctors.request.view');
    Route::delete('/doctors/request/{id}', [DoctorController::class, 'doctor_request_destroy'])->name('doctors.request.destroy');



    Route::get('/chambers/list', [ChamberController::class, 'chambers_list'])->name('chambers.list');
    Route::get('/chambers/create', [ChamberController::class, 'create'])->name('chambers.create');
    Route::post('/chambers', [ChamberController::class, 'store'])->name('chambers.store');
    // Route::get('/doctors-by-location/{location_id}', [DoctorController::class, 'getByLocation']);

    Route::get('/payment/edit', [SettingController::class, 'payment_edit'])->name('payment.edit');
    Route::post('/payment/update', [SettingController::class, 'payment_update'])->name('payment.update');


    Route::get('/aboutUs/edit', [SettingController::class, 'about_us_edit'])->name('aboutUs.edit');
    Route::post('/aboutUs/update', [SettingController::class, 'about_us_update'])->name('aboutUs.update');


    Route::get('/advertisement/edit', [SettingController::class, 'advertisement_edit'])->name('advertisement.edit');
    Route::post('/advertisement/update', [SettingController::class, 'advertisement_update'])->name('advertisement.update');


    Route::get('/advertisement/position', [SettingController::class, 'advertisement_position'])->name('advertisement.position');
    Route::post('/advertisement/position/store', [SettingController::class, 'advertisement_position_store'])->name('advertisement.position.store');
    Route::get('/advertisement/position/{id}/edit', [SettingController::class, 'advertisement_position_edit'])->name('advertisement.position.edit');
    Route::post('/advertisement/position/{id}/update', [SettingController::class, 'advertisement_position_update'])->name('advertisement.position.update');
    Route::post('/advertisement/position/{id}/delete', [SettingController::class, 'advertisement_position_delete'])->name('advertisement.position.delete');


    Route::get('/privacy/edit', [SettingController::class, 'privacy_edit'])->name('privacy.edit');
    Route::post('/privacy/update', [SettingController::class, 'privacy_update'])->name('privacy.update');

    Route::get('/disclaimer/edit', [SettingController::class, 'disclaimer_edit'])->name('disclaimer.edit');
    Route::post('/disclaimer/update', [SettingController::class, 'disclaimer_update'])->name('disclaimer.update');
});

// Auth pages
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected by JWT cookie
Route::middleware(['jwt.cookie'])->group(function () {

    Route::get('/', function () {
        $user = auth('api')->user();

        if (!$user) {
            return redirect()->route('login');
        }
        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    });

    Route::get('/admin/dashboard', function () {
        $totalHospitals = hospital::count();
        $totalDoctors = Doctor::count();
        $totalDoctorsRequest = DoctorRequest::count();
        $totalSpecializations = Specialization::count();
        $totalChambers = Chamber::count();
        return view('admin.dashboard', compact('totalHospitals', 'totalDoctors', 'totalDoctorsRequest', 'totalSpecializations', 'totalChambers'));
    })->middleware('role:admin')->name('admin.dashboard');
});



Route::get('/', [FrontendController::class, 'home'])->name('user.home');

Route::get('/hospitals-{locationName}', [FrontendController::class, 'showHospitalsByLocation'])
    ->name('hospitals.by.location');

Route::get('/doctors-{locationName}', [FrontendController::class, 'showSpecializationsByLocation'])
    ->name('doctors.by.location');




Route::get('/{hospitalSlug}-doctor-list-contact', [FrontendController::class, 'HospitalDoctorList'])
    ->name('hospital.doctor.list');


Route::get('/hospital/{hospitalslug}', [FrontendController::class, 'showHospitalDoctors'])->name('hospital.details');





Route::get('/doctor/chamber', [FrontendController::class, 'doctor_chamber'])->name('doctor.chamber');


Route::get('{slug}', [FrontendController::class, 'showDoctorsByLocationAndSpecialization'])
    ->where('slug', '^[a-z0-9\-]+$')->name('doctors.by.location.specialization');


Route::get('/doctors/{doctor:slug}', [FrontendController::class, 'show'])->name('doctors.show');


Route::get('/add/doctor/profile', [FrontendController::class, 'add_profile'])->name('add.doctor.profile');
Route::post('/store/doctor/profile', [FrontendController::class, 'store'])->name('store.doctor.profile');




Route::get('/about/us', [FrontendController::class, 'about_us'])->name('about.us');
Route::get('/privacy/policy', [FrontendController::class, 'privacy_policy'])->name('privacy.policy');
Route::get('/disclaimer/statement', [FrontendController::class, 'disclaimer_statement'])->name('disclaimer.statement');
Route::get('/contact/us', [FrontendController::class, 'contact_us'])->name('contact.us');
Route::get('/contact/us', [FrontendController::class, 'contact_us'])->name('contact.us');
Route::get('/doctor/advertisement', [FrontendController::class, 'doctor_advertisement'])->name('doctor.advertisement');


Route::get('/privacy', [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/disclaimer', [FrontendController::class, 'disclaimer'])->name('disclaimer');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/advertisement', [FrontendController::class, 'advertisement'])->name('advertisement');






