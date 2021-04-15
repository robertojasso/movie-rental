<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
        'quantity',
        'unit_price',
        'return_date',
        'penalty'
    ];
}
