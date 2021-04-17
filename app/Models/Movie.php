<?php

namespace App\Models;

use App\Models\Rental;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;

    protected $casts = [
        // return boolean instead of tinyint (better format)
        'available' => 'boolean',
        // return decimal instead of float (better visualization)
        'rental_price' => 'decimal:2',
        'sale_price' => 'decimal:2'
    ];

    protected $fillable = [
        'title',
        'description',
        'stock',
        'rental_price',
        'sale_price',
        'available'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function logs()
    {
        return $this->hasMany(UpdatesLog::class);
    }
}
