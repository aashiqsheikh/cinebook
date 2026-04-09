<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation - CineVerse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 40px;
        }
        .booking-info {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .ticket-id {
            font-size: 24px;
            font-weight: bold;
            color: #e94560;
            text-align: center;
            margin: 20px 0;
        }
        .movie-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 20px 0;
        }
        .movie-title {
            font-size: 22px;
            font-weight: 600;
            color: #1a1a2e;
        }
        .show-details {
            background: white;
            padding: 20px;
            border-left: 5px solid #e94560;
            margin: 20px 0;
        }
        .status {
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            display: inline-block;
        }
        .status.confirmed {
            background: #d4edda;
            color: #155724;
        }
        .footer {
            background: #1a1a2e;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            background: #e94560;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            margin: 10px;
            transition: background 0.3s;
        }
        @media (max-width: 600px) {
            .content {
                padding: 20px;
            }
            .movie-info {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-ticket-alt"></i> CineVerse</h1>
            <p>Your Movie Experience Awaits!</p>
        </div>

        <div class="content">
            <h2>🎉 Booking Confirmed!</h2>
            <p>Thank you for booking with CineVerse. We're excited to see you at the movies!</p>

            <div class="ticket-id">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>

            <div class="booking-info">
                <h3><i class="fas fa-film me-2"></i>{{ $booking->show->movie->title }}</h3>
                <div class="movie-info">
                    @if($booking->show->movie->poster)
                        <img src="{{ asset($booking->show->movie->poster) }}" alt="{{ $booking->show->movie->title }}" style="width: 80px; height: 120px; object-fit: cover; border-radius: 8px;">
                    @endif
                    <div>
                        <div class="movie-title">{{ $booking->show->movie->title }}</div>
                        <small class="text-muted">
                            <i class="fas fa-building me-1"></i>{{ $booking->show->theatre->name }}<br>
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $booking->show->theatre->location }}
                        </small>
                    </div>
                </div>

                <div class="show-details">
                    <h5><i class="fas fa-calendar-day me-2"></i>Show Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Date:</strong> {{ \App\Helpers\DateHelper::formatEmailDate($booking->show->show_date) }}<br>
                            <strong>Time:</strong> {{ \App\Helpers\DateHelper::formatTime24Hour($booking->show->show_time) }}<br>
                            <strong>Seat:</strong> {{ $booking->seat_number }}
                        </div>
                        <div class="col-md-6">
                            <strong>Amount:</strong> ₹{{ number_format($booking->total_price, 2) }}<br>
                            <strong>Payment ID:</strong> {{ $booking->payment_id ?? 'TBD' }}<br>
                            <span class="status confirmed"><i class="fas fa-check-circle me-1"></i>Confirmed</span>
                        </div>
                    </div>
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ url('/bookings/my') }}" class="btn">View My Bookings</a>
                    <a href="{{ url('/') }}" class="btn" style="background: #6c757d;">Book More Tickets</a>
                </div>

                <div style="background: #fff3cd; padding: 15px; border-radius: 8px; border-left: 4px solid #ffc107;">
                    <strong>📱 Important:</strong> Please carry this email or screenshot along with a valid ID to the theatre. Arrive 15 minutes early.
                </div>
            </div>

            <p style="color: #666; font-size: 14px;">
                Need help? Contact us at <a href="mailto:support@cineverse.com">support@cineverse.com</a> or call 1800-CINEVERSE
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} CineVerse. All rights reserved. | Enjoy the movie!</p>
        </div>
    </div>
</body>
</html>

