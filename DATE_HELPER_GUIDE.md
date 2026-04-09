# 📅 DateHelper - Reusable Date Formatting System

## Overview

The `DateHelper` is a centralized, reusable helper class for consistent date and time formatting across the CineBook application. It eliminates scattered `->format()` calls throughout Blade templates and provides:

- ✅ **Consistency**: Same format used everywhere
- ✅ **Maintainability**: Change format in one place, update everywhere
- ✅ **Simplicity**: Self-documenting method names
- ✅ **Error Handling**: Graceful fallbacks if parsing fails
- ✅ **Flexibility**: Custom formats supported

---

## File Location

```
app/Helpers/DateHelper.php
```

## Service Provider Registration

The helper is automatically registered in:
```
app/Providers/AppServiceProvider.php
```

No additional setup required!

---

## Basic Usage

### In Blade Templates

```blade
<!-- Simple usage - uses default format -->
{{ DateHelper::formatDate($date) }}

<!-- With custom format -->
{{ DateHelper::formatDate($date, 'Y-m-d') }}

<!-- Shorthand methods (recommended) -->
{{ DateHelper::formatDateShort($date) }}      <!-- Apr 03 -->
{{ DateHelper::formatDateLong($date) }}       <!-- Wednesday, April 03, 2026 -->
{{ DateHelper::formatShowDate($date) }}       <!-- ddd, MMM DD -->
{{ DateHelper::formatReleaseDate($date) }}    <!-- MMM DD, YYYY -->
{{ DateHelper::formatAdminDate($date) }}      <!-- d M Y -->
```

### In Controllers/Models

```php
use App\Helpers\DateHelper;

class BookingController extends Controller
{
    public function show(Booking $booking)
    {
        $date = DateHelper::formatDate($booking->created_at);
        $time = DateHelper::formatTime($booking->show->show_time);
        
        return view('booking.show', compact('date', 'time'));
    }
}
```

---

## Available Methods

### Date Formatting

| Method | Format | Example | Use Case |
|--------|--------|---------|----------|
| `formatDate($date)` | 'D, d M Y' | Wed, 03 Apr 2026 | Default general use |
| `formatDateShort($date)` | 'M d' | Apr 03 | Compact display |
| `formatDateLong($date)` | 'l, F d, Y' | Wednesday, April 03, 2026 | Full formal dates |
| `formatDateFull($date)` | 'D, d M Y' | Wed, 03 Apr 2026 | Standard display |
| `formatShowDate($date)` | 'ddd, MMM DD' | Wed, Apr 03 | Seat booking pages |
| `formatReleaseDate($date)` | 'MMM DD, YYYY' | Apr 03, 2026 | Movie release dates |
| `formatAdminDate($date)` | 'd M Y' | 03 Apr 2026 | Admin tables |
| `formatMonthYear($date)` | 'M Y' | Apr 2026 | Archive pages |
| `formatDateISO($date)` | 'Y-m-d' | 2026-04-03 | HTML date inputs, databases |
| `formatEmailDate($date)` | 'l, d M Y' | Wednesday, 03 Apr 2026 | Email templates |

### Time Formatting

| Method | Format | Example | Use Case |
|--------|--------|---------|----------|
| `formatTime($time)` | 'h:mm A' | 7:30 PM | Default 12-hour |
| `formatTime12Hour($time)` | 'h:i A' | 7:30 PM | 12-hour format |
| `formatTime24Hour($time)` | 'H:i' | 19:30 | 24-hour format |

### DateTime Combining

| Method | Format | Example |
|--------|--------|---------|
| `formatDateTime($date, $time)` | Combined | Apr 03 • 7:30 PM |

### Custom Format

```php
DateHelper::formatDate($date, 'custom format string')
DateHelper::formatTime($time, 'custom format string')
```

---

## Format String Reference

### Common Date Formats

