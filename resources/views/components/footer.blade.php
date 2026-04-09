<!-- Reusable Footer Component -->
<footer class="bg-slate-900 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <!-- Footer Content Grid -->
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            <!-- Column 1: Logo & About -->
            <div>
                <a href="{{ url('/') }}" class="text-2xl font-bold text-red-500 mb-4 block">
                    🎬 CineBook
                </a>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Your ultimate destination for movie tickets and cinema experiences. Book your favorite movies with ease.
                </p>
            </div>

            <!-- Column 2: Quick Links -->
            <div>
                <h4 class="font-semibold text-slate-200 mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('movies.index') }}" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            Movies
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('bookings.my') }}" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            My Bookings
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            My Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('movies.index') }}" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            Browse Theatres
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Support -->
            <div>
                <h4 class="font-semibold text-slate-200 mb-4">Support</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="#" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            Help Center
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            Report an Issue
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Legal -->
            <div>
                <h4 class="font-semibold text-slate-200 mb-4">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="#" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            Cookie Policy
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-red-400 transition-colors duration-200">
                            Refund Policy
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-slate-800 my-8"></div>

        <!-- Copyright Section -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} CineBook. All rights reserved.
            </p>
            <div class="flex items-center gap-4 text-slate-500 text-sm">
                <span>Made with <span class="text-red-500">❤️</span> by Aashiq Sheikh</span>
            </div>
        </div>
    </div>
</footer>
