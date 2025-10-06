<?php

use App\Services\DvlaVehicleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

beforeEach(function () {
    Cache::flush();
});

test('successful lookup is cached', function () {
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
            'registrationNumber' => 'ABC123',
            'make' => 'FORD',
            'colour' => 'BLUE',
            'fuelType' => 'PETROL',
            'yearOfManufacture' => 2015,
        ], 200),
    ]);

    $service = new DvlaVehicleService();
    
    // First lookup - should hit API
    $result1 = $service->lookupVehicle('ABC123');
    
    expect($result1['success'])->toBeTrue()
        ->and(Cache::has('dvla_vehicle_ABC123'))->toBeTrue();
});

test('second lookup uses cache', function () {
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
            'registrationNumber' => 'ABC123',
            'make' => 'FORD',
        ], 200),
    ]);

    $service = new DvlaVehicleService();
    
    // First lookup
    $service->lookupVehicle('ABC123');
    
    // Clear HTTP fake to ensure second call doesn't hit API
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([], 500),
    ]);
    
    // Second lookup - should use cache, not hit API (which would return 500)
    $result2 = $service->lookupVehicle('ABC123');
    
    expect($result2['success'])->toBeTrue()
        ->and($result2['data']['make'])->toBe('FORD');
});

test('cache key is registration uppercase', function () {
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
            'registrationNumber' => 'ABC123',
            'make' => 'FORD',
        ], 200),
    ]);

    $service = new DvlaVehicleService();
    
    // Lookup with lowercase
    $service->lookupVehicle('abc123');
    
    // The service cleans the registration, so check for the cleaned version
    expect(Cache::has('dvla_vehicle_ABC123'))->toBeTrue();
});

test('cache key handles spaces in registration', function () {
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
            'registrationNumber' => 'ABC123',
            'make' => 'FORD',
        ], 200),
    ]);

    $service = new DvlaVehicleService();
    
    // Lookup with spaces
    $service->lookupVehicle('ABC 123');
    
    expect(Cache::has('dvla_vehicle_ABC123'))->toBeTrue();
});

test('skip cache parameter bypasses cache', function () {
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
            'registrationNumber' => 'ABC123',
            'make' => 'FORD',
        ], 200),
    ]);

    $service = new DvlaVehicleService();
    
    // First lookup - cache it
    $service->lookupVehicle('ABC123');
    
    // Modify the cached data
    Cache::put('dvla_vehicle_ABC123', [
        'success' => true,
        'data' => ['make' => 'CACHED_VALUE'],
    ], now()->addHours(24));
    
    // Lookup with skipCache = false (default) - should use cache
    $result1 = $service->lookupVehicle('ABC123', false);
    expect($result1['data']['make'])->toBe('CACHED_VALUE');
    
    // Lookup with skipCache = true - should hit API
    $result2 = $service->lookupVehicle('ABC123', true);
    expect($result2['data']['make'])->toBe('FORD');
});

test('failed lookups are not cached', function () {
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
            'errors' => [['status' => '404', 'title' => 'Not Found']],
        ], 404),
    ]);

    $service = new DvlaVehicleService();
    
    $result = $service->lookupVehicle('NOTFOUND');
    
    expect($result['success'])->toBeFalse()
        ->and(Cache::has('dvla_vehicle_NOTFOUND'))->toBeFalse();
});

test('clear cache method works', function () {
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
            'registrationNumber' => 'ABC123',
            'make' => 'FORD',
        ], 200),
    ]);

    $service = new DvlaVehicleService();
    
    // Cache a lookup
    $service->lookupVehicle('ABC123');
    expect(Cache::has('dvla_vehicle_ABC123'))->toBeTrue();
    
    // Clear the cache
    $service->clearCache('ABC123');
    expect(Cache::has('dvla_vehicle_ABC123'))->toBeFalse();
});

test('clear cache handles registration cleaning', function () {
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
            'registrationNumber' => 'ABC123',
            'make' => 'FORD',
        ], 200),
    ]);

    $service = new DvlaVehicleService();
    
    // Cache with clean registration
    $service->lookupVehicle('ABC123');
    
    // Clear with spaces and lowercase
    $service->clearCache('abc 123');
    
    expect(Cache::has('dvla_vehicle_ABC123'))->toBeFalse();
});

test('cache expires after 24 hours', function () {
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
            'registrationNumber' => 'ABC123',
            'make' => 'FORD',
        ], 200),
    ]);

    $service = new DvlaVehicleService();
    
    // Cache a lookup
    $service->lookupVehicle('ABC123');
    
    // Travel forward 25 hours
    $this->travel(25)->hours();
    
    expect(Cache::has('dvla_vehicle_ABC123'))->toBeFalse();
});

test('different registrations have separate cache entries', function () {
    // Create separate fakes for each registration
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::sequence()
            ->push([
                'registrationNumber' => 'ABC123',
                'make' => 'FORD',
            ], 200)
            ->push([
                'registrationNumber' => 'XYZ789',
                'make' => 'TOYOTA',
            ], 200),
    ]);

    $service = new DvlaVehicleService();
    
    $service->lookupVehicle('ABC123');
    $service->lookupVehicle('XYZ789');
    
    expect(Cache::has('dvla_vehicle_ABC123'))->toBeTrue()
        ->and(Cache::has('dvla_vehicle_XYZ789'))->toBeTrue();
    
    $cached1 = Cache::get('dvla_vehicle_ABC123');
    $cached2 = Cache::get('dvla_vehicle_XYZ789');
    
    expect($cached1['data']['make'])->toBe('FORD')
        ->and($cached2['data']['make'])->toBe('TOYOTA');
});
