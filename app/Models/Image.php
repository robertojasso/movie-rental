<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'movie_id',
        'url'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
