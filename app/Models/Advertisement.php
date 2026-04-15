<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'title',
        'position',
        'image_path',
        'target_url',
        'is_active',
    ];

    // Optional: A helper scope to quickly grab active ads by position
    public function scopeActiveAt($query, $position)
    {
        return $query->where('is_active', true)->where('position', $position);
    }
}