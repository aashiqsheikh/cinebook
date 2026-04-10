<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Handle city selection
     */
    public function select(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id'
        ]);

        $city = City::findOrFail($request->city_id);

        // Store city_id and city_name in session
        session([
            'city_id' => $request->city_id,
            'city_name' => $city->name
        ]);

        return redirect()->back()->with('success', 'City updated successfully!');
    }
}

