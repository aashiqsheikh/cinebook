# 🚀 Quick Start & Customization Snippets

## Quick Links

- 📄 Main File: [select-seats.blade.php](resources/views/booking/select-seats.blade.php)
- 📚 Full Docs: [SEAT_SELECTION_UPGRADE.md](SEAT_SELECTION_UPGRADE.md)

---

## ⚡ Quick Customizations

### 1. Change Lock Duration (from 10 minutes)

**Location:** `resources/views/booking/select-seats.blade.php` - Search for `lockDuration`

```javascript
// Change this line (currently 10 minutes):
lockDuration: 10 * 60 * 1000,  // milliseconds

// Examples:
lockDuration: 5 * 60 * 1000,   // 5 minutes
lockDuration: 15 * 60 * 1000,  // 15 minutes
lockDuration: 3 * 60 * 1000,   // 3 minutes
```

---

### 2. Change VIP Rows (currently D & E)

**Location:** `resources/views/booking/select-seats.blade.php` - Search for `$vipRows`

```blade
// Original (D & E are premium):
$vipRows = ['D', 'E'];

// Make only top row VIP:
$vipRows = ['A'];

// Make first 3 rows VIP:
$vipRows = ['A', 'B', 'C'];

// No VIP seats:
$vipRows = [];
```

---

### 3. Change VIP Price Markup (currently 25%)

**Location:** `resources/views/booking/select-seats.blade.php` - Search for `$isVipRow ? $show->price`

```blade
// Original (1.25 = 25% more):
data-price="{{ $isVipRow ? $show->price * 1.25 : $show->price }}"

// Examples:
data-price="{{ $isVipRow ? $show->price * 1.5 : $show->price }}"   // 50% more
data-price="{{ $isVipRow ? $show->price * 1.10 : $show->price }}"  // 10% more
data-price="{{ $isVipRow ? $show->price * 2 : $show->price }}"     // Double price
```

---

### 4. Change Seat Layout (rows & seat count)

**Location:** `resources/views/booking/select-seats.blade.php` - Search for `$seatLayout = [`

```blade
// Original (46 total seats):
$seatLayout = [
    'A' => 10,
    'B' => 10,
    'C' => 10,
    'D' => 8,
    'E' => 8,
];

// Larger theatre (60 seats):
$seatLayout = [
    'A' => 12,
    'B' => 12,
    'C' => 12,
    'D' => 12,
    'E' => 12,
];

// Small theatre (20 seats):
$seatLayout = [
    'A' => 10,
    'B' => 10,
];

// 6-row theatre:
$seatLayout = [
    'A' => 10,
    'B' => 10,
    'C' => 10,
    'D' => 8,
    'E' => 8,
    'F' => 8,
];
```

---

### 5. Change Color Scheme

**Location:** `resources/views/booking/select-seats.blade.php` - Inside `<style>` section

#### Available Seat Color
```css
/* Find this section: */
.seat.available {
    background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
    /* ... other styles ... */
}

/* Change to your colors (example - green): */
.seat.available {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}
```

#### Selected Seat Color
```css
.seat.selected {
    background: linear-gradient(135deg, #eab308 0%, #facc15 100%);
}

/* Change to purple: */
.seat.selected {
    background: linear-gradient(135deg, #a855f7 0%, #d946ef 100%);
}
```

#### VIP Seat Color
```css
.seat.vip {
    background: linear-gradient(135deg, #d946ef 0%, #ec4899 100%);
}

/* Change to gold: */
.seat.vip {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
}
```

---

### 6. Change Seat Size

**Location:** `resources/views/booking/select-seats.blade.php` - Search for `.seat {`

```css
/* Original (44px × 44px): */
.seat {
    width: 2.75rem;
    height: 2.75rem;
}

/* Smaller seats (36px): */
.seat {
    width: 2.25rem;
    height: 2.25rem;
}

/* Larger seats (52px): */
.seat {
    width: 3.25rem;
    height: 3.25rem;
}

/* Responsive sizes - for tablet: */
@media (max-width: 768px) {
    .seat {
        width: 2.5rem;  /* Change this */
        height: 2.5rem;
    }
}
```

---

### 7. Change Animation Speed

**Location:** `resources/views/booking/select-seats.blade.php` - Search for `transition:`

```css
/* Original (300ms): */
transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);

/* Faster (150ms): */
transition: all 0.15s cubic-bezier(0.34, 1.56, 0.64, 1);

/* Slower (600ms): */
transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);

/* No animation: */
transition: none;
```

---

### 8. Disable VIP Seats Feature

If you don't want VIP seats at all:

```blade
@php
    // Comment out or remove:
    // $vipRows = ['D', 'E'];
    
    // Or set to empty:
    $vipRows = [];
@endphp
```

---

### 9. Change Maximum Seats Selection

Currently allows unlimited seats. To limit:

```javascript
// Find handleSeatClick function and add at start:
const MAX_SEATS = 6;  // Allow max 6 seats

if (index === -1 && state.selectedSeats.length >= MAX_SEATS) {
    showNotification(`Maximum ${MAX_SEATS} seats allowed`, 'warning');
    return;
}
```

---

### 10. Add All Rows as VIP

```blade
@php
    $vipRows = ['A', 'B', 'C', 'D', 'E'];  // All premium
@endphp
```

