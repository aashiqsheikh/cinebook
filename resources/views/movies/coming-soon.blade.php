@extends('layouts.app')

@section('content')

<!-- Hero Header -->
<div class="relative bg-gradient-to-r from-slate-900 via-red-900/20 to-slate-900 pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzIiIGN5PSIzMiIgcj0iMSIgc3R5bGU9InN0b3AtY29sb3I6I2ZmZmZmZjA7c3RvcC1vcGFjaXR5OjAuMDk7c3R5bGU9c3RvcC1jb2xvcjojZTY1ZjllMDA7c3R5bGU9c3RvcC1vcGFjaXR5OjAuMjQiLz4KPC9zdmc+')] opacity-20"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
<h1 class="text-5xl md:text-6xl lg:text-7xl font-black bg-gradient-to-r from-white via-red-100 to-slate-200 bg-clip-text text-transparent mb-6 drop-shadow-2xl">
            Coming Soon
        </h1>
        <p class="text-xl md:text-2xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
            Get ready for the most anticipated releases. Mark your calendars and be the first to book.
        </p>
    </div>
</div>

<!-- Search & Filters -->
<section class="relative -mt-12 lg:-mt-20 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800/50 rounded-3xl p-8 lg:p-12 shadow-2xl">
            <form method="GET" action="{{ route('movies.coming-soon') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-end">
<!-- Search Input -->
                <div class="lg:col-span-2">
                    <label class="sr-only">Search Movies</label>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input
                            type="text"
                            name="title"
                            value="{{ request('title') }}"
                            placeholder="Search upcoming titles..."
                            class="w-full pl-12 pr-4 py-5 bg-slate-800/50 border-2 border-slate-700/50 focus:border-red-500/70 focus:bg-slate-800/70 rounded-2xl text-white placeholder-slate-400 transition-all duration-300 text-lg backdrop-blur-sm shadow-inner hover:shadow-md hover:border-slate-600/50"
                        >
                    </div>
                </div>

                <!-- Genre Filter -->
                <div>
                    <label class="sr-only">Genre</label>
                    <div class="relative">
                        <select name="genre" class="w-full px-5 py-5 bg-slate-800/50 border-2 border-slate-700/50 focus:border-purple-500/70 focus:bg-slate-800/70 rounded-2xl text-white text-lg backdrop-blur-sm shadow-inner hover:shadow-md hover:border-slate-600/50 transition-all duration-300 appearance-none bg-no-repeat bg-right">
                            <option value="">All Genres</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                            @endforeach
                        </select>
                        <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Search Button -->
<button
                    type="submit"
                    class="w-full lg:w-auto px-8 py-5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold text-lg rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transform transition-all duration-300 uppercase tracking-wide col-span-1 lg:col-span-1"
                >
                    <svg class="inline w-6 h-6 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Find Movies
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Tab Toggle -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
    <div class="flex justify-center">
        <div class="inline-flex bg-slate-900/50 backdrop-blur-xl border border-slate-800/50 rounded-2xl p-2 shadow-xl">
            <a href="{{ route('movies.index') }}" class="px-8 py-3 rounded-xl text-lg font-bold text-slate-400 hover:text-white transition-all duration-300">
                Now Showing
            </a>
<a href="{{ route('movies.coming-soon') }}" class="px-8 py-3 rounded-xl text-lg font-bold bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg">
                Coming Soon
            </a>
        </div>
    </div>
</section>

<!-- Movies Grid -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    @if($movies->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-16">
            @foreach($movies as $movie)
                @php
                    $daysUntil = now()->diffInDays($movie->release_date, false);
                    $isSoon = $daysUntil >= 0 && $daysUntil <= 7;
                @endphp
<article class="card-lift group">
                    <div class="block">
                        <div class="bg-slate-900/70 backdrop-blur border border-slate-800/60 rounded-3xl overflow-hidden shadow-lg hover:shadow-red-500/10 hover:border-red-500/20 transition-all duration-500">
                            <!-- Poster -->
                            <div class="relative aspect-[2/3] overflow-hidden">
                                @if($movie->poster)
                                    <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Days Until Badge -->
                                <div class="absolute top-3 right-3">
                                    @if($isSoon)
                                        <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-bold rounded-lg shadow-md ring-1 ring-red-400/40">
                                            <svg class="w-3 h-3 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $daysUntil <= 0 ? 'Tomorrow' : $daysUntil . 'd' }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-black/60 backdrop-blur-md text-white text-xs font-bold rounded-lg border border-white/10">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $movie->release_date->format('M d') }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Hover overlay with Notify button -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400 flex items-end p-4">
                                    <button type="button" onclick="alert('You will be notified when {{ addslashes($movie->title) }} tickets are available!')" class="btn-glow-emerald w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-sm rounded-xl transition-all duration-300 hover:scale-[1.02]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                        </svg>
                                        Get Notified
                                    </button>
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="p-4">
<h3 class="text-lg sm:text-xl font-bold text-white mb-1 group-hover:text-red-400 transition-colors line-clamp-1">{{ $movie->title }}</h3>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 bg-slate-800 text-slate-300 text-xs font-medium rounded-lg">{{ $movie->genre }}</span>
                                    <span class="text-slate-500 text-xs">{{ $movie->duration }} min</span>
                                </div>
                                @php
                                    $timeText = str_replace(['mos', 'wk', 'dy', 'hr', 'min', 'sec', ' from now', ' ago'], ['mo', 'w', 'd', 'h', 'm', 's', '', ''], $movie->release_date->diffForHumans(['parts' => 2, 'short' => true]));
                                @endphp
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[11px] font-bold tracking-wide text-white uppercase bg-gradient-to-r from-blue-500 to-red-600 rounded-lg border border-white/10">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
In {{ $timeText }}
                                    </span>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>


        <!-- Modern Cinematic Pagination -->
        @if($movies->hasPages())
            <div class="mt-24 mb-12">
                <div class="max-w-4xl mx-auto">
                    <!-- Results Info -->
                    <div class="text-center mb-8 p-6 bg-slate-900/50 backdrop-blur-xl border border-slate-800/50 rounded-2xl shadow-2xl">
                        <p class="text-slate-400 text-sm font-medium uppercase tracking-wide">
                            Showing <span class="text-white font-bold text-lg">{{ $movies->firstItem() }}</span> to
                            <span class="text-white font-bold text-lg">{{ $movies->lastItem() }}</span> of
                            <span class="text-white font-bold text-lg">{{ $movies->total() }}</span> upcoming movies
                        </p>
                    </div>

                    <!-- Pagination Controls -->
                    <div class="flex items-center justify-center gap-2 bg-slate-900/50 backdrop-blur-xl border border-slate-800/50 rounded-3xl p-2 px-4 shadow-2xl">
                        {{ $movies->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @endif

    @else
        <!-- No Results -->
        <div class="text-center py-32">
            <div class="w-32 h-32 mx-auto mb-8 p-8 bg-slate-800/50 rounded-3xl border-4 border-dashed border-slate-700/50 flex items-center justify-center">
                <svg class="w-16 h-16 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
            </div>
            <h2 class="text-4xl font-black bg-gradient-to-r from-slate-400 to-slate-200 bg-clip-text text-transparent mb-6">
                No Upcoming Movies
            </h2>
            <p class="text-xl text-slate-400 mb-12 max-w-md mx-auto leading-relaxed">
                Check back later for exciting new releases.
            </p>
from-red-500 to-red-600 hover:from-red-600 hover:to-red-700
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Browse Now Showing
            </a>
        </div>
    @endif
</section>

@endsection

