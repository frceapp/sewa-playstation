@extends('admin.layouts.app')

@section('title', 'Halaman')
@section('heading', 'Halaman')
@section('subheading', 'Tambah dan atur halaman statis pada menu website.')

@section('content')
<div class="mb-6 flex justify-end">
    <a href="{{ route('admin.pages.create') }}" class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 hover:bg-blue-500">+ Tambah Halaman</a>
</div>
<div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-800 text-left text-sm">
            <thead class="bg-slate-900/80 text-xs uppercase tracking-wider text-slate-500">
                <tr><th class="px-6 py-4">Halaman</th><th class="px-6 py-4">Menu</th><th class="px-6 py-4">Status</th><th class="px-6 py-4 text-right">Aksi</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @forelse($pages as $page)
                    <tr class="hover:bg-slate-800/40">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-white">{{ $page->title }}</p>
                            <p class="mt-1 text-xs text-slate-500">/halaman/{{ $page->slug }} · Urutan {{ $page->sort_order }}</p>
                        </td>
                        <td class="px-6 py-4 text-slate-400">{{ $page->show_in_navigation ? 'Ditampilkan' : 'Disembunyikan' }}</td>
                        <td class="px-6 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $page->is_published ? 'bg-emerald-500/10 text-emerald-400' : 'bg-slate-700 text-slate-400' }}">{{ $page->is_published ? 'Terbit' : 'Draf' }}</span></td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                @if($page->is_published)<a href="{{ route('pages.show', $page->slug) }}" target="_blank" class="rounded-lg border border-slate-700 px-3 py-2 text-xs font-semibold text-slate-300 hover:text-white">Lihat</a>@endif
                                <a href="{{ route('admin.pages.edit', $page) }}" class="rounded-lg border border-blue-500/30 bg-blue-500/10 px-3 py-2 text-xs font-semibold text-blue-300 hover:bg-blue-500/20">Edit</a>
                                <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('Hapus halaman ini?')">@csrf @method('DELETE')<button class="rounded-lg border border-red-500/20 px-3 py-2 text-xs font-semibold text-red-400 hover:bg-red-500/10">Hapus</button></form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500">Belum ada halaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pages->hasPages())<div class="border-t border-slate-800 px-6 py-4">{{ $pages->links() }}</div>@endif
</div>
@endsection
