<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'item_type',
        'item_id',
        'amount',
        'item_name',
    ];

    protected $table = 'order_items';

    public function booking(){
        return $this->belongsTo(Booking::class, 'item_id');
    }
}
