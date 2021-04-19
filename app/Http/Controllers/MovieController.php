<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\UpdatesLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        // only show available movies
        return Movie::where('available', true)->get();
    }

    public function show(Movie $movie)
    {
        if($movie->available or (Auth::check() and Auth::user()->isAdmin())) {
            return $movie;
        }
        return response()->json(['message' => 'Movie not found.'], 404);
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
        
        $this->saveUpdateToLog($movie->id, $oldValues, $newValues);

        return response()->json($movie, 200);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(null, 204);
    }

    private function saveUpdateToLog($movieId, $oldValues, $newValues)
    {
        unset($newValues['updated_at']);

        // save update to log
        foreach($newValues as $field => $newValue) {
            UpdatesLog::create([
                'user_id' => auth()->user()->id,
                'movie_id' => $movieId,
                'updated_field' => $field,
                'old_value' => $oldValues[$field],
                'new_value' => $newValue
            ]);
        }
    }
}
