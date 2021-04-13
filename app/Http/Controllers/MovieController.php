<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        return Movie::all();
    }

    public function show(Movie $movie)
    {
        return $movie;
    }
    
    public function store(Request $request)
    {
        $movie = Movie::create($request->all());
        return response()->json($movie, 201);
    }
    
    public function update(Request $request, Movie $movie)
    {
        $movie->update($request->all());
        return response()->json($movie, 200);
    }
    
    public function delete(Movie $movie)
    {
        $movie->delete();
        return response()->json(null, 204);
    }
}
