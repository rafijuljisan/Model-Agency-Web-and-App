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

class User extends Authenticatable implements HasMedia, FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function canAccessPanel(Panel $panel): bool
    {
        // 1. Admin Panel: Only Super-Admins
        if ($panel->getId() === 'admin') {
            return $this->hasRole('Super-Admin');
        }
        
        // 2. Artist Panel: Anyone who is logged in can access their dashboard
        if ($panel->getId() === 'artist') {
            return true; // We will restrict specific pages later based on payment
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
        ];
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
