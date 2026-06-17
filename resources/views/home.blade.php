@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gray-900 pt-16 sm:pt-24 lg:pt-32 pb-16 lg:pb-24 border-b border-gray-800">
    <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]">
        <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#3b82f6] to-[#8b5cf6] opacity-20 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]"></div>
    </div>
    
    <div class="mx-auto max-w-7xl px-6 lg:px-8 relative z-10 text-center">
        <h1 class="font-heading text-4xl font-extrabold tracking-tight text-white sm:text-6xl lg:text-7xl">
            Experience Gaming<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Like Never Before</span>
        </h1>
        <p class="mt-6 text-lg leading-8 text-gray-300 max-w-2xl mx-auto">
            Sewa konsol PlayStation terbaru dengan harga terjangkau. Pilihan game lengkap dan konsol selalu dalam kondisi prima. Siap menemani waktu luang Anda.
        </p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="{{ route('catalog.packages') }}" class="rounded-full bg-blue-600 px-8 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 hover:bg-blue-500 hover:scale-105 transition-all duration-200">
                Lihat Paket Sewa
            </a>
            <a href="{{ route('catalog.games') }}" class="text-sm font-semibold leading-6 text-white hover:text-blue-400 transition-colors">
                Daftar Game <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</div>

<!-- Featured Packages Section -->
<div class="py-24 sm:py-32 bg-gray-900">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="font-heading text-3xl font-bold tracking-tight text-white sm:text-4xl">Paket Pilihan Kami</h2>
            <p class="mt-4 text-lg text-gray-400">Pilih paket sewa terbaik yang sesuai dengan kebutuhan Anda.</p>
        </div>
        
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @forelse($featuredPackages as $package)
            <div class="flex flex-col justify-between rounded-3xl bg-gray-800 p-8 ring-1 ring-gray-700 xl:p-10 hover:ring-blue-500 hover:-translate-y-2 transition-all duration-300 shadow-xl">
                <div>
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
                <a href="{{ route('contact.index') }}" aria-describedby="tier-{{ $package->id }}" class="mt-8 block rounded-full bg-white/10 px-3 py-2 text-center text-sm font-semibold leading-6 text-white hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transition-colors">Pesan Sekarang</a>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-400">Belum ada paket sewa yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
