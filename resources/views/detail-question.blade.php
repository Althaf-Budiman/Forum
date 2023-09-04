@extends('layouts.app')
@section('main')
    <div class="flex w-full items-center flex-col">
        @livewire('question-item', ['question' => $question])

        {{-- Answer Count --}}
        <div class="flex w-8/12 bg-gray-700 p-3 mt-3">
            <h1 class="p-1 text-lg font-semibold">{{ $question->totalAnswers() }} Answers</h1>
        </div>

        @foreach ($answers as $answer)
            @livewire('answer-item', ['answer' => $answer])
        @endforeach

        {{-- Add Answer --}}
        @if ($question->user->id != Auth::user()->id)
            <div class="flex w-8/12 bg-gray-700 p-3 mt-3 flex-col">
                <h1 class="p-1 text-lg font-semibold">Add your answer</h1>
                <form action="/answer/{{ $question->id }}" method="POST">
                    @csrf
                    <textarea type="text" name="answer" id="answer" placeholder="Input Your Answer Here"
                        class="textarea textarea-bordered w-full" value="{{ old('answer') }}"></textarea>
                        <button class="btn btn-success text-white mt-2" type="submit">Add Your Answer</button>
                    @error('answer')
                        <span class="text-red-500">
                            {{ $message }}
                        </span>
                    @enderror
                </form>
            </div>
        @endif

    </div>
@endsection
