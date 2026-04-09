# CineVerse UI Components - Quick Reference

## 📋 Copy-Paste Snippets

### 1. PRIMARY BUTTON
```html
<!-- Large Button (Form Submit) -->
<button type="submit" class="btn btn-primary w-full md:w-auto">
    Save Changes
</button>

<!-- Button with Icon -->
<a href="{{ route('movies.index') }}" class="btn btn-primary inline-flex items-center gap-2">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
    </svg>
    Add Movie
</a>
```

### 2. SECONDARY BUTTON
```html
<a href="{{ route('movies.index') }}" class="btn btn-secondary">
    Cancel
</a>

<!-- Secondary with icon -->
<button type="button" class="btn btn-secondary inline-flex items-center gap-2">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
    </svg>
    Back
</button>
```

### 3. FORM INPUT GROUP
```html
<div class="form-group">
    <label for="email" class="block text-sm font-medium text-slate-200 mb-2">
        Email Address
    </label>
    <input 
        type="email" 
        id="email" 
        name="email" 
        placeholder="you@example.com"
        class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600/50 transition-colors"
    />
    @error('email')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
```

### 4. TEXTAREA
```html
<div class="form-group">
    <label for="description" class="block text-sm font-medium text-slate-200 mb-2">
        Description
    </label>
    <textarea 
        id="description" 
        name="description" 
        rows="4"
        placeholder="Enter description..."
        class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600/50 transition-colors"
    ></textarea>
</div>
```

### 5. SELECT DROPDOWN
```html
<div class="form-group">
    <label for="category" class="block text-sm font-medium text-slate-200 mb-2">
        Category
    </label>
    <select 
        id="category" 
        name="category"
        class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600/50 transition-colors"
    >
        <option value="">Select a category</option>
        <option value="action">Action</option>
        <option value="drama">Drama</option>
        <option value="comedy">Comedy</option>
    </select>
</div>
```

### 6. CARD
```html
<div class="bg-slate-800 border border-slate-700 rounded-xl p-6 hover:border-red-600 transition-colors">
    <h3 class="text-lg font-semibold text-white mb-2">Card Title</h3>
    <p class="text-slate-400 text-sm mb-4">Card description goes here</p>
    <a href="#" class="text-red-500 hover:text-red-400 text-sm font-medium transition-colors">Learn More →</a>
</div>
```

### 7. DASHBOARD CARD WITH ICON
```html
<a href="{{ route('movies.index') }}" class="group block bg-slate-800 hover:bg-slate-750 border border-slate-700 hover:border-red-600 rounded-xl p-8 transition-all duration-300">
    <div class="inline-flex w-14 h-14 bg-red-600 rounded-lg items-center justify-center mb-4 group-hover:bg-red-700 transition-colors">
        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
            <!-- Icon SVG -->
        </svg>
    </div>
    <h3 class="text-xl font-semibold text-white mb-2">Browse Movies</h3>
    <p class="text-slate-400 text-sm mb-4">Discover the latest blockbusters and upcoming releases</p>
    <span class="inline-flex items-center gap-2 text-red-500 font-medium group-hover:gap-3 transition-all">
        Explore 
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </span>
</a>
```

### 8. GRID LAYOUT (2 cols on tablet, 3 on desktop)
```html
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="card">Card 1</div>
    <div class="card">Card 2</div>
    <div class="card">Card 3</div>
</div>
```

### 9. ALERT/MESSAGE BOX
```html
<!-- Success -->
<div class="bg-green-900/30 border border-green-600/50 rounded-lg p-4 text-green-400 text-sm">
    ✓ Your changes have been saved successfully
</div>

<!-- Error -->
<div class="bg-red-900/30 border border-red-600/50 rounded-lg p-4 text-red-400 text-sm">
    ✗ Something went wrong. Please try again
</div>

<!-- Warning -->
<div class="bg-yellow-900/30 border border-yellow-600/50 rounded-lg p-4 text-yellow-400 text-sm">
    ⚠ Please note this action cannot be undone
</div>

<!-- Info -->
<div class="bg-blue-900/30 border border-blue-600/50 rounded-lg p-4 text-blue-400 text-sm">
    ℹ New features are now available
</div>
```

