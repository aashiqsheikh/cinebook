@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Header -->
    <div class="bg-gradient-to-r from-amber-900/80 via-orange-900/50 to-amber-900 py-20 mb-12 rounded-3xl shadow-2xl border border-amber-800/60">
        <div class="flex justify-between items-center px-8">
            <div>
                <h1 class="text-5xl font-black text-white mb-4">
                    <i class="fas fa-ticket-alt mr-4 text-orange-400"></i>
                    Manage Bookings
                </h1>
                <p class="text-xl text-gray-300">View all customer bookings</p>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-8 p-6 bg-green-600 text-white rounded-xl shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-slate-900/70 backdrop-blur-xl border border-slate-700/70 rounded-3xl shadow-2xl p-6">

        @if($bookings->count() > 0)

            <div class="overflow-x-auto">
                <table class="min-w-full text-white">

                    <!-- Head -->
                    <thead>
                        <tr class="bg-gradient-to-r from-orange-900 to-amber-900 text-white">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Movie</th>
                            <th class="px-6 py-4">Theatre</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Time</th>
                            <th class="px-6 py-4">Seat</th>
                            <th class="px-6 py-4">Amount</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr class="border-b border-slate-700 hover:bg-slate-800 transition">

                                <td class="px-6 py-4">#{{ $booking->id }}</td>

                                <td class="px-6 py-4">
                                    {{ $booking->user->name ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $booking->show->movie->title ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $booking->show->theatre->name ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ \App\Helpers\DateHelper::formatAdminDate($booking->show->show_date) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ \App\Helpers\DateHelper::formatTime24Hour($booking->show->show_time) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $booking->seat_number }}
                                </td>

                                <td class="px-6 py-4 font-bold text-amber-400">
                                    ₹{{ number_format($booking->total_price, 2) }}
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @if($booking->payment_status == 'paid')
                                        <span class="bg-green-500 px-3 py-1 rounded-full text-sm font-bold">Paid</span>
                                    @elseif($booking->payment_status == 'pending')
                                        <span class="bg-yellow-500 text-black px-3 py-1 rounded-full text-sm font-bold">Pending</span>
                                    @else
                                        <span class="bg-red-500 px-3 py-1 rounded-full text-sm font-bold">Failed</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-8 text-center">
                {{ $bookings->links() }}
            </div>

        @else

            <!-- Empty -->
            <div class="text-center py-20 text-gray-400">
                <i class="fas fa-ticket-alt text-5xl mb-4"></i>
                <h3 class="text-3xl font-bold">No bookings yet</h3>
            </div>

        @endif

    </div>
</div>

@endsection
