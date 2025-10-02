<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shuttle extends Model
{
    use HasFactory;

    protected $fillable = ['destination', 'capacity'];

    public function bookings()
    {
        return $this->hasMany(ShuttleBooking::class);
    }

    public function remainingSeats($date)
    {
        $booked = $this->bookings()->where('booking_date', $date)->count();
        return $this->capacity - $booked;
    }
}
    
