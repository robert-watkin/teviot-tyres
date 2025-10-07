<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin test account
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => 'password',
            'role' => 'admin',
        ]);
    }
}
