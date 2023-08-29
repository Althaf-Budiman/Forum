<div class="flex flex-col items-center">
    <button wire:click="upvote" class="{{ $isUpvoted ? 'bi bi-caret-up-fill' : 'bi bi-caret-up' }}"></button>
    <p class="leading-[48px]">
        {{ $question->votes()->where('vote_type', 'upvote')->count() -$question->votes()->where('vote_type', 'downvote')->count() }}
    </p>
    <button wire:click="downvote" class="{{ $isDownvoted ? 'bi bi-caret-down-fill' : 'bi bi-caret-down' }}"></button>
</div>
