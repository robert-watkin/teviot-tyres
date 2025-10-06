<?php

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Mock DVLA API for all tests
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
});

test('guest cannot save vehicle', function () {
    $response = $this->post(route('vehicles.save'), [
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);

    $response->assertRedirect(route('login'));
});

test('authenticated user can save vehicle', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('vehicles.save'), [
        'registration' => 'ABC123',
        'vehicle_data' => [
            'make' => 'FORD',
            'colour' => 'Blue',
            'fuel_type' => 'Petrol',
            'year_of_manufacture' => 2015,
        ],
    ]);

    $response->assertSessionHas('success');
    expect(Vehicle::count())->toBe(1)
        ->and(Vehicle::first()->registration)->toBe('ABC123')
        ->and(Vehicle::first()->user_id)->toBe($user->id);
});

test('vehicle registration is cleaned before saving', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('vehicles.save'), [
        'registration' => 'abc 123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);

    expect(Vehicle::first()->registration)->toBe('ABC123');
});

test('cannot save duplicate vehicle', function () {
    $user = User::factory()->create();

    // Save first time
    $this->actingAs($user)->post(route('vehicles.save'), [
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);

    // Try to save again
    $response = $this->actingAs($user)->post(route('vehicles.save'), [
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);

    $response->assertSessionHas('error');
    expect(Vehicle::count())->toBe(1);
});

test('can save vehicle with optional tyre size and notes', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('vehicles.save'), [
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
        'tyre_size' => '205/55R16',
        'notes' => 'Front tyres worn',
    ]);

    $vehicle = Vehicle::first();
    expect($vehicle->tyre_size)->toBe('205/55R16')
        ->and($vehicle->notes)->toBe('Front tyres worn');
});

test('vehicle save requires valid data', function () {
    $user = User::factory()->create();

    // Missing registration
    $response = $this->actingAs($user)->post(route('vehicles.save'), [
        'vehicle_data' => ['make' => 'FORD'],
    ]);
    $response->assertSessionHasErrors('registration');

    // Missing vehicle_data
    $response = $this->actingAs($user)->post(route('vehicles.save'), [
        'registration' => 'ABC123',
    ]);
    $response->assertSessionHasErrors('vehicle_data');
});

test('authenticated user can delete their vehicle', function () {
    $user = User::factory()->create();
    
    $vehicle = Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);

    $response = $this->actingAs($user)->delete(route('vehicles.destroy', $vehicle));

    $response->assertSessionHas('success');
    expect(Vehicle::count())->toBe(0);
});

test('user cannot delete another users vehicle', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    
    $vehicle = Vehicle::create([
        'user_id' => $user1->id,
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);

    $response = $this->actingAs($user2)->delete(route('vehicles.destroy', $vehicle));

    $response->assertForbidden();
    expect(Vehicle::count())->toBe(1);
});

test('guest cannot delete vehicle', function () {
    $user = User::factory()->create();
    
    $vehicle = Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);

    $response = $this->delete(route('vehicles.destroy', $vehicle));

    $response->assertRedirect(route('login'));
    expect(Vehicle::count())->toBe(1);
});

test('reg lookup shows is_saved status for authenticated user', function () {
    $user = User::factory()->create();
    
    Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);

    $response = $this->actingAs($user)->post(route('reg.lookup.search'), [
        'registration' => 'ABC123',
    ]);

    $response->assertStatus(200);
    expect($response->viewData('page')['props']['isSaved'])->toBeTrue();
});

test('reg lookup shows is_saved false for unsaved vehicle', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('reg.lookup.search'), [
        'registration' => 'ABC123',
    ]);

    $response->assertStatus(200);
    expect($response->viewData('page')['props']['isSaved'])->toBeFalse();
});

test('dashboard displays saved vehicles', function () {
    $user = User::factory()->create();
    
    Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'ABC123',
        'vehicle_data' => [
            'make' => 'FORD',
            'colour' => 'Blue',
            'year_of_manufacture' => 2015,
        ],
    ]);
    
    Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'XYZ789',
        'vehicle_data' => [
            'make' => 'TOYOTA',
            'colour' => 'Red',
            'year_of_manufacture' => 2018,
        ],
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertStatus(200);
    $vehicles = $response->viewData('page')['props']['vehicles'];
    expect($vehicles)->toHaveCount(2);
});

test('user cannot save more than 10 vehicles', function () {
    $user = User::factory()->create();

    // Create 10 vehicles
    for ($i = 1; $i <= 10; $i++) {
        Vehicle::create([
            'user_id' => $user->id,
            'registration' => "ABC{$i}23",
            'vehicle_data' => ['make' => 'FORD'],
        ]);
    }

    // Try to save 11th vehicle
    $response = $this->actingAs($user)->post(route('vehicles.save'), [
        'registration' => 'XYZ999',
        'vehicle_data' => ['make' => 'TOYOTA'],
    ]);

    $response->assertSessionHas('error');
    expect(Vehicle::where('user_id', $user->id)->count())->toBe(10);
    expect($response->getSession()->get('error'))->toContain('maximum limit of 10');
});

test('intent-based redirect works for unauthenticated users', function () {
    // Guest tries to access reg lookup with autoSave parameter
    $response = $this->get(route('reg.lookup', [
        'registration' => 'ABC123',
        'autoSave' => '1',
    ]));

    // Should show the page with the registration pre-filled
    $response->assertStatus(200);
    $response->assertSee('ABC123');
});
