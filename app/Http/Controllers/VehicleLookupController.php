<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
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

        // Check if user has already saved this vehicle
        $isSaved = false;
        if ($request->user()) {
            $isSaved = $request->user()->vehicles()
                ->where('registration', strtoupper(preg_replace('/[^A-Z0-9]/', '', $validated['registration'])))
                ->exists();
        }

        return Inertia::render('public/RegLookup', [
            'vehicle' => $vehicleData,
            'searched' => true,
            'isSaved' => $isSaved,
        ]);
    }

    /**
     * Save a vehicle to the user's account
     */
    public function save(Request $request)
    {
        $validated = $request->validate([
            'registration' => 'required|string|max:8',
            'vehicle_data' => 'required|array',
            'tyre_size' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Clean registration (remove non-alphanumeric, then uppercase)
        $cleanReg = strtoupper(preg_replace('/[^A-Z0-9]/i', '', $validated['registration']));

        // Check if already saved
        $existing = $request->user()->vehicles()
            ->where('registration', $cleanReg)
            ->first();

        if ($existing) {
            return back()->with('error', 'Vehicle already saved to your account');
        }

        $request->user()->vehicles()->create([
            'registration' => $cleanReg,
            'vehicle_data' => $validated['vehicle_data'],
            'tyre_size' => $validated['tyre_size'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return back()->with('success', 'Vehicle saved successfully');
    }

    /**
     * Delete a saved vehicle
     */
    public function destroy(Request $request, Vehicle $vehicle)
    {
        // Ensure the vehicle belongs to the authenticated user
        if ($vehicle->user_id !== $request->user()->id) {
            abort(403);
        }

        $vehicle->delete();

        return back()->with('success', 'Vehicle removed from your account');
    }
}
