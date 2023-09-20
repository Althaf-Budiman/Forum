{{-- Comment Content  --}}
<div class="ms-8 mt-3 flex flex-col" id="reply{{ $reply->id }}">
    <div class="flex">
        <div class="avatar">
            <div class="w-10 h-10 rounded-full">
                <img class="w-full" src="{{ asset('storage/' . $reply->user->profile_photo_path) }}"
                    alt="user avatar questioner">
            </div>
        </div>
        <p class="leading-[48px] ml-3">{{ $reply->user->name }}</p>
    </div>

    <div class="w-[40rem] ms-12">
        <p class="text-lg font-regular text-white">{{ $reply->comment }}</p>
    </div>

    {{-- Upvote Downvote, Reply comment --}}
    <div class="flex gap-5 ps-8">
        <button wire:click="replyAddVote('upvote')" class="{{ $reply->upvoteStatusIcon() }}"></button>
        <p class="leading-[48px]">
            {{ $reply->votes()->where('vote_type', 'upvote')->count() -$reply->votes()->where('vote_type', 'downvote')->count() }}
        </p>
        <button wire:click="replyAddVote('downvote')" class="{{ $reply->downvoteStatusIcon() }}"></button>
    </div>
</div>
