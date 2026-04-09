<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Mail\BookingConfirmation;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Razorpay\Api\Exceptions\SignatureVerificationError;

class PaymentController extends Controller
{
    private $api;

    public function __construct()
    {
        $keyId = env('RAZORPAY_KEY_ID');
        $keySecret = env('RAZORPAY_KEY_SECRET');
        $this->api = new Api($keyId, $keySecret);
    }

    /**
     * Create Razorpay order for inline payment
     */
    public function createOrder(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id'
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        if ($booking->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($booking->payment_status !== 'pending') {
            return response()->json(['error' => 'Booking not pending'], 400);
        }

        try {
            $amount = (int) ($booking->total_price * 100);

            $orderData = [
                'receipt' => 'booking_' . $booking->id,
                'amount' => $amount,
                'currency' => 'INR'
            ];

            $razorpayOrder = $this->api->order->create($orderData);

            $booking->razorpay_order_id = $razorpayOrder['id'];
            $booking->save();

            \Log::info('Order created: ' . $razorpayOrder['id'] . ' for booking: ' . $booking->id);

            return response()->json([
                'order_id' => $razorpayOrder['id'],
                'amount' => $amount,
                'key' => env('RAZORPAY_KEY_ID'),
                'currency' => 'INR'
            ]);
        } catch (\Exception $e) {
            \Log::error('Order creation failed: ' . $e->getMessage());
            return response()->json([
                'error' => 'Order creation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display payment checkout page + create Razorpay order.
     */
    public function checkout(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Invalid booking!');
        }

        if ($booking->payment_status === 'paid') {
            return redirect()->route('booking.success', $booking->id);
        }

        if ($booking->razorpay_order_id) {
            // Order already created
        } else {
            // Create Razorpay Order
            $amount = (int) ($booking->total_price * 100); // paise

            $orderData = [
                'receipt'         => 'booking_' . $booking->id,
                'amount'          => $amount, // paise
                'currency'        => 'INR',
                'payment_capture' => 1 // Auto capture
            ];

            try {
                $razorpayOrder = $this->api->order->create($orderData);
                $booking->update(['razorpay_order_id' => $razorpayOrder['id']]);
            } catch (\Exception $e) {
                return redirect()->route('bookings.my')->with('error', 'Payment initialization failed: ' . $e->getMessage());
            }
        }

        $show = $booking->show;
        $movie = $show->movie;
        $theatre = $show->theatre;
        $razorpayKey = env('RAZORPAY_KEY_ID');

        return view('payment.checkout', compact('booking', 'show', 'movie', 'theatre', 'razorpayKey'));
    }

    /**
     * Verify Razorpay payment signature.
     */
    public function verify(Request $request)
    {
        $bookingId = $request->booking_id;
        $booking = Booking::findOrFail($bookingId);

        if ($booking->user_id !== Auth::id() || $booking->payment_status !== 'pending') {
            return response()->json(['error' => 'Invalid booking'], 403);
        }

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        try {
            $this->api->utility->verifyPaymentSignature($attributes);
        } catch (SignatureVerificationError $e) {
            $booking->update(['payment_status' => 'failed']);
            return response()->json(['error' => 'Payment verification failed'], 400);
        }

        // Payment verified, update booking
        $booking->update([
            'payment_id' => $request->razorpay_payment_id,
            'payment_status' => 'paid',
        ]);

        Mail::to($booking->user->email)->send(new BookingConfirmation($booking));

        return response()->json(['success' => true, 'redirect' => route('booking.success', $booking->id)]);
    }

    /**
     * Payment success page (QR ticket).
     */
    public function success(Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || $booking->payment_status !== 'paid') {
            return redirect()->route('bookings.my')->with('error', 'Payment not completed!');
        }

        $show = $booking->show;
        $movie = $show->movie;
        $theatre = $show->theatre;

        $qrData = [
            'booking_id' => $booking->id,
            'movie' => $movie->title,
            'theatre' => $theatre->name,
            'show_time' => $show->show_date->format('Y-m-d') . ' ' . $show->show_time->format('H:i:s'),
            'seats' => $booking->seat_number,
            'user_email' => $booking->user->email
        ];

        return view('booking.success', compact('booking', 'show', 'movie', 'theatre', 'qrData'));
    }

    /**
     * Handle payment failure.
     */
    public function failure(Request $request)
    {
        $bookingId = $request->booking_id ?? $request->get('booking_id');
        $booking = Booking::findOrFail($bookingId);

        $booking->update(['payment_status' => 'failed']);

        return redirect()->route('bookings.my')->with('error', 'Payment failed. Please try again.');
    }
}

