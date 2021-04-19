<?php

namespace App\Http\Services;

use App\Models\Movie;
use App\Models\UpdatesLog;
use Illuminate\Support\Facades\Auth;

class MovieService
{
    /**
     * Decrease stock for the passed movie.
     * 
     * @param Movie $movie
     * @return void
     */
    public static function decreaseStock(Movie $movie, $quantity = 1)
    {
        $movie->stock -= $quantity;
        $movie->save();
    }

    /**
     * Increase stock for the passed movie.
     * 
     * @param Movie $movie
     * @return void
     */
    public static function increaseStock(Movie $movie, $quantity = 1)
    {
        $movie->stock += $quantity;
        $movie->save();
    }

    /**
     * Check if passed movie is in stock.
     * 
     * @param Movie $movie
     * @return boolean
     */
    public static function inStock(Movie $movie, $quantity = 1)
    {
        if($movie->stock >= $quantity) {
            return true;
        }
        return false;
    }

    public static function canShowMovie(Movie $movie)
    {
        return $movie->available or (Auth::check() and Auth::user()->isAdmin());
    }

    public static function saveUpdateToLog(Movie $movie, $oldValues, $newValues)
    {
        unset($newValues['updated_at']);

        foreach($newValues as $field => $newValue) {
            UpdatesLog::create([
                'user_id' => auth()->user()->id,
                'movie_id' => $movie->id,
                'updated_field' => $field,
                'old_value' => $oldValues[$field],
                'new_value' => $newValue
            ]);
        }
    }
}