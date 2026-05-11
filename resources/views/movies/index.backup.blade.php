@extends('layouts.app')

@section('content')

<!-- Hero Header -->
<div class="relative bg-gradient-to-r from-slate-900 via-red-900/20 to-slate-900 pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzIiIGN5PSIzMiIgcj0iMSIgc3R5bGU9InN0b3AtY29sb3I6I2ZmZmZmZjA7c3RvcC1vcGFjaXR5OjAuMDk7c3R5bGU9c3RvcC1jb2xvcjojZTY1ZjllMDA7c3R5bGU9c3RvcC1vcGFjaXR5OjAuMjQiLz4KPC9zdmc+')] opacity-20"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-black bg-gradient-to-r from-white via-slate-100 to-slate-200 bg-clip-text text-transparent mb-6 drop-shadow-2xl">
            Movies
        </h1>
        <p class="text-xl md:text-2xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
            Discover blockbuster hits, indie gems, and everything in between. Book your cinema experience today.
        </p>
    </div>
</div>

<!-- Search & Filters -->
<section class="relative -mt-12 lg:-mt-20 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800/50 rounded-3xl p-8 lg:p-12 shadow-2xl">
            <form method="GET" action="{{ route('movies.index') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-end">
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
                            placeholder="Search by title, actor, or director..."
                            class="w-full pl-12 pr-4 py-5 bg-slate-800/50 border-2 border-slate-700/50 focus:border-red-500/70 focus:bg-slate-800/70 rounded-2xl text-white placeholder-slate-400 transition-all duration-300 text-lg backdrop-blur-sm shadow-inner hover:shadow-md hover:border-slate-600/50"
                        >
                    </div>
                </div>

                <!-- Genre Filter -->
                <div>
                    <label class="sr-only">Genre</label>
                    <div class="relative">
                        <select name="genre" class="w-full px-5 py-5 bg-slate-800/50 border-2 border-slate-700/50 focus:border-red-500/70 focus:bg-slate-800/70 rounded-2xl text-white text-lg backdrop-blur-sm shadow-inner hover:shadow-md hover:border-slate-600/50 transition-all duration-300 appearance-none bg-no-repeat bg-right">
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
            <a href="{{ route('movies.index') }}" class="px-8 py-3 rounded-xl text-lg font-bold bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg">
                Now Showing
            </a>
            <a href="{{ route('movies.coming-soon') }}" class="px-8 py-3 rounded-xl text-lg font-bold text-slate-400 hover:text-white transition-all duration-300">
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
                    $avgRating = $movie->average_rating ?? rand(35, 50) / 10;
                    $fullStars = floor($avgRating);
                    $halfStar = ($avgRating - $fullStars) >= 0.5;
                @endphp
                <article class="card-lift group">
                    <a href="{{ route('movies.show', $movie->id) }}" class="block">
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

                                <!-- Rating Badge -->
                                <div class="absolute top-3 left-3">
                                    <div class="flex items-center gap-1 px-2.5 py-1 bg-black/60 backdrop-blur-md rounded-lg border border-white/10">
                                        <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="text-white text-xs font-bold">{{ number_format($avgRating, 1) }}</span>
                                    </div>
                                </div>

                                <!-- Hover overlay with Book button -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400 flex items-end p-4">
                                    <span class="btn-glow w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold text-sm rounded-xl transition-all duration-300 hover:scale-[1.02]">
                                        <i class="fas fa-ticket text-sm"></i>
                                        Book Now
                                    </span>
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="p-4">
                                <h3 class="text-lg sm:text-xl font-bold text-white mb-1 group-hover:text-red-400 transition-colors line-clamp-1">{{ $movie->title }}</h3>
                                <div class="flex items-center justify-between">
                                    <span class="inline-flex items-center px-2.5 py-0.5 bg-slate-800 text-slate-300 text-xs font-medium rounded-lg">{{ $movie->genre }}</span>
                                    <span class="text-slate-500 text-xs">{{ $movie->duration }} min</span>
                                </div>
                            </div>
                        </div>
                    </a>
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
                            <span class="text-white font-bold text-lg">{{ $movies->total() }}</span> movies
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
                No Movies Found
            </h2>
            <p class="text-xl text-slate-400 mb-12 max-w-md mx-auto leading-relaxed">
                Try adjusting your search or discover our latest releases below.
            </p>
            <a href="{{ route('movies.index') }}" class="inline-flex items-center px-10 py-5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-2xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-300 text-lg">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Explore All Movies
            </a>
        </div>
    @endif
</section>

@endsection

