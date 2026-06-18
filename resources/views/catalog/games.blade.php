@extends('layouts.public')

@section('title', 'Daftar Game')

@section('content')
<div class="bg-gray-900 py-16 sm:py-24">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between mb-12">
            <div>
                <h2 class="font-heading text-4xl font-bold tracking-tight text-white sm:text-5xl">{{ $siteSettings['games_title'] ?? 'Daftar Game' }}</h2>
                <p class="mt-4 text-lg leading-8 text-gray-400">{{ $siteSettings['games_description'] ?? 'Jelajahi koleksi game lengkap kami.' }}</p>
            </div>
            <div class="mt-6 md:mt-0">
                <form action="{{ route('catalog.games') }}" method="GET" class="flex gap-2">
                    <select name="console" class="block w-full md:w-48 rounded-md border-0 bg-gray-800 py-2 pl-3 pr-10 text-white ring-1 ring-inset ring-gray-700 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6">
                        <option value="">Semua Konsol</option>
                        @foreach($consoles as $console)
                            <option value="{{ $console->slug }}" {{ request('console') == $console->slug ? 'selected' : '' }}>
                                {{ $console->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Filter</button>
                </form>
            </div>
        </div>

        <!-- Games Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @forelse($games as $game)
            <div class="group relative overflow-hidden rounded-2xl bg-gray-800 border border-gray-700 hover:border-blue-500 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20">
                <div class="aspect-[3/4] w-full overflow-hidden bg-gray-900 relative">
                    @if($game->image)
                        <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }}" class="h-full w-full object-cover object-center group-hover:scale-110 transition-transform duration-500">
                    @else
                        <!-- Placeholder image if no image provided -->
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-800">
                            <svg class="h-12 w-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-2 group-hover:translate-y-0 transition-transform">
                        <span class="inline-flex items-center rounded-md bg-blue-500/10 px-2 py-1 text-xs font-medium text-blue-400 ring-1 ring-inset ring-blue-500/20 mb-2">
                            {{ $game->console->name }}
                        </span>
                        <h3 class="font-heading font-semibold text-white truncate text-sm">
                            {{ $game->title }}
                        </h3>
                        @if($game->genre)
                            <p class="text-xs text-gray-400 truncate">{{ $game->genre }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center">
                <p class="text-gray-400">Tidak ada game yang ditemukan.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $games->links() }}
        </div>
    </div>
</div>
@endsection
