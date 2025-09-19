<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RegLookupController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $regInput = trim((string) $request->query('reg', ''));
        $reg = $regInput !== '' ? strtoupper(preg_replace('/\s+/', '', $regInput)) : '';

        $vehicle = null;
        $error = null;

        if ($reg !== '') {
            $apiKey = (string) config('services.dvla.ves_api_key', '');
            $baseUrl = rtrim((string) config('services.dvla.base_url', 'https://driver-vehicle-licensing.api.gov.uk'), '/');
            $endpoint = $baseUrl.'/vehicle-enquiry/v1/vehicles';

            if ($apiKey === '') {
                $error = 'DVLA API key is not configured. Please set DVLA_VES_API_KEY in your .env.';
            } else {
                $cacheKey = 'dvla:ves:reg:'.md5($reg);
                [$vehicle, $error] = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($endpoint, $apiKey, $reg) {
                    try {
                        $response = Http::withHeaders([
                            'x-api-key' => $apiKey,
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                        ])->post($endpoint, [
                            'registrationNumber' => $reg,
                        ]);

                        if ($response->successful()) {
                            $data = $response->json();

                            $vehicle = [
                                'make' => $data['make'] ?? null,
                                'model' => $data['model'] ?? null,
                                'year' => $data['yearOfManufacture'] ?? null,
                                'colour' => $data['colour'] ?? null,
                                'fuelType' => $data['fuelType'] ?? null,
                                'motStatus' => $data['motStatus'] ?? null,
                                'motExpiryDate' => $data['motExpiryDate'] ?? null,
                                'engineCapacity' => $data['engineCapacity'] ?? null,
                                'wheelplan' => $data['wheelplan'] ?? null,
                                'co2Emissions' => $data['co2Emissions'] ?? null,
                                'typeApproval' => $data['typeApproval'] ?? null,
                                'revenueWeight' => $data['revenueWeight'] ?? null,
                                'tyreSize' => null, // Not provided by DVLA VES
                            ];

                            return [$vehicle, null];
                        }

                        if ($response->status() === 404) {
                            return [null, 'Vehicle not found. Please check the registration and try again.'];
                        }

                        // Other error
                        return [null, 'Unable to retrieve vehicle details at the moment. Please try again later.'];
                    } catch (\Throwable $e) {
                        return [null, 'An unexpected error occurred while contacting DVLA. Please try again later.'];
                    }
                });
            }
        }

        return Inertia::render('public/RegLookup', [
            'reg' => $regInput !== '' ? $regInput : null,
            'vehicle' => $vehicle,
            'error' => $error,
        ]);
    }
}
