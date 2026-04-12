<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Show extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'theatre_id',
        'show_time',
        'price',
        'show_date',
    ];

    protected $casts = [
        'show_time' => 'datetime:H:i',
        'show_date' => 'date',
        'price' => 'decimal:2',
    ];

    /**
     * Get the movie that owns the show.
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Get the theatre that owns the show.
     */
    public function theatre(): BelongsTo
    {
        return $this->belongsTo(Theatre::class);
    }

    /**
     * Get the bookings for the show.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get ONLY paid booked seats (IMPORTANT FIX)
     */
    public function getBookedSeats()
    {
        return $this->bookings()
->whereIn('payment_status', ['pending', 'paid']) // ✅ Block pending + paid (15min hold)
            ->pluck('seat_number')
            ->toArray();
    }
}
