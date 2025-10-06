<?php

use App\Models\User;

test('user has correct default role', function () {
    $user = User::factory()->create();
    
    expect($user->role)->toBe('user');
    expect($user->isUser())->toBeTrue();
    expect($user->isAdmin())->toBeFalse();
    expect($user->isOwner())->toBeFalse();
});

test('admin role methods work correctly', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    expect($admin->role)->toBe('admin');
    expect($admin->isUser())->toBeFalse();
    expect($admin->isAdmin())->toBeTrue();
    expect($admin->isOwner())->toBeFalse();
    expect($admin->canManageRoles())->toBeFalse();
});

test('owner role methods work correctly', function () {
    $owner = User::factory()->create(['role' => 'owner']);
    
    expect($owner->role)->toBe('owner');
    expect($owner->isUser())->toBeFalse();
    expect($owner->isAdmin())->toBeTrue();
    expect($owner->isOwner())->toBeTrue();
    expect($owner->canManageRoles())->toBeTrue();
});

test('regular user cannot access admin routes', function () {
    $user = User::factory()->create(['role' => 'user']);
    
    $response = $this->actingAs($user)->get('/admin');
    $response->assertStatus(403);
});

test('admin can access admin routes', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    $response = $this->actingAs($admin)->get('/admin');
    $response->assertStatus(200);
});

test('owner can access admin routes', function () {
    $owner = User::factory()->create(['role' => 'owner']);
    
    $response = $this->actingAs($owner)->get('/admin');
    $response->assertStatus(200);
});

test('admin cannot access owner-only routes', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    $response = $this->actingAs($admin)->get('/admin/manage-admins');
    $response->assertStatus(403);
});

test('owner can access owner-only routes', function () {
    $owner = User::factory()->create(['role' => 'owner']);
    
    $response = $this->actingAs($owner)->get('/admin/manage-admins');
    $response->assertStatus(200);
});

test('cannot delete owner account', function () {
    $owner = User::factory()->create(['role' => 'owner']);
    $admin = User::factory()->create(['role' => 'admin']);
    
    $response = $this->actingAs($admin)->delete("/admin/users/{$owner->id}");
    
    $response->assertSessionHas('error');
    expect(User::find($owner->id))->not->toBeNull();
});

test('owner can promote user to admin', function () {
    $owner = User::factory()->create(['role' => 'owner']);
    $user = User::factory()->create(['role' => 'user']);
    
    $response = $this->actingAs($owner)->post("/admin/users/{$user->id}/promote");
    
    $response->assertSessionHas('success');
    expect($user->fresh()->role)->toBe('admin');
});

test('owner can demote admin to user', function () {
    $owner = User::factory()->create(['role' => 'owner']);
    $admin = User::factory()->create(['role' => 'admin']);
    
    $response = $this->actingAs($owner)->post("/admin/users/{$admin->id}/demote");
    
    $response->assertSessionHas('success');
    expect($admin->fresh()->role)->toBe('user');
});

test('cannot demote owner', function () {
    $owner = User::factory()->create(['role' => 'owner']);
    
    $response = $this->actingAs($owner)->post("/admin/users/{$owner->id}/demote");
    
    $response->assertSessionHas('error');
    expect($owner->fresh()->role)->toBe('owner');
});

test('admin can view users list', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    User::factory()->count(5)->create();
    
    $response = $this->actingAs($admin)->get('/admin/users');
    
    $response->assertStatus(200);
});

test('admin can view vehicles list', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    $response = $this->actingAs($admin)->get('/admin/vehicles');
    
    $response->assertStatus(200);
});
