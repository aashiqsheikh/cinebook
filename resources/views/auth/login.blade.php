<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'CineVerse') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: radial-gradient(ellipse at top, #1e3a8a 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-slate-950 text-white">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-slate-900/80 backdrop-blur-xl shadow-2xl rounded-4xl border border-slate-800/50 sm:w-full sm:max-w-md sm:rounded-3xl overflow-hidden">
            <!-- Logo -->
            <div class="text-center mb-8 p-8 -m-6 bg-gradient-to-r from-red-500/20 to-slate-900/50 rounded-t-3xl border-b border-slate-800/50">
                <a href="{{ route('movies.index') }}">
                    <span class="text-4xl font-black bg-gradient-to-r from-red-500 via-red-400 to-orange-500 bg-clip-text text-transparent drop-shadow-lg">
                        🎬 CineVerse
                    </span>
                </a>
                <p class="text-slate-400 mt-4 text-lg">Welcome back to the cinema</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-300 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5 3a9 9 0 01-18 0m-.5 0a9.5 9.5 0 0119.5 0z"/>
                        </svg>
                        Email Address
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="w-full px-6 py-5 bg-slate-800/50 border border-slate-700/50 rounded-2xl text-white placeholder-slate-400 focus:ring-4 focus:ring-red-500/30 focus:border-red-500/60 transition-all duration-300 backdrop-blur-sm shadow-inner hover:shadow-md text-lg @error('email') ring-2 ring-red-500/50 border-red-500/70 @enderror"
                        placeholder="you@cinelover.com"
                    >
                    @error('email')
                        <p class="mt-3 text-sm text-red-400 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-2 0v4a1 1 0 102 0V5z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-300 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full px-6 py-5 bg-slate-800/50 border border-slate-700/50 rounded-2xl text-white placeholder-slate-400 focus:ring-4 focus:ring-red-500/30 focus:border-red-500/60 transition-all duration-300 backdrop-blur-sm shadow-inner hover:shadow-md text-lg @error('password') ring-2 ring-red-500/50 border-red-500/70 @enderror"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <p class="mt-3 text-sm text-red-400 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-2 0v4a1 1 0 102 0V5z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between">
                    <label for="remember" class="flex items-center gap-3">
                        <input id="remember" type="checkbox" name="remember" class="rounded border-slate-700/50 text-red-500 focus:ring-red-500/50 bg-slate-800/50">
                        <span class="text-sm text-slate-400 select-none">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-red-400 hover:text-red-300 font-semibold transition-colors rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500/50">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold text-sm rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 uppercase">
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Sign In
                </button>
            </form>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-800/50"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-6 bg-slate-950/80 backdrop-blur-sm text-slate-500">or continue with</span>
                </div>
            </div>

            <!-- Google Button -->
            <a href="{{ route('auth.google') }}" class="w-full inline-flex items-center justify-center gap-4 px-8 py-5 mt-8 border-2 border-slate-700/50 hover:border-slate-600/50 hover:bg-slate-800/30 text-slate-300 hover:text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl hover:-translate-y-0.5 transition-all duration-300 backdrop-blur-sm group">
                <svg class="w-6 h-6 flex-shrink-0 group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Continue with Google
            </a>

            <!-- Register Link -->
            <div class="text-center mt-10">
                <p class="text-sm text-slate-500 mb-0">
                    New to CineVerse?
                    <a href="{{ route('register') }}" class="font-semibold text-red-400 hover:text-red-300 transition-colors rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500/50">
                        Create an account
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
