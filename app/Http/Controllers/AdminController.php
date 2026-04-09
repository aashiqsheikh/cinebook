<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\Show;
use App\Models\Theatre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Access denied!');
        }

        $stats = [
            'total_movies' => Movie::count(),
            'total_theatres' => Theatre::count(),
            'total_shows' => Show::count(),
            'total_bookings' => Booking::count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_price'),
            'recent_bookings' => Booking::with(['user', 'show.movie', 'show.theatre'])
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }


    public function movies()
    {
        $movies = Movie::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.movies.index', compact('movies'));
    }


    public function createMovie()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Access denied!');
        }

        return view('admin.movies.create');
    }

    public function storeMovie(Request $request)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Access denied!');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster_url' => 'nullable|url',
            'duration' => 'required|integer|min:1',
            'genre' => 'required|string|max:100',
            'release_date' => 'required|date',
        ]);

        $movieData = $validated;

        if (!empty($request->poster_url)) {
            $movieData['poster'] = $request->poster_url;
        }

        Movie::create($movieData);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie created successfully.');
    }

    public function editMovie(Movie $movie)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Access denied!');
        }

        return view('admin.movies.edit', compact('movie'));
    }

    public function updateMovie(Request $request, Movie $movie)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Access denied!');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster_url' => 'nullable|url',
            'duration' => 'required|integer|min:1',
            'genre' => 'required|string|max:100',
            'release_date' => 'required|date',
        ]);

        $movieData = $validated;

        if (!empty($request->poster_url)) {
            $movieData['poster'] = $request->poster_url;
        }

        $movie->update($movieData);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie updated successfully.');
    }

    public function destroyMovie(Movie $movie)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Access denied!');
        }

        $movie->delete();

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie deleted successfully.');
    }

    public function bookings()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Access denied!');
        }

        $bookings = Booking::with(['user', 'show.movie', 'show.theatre'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.bookings.index', compact('bookings'));
    }
}

