<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShuttleBooking extends Model
{
    use HasFactory;

    protected $fillable = ['shuttle_id', 'user_id', 'booking_date', 'name', 'class', 'phone_number', 'detail'];

    public function shuttle()
    {
        return $this->belongsTo(Shuttle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
