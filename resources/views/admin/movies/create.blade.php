@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900/20 to-slate-900 py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Hero Card Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl shadow-2xl mb-8 ring-4 ring-blue-500/30 mx-auto">
                <i class="fas fa-plus text-3xl text-white"></i>
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black bg-gradient-to-r from-gray-100 via-white to-gray-100/70 bg-clip-text text-transparent mb-6 drop-shadow-2xl tracking-tight">
                Add New Movie
            </h1>
            <p class="text-2xl text-gray-400 font-medium max-w-2xl mx-auto leading-relaxed">Create and manage your movie catalog with ease</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-gray-800/60 backdrop-blur-xl border border-gray-700/70 rounded-4xl shadow-2xl p-12 ring-2 ring-slate-800/50 hover:shadow-3xl transition-all duration-500 hover:-translate-y-2">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.movies.store') }}">
                        @csrf

                        <!-- Title Field -->
                        <div class="space-y-3">
                            <label for="title" class="block text-xl font-bold text-gray-200 tracking-wide">Movie Title</label>
                            <input type="text" id="title" name="title" required
                                   class="w-full px-8 py-6 text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 hover:border-gray-500 shadow-xl placeholder-gray-500 text-gray-200 font-semibold tracking-wide">
                        </div>

                        <!-- Description Field -->
                        <div class="space-y-3">
                            <label for="description" class="block text-xl font-bold text-gray-200 tracking-wide">Movie Description</label>
                            <textarea id="description" name="description" rows="6" required
                                      class="w-full px-8 py-6 text-lg bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all duration-300 hover:border-gray-500 shadow-xl placeholder-gray-500 resize-vertical text-gray-200 font-medium leading-relaxed"></textarea>
                        </div>

                        <!-- Poster URL Field -->
                        <div class="space-y-3">
                            <label for="poster_url" class="block text-xl font-bold text-gray-200 tracking-wide">Poster Image URL</label>
                            <div class="relative">
                                <input type="url" id="poster_url" name="poster_url" placeholder="https://example.com/movie-poster.jpg"
                                       class="w-full pl-14 pr-8 py-6 text-lg bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-medium">
                                <i class="fas fa-image absolute left-5 top-1/2 -translate-y-1/2 text-gray-500 text-xl"></i>
                            </div>
                            <p class="text-sm text-gray-500 italic font-medium">Enter a valid image URL (jpg, png, jpeg, gif)</p>
                        </div>

                        <!-- Duration Field -->
                        <div class="space-y-3">
                            <label for="duration" class="block text-xl font-bold text-gray-200 tracking-wide">Duration (minutes)</label>
                            <input type="number" id="duration" name="duration" required min="1"
                                   class="w-full px-8 py-6 text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-bold tracking-wide [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Genre Field -->
                        <div class="space-y-3">
                            <label for="genre" class="block text-xl font-bold text-gray-200 tracking-wide">Genre</label>
                            <select id="genre" name="genre" required
                                    class="w-full px-8 py-6 text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-pink-500/50 focus:border-pink-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-semibold appearance-none cursor-pointer">
                                <option value="">Select Genre</option>
                                <option value="Action">Action</option>
                                <option value="Comedy">Comedy</option>
                                <option value="Drama">Drama</option>
                                <option value="Horror">Horror</option>
                                <option value="Sci-Fi">Sci-Fi</option>
                                <option value="Thriller">Thriller</option>
                                <option value="Romance">Romance</option>
                                <option value="Animation">Animation</option>
                                <option value="Documentary">Documentary</option>
                            </select>
                            <i class="fas fa-list absolute right-6 top-[8.5rem] text-gray-500 text-xl pointer-events-none"></i>
                        </div>

                        <!-- Release Date Field -->
                        <div class="space-y-3">
                            <label for="release_date" class="block text-xl font-bold text-gray-200 tracking-wide">Release Date</label>
                            <input type="date" id="release_date" name="release_date" required
                                   class="w-full px-8 py-6 text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-purple-500/50 focus:border-purple-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-bold tracking-wide">
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t-2 border-gray-700/50 mt-8">
                            <a href="{{ route('admin.movies.index') }}" class="flex-1 group bg-gray-700 hover:bg-gray-600 text-gray-200 px-6 py-2 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl transition-all duration-300 justify-center items-center">
                                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                                Cancel
                            </a>
                            <button type="submit" class="flex-1 group bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl transition-all duration-300 justify-center items-center">
                                <i class="fas fa-rocket mr-2 group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                                Add Movie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

