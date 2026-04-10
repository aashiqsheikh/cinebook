@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-slate-900 to-slate-800 py-12 md:py-16 border-b border-slate-800">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">My Bookings</h1>
            <p class="text-sm md:text-base text-slate-400">Your cinema tickets and reservations</p>
        </div>
    </div>
</section>

<!-- Bookings Grid -->
<section class="bg-slate-950 py-12 md:py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        @if($bookings->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($bookings as $booking)
                    <div class="group bg-slate-900 border border-slate-800 rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 overflow-hidden">
                        <!-- Movie Poster -->
                        <div class="relative h-48 bg-slate-800 overflow-hidden">
                            @if($booking->show->movie->poster)
                                <img src="{{ $booking->show->movie->poster }}" alt="{{ $booking->show->movie->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center text-4xl font-bold text-slate-500">
                                    {{ substr($booking->show->movie->title, 0, 1) }}
                                </div>
                            @endif
                            <!-- Status Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $booking->payment_status == 'paid' ? 'bg-emerald-500/20 text-emerald-300' : ($booking->payment_status == 'pending' ? 'bg-amber-500/20 text-amber-300' : 'bg-red-500/20 text-red-300') }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-5">
                            <!-- Movie Title -->
                            <h3 class="text-lg font-semibold text-white mb-3 line-clamp-2">{{ $booking->show->movie->title }}</h3>

                            <!-- Details -->
                            <div class="space-y-2.5 mb-4">
                                <!-- Theatre -->
                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-slate-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5-4h1m-1 4h1m8-4h1m-1 4h1"/>
                                    </svg>
                                    <p class="text-xs text-slate-400">{{ $booking->show->theatre->name }}</p>
                                </div>

                                <!-- Date & Time -->
                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-slate-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-xs text-slate-400">{{ \App\Helpers\DateHelper::formatShowDate($booking->show->show_date) }} • {{ \App\Helpers\DateHelper::formatTime($booking->show->show_time) }}</p>
                                </div>

                                <!-- Seat -->
                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-slate-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2a3 3 0 01-3 3H9a3 3 0 01-3-3V5a3 3 0 013-3h3a3 3 0 013 3z"/>
                                    </svg>
                                    <p class="text-xs text-slate-400">Seat <span class="font-semibold text-white">{{ $booking->seat_number }}</span></p>
                                </div>
                            </div>

                            <!-- Divider -->
                            <div class="border-t border-slate-800 my-4"></div>

                            <!-- Price & Actions -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-semibold text-white">₹{{ number_format($booking->total_price, 0) }}</span>
                                <span class="text-xs text-slate-500">{{ $booking->created_at->diffForHumans() }}</span>
                            </div>

                            @if($booking->payment_status == 'pending')
                                <button onclick="payNow({{ $booking->id }})" class="w-full px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                    Complete Payment
                                </button>
                            @else
                                <a href="{{ route('booking.ticket', $booking->id) }}" class="block w-full px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-sm font-medium rounded-lg text-center transition-colors duration-200">
                                    View Ticket
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                {{ $bookings->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-24">
                <div class="w-24 h-24 mx-auto mb-6 bg-slate-800 rounded-2xl flex items-center justify-center">
                    <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-6 7h12m-12 4h12"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">No Bookings Yet</h2>
                <p class="text-sm text-slate-400 mb-6">Start booking your favorite movies now!</p>
                <a href="{{ route('movies.index') }}" class="inline-flex items-center px-6 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    Browse Movies
                </a>
            </div>
        @endif
    </div>
</section>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function payNow(bookingId) {
    console.log('Pay now:', bookingId);
    alert('Payment flow - integrate Razorpay');
}
</script>
@endsection

