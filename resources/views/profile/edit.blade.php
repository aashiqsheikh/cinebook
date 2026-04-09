@extends('layouts.app')

@section('content')
<!-- Profile Hero -->
<section class="bg-gradient-to-br from-slate-900 via-blue-900/20 to-slate-900 py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <div class="inline-flex w-32 h-32 bg-gradient-to-r from-slate-800 to-slate-900 rounded-full p-1 mb-8 shadow-2xl ring-4 ring-slate-800/50 mx-auto group-hover:ring-blue-500/50">
                <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-2xl text-4xl font-black text-white">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
            </div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent mb-4">
                {{ Auth::user()->name }}
            </h1>
            <p class="text-2xl text-slate-400">{{ Auth::user()->email }}</p>
        </div>
    </div>
</section>

<!-- Profile Settings -->
<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid md:grid-cols-2 gap-12">
        <!-- Profile Info -->
        <div>
            <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800/50 rounded-4xl p-10 lg:p-12 shadow-2xl">
                <h3 class="text-3xl font-bold text-white mb-10 flex items-center gap-4">
                    <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile Information
                </h3>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-8">
                    @csrf
                    @method('patch')

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xl font-bold text-slate-300 mb-4">
                            Name
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $user->name) }}"
                            class="w-full px-8 py-6 bg-slate-800/50 border border-slate-700/50 rounded-3xl text-white placeholder-slate-400 focus:ring-4 focus:ring-blue-500/40 focus:border-blue-500/70 transition-all duration-300 backdrop-blur-xl shadow-xl hover:shadow-2xl text-xl @error('name') ring-2 ring-red-500/50 border-red-500 @enderror"
                            placeholder="Enter your full name"
                            required
                        >
                        @error('name')
                            <p class="mt-4 text-red-400 text-lg font-semibold flex items-center gap-3">
                                <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xl font-bold text-slate-300 mb-4">
                            Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full px-8 py-6 bg-slate-800/50 border border-slate-700/50 rounded-3xl text-white placeholder-slate-400 focus:ring-4 focus:ring-blue-500/40 focus:border-blue-500/70 transition-all duration-300 backdrop-blur-xl shadow-xl hover:shadow-2xl text-xl @error('email') ring-2 ring-red-500/50 border-red-500 @enderror"
                            placeholder="your.email@example.com"
                            required
                        >
                        @error('email')
                            <p class="mt-4 text-red-400 text-lg font-semibold flex items-center gap-3">
                                <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Save Button -->
                    <div class="pt-6">
                        <button type="submit" class="w-full flex items-center justify-center gap-4 px-12 py-8 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold text-2xl rounded-4xl shadow-2xl hover:shadow-4xl hover:-translate-y-1.5 transition-all duration-500 uppercase tracking-wider group">
                            <svg class="w-8 h-8 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Password Update -->
        <div>
            <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800/50 rounded-4xl p-10 lg:p-12 shadow-2xl">
                <h3 class="text-3xl font-bold text-white mb-10 flex items-center gap-4">
                    <svg class="w-12 h-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Update Password
                </h3>

                <form method="post" action="{{ route('password.update') }}" class="space-y-8">
                    @csrf
                    @method('put')

                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="block text-xl font-bold text-slate-300 mb-4">
                            Current Password
                        </label>
                        <input
                            id="current_password"
                            name="current_password"
                            type="password"
                            class="w-full px-8 py-6 bg-slate-800/50 border border-slate-700/50 rounded-3xl text-white placeholder-slate-400 focus:ring-4 focus:ring-purple-500/40 focus:border-purple-500/70 transition-all duration-300 backdrop-blur-xl shadow-xl hover:shadow-2xl text-xl @error('current_password') ring-2 ring-red-500/50 border-red-500 @enderror"
                            required
                            autocomplete="current-password"
                        >
                        @error('current_password')
                            <p class="mt-4 text-red-400 text-lg font-semibold flex items-center gap-3">
                                <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-xl font-bold text-slate-300 mb-4">
                            New Password
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="w-full px-8 py-6 bg-slate-800/50 border border-slate-700/50 rounded-3xl text-white placeholder-slate-400 focus:ring-4 focus:ring-purple-500/40 focus:border-purple-500/70 transition-all duration-300 backdrop-blur-xl shadow-xl hover:shadow-2xl text-xl @error('password') ring-2 ring-red-500/50 border-red-500 @enderror"
                            required
                            autocomplete="new-password"
                        >
                        @error('password')
                            <p class="mt-4 text-red-400 text-lg font-semibold flex items-center gap-3">
                                <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-xl font-bold text-slate-300 mb-4">
                            Confirm Password
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="w-full px-8 py-6 bg-slate-800/50 border border-slate-700/50 rounded-3xl text-white placeholder-slate-400 focus:ring-4 focus:ring-purple-500/40 focus:border-purple-500/70 transition-all duration-300 backdrop-blur-xl shadow-xl hover:shadow-2xl text-xl"
                            required
                            autocomplete="new-password"
                        >
                    </div>

                    <button type="submit" class="w-full flex items-center justify-center gap-4 px-12 py-8 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-bold text-2xl rounded-4xl shadow-2xl hover:shadow-4xl hover:-translate-y-1.5 transition-all duration-500 uppercase tracking-wider group">
                        <svg class="w-8 h-8 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Password
                    </button>
                </form>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="md:col-span-2 mt-12">
            <div class="bg-gradient-to-r from-rose-500/10 to-red-500/10 backdrop-blur-xl border border-rose-500/40 rounded-4xl p-10 lg:p-12 shadow-2xl group hover:shadow-3xl transition-all">
                <h3 class="text-3xl font-bold bg-gradient-to-r from-rose-400 to-red-500 bg-clip-text text-transparent mb-6 flex items-center gap-4">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9zM4 5a2 2 0 012-2h8a2 2 0 012 2v11a3 3 0 00-3 3H7a3 3 0 00-3-3V5zm3 4a1 1 0 011-1h6a1 1 0 110 2H8a1 1 0 01-1-1zm1 4a1 1 0 011-1h4a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                    Delete Account
                </h3>
                <div class="text-slate-300 text-lg leading-relaxed mb-8 max-w-2xl mx-auto">
                    <p class="mb-6">Permanently delete your account and all associated data including bookings, ratings, and profile information. This action cannot be undone.</p>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}" class="text-center">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm('Are you absolutely sure you want to delete your CineVerse account? This cannot be undone.')" class="inline-flex items-center gap-3 px-12 py-6 bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white font-bold text-xl rounded-4xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide group border-2 border-rose-500/50">
                        <svg class="w-7 h-7 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Permanently Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
