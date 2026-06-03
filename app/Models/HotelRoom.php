<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    protected $fillable = [
        'hotel_id', 'room_type', 'capacity', 'price_per_night',
        'available_rooms', 'amenities', 'image',
        'images',  // ← ДОЛЖНО БЫТЬ
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'item_id')
                    ->where('booking_type', 'hotel');
    }
}