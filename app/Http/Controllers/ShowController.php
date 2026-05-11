<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Show;
use App\Models\Theatre;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Display a listing of shows.
     */
    public function index()
    {
        $shows = Show::with(['movie', 'theatre'])
            ->orderBy('show_date', 'desc')
            ->orderBy('show_time')
            ->paginate(20);
        return view('admin.shows.index', compact('shows'));
    }

    /**
     * Show the form for creating a new show.
     */
    public function create()
    {
        $movies = Movie::all();
        $theatres = Theatre::all();
        return view('admin.shows.create', compact('movies', 'theatres'));
    }

    /**
     * Store a newly created show in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'theatre_id' => 'required|exists:theatres,id',
            'show_time' => 'required',
            'price' => 'required|numeric|min:0',
            'show_date' => 'required|date|after_or_equal:today',
        ]);

        Show::create($validated);

        return redirect()->route('admin.shows.index')
            ->with('success', 'Show created successfully.');
    }

    /**
     * Show the form for editing the specified show.
     */
    public function edit(Show $show)
    {
        $movies = Movie::all();
        $theatres = Theatre::all();
        return view('admin.shows.edit', compact('show', 'movies', 'theatres'));
    }

    /**
     * Update the specified show in storage.
     */
    public function update(Request $request, Show $show)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'theatre_id' => 'required|exists:theatres,id',
            'show_time' => 'required',
            'price' => 'required|numeric|min:0',
            'show_date' => 'required|date',
        ]);

        $show->update($validated);

        return redirect()->route('admin.shows.index')
            ->with('success', 'Show updated successfully.');
    }

    /**
     * Remove the specified show from storage.
     */
    public function destroy(Show $show)
    {
        $show->delete();

        return redirect()->route('admin.shows.index')
            ->with('success', 'Show deleted successfully.');
    }

    /**
     * Automatically generate shows using the console command.
     */
    public function generate(Request $request)
    {
        $days = $request->input('days', 7);
        $theatreId = $request->input('theatre_id');
        $movieId = $request->input('movie_id');

        $options = ['--days' => $days];

        if ($theatreId) {
            $options['--theatre'] = $theatreId;
        }

        if ($movieId) {
            $options['--movie'] = $movieId;
        }

        $exitCode = \Illuminate\Support\Facades\Artisan::call('shows:generate', $options);
        $output = \Illuminate\Support\Facades\Artisan::output();

        if ($exitCode === 0) {
            return redirect()->route('admin.shows.index')
                ->with('success', trim($output));
        }

        return redirect()->route('admin.shows.index')
            ->with('error', 'Failed to generate shows. ' . trim($output));
    }
}

