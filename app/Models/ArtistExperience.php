<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtistExperience extends Model
{
    use HasFactory;

    protected $table = 'artist_experiences';
    
    protected $guarded = [];

    // Type labels for display
    public static $typeLabels = [
        'acting_screen' => 'Acting & Screen',
        'modeling_fashion' => 'Modeling & Fashion',
        'photography_media' => 'Photography & Media',
        'advertising_promotion' => 'Advertising & Promotion',
        'event_hosting' => 'Event & Hosting',
        'digital_content' => 'Digital Content Creation',
        'competitions_pageants' => 'Competitions & Pageants',
        'awards_achievements' => 'Awards & Achievements',
        'workshop_training' => 'Workshop & Training',
        'other' => 'Other',
        'custom' => 'Custom Label',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return self::$typeLabels[$this->type] ?? ucfirst($this->type);
    }
}