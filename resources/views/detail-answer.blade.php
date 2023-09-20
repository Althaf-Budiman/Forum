@extends('layouts.app')
@section('main')
    <div class="flex justify-center w-full">
        <div class="flex w-8/12 bg-gray-700 p-3 mt-3">
            <h1 class="p-1 text-lg font-semibold">This Answer Is From Question: <a href='{{ url("/question/$questionTarget->id/detail") }}' class="underline">{{ $questionTarget->title }}</a></h1>
        </div>
    </div>
    @livewire('answer-item', ['answer' => $answer, 'isDetailPage' => true], key($answer->id))
@endsection
