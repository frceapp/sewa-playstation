@extends('admin.layouts.app')
@section('title', 'Pesan Masuk')
@section('heading', 'Pesan Masuk')
@section('subheading', 'Pertanyaan dan permintaan pelanggan dari halaman Kontak.')
@section('content')
<div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900"><div class="divide-y divide-slate-800">
@forelse($messages as $message)
    <div class="flex items-center gap-4 px-5 py-4 transition hover:bg-slate-800/40 sm:px-6"><span class="h-2.5 w-2.5 shrink-0 rounded-full {{ $message->read_at ? 'bg-slate-700' : 'bg-amber-400' }}"></span><a href="{{ route('admin.messages.show', $message) }}" class="min-w-0 flex-1"><div class="flex items-center gap-3"><p class="truncate font-semibold {{ $message->read_at ? 'text-slate-300' : 'text-white' }}">{{ $message->name }}</p><span class="hidden text-xs text-slate-600 sm:inline">{{ $message->phone_number }}</span></div><p class="mt-1 truncate text-sm text-slate-500">{{ $message->content }}</p></a><time class="hidden shrink-0 text-xs text-slate-600 md:block">{{ $message->created_at?->format('d M Y, H:i') }}</time><form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Hapus pesan ini?')">@csrf @method('DELETE')<button class="rounded-lg p-2 text-sm text-red-400 hover:bg-red-500/10">Hapus</button></form></div>
@empty
    <div class="px-6 py-16 text-center text-slate-500">Belum ada pesan masuk.</div>
@endforelse
</div>@if($messages->hasPages())<div class="border-t border-slate-800 px-6 py-4">{{ $messages->links() }}</div>@endif</div>
@endsection
