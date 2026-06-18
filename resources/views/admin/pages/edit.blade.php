@extends('admin.layouts.app')
@section('title', 'Edit Halaman')
@section('heading', 'Edit Halaman')
@section('subheading', $page->title)
@section('content')
<form method="POST" action="{{ route('admin.pages.update', $page) }}" enctype="multipart/form-data">@csrf @method('PUT') @include('admin.pages._form')</form>
@endsection
