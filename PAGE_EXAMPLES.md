# Complete Page Examples - CineVerse UI Redesign

## 📄 Movies Listing Page Example

```blade
@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="mb-12">
    <h1 class="text-4xl font-bold text-white mb-2">Browse Movies</h1>
    <p class="text-slate-400">Discover the latest releases and trending films</p>
</div>

<!-- Filter Bar -->
<div class="bg-slate-800 border border-slate-700 rounded-xl p-6 mb-8">
    <div class="grid md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-slate-200 mb-2">Genre</label>
            <select class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white">
                <option>All Genres</option>
                <option>Action</option>
                <option>Drama</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-200 mb-2">Language</label>
            <select class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white">
                <option>All Languages</option>
                <option>English</option>
                <option>Hindi</option>
            </select>
        </div>
        <div class="flex items-end gap-2">
            <button class="btn btn-primary w-full">Filter</button>
            <button class="btn btn-secondary w-full">Reset</button>
        </div>
    </div>
</div>

<!-- Movies Grid -->
<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($movies as $movie)
    <a href="{{ route('movies.show', $movie->id) }}" class="group">
        <div class="bg-slate-800 border border-slate-700 rounded-xl overflow-hidden hover:border-red-600 transition-colors">
            <!-- Poster -->
            <div class="aspect-video bg-slate-700 overflow-hidden group-hover:opacity-90 transition-opacity">
                @if($movie->poster_url)
                    <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-4xl">🎬</div>
                @endif
            </div>
            
            <!-- Info -->
            <div class="p-4">
                <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-red-500 transition-colors">
                    {{ $movie->title }}
                </h3>
                <p class="text-sm text-slate-400 mb-3">{{ $movie->duration }} mins • {{ $movie->genre }}</p>
                
                <!-- Rating -->
                <div class="flex items-center gap-2 mb-4">
                    <div class="flex gap-1">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 {{ $i < floor($movie->rating ?? 0) ? 'text-yellow-500' : 'text-slate-600' }}" 
                                 fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-sm text-slate-400">{{ $movie->rating ?? 'N/A' }}</span>
                </div>
                
                <button class="btn btn-primary w-full">Book Now</button>
            </div>
        </div>
    </a>
    @endforeach
</div>

<!-- Pagination -->
<div class="flex items-center justify-between mt-12">
    <a href="{{ $movies->previousPageUrl() }}" class="btn btn-secondary">← Previous</a>
    <div class="flex gap-2">
        @for($i = 1; $i <= $movies->lastPage(); $i++)
            <button class="w-10 h-10 {{ $i === $movies->currentPage() ? 'bg-red-600' : 'bg-slate-800 hover:bg-slate-700' }} text-white rounded-lg font-medium transition-colors">
                {{ $i }}
            </button>
        @endfor
    </div>
    <a href="{{ $movies->nextPageUrl() }}" class="btn btn-secondary">Next →</a>
</div>
@endsection
```

---

## 🎫 Booking Selection Page Example

