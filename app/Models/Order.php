<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'status',
        'total_cost',
        'notes',
        'payment_method',
        'payment_status',
        'payment_id',
    ];
}
