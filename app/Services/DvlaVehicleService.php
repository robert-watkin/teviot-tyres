<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DvlaVehicleService
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        // Use test API key if in local/testing environment, otherwise use live
        $apiKey = app()->environment(['local', 'testing'])
            ? config('services.dvla.test_api_key')
            : config('services.dvla.live_api_key');

        if (empty($apiKey)) {
            throw new \RuntimeException(
                'DVLA API key not configured. Please set ' . 
                (app()->environment(['local', 'testing']) ? 'DVLA_OPEN_DATA_TEST_API_KEY' : 'DVLA_OPEN_DATA_LIVE_API_KEY') .
                ' in your .env file and run: php artisan config:clear'
            );
        }

        $this->apiKey = $apiKey;

        // Use test URL if in local/testing environment, otherwise use live
        $this->baseUrl = app()->environment(['local', 'testing'])
            ? 'https://uat.driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles'
            : 'https://driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles';
    }

    /**
     * Look up vehicle details by registration number
     *
     * @param string $registrationNumber
     * @return array
     * @throws \Exception
     */
    public function lookupVehicle(string $registrationNumber): array
    {
        // Clean the registration number (remove spaces and convert to uppercase)
        $cleanReg = strtoupper(preg_replace('/[^A-Z0-9]/', '', $registrationNumber));

        if (empty($cleanReg)) {
            throw new \InvalidArgumentException('Invalid registration number format');
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl, [
                'registrationNumber' => $cleanReg,
            ]);

            // Handle different response codes
            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                ];
            }

            // Handle specific error codes
            return $this->handleErrorResponse($response);

        } catch (\Exception $e) {
            Log::error('DVLA API Error', [
                'registration' => $cleanReg,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => 'An error occurred while looking up the vehicle',
                'message' => app()->environment('local') ? $e->getMessage() : null,
            ];
        }
    }

    /**
     * Handle error responses from the DVLA API
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return array
     */
    private function handleErrorResponse($response): array
    {
        $statusCode = $response->status();
        $body = $response->json();

        $errorMessage = match ($statusCode) {
            400 => 'Invalid registration number format',
            404 => 'Vehicle not found',
            429 => 'Too many requests. Please try again later',
            500 => 'DVLA service error. Please try again later',
            503 => 'DVLA service temporarily unavailable',
            default => 'An error occurred while looking up the vehicle',
        };

        Log::warning('DVLA API Error Response', [
            'status' => $statusCode,
            'body' => $body,
        ]);

        return [
            'success' => false,
            'error' => $errorMessage,
            'status_code' => $statusCode,
            'details' => $body['errors'] ?? null,
        ];
    }

    /**
     * Format vehicle data for display
     *
     * @param array $vehicleData
     * @return array
     */
    public function formatVehicleData(array $vehicleData): array
    {
        return [
            'registration' => $vehicleData['registrationNumber'] ?? 'N/A',
            'make' => $vehicleData['make'] ?? 'N/A',
            'colour' => ucfirst(strtolower($vehicleData['colour'] ?? 'N/A')),
            'fuel_type' => ucfirst(strtolower($vehicleData['fuelType'] ?? 'N/A')),
            'year_of_manufacture' => $vehicleData['yearOfManufacture'] ?? 'N/A',
            'engine_capacity' => $vehicleData['engineCapacity'] ?? null,
            'co2_emissions' => $vehicleData['co2Emissions'] ?? null,
            'tax_status' => $vehicleData['taxStatus'] ?? 'N/A',
            'tax_due_date' => $vehicleData['taxDueDate'] ?? null,
            'mot_status' => $vehicleData['motStatus'] ?? 'N/A',
            'month_of_first_registration' => $vehicleData['monthOfFirstRegistration'] ?? null,
            'marked_for_export' => $vehicleData['markedForExport'] ?? false,
            'euro_status' => $vehicleData['euroStatus'] ?? null,
        ];
    }
}
