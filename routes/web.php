<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChamberController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SpecializationController;

Route::get('/add/hospital', [HospitalController::class, 'addHospital'])->name('add.hospital');
Route::post('/store/hospital', [HospitalController::class, 'storeHospital'])->name('hospitals.store');


Route::get('/', [FrontendController::class, 'home'])->name('user.home');













Route::middleware(['jwt.cookie', 'role:admin'])->group(function () {

    // Location routes for admin only
    Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
    Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');


    // Hospital routes for admin only
    // routes/web.php
    Route::get('/hospitals/index', [HospitalController::class, 'index'])->name('hospitals.index');
    Route::get('/hospitals/create', [HospitalController::class, 'create'])->name('hospitals.create');
    Route::post('/hospitals', [HospitalController::class, 'store'])->name('hospitals.store');

    Route::get('/specializations/index', [SpecializationController::class, 'index'])->name('specializations.index');
    Route::post('/specializations/store', [SpecializationController::class, 'store'])->name('specializations.store');


    Route::get('/doctors/list', [DoctorController::class, 'doctor_list'])->name('doctors.list');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');




    Route::get('/chambers/create', [ChamberController::class, 'create'])->name('chambers.create');
    Route::post('/chambers', [ChamberController::class, 'store'])->name('chambers.store');
    // Route::get('/doctors-by-location/{location_id}', [DoctorController::class, 'getByLocation']);




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
        return view('admin.dashboard');
    })->middleware('role:admin')->name('admin.dashboard');
});


Route::get('/', [FrontendController::class, 'home'])->name('user.dashboard');

Route::get('/hospitals-{locationName}', [FrontendController::class, 'showHospitalsByLocation'])
    ->name('hospitals.by.location');

Route::get('/doctors-{locationName}', [FrontendController::class, 'showSpecializationsByLocation'])
    ->name('doctors.by.location');

Route::get('/{specializationSlug}-{locationSlug}', [FrontendController::class, 'DoctorsBySpecializationAndLocation'])
    ->name('specialization.location');


Route::get('/{hospitalSlug}-doctor-list-contact', [FrontendController::class, 'HospitalDoctorList'])
    ->name('hospital.doctor.list');

Route::get('location/{location}/hospital/{hospital}', [FrontendController::class, 'showHospitalDoctors'])->name('hospital.details');




Route::get('/doctor/chamber', [FrontendController::class, 'doctor_chamber'])->name('doctor.chamber');

Route::get('/location/{locationSlug}/specialization/{specializationSlug}/doctors', [FrontendController::class, 'showDoctorsByLocationAndSpecialization'])
    ->name('doctors.by.location.specialization');

Route::get('/doctors/{doctor}', [FrontendController::class, 'show'])->name('doctors.show');
