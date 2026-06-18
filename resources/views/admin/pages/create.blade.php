@extends('admin.layouts.app')
@section('title', 'Tambah Halaman')
@section('heading', 'Tambah Halaman')
@section('subheading', 'Buat halaman baru dan tampilkan pada navigasi website.')
@section('content')
<form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data">@csrf @include('admin.pages._form')</form>
@endsection
