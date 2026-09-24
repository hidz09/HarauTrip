<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'category',
    'location',
    'description',
    'open_time',
    'close_time',
    'image',
    'video_url',
    'status',
    ];


    public function tourPackages()
    {
        return $this->hasMany(TourPackage::class);
    }
}