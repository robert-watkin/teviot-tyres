<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\VehicleLookupController;

Route::get('/', function () {
    return Inertia::render('public/Landing');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public pages
Route::get('services', function () {
    return Inertia::render('public/Services');
})->name('services');

Route::get('reg-lookup', [VehicleLookupController::class, 'index'])->name('reg.lookup');
Route::post('reg-lookup', [VehicleLookupController::class, 'lookup'])->name('reg.lookup.search');

Route::get('contact', function () {
    return Inertia::render('public/Contact');
})->name('contact');

Route::get('terms', function () {
    return Inertia::render('public/Terms');
})->name('terms');

Route::get('privacy', function () {
    return Inertia::render('public/Privacy');
})->name('privacy');

// Admin area (restrict access; TODO: add authorization/roles)
Route::get('admin', function () {
    return Inertia::render('admin/Index');
})->middleware(['auth', 'verified'])->name('admin.index');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
