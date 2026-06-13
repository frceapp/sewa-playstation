@extends('layouts.public')

@section('title', $page->title)

@section('content')
<div class="bg-gray-900 py-16 sm:py-24">
    <div class="mx-auto max-w-3xl px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="font-heading text-4xl font-bold tracking-tight text-white sm:text-5xl">{{ $page->title }}</h1>
        </div>

        @if($page->image)
        <div class="mb-12 rounded-3xl overflow-hidden shadow-2xl border border-gray-800">
            <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->title }}" class="w-full h-auto object-cover">
        </div>
        @endif

        <!-- Prose for formatting HTML content nicely -->
        <div class="prose prose-invert prose-blue max-w-none">
            {!! $page->content !!}
        </div>
        
        <!-- If it's empty -->
        @if(empty($page->content))
        <div class="text-center py-12 bg-gray-800 rounded-2xl border border-gray-700">
            <p class="text-gray-400">Konten halaman sedang diperbarui.</p>
        </div>
        @endif
    </div>
</div>
@endsection
