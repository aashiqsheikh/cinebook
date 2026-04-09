@extends('layouts.app')



@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-900/20 to-slate-900 py-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-20">
            <div class="inline-flex w-28 h-28 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-3xl shadow-2xl ring-4 ring-cyan-400/40 mx-auto mb-8 p-6">
                <i class="fas fa-plus text-3xl text-white"></i>
            </div>
            <h1 class="text-5xl md:text-6xl font-black bg-gradient-to-r from-gray-100 via-white/80 to-gray-100 bg-clip-text text-transparent mb-6 drop-shadow-2xl">
                Add New Theatre
            </h1>
            <p class="text-2xl text-gray-400 max-w-lg mx-auto leading-relaxed">Add a new theatre to the system</p>
        </div>

        <!-- Form Card -->
        <div class="bg-gray-800/70 backdrop-blur-xl border border-gray-700/70 rounded-4xl shadow-2xl p-12 ring-2 ring-slate-800/60 hover:shadow-3xl hover:ring-blue-500/40 transition-all duration-500">
            <div class="max-w-2xl mx-auto">
                    <form action="{{ route('admin.theatres.store') }}" method="POST">
                        @csrf
                        <!-- Theatre Name Field -->
                        <div class="space-y-4">
                            <label for="name" class="block text-2xl font-black text-gray-200 tracking-wide">Theatre Name</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-10 py-8 text-2xl bg-gradient-to-r from-gray-700/60 to-slate-700/60 border-4 border-gray-600/50 rounded-4xl focus:ring-8 focus:ring-cyan-500/60 focus:border-cyan-500 backdrop-blur-xl shadow-2xl hover:shadow-3xl hover:border-cyan-400/50 transition-all duration-500 text-gray-100 font-bold placeholder-gray-500">
                        </div>

                        <!-- Location Field -->
                        <div class="space-y-4">
                            <label for="location" class="block text-2xl font-black text-gray-200 tracking-wide">Location</label>
                            <input type="text" id="location" name="location" required
                                   class="w-full px-10 py-8 text-2xl bg-gradient-to-r from-gray-700/60 to-slate-700/60 border-4 border-gray-600/50 rounded-4xl focus:ring-8 focus:ring-blue-500/60 focus:border-blue-500 backdrop-blur-xl shadow-2xl hover:shadow-3xl hover:border-blue-400/50 transition-all duration-500 text-gray-100 font-bold placeholder-gray-500">
                        </div>

                        <!-- Total Seats Field -->
                        <div class="space-y-4">
                            <label for="total_seats" class="block text-2xl font-black text-gray-200 tracking-wide">Total Seats</label>
                            <input type="number" id="total_seats" name="total_seats" required min="1"
                                   class="w-full px-10 py-8 text-2xl bg-gradient-to-r from-gray-700/60 to-slate-700/60 border-4 border-gray-600/50 rounded-4xl focus:ring-8 focus:ring-emerald-500/60 focus:border-emerald-500 backdrop-blur-xl shadow-2xl hover:shadow-3xl hover:border-emerald-400/50 transition-all duration-500 text-gray-100 font-bold placeholder-gray-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col lg:flex-row gap-8 pt-16 border-t-4 border-gray-700/50 mt-16">
                            <a href="{{ route('admin.theatres.index') }}" class="flex-1 group bg-gradient-to-r from-slate-800/80 to-gray-800/80 hover:from-slate-700 hover:to-gray-700 text-gray-300 hover:text-white px-16 py-10 rounded-4xl font-black text-2xl shadow-2xl hover:shadow-3xl hover:-translate-y-4 transition-all duration-700 justify-center items-center border border-gray-600/50 hover:border-gray-400/50 backdrop-blur-xl">
                                <i class="fas fa-arrow-left mr-6 text-3xl group-hover:-translate-x-4 transition-transform duration-700"></i>
                                Cancel
                            </a>
                            <button type="submit" class="flex-1 group bg-gradient-to-r from-emerald-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 text-white px-16 py-10 rounded-4xl font-black text-2xl shadow-2xl hover:shadow-4xl hover:-translate-y-4 transition-all duration-700 justify-center items-center border border-emerald-500/50 hover:border-emerald-400/50 backdrop-blur-xl">
                                <i class="fas fa-save mr-6 text-3xl group-hover:scale-125 transition-transform duration-700"></i>
                                Save Theatre
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

