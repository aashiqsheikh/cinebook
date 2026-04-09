@extends('layouts.app')

@section('content')
<!-- Bookings Hero -->
<section class="bg-gradient-to-br from-slate-900 via-red-900/10 to-slate-900 py-24 relative">
    <div class="absolute inset-0 opacity-20">
        <div class="bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzIiIGN5PSIzMiIgcj0iMSIgc3R5bGU9InN0b3AtY29sb3I6I2ZmZmZmZjA7c3RvcC1vcGFjaXR5OjAuMDk7c3R5bGU9c3RvcC1jb2xvcjojZTY1ZjllMDA7c3R5bGU9c3RvcC1vcGFjaXR5OjAuMjQiLz4KPC9zdmc+')]"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-black bg-gradient-to-r from-white via-slate-100 to-red-400 bg-clip-text text-transparent mb-6">
            My Bookings
        </h1>
        <p class="text-2xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
            Track your tickets, make payments, and relive your cinema memories
        </p>
    </div>
</section>

<!-- Bookings List -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    @if($bookings->count() > 0)
        <div class="grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
            @foreach($bookings as $booking)
                <!-- Booking Card -->
                <div class="group relative bg-slate-900/60 backdrop-blur-xl border border-slate-800/50 rounded-4xl p-8 lg:p-10 hover:shadow-2xl hover:border-red-500/50 hover:bg-slate-900/80 transition-all duration-500 overflow-hidden">
                    <!-- Card Shine Effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity skew-x-12 -translate-x-40 group-hover:translate-x-full duration-1000"></div>

                    <div class="relative z-10">
                        <!-- Movie Poster -->
                        <div class="mb-8">
                            @if($booking->show->movie->poster)
                                <img
                                    src="{{ $booking->show->movie->poster }}"
                                    alt="{{ $booking->show->movie->title }}"
                                    class="w-full h-64 object-cover rounded-3xl shadow-2xl group-hover:scale-105 group-hover:rotate-1 transition-all duration-700 ring-2 ring-slate-900/50 group-hover:ring-red-500/50"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl flex items-center justify-center group-hover:bg-slate-700 transition-all duration-300 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-slate-800/50 to-transparent animate-shimmer"></div>
                                    <svg class="w-24 h-24 text-slate-500 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 4v10c0 2.21 1.79 4 4 4s4-1.79 4-4V4M15 16h1M9 16h1M4 20h16a1 1 0 001-1v-2a1 1 0 00-1-1H4a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Movie Info -->
                        <h3 class="text-2xl lg:text-3xl font-black text-white mb-4 pr-4 line-clamp-2 group-hover:text-red-400 transition-colors">
                            {{ $booking->show->movie->title }}
                        </h3>

                        <!-- Details Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 text-slate-300">
                            <div class="flex items-center gap-3 p-4 bg-slate-800/50 rounded-2xl group-hover:bg-slate-800/30 transition-all">
                                <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5-4h1m-1 4h1m8-4h1m-1 4h1"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-white">{{ $booking->show->theatre->name }}</p>
                                    <p class="text-sm opacity-75">{{ $booking->show->theatre->location }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-4 bg-slate-800/50 rounded-2xl group-hover:bg-slate-800/30 transition-all">
                                <svg class="w-6 h-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div class="min-w-0">
                                    <p class="font-semibold text-white truncate">{{ \App\Helpers\DateHelper::formatShowDate($booking->show->show_date) }}</p>
                                    <p class="text-sm opacity-75">{{ \App\Helpers\DateHelper::formatTime($booking->show->show_time) }}</p>
                                </div>
                            </div>

                            <div class="md:col-span-2 flex items-center gap-3 p-4 bg-slate-800/50 rounded-2xl group-hover:bg-slate-800/30 transition-all">
                                <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2a3 3 0 01-3 3H9a3 3 0 01-3-3V5a3 3 0 013-3h3a3 3 0 013 3z"/>
                                </svg>
                                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500/20 to-red-600/20 text-red-300 border border-red-500/40 rounded-full font-bold text-lg">
                                    {{ $booking->seat_number }}
                                </div>
                            </div>
                        </div>

                        <!-- Price & Status -->
                        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between pt-8 border-t border-slate-800/50">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center px-4 py-2 rounded-full font-bold text-sm uppercase tracking-wide shadow-lg {{ $booking->payment_status == 'paid' ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/40' : ($booking->payment_status == 'pending' ? 'bg-amber-500/20 text-amber-400 border-amber-500/40 animate-pulse' : 'bg-red-500/20 text-red-400 border-red-500/40') }}">
                                    @if($booking->payment_status == 'paid')
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Confirmed
                                    @elseif($booking->payment_status == 'pending')
                                        <svg class="w-4 h-4 mr-1 animate-spin" fill="none" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" pathLength="0.4" class="opacity-25"/>
                                            <path d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" fill="currentColor"/>
                                        </svg>
                                        Pending
                                    @else
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Failed
                                    @endif
                                </span>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-black text-white mb-1">₹{{ number_format($booking->total_price, 2) }}</p>
                                <p class="text-sm text-slate-500 mb-2">
                                    ID: <span class="font-mono bg-slate-800/50 px-3 py-1 rounded font-medium text-slate-300">#{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </p>
                                <p class="text-xs text-slate-500">{{ \App\Helpers\DateHelper::formatDate($booking->created_at, 'M d, Y h:i A') }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col gap-3 pt-8 border-t border-slate-800/50 mt-8">
                            @if($booking->payment_status === 'pending')
                                <button onclick="payNow({{ $booking->id }})" class="inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 w-full uppercase tracking-wide">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12"/>
                                    </svg>
                                    Complete Payment
                                </button>
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
            <div class="inline-flex w-32 h-32 bg-slate-800/50 rounded-3xl items-center justify-center mb-12 mx-auto p-8 border-4 border-dashed border-slate-700/50 group hover:bg-slate-800/70 transition-all">
                <svg class="w-16 h-16 text-slate-500 group-hover:text-slate-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h2 class="text-4xl font-black text-slate-300 mb-6">No Bookings Yet</h2>
            <p class="text-xl text-slate-500 mb-12 max-w-md mx-auto leading-relaxed">
                Your cinema adventure awaits! Book your first movie ticket and create some memories.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('movies.index') }}" class="inline-flex items-center px-10 py-5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-300 text-lg">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c0 4.97-4.03 9-9 9m9 9c0 4.97-4.03 9-9 9"/>
                    </svg>
                    Find Movies Now
                </a>
            </div>
        </div>
    @endif
</section>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function payNow(bookingId) {
    fetch('{{ route("payment.create-order") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ booking_id: bookingId })
    })
    .then(res => res.json())
    .then(data => {
        const options = {
            "key": data.key,
            "amount": data.amount,
            "currency": "INR",
            "name": "CineVerse",
            "description": `Movie Ticket Booking #${bookingId}`,
            "order_id": data.order_id,
            "handler": function(response) {
                verifyPayment(response, bookingId);
            },
            "prefill": {
                "name": "{{ Auth::user()->name }}",
                "email": "{{ Auth::user()->email }}"
            },
            "theme": {
                "color": "#ef4444"
            }
        };
        const rzp = new Razorpay(options);
        rzp.open();
    })
    .catch(err => {
        console.error('Payment error:', err);
        alert('Payment initialization failed. Please try again.');
    });
}

function verifyPayment(response, bookingId) {
    fetch('{{ route("payment.verify") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            booking_id: bookingId,
            ...response
        })
    })
    .then(res => res.json())
    .then(result => {
        if (result.success) {
            window.location.reload();
        } else {
            alert('Payment verification failed.');
        }
    })
    .catch(err => {
        console.error('Verification error:', err);
        alert('Payment verification failed. Please try again.');
    });
}
</script>
@endsection
