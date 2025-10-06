<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Clear rate limiter
    RateLimiter::clear('');
    
    // Mock DVLA API
    Http::fake([
        'uat.driver-vehicle-licensing.api.gov.uk/*' => Http::response([
            'registrationNumber' => 'ABC123',
            'make' => 'FORD',
        ], 200),
    ]);
});

test('reg lookup has rate limiting', function () {
    // Make 10 requests (should all succeed)
    for ($i = 0; $i < 10; $i++) {
        $response = $this->post(route('reg.lookup.search'), [
            'registration' => "ABC12{$i}",
        ]);
        
        $response->assertStatus(200);
    }
    
    // 11th request should be rate limited
    $response = $this->post(route('reg.lookup.search'), [
        'registration' => 'ABC999',
    ]);
    
    $response->assertStatus(429); // Too Many Requests
});

test('rate limit is per minute', function () {
    // Make 10 requests
    for ($i = 0; $i < 10; $i++) {
        $this->post(route('reg.lookup.search'), [
            'registration' => "ABC12{$i}",
        ]);
    }
    
    // 11th request fails
    $response = $this->post(route('reg.lookup.search'), [
        'registration' => 'ABC999',
    ]);
    $response->assertStatus(429);
    
    // Travel forward 61 seconds
    $this->travel(61)->seconds();
    
    // Should work again
    $response = $this->post(route('reg.lookup.search'), [
        'registration' => 'ABC999',
    ]);
    $response->assertStatus(200);
});

test('rate limit is 10 requests per minute', function () {
    $successCount = 0;
    
    // Try 15 requests
    for ($i = 0; $i < 15; $i++) {
        $response = $this->post(route('reg.lookup.search'), [
            'registration' => "ABC12{$i}",
        ]);
        
        if ($response->status() === 200) {
            $successCount++;
        }
    }
    
    // Exactly 10 should succeed
    expect($successCount)->toBe(10);
});

test('rate limit applies to same IP', function () {
    // Make 10 requests from same IP
    for ($i = 0; $i < 10; $i++) {
        $this->post(route('reg.lookup.search'), [
            'registration' => "ABC12{$i}",
        ]);
    }
    
    // 11th request from same IP should fail
    $response = $this->post(route('reg.lookup.search'), [
        'registration' => 'ABC999',
    ]);
    
    $response->assertStatus(429);
});

test('rate limit does not apply to get request', function () {
    // GET request to show the form should not be rate limited
    for ($i = 0; $i < 15; $i++) {
        $response = $this->get(route('reg.lookup'));
        $response->assertStatus(200);
    }
});

test('rate limit includes retry after header', function () {
    // Make 10 requests to hit the limit
    for ($i = 0; $i < 10; $i++) {
        $this->post(route('reg.lookup.search'), [
            'registration' => "ABC12{$i}",
        ]);
    }
    
    // 11th request should have Retry-After header
    $response = $this->post(route('reg.lookup.search'), [
        'registration' => 'ABC999',
    ]);
    
    $response->assertStatus(429);
    $response->assertHeader('Retry-After');
    $response->assertHeader('X-RateLimit-Limit', '10');
});

test('vehicle save route is not rate limited', function () {
    $user = \App\Models\User::factory()->create();
    
    // Should be able to save up to 10 vehicles (user limit, not rate limit)
    for ($i = 0; $i < 10; $i++) {
        $response = $this->actingAs($user)->post(route('vehicles.save'), [
            'registration' => "ABC12{$i}",
            'vehicle_data' => ['make' => 'FORD'],
        ]);
        
        // First 10 should all succeed (no rate limit on this route)
        $response->assertSessionHasNoErrors();
    }
    
    expect(\App\Models\Vehicle::count())->toBe(10);
    
    // 11th vehicle should fail due to user limit, not rate limiting
    $response = $this->actingAs($user)->post(route('vehicles.save'), [
        'registration' => 'XYZ999',
        'vehicle_data' => ['make' => 'TOYOTA'],
    ]);
    
    $response->assertSessionHas('error');
    expect(\App\Models\Vehicle::count())->toBe(10);
});

test('rate limit resets correctly', function () {
    // Make 5 requests
    for ($i = 0; $i < 5; $i++) {
        $this->post(route('reg.lookup.search'), [
            'registration' => "ABC12{$i}",
        ]);
    }
    
    // Wait 61 seconds
    $this->travel(61)->seconds();
    
    // Should be able to make 10 more requests
    for ($i = 5; $i < 15; $i++) {
        $response = $this->post(route('reg.lookup.search'), [
            'registration' => "ABC12{$i}",
        ]);
        $response->assertStatus(200);
    }
    
    // 11th request in new window should fail
    $response = $this->post(route('reg.lookup.search'), [
        'registration' => 'ABC999',
    ]);
    $response->assertStatus(429);
});
