@extends('layouts.app')

@section('content')

<!-- Movie Hero Header -->
<section class="relative bg-gradient-to-br from-slate-900 via-red-900/10 to-slate-900 py-24 lg:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-red-500/5 via-transparent to-slate-900/50"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-3 gap-12 items-start">
            <!-- Poster -->
            <div class="lg:col-span-1">
                <div class="sticky top-8 max-w-sm mx-auto lg:mx-0">
                    @if($movie->poster)
                        <img
                            src="{{ $movie->poster }}"
                            alt="{{ $movie->title }}"
                            class="w-full aspect-[2/3] object-cover rounded-3xl shadow-2xl ring-4 ring-slate-900/50 hover:ring-red-500/50 transition-all duration-500 hover:scale-[1.02] hover:shadow-3xl"
                            loading="lazy"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"
                        >
                        <div class="flex items-center justify-center w-full aspect-[2/3] bg-gradient-to-br from-slate-900/80 to-slate-800 rounded-3xl backdrop-blur-xl border-4 border-slate-800/50 text-6xl hidden">
                            <svg class="w-24 h-24 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M7 4v10c0 2.21 1.79 4 4 4s4-1.79 4-4V4M15 16h1M9 16h1M4 20h16a1 1 0 001-1v-2a1 1 0 00-1-1H4a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                            </svg>
                        </div>
                    @else
                        <div class="w-full aspect-[2/3] bg-gradient-to-br from-slate-900/80 to-slate-800 rounded-3xl flex flex-col items-center justify-center border-4 border-slate-800/50 backdrop-blur-xl shadow-2xl">
                            <svg class="w-24 h-24 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="text-2xl font-bold text-slate-200">No Poster</h3>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Movie Info -->
            <div class="lg:col-span-2 space-y-6">
                <div>
                    <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500/20 to-red-600/20 backdrop-blur-sm text-red-300 border border-red-500/40 rounded-full text-sm font-bold uppercase tracking-wide">
                        {{ $movie->genre }}
                    </span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black bg-gradient-to-r from-white via-slate-100 to-slate-300 bg-clip-text text-transparent leading-tight">
                    {{ $movie->title }}
                </h1>
                <div class="flex flex-wrap items-center gap-6 text-xl text-slate-300">
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        {{ $movie->duration }} mins
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ \App\Helpers\DateHelper::formatReleaseDate($movie->release_date) }}
                    </div>
                    <div class="flex items-center gap-1">
                        @php $avgRating = round($movie->average_rating ?? 0, 1); @endphp
                        <div class="flex gap-0.5">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-7 h-7 {{ $i <= $avgRating ? 'text-yellow-400 fill-current' : 'text-slate-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <span>({{ $movie->rating_count ?? 0 }})</span>
                    </div>
                </div>
                <p class="text-xl leading-relaxed text-slate-300 max-w-4xl">
                    {{ $movie->description }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Ratings & Reviews -->
<section class="py-20 bg-slate-950/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-12">
            <svg class="w-12 h-12 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <div>
                <h2 class="text-4xl font-black text-white">Ratings & Reviews</h2>
                <div class="flex items-center gap-2 text-2xl">
                    <span class="text-yellow-400 font-black">{{ round($movie->average_rating ?? 0, 1) }}</span>
                    <span class="text-slate-400">/ 5 ({{ number_format($movie->rating_count ?? 0) }} reviews)</span>
                </div>
            </div>
        </div>

        @auth
            <!-- Rate Movie Form -->
            <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800/50 rounded-3xl p-8 lg:p-12 mb-12 shadow-2xl">
                <h3 class="text-2xl font-bold mb-8 text-white flex items-center gap-3">
                    <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Rate this movie
                </h3>
                <form method="POST" action="{{ route('ratings.store', $movie) }}" class="grid md:grid-cols-3 gap-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">Your Rating</label>
                        <div class="flex items-center gap-1">
                            @for($i = 5; $i >= 1; $i--)
                                <label>
                                    <input type="radio" name="rating" value="{{ $i }}" class="sr-only" {{ old('rating') == $i ? 'checked' : '' }} required>
                                    <svg class="w-12 h-12 cursor-pointer transition-all {{ old('rating') >= $i || $errors->first('rating') ? 'text-yellow-400 fill-current scale-110 shadow-lg shadow-yellow-500/25' : 'text-slate-600 hover:text-yellow-400 hover:scale-110' }} duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </label>
                            @endfor
                        </div>
                        @error('rating')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-300 mb-3">Review (Optional)</label>
                        <textarea
                            name="review"
                            rows="4"
                            placeholder="Share your thoughts about the movie..."
                            class="w-full px-5 py-4 bg-slate-800/50 border border-slate-700/50 rounded-2xl text-white placeholder-slate-400 focus:ring-2 focus:ring-red-500/50 focus:border-red-500/70 transition-all duration-300 resize-vertical backdrop-blur-sm shadow-inner hover:shadow-md text-lg"
                        >{{ old('review') }}</textarea>
                        @error('review')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-3 flex justify-end pt-2">
                        <button type="submit" class="px-10 py-4 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 whitespace-nowrap flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Submit Rating
                        </button>
                    </div>
                </form>
            </div>
        @endauth

        <!-- Recent Reviews -->
        @if($movie->ratings()->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($movie->ratings()->with('user')->latest()->take(6)->get() as $rating)
                    <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800/50 rounded-3xl p-8 hover:shadow-2xl hover:border-red-500/50 transition-all duration-400 group">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="flex gap-1 pt-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= $rating->rating ? 'text-yellow-400 fill-current' : 'text-slate-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <div class="ml-auto">
                                <span class="inline-flex items-center px-3 py-1 bg-gradient-to-r from-red-500/20 to-yellow-500/20 text-sm font-bold text-white rounded-full">
                                    {{ $rating->rating }}/5
                                </span>
                            </div>
                        </div>
                        @if($rating->review)
                            <p class="text-slate-300 leading-relaxed mb-6 group-hover:text-white transition-colors">
                                {{ Str::limit($rating->review, 200) }}
                            </p>
                        @endif
                        <div class="flex items-center justify-between pt-6 border-t border-slate-800/50">
                            <div>
                                <p class="font-semibold text-white">{{ $rating->user->name }}</p>
                                <p class="text-sm text-slate-500">{{ $rating->created_at->diffForHumans() }}</p>
                            </div>
                            @if($rating->user_id === Auth::id())
                                <form method="POST" action="{{ route('ratings.destroy', [$movie, $rating->id]) }}" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-400 hover:text-red-500 hover:bg-red-500/10 rounded-xl transition-all group-hover:scale-105" onclick="return confirm('Remove your rating?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24 bg-slate-900/30 rounded-3xl border-4 border-dashed border-slate-800/50">
                <svg class="w-24 h-24 text-slate-500 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674zM12 14a2 2 0 100-4 2 2 0 000 4z"/>
                </svg>
                <h3 class="text-3xl font-bold text-slate-300 mb-4">No reviews yet</h3>
                <p class="text-xl text-slate-500 mb-8 max-w-md mx-auto">
                    Be the first to rate and review this movie!
                </p>
                @auth
                    <a href="#rate-movie" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-slate-900 font-bold rounded-2xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        Write Review
                    </a>
                @endauth
            </div>
        @endif
    </div>
</section>

<!-- Showtimes -->
@if($shows->count() > 0)
<section class="py-24 bg-slate-900/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-black bg-gradient-to-r from-white via-slate-100 to-red-400 bg-clip-text text-transparent mb-6">
                Available Showtimes
            </h2>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                Pick your perfect time and theatre for the cinema experience
            </p>
        </div>

        @foreach($shows as $date => $dateShows)
            <div class="mb-20">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-white mb-2 flex items-center justify-center gap-3">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                      {{ \App\Helpers\DateHelper::formatEmailDate($date) }}
                    </h3>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($dateShows as $show)
                        <div class="group relative bg-slate-900/60 backdrop-blur-xl border border-slate-800/50 rounded-3xl p-8 hover:shadow-2xl hover:border-red-500/50 hover:bg-slate-900/80 transition-all duration-500 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-red-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-6">
                                    <span class="text-3xl font-black text-white drop-shadow-lg">
                                        {{ \App\Helpers\DateHelper::formatTime24Hour($show->show_time) }}
                                    </span>
                                    <span class="text-2xl font-bold bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-xl shadow-lg">
                                        ₹{{ number_format($show->price) }}
                                    </span>
                                </div>
                                <div class="space-y-3 mb-8">
                                    <div class="flex items-center gap-2 text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5-4h1m-1 4h1m8-4h1m-1 4h1"/>
                                        </svg>
                                        {{ $show->theatre->name }}
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-400 text-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $show->theatre->location }}
                                    </div>
                                </div>
                                <a href="{{ route('booking.select-seats', $show->id) }}" class="inline-flex w-full items-center justify-center px-8 py-5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-2 group-hover:scale-[1.02] transition-all duration-300 uppercase tracking-wide">
                                    <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2a3 3 0 01-3 3H9a3 3 0 01-3-3V5a3 3 0 013-3h3a3 3 0 013 3z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Book Now
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
@else
<section class="py-24 text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <svg class="w-32 h-32 text-slate-600 mx-auto mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <h2 class="text-4xl font-bold text-slate-300 mb-6">No Shows Available</h2>
        <p class="text-xl text-slate-500 mb-12 max-w-2xl mx-auto leading-relaxed">
            No showtimes scheduled for this movie right now. Please check back later for updates!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('movies.index') }}" class="px-10 py-4 bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-600 hover:to-slate-700 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all">
                Browse Other Movies
            </a>
        </div>
    </div>
</section>
@endif

@endsection
