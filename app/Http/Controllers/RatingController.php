<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
        ]);

        // Check if user already rated this movie
        $existingRating = Rating::where('movie_id', $movie->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingRating) {
            return back()->with('error', 'You have already rated this movie!');
        }

        Rating::create([
            'movie_id' => $movie->id,
            'user_id' => Auth::id(),
            'rating' => $validated['rating'],
            'review' => $validated['review'] ?? null,
        ]);

        return back()->with('success', 'Thank you for your rating!');
    }

    public function destroy(Movie $movie)
    {
        $rating = Rating::where('movie_id', $movie->id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $rating->delete();

        return back()->with('success', 'Rating removed successfully!');
    }
}

