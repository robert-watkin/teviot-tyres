<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class UsersWithVehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating 50 test users with vehicles...');
        
        // Sample UK names
        $firstNames = [
            'James', 'John', 'Robert', 'Michael', 'William', 'David', 'Richard', 'Joseph', 'Thomas', 'Charles',
            'Mary', 'Patricia', 'Jennifer', 'Linda', 'Elizabeth', 'Barbara', 'Susan', 'Jessica', 'Sarah', 'Karen',
            'Daniel', 'Matthew', 'Andrew', 'Joshua', 'Christopher', 'Paul', 'Mark', 'Donald', 'George', 'Kenneth',
            'Emma', 'Olivia', 'Ava', 'Isabella', 'Sophia', 'Charlotte', 'Mia', 'Amelia', 'Harper', 'Evelyn',
            'Alexander', 'Ryan', 'Benjamin', 'Jack', 'Samuel', 'Oliver', 'Harry', 'Jacob', 'Charlie', 'Oscar'
        ];

        $lastNames = [
            'Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez',
            'Wilson', 'Anderson', 'Taylor', 'Thomas', 'Moore', 'Jackson', 'Martin', 'Lee', 'Thompson', 'White',
            'Harris', 'Clark', 'Lewis', 'Robinson', 'Walker', 'Young', 'Allen', 'King', 'Wright', 'Scott',
            'Green', 'Baker', 'Adams', 'Nelson', 'Hill', 'Campbell', 'Mitchell', 'Roberts', 'Carter', 'Phillips',
            'Evans', 'Turner', 'Parker', 'Collins', 'Edwards', 'Stewart', 'Morris', 'Rogers', 'Reed', 'Cook'
        ];

        // Sample UK registration plates
        $registrations = [
            'AB12CDE', 'CD34EFG', 'EF56HIJ', 'GH78KLM', 'IJ90NOP',
            'KL12QRS', 'MN34TUV', 'OP56WXY', 'QR78ZAB', 'ST90CDE',
            'UV12FGH', 'WX34IJK', 'YZ56LMN', 'AB78OPQ', 'CD90RST',
            'FG12HIJ', 'HI34JKL', 'JK56MNO', 'LM78PQR', 'NO90STU',
            'PQ12VWX', 'RS34YZA', 'TU56BCD', 'VW78EFG', 'XY90HIJ',
            'ZA12KLM', 'BC34NOP', 'DE56QRS', 'FG78TUV', 'HI90WXY',
        ];

        // Sample vehicle data
        $makes = ['Ford', 'Vauxhall', 'BMW', 'Audi', 'Mercedes', 'Toyota', 'Honda', 'Nissan', 'Volkswagen', 'Peugeot'];
        $models = ['Focus', 'Corsa', '3 Series', 'A4', 'C-Class', 'Corolla', 'Civic', 'Qashqai', 'Golf', '308'];
        $colours = ['Black', 'White', 'Silver', 'Blue', 'Red', 'Grey', 'Green', 'Yellow', 'Orange', 'Purple'];

        // Create 50 random users
        $totalVehicles = 0;
        
        for ($i = 1; $i <= 50; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $fullName = "{$firstName} {$lastName}";
            $email = strtolower($firstName) . '.' . strtolower($lastName) . $i . '@test.com';

            $user = User::factory()->create([
                'name' => $fullName,
                'email' => $email,
                'password' => 'password',
                'role' => 'user',
            ]);

            // Create 0-3 vehicles for each user
            $vehicleCount = rand(0, 3);
            $usedRegistrations = []; // Track registrations used by this user
            
            for ($j = 0; $j < $vehicleCount; $j++) {
                $makeIndex = array_rand($makes);
                
                // Get a unique registration for this user
                do {
                    $registration = $registrations[array_rand($registrations)];
                } while (in_array($registration, $usedRegistrations));
                
                $usedRegistrations[] = $registration;
                
                Vehicle::create([
                    'user_id' => $user->id,
                    'registration' => $registration,
                    'vehicle_data' => [
                        'make' => $makes[$makeIndex],
                        'model' => $models[$makeIndex],
                        'colour' => $colours[array_rand($colours)],
                        'year_of_manufacture' => rand(2015, 2024),
                    ],
                    'tyre_size' => '205/55R16',
                    'notes' => null,
                ]);
            }
            
            $totalVehicles += $vehicleCount;
            
            // Log progress every 10 users
            if ($i % 10 === 0) {
                $this->command->info("  Created {$i}/50 users ({$totalVehicles} vehicles so far)...");
            }
        }
        
        $this->command->info("✓ Created 50 users with {$totalVehicles} total vehicles");
    }
}
