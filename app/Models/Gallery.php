<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    
    protected $fillable = [
        'title', 'image_path', 'category', 'uploaded_by', 'is_published'
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}