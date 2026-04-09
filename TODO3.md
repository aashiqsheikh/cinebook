# Razorpay Real Integration

## Steps:
- [ ] 1. composer require razorpay/razorpay
- [x] 2. Create migration add_razorpay_order_id_to_bookings_table
- [x] 3. Update app/Models/Booking.php fillable
- [x] 4. Update app/Http/Controllers/PaymentController.php (full)
- [x] 5. Add route POST payment.verify in routes/web.php
- [x] 6. Update resources/views/payment/checkout.blade.php
- [ ] 7. User add .env keys + php artisan migrate

Current: Step 1.
