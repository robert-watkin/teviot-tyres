<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create owner account
        User::factory()->create([
            'name' => 'Owner User',
            'email' => 'owner@test.com',
            'password' => 'password',
            'role' => 'owner',
        ]);

        // Create admin account
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => 'password',
            'role' => 'admin',
        ]);
    }
}
