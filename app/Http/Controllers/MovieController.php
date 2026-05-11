<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display the home / welcome page.
     */
    public function home()
    {
        $nowShowingMovies = Movie::where('release_date', '<=', now())
            ->orderBy('release_date', 'desc')
            ->take(4)
            ->get();

        $upcomingMovies = Movie::where('release_date', '>', now())
            ->orderBy('release_date', 'asc')
            ->take(6)
            ->get();

        return view('welcome', compact('nowShowingMovies', 'upcomingMovies'));
    }

    /**
     * Display movies page (no date filters).
     */
    public function index(Request $request)
    {
        $query = Movie::where('release_date', '<=', now());

        // Search by title
        if ($request->filled('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        // Filter by genre
        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        $movies = $query->orderBy('release_date', 'desc')->paginate(12);
        $movies->appends($request->only(['title', 'genre']));

        $genres = Movie::distinct()->pluck('genre');

        return view('movies.index', compact('movies', 'genres'));
    }

    /**
     * Display the specified movie.
     */

    public function show(Movie $movie)
    {
        $cityId = session('city_id');

        if (!$cityId) {
            return redirect()->route('home')->with('error', 'Please select a city first.');
        }

$shows = \App\Models\Show::with(['theatre'])
            ->where('movie_id', $movie->id)
            ->where('show_date', '>=', now()->toDateString())
            ->whereHas('theatre', function ($query) use ($cityId) {
                $query->where('city_id', $cityId);
            })
            ->orderBy('show_date')
            ->orderBy('show_time')
            ->get()
            ->groupBy('show_date');

        return view('movies.show', compact('movie', 'shows'));
    }


    /**
     * Display now showing movies for home page.
     */
    public function nowShowing()
    {
        $movies = Movie::where('release_date', '<=', now())
            ->orderBy('release_date', 'desc')
            ->take(6)
            ->get();
        return $movies;
    }

    /**
     * Display coming soon / upcoming movies.
     */
    public function comingSoon(Request $request)
    {
        $query = Movie::where('release_date', '>', now());

        // Search by title
        if ($request->filled('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        // Filter by genre
        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        $movies = $query->orderBy('release_date', 'asc')->paginate(12);
        $movies->appends($request->only(['title', 'genre']));

        $genres = Movie::distinct()->pluck('genre');

        return view('movies.coming-soon', compact('movies', 'genres'));
    }
}

