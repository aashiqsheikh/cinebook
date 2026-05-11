@extends('layouts.app')

@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes shimmer {
        0% { background-position: -200% center; }
        100% { background-position: 200% center; }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }

    .btn-glow:hover {
        box-shadow: 0 0 24px rgba(239, 68, 68, 0.45), 0 0 48px rgba(239, 68, 68, 0.2);
    }
    .btn-glow-secondary:hover {
        box-shadow: 0 0 24px rgba(168, 85, 247, 0.4), 0 0 48px rgba(168, 85, 247, 0.15);
    }
    .btn-glow-emerald:hover {
        box-shadow: 0 0 24px rgba(16, 185, 129, 0.45), 0 0 48px rgba(16, 185, 129, 0.2);
    }

    .card-lift {
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.4s ease, border-color 0.3s ease;
    }
    .card-lift:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.05);
    }

    .poster-glow:hover {
        box-shadow: 0 0 30px rgba(239, 68, 68, 0.15);
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .shimmer-text {
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        background-size: 200% auto;
        animation: shimmer 3s linear infinite;
        -webkit-background-clip: text;
        background-clip: text;
    }
</style>

<!-- ===== HERO SECTION ===== -->
<section class="relative min-h-[92vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-black">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-red-900/12 via-transparent to-slate-950/80"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_var(--tw-gradient-stops))] from-blue-900/8 via-transparent to-transparent"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIzMiIgY3k9IjMyIiByPSIxIiBmaWxsPSJ3aGl0ZSIgZmlsbC1vcGFjaXR5PSIwLjAzIi8+PC9zdmc+')] opacity-25"></div>

    <div class="relative z-10 w-full max-w-5xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm mb-8 animate-fade-in-up">
            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
            <span class="text-xs font-semibold text-slate-300 tracking-wider uppercase">Now Booking Open</span>
        </div>

        <h1 class="animate-fade-in-up text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black bg-gradient-to-r from-white via-slate-200 to-red-400 bg-clip-text text-transparent mb-6 leading-tight tracking-tight">
            CineVerse
        </h1>

        <p class="animate-fade-in-up delay-100 text-lg sm:text-xl md:text-2xl font-medium text-slate-400 mb-10 max-w-2xl mx-auto leading-relaxed">
            Book tickets for the latest blockbusters in your city. Seamless, fast, and hassle-free.
        </p>

        <div class="animate-fade-in-up delay-200 flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-5">
            <a href="#now-showing" class="btn-glow group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold text-base sm:text-lg rounded-2xl transition-all duration-300 hover:scale-105">
                <i class="fas fa-ticket text-lg"></i>
                <span>Book Movie</span>
            </a>

            <a href="{{ route('movies.index') }}" class="btn-glow-secondary group inline-flex items-center gap-3 px-8 py-4 text-slate-300 hover:text-white font-bold text-base sm:text-lg rounded-2xl border border-slate-700/60 hover:border-purple-500/50 bg-slate-800/40 hover:bg-slate-800/60 backdrop-blur-md transition-all duration-300 hover:scale-105">
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                <span>Browse All</span>
            </a>
        </div>

        <!-- Scroll indicator -->
        <div class="animate-fade-in-up delay-400 mt-20">
            <a href="#now-showing" class="inline-flex flex-col items-center gap-2 text-slate-500 hover:text-slate-300 transition-colors duration-300">
                <span class="text-xs font-medium tracking-widest uppercase">Explore</span>
                <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- ===== NOW SHOWING SECTION ===== -->
<section id="now-showing" class="relative bg-gradient-to-b from-black via-slate-950 to-slate-950 py-16 sm:py-20">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-10">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-1.5 h-8 bg-gradient-to-b from-red-500 to-red-600 rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Now Showing</h2>
                </div>
                <p class="text-slate-400 text-base max-w-md">Grab your popcorn. These movies are playing in theatres right now.</p>
            </div>
            <a href="{{ route('movies.index') }}" class="group inline-flex items-center gap-2 text-red-400 hover:text-red-300 font-semibold text-sm transition-colors">
                View All Movies
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        @if(isset($nowShowingMovies) && $nowShowingMovies->count() > 0)
            <!-- Desktop Grid / Mobile Scroll -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($nowShowingMovies as $movie)
                    @php
                        $avgRating = $movie->average_rating ?? rand(35, 50) / 10;
                        $ratingCount = $movie->rating_count ?? rand(50, 500);
                        $fullStars = floor($avgRating);
                        $halfStar = ($avgRating - $fullStars) >= 0.5;
                    @endphp
                    <article class="card-lift group">
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
                                    <a href="{{ route('movies.show', $movie->id) }}" class="btn-glow w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold text-sm rounded-xl transition-all duration-300 hover:scale-[1.02]">
                                        <i class="fas fa-ticket text-sm"></i>
                                        Book Now
                                    </a>
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
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-14">
                <div class="w-16 h-16 bg-slate-800/50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-dashed border-slate-700/50">
                    <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v10c0 2.21 1.79 4 4 4s4-1.79 4-4V4M15 16h1M9 16h1M4 20h16a1 1 0 001-1v-2a1 1 0 00-1-1H4a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-400 mb-1">No Movies Playing</h3>
                <p class="text-slate-500 text-sm mb-4">Check out what's coming soon instead.</p>
                <a href="#coming-soon" class="inline-flex items-center gap-2 text-purple-400 hover:text-purple-300 text-sm font-semibold transition-colors">
                    See Upcoming
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- ===== COMING SOON SECTION ===== -->
<section id="coming-soon" class="relative bg-gradient-to-b from-slate-950 via-slate-950 to-black py-16 sm:py-20">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-10">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-1.5 h-8 bg-gradient-to-b from-purple-500 to-indigo-600 rounded-full"></div>
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Coming Soon</h2>
                </div>
                <p class="text-slate-400 text-base max-w-md">Mark your calendars. The most anticipated releases are on their way.</p>
            </div>
            <a href="{{ route('movies.coming-soon') }}" class="group inline-flex items-center gap-2 text-purple-400 hover:text-purple-300 font-semibold text-sm transition-colors">
                View All Upcoming
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        @if(isset($upcomingMovies) && $upcomingMovies->count() > 0)
            <!-- Horizontal scroll on mobile, grid on desktop -->
            <div class="flex lg:grid lg:grid-cols-3 gap-5 overflow-x-auto scrollbar-hide pb-4 lg:pb-0 snap-x snap-mandatory -mx-6 px-6 lg:mx-0 lg:px-0">
                @foreach($upcomingMovies->take(6) as $movie)
                    @php
                        $daysUntil = now()->diffInDays($movie->release_date, false);
                        $isSoon = $daysUntil >= 0 && $daysUntil <= 14;
                    @endphp
                    <article class="card-lift group flex-shrink-0 w-[280px] sm:w-[320px] lg:w-auto snap-start">
                        <div class="bg-slate-900/70 backdrop-blur border border-slate-800/60 rounded-3xl overflow-hidden shadow-lg hover:shadow-purple-500/10 hover:border-purple-500/20 transition-all duration-500 h-full flex flex-col">
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

                                <!-- Release Badge -->
                                <div class="absolute top-3 right-3">
                                    @if($isSoon)
                                        <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-bold rounded-lg shadow-md ring-1 ring-red-400/40">
                                            <svg class="w-3 h-3 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $daysUntil <= 0 ? 'Tomorrow' : $daysUntil . ' days' }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-black/50 backdrop-blur-md text-white text-xs font-bold rounded-lg border border-white/10">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $movie->release_date->format('M d') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="p-4 flex flex-col flex-grow">
                                <h3 class="text-lg sm:text-xl font-bold text-white mb-2 group-hover:text-purple-400 transition-colors line-clamp-1">{{ $movie->title }}</h3>
                                <div class="flex items-center gap-3 text-xs text-slate-400 mb-4">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $movie->duration }} min
                                    </span>
                                    <span class="text-slate-700">|</span>
                                    <span>{{ $movie->genre }}</span>
                                </div>

                                @php
                                    $timeText = str_replace(['mos', 'wk', 'dy', 'hr', 'min', 'sec', ' from now', ' ago'], ['mo', 'w', 'd', 'h', 'm', 's', '', ''], $movie->release_date->diffForHumans(['parts' => 2, 'short' => true]));
                                @endphp

                                <div class="mt-auto space-y-3">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[11px] font-bold tracking-wide text-white uppercase bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg border border-white/10 shadow-[0_0_12px_rgba(99,102,241,0.2)]">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        In {{ $timeText }}
                                    </span>

                                    <button type="button" onclick="alert('You will be notified when {{ addslashes($movie->title) }} tickets are available!')" class="w-full btn-glow-emerald inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-xs rounded-xl transition-all duration-300 hover:scale-[1.02]">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                        </svg>
                                        Get Notified
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-14">
                <div class="w-16 h-16 bg-slate-800/50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-dashed border-slate-700/50">
                    <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-400 mb-1">No Upcoming Premieres</h3>
                <p class="text-slate-500 text-sm">Check back soon for exciting new releases.</p>
            </div>
        @endif
    </div>
</section>

<!-- ===== FOOTER CTA ===== -->
<section class="relative py-16 sm:py-20 bg-black overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-red-900/10 via-transparent to-transparent"></div>
    <div class="max-w-3xl mx-auto px-6 text-center relative z-10">
        <h2 class="text-3xl sm:text-4xl font-black text-white mb-4 tracking-tight">Ready to Watch?</h2>
        <p class="text-slate-400 text-base sm:text-lg mb-8 max-w-lg mx-auto">Book your tickets in seconds. No queues, no hassle — just pure cinema magic.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('movies.index') }}" class="btn-glow inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold text-base rounded-2xl transition-all duration-300 hover:scale-105 shadow-lg">
                <i class="fas fa-ticket text-lg"></i>
                Book Tickets Now
            </a>
            <a href="#coming-soon" class="inline-flex items-center gap-2 text-slate-400 hover:text-white font-semibold text-sm transition-colors">
                See What's Coming
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endsection

