<div class="grid gap-6 xl:grid-cols-3">
    <div class="space-y-6 xl:col-span-2">
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
            <div class="grid gap-5 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="title" class="mb-2 block text-sm font-semibold text-slate-300">Judul halaman</label>
                    <input id="title" name="title" value="{{ old('title', $page->title) }}" required class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Tentang Kami">
                </div>
                <div class="sm:col-span-2">
                    <label for="slug" class="mb-2 block text-sm font-semibold text-slate-300">Slug URL</label>
                    <div class="flex rounded-xl border border-slate-700 bg-slate-950 focus-within:border-blue-500">
                        <span class="border-r border-slate-700 px-3 py-2.5 text-sm text-slate-500">/halaman/</span>
                        <input id="slug" name="slug" value="{{ old('slug', $page->slug) }}" class="min-w-0 flex-1 border-0 bg-transparent text-white focus:ring-0" placeholder="otomatis-dari-judul">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="content" class="mb-2 block text-sm font-semibold text-slate-300">Konten</label>
                    <textarea id="content" name="content" rows="16" required class="w-full rounded-xl border-slate-700 bg-slate-950 text-sm text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Tulis konten halaman dengan teks biasa. Pisahkan paragraf dengan baris kosong.">{{ old('content', $page->plain_content) }}</textarea>
                    <p class="mt-2 text-xs text-slate-500">Tidak perlu menulis HTML. Gunakan baris kosong untuk paragraf dan awali item daftar dengan tanda - jika diperlukan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
            <h2 class="font-bold text-white">Publikasi</h2>
            <div class="mt-5 space-y-4">
                <label class="flex items-start gap-3"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $page->exists ? $page->is_published : true)) class="mt-0.5 rounded border-slate-600 bg-slate-800 text-blue-600 focus:ring-blue-500"><span><span class="block text-sm font-semibold text-slate-300">Terbitkan</span><span class="text-xs text-slate-500">Halaman dapat diakses pengunjung.</span></span></label>
                <label class="flex items-start gap-3"><input type="checkbox" name="show_in_navigation" value="1" @checked(old('show_in_navigation', $page->exists ? $page->show_in_navigation : true)) class="mt-0.5 rounded border-slate-600 bg-slate-800 text-blue-600 focus:ring-blue-500"><span><span class="block text-sm font-semibold text-slate-300">Tampilkan di menu</span><span class="text-xs text-slate-500">Tambahkan halaman ke navigasi utama.</span></span></label>
                <div><label for="sort_order" class="mb-2 block text-sm font-semibold text-slate-300">Urutan menu</label><input type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $page->sort_order ?? 0) }}" required class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
            </div>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
            <label for="image" class="mb-2 block text-sm font-semibold text-slate-300">Gambar sampul</label>
            @if($page->image)<img src="{{ asset('storage/'.$page->image) }}" alt="" class="mb-4 aspect-video w-full rounded-xl object-cover"><label class="mb-4 flex items-center gap-2 text-xs text-red-400"><input type="checkbox" name="remove_image" value="1" class="rounded border-slate-600 bg-slate-800 text-red-500"> Hapus gambar saat ini</label>@endif
            <input type="file" id="image" name="image" accept="image/*" class="block w-full text-sm text-slate-400 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-800 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-slate-300 hover:file:bg-slate-700">
            <p class="mt-2 text-xs text-slate-500">JPG, PNG, atau WebP. Maksimal 2 MB.</p>
        </div>
    </div>
</div>
<div class="mt-6 flex justify-end gap-3"><a href="{{ route('admin.pages.index') }}" class="rounded-lg border border-slate-700 px-4 py-2.5 text-sm font-semibold text-slate-300">Batal</a><button class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-blue-500">Simpan Halaman</button></div>
