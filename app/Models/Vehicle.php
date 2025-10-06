<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id',
        'registration',
        'vehicle_data',
        'tyre_size',
        'notes',
    ];

    protected $casts = [
        'vehicle_data' => 'array',
    ];

    /**
     * Get the user that owns the vehicle
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get formatted registration (uppercase)
     */
    public function getFormattedRegistrationAttribute(): string
    {
        return strtoupper($this->registration);
    }

    /**
     * Get vehicle make from stored data
     */
    public function getMakeAttribute(): ?string
    {
        return $this->vehicle_data['make'] ?? null;
    }

    /**
     * Get vehicle year from stored data
     */
    public function getYearAttribute(): ?int
    {
        return $this->vehicle_data['year_of_manufacture'] ?? null;
    }

    /**
     * Get vehicle colour from stored data
     */
    public function getColourAttribute(): ?string
    {
        return $this->vehicle_data['colour'] ?? null;
    }
}
