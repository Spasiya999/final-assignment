<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
