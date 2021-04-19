<?php

namespace App\Http\Services;

use App\Models\Movie;

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
}