@extends('layouts.app')
@section('main')
    <div class="flex justify-center w-full">
        <div class="flex w-8/12 bg-gray-700 p-3 mt-3">
            <h1 class="p-1 text-lg font-semibold">This Comment Is From Answer: <a
                    href='{{ url("/answer/$answerTarget->id/detail") }}' class="underline">{{ $answerTarget->answer }}</a>
            </h1>
        </div>
    </div>
    <div class="ps-5 pt-2 mt-5 bg-gray-700">
        @livewire('comment-item', ['comment' => $comment, 'isDetailPage' => true], key($comment->id))
    </div>
@endsection
