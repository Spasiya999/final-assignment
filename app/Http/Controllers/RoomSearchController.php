<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomSearchController extends Controller
{
    public function index(Request $request)
    {
        dump($request->all());
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
        dd($rooms);
    }
}
