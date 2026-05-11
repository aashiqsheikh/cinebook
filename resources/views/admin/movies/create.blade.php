@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900/20 to-slate-900 py-12 sm:py-16 lg:py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl sm:max-w-3xl lg:max-w-4xl mx-auto">
        <!-- Hero Card Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl shadow-2xl mb-8 ring-4 ring-blue-500/30 mx-auto">
                <i class="fas fa-plus text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black bg-gradient-to-r from-gray-100 via-white to-gray-100/70 bg-clip-text text-transparent mb-6 drop-shadow-2xl tracking-tight">
                Add New Movie
            </h1>
            <p class="text-2xl text-gray-400 font-medium max-w-2xl mx-auto leading-relaxed">Create and manage your movie catalog with ease</p>
        </div>

        <!-- Upcoming Movie Tip -->
        <div class="mb-8 bg-gradient-to-r from-purple-600/20 to-indigo-600/20 backdrop-blur border border-purple-500/30 rounded-2xl p-5 flex items-start gap-4">
            <div class="p-2 bg-purple-500/20 rounded-xl shrink-0">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-white font-bold text-base mb-1">Adding an Upcoming Movie?</h3>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Simply set the <strong class="text-purple-300">Release Date</strong> to a future date. The movie will automatically appear in the
                    <a href="{{ route('movies.coming-soon') }}" target="_blank" class="text-purple-400 hover:text-purple-300 underline">Coming Soon</a>
                    page for users. If the date is today or earlier, it will show under
                    <a href="{{ route('movies.index') }}" target="_blank" class="text-red-400 hover:text-red-300 underline">Now Showing</a>.
                </p>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-gray-800/60 backdrop-blur-xl border border-gray-700/70 rounded-4xl shadow-2xl p-8 sm:p-10 lg:p-12 ring-2 ring-slate-800/50 hover:shadow-3xl transition-all duration-500 hover:-translate-y-2">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.movies.store') }}" x-data="{ releaseDate: '' }">
                    @csrf

                    <!-- Title Field -->
                    <div class="space-y-3">
                        <label for="title" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Movie Title</label>
                        <input type="text" id="title" name="title" required
                               class="w-full px-6 py-4 text-lg sm:text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 hover:border-gray-500 shadow-xl placeholder-gray-500 text-gray-200 font-semibold tracking-wide">
                    </div>

                    <!-- Description Field -->
                    <div class="space-y-3">
                        <label for="description" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Movie Description</label>
                        <textarea id="description" name="description" rows="6" required
                                  class="w-full px-6 py-4 text-lg bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all duration-300 hover:border-gray-500 shadow-xl placeholder-gray-500 resize-vertical text-gray-200 font-medium leading-relaxed"></textarea>
                    </div>

                    <!-- Poster URL Field -->
                    <div class="space-y-3">
                        <label for="poster_url" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Poster Image URL</label>
                        <div class="relative">
                            <input type="url" id="poster_url" name="poster_url" placeholder="https://example.com/movie-poster.jpg"
                                   class="w-full pl-14 pr-8 py-4 text-lg bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-medium">
                            <i class="fas fa-image absolute left-5 top-1/2 -translate-y-1/2 text-gray-500 text-xl"></i>
                        </div>
                        <p class="text-sm text-gray-500 italic font-medium">Enter a valid image URL (jpg, png, jpeg, gif)</p>
                    </div>

                    <!-- Duration Field -->
                    <div class="space-y-3">
                        <label for="duration" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Duration (minutes)</label>
                        <input type="number" id="duration" name="duration" required min="1"
                               class="w-full px-6 py-4 text-lg sm:text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-bold tracking-wide [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                    </div>

                    <!-- Genre Field -->
                    <div class="space-y-3">
                        <label for="genre" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Genre</label>
                        <select id="genre" name="genre" required
                                class="w-full px-6 py-4 text-lg sm:text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-pink-500/50 focus:border-pink-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-semibold appearance-none cursor-pointer">
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
                    <div class="space-y-3" x-data="{ today: new Date().toISOString().split('T')[0] }">
                        <div class="flex items-center justify-between">
                            <label for="release_date" class="block text-lg sm:text-xl font-bold text-gray-200 tracking-wide">Release Date</label>
                            <!-- Live Preview Badge -->
                            <span x-show="releaseDate" x-cloak
                                  x-bind:class="releaseDate > today
                                      ? 'bg-gradient-to-r from-purple-500 to-indigo-600 text-white border-purple-400/50 shadow-[0_0_12px_rgba(99,102,241,0.3)]'
                                      : 'bg-gradient-to-r from-green-500 to-emerald-600 text-white border-green-400/50 shadow-[0_0_12px_rgba(34,197,94,0.3)]'"
                                  class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full border transition-all duration-300">
                                <svg x-show="releaseDate > today" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <svg x-show="releaseDate <= today" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span x-text="releaseDate > today ? 'Coming Soon' : 'Now Showing'"></span>
                            </span>
                        </div>
                        <input type="date" id="release_date" name="release_date" required x-model="releaseDate"
                               class="w-full px-6 py-4 text-lg sm:text-xl bg-gray-700/80 border-2 border-gray-600 rounded-3xl focus:ring-4 focus:ring-purple-500/50 focus:border-purple-500 transition-all duration-300 hover:border-gray-500 shadow-xl text-gray-200 font-bold tracking-wide"
                               x-init="releaseDate = '{{ request('upcoming') ? now()->addDay()->format('Y-m-d') : '' }}'">
                        <p x-show="!releaseDate" class="text-sm text-slate-500">Select a date to see where this movie will appear.</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t-2 border-gray-700/50 mt-8">
                        <a href="{{ route('admin.movies.index') }}" class="flex-1 group bg-gray-700 hover:bg-gray-600 text-gray-200 px-8 py-3 text-base sm:text-lg rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 justify-center items-center">
                            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                            Cancel
                        </a>
                        <button type="submit" class="flex-1 group bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 text-base sm:text-lg rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 justify-center items-center">
                            <i class="fas fa-rocket mr-2 group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                            Add Movie
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

