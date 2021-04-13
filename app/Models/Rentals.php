<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentals extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'quantity',
        'unit_price',
        'return_date',
        'penalty'
    ];
}
