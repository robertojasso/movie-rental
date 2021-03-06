<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Movie;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Http\Services\MovieService;
use App\Http\Services\RentalService;
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

    public function getRentalsByMovie(Movie $movie)
    {
        return Rental::where('movie_id', $movie->id)->get();
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
        if(!MovieService::inStock($movie)) {
            return response()->json(['message' => 'Movie is out of stock.'], 404);
        }

        $rental = Rental::create([
            'user_id' => Auth::user()->id,
            'movie_id' => $movie->id,
            'price' => $movie->rental_price,
            // renter gets two days to watch the movie
            'return_by' => Carbon::now()->addHours(48)
        ]);
        
        // take the rented copies out of the stock
        MovieService::decreaseStock($movie);
        
        return response()->json($rental, 201);
    }

    /**
     * Update the specified rental in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rental $rental)
    {
        $rental->update([
            'returned_on' => Carbon::now(),
            'penalty' => RentalService::calculatePenalty($rental)
            ]);
            
        $movie = Movie::findOrFail($rental->movie->id);
        // return the copies to the stock
        MovieService::increaseStock($movie);

        return response()->json($rental, 201);
    }
}
