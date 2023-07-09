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
        'beds',
        'occupancy',
        'price',
        'status',
        'image',
    ];

    const roomTypes = [
        'standard' => 'Standard',
        'deluxe' => 'Deluxe',
        'luxury' => 'Luxury',
        'suite' => 'Suite',
    ];

    const roomStatus = [
        'Available' => 'Available',
        'Unavailable' => 'Unavailable',
    ];
}
