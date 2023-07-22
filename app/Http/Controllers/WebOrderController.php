<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Booking;

class WebOrderController extends Controller
{
    public function create(Request $request)
    {
        $room = Room::find($request->room_id);

        $data = [
            'user_id' => '1',
            'room_id' => $request->room_id,
            'check_in' => time(),
            'check_out' => time(),
            'total_cost' => $room->price,
            'notes' => 'test',
            'occupancy' => $request->guest,
        ];

        $title = 'Place Your Order';
        $booking = Booking::create($data);
        $bookingData = session()->get('bookingData');

        return view('home.orders.create', compact('title', 'booking', 'bookingData', 'room'));
    }

    public function confirm(Request $request)
    {
        // Handle the confirmation logic here if needed
    }
}
