<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Profile extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $guarded = []; // Allows saving data without mass-assignment errors

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}