```blade
@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="mb-8">
    <a href="{{ route('movies.index') }}" class="inline-flex items-center gap-2 text-red-500 hover:text-red-400 mb-4 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Movies
    </a>
    <h1 class="text-4xl font-bold text-white">Select Seats</h1>
    <p class="text-slate-400 mt-2">Choose your preferred seats for this showing</p>
</div>

<!-- Main Content Grid -->
<div class="grid lg:grid-cols-3 gap-8">
    <!-- Seating Chart (Left) -->
    <div class="lg:col-span-2">
        <div class="bg-slate-800 border border-slate-700 rounded-xl p-8">
            <!-- Screen -->
            <div class="text-center mb-8">
                <div class="inline-block px-6 py-2 bg-slate-700 rounded-lg text-slate-300 text-sm font-medium">
                    SCREEN
                </div>
            </div>

            <!-- Seats Grid -->
            <div class="grid grid-cols-10 gap-3 justify-items-center mb-8">
                @for($row = 1; $row <= 10; $row++)
                    @for($col = 65; $col <= 75; $col++)
                        @php $seat = chr($col) . $row; @endphp
                        <button class="w-8 h-8 rounded-lg transition-all {{ in_array($seat, $bookedSeats ?? []) ? 'bg-slate-600 cursor-not-allowed opacity-50' : 'bg-green-600 hover:bg-red-600' }}" 
                                {{ in_array($seat, $bookedSeats ?? []) ? 'disabled' : '' }}>
                            {{ substr($seat, 0, 1) }}
                        </button>
                    @endfor
                @endfor
            </div>

            <!-- Legend -->
            <div class="flex gap-6 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-green-600 rounded"></div>
                    <span class="text-slate-300">Available</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-red-600 rounded"></div>
                    <span class="text-slate-300">Selected</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-slate-600 rounded"></div>
                    <span class="text-slate-300">Booked</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Summary (Right) -->
    <div>
        <div class="bg-slate-800 border border-slate-700 rounded-xl p-6 sticky top-24">
            <h3 class="text-2xl font-bold text-white mb-6">Booking Summary</h3>

            <!-- Movie Info -->
            <div class="border-b border-slate-700 pb-6 mb-6">
                <h4 class="font-semibold text-white mb-2">{{ $movie->title }}</h4>
                <p class="text-sm text-slate-400 mb-3">{{ $show->show_date->format('l, F d') }}</p>
                <p class="text-sm text-slate-400">{{ $show->show_time->format('h:i A') }}</p>
            </div>

            <!-- Selected Seats -->
            <div class="border-b border-slate-700 pb-6 mb-6">
                <p class="text-sm text-slate-300 mb-3">
                    Seats: <span class="text-white font-semibold" id="selected-seats">None</span>
                </p>
                <p class="text-sm text-slate-300">
                    Price: <span class="text-white font-semibold">₹{{ $show->price }}</span> per seat
                </p>
            </div>

            <!-- Total -->
            <div class="mb-6 pb-6 border-b border-slate-700">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-slate-300">Subtotal:</span>
                    <span class="text-white" id="subtotal">₹0</span>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-slate-300">Taxes & Fees:</span>
                    <span class="text-white" id="taxes">₹0</span>
                </div>
                <div class="flex justify-between items-center text-xl">
                    <span class="font-semibold text-white">Total:</span>
                    <span class="text-red-500 font-bold" id="total">₹0</span>
                </div>
            </div>

            <!-- Proceed Button -->
            <a href="{{ route('booking.confirm', $booking->id) }}" class="btn btn-primary w-full">
                Continue to Payment
            </a>
            <a href="{{ route('movies.index') }}" class="btn btn-secondary w-full mt-3">
                Cancel
            </a>
        </div>
    </div>
</div>
@endsection
```

---

## 💳 Payment Checkout Page Example

```blade
@extends('layouts.app')

@section('content')
<!-- Back Link -->
<a href="{{ route('booking.select-seats', $booking->id) }}" class="inline-flex items-center gap-2 text-red-500 hover:text-red-400 mb-8 transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
    </svg>
    Back
</a>

<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <h1 class="text-4xl font-bold text-white mb-8">Payment Details</h1>

    <!-- Booking Summary Card -->
    <div class="bg-slate-800 border border-slate-700 rounded-xl p-8 mb-8">
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <p class="text-slate-400 text-sm mb-1">Movie</p>
                <p class="text-xl font-semibold text-white">{{ $movie->title }}</p>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Venue</p>
                <p class="text-xl font-semibold text-white">{{ $theatre->name }}</p>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Date & Time</p>
                <p class="text-xl font-semibold text-white">
                    {{ $show->show_date->format('D, M d') }} • {{ $show->show_time->format('h:i A') }}
                </p>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Seats</p>
                <p class="text-xl font-semibold text-white">{{ $booking->seat_number }}</p>
            </div>
        </div>
    </div>

    <!-- Price Breakdown -->
    <div class="bg-slate-800 border border-slate-700 rounded-xl p-8 mb-8">
        <h3 class="text-lg font-semibold text-white mb-4">Price Breakdown</h3>
        <div class="space-y-3">
            <div class="flex justify-between text-slate-300">
                <span>Ticket × 1</span>
                <span>₹{{ $booking->total_price }}</span>
            </div>
            <div class="flex justify-between text-slate-300">
                <span>Convenience Fee</span>
                <span>₹50</span>
            </div>
            <div class="border-t border-slate-700 pt-3 flex justify-between text-white text-lg font-semibold">
                <span>Total Amount</span>
                <span>₹{{ $booking->total_price + 50 }}</span>
            </div>
        </div>
    </div>

    <!-- Payment Method -->
    <div class="bg-slate-800 border border-slate-700 rounded-xl p-8 mb-8">
        <h3 class="text-lg font-semibold text-white mb-4">Payment Method</h3>
        <div class="bg-slate-700 rounded-lg p-4 text-center">
            <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24">
                <!-- Razorpay logo or payment icon -->
            </svg>
            <p class="text-white font-semibold">Secure Payment via Razorpay</p>
            <p class="text-sm text-slate-400 mt-1">PCI DSS Compliant</p>
        </div>
    </div>

    <!-- Payment Button -->
    <button id="pay-button" class="btn btn-primary w-full py-3 text-lg">
        Proceed to Payment
    </button>
    
    <p class="text-center text-slate-400 text-sm mt-4">
        By proceeding, you agree to our terms and conditions
    </p>
</div>

<script>
    document.getElementById('pay-button').addEventListener('click', function() {
        // Initialize Razorpay payment
    });
</script>
@endsection
```

