<?php

namespace App\Console\Commands;

use App\Services\DvlaVehicleService;
use Illuminate\Console\Command;

class TestDvlaLookup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dvla:test {registration? : The vehicle registration number to lookup}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test DVLA vehicle lookup with a registration number';

    /**
     * Execute the console command.
     */
    public function handle(DvlaVehicleService $dvlaService): int
    {
        $registration = $this->argument('registration');

        if (!$registration) {
            $this->info('Testing with DVLA test registration numbers...');
            $this->newLine();
            
            // Test with a valid test registration
            $this->info('Test 1: Valid registration (should succeed in test environment)');
            $registration = 'AA19AAA';
        } else {
            $this->info("Looking up registration: {$registration}");
        }

        $this->newLine();
        $this->info('Environment: ' . app()->environment());
        $this->info('Using: ' . (app()->environment(['local', 'testing']) ? 'TEST' : 'LIVE') . ' API');
        $this->newLine();

        try {
            $result = $dvlaService->lookupVehicle($registration);

            if ($result['success']) {
                $this->info('✓ Vehicle found!');
                $this->newLine();
                
                $formatted = $dvlaService->formatVehicleData($result['data']);
                
                $this->table(
                    ['Field', 'Value'],
                    [
                        ['Registration', $formatted['registration']],
                        ['Make', $formatted['make']],
                        ['Colour', $formatted['colour']],
                        ['Fuel Type', $formatted['fuel_type']],
                        ['Year', $formatted['year_of_manufacture']],
                        ['Engine Capacity', $formatted['engine_capacity'] ?? 'N/A'],
                        ['CO2 Emissions', $formatted['co2_emissions'] ?? 'N/A'],
                        ['Tax Status', $formatted['tax_status']],
                        ['MOT Status', $formatted['mot_status']],
                    ]
                );

                return Command::SUCCESS;
            } else {
                $this->error('✗ Lookup failed');
                $this->error('Error: ' . $result['error']);
                
                if (isset($result['status_code'])) {
                    $this->warn('Status Code: ' . $result['status_code']);
                }
                
                if (isset($result['details'])) {
                    $this->newLine();
                    $this->warn('Details:');
                    $this->line(json_encode($result['details'], JSON_PRETTY_PRINT));
                }

                return Command::FAILURE;
            }
        } catch (\Exception $e) {
            $this->error('Exception occurred: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
