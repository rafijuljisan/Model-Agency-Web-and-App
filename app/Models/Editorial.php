<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'gallery' => 'array',
    ];

    // Use slug instead of ID for cleaner URLs (e.g., /editorial/fashion-week)
    public function getRouteKeyName()
    {
        return 'slug';
    }
}