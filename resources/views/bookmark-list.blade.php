@extends('layouts.app')
@section('main')
    <div class="flex justify-center">
        <h1 class="text-2xl font-semibold mt-5 ms-5">Your Bookmarked Questions.</h1>
    </div>
    @foreach ($bookmarkedQuestions as $bookmarkedQuestion)
        <div class="flex w-full items-center flex-col">
            @livewire('question-item', ['question' => $bookmarkedQuestion->question], key($bookmarkedQuestion->question->id))
        </div>
    @endforeach
@endsection