---

## 🎨 Color Palette Reference

### Preset Colors Ready to Use

**Blues (Already in available seats)**
```css
#0ea5e9  /* Cyan-500 */
#06b6d4  /* Cyan-600 */
```

**Yellows (Already in selected seats)**
```css
#eab308  /* Amber-500 */
#facc15  /* Amber-400 */
#fbbf24  /* Amber-400 */
#fcd34d  /* Amber-300 */
```

**Magentas (Already in VIP seats)**
```css
#d946ef  /* Fuchsia-500 */
#ec4899  /* Pink-500 */
```

**Greens (Good alternative)**
```css
#10b981  /* Emerald-600 */
#059669  /* Emerald-700 */
#34d399  /* Emerald-400 */
```

**Purples (Good alternative)**
```css
#a855f7  /* Violet-600 */
#d946ef  /* Fuchsia-500 */
#e879f9  /* Fuchsia-400 */
```

**Reds (Good alternative)**
```css
#f87171  /* Red-400 */
#ff6b6b  /* Red-500 */
#dc2626  /* Red-600 */
```

---

## 📱 Common Responsive Tweaks

### Make Seats Smaller on Mobile

```css
@media (max-width: 640px) {
    .seat {
        width: 1.75rem;   /* Was 2rem */
        height: 1.75rem;
        font-size: 0.5rem;
    }
}
```

### Increase Touch Target Size

```css
@media (max-width: 768px) {
    .seat {
        width: 2.5rem;    /* Increase for easier tapping */
        height: 2.5rem;
    }
}
```

### Stack Legend Horizontally

```css
/* Find .grid in legend and change: */
<div class="flex flex-wrap gap-3 justify-center">
    <!-- Legend items go here -->
</div>
```

---

## 🔧 Testing Customizations

After making changes, test:

1. **Desktop browser** - Press F12 to see console
2. **Mobile device** - Test on actual phone if possible
3. **Console tests:**
   ```javascript
   // Check state in browser console:
   console.log(state.selectedSeats);
   console.log(state.lockExpireTime);
   
   // Call functions manually:
   updateSummary();
   showNotification('Test message', 'warning');
   ```

---

## 🐛 Debug Mode

Add this at the end of JavaScript to enable debug logging:

```javascript
// Debug mode - add after line with 'console.log'
window.DEBUG = true;

// Patch updateLockTimer for logging:
const originalUpdate = updateLockTimer;
window.updateLockTimer = function() {
    if (DEBUG) console.log('Timer update:', lockTimerEl.textContent);
    return originalUpdate.apply(this, arguments);
};

// Patch updateSummary:
const originalSummary = updateSummary;
window.updateSummary = function() {
    if (DEBUG) console.log('Summary update:', state.selectedSeats, state.lockExpireTime);
    return originalSummary.apply(this, arguments);
};
```

---

## 🎯 Common Tweaks Collection

### Remove Timer Alert During Last Minute
```javascript
// In updateLockTimer(), find this:
if (timeRemaining < 60000) {
    timerContainer.classList.add('ring-2', 'ring-red-500/50');
}

// Replace with:
if (timeRemaining < 60000) {
    // timerContainer.classList.add('ring-2', 'ring-red-500/50'); // Commented out
}
```

### Disable Animations for Performance
```css
/* Add to <style> section: */
* {
    animation: none !important;
    transition: none !important;
}
```

### Make Selected Seats Larger
```css
.seat.selected {
    /* Already scaled to 1.15, increase to: */
    transform: scale(1.25);  /* Was 1.15 */
}
```

### Change Form Submit Button Color
```html
<!-- Find button element, change class: -->
<button class="... from-emerald-500 to-emerald-600 ...">
    <!-- Change to: -->
    <button class="... from-blue-500 to-blue-600 ...">
```

---

## 📋 File Structure

```
cinebook/
├── resources/views/booking/
│   └── select-seats.blade.php          ← Main file (all changes here)
├── app/Http/Controllers/
│   └── BookingController.php            ← No changes needed
├── app/Models/
│   ├── Show.php                         ← No changes needed
│   └── Booking.php                      ← No changes needed
├── SEAT_SELECTION_UPGRADE.md            ← Full documentation
└── QUICK_START.md                       ← This file
```

---

## ⚠️ Important Notes

1. **Don't forget to save** after editing the Blade file
2. **Clear cache** if changes don't appear:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```
3. **Test payment flow** after changes to ensure form still submits correctly
4. **Backup original** before major customizations:
   ```bash
   cp resources/views/booking/select-seats.blade.php resources/views/booking/select-seats.blade.php.backup
   ```

---

## 🤝 Support Quick Links

- **Issue with timer?** → Check `lockDuration` setting
- **Seats not updating?** → Check browser console (F12) for errors
- **Color not changing?** → Use browser inspector to verify CSS applies
- **Mobile layout broken?** → Check responsive breakpoints in media queries
- **Animation lag?** → Reduce `transition` timing or disable animations

---

## 📞 Need More Help?

Refer to [SEAT_SELECTION_UPGRADE.md](SEAT_SELECTION_UPGRADE.md) for comprehensive documentation on all features, implementation details, and troubleshooting.

Enjoy! 🎬🎫✨
