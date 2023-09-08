<div class="flex w-full justify-between pr-8 mt-4 border-b-[0.1px]">

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

        {{-- Upvote Downvote, Reply comment --}}
        <div class="flex gap-5 ps-8">
            <button wire:click="upvote({{ $comment->id }})" class="{{ $comment->upvoteStatusIcon() }}"></button>
            <p class="leading-[48px]">
                {{ $comment->votes()->where('vote_type', 'upvote')->count() -$comment->votes()->where('vote_type', 'downvote')->count() }}
            </p>
            <button wire:click="downvote({{ $comment->id }})" class="{{ $comment->downvoteStatusIcon() }}"></button>
            <button wire:click="loadReply({{ $comment->id }})" class="underline leading-[48px]">Reply {{ $comment->where('parent_id', $comment->id)->count() }}</button>
        </div>

        @if ($isReplying)
            <form wire:submit.prevent="replyComment({{ $comment->id }})">
                <div class="flex ms-8 mt-3 gap-3">
                    <input type="text" wire:model="replyContent" placeholder="Reply This Comment"
                        class="input input-bordered w-full" value="{{ old('replyContent') }}" />
                    <button wire:click="replyComment({{ $comment->id }})" class="btn btn-primary">Reply</button>
                </div>
            </form>

            @foreach ($replies as $reply)
                {{-- Comment Content  --}}
                <div class="ms-8 mt-3 flex flex-col" wire:key="{{ $reply->id }}">
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
                        <button wire:click="upvote({{ $reply->id }})"
                            class="{{ $reply->upvoteStatusIcon() }}"></button>
                        <p class="leading-[48px]">
                            {{ $reply->votes()->where('vote_type', 'upvote')->count() -$reply->votes()->where('vote_type', 'downvote')->count() }}
                        </p>
                        <button wire:click="downvote({{ $reply->id }})"
                            class="{{ $reply->downvoteStatusIcon() }}"></button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</div>
