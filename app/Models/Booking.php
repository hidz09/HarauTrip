<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;


    protected $fillable = [
    'user_id',
    'phone_number',
    'tour_package_id',
    'booking_code',
    'booking_date',
    'total_people',
    'total_price',
    'notes',
    'status',
    'is_checked_in',
    'checked_in_at',
    'checked_in_by',
];

protected $casts = [
    'booking_date'   => 'date',
    'total_price'    => 'decimal:2',
    'is_checked_in'  => 'boolean',
    'checked_in_at'  => 'datetime',
];

// Relasi ke operator yang melakukan scan
public function checkedInBy()
{
    return $this->belongsTo(User::class, 'checked_in_by');
}


    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Relasi ke Paket Wisata
    public function package()
    {
        return $this->belongsTo(TourPackage::class, 'tour_package_id');
    }


    // Relasi ke Payment (satu booking bisa punya satu payment)
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}