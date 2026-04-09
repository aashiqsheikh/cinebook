@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">⚙️ Admin Dashboard</h1>
        <p class="text-gray-400">Manage your CineVerse application</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">

        <div class="bg-gray-800 p-5 rounded-xl text-center">
            <p class="text-gray-400">Total Movies</p>
            <h2 class="text-2xl font-bold text-white">{{ $stats['total_movies'] }}</h2>
        </div>

        <div class="bg-gray-800 p-5 rounded-xl text-center">
            <p class="text-gray-400">Total Theatres</p>
            <h2 class="text-2xl font-bold text-white">{{ $stats['total_theatres'] }}</h2>
        </div>

        <div class="bg-gray-800 p-5 rounded-xl text-center">
            <p class="text-gray-400">Total Shows</p>
            <h2 class="text-2xl font-bold text-white">{{ $stats['total_shows'] }}</h2>
        </div>

        <div class="bg-gray-800 p-5 rounded-xl text-center">
            <p class="text-gray-400">Total Revenue</p>
            <h2 class="text-2xl font-bold text-green-400">
                ₹{{ number_format($stats['total_revenue'], 0) }}
            </h2>
        </div>

    </div>

    <!-- Management -->
    <h2 class="text-xl font-semibold text-white mb-4">Management</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">

        <a href="{{ route('admin.movies.index') }}" class="bg-gray-800 p-6 rounded-xl text-center hover:bg-gray-700 transition">
            🎬 <p class="mt-2 text-white">Movies</p>
        </a>

        <a href="{{ route('admin.theatres.index') }}" class="bg-gray-800 p-6 rounded-xl text-center hover:bg-gray-700 transition">
            🏢 <p class="mt-2 text-white">Theatres</p>
        </a>

        <a href="{{ route('admin.shows.index') }}" class="bg-gray-800 p-6 rounded-xl text-center hover:bg-gray-700 transition">
            ⏰ <p class="mt-2 text-white">Shows</p>
        </a>

        <a href="{{ route('admin.bookings.index') }}" class="bg-gray-800 p-6 rounded-xl text-center hover:bg-gray-700 transition">
            🎟 <p class="mt-2 text-white">Bookings</p>
        </a>

    </div>

    <!-- Quick Actions -->
    <h2 class="text-xl font-semibold text-white mb-4">Quick Actions</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <a href="{{ route('admin.movies.create') }}" class="bg-red-500 p-5 rounded-xl text-center hover:bg-red-600 transition">
            ➕ Add Movie
        </a>

        <a href="{{ route('admin.theatres.create') }}" class="bg-red-500 p-5 rounded-xl text-center hover:bg-red-600 transition">
            ➕ Add Theatre
        </a>

        <a href="{{ route('admin.shows.create') }}" class="bg-red-500 p-5 rounded-xl text-center hover:bg-red-600 transition">
            ➕ Add Show
        </a>

    </div>

    <!-- Recent Bookings -->
    <div class="bg-gray-800 rounded-xl p-6">

        <h2 class="text-xl font-semibold text-white mb-4">Recent Bookings</h2>

        @if($stats['recent_bookings']->count() > 0)

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-300">

                    <thead class="text-gray-400 border-b border-gray-700">
                        <tr>
                            <th class="py-2">ID</th>
                            <th>User</th>
                            <th>Movie</th>
                            <th>Theatre</th>
                            <th>Seat</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($stats['recent_bookings'] as $booking)
                        <tr class="border-b border-gray-700 hover:bg-gray-700 transition">

                            <td class="py-2">#{{ $booking->id }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->show->movie->title }}</td>
                            <td>{{ $booking->show->theatre->name }}</td>
                            <td>{{ $booking->seat_number }}</td>

                            <td>
                                <span class="px-2 py-1 rounded text-xs
                                    {{ $booking->payment_status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </td>

                            <td>₹{{ number_format($booking->total_price, 2) }}</td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        @else
            <p class="text-gray-400 text-center py-4">No bookings yet</p>
        @endif

    </div>

</div>

@endsection
