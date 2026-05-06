<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroomingBatch extends Model
{
    protected $fillable = [
        'title','description', 'benefits', 'course_modules', 'start_date', 'end_date', 'schedule_json',
        'trainer', 'seat_limit', 'filled_seats', 'fee', 'status', 'is_active',
        'venue',
        'show_seats_public',
        'trainer_image',
        'trainer_designation',
        'trainer_bio',
        'eligibility',
        'faqs',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'schedule_json' => 'array',
        'benefits' => 'array',         // <-- Add this
        'course_modules' => 'array',   // <-- Add this
        'is_active' => 'boolean',
        'show_seats_public' => 'boolean',
        'eligibility' => 'array',
        'faqs'        => 'array',
    ];

    public function applications()
    {
        return $this->hasMany(GroomingApplication::class, 'batch_id');
    }

    public function getRemainingSeatsAttribute(): int
    {
        return max(0, $this->seat_limit - $this->filled_seats);
    }

    public function getFillPercentageAttribute(): int
    {
        if ($this->seat_limit === 0) return 100;
        return (int) round(($this->filled_seats / $this->seat_limit) * 100);
    }
}
