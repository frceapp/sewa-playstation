@extends('admin.layouts.app')
@section('title', 'Detail Pesan')
@section('heading', 'Detail Pesan')
@section('subheading', 'Dikirim '.$message->created_at?->format('d M Y, H:i'))
@section('content')
<div class="mx-auto max-w-3xl rounded-2xl border border-slate-800 bg-slate-900 p-6 sm:p-8">
    <div class="flex flex-col gap-4 border-b border-slate-800 pb-6 sm:flex-row sm:items-center sm:justify-between"><div><p class="text-sm text-slate-500">Pengirim</p><h2 class="mt-1 text-xl font-bold text-white">{{ $message->name }}</h2><a href="tel:{{ preg_replace('/[^0-9+]/', '', $message->phone_number) }}" class="mt-1 block text-sm text-blue-400">{{ $message->phone_number }}</a></div><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone_number) }}" target="_blank" rel="noopener" class="rounded-lg bg-emerald-600 px-4 py-2.5 text-center text-sm font-bold text-white hover:bg-emerald-500">Balas via WhatsApp ↗</a></div>
    <div class="py-8"><p class="whitespace-pre-wrap leading-7 text-slate-300">{{ $message->content }}</p></div>
    <div class="flex justify-between border-t border-slate-800 pt-6"><a href="{{ route('admin.messages.index') }}" class="rounded-lg border border-slate-700 px-4 py-2.5 text-sm font-semibold text-slate-300">← Kembali</a><form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Hapus pesan ini?')">@csrf @method('DELETE')<button class="rounded-lg border border-red-500/30 px-4 py-2.5 text-sm font-semibold text-red-400">Hapus Pesan</button></form></div>
</div>
@endsection
