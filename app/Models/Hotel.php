<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name', 'stars', 'address', 'distance_to_lift',
        'description', 'main_image','images',  // ← ДОЛЖНО БЫТЬ
    ];

    public function rooms()
    {
        return $this->hasMany(HotelRoom::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}