@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900/20 to-slate-900 py-12 sm:py-16 lg:py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl sm:max-w-3xl lg:max-w-4xl mx-auto">
        <!-- Hero Card Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-amber-500 to-orange-600 rounded-3xl shadow-2xl mb-8 ring-4 ring-amber-500/30 mx-auto">
                <i class="fas fa-edit text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black bg-gradient-to-r from-gray-100 via-white to-gray-100/70 bg-clip-text text-transparent mb-6 drop-shadow-2xl tracking-tight">
                Edit Movie
            </h1>
            <p class="text-2xl text-gray-400 font-medium max-w-2xl mx-auto leading-relaxed">Update movie details in your catalog</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-gray-800/60 backdrop-blur-xl border border-gray-700/70 rounded-4xl shadow-2xl p-8 sm:p-10 lg:p-12 ring-2 ring-slate-800/50 hover:shadow-3xl transition-all duration-500 hover:-translate-y-2">
            <form method="POST" action="{{ route('admin.movies.update', $movie->id) }}">
                @csrf
                @method('PUT')

                <!-- Title Field -->
                <div class="space-y-3 mb-6">
                    <label for="title" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Movie Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $movie->title) }}" required
                           class="w-full px-6 py-4 text-lg sm:text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 hover:border-gray-500 shadow-xl placeholder-gray-500 text-gray-200 font-semibold tracking-wide">
                    @error('title')
                        <p class="text-red-400 text-sm font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="space-y-3 mb-6">
                    <label for="description" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Movie Description</label>
                    <textarea id="description" name="description" rows="6" required
                              class="w-full px-6 py-4 text-lg bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all duration-300 hover:border-gray-500 shadow-xl placeholder-gray-500 resize-vertical text-gray-200 font-medium leading-relaxed">{{ old('description', $movie->description) }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-sm font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poster URL Field -->
                <div class="space-y-3 mb-6">
                    <label for="poster_url" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Poster Image URL</label>
                    <div class="relative">
                        <input type="url" id="poster_url" name="poster_url" value="{{ old('poster_url', $movie->poster) }}" placeholder="https://example.com/movie-poster.jpg"
                               class="w-full pl-14 pr-8 py-4 text-lg bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-medium">
                        <i class="fas fa-image absolute left-5 top-1/2 -translate-y-1/2 text-gray-500 text-xl"></i>
                    </div>
                    <p class="text-sm text-gray-500 italic font-medium">Enter a valid image URL (jpg, png, jpeg, gif)</p>
                    @error('poster_url')
                        <p class="text-red-400 text-sm font-medium mt-1">{{ $message }}</p>
                    @enderror

                    @if($movie->poster)
                        <div class="mt-4">
                            <p class="text-sm text-gray-400 mb-2 font-medium">Current Poster:</p>
                            <img src="{{ $movie->poster }}" alt="Current Poster" class="max-h-48 rounded-2xl border-2 border-gray-700 shadow-lg">
                        </div>
                    @endif
                </div>

                <!-- Duration Field -->
                <div class="space-y-3 mb-6">
                    <label for="duration" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Duration (minutes)</label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration', $movie->duration) }}" required min="1"
                           class="w-full px-6 py-4 text-lg sm:text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-bold tracking-wide [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                    @error('duration')
                        <p class="text-red-400 text-sm font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Genre Field -->
                <div class="space-y-3 mb-6 relative">
                    <label for="genre" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Genre</label>
                    <select id="genre" name="genre" required
                            class="w-full px-6 py-4 text-lg sm:text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-pink-500/50 focus:border-pink-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-semibold appearance-none cursor-pointer">
                        <option value="">Select Genre</option>
                        <option value="Action" {{ old('genre', $movie->genre) == 'Action' ? 'selected' : '' }}>Action</option>
                        <option value="Comedy" {{ old('genre', $movie->genre) == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                        <option value="Drama" {{ old('genre', $movie->genre) == 'Drama' ? 'selected' : '' }}>Drama</option>
                        <option value="Horror" {{ old('genre', $movie->genre) == 'Horror' ? 'selected' : '' }}>Horror</option>
                        <option value="Sci-Fi" {{ old('genre', $movie->genre) == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                        <option value="Thriller" {{ old('genre', $movie->genre) == 'Thriller' ? 'selected' : '' }}>Thriller</option>
                        <option value="Romance" {{ old('genre', $movie->genre) == 'Romance' ? 'selected' : '' }}>Romance</option>
                        <option value="Animation" {{ old('genre', $movie->genre) == 'Animation' ? 'selected' : '' }}>Animation</option>
                        <option value="Documentary" {{ old('genre', $movie->genre) == 'Documentary' ? 'selected' : '' }}>Documentary</option>
                        <option value="Biography" {{ old('genre', $movie->genre) == 'Biography' ? 'selected' : '' }}>Biography</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-6 top-[3.2rem] text-gray-500 text-xl pointer-events-none"></i>
                    @error('genre')
                        <p class="text-red-400 text-sm font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Release Date Field -->
                <div class="space-y-3 mb-8">
                    <label for="release_date" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Release Date</label>
                    <input type="date" id="release_date" name="release_date" value="{{ old('release_date', \App\Helpers\DateHelper::formatDateISO($movie->release_date)) }}" required
                           class="w-full px-6 py-4 text-lg sm:text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-purple-500/50 focus:border-purple-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-bold tracking-wide">
                    @error('release_date')
                        <p class="text-red-400 text-sm font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t-2 border-gray-700/50">
                    <a href="{{ route('admin.movies.index') }}" class="flex-1 group bg-gray-700 hover:bg-gray-600 text-gray-200 px-8 py-4 text-base sm:text-lg rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex justify-center items-center">
                        <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                        Cancel
                    </a>
                    <button type="submit" class="flex-1 group bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 text-base sm:text-lg rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex justify-center items-center">
                        <i class="fas fa-save mr-2 group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                        Update Movie
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

