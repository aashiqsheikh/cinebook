@extends('layouts.app')

@section('content')
<!-- Dashboard Header -->
<div class="mb-12">
    <div class="flex items-center gap-6 mb-8">
        <div class="w-16 h-16 bg-red-600 rounded-lg flex items-center justify-center text-2xl font-bold text-white">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Welcome back, {{ Auth::user()->name }}</h1>
            <p class="text-slate-400">Manage your bookings and explore movies</p>
        </div>
    </div>
</div>

<!-- Quick Actions Grid -->
<div class="grid md:grid-cols-3 gap-6 mb-12">
    <!-- Browse Movies Card -->
    <a href="{{ route('movies.index') }}" class="group block bg-slate-800 hover:bg-slate-750 border border-slate-700 hover:border-red-600 rounded-xl p-8 transition-all duration-300">
        <div class="inline-flex w-14 h-14 bg-red-600 rounded-lg items-center justify-center mb-4 group-hover:bg-red-700 transition-colors">
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 4v10c0 2.21 1.79 4 4 4s4-1.79 4-4V4M15 16h1M9 16h1M4 20h16a1 1 0 001-1v-2a1 1 0 00-1-1H4a1 1 0 00-1 1v2a1 1 0 001 1z"/>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-white mb-2">Browse Movies</h3>
        <p class="text-slate-400 text-sm mb-4">Discover the latest blockbusters and upcoming releases</p>
        <span class="inline-flex items-center gap-2 text-red-500 font-medium group-hover:gap-3 transition-all">
            Explore <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </span>
    </a>

    <!-- My Bookings Card -->
    <a href="{{ route('bookings.my') }}" class="group block bg-slate-800 hover:bg-slate-750 border border-slate-700 hover:border-red-600 rounded-xl p-8 transition-all duration-300">
        <div class="inline-flex w-14 h-14 bg-red-600 rounded-lg items-center justify-center mb-4 group-hover:bg-red-700 transition-colors">
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-white mb-2">My Bookings</h3>
        <p class="text-slate-400 text-sm mb-4">View and manage your booked tickets</p>
        <span class="inline-flex items-center gap-2 text-red-500 font-medium group-hover:gap-3 transition-all">
            View Tickets <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </span>
    </a>

    <!-- Profile Settings Card -->
    <a href="{{ route('profile.edit') }}" class="group block bg-slate-800 hover:bg-slate-750 border border-slate-700 hover:border-red-600 rounded-xl p-8 transition-all duration-300">
        <div class="inline-flex w-14 h-14 bg-red-600 rounded-lg items-center justify-center mb-4 group-hover:bg-red-700 transition-colors">
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-white mb-2">Profile Settings</h3>
        <p class="text-slate-400 text-sm mb-4">Update your account information and preferences</p>
        <span class="inline-flex items-center gap-2 text-red-500 font-medium group-hover:gap-3 transition-all">
            Edit Profile <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </span>
    </a>
</div>

@if(Auth::user()->is_admin)
<!-- Admin Section -->
<div class="bg-yellow-950/30 border border-yellow-600/50 rounded-xl p-8 mb-12">
    <h2 class="text-2xl font-bold text-yellow-400 mb-6">Administrator Panel</h2>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.movies.index') }}" class="bg-slate-800 hover:bg-slate-750 border border-slate-700 rounded-lg p-4 transition-colors text-center">
            <div class="text-2xl mb-2">🎬</div>
            <div class="text-sm font-medium text-white">Manage Movies</div>
        </a>
        <a href="{{ route('admin.shows.index') }}" class="bg-slate-800 hover:bg-slate-750 border border-slate-700 rounded-lg p-4 transition-colors text-center">
            <div class="text-2xl mb-2">🎪</div>
            <div class="text-sm font-medium text-white">Manage Shows</div>
        </a>
        <a href="{{ route('admin.bookings.index') }}" class="bg-slate-800 hover:bg-slate-750 border border-slate-700 rounded-lg p-4 transition-colors text-center">
            <div class="text-2xl mb-2">🎫</div>
            <div class="text-sm font-medium text-white">All Bookings</div>
        </a>
        <a href="{{ route('admin.theatres.index') }}" class="bg-slate-800 hover:bg-slate-750 border border-slate-700 rounded-lg p-4 transition-colors text-center">
            <div class="text-2xl mb-2">🏢</div>
            <div class="text-sm font-medium text-white">Manage Theatres</div>
        </a>
    </div>
</div>
@endif
@endsection

