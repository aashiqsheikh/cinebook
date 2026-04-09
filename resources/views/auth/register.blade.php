<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name', 'CineVerse') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: radial-gradient(ellipse at bottom left, #8b5cf6 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
        }
        .otp-input {
            letter-spacing: 0.5em;
            text-align: center;
            font-family: 'Courier New', monospace;
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>
<body class="bg-slate-950 text-white">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-slate-900/80 backdrop-blur-xl shadow-2xl rounded-4xl border border-slate-800/50 sm:w-full sm:max-w-md sm:rounded-3xl overflow-hidden">
            <!-- Logo -->
            <div class="text-center mb-8 p-8 -m-6 bg-gradient-to-r from-purple-500/20 to-slate-900/50 rounded-t-3xl border-b border-slate-800/50">
                <a href="{{ route('movies.index') }}">
                    <span class="text-4xl font-black bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 bg-clip-text text-transparent drop-shadow-lg">
                        🎬 CineVerse
                    </span>
                </a>
                <p class="text-slate-400 mt-4 text-lg">{{ session('status') === 'otp-sent' ? 'Check your email for OTP' : 'Join the cinema revolution' }}</p>
            </div>

            @if (session('status') === 'otp-sent')
                <!-- OTP Verification -->
                <form method="POST" action="{{ route('register.verify-otp') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('register_otp_email') }}">

                    <div>
                        <label for="otp" class="block text-sm font-semibold text-slate-300 mb-4 flex items-center justify-center gap-3">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Enter 6-digit OTP
                        </label>
                        <div class="relative">
                            <input
                                id="otp"
                                type="text"
                                name="otp"
                                maxlength="6"
                                pattern="[0-9]{6}"
                                required
                                autofocus
                                autocomplete="one-time-code"
                                class="otp-input w-full px-8 py-6 bg-slate-800/70 border-2 border-slate-700/50 rounded-3xl text-2xl font-bold text-center tracking-widest focus:ring-4 focus:ring-purple-500/40 focus:border-purple-500/70 transition-all duration-300 shadow-inner hover:shadow-lg backdrop-blur-sm uppercase letter-spacing-8 @error('otp') ring-2 ring-red-500/50 border-red-500/70 @enderror"
                                placeholder="000000"
                            >
                            @error('otp')
                                <p class="mt-3 text-sm text-red-400 text-center flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-2 0v4a1 1 0 102 0V5z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="w-full flex items-center justify-center gap-3 px-8 py-6 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-bold text-xl rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide group">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Verify & Join CineVerse
                    </button>
                </form>

                <!-- Resend OTP -->
                <div class="text-center mt-8 pt-8 border-t border-slate-800/50">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white font-semibold transition-all rounded-xl p-3 hover:bg-slate-800/50 group">
                        <svg class="w-4 h-4 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Didn't receive OTP? Send new code
                    </a>
                </div>
            @else
                <!-- Registration Form -->
                @if(session('status') && session('status') !== 'otp-sent')
                    <div class="mb-8 p-6 bg-gradient-to-r from-amber-500/10 to-yellow-500/10 border border-amber-500/30 rounded-3xl backdrop-blur-sm text-center">
                        <p class="text-amber-400 font-bold text-lg mb-2 flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            {{ session('status') }}
                        </p>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.send-otp') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-300 mb-3">
                            Full Name
                        </label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            class="w-full px-6 py-5 bg-slate-800/50 border border-slate-700/50 rounded-2xl text-white placeholder-slate-400 focus:ring-4 focus:ring-purple-500/30 focus:border-purple-500/60 transition-all duration-300 backdrop-blur-sm shadow-inner hover:shadow-md text-lg @error('name') ring-2 ring-red-500/50 border-red-500/70 @enderror"
                            placeholder="John Doe"
                        >
                        @error('name')
                            <p class="mt-3 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-300 mb-3">
                            Gmail Address (for OTP verification)
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            class="w-full px-6 py-5 bg-slate-800/50 border border-slate-700/50 rounded-2xl text-white placeholder-slate-400 focus:ring-4 focus:ring-purple-500/30 focus:border-purple-500/60 transition-all duration-300 backdrop-blur-sm shadow-inner hover:shadow-md text-lg @error('email') ring-2 ring-red-500/50 border-red-500/70 @enderror"
                            placeholder="your.email@gmail.com"
                        >
                        @error('email')
                            <p class="mt-3 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-300 mb-3">
                            Password (min 8 chars)
                        </label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            minlength="8"
                            autocomplete="new-password"
                            class="w-full px-6 py-5 bg-slate-800/50 border border-slate-700/50 rounded-2xl text-white placeholder-slate-400 focus:ring-4 focus:ring-purple-500/30 focus:border-purple-500/60 transition-all duration-300 backdrop-blur-sm shadow-inner hover:shadow-md text-lg @error('password') ring-2 ring-red-500/50 border-red-500/70 @enderror"
                            placeholder="•••••••••••••"
                        >
                        @error('password')
                            <p class="mt-3 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-300 mb-3">
                            Confirm Password
                        </label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="w-full px-6 py-5 bg-slate-800/50 border border-slate-700/50 rounded-2xl text-white placeholder-slate-400 focus:ring-4 focus:ring-purple-500/30 focus:border-purple-500/60 transition-all duration-300 backdrop-blur-sm shadow-inner hover:shadow-md text-lg"
                            placeholder="•••••••••••••"
                        >
                    </div>

                    <button type="submit" class="w-full flex items-center justify-center gap-3 px-8 py-6 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-bold text-xl rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide group">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Send Verification Code
                    </button>
                </form>

                <!-- Login Link -->
                <div class="text-center mt-10 pt-8 border-t border-slate-800/50">
                    <p class="text-sm text-slate-500 mb-0">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-semibold text-red-400 hover:text-red-300 transition-colors rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500/50">
                            Sign in here
                        </a>
                    </p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
