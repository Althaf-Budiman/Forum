<div class="flex w-full justify-between pr-8 mt-4">

    {{-- Comment Content  --}}
    <div class="flex flex-col">
        <div class="flex">
            <div class="avatar">
                <div class="w-10 h-10 rounded-full">
                    <img class="w-full" src="{{ asset('storage/' . $comment->user->profile_photo_path) }}"
                        alt="user avatar questioner">
                </div>
            </div>
            <p class="leading-[48px] ml-3">{{ $comment->user->name }}</p>
        </div>

        <div class="w-[40rem] ms-12">
            <p class="text-lg font-regular text-white">{{ $comment->comment }}</p>
        </div>
    </div>

    {{-- Upvote Downvote --}}
    <div class="flex flex-col items-center">
        <button wire:click="upvote({{ $comment->id }})" class="{{ $comment->upvoteStatusIcon() }}"></button>
        <p class="leading-[48px]">
            {{ $comment->votes()->where('vote_type', 'upvote')->count() -$comment->votes()->where('vote_type', 'downvote')->count() }}
        </p>
        <button wire:click="downvote({{ $comment->id }})" class="{{ $comment->downvoteStatusIcon() }}"></button>
    </div>
</div>
