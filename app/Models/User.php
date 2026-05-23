<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia, FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    // 2. Add the boot method to auto-generate the ID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->member_id)) {
                $year = date('y'); // Gets the last two digits of the year (e.g., '26')
                $prefix = 'DMA-' . $year;

                // Find the latest user created this year
                $lastUser = self::where('member_id', 'like', $prefix . '%')
                    ->orderBy('member_id', 'desc')
                    ->first();

                if ($lastUser) {
                    // Extract the last 4 digits and increment by 1
                    $lastSerial = (int) substr($lastUser->member_id, -4);
                    $newSerial = $lastSerial + 1;
                } else {
                    // If no users exist for this year, start at 1001
                    $newSerial = 1001;
                }

                // Format: DMA-261001
                $user->member_id = $prefix . str_pad($newSerial, 4, '0', STR_PAD_LEFT);
            }
        });
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Determine who can access which Filament panels.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // 1. Admin Panel: Only Super-Admins
        if ($panel->getId() === 'admin') {
            return $this->hasRole('Super-Admin') || $this->role === 'Super-Admin';
        }

        // 2. Artist Panel: Only Verified Artists
        if ($panel->getId() === 'artist') {
            return $this->hasRole('Verified-Artist') || $this->role === 'Verified-Artist';
        }

        return false;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean', // Tells Laravel to treat this as true/false
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function experiences()
    {
        return $this->hasMany(ArtistExperience::class)->orderBy('year', 'desc')->orderBy('sort_order');
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->performOnCollections('avatar')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 400, 400)
            ->quality(85)
            ->nonQueued();
    }
}
