@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-black py-32 lg:py-44 overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_right,_var(--tw-gradient-stops))] from-red-900/20 via-transparent to-slate-900/20"></div>
        <div class="absolute -inset-1/2 bg-[radial-gradient(circle_at_25%25%,theme(colors.red.400/0.15),transparent_50%)]"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxjaXJjbGUgY3g9IjUwIiBjeT0iNTAiIHI9IjMiIGZpbGw9InVybCgjZ3JhZGllbnQpIi8+CjxkZWZzPgo8cmFkaWFsR3JhZGllbnQgaWQ9ImdyYWRpZW50IiBjeD0iNTAlIiBjeT0iNTAlIiByPSIzNSUiPgo8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjRkY2MjY2IiBzdG9wLW9wYWNpdHk9IjAuMyIvPgo8c3RvcCBvZmZzZXQ9IjEwMCUiBzdG9wLWNvbG9yPSIjRkY0NDQ0IiBzdG9wLW9wYWNpdHk9IjAuMSIvPgo8L3JhZGlhbEdyYWRpZW50Pgo8L2RlZnM+Cjwvc3ZnPg==')] opacity-20 animate-pulse"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-black bg-gradient-to-r from-white via-slate-200 to-red-400 bg-clip-text text-transparent drop-shadow-2xl mb-8 leading-none">
                CineVerse
            </h1>
            <p class="text-2xl md:text-3xl lg:text-4xl font-bold text-slate-300/90 mb-12 max-w-3xl mx-auto leading-relaxed drop-shadow-lg">
                The ultimate movie booking experience at your fingertips
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center max-w-2xl mx-auto">
                <a href="{{ route('movies.index') }}" class="group relative inline-flex items-center gap-4 px-12 py-8 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold text-2xl rounded-4xl shadow-2xl hover:shadow-4xl hover:-translate-y-3 transition-all duration-700 backdrop-blur-xl border border-red-500/50 hover:border-red-600/70 w-full sm:w-auto text-center uppercase tracking-wide">
                    <span class="group-hover:hidden">Book Movie</span>
                    <span class="hidden group-hover:inline">Start Booking</span>
                    <svg class="w-8 h-8 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="#now-showing" class="inline-flex items-center gap-3 px-10 py-8 text-2xl font-bold text-slate-300 hover:text-white border-2 border-slate-700/50 hover:border-slate-600/50 rounded-4xl hover:bg-slate-800/30 backdrop-blur-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                    <svg class="w-10 h-10 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v10c0 2.21 1.79 4 4 4s4-1.79 4-4V4M15 16h1M9 16h1M4 20h16a1 1 0 001-1v-2a1 1 0 00-1-1H4a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                    Watch Trailer
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Now Showing -->
<section id="now-showing" class="py-32 relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-24">
            <h2 class="text-5xl md:text-6xl font-black bg-gradient-to-r from-slate-200 via-white to-slate-300 bg-clip-text text-transparent drop-shadow-2xl mb-6">
                Now Showing
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-red-500 to-orange-500 rounded-full mx-auto shadow-lg"></div>
        </div>

        @if($movies->count() > 0)
            <!-- Action Bar -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center sm:justify-start items-center mb-16 pb-12 border-b border-slate-800/50">
                <div class="flex gap-4">
                    <a href="{{ route('movies.index') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-slate-800/50 to-slate-900/50 backdrop-blur-xl border border-slate-700/50 hover:border-slate-600 hover:bg-slate-800/70 text-slate-300 hover:text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        {{ $movies->total() }} Movies Showing
                    </a>
                </div>
            </div>

            <!-- Movies Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-8">
                @foreach($movies as $movie)
                    <article class="group relative">
                        <div class="bg-gradient-to-b from-slate-900/80 to-slate-800/60 backdrop-blur-xl border border-slate-800/50 rounded-4xl overflow-hidden shadow-2xl hover:shadow-4xl hover:-translate-y-4 hover:scale-[1.02] transition-all duration-700 hover:border-red-500/60">
                            <!-- Poster -->
                            <div class="relative h-80 lg:h-96 overflow-hidden">
                                @if($movie->poster)
                                    <img
                                        src="{{ $movie->poster }}"
                                        alt="{{ $movie->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                                    >
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-slate-900/80 to-slate-800 relative overflow-hidden flex items-center justify-center">
                                        <div class="absolute inset-0 bg-gradient-to-r animate-shimmer from-slate-700/50"></div>
                                        <svg class="w-24 h-24 text-slate-400 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>
                                @endif
                                <!-- Quick Action Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-8">
                                    <a href="{{ route('movies.show', $movie->id) }}" class="w-full flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-3xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300 mx-6 backdrop-blur-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2a3 3 0 01-3 3H9a3 3 0 01-3-3V5a3 3 0 013-3h3a3 3 0 013 3z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Book Now
                                    </a>
                                </div>
                            </div>

                            <!-- Movie Info -->
                            <div class="p-8">
                                <h4 class="text-2xl lg:text-3xl font-bold text-white mb-4 line-clamp-2 group-hover:text-red-400 transition-colors pr-2">
                                    {{ $movie->title }}
                                </h4>

                                <div class="flex flex-wrap gap-4 items-center mb-8 text-lg">
                                    <div class="flex items-center gap-2 text-slate-400 bg-slate-800/50 px-4 py-2 rounded-2xl backdrop-blur">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $movie->duration }} min
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-400 bg-slate-800/50 px-4 py-2 rounded-2xl backdrop-blur">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \App\Helpers\DateHelper::formatReleaseDate($movie->release_date) }}
                                    </div>
                                </div>

                                <div class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-red-500/20 to-red-600/20 backdrop-blur border border-red-500/40 rounded-full font-bold text-xl text-red-300 shadow-lg">
                                    {{ $movie->genre }}
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- CTA -->
            <div class="text-center mt-24">
                <a href="{{ route('movies.index') }}" class="inline-flex items-center gap-4 px-16 py-8 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold text-2xl rounded-4xl shadow-2xl hover:shadow-4xl hover:-translate-y-3 transition-all duration-700 backdrop-blur-xl border border-red-500/50 hover:border-red-600/70 uppercase tracking-wide group">
                    <span>View All Movies</span>
                    <svg class="w-8 h-8 group-hover:translate-x-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        @else
            <!-- No Movies -->
            <div class="text-center py-32">
                <div class="inline-flex w-36 h-36 bg-slate-800/50 rounded-4xl items-center justify-center mb-12 p-8 border-4 border-dashed border-slate-700/50 mx-auto group hover:bg-slate-800 transition-colors">
                    <svg class="w-20 h-20 text-slate-500 group-hover:text-slate-400 w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h2 class="text-5xl font-black text-slate-400 mb-6">No Movies Premiering</h2>
                <p class="text-2xl text-slate-500 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Lights, camera... coming soon! Check back for our latest cinematic premieres.
                </p>
                <a href="{{ route('movies.index') }}" class="inline-flex items-center px-12 py-6 bg-gradient-to-r from-slate-700/50 to-slate-800/50 hover:from-slate-600 hover:to-slate-700 text-slate-300 hover:text-white font-bold text-xl rounded-4xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-300 backdrop-blur-xl border border-slate-700/50 hover:border-slate-600/50">
                    Explore Full Catalog
                </a>
            </div>
        @endif
    </div>
</section>
@endsection

