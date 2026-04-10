@extends('layouts.app')

@section('content')
<!-- Confirm Hero -->
<section class="bg-gradient-to-br from-slate-900 to-red-900/20 py-24 lg:py-32 relative overflow-hidden">
    <div class="absolute inset-0 opacity-30">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-red-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black bg-gradient-to-r from-white to-slate-200 bg-clip-text text-transparent mb-6 drop-shadow-2xl">
            Confirm Booking
        </h1>
        <p class="text-xl md:text-2xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
            Review your selection and get ready for the ultimate cinema experience
        </p>
    </div>
</section>

<!-- Booking Details -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 -mt-16 lg:-mt-20">
    <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800/50 rounded-4xl p-10 lg:p-16 shadow-2xl">
        <div class="text-center mb-16">
            <div class="inline-flex w-24 h-24 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-3xl items-center justify-center mb-6 shadow-2xl">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h2 class="text-3xl lg:text-4xl font-black text-white mb-3">Almost There!</h2>
            <p class="text-xl text-slate-300">Please review your booking details</p>
        </div>

        <div class="grid gap-8 mb-12">
            <div class="grid md:grid-cols-2 gap-6 p-8 bg-slate-800/50 rounded-3xl border border-slate-700/50">
                <div>
                    <span class="inline-block text-sm text-slate-400 font-medium uppercase tracking-wide mb-2">Movie</span>
                    <h3 class="text-2xl font-bold text-white">{{ $show->movie->title }}</h3>
                </div>
                <div class="text-right md:text-left">
                    <span class="inline-block text-sm text-slate-400 font-medium uppercase tracking-wide mb-2">Theatre</span>
                    <p class="text-xl font-bold text-white">{{ $show->theatre->name }}</p>
                    <p class="text-slate-400">{{ $show->theatre->location }}</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="p-6 bg-slate-800/30 rounded-2xl border border-slate-700/30 text-center group hover:bg-slate-800/50 hover:border-slate-600/50 transition-all">
                    <svg class="w-12 h-12 text-emerald-400 mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-slate-400 font-medium mb-1">Date</p>
                    <p class="text-xl font-bold text-white">{{ \App\Helpers\DateHelper::formatDate($show->show_date, 'l, F d') }}</p>
                </div>
                <div class="p-6 bg-slate-800/30 rounded-2xl border border-slate-700/30 text-center group hover:bg-slate-800/50 hover:border-slate-600/50 transition-all">
                    <svg class="w-12 h-12 text-red-400 mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-slate-400 font-medium mb-1">Time</p>
                    <p class="text-xl font-bold text-white">{{ \App\Helpers\DateHelper::formatTime($show->show_time) }}</p>
                </div>
                <div class="p-6 md:col-span-2 lg:col-span-1 bg-gradient-to-r from-emerald-500/20 to-emerald-600/20 border border-emerald-500/40 rounded-2xl text-center group hover:from-emerald-500/30 hover:border-emerald-500/60 transition-all">
                    <svg class="w-12 h-12 text-emerald-400 mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2a3 3 0 01-3 3H9a3 3 0 01-3-3V5a3 3 0 013-3h3a3 3 0 013 3z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p class="text-sm text-emerald-300 font-medium mb-1">Seat</p>
                    <p class="text-2xl lg:text-3xl font-black bg-gradient-to-r from-emerald-400 to-emerald-600 text-transparent bg-clip-text drop-shadow-lg">{{ $seatNumber }}</p>
                </div>
            </div>
        </div>

        <!-- Pricing Breakdown -->
        <div class="p-8 bg-slate-800/50 rounded-3xl border border-slate-700/50 mb-12">
            <h4 class="text-2xl font-bold text-white mb-8 flex items-center gap-3">
                <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
                Pricing
            </h4>
            <div class="space-y-4 mb-8">
                <div class="flex justify-between items-center py-4 px-6 bg-slate-700/50 rounded-2xl">
                    <span class="text-lg text-slate-300">Price per ticket</span>
                    <span class="text-2xl font-bold text-white">₹{{ number_format($show->price, 2) }}</span>
                </div>
                <div class="flex justify-between items-center py-4 px-6 bg-slate-700/50 rounded-2xl">
                    <span class="text-lg text-slate-300">Number of seats</span>
                    <span class="text-2xl font-bold text-white">1</span>
                </div>
            </div>
            <div class="flex items-center justify-between p-6 bg-gradient-to-r from-slate-900 to-slate-800/50 rounded-3xl border-2 border-slate-700/50">
                <span class="text-3xl font-black text-slate-300">Total Amount</span>
                <span class="text-4xl font-black bg-gradient-to-r from-red-500 to-red-600 text-transparent bg-clip-text drop-shadow-2xl">₹{{ number_format($totalPrice, 2) }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('booking.select-seats', $show->id) }}" class="flex-1 inline-flex items-center justify-center px-6 py-2 text-sm font-semibold bg-slate-700 hover:bg-slate-600 border border-slate-600 rounded-lg text-slate-300 hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl">
                <svg class="w-4 h-4 mr-2 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
                Change Seats
            </a>
            <form action="{{ route('booking.store', $show->id) }}" method="POST" class="flex-1">
                @csrf
                <input type="hidden" name="seat_number" value="{{ $seatNumber }}">
                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-2 text-sm font-semibold bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 uppercase">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Confirm & Pay
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
