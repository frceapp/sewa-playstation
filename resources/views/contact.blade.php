@extends('layouts.public')

@section('title', 'Kontak Kami')

@section('content')
<div class="relative isolate bg-gray-900">
    <div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
        <div class="relative px-6 pb-20 pt-24 sm:pt-32 lg:static lg:px-8 lg:py-48">
            <div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
                <div class="absolute inset-y-0 left-0 -z-10 w-full overflow-hidden ring-1 ring-white/5 lg:w-1/2">
                    <svg class="absolute inset-0 h-full w-full stroke-gray-700 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">
                        <defs>
                            <pattern id="54f88622-e7f8-4f1d-aaf9-c2f5e46dd1f2" width="200" height="200" x="100%" y="-1" patternUnits="userSpaceOnUse">
                                <path d="M130 200V.5M.5 .5H200" fill="none" />
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" stroke-width="0" fill="url(#54f88622-e7f8-4f1d-aaf9-c2f5e46dd1f2)" />
                    </svg>
                </div>
                <h2 class="font-heading text-4xl font-bold tracking-tight text-white">Hubungi Kami</h2>
                <p class="mt-6 text-lg leading-8 text-gray-300">Punya pertanyaan tentang paket sewa? Ingin booking untuk akhir pekan ini? Jangan ragu untuk menghubungi kami melalui form di samping atau melalui kontak di bawah ini.</p>
                <dl class="mt-10 space-y-4 text-base leading-7 text-gray-300">
                    <div class="flex gap-x-4">
                        <dt class="flex-none">
                            <span class="sr-only">Alamat</span>
                            <svg class="h-7 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                        </dt>
                        <dd>Jl. Gaming No. 99<br>Jakarta Selatan, 12345</dd>
                    </div>
                    <div class="flex gap-x-4">
                        <dt class="flex-none">
                            <span class="sr-only">Telepon</span>
                            <svg class="h-7 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.18-7.076-7.076l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                        </dt>
                        <dd><a class="hover:text-white" href="tel:+628123456789">+62 812-3456-7890</a></dd>
                    </div>
                    <div class="flex gap-x-4">
                        <dt class="flex-none">
                            <span class="sr-only">Email</span>
                            <svg class="h-7 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </dt>
                        <dd><a class="hover:text-white" href="mailto:halo@psrental.com">halo@psrental.com</a></dd>
                    </div>
                </dl>
            </div>
        </div>
        <form action="{{ route('contact.store') }}" method="POST" class="px-6 pb-24 pt-20 sm:pb-32 lg:px-8 lg:py-48">
            @csrf
            <div class="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">
                
                @if(session('success'))
                <div class="mb-8 rounded-md bg-green-500/10 p-4 border border-green-500/20">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-400">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-semibold leading-6 text-white">Nama Lengkap</label>
                        <div class="mt-2.5">
                            <input type="text" name="name" id="name" autocomplete="name" required class="block w-full rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6 @error('name') ring-red-500 @enderror" value="{{ old('name') }}">
                            @error('name')<p class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="phone_number" class="block text-sm font-semibold leading-6 text-white">Nomor WhatsApp / HP</label>
                        <div class="mt-2.5">
                            <input type="tel" name="phone_number" id="phone_number" autocomplete="tel" required class="block w-full rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6 @error('phone_number') ring-red-500 @enderror" value="{{ old('phone_number') }}">
                            @error('phone_number')<p class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="content" class="block text-sm font-semibold leading-6 text-white">Pesan</label>
                        <div class="mt-2.5">
                            <textarea name="content" id="content" rows="4" required class="block w-full rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6 @error('content') ring-red-500 @enderror">{{ old('content') }}</textarea>
                            @error('content')<p class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="rounded-md bg-blue-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 w-full sm:w-auto">Kirim Pesan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