```
d    → 03 (day of month, 2 digits)
D    → Wed (short day name)
l    → Wednesday (full day name)
m    → 04 (month number, 2 digits)
M    → Apr (short month name)
F    → April (full month name)
Y    → 2026 (4-digit year)
y    → 26 (2-digit year)

Examples:
'd M Y'          → 03 Apr 2026
'D, M d'         → Wed, Apr 03
'l, F d, Y'      → Wednesday, April 03, 2026
'ddd, MMM DD'    → Wed, Apr 03
'Y-m-d'          → 2026-04-03
```

### Common Time Formats

```
h    → 07 (12-hour, 2 digits)
H    → 19 (24-hour, 2 digits)
i    → 30 (minutes)
s    → 45 (seconds)
A    → PM (AM/PM)
a    → pm (am/pm)

Examples:
'h:mm A'         → 7:30 PM
'h:i A'          → 7:30 PM
'H:i'            → 19:30
'H:i:s'          → 19:30:45
```

---

## Real-World Examples

### Seat Selection Page
```blade
<!-- Before -->
<p>{{ $show->show_date->format('ddd, MMM DD') }}</p>
<p>{{ $show->show_time->format('h:mm A') }}</p>

<!-- After -->
<p>{{ DateHelper::formatShowDate($show->show_date) }}</p>
<p>{{ DateHelper::formatTime($show->show_time) }}</p>
```

### Booking Confirmation Email
```blade
<!-- Before -->
<strong>Date:</strong> {{ $booking->show->show_date->format('l, d M Y') }}<br>
<strong>Time:</strong> {{ $booking->show->show_time->format('h:i A') }}<br>

<!-- After -->
<strong>Date:</strong> {{ DateHelper::formatEmailDate($booking->show->show_date) }}<br>
<strong>Time:</strong> {{ DateHelper::formatTime24Hour($booking->show->show_time) }}<br>
```

### Movie Index Page
```blade
<!-- Before -->
{{ $movie->duration }} mins • {{ \Carbon\Carbon::parse($movie->release_date)->format('M Y') }}

<!-- After -->
{{ $movie->duration }} mins • {{ DateHelper::formatMonthYear($movie->release_date) }}
```

### Admin Form
```blade
<!-- Before -->
<input type="date" value="{{ old('release_date', $movie->release_date->format('Y-m-d')) }}">

<!-- After -->
<input type="date" value="{{ old('release_date', DateHelper::formatDateISO($movie->release_date)) }}">
```

### Dashboard Table
```blade
<!-- Before -->
<td>{{ \Carbon\Carbon::parse($booking->show->show_date)->format('d M Y') }}</td>

<!-- After -->
<td>{{ DateHelper::formatAdminDate($booking->show->show_date) }}</td>
```

---

## Key Features

### 1. Error Handling
```php
// Handles null or invalid dates gracefully
DateHelper::formatDate(null)        // Returns empty string
DateHelper::formatDate('invalid')   // Logs warning, returns original string
```

### 2. Automatic Carbon Parsing
```php
// All formats accept multiple input types
DateHelper::formatDate('2026-04-03')        // String
DateHelper::formatDate($carbonInstance)     // Carbon instance
DateHelper::formatDate($dateObject)         // DateTime instance
DateHelper::formatDate(now())               // Now helper
```

### 3. Localization Ready
```php
// All Carbon formats respect your locale
// Change in config/app.php:
'locale' => 'es', // Spanish
// Automatically affects all DateHelper outputs
```

---

## Migration Guide

### Step 1: Identify all ->format() calls
Find all instances in your Blade files:
```bash
grep -r "->format(" resources/views/
```

### Step 2: Replace with DateHelper
```blade
<!-- Old -->
{{ $date->format('M d, Y') }}

<!-- New -->
{{ DateHelper::formatDate($date, 'M d, Y') }}
```

### Step 3: Use shorthand when available
```blade
<!-- If using standard format -->
{{ DateHelper::formatReleaseDate($movie->release_date) }}
```

---

## Best Practices

### ✅ DO

1. **Use shorthand methods** when available
   ```php
   DateHelper::formatShowDate($date)  // ✅ Clear intent
   DateHelper::formatDate($date, 'ddd, MMM DD')  // ❌ Less clear
   ```

2. **Pass raw data from models**
   ```php
   DateHelper::formatDate($movie->release_date)  // ✅
   ```

