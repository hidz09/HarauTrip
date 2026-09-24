<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;

    protected $table = 'tour_packages';

    protected $fillable = [
          'destination_id',
    'category',   // <- ditambah
    'name',
    'description',
    'price',
    'duration_days',
    'quota',
    'departure_date',
    'status',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'price' => 'decimal:2',
    ];

    // Relasi ke Destinasi
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    // Relasi ke Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'tour_package_id');
    }
}