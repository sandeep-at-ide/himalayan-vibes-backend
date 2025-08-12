<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function customTripQueries()
    {
        return $this->hasMany(CustomTripQuery::class, 'user_id');
    }
    
     public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class, 'user_id');
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone', 
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

    // public function canAccessPanel(\Filament\Panel $panel): bool
    // {
    //     return str_ends_with($this->email, '@nam.com');
    // }
}