3. **Use consistent formatting** across similar pages
   ```php
   // All movie pages use same format
   formatReleaseDate()
   ```

4. **Extend with new methods** if pattern repeats
   ```php
   // If multiple files use 'D, M d':
   public static function formatCustom($date): string
   {
       return static::formatDate($date, 'D, M d');
   }
   ```

### ❌ DON'T

1. **Mix formatting methods**
   ```php
   // ❌ Don't mix
   {{ $date->format('M d') }}
   {{ DateHelper::formatDate($date, 'M d') }}
   
   // ✅ Do use consistently
   {{ DateHelper::formatDateShort($date) }}
   ```

2. **Create local helpers**
   ```php
   // ❌ Don't do this in templates
   @php $date = $movie->release_date->format('M Y'); @endphp
   
   // ✅ Use the helper
   {{ DateHelper::formatMonthYear($movie->release_date) }}
   ```

3. **Hardcode Carbon in views**
   ```php
   // ❌ Don't hardcode Carbon
   {{ \Carbon\Carbon::parse($date)->format(...) }}
   
   // ✅ Always use the helper
   {{ DateHelper::formatDate($date) }}
   ```

---

## Adding New Format Methods

### Example: Add custom format for upcoming shows

```php
// In app/Helpers/DateHelper.php

public static function formatUpcomingShow($date): string
{
    // Tomorrow format: "Tomorrow at 7:30 PM"
    // Next week: "Wed, Apr 10"
    $carbonDate = Carbon::parse($date);
    
    if ($carbonDate->isToday()) {
        return 'Today';
    } elseif ($carbonDate->isTomorrow()) {
        return 'Tomorrow';
    } else {
        return static::formatDate($date, 'D, M d');
    }
}
```

Then use in templates:
```blade
{{ DateHelper::formatUpcomingShow($show->show_date) }}
```

---

## Integration with Blade Directives

Custom Blade directives are available (optional):

```blade
<!-- Using directive -->
@formatDate($date)

<!-- Equivalent to -->
{{ DateHelper::formatDate($date) }}
```

---

## Testing

### Unit Test Example

```php
namespace Tests\Unit;

use App\Helpers\DateHelper;
use Carbon\Carbon;
use Tests\TestCase;

class DateHelperTest extends TestCase
{
    public function test_format_date_default()
    {
        $date = Carbon::parse('2026-04-03');
        $result = DateHelper::formatDate($date);
        
        $this->assertEquals('Fri, 03 Apr 2026', $result);
    }

    public function test_format_show_date()
    {
        $date = Carbon::parse('2026-04-03');
        $result = DateHelper::formatShowDate($date);
        
        $this->assertEquals('Fri, Apr 03', $result);
    }

    public function test_format_null_date()
    {
        $result = DateHelper::formatDate(null);
        $this->assertEquals('', $result);
    }
}
```

---

## Performance

- **Minimal overhead**: Methods are simple wrappers around Carbon
- **No caching needed**: Carbon handles caching internally
- **Lazy loaded**: Helper only instantiated when used

---

## Troubleshooting

### Format not working
**Problem**: Date shows as "Jan 01, 1970"
**Solution**: Check input is a valid date/Carbon instance
```php
DateHelper::formatDate(Carbon::parse($dateString))
```

### Locale not changing
**Problem**: Dates still in English
**Solution**: Ensure `config/app.php` locale is set before DateHelper is used
```php
// config/app.php
'locale' => 'es', // Spanish
```

### Method not found
**Problem**: `Call to undefined method DateHelper::formatCustomDate()`
**Solution**: Add the method to DateHelper class following the pattern

---

## Summary

| Aspect | Benefit |
|--------|---------|
| **Consistency** | Same format used everywhere |
| **Maintainability** | Change once, update everywhere |
| **Readability** | Self-documenting method names |
| **Flexibility** | Custom formats supported |
| **Error Handling** | Graceful fallbacks |
| **Performance** | Minimal overhead |
| **Type Safety** | Static methods, IDE autocomplete |

The DateHelper is now the single source of truth for all date/time formatting in CineBook! 📅✨
