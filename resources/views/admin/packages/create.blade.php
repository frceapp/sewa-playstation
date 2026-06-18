@extends('admin.layouts.app')
@section('title', 'Tambah Paket')
@section('heading', 'Tambah Paket Sewa')
@section('subheading', 'Buat penawaran paket baru untuk pelanggan.')
@section('content')<form method="POST" action="{{ route('admin.packages.store') }}">@csrf @include('admin.packages._form')</form>@endsection
