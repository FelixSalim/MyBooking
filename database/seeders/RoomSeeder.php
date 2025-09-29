<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            // Discussion Rooms (using real floor numbers only)
            ['floor_number' => 2,  'name' => 'Discussion Room 2',  'type' => 'discussion'],
            ['floor_number' => 3,  'name' => 'Discussion Room 3',  'type' => 'discussion'],
            ['floor_number' => 5,  'name' => 'Discussion Room 5',  'type' => 'discussion'],
            ['floor_number' => 6,  'name' => 'Discussion Room 6',  'type' => 'discussion'],
            ['floor_number' => 7,  'name' => 'Discussion Room 7',  'type' => 'discussion'],
            ['floor_number' => 9,  'name' => 'Discussion Room 9',  'type' => 'discussion'],
            ['floor_number' => 10, 'name' => 'Discussion Room 10', 'type' => 'discussion'],

            // Classrooms (floor number merged with room code)
            ['floor_number' => 801,  'name' => 'Classroom 801',  'type' => 'class'],
            ['floor_number' => 802,  'name' => 'Classroom 802',  'type' => 'class'],
            ['floor_number' => 803,  'name' => 'Classroom 803',  'type' => 'class'],

            ['floor_number' => 901,  'name' => 'Classroom 901',  'type' => 'class'],
            ['floor_number' => 902,  'name' => 'Classroom 902',  'type' => 'class'],
            ['floor_number' => 903,  'name' => 'Classroom 903',  'type' => 'class'],
            ['floor_number' => 904,  'name' => 'Classroom 904',  'type' => 'class'],
            ['floor_number' => 905,  'name' => 'Classroom 905',  'type' => 'class'],

            ['floor_number' => 1001, 'name' => 'Classroom 1001', 'type' => 'class'],
            ['floor_number' => 1002, 'name' => 'Classroom 1002', 'type' => 'class'],
            ['floor_number' => 1003, 'name' => 'Classroom 1003', 'type' => 'class'],
            ['floor_number' => 1004, 'name' => 'Classroom 1004', 'type' => 'class'],
        
            // Ampitheater
            ['floor_number' => null, 'name' => 'Amphitheater', 'type' => 'amphitheater'],

            // Thinktank
            ['floor_number' => null,  'name' => 'Thinktank',  'type' => 'thinktank'],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
