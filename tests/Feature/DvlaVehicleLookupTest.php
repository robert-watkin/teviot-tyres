<?php

namespace Tests\Feature;

use App\Services\DvlaVehicleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DvlaVehicleLookupTest extends TestCase
{
    /**
     * Test successful vehicle lookup
     */
    public function test_successful_vehicle_lookup(): void
    {
        Http::fake([
            'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
                'registrationNumber' => 'ABC123',
                'make' => 'FORD',
                'colour' => 'BLUE',
                'fuelType' => 'PETROL',
                'yearOfManufacture' => 2015,
                'engineCapacity' => 1600,
                'co2Emissions' => 120,
                'taxStatus' => 'Taxed',
                'motStatus' => 'Valid',
            ], 200),
        ]);

        $service = new DvlaVehicleService();
        $result = $service->lookupVehicle('ABC123');

        $this->assertTrue($result['success']);
        $this->assertEquals('ABC123', $result['data']['registrationNumber']);
        $this->assertEquals('FORD', $result['data']['make']);
    }

    /**
     * Test vehicle not found (404)
     */
    public function test_vehicle_not_found(): void
    {
        Http::fake([
            'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
                'errors' => [
                    [
                        'status' => '404',
                        'code' => '404',
                        'title' => 'Not Found',
                        'detail' => 'Vehicle not found',
                    ],
                ],
            ], 404),
        ]);

        $service = new DvlaVehicleService();
        $result = $service->lookupVehicle('NOTFOUND');

        $this->assertFalse($result['success']);
        $this->assertEquals('Vehicle not found', $result['error']);
    }

    /**
     * Test invalid registration format (400)
     */
    public function test_invalid_registration_format(): void
    {
        Http::fake([
            'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
                'errors' => [
                    [
                        'status' => '400',
                        'code' => '400',
                        'title' => 'Bad Request',
                        'detail' => 'Invalid format for field - vehicle registration number',
                    ],
                ],
            ], 400),
        ]);

        $service = new DvlaVehicleService();
        $result = $service->lookupVehicle('INVALID!!!');

        $this->assertFalse($result['success']);
        $this->assertEquals('Invalid registration number format', $result['error']);
    }

    /**
     * Test rate limiting (429)
     */
    public function test_rate_limiting(): void
    {
        Http::fake([
            'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([], 429),
        ]);

        $service = new DvlaVehicleService();
        $result = $service->lookupVehicle('ABC123');

        $this->assertFalse($result['success']);
        $this->assertEquals('Too many requests. Please try again later', $result['error']);
    }

    /**
     * Test registration number cleaning
     */
    public function test_registration_number_cleaning(): void
    {
        Http::fake([
            'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
                'registrationNumber' => 'ABC123',
                'make' => 'FORD',
            ], 200),
        ]);

        $service = new DvlaVehicleService();
        
        // Test with spaces
        $result = $service->lookupVehicle('ABC 123');
        $this->assertTrue($result['success']);
        
        // Test with lowercase
        $result = $service->lookupVehicle('abc123');
        $this->assertTrue($result['success']);
        
        // Test with mixed
        $result = $service->lookupVehicle('aBc 123');
        $this->assertTrue($result['success']);
    }

    /**
     * Test vehicle lookup form submission
     */
    public function test_vehicle_lookup_form_submission(): void
    {
        Http::fake([
            'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
                'registrationNumber' => 'ABC123',
                'make' => 'FORD',
                'colour' => 'BLUE',
                'fuelType' => 'PETROL',
                'yearOfManufacture' => 2015,
            ], 200),
        ]);

        $response = $this->post(route('reg.lookup.search'), [
            'registration' => 'ABC123',
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test form validation
     */
    public function test_form_validation(): void
    {
        // Test empty registration
        $response = $this->post(route('reg.lookup.search'), [
            'registration' => '',
        ]);
        $response->assertSessionHasErrors('registration');

        // Test invalid characters
        $response = $this->post(route('reg.lookup.search'), [
            'registration' => 'ABC@123',
        ]);
        $response->assertSessionHasErrors('registration');

        // Test too long
        $response = $this->post(route('reg.lookup.search'), [
            'registration' => 'ABCDEFGHI',
        ]);
        $response->assertSessionHasErrors('registration');
    }
}
