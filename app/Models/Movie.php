<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster',
        'duration',
        'genre',
        'release_date',
    ];

    protected $casts = [
        'release_date' => 'date',
        'duration' => 'integer',
    ];

    /**
     * Get the shows for the movie.
     */
    public function shows(): HasMany
    {
        return $this->hasMany(Show::class);
    }

    /**
     * Get ratings.
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get average rating.
     */
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    /**
     * Get rating count.
     */
    public function getRatingCountAttribute()
    {
        return $this->ratings()->count();
    }
}

