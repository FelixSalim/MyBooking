<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'user_id',
        'name',
        'role',
        'booking_date',
        'start_time',
        'end_time',
        'category',
        'detail',
        'purpose',
        'participants',
        'attendance_file',
        'status',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
