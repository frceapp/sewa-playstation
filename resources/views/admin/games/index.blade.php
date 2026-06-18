@extends('admin.layouts.app')
@section('title', 'Daftar Game')
@section('heading', 'Daftar Game')
@section('subheading', 'Kelola koleksi game yang tersedia untuk disewa.')
@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:justify-between"><form method="GET" class="flex max-w-md flex-1 gap-2"><input name="q" value="{{ request('q') }}" class="min-w-0 flex-1 rounded-lg border-slate-700 bg-slate-900 text-sm text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Cari judul game..."><button class="rounded-lg border border-slate-700 px-4 py-2 text-sm font-semibold text-slate-300">Cari</button></form><a href="{{ route('admin.games.create') }}" class="rounded-lg bg-blue-600 px-4 py-2.5 text-center text-sm font-bold text-white hover:bg-blue-500">+ Tambah Game</a></div>
<div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-5">
    @forelse($games as $game)
        <article class="group overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
            <div class="relative aspect-[3/4] bg-slate-800">@if($game->image)<img src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->title }}" class="h-full w-full object-cover">@else<div class="grid h-full place-items-center text-4xl text-slate-700">▦</div>@endif<span class="absolute right-2 top-2 rounded-full px-2 py-1 text-[10px] font-bold {{ $game->is_published ? 'bg-emerald-500 text-white' : 'bg-slate-800 text-slate-300' }}">{{ $game->is_published ? 'AKTIF' : 'DRAF' }}</span></div>
            <div class="p-4"><p class="text-xs font-semibold text-blue-400">{{ $game->console->name }}</p><h2 class="mt-1 truncate font-bold text-white">{{ $game->title }}</h2><p class="mt-1 truncate text-xs text-slate-500">{{ $game->genre ?: 'Tanpa genre' }}</p><div class="mt-4 flex gap-2"><a href="{{ route('admin.games.edit', $game) }}" class="flex-1 rounded-lg bg-blue-500/10 px-2 py-2 text-center text-xs font-semibold text-blue-300">Edit</a><form method="POST" action="{{ route('admin.games.destroy', $game) }}" onsubmit="return confirm('Hapus game ini?')">@csrf @method('DELETE')<button class="rounded-lg border border-red-500/20 px-2.5 py-2 text-xs font-semibold text-red-400">Hapus</button></form></div></div>
        </article>
    @empty
        <div class="col-span-full rounded-2xl border border-dashed border-slate-700 p-12 text-center text-slate-500">Tidak ada game yang ditemukan.</div>
    @endforelse
</div>
@if($games->hasPages())<div class="mt-6">{{ $games->links() }}</div>@endif
@endsection
