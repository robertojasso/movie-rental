<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdatesLog extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
        'updated_field',
        'old_value',
        'new_value'
    ];
}
