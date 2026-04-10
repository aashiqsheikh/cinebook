@extends('layouts.app')

@section('content')
<!-- Payment Hero -->
<section class="bg-gradient-to-br from-slate-900 via-emerald-900/20 to-red-900/20 py-24 lg:py-32 relative">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_50%_50%_at_50%25%,theme(colors.emerald.400/0.1),transparent),radial-gradient(ellipse_50%_50%_at_50%75%,theme(colors.red.500/0.1),transparent)]"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="mb-12">
            <div class="inline-flex w-24 h-24 bg-gradient-to-r from-emerald-500 to-red-500 rounded-2xl items-center justify-center mb-8 shadow-2xl mx-auto">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black bg-gradient-to-r from-white to-slate-200 bg-clip-text text-transparent mb-6 drop-shadow-2xl">
                Secure Checkout
            </h1>
            <p class="text-xl md:text-2xl text-slate-300 max-w-2xl mx-auto">
                Complete your booking with Razorpay - India's most trusted payment gateway
            </p>
        </div>
    </div>
</section>

<!-- Payment Form -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 -mt-6 lg:-mt-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 items-start">
        <!-- Payment Form -->
        <div>
            <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800/50 rounded-4xl p-6 lg:p-10 shadow-2xl">
                <h3 class="text-2xl lg:text-3xl font-bold text-white mb-8 flex items-center gap-4">
                    <svg class="w-12 h-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V9a3 3 0 00-3-3H9a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Payment Details
                </h3>

                <!-- Razorpay Branding -->
                <div class="text-center py-12 mb-10">
                    <div class="inline-block p-6 bg-gradient-to-r from-slate-800/50 to-slate-900/50 backdrop-blur-xl rounded-3xl border border-slate-700/50 shadow-2xl">
                        <svg class="w-32 h-12 mx-auto mb-4" viewBox="0 0 160 40" fill="none">
                            <path d="M10 20c0 5.523 4.477 10 10 10s10-4.477 10-10-4.477-10-10-10S10 14.477 10 20z" fill="#00BAF2"/>
                            <text x="23" y="26" font-family="'Helvetica Neue', Arial, sans-serif" font-size="18" font-weight="bold" fill="#fff">RAZORPAY</text>
                        </svg>
                        <p class="text-slate-400 text-sm font-medium">🔒 100% Secure Payment</p>
                    </div>
                </div>

                <!-- Test Card Info -->
                <div class="bg-gradient-to-r from-yellow-500/10 to-amber-500/10 border border-yellow-500/30 rounded-3xl p-6 mb-8 backdrop-blur-sm">
                    <h4 class="font-bold text-yellow-400 mb-3 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Test Card Details
                    </h4>
                    <div class="text-sm space-y-2 text-slate-300">
                        <div>Card: <span class="font-mono bg-slate-800/50 px-2 py-1 rounded font-bold">4111 1111 1111 1111</span></div>
                        <div>Expiry: Any future date</div>
                        <div>Cvv: Any 3 digits</div>
                    </div>
                </div>

                <!-- Pay Button -->
                <div class="pt-4">
                    <button
                        id="rzp-button"
                        type="button"
                        class="w-full flex items-center justify-center gap-4 px-8 py-6 bg-gradient-to-r from-emerald-500 via-emerald-600 to-red-500 hover:from-emerald-600 hover:via-emerald-700 hover:to-red-600 text-white font-bold text-xl lg:text-2xl rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-500 uppercase tracking-wide group"
                    >
                        <svg class="w-8 h-8 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12"/>
                        </svg>
                        Pay ₹{{ number_format($booking->total_price, 2) }} Now
                    </button>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div>
            <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800/50 rounded-4xl p-6 lg:p-10 shadow-2xl lg:sticky lg:top-24 max-h-screen overflow-y-auto">
                <h3 class="text-2xl lg:text-3xl font-bold text-white mb-8 text-center flex items-center justify-center gap-4">
                    <svg class="w-12 h-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Final Summary
                </h3>

                <div class="space-y-6 mb-12">
                    <div class="p-6 bg-slate-800/50 rounded-3xl border border-slate-700/50">
                        <span class="block text-sm text-slate-400 font-medium uppercase tracking-wide mb-3">Movie</span>
                        <h4 class="text-2xl font-bold text-white mb-2">{{ $movie->title }}</h4>
                    </div>

                    <div class="p-6 bg-slate-800/50 rounded-3xl border border-slate-700/50">
                        <span class="block text-sm text-slate-400 font-medium uppercase tracking-wide mb-3">Theatre</span>
                        <p class="text-xl font-bold text-white">{{ $theatre->name }}</p>
                        <p class="text-slate-400 mt-1">{{ $theatre->location }}</p>
                    </div>

                    <div class="p-6 bg-slate-800/50 rounded-3xl border border-slate-700/50">
                        <span class="block text-sm text-slate-400 font-medium uppercase tracking-wide mb-3">Date & Time</span>
                        <div class="grid grid-cols-2 gap-4 text-lg">
                            <div>
                                <svg class="w-6 h-6 text-emerald-400 inline mr-2 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <div>{{ \App\Helpers\DateHelper::formatShowDate($show->show_date) }}</div>
                            </div>
                            <div>
                                <svg class="w-6 h-6 text-red-400 inline mr-2 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div>{{ \App\Helpers\DateHelper::formatTime($show->show_time) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-gradient-to-r from-emerald-500/20 to-red-500/20 border border-emerald-500/40 rounded-3xl">
                        <span class="block text-sm text-emerald-300 font-medium uppercase tracking-wide mb-4">Seat</span>
                        <div class="text-center">
                            <div class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold text-2xl rounded-3xl shadow-2xl ring-4 ring-emerald-500/30 mb-3 mx-auto">
                                {{ $booking->seat_number }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total -->
                <div class="p-8 bg-gradient-to-r from-slate-900 to-slate-800 rounded-4xl border-2 border-slate-700 shadow-2xl text-center">
                    <div class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-emerald-400 to-red-500 text-transparent bg-clip-text drop-shadow-2xl mb-2">
                        ₹{{ number_format($booking->total_price, 2) }}
                    </div>
                    <p class="text-lg text-slate-400 font-medium tracking-wide uppercase">Total Amount</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Razorpay Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
let razorpayOrderId = '{{ $booking->razorpay_order_id }}';
let bookingId = {{ $booking->id }};
let amount = {{ (int)($booking->total_price * 100) }};

document.addEventListener('DOMContentLoaded', function() {
    // Auto trigger after page load
    setTimeout(() => {
        document.getElementById('rzp-button').click();
    }, 800);
});

document.getElementById('rzp-button').onclick = function(e) {
    e.preventDefault();

    const options = {
        "key": "{{ $razorpayKey }}",
        "amount": amount,
        "currency": "INR",
        "name": "CineVerse",
        "description": "Movie Ticket Booking #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}",
        "order_id": razorpayOrderId,
        "image": window.location.origin + '/favicon.ico',
        "handler": function(response) {
            verifyPayment(response);
        },
        "prefill": {
            "name": "{{ Auth::user()->name }}",
            "email": "{{ Auth::user()->email }}",
            "contact": "{{ Auth::user()->phone ?? '' }}"
        },
        "theme": {
            "color": "#ef4444"
        },
        "modal": {
            "ondismiss": function(){
                console.log('Payment dismissed');
            }
        }
    };

    var rzp1 = new Razorpay(options);
    rzp1.open();
};

function verifyPayment(response) {
    fetch('{{ route("payment.verify") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
        },
        body: JSON.stringify({
            booking_id: bookingId,
            razorpay_payment_id: response.razorpay_payment_id,
            razorpay_order_id: response.razorpay_order_id,
            razorpay_signature: response.razorpay_signature
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            alert('Payment verification failed. Please contact support.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
    });
}
</script>
@endsection
