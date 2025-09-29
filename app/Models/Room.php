<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['floor_number', 'name', 'type'];

     public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
