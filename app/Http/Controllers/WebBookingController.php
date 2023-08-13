<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Booking;

class WebBookingController extends Controller
{
    /**
     * Create a new booking based on the selected room.
     */
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

        return view('home.booking.create', compact('title', 'booking', 'bookingData', 'room'));
    }

    /**
     * Confirm a booking and create an order item for it.
     */
    public function confirm(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        $price = $booking->room->price;
        $booking->update([
            'status' => 'Confirmed',
            'notes' => $request->booking_comment,
            'occupancy' => $request->booking_guest,
            'price' => $price,
        ]);

        session()->forget('bookingData');

        // Create an order item for the booking
        $orderItem = OrderItem::create([
            'item_type' => 'booking',
            'item_id' => $booking->id,
            'amount' => $booking->room->price,
            'item_name' => 'Booking "'.$booking->room->room_name. '" "'. $booking->room->room_number. '" in '. $booking->room->price,
        ]);

        // Add the order item ID to the session
        if (!session()->has('orderItems')) {
            session()->put('orderItems', [$orderItem->id]);
        } else {
            $orderItems = session()->get('orderItems');
            if (!is_array($orderItems)) {
                $orderItems[] = $orderItem->id;
            } else {
                $orderItems[] = $orderItem->id;
            }
            session()->put('orderItems', $orderItems);
        }

        return redirect()->route('cart');
    }
}
