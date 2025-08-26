<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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



