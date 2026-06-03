<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $fillable = [
        'name', 'type', 'price', 'description',
        'valid_from', 'valid_to', 'is_active'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where('valid_from', '<=', now())
                    ->where(function($q) {
                        $q->whereNull('valid_to')
                          ->orWhere('valid_to', '>=', now());
                    });
    }
}