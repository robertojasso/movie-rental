<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function logs()
    {
        return $this->hasMany(UpdatesLog::class);
    }

    // decided to use this noun instead of "sales" since it makes more sense
    // from the user's perspective
    public function purchases()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Return boolean indicating if logged-in user is an admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role == 'admin' ? true : false;
    }
}
