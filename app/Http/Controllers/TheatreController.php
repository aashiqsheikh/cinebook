<?php

namespace App\Http\Controllers;

use App\Models\Theatre;
use Illuminate\Http\Request;

class TheatreController extends Controller
{
    /**
     * Display a listing of theatres.
     */
    public function index()
    {
        $theatres = Theatre::all();
        return view('admin.theatres.index', compact('theatres'));
    }

    /**
     * Show the form for creating a new theatre.
     */
    public function create()
    {
        return view('admin.theatres.create');
    }

    /**
     * Store a newly created theatre in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1',
        ]);

        Theatre::create($validated);

        return redirect()->route('admin.theatres.index')
            ->with('success', 'Theatre created successfully.');
    }

    /**
     * Show the form for editing the specified theatre.
     */
    public function edit(Theatre $theatre)
    {
        return view('admin.theatres.edit', compact('theatre'));
    }

    /**
     * Update the specified theatre in storage.
     */
    public function update(Request $request, Theatre $theatre)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1',
        ]);

        $theatre->update($validated);

        return redirect()->route('admin.theatres.index')
            ->with('success', 'Theatre updated successfully.');
    }

    /**
     * Remove the specified theatre from storage.
     */
    public function destroy(Theatre $theatre)
    {
        $theatre->delete();

        return redirect()->route('admin.theatres.index')
            ->with('success', 'Theatre deleted successfully.');
    }
}

