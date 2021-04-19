<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
        'price',
        'return_by',
        'returned_on',
        'penalty'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getOldestRentalPendingReturn(Movie $movie, User $user)
    {
        return self::where('movie_id', $movie->id)
            ->where('user_id', $user->id)
            ->where('returned_on', null)
            ->orderBy('return_by')
            ->first();
    }
}
