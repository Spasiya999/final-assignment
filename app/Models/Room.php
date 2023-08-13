<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'room_name',
        'room_type',
        'short_description',
        'description',
        'slug',
        'beds',
        'occupancy',
        'price',
        'status',
        'image',
    ];

    const roomTypes = [
        'Standard' => 'Standard',
        'Deluxe' => 'Deluxe',
        'Luxury' => 'Luxury',
        'Suite' => 'Suite',
    ];

    const roomStatus = [
        'Available' => 'Available',
        'Unavailable' => 'Unavailable',
    ];

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function upcomingBookings(){
        return $this->hasMany(Booking::class)
            ->where('check_out', '>=', time())
            ->get();
    }
}
