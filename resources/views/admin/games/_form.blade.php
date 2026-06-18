<div class="grid gap-6 lg:grid-cols-3">
    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6 lg:col-span-2">
        @if($consoles->isEmpty())<div class="mb-6 rounded-xl border border-amber-500/30 bg-amber-500/10 p-4 text-sm text-amber-300">Tambahkan data konsol terlebih dahulu.</div>@endif
        <div class="grid gap-5 sm:grid-cols-2">
            <div class="sm:col-span-2"><label for="title" class="mb-2 block text-sm font-semibold text-slate-300">Judul game</label><input id="title" name="title" required value="{{ old('title', $game->title) }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="EA Sports FC 26"></div>
            <div><label for="console_id" class="mb-2 block text-sm font-semibold text-slate-300">Konsol</label><select id="console_id" name="console_id" required class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"><option value="">Pilih konsol</option>@foreach($consoles as $console)<option value="{{ $console->id }}" @selected(old('console_id', $game->console_id) == $console->id)>{{ $console->name }}</option>@endforeach</select></div>
            <div><label for="genre" class="mb-2 block text-sm font-semibold text-slate-300">Genre</label><input id="genre" name="genre" value="{{ old('genre', $game->genre) }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Sports"></div>
            <div class="sm:col-span-2"><label for="slug" class="mb-2 block text-sm font-semibold text-slate-300">Slug</label><input id="slug" name="slug" value="{{ old('slug', $game->slug) }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="otomatis-dari-judul"></div>
            <label class="sm:col-span-2 flex items-center gap-3"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $game->exists ? $game->is_published : true)) class="rounded border-slate-600 bg-slate-800 text-blue-600"><span class="text-sm font-semibold text-slate-300">Tampilkan game di website</span></label>
        </div>
    </div>
    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
        <label for="image" class="mb-3 block text-sm font-semibold text-slate-300">Cover game</label>
        @if($game->image)<img src="{{ asset('storage/'.$game->image) }}" alt="" class="mx-auto mb-4 aspect-[3/4] max-h-72 rounded-xl object-cover"><label class="mb-4 flex items-center gap-2 text-xs text-red-400"><input type="checkbox" name="remove_image" value="1" class="rounded border-slate-600 bg-slate-800 text-red-500"> Hapus cover saat ini</label>@endif
        <input type="file" id="image" name="image" accept="image/*" class="block w-full text-sm text-slate-400 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-800 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-slate-300"><p class="mt-2 text-xs text-slate-500">Rasio 3:4, maksimal 2 MB.</p>
    </div>
</div>
<div class="mt-6 flex justify-end gap-3"><a href="{{ route('admin.games.index') }}" class="rounded-lg border border-slate-700 px-4 py-2.5 text-sm font-semibold text-slate-300">Batal</a><button @disabled($consoles->isEmpty()) class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-blue-500 disabled:opacity-50">Simpan Game</button></div>
