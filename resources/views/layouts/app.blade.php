<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CineVerse') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Design System CSS -->
    <style>
        /* Color Palette */
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --border-color: #475569;
            --text-primary: #ffffff;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --accent-red: #dc2626;
            --accent-red-hover: #b91c1c;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--accent-red);
            color: white;
            border: 1px solid var(--accent-red);
        }

        .btn-primary:hover {
            background-color: var(--accent-red-hover);
            border-color: var(--accent-red-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .btn-secondary {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background-color: var(--bg-tertiary);
            border-color: var(--accent-red);
            color: var(--accent-red);
        }

        .btn-ghost {
            background-color: transparent;
            color: var(--text-primary);
            border: 1px solid transparent;
        }

        .btn-ghost:hover {
            color: var(--accent-red);
        }

        /* Input Fields */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            color: var(--text-primary);
            font-size: 0.95rem;
            transition: border-color 0.2s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--accent-red);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        /* Card */
        .card {
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            padding: 1.5rem;
        }

        .card-hover {
            transition: all 0.2s ease;
        }

        .card-hover:hover {
            border-color: var(--accent-red);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.15);
        }
    </style>
</head>

<body class="font-sans antialiased min-h-screen">

    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Page Content -->
    <main>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 lg:py-16">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-red-500 mb-4 block">
                        🎬 CineVerse
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Your ultimate destination for movie tickets and cinema experiences.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-200 mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="{{ route('movies.index') }}" class="hover:text-red-400 transition-colors">Movies</a></li>
                        <li><a href="{{ route('bookings.my') }}" class="hover:text-red-400 transition-colors">My Bookings</a></li>
                        <li><a href="{{ route('profile.edit') }}" class="hover:text-red-400 transition-colors">Profile</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-200 mb-4">Support</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-red-400 transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-200 mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-red-400 transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-8 text-center text-slate-500 text-sm">
                <p>&copy; 2026 CineVerse. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
                    <h4 class="font-semibold text-slate-200 mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-red-400 transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-red-400 transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-200 mb-4">Connect</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-slate-800/50 hover:bg-red-500/20 hover:border-red-500/50 rounded-xl border-2 border-transparent flex items-center justify-center transition-all hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <!-- Add more social icons -->
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-8 text-center text-sm text-slate-500">
                © {{ date('Y') }} CineVerse. All rights reserved. | Made with ❤️ for cinema lovers.
            </div>
        </div>
    </footer>

</body>
</html>
