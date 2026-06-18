@extends('admin.layouts.app')
@section('title', 'Tambah Game')
@section('heading', 'Tambah Game')
@section('subheading', 'Tambahkan judul baru ke koleksi rental.')
@section('content')<form method="POST" action="{{ route('admin.games.store') }}" enctype="multipart/form-data">@csrf @include('admin.games._form')</form>@endsection
