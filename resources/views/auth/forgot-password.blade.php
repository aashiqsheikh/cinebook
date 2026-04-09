@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-900 px-4">
    <div class="w-full max-w-md bg-slate-800 p-8 rounded-3xl shadow-2xl border border-slate-700">

        <h2 class="text-2xl font-bold text-white mb-6 text-center">
            Forgot Password
        </h2>

        <p class="text-slate-400 mb-6 text-center">
            Enter your email and we’ll send you a reset link.
        </p>

        @if (session('status'))
            <div class="mb-4 text-green-400 text-sm text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <input type="email" name="email" required autofocus
                    placeholder="Enter your email"
                    class="w-full px-4 py-3 rounded-xl bg-slate-900 text-white border border-slate-600 focus:border-red-500 outline-none">
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-xl transition">
                Send Reset Link
            </button>
        </form>

        <a href="{{ route('login') }}" class="text-sm text-red-400 mt-4 block text-center">
    Back to Login
</a>

    </div>
</div>
@endsection
