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

    <!-- Footer Component -->
    <x-footer />

</body>
</html>
