<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Profile extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;
    protected $guarded = []; // Allows saving data without mass-assignment errors

    protected $casts = [
        'languages' => 'array',
        'categories' => 'array', // <-- ADD THIS
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // This is the magic line! It tells Laravel to handle the Array to JSON conversion automatically.
            'languages' => 'array',
            'date_of_birth' => 'date', // This will automatically convert to a Carbon date object
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}