<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VehicleLookupController;

Route::get('/', function () {
    return Inertia::render('public/Landing');
})->name('home');

Route::get('dashboard', function () {
    $vehicles = auth()->user()->vehicles()->latest()->get();
    return Inertia::render('Dashboard', [
        'vehicles' => $vehicles,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Public pages
Route::get('services', function () {
    return Inertia::render('public/Services');
})->name('services');

Route::get('reg-lookup', [VehicleLookupController::class, 'index'])->name('reg.lookup');
Route::post('reg-lookup', [VehicleLookupController::class, 'lookup'])
    ->middleware('throttle:10,1') // 10 requests per minute
    ->name('reg.lookup.search');

// Vehicle management (authenticated users only)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('vehicles', [VehicleLookupController::class, 'save'])->name('vehicles.save');
    Route::delete('vehicles/{vehicle}', [VehicleLookupController::class, 'destroy'])->name('vehicles.destroy');
});

Route::get('contact', function () {
    return Inertia::render('public/Contact');
})->name('contact');

Route::get('terms', function () {
    return Inertia::render('public/Terms');
})->name('terms');

Route::get('privacy', function () {
    return Inertia::render('public/Privacy');
})->name('privacy');

// Admin area (admin and owner only)
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/vehicles', [AdminController::class, 'vehicles'])->name('vehicles');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::delete('/vehicles/{vehicle}', [AdminController::class, 'deleteVehicle'])->name('vehicles.delete');
    
    // Owner only routes
    Route::middleware('owner')->group(function () {
        Route::get('/manage-admins', [AdminController::class, 'manageAdmins'])->name('manage-admins');
        Route::post('/users/{user}/promote', [AdminController::class, 'promoteToAdmin'])->name('users.promote');
        Route::post('/users/{user}/demote', [AdminController::class, 'demoteToUser'])->name('users.demote');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
