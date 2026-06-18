@extends('admin.layouts.app')
@section('title', 'Edit Konsol')
@section('heading', 'Edit Konsol')
@section('subheading', $console->name)
@section('content')<form method="POST" action="{{ route('admin.consoles.update', $console) }}">@csrf @method('PUT') @include('admin.consoles._form')</form>@endsection
