<?php

namespace App\Http\Controllers;

use App\Http\Services\MovieService;
use App\Models\Movie;
use App\Models\UpdatesLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        return Movie::where('available', true)->get();
    }

    public function show(Movie $movie)
    {
        if(MovieService::canShowMovie($movie)) {
            return $movie;
        }
        return response()->json(['message' => 'Movie unavailable.'], 404);
    }

    public function store(Request $request)
    {
        $movie = Movie::create($request->all());
        return response()->json($movie, 201);
    }

    public function update(Request $request, Movie $movie)
    {
        $oldValues = $movie->getOriginal();
        $movie->update($request->all());
        $newValues = $movie->getChanges();
        
        MovieService::saveUpdateToLog($movie, $oldValues, $newValues);

        return response()->json($movie, 200);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(null, 204);
    }
}
