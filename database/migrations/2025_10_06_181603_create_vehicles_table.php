<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('registration', 8)->index();
            $table->json('vehicle_data'); // Store all DVLA data
            $table->string('tyre_size')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Prevent duplicate registrations per user
            $table->unique(['user_id', 'registration']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
