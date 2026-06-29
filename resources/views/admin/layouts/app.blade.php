<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - CMS PS Rental</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 antialiased">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen">
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-950/80 lg:hidden" x-transition.opacity></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-slate-800 bg-slate-900 transition-transform duration-200 lg:translate-x-0">
            <div class="flex h-20 items-center justify-between border-b border-slate-800 px-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-gradient-to-br from-blue-500 to-violet-600 shadow-lg shadow-blue-500/20">
                        <img src="{{ asset('images/logo.svg') }}" alt="" class="h-6 w-6 brightness-0 invert">
                    </span>
                    <span>
                        <span class="block text-xs font-semibold uppercase tracking-[0.2em] text-blue-400">Content</span>
                        <span class="text-lg font-bold text-white">PS Rental CMS</span>
                    </span>
                </a>
                <button @click="sidebarOpen = false" class="text-slate-400 lg:hidden" aria-label="Tutup menu">×</button>
            </div>

            @php
                $navItems = [
                    ['route' => 'admin.dashboard', 'pattern' => 'admin.dashboard', 'label' => 'Ringkasan', 'icon' => '⌂'],
                    ['route' => 'admin.pages.index', 'pattern' => 'admin.pages.*', 'label' => 'Halaman', 'icon' => '▤'],
                    ['route' => 'admin.messages.index', 'pattern' => 'admin.messages.*', 'label' => 'Pesan Masuk', 'icon' => '✉'],
                    ['route' => 'admin.settings.edit', 'pattern' => 'admin.settings.*', 'label' => 'Pengaturan Situs', 'icon' => '⚙'],
                ];

                $catalogItems = [
                    ['route' => 'admin.packages.index', 'pattern' => 'admin.packages.*', 'label' => 'Paket Sewa'],
                    ['route' => 'admin.games.index', 'pattern' => 'admin.games.*', 'label' => 'Daftar Game'],
                    ['route' => 'admin.consoles.index', 'pattern' => 'admin.consoles.*', 'label' => 'Konsol'],
                ];

                $catalogActive = request()->routeIs('admin.packages.*', 'admin.games.*', 'admin.consoles.*');
            @endphp
            <nav class="flex-1 space-y-1 overflow-y-auto p-4" x-data="{ catalogMenuOpen: {{ $catalogActive ? 'true' : 'false' }} }">
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs($item['pattern']) ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span class="w-5 text-center text-base">{{ $item['icon'] }}</span>
                        {{ $item['label'] }}
                        @if($item['route'] === 'admin.messages.index' && \App\Models\Message::whereNull('read_at')->exists())
                            <span class="ml-auto h-2 w-2 rounded-full bg-amber-400"></span>
                        @endif
                    </a>
                @endforeach

                <div>
                    <button type="button" @click="catalogMenuOpen = ! catalogMenuOpen" class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ $catalogActive ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span class="w-5 text-center text-base">▦</span>
                        <span class="flex-1 text-left">Katalog</span>
                        <svg class="h-4 w-4 transition" :class="{ 'rotate-180': catalogMenuOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="catalogMenuOpen" class="mt-1 space-y-1 pl-8" style="display: {{ $catalogActive ? 'block' : 'none' }};">
                        @foreach($catalogItems as $item)
                            <a href="{{ route($item['route']) }}" class="block rounded-lg px-4 py-2 text-sm font-medium transition {{ request()->routeIs($item['pattern']) ? 'bg-slate-800 text-white' : 'text-slate-500 hover:bg-slate-800 hover:text-slate-200' }}">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </nav>

            <div class="border-t border-slate-800 p-4">
                <div class="mb-3 flex items-center gap-3 px-2">
                    <span class="grid h-9 w-9 place-items-center rounded-full bg-slate-700 text-sm font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    <span class="min-w-0">
                        <span class="block truncate text-sm font-semibold text-white">{{ auth()->user()->name }}</span>
                        <span class="block truncate text-xs text-slate-500">Administrator</span>
                    </span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full rounded-lg border border-slate-700 px-3 py-2 text-sm text-slate-300 transition hover:border-slate-600 hover:bg-slate-800 hover:text-white">Keluar</button>
                </form>
            </div>
        </aside>

        <div class="lg:pl-72">
            <header class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-slate-800 bg-slate-950/90 px-4 backdrop-blur sm:px-8">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="rounded-lg border border-slate-800 p-2 text-slate-300 lg:hidden" aria-label="Buka menu">☰</button>
                    <div>
                        <h1 class="text-lg font-bold text-white sm:text-xl">@yield('heading', 'Dashboard')</h1>
                        <p class="hidden text-sm text-slate-500 sm:block">@yield('subheading', 'Kelola konten website dari satu tempat.')</p>
                    </div>
                </div>
                <a href="{{ route('home') }}" target="_blank" class="rounded-lg border border-slate-700 px-3 py-2 text-sm font-semibold text-slate-300 transition hover:border-blue-500 hover:text-white">Lihat Website ↗</a>
            </header>

            <main class="p-4 sm:p-8">
                @if(session('success'))
                    <div class="mb-6 rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-300">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">
                        <p class="font-semibold">Periksa kembali data berikut:</p>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
