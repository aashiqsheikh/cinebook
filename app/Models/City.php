<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get the theatres for the city.
     */
    public function theatres(): HasMany
    {
        return $this->hasMany(Theatre::class);
    }

    /**
     * Get the shows for the city.
     */
    public function shows()
    {
        return $this->theatres()->with('shows')->get();
    }
}

