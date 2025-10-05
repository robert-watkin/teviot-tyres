<?php

namespace App\Http\Controllers;

use App\Services\DvlaVehicleService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VehicleLookupController extends Controller
{
    public function __construct(
        private DvlaVehicleService $dvlaService
    ) {}

    /**
     * Show the vehicle lookup page
     */
    public function index()
    {
        return Inertia::render('public/RegLookup');
    }

    /**
     * Perform vehicle lookup
     */
    public function lookup(Request $request)
    {
        $validated = $request->validate([
            'registration' => [
                'required',
                'string',
                'min:2',
                'max:8',
                'regex:/^[A-Z0-9\s]+$/i',
            ],
        ], [
            'registration.required' => 'Please enter a registration number',
            'registration.regex' => 'Registration number can only contain letters and numbers',
            'registration.min' => 'Registration number is too short',
            'registration.max' => 'Registration number is too long',
        ]);

        $result = $this->dvlaService->lookupVehicle($validated['registration']);

        if (!$result['success']) {
            return back()->withErrors([
                'registration' => $result['error'],
            ])->withInput();
        }

        // Format the vehicle data for display
        $vehicleData = $this->dvlaService->formatVehicleData($result['data']);

        return Inertia::render('public/RegLookup', [
            'vehicle' => $vehicleData,
            'searched' => true,
        ]);
    }
}
