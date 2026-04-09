@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto px-4 py-10">

    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-white">➕ Add New Show</h1>
        <p class="text-gray-400">Create a new show timing</p>
    </div>

    <!-- Form Card -->
    <div class="bg-gray-800 rounded-xl shadow-lg p-6">

        <form action="{{ route('admin.shows.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Movie -->
            <div>
                <label class="block text-gray-300 mb-1">Movie</label>
                <select name="movie_id"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-red-500 outline-none"
                    required>
                    <option value="">Select Movie</option>
                    @foreach($movies as $movie)
                        <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Theatre -->
            <div>
                <label class="block text-gray-300 mb-1">Theatre</label>
                <select name="theatre_id"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-red-500 outline-none"
                    required>
                    <option value="">Select Theatre</option>
                    @foreach($theatres as $theatre)
                        <option value="{{ $theatre->id }}">
                            {{ $theatre->name }} - {{ $theatre->location }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Show Date -->
            <div>
                <label class="block text-gray-300 mb-1">Show Date</label>
                <input type="date" name="show_date"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-red-500 outline-none"
                    required>
            </div>

            <!-- Show Time -->
            <div>
                <label class="block text-gray-300 mb-1">Show Time</label>
                <input type="time" name="show_time"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-red-500 outline-none"
                    required>
            </div>

            <!-- Price -->
            <div>
                <label class="block text-gray-300 mb-1">Price (₹)</label>
                <input type="number" name="price" min="0" step="0.01"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-red-500 outline-none"
                    required>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4">

                <a href="{{ route('admin.shows.index') }}"
                   class="text-gray-400 hover:text-white transition">
                    Cancel
                </a>

                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 px-6 py-2 rounded-lg font-semibold transition">
                    💾 Save Show
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
