<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Movie;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * Display a listing of the rentals.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rental::all();
    }

    public function getPendingRentals()
    {
        return Rental::where('returned_on', null)->get();
    }

    public function getRentalsByMovie($movie_id)
    {
        $result = Rental::where('movie_id', $movie_id)->get();
        return count($result) > 0 ? $result : [];
    }

    public function getRentalsByUser(User $user)
    {
        return Rental::where('user_id', $user->id)->get();
    }

    /**
     * Store a rental in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movie $movie)
    {
        // check if there are movie copies in stock
        if($movie->stock < 1) {
            return response()->json(['message' => 'Movie is out of stock.']);
        }

        $rental = Rental::create([
            'user_id' => Auth::user()->id,
            'movie_id' => $movie->id,
            'price' => $movie->rental_price,
            'return_by' => Carbon::now()->addHours(48)
        ]);
        
        // reduce the movie's stock
        $movie->stock--;
        $movie->save();

        return response()->json($rental, 201);
    }

    /**
     * Update the specified rental in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        // get the oldest rental pending return for this movie and user
        $rental = Rental::where('user_id', Auth::user()->id)->where('movie_id', $movie->id)->where('returned_on', null)->orderBy('return_by')->first();
        
        // if no pending returns for movie and user combination, 404
        if(!$rental) {
            return response()->json(['message' => 'No pending returns for this movie.'], 404);
        }
        
        $penalty = $this->calculatePenalty($rental);

        $rental->update([
            'returned_on' => Carbon::now(),
            'penalty' => $penalty
        ]);

        // return the copy to the stock
        $movie->stock++;
        $movie->save();

        return response()->json($rental, 201);
    }

    /**
     * Determine if a movie return deserves a penalty.
     * 
     * @param Rental $rental
     * @return null | float
     */
    public function calculatePenalty($rental)
    {
        $penalty = null;
        // check if return is delayed
        if(Carbon::now()->isAfter($rental->return_by)) {
            $delay = Carbon::now()->diffInhours($rental->return_by);
            // for every day of delayed return, charge the whole rent price
            $penalty = $rental->price * ($delay / 24);
        }
    }
}
