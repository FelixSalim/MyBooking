<?php

namespace App\Http\Controllers;

use App\Models\Shuttle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;

class PageController extends Controller
{
    public function home()
    {
        $rooms = Auth::user()->bookings()
            ->orderBy('booking_date', 'desc')
            ->get()
            ->map(function ($booking) {
                return (object) [
                    'name'   => strtoupper($booking->room->name),
                    'time'   => $booking->start_time . ' - ' . $booking->end_time,
                    'date'   => \Carbon\Carbon::parse($booking->booking_date)->format('d/m'),
                    'status' => ucfirst($booking->status), // Approved, Pending, Cancelled
                ];
            });

            $shuttles = Auth::user()->shuttleBookings()
                ->orderBy('booking_date', 'desc')
                ->get();

        return view('home', compact('rooms', 'shuttles'));
    }

    public function bookRoom()
    {
        $rooms = [
            (object) [
                'name' => 'Discussion',
            ],
            (object) [
                'name' => 'Amphitheater',
            ],
            (object) [
                'name' => 'Thinktank',
            ],
            (object) [
                'name' => 'Class',
            ],
        ];

        return view('book.room', compact('rooms'));
    }

    public function bookShuttle($selected) {
        $shuttles = Shuttle::select(['destination', 'capacity'])->get()->unique('destination');
        $selected = ($selected == 'None') ? null : $selected;
        $destination = $selected;
        $toShuttle = Shuttle::where('destination', '=', $destination)->where('direction', '=', 'to')->first();
        $fromShuttle = Shuttle::where('destination', '=', $destination)->where('direction', '=', 'from')->first();

        return view('book.shuttle', compact('shuttles', 'selected','destination', 'fromShuttle', 'toShuttle'));
    }

    public function showRoom($roomName)
    {
        $roomName = strtolower($roomName);
        if ($roomName === 'discussion') {
            return $this->discussion();
        } elseif ($roomName === 'amphitheater') {
            return $this->ampitheatreForm();
        } elseif ($roomName === 'thinktank') {
            return $this->thinktankForm();
        } elseif ($roomName === 'class') {
            return $this->class();
        } else {
            abort(404);
        }
    }

    public function discussion()
    {
        $discussionRooms = Room::where('type', 'discussion')->get();

        return view('book.discussion', compact('discussionRooms'));
    }


    public function discussionForm($id)
    {
        $room = Room::findOrFail($id);
        $rooms = Room::where('type', '=', 'discussion')->get();
        $waiting = Booking::where('room_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('book.discussion-book', compact('room', 'rooms', 'waiting'));
    }

    public function class() {
        $floors = Room::where('type', 'class')
            ->select('floor_number')->get()->map(function($item) {
                $item->floor_number = substr($item->floor_number, 0, -2);
                return $item;
            });
        $floors = $floors->unique('floor_number')->sortBy('floor_number')->values();

        return view('book.class.index', compact('floors'));
    }

    public function pick_floor($floor) {
        $rooms = Room::where('type', 'class')
            ->whereLike('floor_number',  $floor . '%')
            ->orderBy('name')
            ->get();

        return view('book.class.pick-room', compact('rooms', 'floor'));
    }

    public function classForm($id) {
        $room = Room::findOrFail($id);
        $rooms = Room::where('type', '=', 'class')->get();
        $waiting = Booking::where('room_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('book.class.class-book', compact('room', 'rooms', 'waiting'));
    }

    public function ampitheatreForm() {
        $room = Room::where('type', '=', 'amphitheater')->first();
        $rooms = Room::where('type', '=', 'amphitheater')->get();
        $waiting = Booking::where('room_id', '=', $room->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('book.ampitheatre.ampitheatre-book', compact('room', 'rooms', 'waiting'));
    }

    public function thinktankForm() {
        $room = Room::where('type', '=', 'thinktank')->first();
        $rooms = Room::where('type', '=', 'thinktank')->get();
        $waiting = Booking::where('room_id', '=', $room->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('book.thinktank.thinktank-book', compact('room', 'rooms', 'waiting'));
    }

    public function shuttleForm($id) {
        $shuttle = Shuttle::findOrFail($id);

        return view('book.shuttle-book', compact('shuttle'));
    }

}
