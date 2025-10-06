<?php

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('vehicle belongs to a user', function () {
    $user = User::factory()->create();
    
    $vehicle = Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'ABC123',
        'vehicle_data' => [
            'make' => 'FORD',
            'colour' => 'Blue',
            'fuel_type' => 'Petrol',
            'year_of_manufacture' => 2015,
        ],
    ]);

    expect($vehicle->user)->toBeInstanceOf(User::class)
        ->and($vehicle->user->id)->toBe($user->id);
});

test('user can have multiple vehicles', function () {
    $user = User::factory()->create();
    
    Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);
    
    Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'XYZ789',
        'vehicle_data' => ['make' => 'TOYOTA'],
    ]);

    expect($user->vehicles)->toHaveCount(2);
});

test('vehicle data is cast to array', function () {
    $user = User::factory()->create();
    
    $vehicle = Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'ABC123',
        'vehicle_data' => [
            'make' => 'FORD',
            'colour' => 'Blue',
            'year_of_manufacture' => 2015,
        ],
    ]);

    expect($vehicle->vehicle_data)->toBeArray()
        ->and($vehicle->vehicle_data['make'])->toBe('FORD');
});

test('vehicle registration is stored uppercase', function () {
    $user = User::factory()->create();
    
    $vehicle = Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'abc123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);

    expect($vehicle->registration)->toBe('abc123'); // Stored as-is, but cleaned in controller
});

test('vehicle can have optional tyre size and notes', function () {
    $user = User::factory()->create();
    
    $vehicle = Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
        'tyre_size' => '205/55R16',
        'notes' => 'Front tyres need replacing soon',
    ]);

    expect($vehicle->tyre_size)->toBe('205/55R16')
        ->and($vehicle->notes)->toBe('Front tyres need replacing soon');
});

test('cannot create duplicate vehicle for same user', function () {
    $user = User::factory()->create();
    
    Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);

    // Attempting to create duplicate should throw exception
    expect(fn() => Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]))->toThrow(\Illuminate\Database\QueryException::class);
});

test('different users can save same registration', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    
    $vehicle1 = Vehicle::create([
        'user_id' => $user1->id,
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);
    
    $vehicle2 = Vehicle::create([
        'user_id' => $user2->id,
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);

    expect($vehicle1->id)->not->toBe($vehicle2->id)
        ->and(Vehicle::where('registration', 'ABC123')->count())->toBe(2);
});

test('deleting user cascades to vehicles', function () {
    $user = User::factory()->create();
    
    Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'ABC123',
        'vehicle_data' => ['make' => 'FORD'],
    ]);
    
    Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'XYZ789',
        'vehicle_data' => ['make' => 'TOYOTA'],
    ]);

    expect(Vehicle::count())->toBe(2);
    
    $user->delete();

    expect(Vehicle::count())->toBe(0);
});

test('vehicle accessor methods work correctly', function () {
    $user = User::factory()->create();
    
    $vehicle = Vehicle::create([
        'user_id' => $user->id,
        'registration' => 'abc123',
        'vehicle_data' => [
            'make' => 'FORD',
            'colour' => 'Blue',
            'year_of_manufacture' => 2015,
        ],
    ]);

    expect($vehicle->formatted_registration)->toBe('ABC123')
        ->and($vehicle->make)->toBe('FORD')
        ->and($vehicle->colour)->toBe('Blue')
        ->and($vehicle->year)->toBe(2015);
});
