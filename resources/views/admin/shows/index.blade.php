@extends('layouts.app')



@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-amber-900/80 via-orange-900/50 to-amber-900 py-24 mb-16 rounded-3xl shadow-2xl relative overflow-hidden border border-amber-800/60 backdrop-blur-xl">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(251,191,36,0.4),transparent),radial-gradient(circle_at_80%_80%,rgba(245,158,11,0.3),transparent)]"></div>
        <div class="relative z-10 max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 px-8">
                <div>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black bg-gradient-to-r from-amber-100 via-orange-100 to-yellow-100/50 bg-clip-text text-transparent mb-6 drop-shadow-2xl">
                        <i class="fas fa-clock mr-6 text-orange-400 text-5xl inline animate-ping"></i>
                        Manage Shows
                    </h1>
                    <p class="text-2xl md:text-3xl text-gray-300 font-semibold opacity-90 max-w-xl leading-relaxed">Add, edit, and remove show timings with precision</p>
                </div>
                <a href="{{ route('admin.shows.create') }}" class="group bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 text-white px-14 py-8 rounded-3xl font-bold text-2xl shadow-2xl hover:shadow-3xl hover:-translate-y-3 transition-all duration-500 flex items-center whitespace-nowrap border border-orange-500/50">
                    <i class="fas fa-plus mr-4 text-3xl group-hover:scale-110 transition-transform"></i>
                    Add Show
                </a>
            </div>
        </div>
    </div>