---

## 📋 Admin Management Page Example

```blade
@extends('layouts.admin')

@section('content')
<!-- Header with Action Button -->
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-4xl font-bold text-white mb-2">Manage Movies</h1>
        <p class="text-slate-400">Create and manage your movie catalog</p>
    </div>
    <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Movie
    </a>
</div>

<!-- Table -->
<div class="bg-slate-800 border border-slate-700 rounded-xl overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-700 border-b border-slate-600">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-200">Title</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-200">Genre</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-200">Duration</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-200">Rating</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-200">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-200">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-700">
            @foreach($movies as $movie)
            <tr class="hover:bg-slate-700/50 transition-colors">
                <td class="px-6 py-4 text-slate-200">{{ $movie->title }}</td>
                <td class="px-6 py-4 text-slate-400 text-sm">{{ $movie->genre }}</td>
                <td class="px-6 py-4 text-slate-400 text-sm">{{ $movie->duration }} min</td>
                <td class="px-6 py-4">
                    <div class="flex gap-0.5">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 {{ $i < floor($movie->rating ?? 0) ? 'text-yellow-500' : 'text-slate-600' }}" 
                                 fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 bg-green-900/30 text-green-400 text-xs font-medium rounded-full">
                        Active
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-3">
                        <a href="{{ route('admin.movies.edit', $movie->id) }}" class="text-slate-400 hover:text-white transition-colors text-sm font-medium">
                            Edit
                        </a>
                        <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this movie?')" class="text-red-500 hover:text-red-400 transition-colors text-sm font-medium">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="flex items-center justify-between mt-8">
    <a href="{{ $movies->previousPageUrl() }}" class="btn btn-secondary">← Previous</a>
    <div class="flex gap-2">
        @for($i = 1; $i <= $movies->lastPage(); $i++)
            <a href="{{ $movies->url($i) }}" 
               class="w-10 h-10 {{ $i === $movies->currentPage() ? 'bg-red-600' : 'bg-slate-800 hover:bg-slate-700' }} text-white rounded-lg font-medium transition-colors flex items-center justify-center">
                {{ $i }}
            </a>
        @endfor
    </div>
    <a href="{{ $movies->nextPageUrl() }}" class="btn btn-secondary">Next →</a>
</div>
@endsection
```

---

## 📝 Form Page Example

```blade
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <h1 class="text-4xl font-bold text-white mb-8">Edit Profile</h1>

    <!-- Form Card -->
    <div class="bg-slate-800 border border-slate-700 rounded-xl p-8 mb-8">
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf @method('PATCH')

            <!-- Name Field -->
            <div class="form-group">
                <label for="name" class="block text-sm font-medium text-slate-200 mb-2">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', Auth::user()->name) }}"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:border-red-600 focus:outline-none transition-colors" 
                />
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-slate-200 mb-2">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', Auth::user()->email) }}"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:border-red-600 focus:outline-none transition-colors" 
                />
                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Field -->
            <div class="form-group">
                <label for="phone" class="block text-sm font-medium text-slate-200 mb-2">Phone Number</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone', Auth::user()->phone) }}"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:border-red-600 focus:outline-none transition-colors" 
                />
                @error('phone')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4 border-t border-slate-700">
                <button type="submit" class="btn btn-primary flex-1">Save Changes</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary flex-1 text-center">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="bg-red-900/20 border border-red-600/50 rounded-xl p-8">
        <h3 class="text-lg font-semibold text-red-400 mb-4">Danger Zone</h3>
        <p class="text-slate-400 text-sm mb-4">
            Once you delete your account, there is no going back. Please be certain.
        </p>
        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-secondary bg-red-900 hover:bg-red-800 border-red-600">
                Delete Account
            </button>
        </form>
    </div>
</div>
@endsection
```

---

## ✅ Implementation Checklist

When updating pages, ensure:

- [ ] Remove all gradient backgrounds
- [ ] Remove shadow-2xl, shadow-xl classes
- [ ] Use `.btn` base class for buttons
- [ ] Wrap forms in card with proper spacing
- [ ] Use consistent gap and padding (4, 6, 8)
- [ ] Replace input styling with form-group pattern
- [ ] Test on mobile (md, lg breakpoints)
- [ ] Verify color contrast
- [ ] Remove backdrop-blur effects
- [ ] Simplify animations/transitions
- [ ] Check typography hierarchy
- [ ] Verify responsive grid layouts

