<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroomingNotice extends Model
{
    protected $fillable = [
        'title', 'message', 'priority', 'show_on_grooming',
        'show_on_homepage', 'is_active', 'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'show_on_grooming' => 'boolean',
        'show_on_homepage' => 'boolean',
    ];
}