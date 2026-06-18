@extends('admin.layouts.app')
@section('title', 'Pengaturan Situs')
@section('heading', 'Pengaturan Situs')
@section('subheading', 'Ubah teks Beranda, katalog, Kontak, dan identitas website.')
@section('content')
@php($value = fn ($key, $default = '') => old($key, $settings[$key] ?? $default))
<form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">@csrf @method('PUT')
    <section class="rounded-2xl border border-slate-800 bg-slate-900">
        <div class="border-b border-slate-800 px-6 py-5"><h2 class="font-bold text-white">Identitas website</h2><p class="mt-1 text-sm text-slate-500">Nama, footer, dan tautan media sosial.</p></div>
        <div class="grid gap-5 p-6 sm:grid-cols-2">
            <div><label for="site_name" class="mb-2 block text-sm font-semibold text-slate-300">Nama situs</label><input id="site_name" name="site_name" required value="{{ $value('site_name', 'PS Rental') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
            <div><label for="footer_text" class="mb-2 block text-sm font-semibold text-slate-300">Teks footer</label><input id="footer_text" name="footer_text" required value="{{ $value('footer_text', 'PS Rental. Hak cipta dilindungi.') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
            <div><label for="facebook_url" class="mb-2 block text-sm font-semibold text-slate-300">URL Facebook</label><input type="url" id="facebook_url" name="facebook_url" value="{{ $value('facebook_url') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="https://facebook.com/..."></div>
            <div><label for="instagram_url" class="mb-2 block text-sm font-semibold text-slate-300">URL Instagram</label><input type="url" id="instagram_url" name="instagram_url" value="{{ $value('instagram_url') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="https://instagram.com/..."></div>
        </div>
    </section>

    <section class="rounded-2xl border border-slate-800 bg-slate-900">
        <div class="border-b border-slate-800 px-6 py-5"><h2 class="font-bold text-white">Beranda</h2><p class="mt-1 text-sm text-slate-500">Teks utama dan bagian paket pilihan.</p></div>
        <div class="grid gap-5 p-6 sm:grid-cols-2">
            <div><label for="home_hero_title" class="mb-2 block text-sm font-semibold text-slate-300">Judul utama</label><input id="home_hero_title" name="home_hero_title" required value="{{ $value('home_hero_title', 'Experience Gaming') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
            <div><label for="home_hero_highlight" class="mb-2 block text-sm font-semibold text-slate-300">Teks sorotan</label><input id="home_hero_highlight" name="home_hero_highlight" required value="{{ $value('home_hero_highlight', 'Like Never Before') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
            <div class="sm:col-span-2"><label for="home_hero_description" class="mb-2 block text-sm font-semibold text-slate-300">Deskripsi utama</label><textarea id="home_hero_description" name="home_hero_description" rows="3" required class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500">{{ $value('home_hero_description', 'Sewa konsol PlayStation terbaru dengan harga terjangkau. Pilihan game lengkap dan konsol selalu dalam kondisi prima.') }}</textarea></div>
            <div><label for="home_packages_title" class="mb-2 block text-sm font-semibold text-slate-300">Judul bagian paket</label><input id="home_packages_title" name="home_packages_title" required value="{{ $value('home_packages_title', 'Paket Pilihan Kami') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
            <div><label for="home_packages_description" class="mb-2 block text-sm font-semibold text-slate-300">Deskripsi bagian paket</label><input id="home_packages_description" name="home_packages_description" required value="{{ $value('home_packages_description', 'Pilih paket sewa terbaik yang sesuai dengan kebutuhan Anda.') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
        </div>
    </section>

    <section class="rounded-2xl border border-slate-800 bg-slate-900">
        <div class="border-b border-slate-800 px-6 py-5"><h2 class="font-bold text-white">Katalog & Harga</h2><p class="mt-1 text-sm text-slate-500">Judul dan deskripsi halaman Paket Sewa serta Daftar Game.</p></div>
        <div class="grid gap-5 p-6 sm:grid-cols-2">
            <div><label for="packages_title" class="mb-2 block text-sm font-semibold text-slate-300">Judul Paket Sewa</label><input id="packages_title" name="packages_title" required value="{{ $value('packages_title', 'Katalog Paket Sewa') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
            <div><label for="games_title" class="mb-2 block text-sm font-semibold text-slate-300">Judul Daftar Game</label><input id="games_title" name="games_title" required value="{{ $value('games_title', 'Daftar Game') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
            <div><label for="packages_description" class="mb-2 block text-sm font-semibold text-slate-300">Deskripsi Paket Sewa</label><textarea id="packages_description" name="packages_description" rows="3" required class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500">{{ $value('packages_description', 'Temukan paket sewa PlayStation yang sesuai dengan kebutuhan Anda.') }}</textarea></div>
            <div><label for="games_description" class="mb-2 block text-sm font-semibold text-slate-300">Deskripsi Daftar Game</label><textarea id="games_description" name="games_description" rows="3" required class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500">{{ $value('games_description', 'Jelajahi koleksi game lengkap kami.') }}</textarea></div>
        </div>
    </section>

    <section class="rounded-2xl border border-slate-800 bg-slate-900">
        <div class="border-b border-slate-800 px-6 py-5"><h2 class="font-bold text-white">Kontak</h2><p class="mt-1 text-sm text-slate-500">Informasi bisnis yang tampil di halaman Kontak.</p></div>
        <div class="grid gap-5 p-6 sm:grid-cols-2">
            <div><label for="contact_title" class="mb-2 block text-sm font-semibold text-slate-300">Judul halaman</label><input id="contact_title" name="contact_title" required value="{{ $value('contact_title', 'Hubungi Kami') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
            <div><label for="contact_phone" class="mb-2 block text-sm font-semibold text-slate-300">Nomor telepon / WhatsApp</label><input id="contact_phone" name="contact_phone" required value="{{ $value('contact_phone', '+62 812-3456-7890') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
            <div class="sm:col-span-2"><label for="contact_description" class="mb-2 block text-sm font-semibold text-slate-300">Deskripsi</label><textarea id="contact_description" name="contact_description" rows="3" required class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500">{{ $value('contact_description', 'Punya pertanyaan tentang paket sewa? Hubungi kami melalui formulir ini.') }}</textarea></div>
            <div><label for="contact_address" class="mb-2 block text-sm font-semibold text-slate-300">Alamat</label><textarea id="contact_address" name="contact_address" rows="4" required class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500">{{ $value('contact_address', "Jl. Gaming No. 99\nJakarta Selatan, 12345") }}</textarea></div>
            <div><label for="contact_email" class="mb-2 block text-sm font-semibold text-slate-300">Email</label><input type="email" id="contact_email" name="contact_email" required value="{{ $value('contact_email', 'halo@psrental.com') }}" class="w-full rounded-xl border-slate-700 bg-slate-950 text-white focus:border-blue-500 focus:ring-blue-500"></div>
        </div>
    </section>
    <div class="sticky bottom-4 flex justify-end"><button class="rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow-xl shadow-blue-600/30 hover:bg-blue-500">Simpan Semua Pengaturan</button></div>
</form>
@endsection
