<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\Show;
use App\Models\Theatre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function myBookings()
    {
        Booking::where('payment_status', 'pending')
            ->where('created_at', '<', Carbon::now()->subMinutes(15))
            ->delete();

        $bookings = Booking::with(['show.movie', 'show.theatre'])
            ->where('user_id', Auth::id())
            ->where('payment_status', 'paid')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.my', compact('bookings'));
    }

    public function selectTheatre(Movie $movie)
    {
        $cityId = session('city_id');

        if (!$cityId) {
            return redirect()->route('home')->with('error', 'Please select a city first.');
        }

        $theatres = Theatre::where('city_id', $cityId)
            ->with(['shows' => function ($query) use ($movie) {
                $query->where('movie_id', $movie->id)
                    ->where('show_date', '>=', now()->toDateString());
            }])->get();

        return view('booking.select-theatre', compact('movie', 'theatres'));
    }

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

    public function selectSeats(Show $show)
    {
        $theatre = $show->theatre;
        $movie = $show->movie;

        $bookedSeats = $show->getBookedSeats();

        return view('booking.select-seats', compact('show', 'theatre', 'movie', 'bookedSeats'));
    }

    public function confirmBooking(Request $request, Show $show)
    {
        $validated = $request->validate([
            'seat_number' => 'required|string',
        ]);

        $seats = array_map('trim', explode(',', $validated['seat_number']));
        $seatNumber = implode(', ', $seats);

        $bookedSeats = $show->getBookedSeats();

        foreach ($seats as $s) {
            $s = trim($s);
            if (in_array($s, $bookedSeats)) {
                return back()->with('error', "Seat {$s} is already booked!");
            }
        }

        $totalPrice = $show->price * count($seats);

        return view('booking.confirm', compact('show', 'seatNumber', 'totalPrice'));
    }

    public function store(Request $request, Show $show)
    {
        $validated = $request->validate([
            'seat_number' => 'required|string',
        ]);

        $seats = array_map('trim', explode(',', $validated['seat_number']));

        $bookedSeats = $show->getBookedSeats();

        foreach ($seats as $seatNumber) {
            if (in_array($seatNumber, $bookedSeats)) {
                return back()->with('error', "Seat {$seatNumber} is already booked!");
            }
        }

        $bookings = [];
        foreach ($seats as $seatNumber) {
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'show_id' => $show->id,
                'seat_number' => $seatNumber,
                'total_price' => $show->price,
                'payment_status' => 'pending',
            ]);
            $bookings[] = $booking;
        }

        return redirect()->route('payment.checkout', ['booking' => $bookings[0]->id]);
    }

    public function downloadPDF(Booking $booking)
    {
        $booking->load('show.movie', 'show.theatre');
        $pdf = Pdf::loadView('booking.success', compact('booking'));
        return $pdf->download('ticket-' . $booking->id . '.pdf');
    }
}

