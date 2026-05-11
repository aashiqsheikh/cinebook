@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-slate-900 via-purple-900/30 to-slate-900 py-20 mb-12 rounded-3xl shadow-2xl relative overflow-hidden border border-slate-700/50 backdrop-blur-md">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_right,_var(--tw-gradient-stops))] from-blue-500/20 via-transparent to-transparent"></div>
        <div class="relative z-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 max-w-6xl mx-auto">
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 bg-gradient-to-r from-gray-100 via-white to-gray-100/60 bg-clip-text text-transparent drop-shadow-2xl tracking-tight">
                        <i class="fas fa-film mr-4 text-blue-400 text-3xl inline-block"></i>
                        Movies Management
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-300 font-medium opacity-95 max-w-2xl mx-auto lg:mx-0">Complete movie catalog management system</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-end">
                    <a href="{{ route('admin.movies.create') }}" class="group bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform duration-300 text-sm"></i>
                        Add New Movie
                    </a>
                    <a href="{{ route('admin.movies.create', ['upcoming' => 1]) }}" class="group bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-clock mr-2 group-hover:scale-110 transition-transform duration-300 text-sm"></i>
                        Add Upcoming Movie
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="mb-10 p-8 bg-gradient-to-r from-green-900/60 to-emerald-900/60 border-4 border-green-400/50 rounded-3xl backdrop-blur-xl shadow-2xl ring-2 ring-green-400/30 animate-in slide-in-from-top-4 fade-in duration-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-green-500/20 rounded-2xl ring-2 ring-green-400/40">
                        <i class="fas fa-check-circle text-green-400 text-3xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-100 tracking-wide">{{ session('success') }}</span>
                </div>
                <button onclick="this.closest('div').remove()" class="p-2 hover:bg-white/10 rounded-lg transition-all duration-200 hover:scale-110">
                    <i class="fas fa-times text-xl text-gray-400 hover:text-white"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-10 p-8 bg-gradient-to-r from-red-900/60 to-rose-900/60 border-4 border-red-400/50 rounded-3xl backdrop-blur-xl shadow-2xl ring-2 ring-red-400/30 animate-in slide-in-from-top-4 fade-in duration-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-red-500/20 rounded-2xl ring-2 ring-red-400/40">
                        <i class="fas fa-exclamation-triangle text-red-400 text-3xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-100 tracking-wide">{{ session('error') }}</span>
                </div>
                <button onclick="this.closest('div').remove()" class="p-2 hover:bg-white/10 rounded-lg transition-all duration-200 hover:scale-110">
                    <i class="fas fa-times text-sm text-gray-400 hover:text-white"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Movies Table Card -->
    <div class="bg-gray-900/50 backdrop-blur-xl border border-gray-700/70 rounded-3xl shadow-2xl overflow-hidden mb-12">
        @if($movies->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="sticky top-0 z-10">
                        <tr class="bg-gradient-to-r from-slate-800 via-blue-900/50 to-slate-800/80 border-b-4 border-blue-500/30">
                            <th class="px-8 py-6 text-left text-xl font-black text-white uppercase tracking-wider rounded-tl-2xl">
                                <i class="fas fa-image mr-3 text-blue-300"></i>Poster
                            </th>
                            <th class="px-8 py-6 text-left text-xl font-black text-white uppercase tracking-wider">
                                <i class="fas fa-heading mr-3 text-indigo-300"></i>Movie Details
                            </th>
                            <th class="px-6 py-6 text-center text-xl font-black text-white uppercase tracking-wider">
                                <i class="fas fa-stopwatch mr-2 text-emerald-300"></i>Duration
                            </th>
                            <th class="px-6 py-6 text-center text-xl font-black text-white uppercase tracking-wider">
                                <i class="fas fa-tag mr-2 text-orange-300"></i>Genre
                            </th>
                            <th class="px-6 py-6 text-center text-xl font-black text-white uppercase tracking-wider">
                                <i class="fas fa-calendar mr-2 text-purple-300"></i>Release
                            </th>
                            <th class="px-8 py-6 text-center text-xl font-black text-white uppercase tracking-wider rounded-tr-2xl">
                                <i class="fas fa-cogs mr-3 text-amber-300"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50">
                        @foreach($movies as $movie)
                            <tr class="group hover:bg-slate-800/60 hover:scale-[1.01] transition-all duration-300 hover:shadow-xl">
                                <td class="px-4 py-6">
                                    @if($movie->poster)
                                        <img src="{{ asset($movie->poster) }}" alt="{{ $movie->title }}" class="w-28 h-40 object-cover rounded-2xl ring-4 ring-slate-800/50 hover:ring-blue-500/50 hover:scale-105 transition-all duration-300 shadow-2xl"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="w-28 h-40 bg-gradient-to-br from-gray-700 to-gray-800 rounded-2xl ring-4 ring-slate-800/50 flex items-center justify-center text-2xl hidden">
                                            <i class="fas fa-film text-gray-400"></i>
                                        </div>
                                    @else
                                        <div class="w-28 h-40 bg-gradient-to-br from-gray-700 via-slate-600 to-gray-800 rounded-2xl ring-4 ring-slate-800/50 flex items-center justify-center text-2xl shadow-xl">
                                            <i class="fas fa-film text-gray-400"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-6 max-w-md">
                                    <div class="font-black text-xl md:text-2xl text-white mb-2 line-clamp-1 group-hover:text-blue-300 transition-colors pr-4">{{ $movie->title }}</div>
                                    @if(\Carbon\Carbon::parse($movie->release_date)->isFuture())
                                        <span class="inline-block mt-2 bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-bold">Coming Soon</span>
                                    @else
                                        <span class="inline-block mt-2 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">Now Showing</span>
                                    @endif
                                    <div class="text-gray-400 leading-relaxed line-clamp-3 md:line-clamp-2 text-base pr-4">{{ Str::limit($movie->description, 120) }}</div>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span class="inline-flex px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold rounded-2xl text-lg shadow-lg ring-2 ring-emerald-400/50 hover:shadow-emerald-500/25 transition-all hover:scale-105">{{ $movie->duration }} min</span>
                                </td>
                                <td class="px-4 py-6 text-center">
                                    <div class="flex flex-wrap gap-2 justify-center max-w-xs mx-auto">
                                        @foreach(explode(',', $movie->genre) as $genre)
                                            <span class="inline-flex px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-bold rounded-full text-sm shadow-md hover:shadow-orange-400/50 transition-all duration-300 hover:-translate-y-1">{{ trim($genre) }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span class="inline-flex px-6 py-3 bg-gradient-to-r from-purple-600 to-violet-600 text-white font-bold rounded-2xl text-lg shadow-lg ring-2 ring-purple-400/50 hover:shadow-purple-500/25 transition-all hover:scale-105">{{ \App\Helpers\DateHelper::formatAdminDate($movie->release_date) }}</span>
                                </td>
                                <td class="px-6 py-6 align-middle">
                                    <div class="flex items-center justify-center gap-2.5">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.movies.edit', $movie) }}"
                                           class="group relative inline-flex items-center justify-center w-10 h-10 bg-gradient-to-br from-amber-400 to-orange-500 hover:from-amber-500 hover:to-orange-600 text-white rounded-xl shadow-lg shadow-amber-500/20 hover:shadow-amber-500/50 hover:scale-110 hover:-translate-y-0.5 transition-all duration-300 cursor-pointer"
                                           title="Edit Movie">
                                            <i class="fas fa-pen text-sm transition-transform duration-300 group-hover:rotate-12"></i>
                                            <span class="absolute -top-9 left-1/2 -translate-x-1/2 px-2.5 py-1 bg-slate-800 text-white text-[11px] font-bold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap pointer-events-none shadow-lg border border-slate-700">Edit Movie</span>
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete "{{ $movie->title }}"? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="group relative inline-flex items-center justify-center w-10 h-10 bg-gradient-to-br from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white rounded-xl shadow-lg shadow-red-500/20 hover:shadow-red-500/50 hover:scale-110 hover:-translate-y-0.5 transition-all duration-300 cursor-pointer"
                                                    title="Delete Movie">
                                                <i class="fas fa-trash text-sm transition-transform duration-300 group-hover:rotate-12"></i>
                                                <span class="absolute -top-9 left-1/2 -translate-x-1/2 px-2.5 py-1 bg-slate-800 text-white text-[11px] font-bold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap pointer-events-none shadow-lg border border-slate-700">Delete Movie</span>
                                            </button>
                                        </form>

                                        <!-- View -->
                                        <a href="{{ route('movies.show', $movie) }}"
                                           class="group relative inline-flex items-center justify-center w-10 h-10 bg-gradient-to-br from-emerald-400 to-teal-500 hover:from-emerald-500 hover:to-teal-600 text-white rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/50 hover:scale-110 hover:-translate-y-0.5 transition-all duration-300 cursor-pointer"
                                           title="View Public Page"
                                           target="_blank">
                                            <i class="fas fa-eye text-sm transition-transform duration-300 group-hover:rotate-12"></i>
                                            <span class="absolute -top-9 left-1/2 -translate-x-1/2 px-2.5 py-1 bg-slate-800 text-white text-[11px] font-bold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap pointer-events-none shadow-lg border border-slate-700">View Public Page</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="bg-slate-900/70 border-t border-slate-700/50 p-8 rounded-b-3xl backdrop-blur-xl">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="text-gray-400 text-lg font-medium">
                        Showing <span class="font-bold text-white">{{ $movies->firstItem() }}</span> to <span class="font-bold text-white">{{ $movies->lastItem() }}</span> of <span class="font-bold text-white">{{ $movies->total() }}</span> movies
                    </div>
                    <div class="flex justify-center md:justify-end">
                        {{ $movies->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-24 px-8">
                <div class="w-48 h-48 bg-gradient-to-br from-gray-800 to-slate-900 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl ring-4 ring-slate-800/50">
                    <i class="fas fa-film text-6xl text-gray-600"></i>
                </div>
                <h3 class="text-4xl md:text-5xl font-black text-gray-400 mb-6 tracking-tight">No Movies Found</h3>
                <p class="text-xl md:text-2xl text-gray-500 mb-12 max-w-2xl mx-auto leading-relaxed">Your movie collection is empty. Add movies to get started!</p>
                <a href="{{ route('admin.movies.create') }}" class="group bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl flex items-center justify-center mx-auto transition-all duration-300">
                    <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform text-sm"></i>
                    Add First Movie
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

