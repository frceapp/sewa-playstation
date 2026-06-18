@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('heading', 'Ringkasan CMS')
@section('subheading', 'Status konten dan aktivitas terbaru website.')

@section('content')
@php
    $cards = [
        ['label' => 'Halaman', 'value' => $counts['pages'], 'route' => 'admin.pages.index'],
        ['label' => 'Paket Sewa', 'value' => $counts['packages'], 'route' => 'admin.packages.index'],
        ['label' => 'Game', 'value' => $counts['games'], 'route' => 'admin.games.index'],
        ['label' => 'Konsol', 'value' => $counts['consoles'], 'route' => 'admin.consoles.index'],
    ];
@endphp
<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    @foreach($cards as $card)
        <a href="{{ route($card['route']) }}" class="group rounded-2xl border border-slate-800 bg-slate-900 p-6 transition hover:-translate-y-0.5 hover:border-blue-500/50">
            <p class="text-sm font-medium text-slate-500">{{ $card['label'] }}</p>
            <div class="mt-3 flex items-end justify-between">
                <p class="text-3xl font-bold text-white">{{ $card['value'] }}</p>
                <span class="text-slate-600 transition group-hover:text-blue-400">→</span>
            </div>
        </a>
    @endforeach
</div>

<div class="mt-6 grid gap-6 xl:grid-cols-3">
    <section class="rounded-2xl border border-slate-800 bg-slate-900 xl:col-span-2">
        <div class="flex items-center justify-between border-b border-slate-800 px-6 py-5">
            <div>
                <h2 class="font-bold text-white">Pesan terbaru</h2>
                <p class="mt-1 text-sm text-slate-500">{{ $counts['messages'] }} pesan belum dibaca</p>
            </div>
            <a href="{{ route('admin.messages.index') }}" class="text-sm font-semibold text-blue-400 hover:text-blue-300">Lihat semua</a>
        </div>
        <div class="divide-y divide-slate-800">
            @forelse($latestMessages as $message)
                <a href="{{ route('admin.messages.show', $message) }}" class="flex items-center gap-4 px-6 py-4 transition hover:bg-slate-800/50">
                    <span class="h-2 w-2 shrink-0 rounded-full {{ $message->read_at ? 'bg-slate-700' : 'bg-amber-400' }}"></span>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-semibold text-white">{{ $message->name }}</p>
                        <p class="truncate text-sm text-slate-500">{{ $message->content }}</p>
                    </div>
                    <time class="text-xs text-slate-600">{{ $message->created_at?->diffForHumans() }}</time>
                </a>
            @empty
                <p class="px-6 py-10 text-center text-sm text-slate-500">Belum ada pesan masuk.</p>
            @endforelse
        </div>
    </section>

    <section class="rounded-2xl border border-slate-800 bg-gradient-to-br from-blue-600 to-violet-700 p-6">
        <p class="text-sm font-semibold text-blue-100">Akses cepat</p>
        <h2 class="mt-2 text-2xl font-bold text-white">Perbarui tampilan website</h2>
        <p class="mt-3 text-sm leading-6 text-blue-100/80">Ubah judul Beranda, informasi Kontak, nama situs, dan teks katalog.</p>
        <a href="{{ route('admin.settings.edit') }}" class="mt-8 inline-flex rounded-lg bg-white px-4 py-2.5 text-sm font-bold text-blue-700 shadow-lg transition hover:bg-blue-50">Buka pengaturan</a>
    </section>
</div>
@endsection