<div class="container mb-5">
    @if(session('success'))
        <div class="mb-12 p-8 bg-gradient-to-r from-emerald-900/80 to-teal-900/80 border-l-8 border-emerald-400 rounded-3xl backdrop-blur-2xl shadow-2xl ring-2 ring-emerald-400/50 mx-auto max-w-4xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="p-4 bg-emerald-500/40 rounded-3xl ring-4 ring-emerald-400/60 shadow-2xl">
                        <i class="fas fa-check-circle text-emerald-400 text-4xl"></i>
                    </div>
                    <span class="text-3xl font-bold text-white tracking-wide leading-tight">{{ session('success') }}</span>
                </div>
                <button onclick="this.closest('div').remove()" class="p-4 hover:bg-white/30 rounded-3xl transition-all duration-300 hover:scale-125 hover:rotate-90 shrink-0">
                    <i class="fas fa-times text-2xl text-gray-300 hover:text-white"></i>
                </button>
            </div>
        </div>
    @endif
    <div class="bg-slate-900/70 backdrop-blur-xl border border-slate-700/70 rounded-4xl shadow-2xl overflow-hidden ring-2 ring-orange-800/50 p-2">
        <div class="p-10 rounded-3xl bg-gradient-to-b from-gray-950/50 to-slate-950">
            @if($shows->count() > 0)
                <div class="overflow-x-auto -mx-4 sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-4 align-middle">
                        <table class="min-w-full divide-y divide-orange-900/50">
                            <thead class="sticky top-0 z-10"></thead>
                                <tr class="bg-gradient-to-r from-orange-900/80 to-amber-900/60 backdrop-blur-sm border-b-4 border-orange-400/40">
                                    <th class="px-12 py-6 text-left text-xl font-black text-white uppercase tracking-widest rounded-l-3xl">Movie</th>
                                    <th class="px-12 py-6 text-left text-xl font-black text-white uppercase tracking-widest">Theatre</th>
                                    <th class="px-8 py-6 text-center text-xl font-black text-white uppercase tracking-widest">Date</th>
                                    <th class="px-8 py-6 text-center text-xl font-black text-white uppercase tracking-widest">Time</th>
                                    <th class="px-12 py-6 text-right text-xl font-black text-white uppercase tracking-widest">Price</th>
                                    <th class="px-12 py-6 text-center text-xl font-black text-white uppercase tracking-widest rounded-r-3xl">Actions</th>
                                </tr>
                        <tbody>
                            @foreach($shows as $show)
                                <tr class="group hover:bg-orange-950/60 hover:shadow-inner transition-all duration-500 border-b border-orange-900/60 last:border-none">
                                    <td class="px-12 py-8">
                                        <div class="font-black text-2xl text-white group-hover:text-amber-300 transition-all pr-6 truncate max-w-lg">{{ $show->movie->title }}</div>
                                    </td>
                                    <td class="px-12 py-8">
                                        <div class="text-xl font-semibold text-gray-300 group-hover:text-cyan-300 transition-colors">{{ $show->theatre->name }}</div>
                                    </td>
                                    <td class="px-8 py-8 text-center">
                                        <span class="inline-flex px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl text-lg shadow-xl hover:shadow-blue-500/50 hover:scale-105 transition-all">{{ \App\Helpers\DateHelper::formatAdminDate($show->show_date) }}</span>
                                    </td>
                                    <td class="px-8 py-8 text-center">
                                        <span class="inline-flex px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold rounded-2xl text-lg shadow-xl hover:shadow-emerald-500/50 hover:scale-105 transition-all">{{ \App\Helpers\DateHelper::formatTime24Hour($show->show_time) }}</span>
                                    </td>
                                    <td class="px-12 py-8 text-right">
                                        <span class="inline-flex px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-black text-xl rounded-3xl shadow-2xl ring-2 ring-amber-400/50 hover:shadow-orange-400/50 hover:scale-110 transition-all">₹{{ number_format($show->price, 2) }}</span>
                                    </td>
                                    <td class="px-12 py-8 text-center">
                                        <div class="flex gap-4 justify-center">
                                            <a href="{{ route('admin.shows.edit', $show->id) }}" class="group p-5 bg-gradient-to-r from-yellow-500 to-amber-500 hover:from-yellow-600 hover:to-amber-600 text-white rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-4 transition-all duration-500" title="Edit Show">
                                                <i class="fas fa-edit text-2xl group-hover:scale-125 transition-transform duration-300"></i>
                                            </a>
                                            <form action="{{ route('admin.shows.destroy', $show->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this show?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="group p-5 bg-gradient-to-r from-red-500 to-orange-600 hover:from-red-600 hover:to-orange-700 text-white rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-4 transition-all duration-500" title="Delete Show">
                                                    <i class="fas fa-trash text-2xl group-hover:scale-125 transition-transform duration-300"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-12 text-center">
                    <div class="inline-flex bg-gradient-to-r from-slate-900/60 to-gray-900/60 backdrop-blur-xl rounded-3xl p-8 border border-slate-700/50 shadow-2xl">
                        {{ $shows->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-32 px-16">
                    <div class="w-40 h-40 bg-gradient-to-br from-orange-900/60 to-amber-900/60 rounded-4xl flex items-center justify-center mx-auto mb-16 shadow-2xl ring-8 ring-orange-800/50 backdrop-blur-xl p-8">
                        <i class="fas fa-clock text-6xl text-gray-600 animate-pulse"></i>
                    </div>
                    <h3 class="text-6xl md:text-7xl font-black text-gray-600 mb-8 tracking-tight bg-gradient-to-r from-transparent via-gray-500 to-transparent bg-clip-text drop-shadow-2xl">No Shows Yet</h3>
                    <p class="text-2xl md:text-3xl text-gray-500 mb-16 max-w-2xl mx-auto leading-relaxed opacity-90">Create your first show schedule to start selling tickets</p>
                    <a href="{{ route('admin.shows.create') }}" class="group bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 text-white px-20 py-10 rounded-4xl font-black text-3xl shadow-2xl hover:shadow-4xl hover:-translate-y-6 transition-all duration-700 inline-flex items-center mx-auto">
                        <i class="fas fa-plus mr-8 text-4xl group-hover:scale-125 transition-transform duration-700"></i>
                        Add First Show
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

