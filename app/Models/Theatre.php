<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theatre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city_id',
        'location',
        'total_seats',
    ];

    protected $casts = [
        'total_seats' => 'integer',
    ];

    /**
     * Get the city that owns the theatre.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the shows for the theatre.
     */
    public function shows(): HasMany
    {
        return $this->hasMany(Show::class);
    }
}

