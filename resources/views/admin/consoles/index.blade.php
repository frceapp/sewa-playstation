@extends('admin.layouts.app')
@section('title', 'Konsol')
@section('heading', 'Konsol')
@section('subheading', 'Kelola jenis konsol untuk filter game dan paket sewa.')
@section('content')
<div class="mb-6 flex justify-end"><a href="{{ route('admin.consoles.create') }}" class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-blue-500">+ Tambah Konsol</a></div>
<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
    @forelse($consoles as $console)
        <article class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
            <div class="flex items-start justify-between gap-4"><div><h2 class="font-bold text-white">{{ $console->name }}</h2><p class="mt-1 text-xs text-slate-500">{{ $console->slug }}</p></div><span class="rounded-lg bg-slate-800 px-2.5 py-1 text-xs text-slate-400">{{ $console->games_count }} game</span></div>
            <p class="mt-4 line-clamp-3 min-h-[3.75rem] text-sm leading-5 text-slate-400">{{ $console->description ?: 'Belum ada deskripsi.' }}</p>
            <p class="mt-4 text-xs text-slate-500">{{ $console->rental_packages_count }} paket sewa</p>
            <div class="mt-5 flex gap-2 border-t border-slate-800 pt-4"><a href="{{ route('admin.consoles.edit', $console) }}" class="flex-1 rounded-lg bg-blue-500/10 px-3 py-2 text-center text-xs font-semibold text-blue-300">Edit</a><form class="flex-1" method="POST" action="{{ route('admin.consoles.destroy', $console) }}" onsubmit="return confirm('Hapus konsol ini?')">@csrf @method('DELETE')<button class="w-full rounded-lg border border-red-500/20 px-3 py-2 text-xs font-semibold text-red-400">Hapus</button></form></div>
        </article>
    @empty
        <div class="col-span-full rounded-2xl border border-dashed border-slate-700 p-12 text-center text-slate-500">Belum ada data konsol.</div>
    @endforelse
</div>
@if($consoles->hasPages())<div class="mt-6">{{ $consoles->links() }}</div>@endif
@endsection
