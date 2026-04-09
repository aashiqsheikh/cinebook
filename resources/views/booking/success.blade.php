@extends('layouts.app')

@section('content')
<!-- Success Celebration -->
<section class="min-h-screen bg-gradient-to-br from-emerald-900/30 via-slate-900 to-red-900/20 py-24 relative overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_800px_800px,_var(--tw-gradient-stops))] from-emerald-500/10 to-transparent"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-emerald-400/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-red-400/5 rounded-full blur-3xl animate-pulse" style="animation-delay: -1s;"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <!-- Celebration Badge -->
        <div class="inline-flex w-32 h-32 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-3xl items-center justify-center mb-8 shadow-2xl ring-8 ring-emerald-500/30 animate-bounce">
            <svg class="w-16 h-16 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black bg-gradient-to-r from-emerald-400 via-white to-emerald-200 bg-clip-text text-transparent mb-4 leading-tight">
            Booking Confirmed!
        </h1>
        <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed opacity-90">
            Your digital ticket is ready! Save this page or show it at the theatre counter.
        </p>
    </div>
</section>

<!-- Digital Ticket -->
<section class="py-16 lg:py-28">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Ticket Wrapper -->
        <div class="relative bg-white/10 backdrop-blur-md border border-white/20 rounded-4xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-500">
            <!-- Ticket Perforation Effect -->
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_1px_1px,theme(colors.slate.300/0.4)_1px,transparent_0)] [background-size:20px_20px]"></div>

            <!-- Ticket Header -->
            <div class="bg-gradient-to-r from-slate-900 to-slate-800/80 p-8 pb-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-emerald-500 to-red-500"></div>
                <div class="text-center relative z-10">
                    <div class="inline-flex items-center gap-2 bg-green-500/20 px-5 py-2 rounded-full mb-5 border border-green-500/30 font-bold text-green-300 text-sm uppercase tracking-wider">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        PAYMENT CONFIRMED
                    </div>
                    <h2 class="text-3xl md:text-4xl font-black text-white mb-1">
                        CineVerse
                    </h2>
                    <p class="text-xl text-slate-400 font-bold">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            <!-- Ticket Content -->
            <div class="p-8 lg:p-12">
                <div class="grid md:grid-cols-2 gap-8 lg:gap-12 mb-8">
                    <div>
                        <div class="space-y-6">
                            <div>
                                <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Movie</span>
                                <h3 class="text-2xl md:text-3xl font-black text-slate-900">{{ $booking->show->movie->title }}</h3>
                            </div>
                            <div>
                                <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Theatre</span>
                                <p class="text-xl font-bold text-slate-900">{{ $booking->show->theatre->name }}</p>
                                <p class="text-lg text-slate-600 mt-1">{{ $booking->show->theatre->location }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="space-y-6">
                            <div>
                                <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Show Details</span>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-4 text-lg text-slate-800">
                                        <svg class="w-6 h-6 text-slate-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ \App\Helpers\DateHelper::formatEmailDate($booking->show->show_date) }}</span>
                                    </div>
                                    <div class="flex items-center gap-4 text-xl font-bold text-slate-900">
                                        <svg class="w-7 h-7 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ \App\Helpers\DateHelper::formatTime($booking->show->show_time) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">Seat</span>
                                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold text-lg rounded-2xl shadow-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2a3 3 0 01-3 3H9a3 3 0 01-3-3V5a3 3 0 013-3h3a3 3 0 013 3z"/>
                                    </svg>
                                    {{ $booking->seat_number }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment & Booking Details -->
                <div class="grid md:grid-cols-3 gap-4 mb-8 py-6 border-y border-slate-200/50">
                    <div class="text-center">
                        <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Total Price</span>
                        <p class="text-2xl font-black text-red-500">₹{{ number_format($booking->total_price, 2) }}</p>
                    </div>
                    <div class="text-center">
                        <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Payment Status</span>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-500/20 rounded-lg border border-green-500/30">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-bold text-green-300 text-sm">PAID</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Payment ID</span>
                        <p class="text-sm font-mono text-slate-400 truncate">{{ substr($booking->payment_id, 0, 12) }}...</p>
                    </div>
                </div>

                <!-- QR Section -->
                <div class="bg-slate-50/10 p-8 rounded-2xl border border-slate-200/30 text-center">
                    <span class="block text-base font-bold text-slate-300 uppercase tracking-wide mb-6">Scan at Theatre Counter</span>
                    @php
                        $qrData = json_encode(['booking_id' => $booking->id, 'seat' => $booking->seat_number, 'payment_id' => $booking->payment_id]);
                        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($qrData);
                    @endphp
                    <div class="inline-block p-3 bg-white rounded-xl shadow-lg max-w-xs mx-auto mb-5">
                        <img src="{{ $qrUrl }}" alt="Booking QR Code" class="w-full h-auto" loading="lazy">
                    </div>
                    <p class="text-slate-400 text-sm font-medium max-w-sm mx-auto leading-relaxed">
                        Present this digital ticket at the theatre counter. No printing required!
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center pt-6 mt-8 border-t border-slate-200/30">
                    <a href="{{ route('bookings.my') }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-white/80 hover:bg-white border-2 border-slate-300/50 rounded-xl text-slate-900 font-bold text-base shadow-lg hover:shadow-xl transition-all duration-300 text-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        My Bookings
                    </a>
                    <button onclick="printTicket()" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold text-base rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 uppercase tracking-wider">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10l-5.5 5.5m0 0L12 21l5.5-5.5m-5.5 5.5V8"/>
                        </svg>
                        Download
                    </button>
                </div>
            </div>

            <!-- Ticket Footer -->
            <div class="bg-slate-50/5 pt-6 pb-8 px-8 border-t border-slate-200/30">
                <div class="text-center">
                    <p class="text-xs text-slate-400 font-medium mb-2 max-w-md mx-auto leading-relaxed">
                        Valid for {{ \App\Helpers\DateHelper::formatDate($booking->show->show_date, 'M d, Y') }}
                    </p>
                    <p class="text-xs text-slate-500">
                        Show at counter • No printing • Instant entry
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function printTicket() {
    const ticket = document.querySelector('.max-w-2xl');
    const printWindow = window.open('', '_blank');
    const ticketHTML = ticket.outerHTML;

    printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>CineVerse Ticket #${{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</title>
            <style>
                body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; margin: 0; padding: 40px; background: white; }
                .ticket { max-width: 600px; margin: 0 auto; }
                @media print { body { padding: 0; } }
            </style>
        </head>
        <body>${ticketHTML}</body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}
</script>
@endsection
