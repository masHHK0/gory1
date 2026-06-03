<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slope extends Model
{
    protected $fillable = [
        'name', 'difficulty', 'length', 'elevation', 'status', 'description'
    ];

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }
}