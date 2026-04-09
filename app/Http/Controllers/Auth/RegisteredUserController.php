<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    /**
     * Send OTP to email for verification.
     */
    public function sendOtp(Request $request): RedirectResponse
    {
        $key = 'register-otp:' . $request->email;

        if (RateLimiter::tooManyAttempts($key, 6)) {
            throw ValidationException::withMessages([
                'email' => 'Too many OTP requests. Try again later.',
            ]);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
        ]);

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expires = now()->addMinutes(5);

        session([
            'register_otp' => $otp,
            'register_otp_email' => $request->email,
            'register_otp_data' => $request->only(['name', 'password']),
            'register_otp_expires' => $expires,
        ]);

        Mail::to($request->email)->send(new \App\Mail\OtpMail($otp));

        RateLimiter::hit($key, 60);

        return back()->with('status', 'otp-sent');
    }

    /**
     * Verify OTP and complete registration.
     */
    public function verifyOtpAndRegister(Request $request): RedirectResponse
    {
        $request->validate(['otp' => 'required|string|size:6']);

        $otp = $request->otp;
        $sessionOtp = session('register_otp');
        $sessionEmail = session('register_otp_email');
        $expires = session('register_otp_expires');
        $data = session('register_otp_data');

        if (!$sessionOtp || $otp !== $sessionOtp || now()->gt($expires) || !$data || $request->email !== $sessionEmail) {
            // Invalidate session
            request()->session()->forget(['register_otp', 'register_otp_email', 'register_otp_data', 'register_otp_expires']);

            throw ValidationException::withMessages([
                'otp' => 'Invalid or expired OTP.',
            ]);
        }

        // Create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $sessionEmail,
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        // Clear session
        request()->session()->forget(['register_otp', 'register_otp_email', 'register_otp_data', 'register_otp_expires']);

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Original store (kept as fallback).
     */
    public function store(Request $request): RedirectResponse
    {
$request->validateWithBag('createAccount', [
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
