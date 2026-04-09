@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-900">
    <!-- Admin Header -->
    <div class="bg-gradient-to-r from-indigo-900/90 to-purple-900/90 backdrop-blur-xl border-b border-slate-800/50 py-8 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center gap-6">
                <div class="p-4 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-2xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 013 3z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl font-black text-white drop-shadow-lg">Admin Panel</h1>
                    <p class="text-xl text-slate-300 mt-1">Complete system management</p>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8 lg:p-12">
        @yield('admin-content')
    </div>
</div>
@endsection

