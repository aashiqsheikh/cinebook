<nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-2xl font-bold text-red-500 hover:text-red-400 transition-colors">
                🎬 CineVerse
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-6">
                @if(session('city_id'))
                    <div x-data="{ showModal: false }">
                        <!-- City Selector Button -->
                        <div class="flex items-center gap-2 px-3 py-1 bg-slate-800/50 border border-slate-700 rounded-lg text-sm font-medium text-slate-200 hover:bg-slate-700/50 transition-all group cursor-pointer"
                             x-on:click="showModal = true">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ session('city_name', 'City') }}</span>
                            <svg class="w-3 h-3 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <!-- City Modal -->
                        <div x-show="showModal" x-transition:duration.300 class="fixed inset-0 z-50 flex items-center justify-center p-4" x-on:click.away="showModal = false">
                            @include('components.city-modal')
                        </div>
                    </div>
                @endif

                <a href="{{ route('movies.index') }}" class="text-slate-300 hover:text-white transition-colors font-medium">Movies</a>
                <a href="{{ route('movies.coming-soon') }}" class="text-slate-300 hover:text-white transition-colors font-medium">Coming Soon</a>
                <a href="{{ route('bookings.my') }}" class="text-slate-300 hover:text-white transition-colors font-medium">My Bookings</a>

                @auth
                    <div class="relative group">
                        <button class="flex items-center text-slate-300 hover:text-white font-medium transition-colors">
                            {{ Auth::user()->name }}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-0 w-48 bg-slate-800 border border-slate-700 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 py-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-700/50 transition-colors">Profile</a>
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-700/50 transition-colors">Admin Panel</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-700">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-700/50 transition-colors">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-slate-300 hover:text-white transition-colors font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg transition-colors">Sign Up</a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button id="mobile-menu-btn" class="p-2 rounded-lg hover:bg-slate-800 transition-colors text-slate-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden hidden border-t border-slate-800 bg-slate-900">
            <div class="px-2 py-2 space-y-1">
                <a href="{{ route('movies.index') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors font-medium">Movies</a>
                <a href="{{ route('movies.coming-soon') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors font-medium">Coming Soon</a>
                <a href="{{ route('bookings.my') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors font-medium">My Bookings</a>

                @auth
                    <div class="border-t border-slate-800 pt-2 mt-2">
                        <span class="block px-3 py-2 text-slate-200 font-medium">{{ Auth::user()->name }}</span>
                        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">Profile</a>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">Admin Panel</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="border-t border-slate-800 pt-2 mt-2">
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">Sign Up</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Add padding to body to account for fixed nav -->
<style>
    body {
        padding-top: 4rem;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', function() {
        menu.classList.toggle('hidden');
    });
});
</script>
