<?php

namespace App\Http\Services;

use Carbon\Carbon;

class RentalService
{
    /**
     * Determine if a movie return deserves a penalty.
     * 
     * @param Rental $rental
     * @return float
     */
    public static function calculatePenalty($rental)
    {
        if(Carbon::now()->isAfter($rental->return_by)) {
            $delay = Carbon::now()->diffInhours($rental->return_by);
            // for every day (or part) of delayed return,
            // charge the whole rent price
            return $rental->price * ceil($delay / 24);
        }

        return 0.0;
    }
}