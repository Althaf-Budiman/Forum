@extends('layouts.app')
@section('main')
    <img src="{{ asset('storage/'. Auth::user()->profile_photo_path) }}">
    {{ Auth::user()->name }}
@endsection