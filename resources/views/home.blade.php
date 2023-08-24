@extends('layouts.app')
@section('main')
    {{ Auth::user()->name }}
@endsection