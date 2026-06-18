@extends('admin.layouts.app')
@section('title', 'Edit Game')
@section('heading', 'Edit Game')
@section('subheading', $game->title)
@section('content')<form method="POST" action="{{ route('admin.games.update', $game) }}" enctype="multipart/form-data">@csrf @method('PUT') @include('admin.games._form')</form>@endsection
