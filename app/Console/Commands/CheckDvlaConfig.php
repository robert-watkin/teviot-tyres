<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckDvlaConfig extends Command
{
    protected $signature = 'dvla:check';
    protected $description = 'Check DVLA API configuration';

    public function handle(): int
    {
        $this->info('Checking DVLA Configuration...');
        $this->newLine();

        // Check environment
        $env = app()->environment();
        $this->info("Environment: {$env}");
        $this->newLine();

        // Check which key should be used
        $keyToUse = app()->environment(['local', 'testing']) ? 'test' : 'live';
        $this->info("Should use: {$keyToUse} API key");
        $this->newLine();

        // Check test key
        $testKey = config('services.dvla.test_api_key');
        $this->line('Test API Key (DVLA_OPEN_DATA_TEST_API_KEY):');
        if ($testKey) {
            $masked = substr($testKey, 0, 4) . str_repeat('*', strlen($testKey) - 8) . substr($testKey, -4);
            $this->info("  ✓ Set: {$masked}");
        } else {
            $this->error('  ✗ Not set');
        }

        // Check live key
        $liveKey = config('services.dvla.live_api_key');
        $this->line('Live API Key (DVLA_OPEN_DATA_LIVE_API_KEY):');
        if ($liveKey) {
            $masked = substr($liveKey, 0, 4) . str_repeat('*', strlen($liveKey) - 8) . substr($liveKey, -4);
            $this->info("  ✓ Set: {$masked}");
        } else {
            $this->error('  ✗ Not set');
        }

        $this->newLine();

        // Check if current environment has required key
        $currentKey = $keyToUse === 'test' ? $testKey : $liveKey;
        if ($currentKey) {
            $this->info("✓ Current environment ({$env}) has required {$keyToUse} API key configured");
            return Command::SUCCESS;
        } else {
            $this->error("✗ Current environment ({$env}) is missing required {$keyToUse} API key");
            $this->newLine();
            $this->warn('To fix this:');
            $this->line('1. Add to your .env file:');
            $this->line("   DVLA_OPEN_DATA_" . strtoupper($keyToUse) . "_API_KEY=your_key_here");
            $this->line('2. Run: php artisan config:clear');
            return Command::FAILURE;
        }
    }
}
