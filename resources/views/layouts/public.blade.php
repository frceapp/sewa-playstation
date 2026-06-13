<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sewa PlayStation') - Profile Bisnis</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|outfit:400,600,700,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 antialiased min-h-screen flex flex-col selection:bg-blue-600 selection:text-white">

    <!-- Navigation -->
    <nav class="bg-gray-800/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-6 h-6 brightness-0 invert">
                        </div>
                        <span class="font-heading font-bold text-2xl tracking-tight text-white">PS<span class="text-blue-500">Rental</span></span>
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors duration-200 font-medium px-1 py-2 border-b-2 {{ request()->routeIs('home') ? 'border-blue-500 text-white' : 'border-transparent hover:border-gray-300' }}">Beranda</a>
                    
                    <!-- Dropdown Menu Katalog -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                        <button @click="open = ! open" class="flex items-center transition-colors duration-200 font-medium px-1 py-2 border-b-2 {{ request()->routeIs('catalog.*') ? 'border-blue-500 text-white' : 'text-gray-300 hover:text-white border-transparent hover:border-gray-300' }}">
                            Katalog & Harga
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute z-50 mt-2 w-48 rounded-xl shadow-lg shadow-black/50 bg-gray-800 border border-gray-700 py-1" style="display: none;">
                            <a href="{{ route('catalog.packages') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('catalog.packages') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors">Paket Sewa</a>
                            <a href="{{ route('catalog.games') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('catalog.games') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors">Daftar Game</a>
                        </div>
                    </div>

                    <a href="{{ route('pages.show', 'syarat-ketentuan') }}" class="text-gray-300 hover:text-white transition-colors duration-200 font-medium px-1 py-2 border-b-2 {{ request()->is('halaman/syarat-ketentuan') ? 'border-blue-500 text-white' : 'border-transparent hover:border-gray-300' }}">Syarat & Ketentuan</a>
                    <a href="{{ route('pages.show', 'tentang-kami') }}" class="text-gray-300 hover:text-white transition-colors duration-200 font-medium px-1 py-2 border-b-2 {{ request()->is('halaman/tentang-kami') ? 'border-blue-500 text-white' : 'border-transparent hover:border-gray-300' }}">Tentang Kami</a>
                    <a href="{{ route('contact.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200 font-medium px-1 py-2 border-b-2 {{ request()->routeIs('contact.index') ? 'border-blue-500 text-white' : 'border-transparent hover:border-gray-300' }}">Kontak</a>
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center sm:hidden" x-data="{ mobileMenuOpen: false }">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <!-- Mobile Menu Panel -->
                    <div x-show="mobileMenuOpen" class="absolute top-20 left-0 w-full bg-gray-800 shadow-xl border-b border-gray-700 sm:hidden z-50">
                        <div class="px-2 pt-2 pb-3 space-y-1">
                            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-700' }}">Beranda</a>
                            <div class="px-3 py-2 text-base font-medium {{ request()->routeIs('catalog.*') ? 'text-white' : 'text-gray-300' }}">Katalog & Harga</div>
                            <a href="{{ route('catalog.packages') }}" class="block pl-6 pr-3 py-2 text-sm {{ request()->routeIs('catalog.packages') ? 'text-white' : 'text-gray-400 hover:text-white' }}">Paket Sewa</a>
                            <a href="{{ route('catalog.games') }}" class="block pl-6 pr-3 py-2 text-sm {{ request()->routeIs('catalog.games') ? 'text-white' : 'text-gray-400 hover:text-white' }}">Daftar Game</a>
                            <a href="{{ route('pages.show', 'syarat-ketentuan') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('halaman/syarat-ketentuan') ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-700' }}">Syarat & Ketentuan</a>
                            <a href="{{ route('pages.show', 'tentang-kami') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('halaman/tentang-kami') ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-700' }}">Tentang Kami</a>
                            <a href="{{ route('contact.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('contact.index') ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-700' }}">Kontak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-950 border-t border-gray-800 mt-20">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:justify-start mb-6 md:mb-0 gap-3 items-center">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-5 h-5 brightness-0 invert">
                    </div>
                    <span class="font-heading font-bold text-xl text-white">PS<span class="text-blue-500">Rental</span></span>
                </div>
                <div class="flex justify-center space-x-6 md:order-2">
                    <a href="#" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                    </a>
                </div>
                <div class="mt-8 md:mt-0 md:order-1">
                    <p class="text-center text-sm text-gray-400">
                        &copy; {{ date('Y') }} PS Rental. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
