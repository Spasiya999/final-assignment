<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomSearchController extends Controller
{
    public function index(Request $request)
    {
        // dump($request->all());
        // $rooms = Room::where('room_type', $request->roomType)
        // ->where('occupancy','>=', $request->guest)
        // ->where('status', 'available')
        // ->get();
        $rooms = new Room;
        if($request->roomType){
            $rooms = $rooms->where('room_type', $request->roomType);
        }
        if($request->guest){
            $rooms = $rooms->where('occupancy', '>=', $request->guest);
        }
        $rooms = $rooms->get();
        return view('home.rooms', compact('rooms'));
    }

    public function indside(Room $room){
        $room = Room::find($room->id);
        $types = Room::roomTypes;
        $statuses = Room::roomStatus;
        $roomName = Room::find($room->room_name);
        return view('home.roominside', compact('room', 'types', 'statuses', 'roomName'));
    }
}
