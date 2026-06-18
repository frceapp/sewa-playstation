@extends('admin.layouts.app')
@section('title', 'Tambah Konsol')
@section('heading', 'Tambah Konsol')
@section('subheading', 'Tambahkan jenis konsol baru ke katalog.')
@section('content')<form method="POST" action="{{ route('admin.consoles.store') }}">@csrf @include('admin.consoles._form')</form>@endsection
