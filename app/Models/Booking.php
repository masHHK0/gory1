<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'booking_type',
        'item_id',
        'start_date',
        'end_date',
        'guests_count',
        'total_price',
        'status',
        'payment_status',
        'comment'
    ];

    // Добавьте это:
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hotelRoom()
    {
        return $this->belongsTo(HotelRoom::class, 'item_id');
    }
}