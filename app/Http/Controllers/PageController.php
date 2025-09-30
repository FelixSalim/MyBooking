<?php

namespace App\Http\Controllers;

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
        
        $shuttles = [
            (object) [
                'date' => '23/09',
                'time' => '06.15',
                'destination' => 'KELAPA GADING',
                'direction' => 'to'   // "to" means To BLI (green marker)
            ],
            (object) [
                'date' => '23/09',
                'time' => '17.00',
                'destination' => 'BEKASI',
                'direction' => 'from' // "from" means From BLI (red marker)
            ],
            (object) [
                'date' => '23/09',
                'time' => '06.10',
                'destination' => 'ALAM SUTERA',
                'direction' => 'to'
            ],
        ];

        return view('home', compact('rooms', 'shuttles'));
    }

    public function bookRoom()
    {
        $rooms = [
            (object) [
                'name' => 'Discussion',
                'image' => 'https://picsum.photos/id/1011/400/300'
            ],
            (object) [
                'name' => 'Amphitheater',
                'image' => 'https://picsum.photos/id/1015/400/300'
            ],
            (object) [
                'name' => 'Thinktank',
                'image' => 'https://picsum.photos/id/1025/400/300'
            ],
            (object) [
                'name' => 'Class',
                'image' => 'https://picsum.photos/id/1035/400/300'
            ],
        ];

        return view('book.room', compact('rooms'));
    }

    public function showRoom($roomName)
    {
        $roomName = strtolower($roomName);
        if ($roomName === 'discussion') {
            return $this->discussion();
        } elseif ($roomName === 'amphitheater') {
        } elseif ($roomName === 'thinktank') {
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

}
