@extends('layouts.public')

@section('title', 'Katalog Paket Sewa')

@section('content')
<div class="bg-gray-900 py-16 sm:py-24">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="font-heading text-4xl font-bold tracking-tight text-white sm:text-5xl">Katalog Paket Sewa</h2>
            <p class="mt-4 text-lg leading-8 text-gray-400">Temukan paket sewa PlayStation yang sesuai dengan kebutuhan Anda. Filter berdasarkan konsol pilihan Anda.</p>
        </div>

        <!-- Filter Form -->
        <div class="mt-12 flex justify-center">
            <form action="{{ route('catalog.packages') }}" method="GET" class="flex gap-4">
                <select name="console" class="block w-full rounded-md border-0 bg-gray-800 py-2 pl-3 pr-10 text-white ring-1 ring-inset ring-gray-700 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6">
                    <option value="">Semua Konsol</option>
                    @foreach($consoles as $console)
                        <option value="{{ $console->slug }}" {{ request('console') == $console->slug ? 'selected' : '' }}>
                            {{ $console->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    Filter
                </button>
            </form>
        </div>

        <!-- Packages Grid -->
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @forelse($packages as $package)
            <div class="flex flex-col justify-between rounded-3xl bg-gray-800 p-8 ring-1 ring-gray-700 xl:p-10 hover:ring-blue-500 hover:-translate-y-2 transition-all duration-300 shadow-xl relative overflow-hidden group">
                <!-- Background decoration -->
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-blue-500/10 blur-2xl group-hover:bg-blue-500/20 transition-all"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-between gap-x-4">
                        <h3 class="font-heading text-xl font-semibold leading-8 text-white">{{ $package->name }}</h3>
                        <span class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold leading-5 text-blue-400">{{ $package->console->name }}</span>
                    </div>
                    <p class="mt-6 flex items-baseline gap-x-1">
                        <span class="text-4xl font-bold tracking-tight text-white">Rp{{ number_format($package->price, 0, ',', '.') }}</span>
                        <span class="text-sm font-semibold leading-6 text-gray-400">/hari</span>
                    </p>
                    <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-300">
                        @foreach(explode(',', $package->features) as $feature)
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-blue-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                            {{ trim($feature) }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                <a href="{{ route('contact.index') }}" class="relative z-10 mt-8 block rounded-full bg-blue-600 px-3 py-2 text-center text-sm font-semibold leading-6 text-white hover:bg-blue-500 shadow-md transition-colors">Sewa Sekarang</a>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-800 mb-4">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4M8 16l-4-4 4-4M16 8l4 4-4 4"/></svg>
                </div>
                <h3 class="text-lg font-medium text-white mb-2">Tidak ada paket ditemukan</h3>
                <p class="text-gray-400">Maaf, kami belum memiliki paket untuk filter yang Anda pilih.</p>
                <a href="{{ route('catalog.packages') }}" class="mt-4 inline-block text-blue-400 hover:text-blue-300">Reset Filter</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
