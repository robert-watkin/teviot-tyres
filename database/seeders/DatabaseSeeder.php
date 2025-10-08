<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin and owner accounts
        $this->call([
            OwnerSeeder::class,
            UsersWithVehiclesSeeder::class,
        ]);
    }
}
