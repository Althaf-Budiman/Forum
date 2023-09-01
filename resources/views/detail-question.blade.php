@extends('layouts.app')
@section('main')
    <div class="flex w-full items-center flex-col">
        @livewire('question-item', ['question' => $question])
    </div>
@endsection
