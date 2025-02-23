<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'trip_id',
        'user_id',
        'seat_number',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            $trip = $booking->trip;
            if ($trip->available_seats < 1) {
                throw new \Exception('No available seats for this trip.');
            }
            $trip->available_seats -= 1;
            $trip->save();
        });

        static::deleting(function ($booking) {
            $trip = $booking->trip;
            $trip->available_seats += 1;
            $trip->save();
        });
    }
}
