<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'user_id', 'name', 'specialization', 'experience_years',
        'price_per_hour', 'photo', 'available', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'item_id')
                    ->where('booking_type', 'instructor');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }
}