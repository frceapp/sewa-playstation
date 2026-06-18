@extends('admin.layouts.app')
@section('title', 'Edit Paket')
@section('heading', 'Edit Paket Sewa')
@section('subheading', $package->name)
@section('content')<form method="POST" action="{{ route('admin.packages.update', $package) }}">@csrf @method('PUT') @include('admin.packages._form')</form>@endsection
