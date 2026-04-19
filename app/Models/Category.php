<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['group', 'name', 'is_active'];
    protected static function booted(): void
    {
        $clear = fn() => \Illuminate\Support\Facades\Cache::forget('nav_category_groups');

        static::created($clear);
        static::updated($clear);
        static::deleted($clear);
    }
    public function scopeCustomOrdered($query)
    {
        return $query->orderByRaw("FIELD(`group`, 'Artist', 'Model', 'Brand Promoter', 'Content Creator', 'Director', 'Creative Crew')")
            ->orderBy('name');
    }
}