### 10. SIMPLE TABLE
```html
<div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-800 border-b border-slate-700">
            <tr>
                <th class="px-6 py-3 font-semibold text-slate-200">Name</th>
                <th class="px-6 py-3 font-semibold text-slate-200">Email</th>
                <th class="px-6 py-3 font-semibold text-slate-200">Status</th>
                <th class="px-6 py-3 font-semibold text-slate-200">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b border-slate-700 hover:bg-slate-800/50 transition-colors">
                <td class="px-6 py-4 text-slate-200">John Doe</td>
                <td class="px-6 py-4 text-slate-400">john@example.com</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 bg-green-900/30 text-green-400 text-xs font-medium rounded-full">Active</span>
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="text-red-500 hover:text-red-400 transition-colors text-sm">Edit</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
```

### 11. MODAL/DIALOG
```html
<div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-slate-800 border border-slate-700 rounded-xl p-8 max-w-md w-full mx-4">
        <h2 class="text-2xl font-bold text-white mb-4">Confirm Delete</h2>
        <p class="text-slate-400 mb-6">Are you sure you want to delete this item?</p>
        <div class="flex gap-4">
            <button class="btn btn-secondary flex-1">Cancel</button>
            <button class="btn btn-primary flex-1">Delete</button>
        </div>
    </div>
</div>
```

### 12. RATING/STARS
```html
<div class="flex items-center gap-2">
    <div class="flex gap-1">
        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
        <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
    </div>
    <span class="text-slate-400 text-sm">4.5 out of 5</span>
</div>
```

### 13. PAGINATION
```html
<div class="flex items-center justify-between py-4">
    <a href="#" class="btn btn-secondary">← Previous</a>
    <div class="flex gap-2">
        <button class="w-10 h-10 bg-red-600 text-white rounded-lg font-medium">1</button>
        <button class="w-10 h-10 bg-slate-800 hover:bg-slate-700 text-white rounded-lg font-medium transition-colors">2</button>
        <button class="w-10 h-10 bg-slate-800 hover:bg-slate-700 text-white rounded-lg font-medium transition-colors">3</button>
    </div>
    <a href="#" class="btn btn-secondary">Next →</a>
</div>
```

### 14. HERO SECTION
```html
<div class="mb-12">
    <div class="flex items-center gap-6 mb-8">
        <div class="w-16 h-16 bg-red-600 rounded-lg flex items-center justify-center text-2xl font-bold text-white">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Welcome back, {{ Auth::user()->name }}</h1>
            <p class="text-slate-400">Manage your bookings and explore movies</p>
        </div>
    </div>
</div>
```

---

## 🎨 Color Utilities

```html
<!-- Text Colors -->
<p class="text-white">Primary text</p>
<p class="text-slate-200">Secondary text</p>
<p class="text-slate-400">Muted text</p>
<p class="text-red-500">Accent text</p>

<!-- Background Colors -->
<div class="bg-slate-900">Primary background</div>
<div class="bg-slate-800">Secondary background</div>
<div class="bg-slate-700">Tertiary background</div>
<div class="bg-red-600">Accent background</div>

<!-- Border Colors -->
<div class="border border-slate-700">Subtle border</div>
<div class="border border-slate-600">Strong border</div>
<div class="border border-red-600">Accent border</div>
```

---

## ✅ Best Practices When Using Snippets

1. ✅ **Always use consistent spacing** - Use `gap-4`, `gap-6`, `p-4`, `p-6`, `p-8`
2. ✅ **Use proper button classes** - Always use `.btn` base class
3. ✅ **Maintain dark theme** - Use slate-800/700 for cards
4. ✅ **Add transitions** - Use `transition-colors`, `transition-all` for smooth effects
5. ✅ **Test responsive** - Use `md:`, `lg:` breakpoints
6. ✅ **Don't add shadows** - Keep design minimal and clean
7. ✅ **Ensure contrast** - Text must be readable on backgrounds

