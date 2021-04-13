<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'description',
        'stock',
        'rental_price',
        'sale_price',
        'available'
    ];
}
