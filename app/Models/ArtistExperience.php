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
    public static array $typeLabels = [
        'film'        => 'Film',
        'tv_drama'    => 'TV / Drama',
        'commercial'  => 'Commercial / TVC',
        'theater'     => 'Theater',
        'music_video' => 'Music Video',
        'award'       => 'Award',
        'jury'        => 'Jury Activity',
        'other'       => 'Other',
        'custom'      => 'Custom',
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