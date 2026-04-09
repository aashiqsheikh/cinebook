@extends('layouts.app')

@section('content')
<style>
    /* ==================== CINEMA SCREEN STYLES ==================== */
    .cinema-screen {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1e293b 100%);
        border: 2px solid #64748b;
        box-shadow:
            inset 0 -20px 40px rgba(0, 0, 0, 0.8),
            0 0 80px rgba(255, 59, 48, 0.3),
            0 0 120px rgba(255, 59, 48, 0.15);
        position: relative;
        overflow: hidden;
    }

    .cinema-screen::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(ellipse at center bottom, rgba(255, 59, 48, 0.2) 0%, transparent 70%);
        pointer-events: none;
    }

    .cinema-screen-label {
        font-weight: 900;
        font-size: 2rem;
        letter-spacing: 4px;
        background: linear-gradient(135deg, #ff3b30 0%, #ff6b6b 50%, #ff3b30 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 0 30px rgba(255, 59, 48, 0.4);
        animation: screenGlow 3s ease-in-out infinite;
    }

    @keyframes screenGlow {
        0%, 100% { filter: drop-shadow(0 0 10px rgba(255, 59, 48, 0.4)); }
        50% { filter: drop-shadow(0 0 25px rgba(255, 59, 48, 0.7)); }
    }

    /* ==================== SEAT STYLES ==================== */
    .seat-container {
        perspective: 1000px;
    }

    .seat {
        position: relative;
        width: 2.75rem;
        height: 2.75rem;
        padding: 0;
        border: none;
        font-weight: 600;
        font-size: 0.7rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Available Seat */
    .seat.available {
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        color: white;
        box-shadow:
            0 4px 6px rgba(6, 182, 212, 0.3),
            inset -2px -2px 4px rgba(0, 0, 0, 0.4),
            inset 2px 2px 4px rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(6, 182, 212, 0.5);
    }

    .seat.available:hover {
        transform: translateY(-4px) scale(1.1);
        box-shadow:
            0 12px 24px rgba(6, 182, 212, 0.5),
            inset -2px -2px 4px rgba(0, 0, 0, 0.4),
            inset 2px 2px 4px rgba(255, 255, 255, 0.2),
            0 0 20px rgba(6, 182, 212, 0.6);
    }

    .seat.available:focus-visible {
        outline: 2px solid #06b6d4;
        outline-offset: 2px;
    }

    /* Selected Seat */
    .seat.selected {
        background: linear-gradient(135deg, #eab308 0%, #facc15 100%);
        color: #1e293b;
        box-shadow:
            0 8px 20px rgba(234, 179, 8, 0.5),
            inset -2px -2px 4px rgba(0, 0, 0, 0.3),
            inset 2px 2px 4px rgba(255, 255, 255, 0.3),
            0 0 25px rgba(234, 179, 8, 0.7);
        border: 1px solid rgba(234, 179, 8, 0.8);
        transform: scale(1.15);
        font-weight: 700;
    }

    .seat.selected:hover {
        transform: translateY(-5px) scale(1.15);
        box-shadow:
            0 12px 28px rgba(234, 179, 8, 0.6),
            inset -2px -2px 4px rgba(0, 0, 0, 0.3),
            inset 2px 2px 4px rgba(255, 255, 255, 0.3),
            0 0 30px rgba(234, 179, 8, 0.8);
    }

    /* VIP Seat */
    .seat.vip {
        background: linear-gradient(135deg, #d946ef 0%, #ec4899 100%);
        color: white;
        box-shadow:
            0 4px 6px rgba(236, 72, 153, 0.3),
            inset -2px -2px 4px rgba(0, 0, 0, 0.4),
            inset 2px 2px 4px rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(236, 72, 153, 0.5);
    }

    .seat.vip:hover {
        transform: translateY(-4px) scale(1.1);
        box-shadow:
            0 12px 24px rgba(236, 72, 153, 0.5),
            inset -2px -2px 4px rgba(0, 0, 0, 0.4),
            inset 2px 2px 4px rgba(255, 255, 255, 0.2),
            0 0 20px rgba(236, 72, 153, 0.6);
    }

    .seat.vip.selected {
        background: linear-gradient(135deg, #fbbf24 0%, #fcd34d 100%);
        color: #1e293b;
        box-shadow:
            0 8px 20px rgba(251, 191, 36, 0.5),
            inset -2px -2px 4px rgba(0, 0, 0, 0.3),
            inset 2px 2px 4px rgba(255, 255, 255, 0.3),
            0 0 25px rgba(251, 191, 36, 0.7);
    }

    /* Booked Seat */
    .seat.booked {
        background: linear-gradient(135deg, #475569 0%, #334155 100%);
        color: #94a3b8;
        cursor: not-allowed;
        opacity: 0.6;
        box-shadow:
            inset -2px -2px 4px rgba(0, 0, 0, 0.5),
            inset 2px 2px 4px rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(75, 85, 99, 0.3);
    }

    .seat.booked:hover {
        transform: none;
    }

    /* Locked Seat (Pending Reservation) */
    .seat.locked {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .seat.locked::after {
        content: '🔒';
        position: absolute;
        font-size: 0.6rem;
        top: -8px;
        right: -8px;
    }

    /* ==================== LEGEND STYLES ==================== */
    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1.5rem;
        background: rgba(15, 23, 42, 0.5);
        border: 1px solid rgba(100, 116, 139, 0.3);
        border-radius: 0.75rem;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .legend-item:hover {
        background: rgba(15, 23, 42, 0.8);
        border-color: rgba(100, 116, 139, 0.5);
    }

    .legend-seat {
        width: 1.5rem;
        height: 1.5rem;
        border-radius: 0.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.6rem;
        font-weight: bold;
    }

    /* ==================== TIMER STYLES ==================== */
    .lock-timer {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.2) 100%);
        border: 1px solid rgba(239, 68, 68, 0.5);
        border-radius: 0.5rem;
        color: #fca5a5;
        font-weight: 600;
        font-size: 0.875rem;
        animation: timerPulse 1s ease-in-out infinite;
    }

    @keyframes timerPulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    /* ==================== ANIMATIONS ==================== */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-slideUp {
        animation: slideUp 0.5s ease-out forwards;
    }

    .animate-scaleIn {
        animation: scaleIn 0.3s ease-out forwards;
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 768px) {
        .seat {
            width: 2.25rem;
            height: 2.25rem;
            font-size: 0.6rem;
        }

        .cinema-screen-label {
            font-size: 1.25rem;
            letter-spacing: 2px;
        }

        .legend-item {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    }

    @media (max-width: 640px) {
        .seat {
            width: 2rem;
            height: 2rem;
            font-size: 0.55rem;
        }

        .legend-item {
            padding: 0.5rem 0.75rem;
            gap: 0.5rem;
            font-size: 0.75rem;
        }

        .legend-seat {
            width: 1.25rem;
            height: 1.25rem;
        }
    }
</style>

<!-- Booking Hero -->
<section class="bg-gradient-to-br from-slate-900 via-red-900/10 to-slate-900 py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxjaXJjbGUgY3g9IjUwIiBjeT0iNTAiIHI9IjIiIHN0b3AtY29sb3I9IiNlZjQ0NDQ7IiBzdG9wLW9wYWNpdHk9IjAuMiIvPgo8L3N2Zz4=')] opacity-20"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-black bg-gradient-to-r from-white via-slate-100 to-red-400 bg-clip-text text-transparent mb-4 md:mb-6 animate-slideUp">
            Select Your Seats
        </h1>
        <p class="text-lg md:text-2xl text-slate-300 max-w-2xl mx-auto animate-slideUp" style="animation-delay: 0.1s;">
            Pick the perfect seats for an unforgettable cinema experience
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
    <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">
        <!-- Seat Selection Section -->
        <div class="lg:col-span-2">
            <!-- Movie & Show Info Card -->
            <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800/50 rounded-3xl p-6 md:p-8 mb-10 shadow-2xl animate-slideUp">
                <div class="grid md:grid-cols-2 gap-6 md:gap-8 text-slate-300">
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold text-white mb-2 flex items-center gap-3">
                            <svg class="w-6 md:w-8 h-6 md:h-8 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4v10a1 1 0 01-1 1H4a1 1 0 01-1-1V4h4z"/>
                            </svg>
                            {{ $movie->title }}
                        </h3>
                        <p class="text-base md:text-lg">{{ $theatre->name }}</p>
                        <p class="text-xs md:text-sm opacity-75">{{ $theatre->location }}</p>
                    </div>
                    <div class="text-left md:text-left">
                        <p class="text-xl md:text-2xl font-bold text-white mb-1">{{ \App\Helpers\DateHelper::formatShowDate($show->show_date) }}</p>
                        <p class="text-lg md:text-xl text-slate-400 mb-4">{{ \App\Helpers\DateHelper::formatTime($show->show_time) }}</p>
                        <span class="inline-flex items-center gap-2 px-3 md:px-4 py-2 bg-gradient-to-r from-emerald-500/20 to-emerald-600/20 text-emerald-300 border border-emerald-500/40 rounded-full text-sm md:text-lg font-bold">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.894 2.553a.989.989 0 00-1.788 0l-7 14a.987.987 0 00.855 1.433h14a.987.987 0 00.855-1.433l-7-14z"/>
                            </svg>
                            ₹{{ number_format($show->price, 0) }} / seat
                        </span>
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="mb-10 animate-slideUp" style="animation-delay: 0.1s;">
                <h4 class="text-sm font-semibold text-slate-400 mb-3 uppercase tracking-wide">Legend</h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    <div class="legend-item">
                        <div class="legend-seat bg-gradient-to-br from-cyan-500 to-cyan-600 text-white">✓</div>
                        <span class="text-xs md:text-sm text-slate-300 font-medium">Available</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-seat bg-gradient-to-br from-yellow-500 to-yellow-600 text-slate-900">✓</div>
                        <span class="text-xs md:text-sm text-slate-300 font-medium">Selected</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-seat bg-gradient-to-br from-slate-500 to-slate-600 text-slate-400" style="opacity: 0.6;">✗</div>
                        <span class="text-xs md:text-sm text-slate-400 font-medium">Booked</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-seat bg-gradient-to-br from-pink-500 to-pink-600 text-white">♛</div>
                        <span class="text-xs md:text-sm text-slate-300 font-medium">Premium</span>
                    </div>
                </div>
            </div>

            <!-- Cinema Screen -->
            <div class="text-center mb-10 md:mb-14 animate-slideUp" style="animation-delay: 0.15s;">
                <div class="inline-block cinema-screen px-8 md:px-16 py-6 md:py-8 rounded-t-full relative">
                    <div class="cinema-screen-label">✨ CINEMA SCREEN ✨</div>
                </div>
                <div class="w-full h-1 bg-gradient-to-r from-transparent via-red-500/30 to-transparent"></div>
            </div>

            <!-- Seats Grid with Row Labels -->
            <form id="seatForm" method="POST" action="{{ route('booking.store', $show) }}" class="space-y-4">
                @csrf
                <input type="hidden" name="seat_number" id="selectedSeatInput" value="">

                @php
                    $vipRows = ['D', 'E']; // VIP rows
                    $seatLayout = [
                        'A' => 10,
                        'B' => 10,
                        'C' => 10,
                        'D' => 8,
                        'E' => 8,
                    ];
                @endphp

                @foreach($seatLayout as $rowLetter => $seatCount)
                    @php
                        $isVipRow = in_array($rowLetter, $vipRows);
                    @endphp
                    <div class="flex items-center justify-center md:justify-start gap-3 md:gap-4 animate-slideUp" style="animation-delay: {{ $loop->index * 0.05 }}s;">
                        <!-- Row Label -->
                        <span class="w-8 md:w-12 text-right text-lg md:text-xl font-bold text-slate-300 flex-shrink-0">{{ $rowLetter }}</span>

                        <!-- Aisle Spacer -->
                        <div class="flex gap-2 md:gap-3 flex-wrap justify-center md:justify-start">
                            @for($seatNum = 1; $seatNum <= $seatCount; $seatNum++)
                                @php
                                    $seatId = $rowLetter . $seatNum;
                                    $isBooked = in_array($seatId, $bookedSeats ?? []);
                                @endphp

                                @if($seatNum == ceil($seatCount / 2) + 1 && $seatCount > 6)
                                    <!-- Middle Aisle -->
                                    <div class="w-2 md:w-4"></div>
                                @endif

                                <button
                                    type="button"
                                    class="seat {{ $isBooked ? 'booked' : ($isVipRow ? 'vip' : 'available') }}"
                                    data-seat="{{ $seatId }}"
                                    data-price="{{ $isVipRow ? $show->price * 1.25 : $show->price }}"
                                    data-is-vip="{{ $isVipRow ? 'true' : 'false' }}"
                                    {{ $isBooked ? 'disabled' : '' }}
                                    aria-label="{{ $isBooked ? 'Seat ' . $seatId . ' is booked' : 'Seat ' . $seatId . ', available' }}"
                                    role="button"
                                    tabindex="{{ $isBooked ? '-1' : '0' }}"
                                >
                                    {{ $seatNum }}
                                </button>
                            @endfor
                        </div>

                        <!-- Row Label Right -->
                        <span class="w-8 md:w-12 text-left text-lg md:text-xl font-bold text-slate-300 flex-shrink-0">{{ $rowLetter }}</span>
                    </div>
                @endforeach

                <!-- Proceed Button -->
                <div class="text-center mt-12 md:mt-16 animate-slideUp" style="animation-delay: {{ count($seatLayout) * 0.05 }}s;">
                    <button type="submit" class="group relative inline-flex items-center gap-3 px-8 md:px-12 py-4 md:py-5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 disabled:from-slate-600 disabled:to-slate-700 text-white font-bold text-base md:text-lg rounded-2xl shadow-2xl hover:shadow-3xl hover:-translate-y-1.5 disabled:hover:translate-y-0 transition-all duration-300 uppercase tracking-wide disabled:opacity-60 disabled:cursor-not-allowed" id="proceedBtn" disabled>
                        <svg class="w-5 h-5 md:w-6 md:h-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                        Proceed to Payment
                    </button>
                </div>
            </form>
        </div>

        <!-- Booking Summary Sidebar -->
        <div class="lg:sticky lg:top-24 lg:h-fit">
            <div class="bg-slate-900/70 backdrop-blur-xl border border-slate-800/50 rounded-3xl p-6 md:p-8 shadow-2xl animate-slideUp" style="animation-delay: 0.25s;">
                <h3 class="text-xl md:text-2xl font-bold mb-6 md:mb-8 text-white text-center flex items-center justify-center gap-3">
                    <svg class="w-8 h-8 md:w-10 md:h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Booking Summary
                </h3>

                <!-- Show Details -->
                <div class="space-y-4 md:space-y-6 mb-6 md:mb-8">
                    <div class="p-3 md:p-4 bg-slate-800/50 rounded-2xl border border-slate-700/30">
                        <p class="text-xs md:text-sm text-slate-400 mb-1 font-semibold uppercase tracking-wide">Movie</p>
                        <p class="text-base md:text-lg font-bold text-white truncate">{{ $movie->title }}</p>
                    </div>
                    <div class="p-3 md:p-4 bg-slate-800/50 rounded-2xl border border-slate-700/30">
                        <p class="text-xs md:text-sm text-slate-400 mb-1 font-semibold uppercase tracking-wide">Theatre</p>
                        <p class="text-base md:text-lg font-bold text-white">{{ $theatre->name }}</p>
                    </div>
                    <div class="p-3 md:p-4 bg-slate-800/50 rounded-2xl border border-slate-700/30">
                        <p class="text-xs md:text-sm text-slate-400 mb-1 font-semibold uppercase tracking-wide">Date & Time</p>
                        <p class="text-base md:text-lg font-bold text-white">{{ \App\Helpers\DateHelper::formatDateShort($show->show_date) }} • {{ \App\Helpers\DateHelper::formatTime24Hour($show->show_time) }}</p>
                    </div>
                </div>

                <!-- Seat Lock Timer (Shown when seats are selected) -->
                <div id="timerContainer" class="hidden mb-6 md:mb-8 p-4 bg-gradient-to-r from-red-950/40 to-orange-950/40 border border-red-500/30 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-300 font-medium">Seats Reserved For</span>
                        <span id="lockTimer" class="lock-timer">10:00</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Your selected seats will be automatically released after this timer expires.</p>
                </div>

                <!-- Selected Seats Display -->
                <div class="text-center mb-6 md:mb-8 p-4 md:p-6 bg-gradient-to-r from-cyan-500/10 to-cyan-600/10 border border-cyan-500/30 rounded-2xl">
                    <p class="text-xs md:text-sm text-slate-400 mb-2 font-semibold uppercase tracking-wide">Selected Seats</p>
                    <div id="selectedSeatsList" class="hidden">
                        <div class="flex items-center justify-center gap-2 mb-3 flex-wrap">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <span id="selectedSeatDisplay" class="font-bold text-cyan-300 text-sm md:text-base">-</span>
                        </div>
                        <p class="text-xs text-slate-400">Click seats to select/deselect</p>
                    </div>
                    <div id="noSeatsText" class="text-slate-400 text-sm md:text-base">No seats selected</div>
                </div>

                <!-- Price Breakdown -->
                <div class="space-y-3 md:space-y-4 mb-6 md:mb-8 text-sm md:text-base">
                    <div class="flex justify-between items-center py-2 md:py-3 px-3 md:px-4 bg-slate-800/30 rounded-xl border border-slate-700/20">
                        <span class="text-slate-300 font-medium">Seats</span>
                        <span class="font-bold text-white" id="seatCount">0</span>
                    </div>
                    <div class="flex justify-between items-center py-2 md:py-3 px-3 md:px-4 bg-slate-800/30 rounded-xl border border-slate-700/20">
                        <span class="text-slate-300 font-medium">Price/Seat</span>
                        <span class="font-bold text-white" id="priceDisplay">₹0</span>
                    </div>
                    <div class="flex justify-between items-center py-2 md:py-3 px-3 md:px-4 bg-slate-800/30 rounded-xl border border-slate-700/20">
                        <span class="text-slate-300 font-medium">Subtotal</span>
                        <span class="font-bold text-white" id="seatsTotal">₹0</span>
                    </div>
                </div>

                <!-- Total -->
                <div class="border-t border-slate-800/50 pt-6 md:pt-8">
                    <div class="flex justify-between items-center text-2xl md:text-3xl font-black mb-4 md:mb-6 p-3 md:p-4 bg-gradient-to-r from-slate-800/50 to-slate-900/50 rounded-2xl border border-slate-700/30">
                        <span>Total</span>
                        <span class="text-emerald-400" id="grandTotal">₹0</span>
                    </div>
                    <div class="bg-gradient-to-r from-slate-800/50 to-slate-900/30 p-3 md:p-4 rounded-2xl border border-slate-700/30 text-xs md:text-sm text-slate-400 leading-relaxed">
                        <svg class="w-4 h-4 md:w-5 md:h-5 inline mr-2 mb-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                        </svg>
                        Select seats and complete payment within 10 minutes to reserve your booking.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * ==================== CINEMA SEAT SELECTION SYSTEM ====================
     * Features:
     * - Multi-seat selection with real-time pricing
     * - 10-minute seat lock system with countdown timer
     * - VIP seat support with premium pricing
     * - Smooth animations and transitions
     * - Accessibility support
     */

    // State Management
    const state = {
        selectedSeats: [],
        baseSeatPrice: {{ $show->price }},
        bookedSeatsArray: @json($bookedSeats ?? []),
        lockDuration: 10 * 60 * 1000, // 10 minutes in milliseconds
        lockExpireTime: null,
        timerInterval: null,
    };

    // DOM Elements
    const seatForm = document.getElementById('seatForm');
    const proceedBtn = document.getElementById('proceedBtn');
    const selectedSeatInput = document.getElementById('selectedSeatInput');
    const selectedSeatsList = document.getElementById('selectedSeatsList');
    const selectedSeatDisplay = document.getElementById('selectedSeatDisplay');
    const seatCountEl = document.getElementById('seatCount');
    const priceDisplayEl = document.getElementById('priceDisplay');
    const seatsTotalEl = document.getElementById('seatsTotal');
    const grandTotalEl = document.getElementById('grandTotal');
    const timerContainer = document.getElementById('timerContainer');
    const lockTimerEl = document.getElementById('lockTimer');
    const noSeatsText = document.getElementById('noSeatsText');

    /**
     * Initialize seat selection listeners
     */
    function initializeSeats() {
        document.querySelectorAll('.seat:not(.booked)').forEach(seat => {
            seat.addEventListener('click', handleSeatClick);
            // Keyboard navigation
            seat.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    handleSeatClick.call(seat);
                }
            });
        });
    }

    /**
     * Handle seat click - select/deselect with animations
     */
    function handleSeatClick(e) {
        e.preventDefault();
        const seatId = this.dataset.seat;
        const index = state.selectedSeats.indexOf(seatId);

        if (index > -1) {
            // Deselect
            state.selectedSeats.splice(index, 1);
            this.classList.remove('selected');
            const seatType = this.dataset.isVip === 'true' ? 'vip' : 'available';
            this.classList.add(seatType);
        } else {
            // Select
            state.selectedSeats.push(seatId);
            this.classList.remove('available', 'vip');
            this.classList.add('selected');
            // Trigger animation
            this.style.animation = 'none';
            setTimeout(() => {
                this.style.animation = '';
            }, 10);
        }

        updateSummary();
        startSeatLock();
    }

    /**
     * Start the 10-minute seat lock timer
     */
    function startSeatLock() {
        if (state.selectedSeats.length === 0) {
            clearSeatLock();
            return;
        }

        if (state.timerInterval) {
            clearInterval(state.timerInterval);
        }

        state.lockExpireTime = Date.now() + state.lockDuration;
        timerContainer.classList.remove('hidden');
        timerContainer.classList.add('animate-scaleIn');

        updateLockTimer();
    }

    /**
     * Update lock timer display and check expiration
     */
    function updateLockTimer() {
        if (!state.lockExpireTime || state.selectedSeats.length === 0) {
            clearSeatLock();
            return;
        }

        const now = Date.now();
        const timeRemaining = state.lockExpireTime - now;

        if (timeRemaining <= 0) {
            // Time expired - auto clear selection
            clearSelectedSeats();
            clearSeatLock();
            showNotification('Your seat reservation has expired. Please select again.', 'warning');
            return;
        }

        // Format timer display (MM:SS)
        const minutes = Math.floor((timeRemaining / 1000) / 60);
        const seconds = Math.floor((timeRemaining / 1000) % 60);
        lockTimerEl.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        // Calculate warning threshold (last 1 minute)
        if (timeRemaining < 60000) {
            timerContainer.classList.add('ring-2', 'ring-red-500/50');
            lockTimerEl.classList.add('animate-pulse');
        } else {
            timerContainer.classList.remove('ring-2', 'ring-red-500/50');
            lockTimerEl.classList.remove('animate-pulse');
        }

        state.timerInterval = setTimeout(updateLockTimer, 1000);
    }

    /**
     * Clear all locks and timers
     */
    function clearSeatLock() {
        if (state.timerInterval) {
            clearInterval(state.timerInterval);
            state.timerInterval = null;
        }
        state.lockExpireTime = null;
        timerContainer.classList.add('hidden');
        timerContainer.classList.remove('ring-2', 'ring-red-500/50');
        lockTimerEl.classList.remove('animate-pulse');
    }

    /**
     * Update booking summary with real-time calculations
     */
    function updateSummary() {
        const seatCount = state.selectedSeats.length;

        if (seatCount > 0) {
            // Calculate total price considering VIP seats
            let totalPrice = 0;
            state.selectedSeats.forEach(seatId => {
                const seatEl = document.querySelector(`[data-seat="${seatId}"]`);
                const price = parseFloat(seatEl.dataset.price);
                totalPrice += price;
            });

            // Determine pricing display
            const basePrice = state.baseSeatPrice;
            const hasVipSeats = state.selectedSeats.some(seatId => {
                const seatEl = document.querySelector(`[data-seat="${seatId}"]`);
                return seatEl.dataset.isVip === 'true';
            });

            // Update UI
            seatCountEl.textContent = seatCount;
            priceDisplayEl.textContent = hasVipSeats ? `₹${number_format(basePrice)} (+ Premium)` : `₹${number_format(basePrice)}`;
            seatsTotalEl.textContent = '₹' + number_format(totalPrice);
            grandTotalEl.textContent = '₹' + number_format(totalPrice);

            // Show selected seats
            const seatsList = state.selectedSeats.join(', ');
            selectedSeatDisplay.textContent = seatsList;
            selectedSeatsList.classList.remove('hidden');
            noSeatsText.classList.add('hidden');

            // Enable proceed button
            proceedBtn.disabled = false;
            proceedBtn.classList.remove('opacity-60', 'cursor-not-allowed');
            proceedBtn.classList.add('opacity-100', 'cursor-pointer');

            // Update form input
            selectedSeatInput.value = state.selectedSeats.join(',');
        } else {
            // No seats selected
            seatCountEl.textContent = '0';
            priceDisplayEl.textContent = '₹0';
            seatsTotalEl.textContent = '₹0';
            grandTotalEl.textContent = '₹0';
            selectedSeatsList.classList.add('hidden');
            noSeatsText.classList.remove('hidden');

            // Disable proceed button
            proceedBtn.disabled = true;
            proceedBtn.classList.add('opacity-60', 'cursor-not-allowed');
            proceedBtn.classList.remove('opacity-100', 'cursor-pointer');

            // Clear form input
            selectedSeatInput.value = '';
        }
    }

    /**
     * Clear all selected seats from UI
     */
    function clearSelectedSeats() {
        state.selectedSeats.forEach(seatId => {
            const seatEl = document.querySelector(`[data-seat="${seatId}"]`);
            if (seatEl) {
                seatEl.classList.remove('selected');
                const seatType = seatEl.dataset.isVip === 'true' ? 'vip' : 'available';
                seatEl.classList.add(seatType);
            }
        });
        state.selectedSeats = [];
        updateSummary();
    }

    /**
     * Utility: Format number as Indian currency
     */
    function number_format(num) {
        return Math.round(num).toLocaleString('en-IN');
    }

    /**
     * Show notification message
     */
    function showNotification(message, type = 'info') {
        // Create a simple notification (can be enhanced with toast library)
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg text-white font-semibold z-50 animate-slideUp ${
            type === 'warning' ? 'bg-red-500' : 'bg-blue-500'
        }`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    /**
     * Handle form submission
     */
    seatForm.addEventListener('submit', function(e) {
        if (state.selectedSeats.length === 0) {
            e.preventDefault();
            showNotification('Please select at least one seat', 'warning');
            return;
        }

        // Check if seat lock is still valid
        if (state.lockExpireTime && Date.now() > state.lockExpireTime) {
            e.preventDefault();
            showNotification('Your seat reservation has expired. Please select again.', 'warning');
            clearSelectedSeats();
            clearSeatLock();
            return;
        }
    });

    /**
     * Handle page unload - cleanup timers
     */
    window.addEventListener('beforeunload', () => {
        if (state.timerInterval) {
            clearInterval(state.timerInterval);
        }
    });

    /**
     * Initialize on page load
     */
    document.addEventListener('DOMContentLoaded', function() {
        initializeSeats();
        updateSummary();

        // Add keyboard shortcuts info
        console.log('💺 Seat Selection Shortcuts:');
        console.log('- Click seat or press Enter/Space to select');
        console.log('- Seats are reserved for 10 minutes');
        console.log('- Complete payment before timer expires');
    });
</script>
@endsection
