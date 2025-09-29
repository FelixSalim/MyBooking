<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // dummy room bookings
        $rooms = [
            (object) [
                'name' => 'DISCUSSION 5',
                'time' => '09:00 - 10:00',
                'date' => '23/09',
                'status' => 'Approved',
            ],
            (object) [
                'name' => 'AMPHITHEATER',
                'time' => '11:00 - 12:00',
                'date' => '23/09',
                'status' => 'Pending',
            ],
            (object) [
                'name' => 'CLASS A1004',
                'time' => '14:00 - 15:00',
                'date' => '23/09',
                'status' => 'Cancelled',
            ],
        ];

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
        } else {
            abort(404);
        }
    }

    public function discussion()
    {
        $discussionRooms = [
            ['number' => 2, 'floor' => '2nd', 'image' => 'discussion2.jpg'],
            ['number' => 3, 'floor' => '3rd', 'image' => 'discussion3.jpg'],
            ['number' => 5, 'floor' => '5th', 'image' => 'discussion5.jpg'],
            ['number' => 6, 'floor' => '6th', 'image' => 'discussion6.jpg'],
            ['number' => 7, 'floor' => '7th', 'image' => 'discussion7.jpg'],
            ['number' => 9, 'floor' => '9th', 'image' => 'discussion9.jpg'],
            ['number' => 10, 'floor' => '10th', 'image' => 'discussion10.jpg'],
        ];

        return view('book.discussion', compact('discussionRooms'));
    }


    public function discussionForm($id)
    {
        // Example static rooms data
        $discussionRooms = [
            2 => ['id' => 2, 'floor' => '2nd Floor'],
            3 => ['id' => 3, 'floor' => '3rd Floor'],
            5 => ['id' => 5, 'floor' => '5th Floor'],
            6 => ['id' => 6, 'floor' => '6th Floor'],
            7 => ['id' => 7, 'floor' => '7th Floor'],
            9 => ['id' => 9, 'floor' => '9th Floor'],
            10 => ['id' => 10, 'floor' => '10th Floor'],
        ];

        // Pass the selected room to the view
        $room = $discussionRooms[$id] ?? null;
        if (!$room) {
            abort(404);
        }

        $rooms = [
            (object) ['id' => 1, 'category' => 'Discussion', 'description' => 'Small group discussions'],
            (object) ['id' => 2, 'category' => 'Amphitheater', 'description' => 'Large presentations'],
            (object) ['id' => 3, 'category' => 'Thinktank', 'description' => 'Brainstorming sessions'],
            (object) ['id' => 4, 'category' => 'Class', 'description' => 'Standard classroom setup'],
        ];
        
        return view('book.discussion-book', compact('room', 'rooms'));
    }


}
