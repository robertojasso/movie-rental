<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the sales.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sale::all();
    }

    /**
     * Store a sale in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movie $movie)
    {
        $sale = Sale::create([
            'user_id' => Auth::user()->id,
            'movie_id' => $movie->id,
            // hardcoded due to lack of time for more elaborate logic
            'quantity' => 1,
            'unit_price' => $movie->sale_price
        ]);

        return response()->json($sale, 201);
    }
}
