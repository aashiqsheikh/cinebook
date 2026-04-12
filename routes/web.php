<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\TheatreController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

// Google OAuth Routes
Route::get('/auth/google', [GoogleController::class, 'redirectToProvider'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleProviderCallback']);

// City Selection Route (Public - No middleware)
Route::post('/select-city', [CityController::class, 'select'])->name('city.select');

// Auth Routes (Breeze)
require __DIR__.'/auth.php';


// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {

        if (\Illuminate\Support\Facades\Auth::user()->is_admin) {

            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');

    Route::post('/movies/{movie}/rate', [RatingController::class, 'store'])->name('ratings.store');
    Route::delete('/movies/{movie}/rate', [RatingController::class, 'destroy'])->name('ratings.destroy');

    Route::get('/book/{movie}/theatre', [BookingController::class, 'selectTheatre'])->name('booking.select-theatre');
    Route::get('/book/{movie}/showtime', [BookingController::class, 'selectShowtime'])->name('booking.select-showtime');
    Route::get('/book/show/{show}/seats', [BookingController::class, 'selectSeats'])->name('booking.select-seats');
    Route::post('/book/show/{show}/confirm', [BookingController::class, 'confirmBooking'])->name('booking.confirm');
    Route::post('/book/show/{show}', [BookingController::class, 'store'])->name('booking.store');

    Route::get('/bookings/{booking}/pdf', [BookingController::class, 'downloadPDF'])->name('bookings.pdf');

    Route::get('/payment/checkout/{booking}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/payment/initiate', [PaymentController::class, 'initiate'])->name('payment.initiate');
Route::post('/payment/create-order', [PaymentController::class, 'createOrder'])->name('payment.create-order');
Route::post('/payment/verify', [PaymentController::class, 'verify'])->name('payment.verify');
    Route::get('/payment/success/{booking}', [PaymentController::class, 'success'])->name('booking.success');
    Route::post('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/movies', [AdminController::class, 'movies'])->name('movies.index');
        Route::get('/movies/create', [AdminController::class, 'createMovie'])->name('movies.create');
        Route::post('/movies', [AdminController::class, 'storeMovie'])->name('movies.store');
        Route::get('/movies/{movie}/edit', [AdminController::class, 'editMovie'])->name('movies.edit');
        Route::put('/movies/{movie}', [AdminController::class, 'updateMovie'])->name('movies.update');
        Route::delete('/movies/{movie}', [AdminController::class, 'destroyMovie'])->name('movies.destroy');

        Route::get('/theatres', [TheatreController::class, 'index'])->name('theatres.index');
        Route::get('/theatres/create', [TheatreController::class, 'create'])->name('theatres.create');
        Route::post('/theatres', [TheatreController::class, 'store'])->name('theatres.store');
        Route::get('/theatres/{theatre}/edit', [TheatreController::class, 'edit'])->name('theatres.edit');
        Route::put('/theatres/{theatre}', [TheatreController::class, 'update'])->name('theatres.update');
        Route::delete('/theatres/{theatre}', [TheatreController::class, 'destroy'])->name('theatres.destroy');

        Route::get('/shows', [ShowController::class, 'index'])->name('shows.index');
        Route::get('/shows/create', [ShowController::class, 'create'])->name('shows.create');
        Route::post('/shows', [ShowController::class, 'store'])->name('shows.store');
        Route::get('/shows/{show}/edit', [ShowController::class, 'edit'])->name('shows.edit');
        Route::put('/shows/{show}', [ShowController::class, 'update'])->name('shows.update');
        Route::delete('/shows/{show}', [ShowController::class, 'destroy'])->name('shows.destroy');

        Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings.index');
    });
});

