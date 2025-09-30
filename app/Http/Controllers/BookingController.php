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
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'name' => 'required',
            'role' => 'required',
            'detail' => 'required',
            'purpose' => 'required',
            'participants' => 'required|integer|min:1',
            'attendance_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('attendance_file')) {
            $filePath = $request->file('attendance_file')->store('attendance_files', 'public');
        }

        Booking::create([
            'room_id' => $request->room_id,
            'user_id' => auth()->id(), // 🔑 Link to logged-in user
            'name' => $request->name,
            'role' => $request->role,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'detail' => $request->detail,
            'purpose' => $request->purpose,
            'participants' => $request->participants,
            'attendance_file' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Booking created successfully!');
    }

    public function store_class(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date|afterOrEqual:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'name' => 'required',
            'role' => 'required',
            'detail' => 'required',
            'purpose' => 'required',
            'participants' => 'required|integer|min:1',
            'attendance_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('attendance_file')) {
            $filePath = $request->file('attendance_file')->store('attendance_files', 'public');
        }

        Booking::create([
            'room_id' => $request->room_id,
            'user_id' => auth()->id(), // 🔑 Link to logged-in user
            'name' => $request->name,
            'role' => $request->role,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'detail' => $request->detail,
            'purpose' => $request->purpose,
            'participants' => $request->participants,
            'attendance_file' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Class booking created successfully!');
    }

}
