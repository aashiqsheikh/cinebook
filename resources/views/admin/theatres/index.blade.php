@extends('layouts.app')



@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-indigo-900 via-slate-900 to-purple-900/30 py-24 mb-16 rounded-3xl shadow-2xl relative overflow-hidden border border-indigo-800/50 backdrop-blur-xl">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_50%_80%_at_50%_0%,rgba(147,51,234,0.3),transparent)]"></div>
        <div class="relative z-10 max-w-5xl mx-auto text-center">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 px-8">
                <div>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black bg-gradient-to-r from-gray-100 to-white/60 bg-clip-text text-transparent mb-6 drop-shadow-2xl">
                        <i class="fas fa-building mr-6 text-cyan-400 text-4xl inline-block animate-pulse"></i>
                        Manage Theatres
                    </h1>
                    <p class="text-2xl md:text-3xl text-gray-300 font-semibold opacity-90 max-w-2xl mx-auto lg:mx-0 leading-relaxed">Add, edit, and remove theatres from the system</p>
                </div>
                <a href="{{ route('admin.theatres.create') }}" class="group bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center whitespace-nowrap">
                    <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                    Add Theatre
                </a>
            </div>
        </div>
    </div>

<div class="container mb-5">
    @if(session('success'))
        <div class="mb-10 p-8 bg-gradient-to-r from-emerald-900/70 to-green-900/70 border-4 border-emerald-400/60 rounded-3xl backdrop-blur-2xl shadow-2xl ring ring-emerald-400/40">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="p-4 bg-emerald-500/30 rounded-2xl ring-2 ring-emerald-400/50">
                        <i class="fas fa-check-circle text-emerald-400 text-3xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-white tracking-wide">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="p-2 hover:bg-white/20 rounded-lg transition-all duration-300 hover:scale-110">
                    <i class="fas fa-times text-sm text-gray-300 hover:text-white"></i>
                </button>
            </div>
        </div>
    @endif

    <div class="bg-gradient-to-b from-gray-900/80 to-slate-900/60 backdrop-blur-xl border border-gray-700/60 rounded-4xl shadow-2xl overflow-hidden ring-2 ring-slate-800/50 p-1">
        <div class="bg-gradient-to-b from-slate-950 to-gray-900/50 p-8 rounded-3xl">
            @if($theatres->count() > 0)
                <div class="overflow-x-auto rounded-2xl">
                    <table class="w-full table-fixed">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-900 via-slate-900 to-gray-900/50 backdrop-blur-sm border-b-2 border-gray-700">
                                <th class="px-8 py-6 text-left text-lg font-black text-white uppercase tracking-widest rounded-tl-2xl">ID</th>
                                <th class="px-8 py-6 text-left text-lg font-black text-white uppercase tracking-widest">Name</th>
                                <th class="px-8 py-6 text-left text-lg font-black text-white uppercase tracking-widest">Location</th>
                                <th class="px-8 py-6 text-center text-lg font-black text-white uppercase tracking-widest">Total Seats</th>
                                <th class="px-8 py-6 text-center text-lg font-black text-white uppercase tracking-widest rounded-tr-2xl">Actions</th>
                            </tr>
                        <tbody>
                            @foreach($theatres as $theatre)
                                <tr class="group hover:bg-slate-800/70 hover:shadow-inner transition-all duration-300 border-b border-slate-800/50 last:border-b-0">
                                    <td class="px-8 py-8 font-mono font-bold text-blue-400 text-lg group-hover:text-blue-300 transition-colors">{{ $theatre->id }}</td>
                                    <td class="px-8 py-8">
                                        <div class="font-black text-2xl text-white group-hover:text-cyan-300 transition-all pr-4 truncate max-w-xs">{{ $theatre->name }}</div>
                                    </td>
                                    <td class="px-8 py-8">
                                        <div class="text-xl text-gray-300 max-w-md truncate">{{ $theatre->location }}</div>
                                    </td>
                                    <td class="px-8 py-8 text-center">
                                        <span class="inline-flex px-8 py-4 bg-gradient-to-r from-emerald-600/80 to-teal-600/80 text-white font-black text-xl rounded-2xl shadow-xl ring-2 ring-emerald-500/50 backdrop-blur-sm hover:shadow-emerald-400/50 hover:scale-105 transition-all">{{ $theatre->total_seats }}</span>
                                    </td>
                                    <td class="px-8 py-8 text-center">
                                        <div class="flex gap-4 justify-center">
                                            <a href="{{ route('admin.theatres.edit', $theatre->id) }}" class="group p-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300" title="Edit Theatre">
                                                <i class="fas fa-edit text-sm group-hover:scale-110 transition-transform"></i>
                                            </a>
                                            <form action="{{ route('admin.theatres.destroy', $theatre->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete {{ $theatre->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="group p-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300" title="Delete Theatre">
                                                    <i class="fas fa-trash text-sm group-hover:scale-110 transition-transform"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-32 px-12">
                    <div class="w-36 h-36 bg-gradient-to-br from-gray-800 to-slate-900 rounded-3xl flex items-center justify-center mx-auto mb-12 shadow-2xl ring-8 ring-slate-800/50 backdrop-blur-xl">
                        <i class="fas fa-building text-5xl text-gray-600"></i>
                    </div>
                    <h3 class="text-5xl md:text-6xl font-black text-gray-500 mb-8 tracking-tight animate-pulse">No Theatres Yet</h3>
                    <p class="text-2xl text-gray-600 mb-12 max-w-lg mx-auto leading-relaxed opacity-80">Get started by adding your first theatre to the system</p>
                    <a href="{{ route('admin.theatres.create') }}" class="group bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl transition-all duration-300 inline-flex items-center">
                        <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                        Add First Theatre
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

