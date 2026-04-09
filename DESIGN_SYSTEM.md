# CineVerse Design System

## 🎨 Color Palette

```
Primary Background: #0f172a (slate-900)
Secondary Background: #1e293b (slate-800)
Tertiary Background: #334155 (slate-700)
Border Color: #475569 (slate-600)
Text Primary: #ffffff (white)
Text Secondary: #cbd5e1 (slate-200)
Text Muted: #94a3b8 (slate-400)
Accent Color: #dc2626 (red-600)
Accent Hover: #b91c1c (red-700)
```

## 🔘 Buttons

### Primary Button
```html
<button class="btn btn-primary">Button Text</button>
```

**Styles:**
- Background: Red (#dc2626)
- Text: White
- Padding: 0.75rem 1.5rem
- Border Radius: 0.5rem
- On Hover: Darker red + slight scale + shadow

```css
.btn-primary {
    background-color: #dc2626;
    color: white;
    border: 1px solid #dc2626;
}

.btn-primary:hover {
    background-color: #b91c1c;
    border-color: #b91c1c;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}
```

### Secondary Button
```html
<button class="btn btn-secondary">Button Text</button>
```

**Styles:**
- Background: Slate-800
- Text: White
- Border: Slate-600
- On Hover: Slate-700 + Red border + Red text

```css
.btn-secondary {
    background-color: #1e293b;
    color: #ffffff;
    border: 1px solid #475569;
}

.btn-secondary:hover {
    background-color: #334155;
    border-color: #dc2626;
    color: #dc2626;
}
```

### Ghost Button
```html
<a href="#" class="btn btn-ghost">Link</a>
```

**Styles:**
- Background: Transparent
- Text: White
- Border: None
- On Hover: Red text

## 📝 Input Fields

### Basic Input
```html
<input type="text" placeholder="Enter text" />
```

**Styles:**
```css
input[type="text"],
input[type="email"],
input[type="password"],
textarea,
select {
    width: 100%;
    padding: 0.75rem 1rem;
    background-color: #1e293b;
    border: 1px solid #475569;
    border-radius: 0.5rem;
    color: #ffffff;
    transition: border-color 0.2s ease;
}

input:focus,
textarea:focus,
select:focus {
    outline: none;
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}
```

### Form Group
```html
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" />
</div>
```

**Styles:**
```css
.form-group {
    margin-bottom: 1.5rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #cbd5e1;
}
```

## 🎪 Cards

### Card
```html
<div class="card">
    <h3>Card Title</h3>
    <p>Card content goes here</p>
</div>
```

**Styles:**
```css
.card {
    background-color: #1e293b;
    border: 1px solid #475569;
    border-radius: 0.75rem;
    padding: 1.5rem;
}

.card-hover:hover {
    border-color: #dc2626;
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.15);
}
```

### Dashboard Card
```html
<a href="{{ route('movies.index') }}" class="group block bg-slate-800 hover:bg-slate-750 border border-slate-700 hover:border-red-600 rounded-xl p-8 transition-all duration-300">
    <div class="inline-flex w-14 h-14 bg-red-600 rounded-lg items-center justify-center mb-4">
        <svg>...</svg>
    </div>
    <h3 class="text-xl font-semibold text-white mb-2">Title</h3>
    <p class="text-slate-400 text-sm">Description</p>
</a>
```

## 📐 Layout & Spacing

### Spacing Scale
- None (0): 0
- XS (1): 0.25rem
- SM (2): 0.5rem
- MD (4): 1rem
- LG (6): 1.5rem
- XL (8): 2rem
- 2XL (12): 3rem

### Container
```html
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Content -->
</div>
```

### Grid
```html
<!-- 2 columns on tablet, 3 on desktop -->
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="card">...</div>
    <div class="card">...</div>
</div>
```

## Typography

### Heading Hierarchy
```html
<h1 class="text-4xl font-bold text-white">Main Heading</h1>
<h2 class="text-3xl font-semibold text-white">Section Title</h2>
<h3 class="text-xl font-semibold text-white">Subsection</h3>
<h4 class="text-lg font-medium text-white">Minor Title</h4>
<p class="text-base text-slate-400">Body text</p>
<p class="text-sm text-slate-500">Small text</p>
```

### Font Sizes
- h1: 2.25rem (36px)
- h2: 1.875rem (30px)
- h3: 1.25rem (20px)
- p: 1rem (16px)
- small: 0.875rem (14px)

## 🚀 Usage Examples

### Navigation Link
```html
<a href="{{ route('movies.index') }}" class="text-slate-300 hover:text-white transition-colors font-medium">
    Movies
</a>
```

### Hero Section
```html
<div class="mb-12">
    <div class="flex items-center gap-6 mb-8">
        <div class="w-16 h-16 bg-red-600 rounded-lg flex items-center justify-center text-2xl font-bold text-white">
            A
        </div>
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Welcome back</h1>
            <p class="text-slate-400">Manage your bookings</p>
        </div>
    </div>
</div>
```

### Quick Action Cards Grid
```html
<div class="grid md:grid-cols-3 gap-6">
    <!-- Browse Movies Card -->
    <a href="{{ route('movies.index') }}" class="group block bg-slate-800 hover:bg-slate-750 border border-slate-700 hover:border-red-600 rounded-xl p-8 transition-all duration-300">
        <div class="inline-flex w-14 h-14 bg-red-600 rounded-lg items-center justify-center mb-4 group-hover:bg-red-700 transition-colors">
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="..."/>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-white mb-2">Browse Movies</h3>
        <p class="text-slate-400 text-sm mb-4">Discover the latest blockbusters and upcoming releases</p>
        <span class="inline-flex items-center gap-2 text-red-500 font-medium group-hover:gap-3 transition-all">
            Explore <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </span>
    </a>
</div>
```

## ✨ Transitions & Effects

### Smooth Transitions
```html
<!-- Hover color change -->
<a class="text-slate-300 hover:text-white transition-colors">Link</a>

<!-- Hover with shadow -->
<button class="hover:shadow-lg transition-shadow">Button</button>

<!-- Hover with scale -->
<div class="hover:scale-105 transition-transform">Content</div>

<!-- Smooth duration -->
<div class="transition-all duration-300">Content</div>
```

### Disabled State
```html
<button class="btn btn-primary disabled:opacity-50 disabled:cursor-not-allowed" disabled>
    Disabled Button
</button>
```

## 🎯 Best Practices

1. **Remove Excessive Effects**: No hard shadows, no over-bright elements, minimal blur
2. **Maintain Consistency**: Use the same colors, spacing, and button styles throughout
3. **Clear Hierarchy**: Use typography and spacing to establish visual hierarchy
4. **Accessibility**: Ensure proper contrast ratios, readable fonts, and focus states
5. **Responsive**: Mobile-first approach with proper breakpoints (md: 768px, lg: 1024px)
6. **Performance**: Avoid complex animations and gradients

## 📱 Responsive Breakpoints

- SM: 640px
- MD: 768px (tablet)
- LG: 1024px (desktop)
- XL: 1280px (large desktop)

## 🔄 Files Updated

- ✅ `resources/views/dashboard.blade.php` - Cleaned hero, minimal cards
- ✅ `resources/views/layouts/app.blade.php` - Added design system CSS
- ✅ `resources/views/layouts/navigation.blade.php` - Simplified nav, removed effects

## 📋 Next Steps

Apply these styles to:
- [ ] Movie listing page
- [ ] Booking pages
- [ ] Payment checkout
- [ ] Admin panels
- [ ] Form pages
- [ ] Authentication pages

