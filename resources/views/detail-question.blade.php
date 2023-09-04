@extends('layouts.app')
@section('main')
    <div class="flex w-full items-center flex-col">
        @livewire('question-item', ['question' => $question])

        {{-- Answer --}}
        <div class="flex w-8/12 bg-gray-700 p-3 mt-3">
            <h1 class="p-1 text-lg font-semibold">0 Answers</h1>
        </div>

        @foreach ($answers as $answer)
            @livewire('answer-item', ['answer' => $answer])
        @endforeach

        {{-- Add Answer --}}
        <div class="flex w-8/12 bg-gray-700 p-3 mt-3 flex-col">
            <h1 class="p-1 text-lg font-semibold">Add your answer</h1>
            <form action="/answer/{{ $question->id }}" method="POST">
                @csrf
                <textarea type="text" name="answer" id="answer" placeholder="Input Your Answer Here"
                    class="textarea textarea-bordered w-full" value="{{ old('answer') }}"></textarea>
                <div class="btn btn-primary mt-2">
                    <button class="font-medium text-white" type="submit">Add Your Answer</button>
                </div>
                @error('answer')
                    <span class="text-red-500">
                        {{ $message }}
                    </span>
                @enderror
            </form>
        </div>

    </div>
@endsection
