<div class="mx-auto max-w-3xl rounded-2xl border border-slate-800 bg-slate-900 p-6 sm:p-8">
    <div class="grid gap-5 sm:grid-cols-2">
        <div><label for="name" class="mb-2 block text-sm font-semibold text-slate-300">Nama konsol</label><input id="name" name="name" required value="{{ old('name', $console->name) }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="PlayStation 5"></div>
        <div><label for="slug" class="mb-2 block text-sm font-semibold text-slate-300">Slug</label><input id="slug" name="slug" value="{{ old('slug', $console->slug) }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="playstation-5"></div>
        <div class="sm:col-span-2"><label for="description" class="mb-2 block text-sm font-semibold text-slate-300">Deskripsi</label><textarea id="description" name="description" rows="5" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500">{{ old('description', $console->description) }}</textarea></div>
    </div>
    <div class="mt-6 flex justify-end gap-3"><a href="{{ route('admin.consoles.index') }}" class="rounded-lg border border-slate-700 px-4 py-2.5 text-sm font-semibold text-slate-300">Batal</a><button class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-blue-500">Simpan Konsol</button></div>
</div>
