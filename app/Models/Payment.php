<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;


   protected $fillable = [
    'booking_id',
    'payment_code',
    'amount',
    'method',
    'proof',
    'status',
    'snap_token',
    'order_id',
];



    protected $casts = [

        'amount' => 'decimal:2',

    ];



    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

}