<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomSearchController extends Controller
{
    public function index(Request $request)
    {
        $rooms = new Room;
        $title = 'Select Your Room';
        if ($request->booking_roomType) {
            $rooms = $rooms->where('room_type', $request->booking_roomType);
        }
        if ($request->booking_guest) {
            $rooms = $rooms->where('occupancy', '>=', $request->booking_guest);
        }
        if($request->booking_date){
            $dates = explode(' - ', $request->booking_date);
            $checkIn = strtotime($dates[0]);
            $checkOut = strtotime($dates[1]);
            $rooms = $rooms->whereDoesntHave('bookings', function($query) use ($checkIn, $checkOut){
                $query->where('check_in', '<=', $checkIn)
                    ->where('check_out', '>=', $checkOut);
            });
        }
        $rooms = $rooms->get();
        $bookingData = [
            'booking_roomType' => $request->booking_roomType,
            'booking_guest' => $request->booking_guest,
            'booking_name' => $request->booking_name,
            'booking_email' => $request->booking_email,
            'booking_date' => $request->booking_date,
        ];

        session()->put('bookingData', $bookingData);

        return view('home.rooms', compact('rooms', 'title'));
    }

    public function inside(Room $room)
    {
        $room = Room::find($room->id);
        $types = Room::roomTypes;
        $statuses = Room::roomStatus;
        $roomName = Room::find($room->room_name);
        $bookingData = session()->get('bookingData');
        $title = 'Book Your Room';
        return view('home.roominside', compact('bookingData', 'room', 'types', 'statuses', 'roomName', 'title'));
    }
}
