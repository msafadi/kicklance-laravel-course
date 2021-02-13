<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected static function booted()
    {
        static::saving(function($user) {
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password);
            }
        });
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id')->withDefault();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function favouriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favourites');
    }

    public function ratedProducts()
    {
        return $this->morphedByMany(Product::class, 'rateable', 'ratings')->withPivot([
            'rating', 'created_at', 'updated_at'
        ]);
    }

    public function ratedUsers()
    {
        return $this->morphedByMany(User::class, 'rateable', 'ratings')->withPivot([
            'rating', 'created_at', 'updated_at'
        ]);
    }

    public function ratings()
    {
        return $this->morphToMany(User::class, 'rateable', 'ratings')
            ->withPivot([
                'rating', 'created_at', 'updated_at'
            ]);
    }

    public function routeNotificationForNexmo($notification = null)
    {
        return $this->phone;
    }

    public function routeNotificationForMail($notification = null)
    {
        return $this->email;
    }

    public function routeNotificationForBroadcast($notification = null)
    {
        return 'User.' . $this->id;
    }

}
