@extends('layouts.app')

@section('content')
<!-- Bookings Hero -->
<section class="bg-gradient-to-br from-slate-900 via-red-900/10 to-slate-900 py-24 relative">
    <div class="absolute inset-0 opacity-20">
        <div class="bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzIiIGN5PSIzMiIgcj0iMSIgc3R5bGU9InN0b3AtY29sb3I6I2ZmZmZmZjA7c3RvcC1vcGFjaXR5OjAuMDk7c3R5bGU9c3RvcC1jb2xvcjojZTY1ZjllMDA7c3R5bGU9c3RvcC1vcGFjaXR5OjAuMjQiLz4KPC9zdmc+')]"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-black bg-gradient-to-r from-white via-slate-100 to-red-400 bg-clip-text text-transparent mb-6">
            My Tickets
        </h1>
        <p class="text-2xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
            Your cinema adventures and tickets at a glance
        </p>
    </div>
</section>

<!-- Tickets Grid -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    @if($bookings->count() > 0)
        <div class="grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
            @foreach($bookings as $booking)
                <div class="group relative">
                    <!-- Digital Ticket Card -->
                    <div class="bg-gradient-to-br from-slate-900/95 via-slate-800/60 to-slate-900/50 backdrop-blur-xl border border-slate-700/50 rounded-4xl p-8 lg:p-12 shadow-2xl hover:shadow-4xl hover:border-red-500/60 hover:bg-slate-900/80 transition-all duration-700 overflow-hidden h-full">
                        <!-- QR/Shine Effect -->
                        <div class="absolute top-6 right-6 w-20 h-20 bg-gradient-to-r from-red-500/30 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-700 rotate-12 blur-sm"></div>

                        <!-- Top Bar (Ticket Header) -->
                        <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-700/50">
                            <div class="flex items-center gap-4">
                                <div class="w-3 h-12 bg-gradient-to-b from-emerald-400 to-emerald-500 rounded-r-full shadow-lg"></div>
                                <div>
                                    <h4 class="text-sm font-bold uppercase tracking-wide text-emerald-400">Confirmed Ticket</h4>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-black text-white mb-1 tracking-tight">₹{{ number_format($booking->total_price, 2) }}</div>
                                <div class="text-xs font-mono bg-slate-800/50 px-3 py-1 rounded text-slate-400 font-bold">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>

                        <!-- Movie Poster -->
                        <div class="mb-8">
                            @if($booking->show->movie->poster)
                                <img src="{{ $booking->show->movie->poster }}" alt="{{ $booking->show->movie->title }}" class="w-full h-64 object-cover rounded-3xl shadow-2xl ring-4 ring-slate-900/50 group-hover:ring-red-500/50 transition-all duration-500 group-hover:scale-[1.02]">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl flex items-center justify-center text-6xl font-black text-slate-400 shadow-inner border-4 border-slate-700/50 relative overflow-hidden">
                                    <span class="relative z-10">{{ substr($booking->show->movie->title, 0, 2) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Movie & Show Details -->
                        <div class="space-y-4 mb-10">
                            <h3 class="text-3xl font-black text-white line-clamp-2">{{ $booking->show->movie->title }}</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="p-6 bg-slate-800/50 rounded-3xl backdrop-blur group-hover:bg-slate-800/70 transition-all">
                                    <div class="flex items-center gap-3 mb-2">
                                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5-4h1m-1 4h1m8-4h1m-1 4h1"/>
                                        </svg>
                                        <span class="font-semibold text-slate-300">Theatre</span>
                                    </div>
                                    <p class="text-2xl font-bold text-white">{{ $booking->show->theatre->name }}</p>
                                </div>

                                <div class="p-6 bg-slate-800/50 rounded-3xl backdrop-blur group-hover:bg-slate-800/70 transition-all">
                                    <div class="flex items-center gap-3 mb-2">
                                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="font-semibold text-slate-300">Showtime</span>
                                    </div>
                                    <p class="text-xl font-bold text-white flex items-center gap-2">
                                        {{ \App\Helpers\DateHelper::formatShowDate($booking->show->show_date) }} • {{ \App\Helpers\DateHelper::formatTime($booking->show->show_time) }}
                                    </p>
                                </div>
                            </div>

                            <div class="p-6 bg-gradient-to-r from-red-500/10 to-red-600/10 border border-red-500/30 rounded-3xl backdrop-blur">
                                <div class="flex items-center gap-4">
                                    <svg class="w-8 h-8 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2a3 3 0 01-3 3H9a3 3 0 01-3-3V5a3 3 0 013-3h3a3 3 0 013 3z"/>
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-lg font-semibold text-slate-300 mb-1">Seat</p>
                                        <p class="text-3xl font-black text-white">{{ $booking->seat_number }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status & Actions -->
                        <div class="flex flex-col gap-4 pt-8 border-t border-slate-800/50">
                            <div class="flex items-center justify-between">
                                <span class="px-6 py-3 rounded-full font-bold text-lg {{ $booking->payment_status == 'paid' ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/40' : ($booking->payment_status == 'pending' ? 'bg-amber-500/20 text-amber-400 border-amber-500/40 animate-pulse' : 'bg-red-500/20 text-red-400 border-red-500/40') }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                                <span class="text-sm text-slate-500">{{ $booking->created_at->diffForHumans() }}</span>
                            </div>

                            @if($booking->payment_status == 'pending')
                                <div class="pt-6">
                                    <button onclick="payNow({{ $booking->id }})" class="w-full py-4 px-8 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide">
                                        Complete Payment
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-20">
            {{ $bookings->appends(request()->query())->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-32">
            <div class="w-36 h-36 mx-auto mb-12 p-10 bg-slate-800/50 rounded-4xl border-4 border-dashed border-slate-700/50 flex items-center justify-center group hover:bg-slate-800 hover:border-slate-600 transition-all">
                <svg class="w-20 h-20 text-slate-500 group-hover:text-slate-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-6 7h12m-12 4h12"/>
                </svg>
            </div>
            <h2 class="text-5xl font-black text-slate-300 mb-6">No Tickets Yet</h2>
            <p class="text-xl text-slate-500 mb-12 max-w-lg mx-auto leading-relaxed">
                Ready to experience cinema magic? Your first ticket is just a few clicks away.
            </p>
            <a href="{{ route('movies.index') }}" class="inline-flex items-center px-12 py-6 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold text-xl rounded-4xl shadow-2xl hover:shadow-4xl hover:-translate-y-2 transition-all duration-300">
                Book Your First Ticket
            </a>
        </div>
    @endif
</section>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function payNow(bookingId) {
    // Payment logic (same as before)
    console.log('Pay now:', bookingId);
    alert('Payment flow - integrate Razorpay');
}
</script>
@endsection

