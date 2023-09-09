<div class="flex w-8/12 bg-gray-700 p-3 mt-3">
    <div class="flex w-full justify-evenly">
        {{-- Upvote Downvote --}}
        <div class="flex flex-col items-center">
            <button wire:click="questionAddVote('upvote')" class="{{ $question->upvoteStatusIcon() }}"></button>
            <p class="leading-[48px]">
                {{ $question->votes()->where('vote_type', 'upvote')->count() -$question->votes()->where('vote_type', 'downvote')->count() }}
            </p>
            <button wire:click="questionAddVote('downvote')" class="{{ $question->downvoteStatusIcon() }}"></button>
        </div>
        {{-- Answer Count --}}
        <div class="flex flex-col">
            <p class="leading-[96px]">{{ $question->totalAnswers() }} Answers</p>
        </div>

        {{-- Question Title , Kategori  --}}
        <div class="flex flex-col">
            <div class="w-80 @if (!$isDetailPage) whitespace-nowrap text-ellipsis overflow-hidden @endif">
                <a href='{{ url("/question/$question->id/detail") }}'
                    class="text-lg font-semibold text-white underline leading-[48px]">{{ $question->title }}</a>
            </div>
            <span class="badge">{{ $question->category }}</span>
        </div>

        {{-- Questioner avatar and name --}}
        <div class="flex mt-7">
            <div class="avatar">
                <div class="w-10 h-10 rounded-full">
                    <img class="w-full" src="{{ asset('storage/' . $question->user->profile_photo_path) }}"
                        alt="user avatar questioner">
                </div>
            </div>
            <p class="leading-[48px] ml-3">{{ $question->user->name }}</p>
        </div>

        {{-- Questioner bookmarks --}}
        <div class="flex">
            <button wire:click="questionAddBookmark()" class="{{ $question->bookmarkStatusIcon() }}"></button>
        </div>

    </div>
</div>
