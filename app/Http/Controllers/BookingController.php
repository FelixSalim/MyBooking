<?php

// app/Http/Controllers/BookingController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;

class BookingController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'room_id'       => 'required|exists:rooms,id',
            'name'          => 'required|string|max:100',
            'role'          => 'nullable|string|max:50',
            'purpose'       => 'required|string',
            'participants'  => 'required|integer|min:1',
            'booking_date'  => 'required|date',
            'start_time'    => 'required|date_format:H:i',
            'end_time'      => 'required|date_format:H:i|after:start_time',
        ]);

        // Check availability
        $overlap = Booking::where('room_id', $request->room_id)
            ->where('booking_date', $request->booking_date)
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function($q) use ($request) {
                          $q->where('start_time', '<', $request->start_time)
                            ->where('end_time', '>', $request->end_time);
                      });
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['time' => 'This room is already booked at that time!'])->withInput();
        }

        // File upload
        $filePath = null;
        if ($request->hasFile('attendance_file')) {
            $filePath = $request->file('attendance_file')->store('attendance', 'public');
        }

        Booking::create([
            'room_id'       => $request->room_id,
            'name'          => $request->name,
            'role'          => $request->role,
            'purpose'       => $request->purpose,
            'participants'  => $request->participants,
            'attendance_file' => $filePath,
            'booking_date'  => $request->booking_date,
            'start_time'    => $request->start_time,
            'end_time'      => $request->end_time,
            'status'        => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success','Booking submitted!');
    }
}
