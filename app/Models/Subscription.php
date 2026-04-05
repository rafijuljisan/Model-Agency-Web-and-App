<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    // Your existing user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ── ADD THIS NEW RELATIONSHIP ──
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}