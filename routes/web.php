<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\LocationController;

Route::get('/add/hospital', [HospitalController::class, 'addHospital'])->name('add.hospital');
Route::post('/store/hospital', [HospitalController::class, 'storeHospital'])->name('hospitals.store');


Route::middleware(['jwt.cookie', 'role:admin'])->group(function () {

    // Location routes for admin only
    Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
    Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');


    // Hospital routes for admin only
    // routes/web.php
    Route::get('/hospitals/index', [HospitalController::class, 'index'])->name('hospitals.index');
    Route::get('/hospitals/create', [HospitalController::class, 'create'])->name('hospitals.create');
    Route::post('/hospitals', [HospitalController::class, 'store'])->name('hospitals.store');
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

    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->middleware('role:user')->name('user.dashboard');
});
