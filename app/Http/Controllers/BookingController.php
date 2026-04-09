<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\Show;
use App\Models\Theatre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display user's bookings.
     */
    public function myBookings()
    {
        // 🔥 Auto delete old pending bookings (older than 15 minutes)
        Booking::where('payment_status', 'pending')
            ->where('created_at', '<', Carbon::now()->subMinutes(15))
            ->delete();

        // ✅ Show ONLY paid bookings
        $bookings = Booking::with(['show.movie', 'show.theatre'])
            ->where('user_id', Auth::id())
            ->where('payment_status', 'paid')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Select theatre for booking.
     */
    public function selectTheatre(Movie $movie)
    {
        $theatres = Theatre::with(['shows' => function ($query) use ($movie) {
            $query->where('movie_id', $movie->id)
                ->where('show_date', '>=', now()->toDateString());
        }])->get();

        return view('booking.select-theatre', compact('movie', 'theatres'));
    }

    /**
     * Select showtime for booking.
     */
    public function selectShowtime(Request $request, Movie $movie)
    {
        $theatre = Theatre::findOrFail($request->theatre_id);

        $shows = Show::where('movie_id', $movie->id)
            ->where('theatre_id', $request->theatre_id)
            ->where('show_date', '>=', now()->toDateString())
            ->orderBy('show_date')
            ->orderBy('show_time')
            ->get();

        return view('booking.select-showtime', compact('movie', 'theatre', 'shows'));
    }

    /**
     * Select seats for booking.
     */
    public function selectSeats(Show $show)
    {
        $theatre = $show->theatre;
        $movie = $show->movie;

        // ✅ Only paid bookings should block seats
        $bookedSeats = $show->getBookedSeats();

        return view('booking.select-seats', compact('show', 'theatre', 'movie', 'bookedSeats'));
    }

    /**
     * Confirm and process booking.
     */
    public function confirmBooking(Request $request, Show $show)
    {
        $validated = $request->validate([
            'seat_number' => 'required|string',
        ]);

        $seatNumber = $validated['seat_number'];

        // ✅ Check only paid seats
        $bookedSeats = $show->getBookedSeats();

        if (in_array($seatNumber, $bookedSeats)) {
            return back()->with('error', 'This seat is already booked!');
        }

        $totalPrice = $show->price;

        return view('booking.confirm', compact('show', 'seatNumber', 'totalPrice'));
    }

    /**
     * Store booking and redirect to payment.
     */
    public function store(Request $request, Show $show)
    {
        $validated = $request->validate([
            'seat_number' => 'required|string',
        ]);

        $seatNumber = $validated['seat_number'];

        // ✅ Check only paid seats (important fix)
        $bookedSeats = $show->getBookedSeats();

        if (in_array($seatNumber, $bookedSeats)) {
            return back()->with('error', 'This seat is already booked!');
        }

        // ✅ Create pending booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'show_id' => $show->id,
            'seat_number' => $seatNumber,
            'total_price' => $show->price,
            'payment_status' => 'pending',
        ]);

        return redirect()->route('payment.checkout', ['booking' => $booking->id]);
    }
}
