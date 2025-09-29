<?php
// app/Models/Booking.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id','name','role','purpose','participants',
        'attendance_file','booking_date','start_time','end_time','status'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
